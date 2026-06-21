<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Str;

class SuperAdminController extends Controller
{
    public function index()
    {
        // dd('jsdklfa');
        $memberIds =  User::where('parent', auth()->id())->pluck('id');
        // dd(auth()->id(), $memberIds);

        $allurls = ShortUrl::whereIn('user_id', $memberIds)->latest()->paginate(10);
        // $allurls = ShortUrl::latest()->paginate(10);
        // dd($allurls);
        $allMembers = User::Where('role_id', '2')->limit(2)->get();
        $totalMembers =  User::Where('role_id', '2')->count();
        // dd($totalMembers);
        // dd($allMembers);
        return view('superadmin.index', compact('allurls', 'allMembers', 'totalMembers'));
    }


    public function viewAllUrl()
    {
        // dd('jsdklfa');
        // $memberIds =  User::where('parent', auth()->id())->pluck('id');
        // dd(auth()->id(), $memberIds);
        $memberIds =  User::where('parent', auth()->id())->pluck('id');

        $allurls = ShortUrl::whereIn('user_id', $memberIds)->latest()->paginate(10);

        // $allurls = ShortUrl::latest()->paginate(10);

        // dd($allurls);
        // dd($allMembers);
        return view('superadmin.viewAllUrl', compact('allurls'));
    }

    public function download(Request $request)
    {
        $duration =  $request->duration;
        // dd($duration, now()->subMonth()->month);
        // dd($duration, now()->month);
        $companyIds = User::where('parent', auth()->id())->pluck('id');
        // dd($companyIds);
        if ($duration == "this_month") {
            $Data = ShortUrl::whereIn('user_id', $companyIds)
                ->whereMonth('created_at', now()->month)
                ->get();
            // dd($Data);
            // return response()->json($Data);
        } elseif ($duration == "last_month") {
            $Data = ShortUrl::whereMonth('created_at', now()->subMonth()->month)->get();
            // dd($Data);
            // return response()->json($Data);
        } elseif ($duration == "last_week") {
            $Data = ShortUrl::whereBetween('created_at', [now()->subWeek(), now()])->get();
            // dd($Data);
            // return response()->json($Data);
        } elseif ($duration == "today") {
            $Data = ShortUrl::whereDate('created_at', today())->get();
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
        $allMembers = User::Where('role_id', '2')->latest()->paginate(10);

        // $allMembers = User::latest()->paginate(10);
        return view('superadmin.allMembers', compact('allMembers'));
    }

    public function invite()
    {
        return view('superadmin.invite');
    }

    public function inviteSend(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
        ]);

        $hashedPass = Hash::make('InvitedPerson@123');
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $hashedPass,
            'role_id' => 2,
            'parent' => auth()->id()
        ]);

        return redirect()
            ->route('superadmin.index')
            ->with('success', 'Invitation send successfully.
');
    }
}
