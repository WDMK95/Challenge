<?php

namespace App\Http\Controllers;

use stdClass;
use Throwable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\CleanTweetValidationRequest;
use App\Models\Tweet;

class TweetController extends Controller
{

    public function cleanTweet(CleanTweetValidationRequest $request, CleanLanguageService $cleanLanguageService)
    {
        $text = $request->text;
        $cleanText = $cleanLanguageService->clean($text)['cleanText'];

        if ($text != $cleanText) {
            if (config('admin.email')) {
                $this->notifyAdmin($text, new EmailService);
            }
            if (config('admin.phone')) {
                $this->notifyAdmin($text, new SmsService);
            }
        }

        if (!$this->saveTweet($cleanText)) {
            return 'something went wrong';
        }

        return redirect('/');
    }


    private function notifyAdmin(string $text, NotifiesAdmin $notificationService): void
    {
        $notificationService->notifyAdmin($text);
    }

    private function saveTweet($cleanText)
    {
        try {
            Tweet::create(['body' => $cleanText, 'user_id' => auth()->user()->id]);
            return 'success';
        } catch (\Exception $exception) {
            return '';
        }
    }
}

class CleanLanguageService
{
    public function clean(string $text): array
    {
        $response = new stdClass;
        try {
            $response = json_decode(Http::get('https://www.purgomalum.com/service/json?text=' . $text)->getBody()->getContents());
        } catch (Throwable $th) {
            Log::info($th);
        }
        $cleanText = optional($response)->result;

        $replacedCharCount = substr_count($text, '*');
        return [
            'originalText' => $text,
            'cleanText' => $cleanText,
            'replacedCharCount' => $replacedCharCount
        ];
    }
}

interface NotifiesAdmin
{
    public function notifyAdmin(string $text): void;
}

class EmailService implements NotifiesAdmin
{
    public function notifyAdmin(string $text): void
    {
        // nothing to implement here. This is just a dummy method
        Log::info('Admin email notification: ' . $text);
    }
}

class SmsService implements NotifiesAdmin
{
    public function notifyAdmin(string $text): void
    {
        // nothing to implement here. This is just a dummy method
        Log::info('Admin sms notification: ' . $text);
    }
}
