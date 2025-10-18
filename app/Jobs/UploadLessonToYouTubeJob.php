<?php

namespace App\Jobs;

use App\Models\lesson;
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
use Illuminate\Support\Facades\Storage;

class UploadLessonToYouTubeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $lesson;
    protected $videoPath;
    protected $token;

    public function __construct(lesson $lesson, $videoPath, $token)
    {
        $this->lesson = $lesson;
        $this->videoPath = $videoPath;
        $this->token = $token;
    }

    public function handle(): void
    {
        echo "🚀 بدء رفع الفيديو: {$this->lesson->title}" . PHP_EOL;

        $client = new Google_Client();
        $client->setAccessToken($this->token);

        try {
            echo "🔹 إنشاء كائن YouTube..." . PHP_EOL;
            $youtube = new Google_Service_YouTube($client);

            $video = new Google_Service_YouTube_Video();
            $snippet = new Google_Service_YouTube_VideoSnippet();
            $snippet->setTitle($this->lesson->title);
            $snippet->setDescription($this->lesson->description ?? 'Lesson uploaded via Viedma Platform');
            $snippet->setCategoryId("27"); // Education category

            $status = new Google_Service_YouTube_VideoStatus();
            $status->privacyStatus = "unlisted";

            $video->setSnippet($snippet);
            $video->setStatus($status);

            $chunkSizeBytes = 1 * 1024 * 1024;
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

            $fullPath = Storage::disk('public')->path($this->videoPath);

            if (!file_exists($fullPath)) {
                echo "❌ ملف الفيديو غير موجود في المسار: {$fullPath}" . PHP_EOL;
                return;
            }

            echo "📦 حجم الملف: " . filesize($fullPath) . " بايت" . PHP_EOL;

            $media->setFileSize(filesize($fullPath));

            $uploadStatus = false;
            $handle = fopen($fullPath, "rb");

            echo "📤 بدء رفع الفيديو على YouTube..." . PHP_EOL;

            while (!$uploadStatus && !feof($handle)) {
                $chunk = fread($handle, $chunkSizeBytes);
                $uploadStatus = $media->nextChunk($chunk);
            }

            fclose($handle);
            $client->setDefer(false);

            if (isset($uploadStatus['id'])) {
                $youtubeVideoId = $uploadStatus['id'];
                $this->lesson->update([
                    'video_url' => "https://www.youtube.com/watch?v={$youtubeVideoId}"
                ]);

                Storage::disk('public')->delete($this->videoPath);

                echo "✅ تم رفع الفيديو بنجاح إلى YouTube! ID: {$youtubeVideoId}" . PHP_EOL;
            } else {
                echo "❌ لم يتم استلام معرف الفيديو من YouTube" . PHP_EOL;
            }

        } catch (\Exception $e) {
            echo "💥 خطأ أثناء الرفع: " . $e->getMessage() . PHP_EOL;
        }
    }

    public function failed(\Throwable $exception)
    {
        echo "🔥 فشل الجوب: " . $exception->getMessage() . PHP_EOL;
    }
}
