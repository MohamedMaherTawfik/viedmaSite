<?php

namespace App\Jobs;

use App\Models\Lesson;
use Google_Client;
use Google_Service_YouTube;
use Google_Service_YouTube_Video;
use Google_Service_YouTube_VideoSnippet;
use Google_Service_YouTube_VideoStatus;
use Google_Http_MediaFileUpload;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class UploadLessonToYouTubeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $lesson;
    protected $videoPath;
    protected $token;

    /**
     * Create a new job instance.
     */
    public function __construct(Lesson $lesson, $videoPath, $token)
    {
        $this->lesson = $lesson;
        $this->videoPath = $videoPath;
        $this->token = $token;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $client = new Google_Client();
        $client->setAccessToken($this->token);

        $youtube = new Google_Service_YouTube($client);

        $video = new Google_Service_YouTube_Video();
        $snippet = new Google_Service_YouTube_VideoSnippet();
        $snippet->setTitle($this->lesson->title);
        $snippet->setDescription($this->lesson->description ?? 'Lesson uploaded via Viedma Platform');
        $snippet->setCategoryId("27"); // Education

        $status = new Google_Service_YouTube_VideoStatus();
        $status->privacyStatus = "unlisted";

        $video->setSnippet($snippet);
        $video->setStatus($status);

        $chunkSizeBytes = 1 * 1024 * 1024; // 1MB
        $client->setDefer(true);

        $insertRequest = $youtube->videos->insert("status,snippet", $video);
        $media = new Google_Http_MediaFileUpload(
            $client,
            $insertRequest,
            'video/*',
            null,
            true,
            $chunkSizeBytes
        );

        $fullPath = storage_path('app/' . $this->videoPath);
        $media->setFileSize(filesize($fullPath));

        $uploadStatus = false;
        $handle = fopen($fullPath, "rb");
        while (!$uploadStatus && !feof($handle)) {
            $chunk = fread($handle, $chunkSizeBytes);
            $uploadStatus = $media->nextChunk($chunk);
        }
        fclose($handle);

        $client->setDefer(false);

        // حفظ رابط الفيديو في قاعدة البيانات
        $youtubeVideoId = $uploadStatus['id'];
        $this->lesson->update([
            'video_url' => "https://www.youtube.com/watch?v={$youtubeVideoId}"
        ]);

        // حذف الفيديو المحلي بعد الرفع
        Storage::delete($this->videoPath);
    }
}