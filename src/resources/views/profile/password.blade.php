@extends('layouts.app')

@section('content')
    @include('system.profile.header')
    <div class="bg-light">
        <div class="container pad-1">
            @include('flash::message')
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post" action="{{ route('system.profile.password.update') }}" class="js-validate pad-1" novalidate="novalidate">
                @csrf
                @method('patch')
                <div class="js-form-message mb-6">
                    <label id="currentLabel" class="form-label">
                        {{ __('Current Password') }}
                    </label>
                    <div class="form-group">
                        <input type="password" class="form-control @error('current') is-invalid @enderror" name="current" value="" placeholder="{{ __('Enter your current password') }}" aria-label="{{ __('Current password') }}" required="" aria-describedby="currentLabel" data-msg="Please enter your current password." data-error-class="u-has-error" data-success-class="u-has-success">
                        @error('current')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="js-form-message mb-6">
                    <label id="newLabel" class="form-label">
                        {{ __('New Password') }}
                    </label>
                    <div class="form-group">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="" placeholder="{{ __('Enter your new password') }}" aria-label="{{ __('New password') }}" required="" aria-describedby="newLabel" data-msg="Please enter your new password." data-error-class="u-has-error" data-success-class="u-has-success">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="js-form-message mb-6">
                    <label id="confirmLabel" class="form-label">
                        {{ __('Confirm Password') }}
                    </label>
                    <div class="form-group">
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" value="" placeholder="{{ __('Confirm your new password') }}" aria-label="{{ __('Confirm password') }}" required="" aria-describedby="confirmLabel" data-msg="Please confirm your new password." data-error-class="u-has-error" data-success-class="u-has-success">
                        @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="w-lg-50">
                    <button type="submit" class="btn btn-sm btn-primary transition-3d-hover mr-1">Save Password</button>
                    <button type="submit" class="btn btn-sm btn-soft-secondary transition-3d-hover">Cancel</button>
                </div>
            </form>
        </div>
    </div>
@endsection
