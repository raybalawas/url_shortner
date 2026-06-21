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
            <h3>Generated Short URLs</h3>

            <a href="{{ route('admin.create') }}" class="btn-generate">Generate</a>
        </div>

        <div class="right-section">

            <div class="options-row">
                <form action="{{ route('admin.download') }}" method="post">
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
                <th>Created On</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($allurls as $allurl)

            <tr>
                <td>{{ url('/s/' . $allurl->short_url) }}</td>
                <td>{{ $allurl->long_url }}</td>

                <td>{{ $allurl->hits }}</td>

                <td>{{ $allurl->created_at->format("d M 'y") }}</td>
            </tr>
            @endforeach


        </tbody>

    </table>

    <div class="pagination-box">

        <div>
            Showing {{ $allurls->firstItem() ?? 0 }} of total {{ $allurls->total() }}
        </div>

        <div>

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
            @endif
        </div>

    </div>

</div>

@endsection