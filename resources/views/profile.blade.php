@extends('layouts.master')

@section('profile')
    <div class="box">
        <h1 class="text-center">Profile</h1>
    
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="/profile-update" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" id="disabledInput" name="address" value="{{ $user->name }}" disabled>
            </div>
            
            <div class="mb-3">
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="text" class="form-control" id="disabledInput" name="address" value="{{ $user->email }}" disabled>
            </div>
            
            <div class="mb-3">
            <div class="mb-3">
                <label class="form-label">Role</label>
                <input type="text" class="form-control" id="disabledInput" name="address" value="{{ $user->role }}" disabled    >
            </div>
            
            <div class="mb-3">
            <div class="mb-3">
                <label class="form-label">Address</label>
                <input type="text" class="form-control" name="address" placeholder="Enter your address here" value="{{ $user->address }}">
            </div>
            
            <div class="mb-3">
                <label class="form-label">Postal Code</label>
                <input type="text" class="form-control" name="postal_code" placeholder="Enter your address postal code here" value="{{ $user->postal_code }}">
            </div>
    
            <button type="submit" class="btn btn-dark btn-submit">Save</button>
            <a href="/" class="btn btn-outline-dark btn-outline-submit">Cancel</a>
        </form>
    </div>
@endsection