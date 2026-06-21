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
            <h3>All Team Membrs</h3>
        </div>

        <div class="right-section">

            <div class="options-row">


                <a href="{{ route('admin.invite') }}" class="btn-generate">
                    Invite
                </a>

            </div>

        </div>

    </div>
    <table class="url-table">

        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Total Generated Urls</th>
                <th>Total URL Hits</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($allMembers as $allMember)

            <tr>
                <td>{{ $allMember->name }}</td>
                <td>{{ $allMember->email }}</td>
                <td>{{ $allMember->role_id == 2 ? 'admin':'null' }}</td>
                <td> {{ \App\Models\ShortUrl::where('user_id', $allMember->id)->count() }}</td>
                <td> {{ \App\Models\ShortUrl::where('user_id', $allMember->id)->sum('hits') }}
                </td>
            </tr>
            @endforeach


        </tbody>

    </table>

    <div class="pagination-box">

        <div>
            Showing {{ $allMembers->firstItem() ?? 0 }} of total {{ $allMembers->total() }}
        </div>

        <div>

            @if($allMembers->onFirstPage())
            <button class="page-btn" disabled>
                ← Prev
            </button>
            @else
            <a href="{{ $allMembers->previousPageUrl() }}"
                class="page-btn">
                ← Prev
            </a>
            @endif

            @if($allMembers->hasMorePages())
            <a href="{{ $allMembers->nextPageUrl() }}"
                class="page-btn">
                Next →
            </a>
            @else
            <button class="page-btn" disabled>
                Next →
            </button>
            @endif
        </div>

    </div>
</div>
@endsection