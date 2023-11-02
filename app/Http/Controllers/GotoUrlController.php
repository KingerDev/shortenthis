<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;

class GotoUrlController extends Controller
{
    public function click(Request $request, String $prefix)
    {
       $url = Url::where('prefix', $prefix)->withCount('clicks')->first();

       if ($url->clicks_limit && $url->clicks_count >= $url->clicks_limit) {
           return redirect()
               ->route('/')
               ->with('success', "Clicks limit has been reached");
       }

       $url->clicks()->create([
           'user_agent' => $request->header('user-agent'),
           'type' => 'click',
       ]);

        return redirect()->away($url->original_url);
    }

    public function qr(Request $request, String $prefix)
    {
        $url = Url::where('prefix', $prefix)->withCount('clicks')->first();

        if ($url->clicks_limit && $url->clicks_count >= $url->clicks_limit) {
            return redirect()
                ->route('/')
                ->with('success', "Clicks limit has been reached");
        }

        $url->clicks()->create([
            'user_agent' => $request->header('user-agent'),
            'type' => 'qr'
        ]);

        return redirect()->away($url->original_url);
    }
}
