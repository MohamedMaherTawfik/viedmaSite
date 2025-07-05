<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Mail\ZoomMeetingReminderMail;
use App\Models\CourseMeeting;
use App\Models\Courses;
use App\Models\Enrollments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class zoomController extends Controller
{

    public function livePage(Request $request, $slug)
    {
        $course = Courses::where('slug', $slug)->firstOrFail();
        $meeting = $course->courseMeetings()->latest('start_time')->first();
        return view('teacherDashboard.zoom.live', compact('slug', 'meeting'));
    }

    public function redirectToZoom(Request $request, $slug)
    {
        $clientId = env('ZOOM_CLIENT_ID');

        session(['zoom_course_slug' => $slug]);

        $redirectUri = route('zoom.callback', ['slug' => 'redirect-handler']);

        $url = "https://zoom.us/oauth/authorize?" . http_build_query([
            'response_type' => 'code',
            'client_id' => $clientId,
            'redirect_uri' => $redirectUri,
        ]);

        return redirect($url);
    }


    public function handleCallback(Request $request, $slug)
    {
        // 👈 هنا بنتجاهل الـ $slug اللي جاي من الرابط ونستخدم اللي في session
        $realSlug = session('zoom_course_slug');

        $code = $request->get('code');
        $redirectUri = route('zoom.callback', ['slug' => 'redirect-handler']);

        $response = Http::asForm()
            ->withHeaders([
                'Authorization' => 'Basic ' . base64_encode(env('ZOOM_CLIENT_ID') . ':' . env('ZOOM_CLIENT_SECRET')),
            ])
            ->post('https://zoom.us/oauth/token', [
                'grant_type' => 'authorization_code',
                'code' => $code,
                'redirect_uri' => $redirectUri,
            ]);

        if ($response->failed()) {
            return redirect()->route('liveChat', $realSlug)->with('error', 'Zoom connection failed at token exchange.');
        }

        $data = $response->json();

        $userResponse = Http::withToken($data['access_token'])
            ->get('https://api.zoom.us/v2/users/me');

        if ($userResponse->failed()) {
            return redirect()->route('liveChat', $realSlug)->with('error', 'Zoom user info request failed.');
        }

        $user = $userResponse->json();

        // 👈 احفظ التوكن مع بيانات الكورس
        session([
            'zoom_token' => $data['access_token'],
            'zoom_refresh_token' => $data['refresh_token'],
            'zoom_user_id' => $user['id'] ?? 'unknown',
            'zoom_email' => $user['email'] ?? 'not available',
            'zoom_name' => trim(($user['first_name'] ?? '') . ' ' . ($user['last_name'] ?? '')),
        ]);

        return redirect()->route('liveChat', $realSlug)->with('success', 'Zoom connected successfully.');
    }


    public function disconnectZoom()
    {
        session()->forget([
            'zoom_token',
            'zoom_refresh_token',
            'zoom_user_id',
            'zoom_email',
            'zoom_name',
        ]);

        return redirect()->route('liveChat', ['slug' => request('slug')])->with('success', 'Zoom disconnected successfully.');
    }

    public function createMeeting(Request $request, $slug)
    {
        $course = Courses::where('slug', $slug)->with('user')->firstOrFail();

        $accessToken = session('zoom_token');

        if (!$accessToken) {
            return redirect()->route('liveChat', $slug)->with('error', 'Zoom not connected.');
        }

        $response = Http::withToken($accessToken)->post('https://api.zoom.us/v2/users/me/meetings', [
            'topic' => 'Live Session - ' . $course->title,
            'type' => 2, // Scheduled meeting
            'start_time' => now()->addMinutes(10)->toIso8601String(),
            'duration' => 60, // بالـ minutes
            'settings' => [
                'host_video' => true,
                'participant_video' => true,
            ],
        ]);

        if ($response->failed()) {
            dd($response->json()); // ✅ يطبع الرسالة فعليًا
        }

        $data = $response->json();

        $meeting = CourseMeeting::create([
            'courses_id' => $course->id,
            'zoom_meeting_id' => $data['id'],
            'join_url' => $data['join_url'],
            'start_url' => $data['start_url'] ?? null,
            'start_time' => now(),
        ]);
        $enrollments = Enrollments::with('user')->where('courses_id', $course->id)->get();
        foreach ($enrollments as $enrollment) {
            if (!$enrollment->user) {
                logger('Enrollment ID ' . $enrollment->id . ' has no user!');
                continue;
            }

            logger('Sending to: ' . $enrollment->user->email);

            Mail::to($enrollment->user->email)->send(new ZoomMeetingReminderMail($enrollment->user, $course, $meeting));
        }
        session([
            'zoom_meeting_url_' . $slug => $data['join_url'],
            'zoom_start_url_' . $slug => $data['start_url'],
        ]);
        return redirect()->route('liveChat', $slug)->with('success', 'Meeting created and students notified by email.');
    }



    public function attendMeeting($slug)
    {
        $course = Courses::where('slug', $slug)->firstOrFail();
        $meeting = $course->meetings()->latest('start_time')->first();

        if (!$meeting || !$meeting->join_url) {
            return redirect()->route('liveChat', $slug)->with('error', 'No active meeting found.');
        }

        return redirect()->away($meeting->join_url);
    }


}