<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use Illuminate\Http\Request;

class publiclUrlController extends Controller
{
    public function redirect($shortUrl)
    {
        $url = ShortUrl::where('short_url', $shortUrl)->firstOrFail();
        // dd($url->long_url);
        $url->increment('hits');

        return redirect()->away($url->long_url);
    }
}
