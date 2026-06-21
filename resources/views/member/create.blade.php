@extends('layout.app')
@section('title', 'Generate URL')
@section('content')
<div class="card">
    <h2 class="page-heading">
        Generate Short URL
    </h2>
    <div class="url-box">
        <form action="{{ route('member.create.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">
                    Long URL
                </label>
                <input
                    style="width:max-content"
                    type="url"
                    name="long_url"
                    class="form-input"
                    placeholder="e.g. https://www.test.com"
                    >
                    @error('long_url')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
            </div>
            <button type="submit" class="btn-generate">
                Generate
            </button>
        </form>
    </div>
</div>
@endsection