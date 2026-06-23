<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use Illuminate\Http\Request;
use Str;

class ShortUrlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $allurls = ShortUrl::get()->all();
        $allurls = ShortUrl::where('user_id', auth()->id())->latest()->paginate(10);

        // dd($allurls);
        return view('member.index', compact('allurls'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('member.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd('you are here');
        $validate_data =  $request->validate([
            'long_url' => 'required'
        ]);
        // dd($validate_data);
        // $short_url = Str::random('7')->unique();

        do {
            $short_url = Str::random('7');
        } while (
            ShortUrl::where('short_url', $short_url)->exists()
        );

        // dd($short_url);
        ShortUrl::create([
            'long_url' => $request->long_url,
            'short_url' => $short_url,
            'user_id' => auth()->id(),
        ]);
        return redirect()->route('member.index')->with('success', 'url generated and stored successfully');
    }

    public function download(Request $request)
    {
        $duration =  $request->duration;
        // dd($duration, now()->subMonth()->month);
        // dd($duration, now()->month);
        if ($duration == "this_month") {
            $Data = ShortUrl::where('user_id', auth()->id())->whereMonth('created_at', now()->month)->get();
            // dd($Data);
            // return response()->json($Data);
        } elseif ($duration == "last_month") {
            $Data = ShortUrl::where('user_id', auth()->id())->whereMonth('created_at', now()->subMonth()->month)->get();
            // dd($Data);
            // return response()->json($Data);
        } elseif ($duration == "last_week") {
            $Data = ShortUrl::where('user_id', auth()->id())->whereBetween('created_at', [now()->subWeek(), now()])->get();
            // dd($Data);
            // return response()->json($Data);
        } elseif ($duration == "today") {
            $Data = ShortUrl::where('user_id', auth()->id())->whereDate('created_at', today())->get();
            // dd(today());
            // dd($Data);
            // return response()->json($Data);
        }

        return response(
            $Data->toJson(JSON_PRETTY_PRINT)
        )
            ->header('Content-Type', 'application/json')
            ->header(
                'Content-Disposition',
                'attachment; filename="short_urls.json"'
            );
    }
}
