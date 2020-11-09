@extends('layouts.app')

@section('content')
<main id="content" role="main">
    <!-- Breadcrumb Section -->
    <div class="bg-primary">
        <div class="container pad-1">
            <div class="d-sm-flex justify-content-sm-between align-items-sm-center">
                <div class="mb-3 mb-sm-0">
                    <!-- Breadcrumb -->
                    <ol class="breadcrumb breadcrumb-white breadcrumb-no-gutter mb-0">
                        <li class="breadcrumb-item"><a class="breadcrumb-link" href="{{ route('home') }}">{{ __('pwweb::core.Home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('pwweb::core.Profile') }}</li>
                    </ol>
                    <!-- End Breadcrumb -->
                </div>
                <!-- Edit Profile -->
                <a class="btn btn-sm btn-soft-white transition-3d-hover" href="{{ route('system.profile.befriend', $profile->username) }}">
                    <span class="fas fa-user-plus small mr-2"></span>
                    {{ __('pwweb::core.Send friend request') }}
                </a>
                <!-- End Edit Profile -->
            </div>
        </div>
    </div>
    <!-- End Breadcrumb Section -->

    <!-- Content Section -->
    <div class="bg-light">
        <div class="container pad-1">
            <div class="row">
                <div class="col">
                    @include('flash::message')
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 mb-7 mb-lg-0">
                    <!-- Profile Card -->
                    <div class="card p-1 mb-4">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <img class="avatar-lg rounded-circle" src="{{ $profile->person->avatar }}" alt="{{ $profile->person->display_name }}" />
                            </div>
                            <div class="mb-3">
                                <h1 class="h6 font-weight-medium mb-0">{{ $profile->person->title }} {{ $profile->person->display_name }}</h1>
                                <small class="d-block text-muted">{{ $profile->person->description}}</small>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header pt-4 pb-3 px-0 mx-4">
                            <h2 class="h6 mb-0">{{__('pwweb::core.Contacts')}}</h2>
                        </div>
                        <div class="card-body pt-3 pb-4 px-4">
                            @foreach($profile->getFriends() as $friend)
                                <!-- User -->
                                <a class="d-flex align-items-start mb-4" href="#">
                                    <div class="position-relative u-avatar">
                                        <img class="img-fluid rounded-circle" src="{{ $friend->person->avatar }}" alt="{{ $friend->person->display_name }}">
                                        <span class="badge badge-xs badge-outline-success badge-pos badge-pos--bottom-right rounded-circle"></span>
                                    </div>

                                    <div class="ml-3">
                                        <span class="d-block text-dark">{{ $friend->person->display_name }}</span>
                                        {{-- <small class="d-block text-secondary">Web Developer</small> --}}
                                    </div>
                                </a>
                                <!-- End User -->
                                @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="mb-4">
                        <h2 class="h4">Hey, I am {{ $profile->person->display_name }} <span class="badge badge-secondary ml-1">Pro</span></h2>
                        <h4 class="h6 text-secondary mb-0">
                            @isnotnull($profile->person->home)
                                {{ $profile->person->home->city }}, {{ $profile->person->home->country->iso }} <small>&dash;
                                    @else
                                    <small>
                                        @endisnotnull
                                        {{__('pwweb::core.Joined In')}} {{ $profile->joined->format('M Y') }}</small>
                        </h4>
                    </div>
                    @if($profile->hasVerifiedEmail() === false)
                        <div class="alert alert-danger">You have not verified your email. If you have not received an email, click <a href="{{ route('system.profile.reverify') }}">here</a> to resend it.</div>
                        @endif
                        <div class="mb-4">
                            <p>{{__('pwweb::core.Description')}}</p>
                        </div>
                        <hr class="my-7">
                        <div class="row">
                            <div class="col-md-6 col-lg-4">
                                <ul class="list-group list-group-transparent list-group-flush list-group-borderless mb-0">
                                    <li class="list-group-item pt-0 pb-4">
                                        <div class="media">
                                            <span class="fas fa-map-marker-alt list-group-icon mr-3"></span>
                                            <div class="media-body text-lh-sm">
                                                <span class="d-block mb-1">{{__('pwweb::core.Location')}}:</span>
                                                @isnotnull($profile->person->home)
                                                    <a href="#">{{ $profile->person->home->city }}, {{ $profile->person->home->country->name }}</a>
                                                    @else
                                                    &dash;
                                                    @endisnotnull
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <ul class="list-group list-group-transparent list-group-flush list-group-borderless mb-0">
                                    <li class="list-group-item pt-0 pb-4">
                                        <div class="media">
                                            <span class="fas fa-birthday-cake list-group-icon mr-3"></span>
                                            <div class="media-body text-lh-sm">
                                                <span class="d-block mb-1">{{__('pwweb::core.Birthday')}}:</span>
                                                <span class="d-block text-muted">
                                                    @date($profile->person->dob, 'd. M Y')
                                                </span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <ul class="list-group list-group-transparent list-group-flush list-group-borderless mb-0">
                                </ul>
                            </div>
                        </div>
                        <hr class="my-7">
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
