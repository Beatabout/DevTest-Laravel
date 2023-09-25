<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MyEvent;
use OpenAI\Laravel\Facades\OpenAI;

class AskController extends Controller
{
    public function __invoke(Request $request)
    {
        $question = $request->query('question');
        
        event(new MyEvent('Hello World!'));

        return response()->stream(function () use ($question) {
            $stream = OpenAI::chat()->createStreamed([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    
                    ['role' => 'system', 'content' => 'Ти віртуальний лікар! Якщо питання не стосується медицини, відповідай - "Я не знаю.".'],
                    ['role' => 'user', 'content' => $question]
                ],
                'temperature' => 1,
                'max_tokens' => 1000
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
