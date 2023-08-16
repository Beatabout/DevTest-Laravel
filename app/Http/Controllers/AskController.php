<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class AskController extends Controller
{
    public function __invoke(Request $request)
    {
        $question = $request->query('question');
        return response()->stream(function () use ($question) {
            $stream = OpenAI::chat()->createStreamed([
                'model' => 'gpt-3.5-turbo-16k',
                'messages' => [
                    
                    ['role' => 'system', 'content' => 'Завжди відповідай Українською! Наче ти веб розробник.'],
                    ['role' => 'user', 'content' => $question]
                ],
                'temperature' => 0,
                'max_tokens' => 16000
            ]);

            foreach ($stream as $response) {
                $text = $response->choices[0]->delta->content;
                if (connection_aborted()) {
                    break;
                }

                echo "event: update\n";
                echo 'data: ' . $text;
                echo "\n\n";
                ob_flush();
                flush();
            }

            echo "event: update\n";
            echo 'data: <END_STREAMING_SSE>';
            echo "\n\n";
            ob_flush();
            flush();
        }, 200, [
            'Cache-Control' => 'no-cache',
            'X-Accel-Buffering' => 'no',
            'Content-Type' => 'text/event-stream',
        ]);
    }
}
