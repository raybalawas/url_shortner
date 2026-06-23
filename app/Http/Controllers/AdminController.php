<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Str;

class AdminController extends Controller
{
    public function index()
    {
        // dd('jsdklfa');
        // $memberIds =  User::where('parent', auth()->id())->pluck('id');
        // dd(auth()->id(), $memberIds);

        // $allurls = ShortUrl::whereIn('user_id', $memberIds)->latest()->paginate(10);
        $allurls = ShortUrl::where('user_id', auth()->id())->latest()->paginate(10);
        // dd($allurls);
        $allMembers = User::where('parent', auth()->id())->limit(2)->get();
        $count = User::where('parent', auth()->id())->count();

        // dd($allMembers);
        return view('admin.index', compact('allurls', 'allMembers', 'count'));
    }

    public function create()
    {
        return view('admin.create');
    }

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
        return redirect()->route('admin.index')->with('success', 'url generated and stored successfully');
    }
    public function viewAllUrl()
    {
        // dd('jsdklfa');
        // $memberIds =  User::where('parent', auth()->id())->pluck('id');
        // dd(auth()->id(), $memberIds);

        // $allurls = ShortUrl::whereIn('user_id', $memberIds)->latest()->paginate(10);
        $allurls = ShortUrl::where('user_id', auth()->id())->latest()->paginate(10);
        // dd($allurls);
        // dd($allMembers);
        return view('admin.viewAllUrl', compact('allurls'));
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

    public function AllMemebers()
    {
        $allMembers = User::where('parent', auth()->id())->paginate(10);
        return view('admin.allMembers', compact('allMembers'));
    }

    public function invite()
    {
        return view('admin.invite');
    }

    public function inviteSend(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'role' => 'required'
        ]);

        $hashedPass = Hash::make('InvitedPerson@123');
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $hashedPass,
            'role_id' => $request->role == 'admin' ? 2 : 3,
            'parent' => auth()->id()
        ]);

        return redirect()
            ->route('admin.index')
            ->with('success', 'Invitation send successfully.
');
    }
}
