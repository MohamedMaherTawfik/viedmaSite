<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;

use App\Http\Requests\userApiRequest;
use App\Http\Requests\userEditRequest;
use App\Mail\OtpMail;
use App\Models\applyTeacher;
use App\Models\Courses;
use App\Models\Enrollments;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    use apiResponse;

    public function register(userApiRequest $request)
    {
        $fields = $request->validated();
        $fields['password'] = bcrypt($fields['password']);
        $fields['photo'] = $request->file('photo')->store('photos', 'public');

        $otp = rand(100000, 999999);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => $fields['password'],
            'role' => $fields['role'],
            'photo' => $fields['photo'],
            'otp' => $otp,
            'otp_expires_at' => now()->addMinutes(10),
            'is_verified' => false
        ]);

        if ($user->role === 'teacher') {
            $fields['cv'] = $request->file('cv')->store('CVs', 'public');
            $fields['certificate'] = $request->file('certificate')->store('certificatess', 'public');

            applyTeacher::create([
                'user_id' => $user->id,
                'cv' => $fields['cv'],
                'certificate' => $fields['certificate'],
                'topic' => $fields['topics'],
                'phone' => $fields['phone'],
            ]);
        }

        Mail::to($user->email)->send(new OtpMail($otp, $user));
        return response()->json([
            'message' => 'User registered. Please verify the OTP sent to your email.'
        ]);
    }

    public function verifyOtpAfterRegister(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|digits:6',
        ]);

        $user = User::where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('otp_expires_at', '>=', now())
            ->first();

        if (!$user) {
            return response()->json(['message' => 'Invalid or expired OTP'], 422);
        }

        $user->is_verified = true;
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();

        $token = Auth::guard('api')->login($user);

        return response()->json([
            'message' => 'Account verified successfully.',
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60,
            'user' => $user->load('applyTeacher'),
        ]);
    }



    public function login()
    {
        $credentials = request(['email', 'password']);
        $token = Auth::guard('api')->attempt($credentials);

        if (!$token) {
            return $this->unauthorized(__('messages.Error_login'));
        }

        $success = $this->respondWithToken($token);

        return $this->success($success->original, __('messages.login'));
    }


    public function profile()
    {
        $user = Auth::user()->load('course');
        $enrollment = Enrollments::with('course')->where('user_id', $user->id)->where('enrolled', 'yes')->pluck('courses_id');
        $courses = Courses::whereIn('id', $enrollment)->get();
        return response()->json(
            [
                'status' => 'success',
                'message' => 'Profile',
                'data' => $user,
                'courses' => $courses,
            ]
        );

    }

    public function logout()
    {
        Auth::guard('api')->logout();

        return $this->success([], 'Logout Successfully');
    }

    public function refresh()
    {
        $token = $this->respondWithToken(Auth::guard('api')->refresh());

        return $this->success($token->original, 'Refresh Successfully');
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60 * 14 * 24,
            'user' => Auth::guard('api')->user(),
        ]);
    }

    public function updateProfile(userEditRequest $request)
    {
        $fields = $request->validated();
        if ($request->hasFile('photo')) {
            $fields['photo'] = $request->file('photo')->store('photos', 'public');
        }
        $user = User::where('id', Auth::guard('api')->id())->update($fields);
        if (!$user) {
            return $this->unauthorized(__('messages.Error_update_profile'));
        }
        return $this->success($user, __('messages.update_profile'));
    }

    public function userNotifications()
    {
        $user = User::with('notifications')->find(Auth::guard('api')->id());
    }
}