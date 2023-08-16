<?php

namespace App\Http\Controllers;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class SalvadorController extends Controller
{
    public function __invoke(Request $request)
    {
        if($request->isMethod('get')) {
            return view('salvador');

        } else if($request->isMethod('post')) {
            $description = $request->input('description');
            $response = OpenAI::images()->create([
                'prompt' => $description,
                'n' => 1,
                'size' => '1024x1024',
                'response_format' => 'url'
            ]);
            $response->created;

            foreach ($response->data as $data) {
                $imageUrl = $data->url;
            }
    
            return view('salvador', compact(
                'imageUrl',
                'description',
            ));

            // return view('salvador', compact(
            //     'request',
            // ));
        }
    }
}
