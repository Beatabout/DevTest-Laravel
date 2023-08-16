<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;
use OpenAI\Responses\Completions\CreateResponse;

class StreamingChatController extends Controller
{
    public function __invoke()
    {
        return view('streaming-chat'); // an open-source, widely-used, server-side scripting language.
    }
}
