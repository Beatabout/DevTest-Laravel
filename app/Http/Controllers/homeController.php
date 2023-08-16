<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;
use OpenAI\Responses\Completions\CreateResponse;

class homeController extends Controller
{
    public function requestOpenAi(){

        $result = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo-16k',
            'messages' => [
                
                ['role' => 'system', 'content' => 'Ти - віртуальний медичний асистент. Якщо user повідомлення не стосується медицини, відповідай: "Я - медичний асистент, який може допомогти вам з медичними питаннями."'],
                ['role' => 'user', 'content' => 'Що таке php']
            ],
            'temperature' => 0,
            'max_tokens' => 16000
        ]);

        $responce = $result['choices'][0]['message']['content'];
        
        return $responce; // an open-source, widely-used, server-side scripting language.
    }
}
