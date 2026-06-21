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
            <h3>Invite New Team Member</h3>
        </div>

    </div>
    <table class="url-table">


    </table>

    <div class="pagination-box">

        <div class="url-box">
            <form action="{{ route('admin.invite.send') }}" method="POST">
                @csrf

                <div class="invite-row">

                    <div class="form-group">
                        <label>Name</label>
                        <input
                            type="text"
                            name="name"
                            class="form-input"
                            placeholder="User Name"
                            value="{{ old('name') }}"
                            required>
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input
                            type="email"
                            name="email"
                            class="form-input"
                            placeholder="ex. sample@example.com"
                            required>
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Role</label>
                        <select name="role" class="form-input">
                            <option value="member">Member</option>
                            <option value="admin">Admin</option>
                        </select>
                        @error('role')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <button type="submit" class="btn-generate">
                    Send Invitation
                </button>
            </form>
        </div>

    </div>
</div>
@endsection