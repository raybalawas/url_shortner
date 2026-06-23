@extends('layout.app')
@section('title', 'Admin Dashboard')
@section('content')

@if(session('success'))
<div class="success-message">
    {{ session('success') }}
</div>
@endif

<div class="card">

    <div class="top-bar">
        <div class="left-section">
            <h3>Clients</h3>
        </div>

        <div class="right-section">

            <div class="options-row">


                <a href="{{ route('superadmin.invite') }}" class="btn-generate">
                    Invite
                </a>

            </div>

        </div>

    </div>
    <table class="url-table">

        <thead>
            <tr>
                <th>Client Name</th>
                <th>Users</th>
                <th>Total Generated Urls</th>
                <th>Total URL Hits</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($allMembers as $allMember)

            <tr>
                <td>{{ $allMember->name }}
                    <br>
                    <small>{{ $allMember->email }}</small>
                </td>
                <td>{{ \App\Models\User::where('parent',$allMember->id)->count() }}</td>

                <td>
                    {{ \App\Models\ShortUrl::where('user_id', $allMember->id)->count() }}
                </td>

                <td>
                    {{ \App\Models\ShortUrl::where('user_id', $allMember->id)->sum('hits') }}
                </td>
            </tr>
            @endforeach


        </tbody>

    </table>

    <div class="pagination-box">

        <div>
            Showing {{ $allurls->firstItem() ?? 0 }} of total {{ $totalMembers }}
        </div>
        <a href="{{ route('superadmin.allmembers') }}" style="margin-left: -50%;" class="page-btn">
            View All
        </a>
        <div>

            <!-- @if($allurls->onFirstPage())
            <button class="page-btn" disabled>
                ← Prev
            </button>
            @else
            <a href="{{ $allurls->previousPageUrl() }}"
                class="page-btn">
                ← Prev
            </a>
            @endif

            @if($allurls->hasMorePages())
            <a href="{{ $allurls->nextPageUrl() }}"
                class="page-btn">
                Next →
            </a>
            @else
            <button class="page-btn" disabled>
                Next →
            </button>
            @endif -->
        </div>

    </div>
</div>

<div class="card">

    <div class="top-bar">
        <div class="left-section">
            <h3>Generated Short URLs</h3>

        </div>

        <div class="right-section">

            <div class="options-row">
                <form action="{{ route('superadmin.download') }}" method="post">
                    @csrf
                    <select name="duration">
                        <option value="this_month">This Month</option>
                        <option value="last_month">Last Month</option>
                        <option value="last_week">Last Week</option>
                        <option value="today">Today</option>
                    </select>

                    <button type="submit" class="btn-download">
                        Download
                    </button>
                </form>
            </div>

        </div>

    </div>

    <table class="url-table">

        <thead>
            <tr>
                <th>Short URL</th>
                <th>Long URL</th>
                <th>Hits</th>
                <th>Company</th>
                <th>Created On</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($allurls as $allurl)
            <tr>
                <td>{{ url('/s/' . $allurl->short_url) }}</td>
                <td>{{ $allurl->long_url }}</td>
                <td>{{ $allurl->hits }}</td>
                <td>{{ \App\Models\User::find($allurl->user_id)?->name }}</td>
                <td>{{ $allurl->created_at->format("d M 'y") }}</td>
            </tr>
            @endforeach


        </tbody>

    </table>

    <div class="pagination-box">

        <div>
            Showing {{ $allurls->firstItem() ?? 0 }} of total {{ $allurls->total() }}

        </div>
        <a href="{{ route('superadmin.view.all.url') }}" style="margin-left: -50%;" class="page-btn">
            View All
        </a>
        <div>
            <!--
            @if($allurls->onFirstPage())
            <button class="page-btn" disabled>
                ← Prev
            </button>
            @else
            <a href="{{ $allurls->previousPageUrl() }}"
                class="page-btn">
                ← Prev
            </a>
            @endif

            @if($allurls->hasMorePages())
            <a href="{{ $allurls->nextPageUrl() }}"
                class="page-btn">
                Next →
            </a>
            @else
            <button class="page-btn" disabled>
                Next →
            </button>
            @endif -->
        </div>

    </div>

</div>



@endsection