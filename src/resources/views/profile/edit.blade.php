@extends('layouts.app')

@section('content')
@include('core::profile.header')
<div class="bg-light">
    <div class="container pad-1">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <!-- Update Avatar Form -->
        <form method="post" action="{{ route('system.profile.update.avatar') }}" enctype="multipart/form-data" class="media align-items-center mb-7" novalidate="novalidate">
            @csrf
            @method('patch')
            <div class="avatar-lg mr-3">
                <img class="img-fluid rounded-circle" src="{{ $profile->person->avatar }}" alt="{{ $profile->person->display_name }}" />
            </div>
            <div class="media-body">
                <label class="btn btn-sm btn-primary transition-3d-hover file-attachment-btn mb-1 mb-sm-0 mr-1" for="fileAttachmentBtn">
                    {{ __('pwweb::core.Upload New Picture') }}
                    <input id="fileAttachmentBtn" name="avatar" type="file" class="file-attachment-btn__label">
                </label>
                <button type="submit" class="btn btn-sm btn-soft-secondary transition-3d-hover mb-1 mb-sm-0">{{ __('pwweb::core.Delete') }}</button>
            </div>
        </form>
        <form method="post" action="{{ route('system.profile.update') }}" class="js-validate pad-1" novalidate="novalidate">
            @csrf
            @method('patch')
            <div class="row">
                <!-- Input -->
                <div class="col-sm-6 mb-6">
                    <div class="js-form-message">
                        <label id="titleLabel" class="form-label">
                            {{ __('pwweb::core.Title') }}
                        </label>
                        <div class="form-group">
                            <select name="title" class="custom-select" aria-label="" required="" aria-describedby="titleLabel" data-msg="Please choose your title." data-error-class="u-has-error" data-success-class="u-has-success">
                                <option value="0">{{ __('pwweb::core.Please select') }}</option>
                                @foreach ($titles as $title)
                                <option value="{{ $title->getIndex() }}" {{ (int)(old('title') ? old('title') : $profile->person->title->getIndex()) === $title->getIndex() ? ' selected="selected"' : '' }}>
                                    {{ $title->getValue() }}</option>
                                @endforeach
                            </select>
                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Input -->
                <div class="col-sm-6 mb-6">
                    <div class="js-form-message">
                        <label id="nameLabel" class="form-label">
                            {{ __('pwweb::core.Name') }}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="form-group">
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="name" value="{{ old('name') ? old('name') : $profile->person->name }}"
                            placeholder="{{ __('pwweb::core.Enter your name') }}"
                            aria-label="{{ __('pwweb::core.Enter your name') }}" required="" aria-describedby="nameLabel" data-msg="Please enter your name." data-error-class="u-has-error" data-success-class="u-has-success">
                            <small class="form-text text-muted">{{ __('pwweb::core.Displayed on your public profile, notifications and other places') }}.</small>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- End Input -->
                <!-- Input -->
                <div class="col-sm-6 mb-6">
                    <div class="js-form-message">
                        <label id="usernameLabel" class="form-label">
                            {{ __('pwweb::core.Surname') }}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="surname" value="{{ old('surname') ? old('surname') : $profile->person->surname }}" placeholder="{{__('pwweb::core.Enter your surname')}}" aria-label="Enter your surname"
                                required="" aria-describedby="usernameLabel" data-msg="Please enter your surname." data-error-class="u-has-error" data-success-class="u-has-success">
                            @error('surname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- End Input -->
            </div>
            <div class="row">
                <div class="col-sm-6 mb-6">
                    <div class="js-form-message">
                        <label id="middleNameLabel" class="form-label">
                            {{ __('pwweb::core.Middle name') }}
                        </label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="middle_name" value="{{ old('middle_name') ? old('middle_name') : $profile->person->middle_name }}" placeholder="" aria-label="" required="" aria-describedby="middleNameLabel"
                                data-msg="Please enter your middle name." data-error-class="u-has-error" data-success-class="u-has-success">
                            @error('middle_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 mb-6">
                    <div class="js-form-message">
                        <label id="maidenNameLabel" class="form-label">
                            {{ __('pwweb::core.Maiden name') }}
                        </label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="maiden_name" value="{{ old('maiden_name') ? old('maiden_name') : $profile->person->maiden_name }}" placeholder="" aria-label="" required="" aria-describedby="maidenNameLabel"
                                data-msg="Please enter your maiden name." data-error-class="u-has-error" data-success-class="u-has-success">
                            @error('maiden_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 mb-6">
                    <div class="js-form-message">
                        <label id="dobLabel" class="form-label">
                            {{ __('pwweb::core.Dob') }}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="form-group">
                            <input type="date" class="form-control" name="dob" value="{{ old('dob') ? old('dob') : ($profile->person->dob === null ? '' : $profile->person->dob->format('Y-m-d')) }}" placeholder="" aria-label="" required=""
                                aria-describedby="dobLabel" data-msg="Please enter your date of birth." data-error-class="u-has-error" data-success-class="u-has-success">
                            @error('dob')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 mb-6">
                    <div class="js-form-message">
                        <label id="genderLabel" class="form-label">
                            {{ __('pwweb::core.Gender') }}
                        </label>
                        <div class="form-group">
                            <select name="gender" class="custom-select" aria-label="" required="" aria-describedby="genderLabel" data-msg="Please choose your gender." data-error-class="u-has-error" data-success-class="u-has-success">
                                <option value="0">{{ __('pwweb::core.Please select') }}</option>
                                @foreach ($genders as $gender)
                                <option value="{{ $gender->getIndex() }}" {{ (int)(old('gender') ? old('gender') : $profile->person->gender->getIndex()) === $gender->getIndex() ? ' selected="selected"' : '' }}>
                                    {{ $gender->getValue() }}</option>
                                @endforeach
                            </select>
                            @error('gender')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <!-- Buttons -->
            <button type="submit" class="btn btn-sm btn-primary transition-3d-hover mr-1">{{ __('pwweb::core.Save Changes') }}</button>
            <button type="submit" class="btn btn-sm btn-soft-secondary transition-3d-hover">{{ __('pwweb::core.Cancel') }}</button>
            <!-- End Buttons -->
        </form>
        <!-- End Personal Info Form -->
        <hr class="my-7" />
        <div class="mb-3">
            <h2 class="h5 mb-0">{{ __('pwweb::core.Addresses') }}</h2>
            <p>{{ __('pwweb::core.Add your addresses.') }}</p>
            <a href="{{ route('system.profile.address.create') }}" class="btn btn-sm btn-primary transition-3d-hover mr-1">
                <span class="fas fa-plus"></span>
                {{ __('pwweb::core.Add address') }}
            </a>
        </div>
        @foreach ($profile->person->addresses as $address)
        <div class="card mb-5">
            <div class="card-body p-4">
                <div class="media d-block d-sm-flex">
                    <div class="u-avatar mb-3 mb-sm-0 mr-4">
                        <span class="fas fa-{{ $address->type->name }}"></span>
                    </div>
                    <div class="media-body">
                        <div class="media mb-2">
                            <div class="media-body">
                                <h1 class="h5 mb-1">
                                    <a href="{{ route('system.profile.address.show', $address->id) }}">{{ $address->street }}</a>
                                </h1>
                                <span class="text-muted">{{ $address->city }}, {{ $address->state }}, {{ $address->country->name }}</span>
                            </div>
                            <div class="d-flex ml-auto">
                                <div class="checkbox-bookmark d-inline-block" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ __('pwweb::core.Uake favourite') }}">
                                    <input type="checkbox" class="checkbox-bookmark-input" id="bookmark-{{ $address->id}}" @if($address->primary == 1) checked="checked" @endif>
                                        <label class="checkbox-bookmark-label" for="bookmark-{{ $address->id}}"></label>
                                </div>
                            </div>
                        </div>
                        <div class="d-md-flex align-items-md-center">
                            <!-- Location -->
                            <div class="u-ver-divider u-ver-divider--none-md pr-4 mb-3 mb-md-0 mr-4">
                                <small class="fas fa-edit text-secondary align-middle mr-1"></small>
                                <span class="align-middle"><a href="{{ route('core.addresses.update', [$address->id]) }}">{{ __('pwweb::core.Edit address') }}</a></span>
                            </div>
                            <!-- End Location -->

                            <!-- Posted -->
                            <div class="u-ver-divider u-ver-divider--none-md pr-4 mb-3 mb-md-0 mr-4">
                                <small class="fas fa-trash text-secondary align-middle mr-1"></small>
                                <span class="align-middle"><a href="{{ route('core.addresses.destroy', [$address->id]) }}">{{ __('pwweb::core.Delete address') }}</a></span>
                            </div>
                            <!-- End Posted -->

                            <div class="ml-md-auto">
                                <span class="btn btn-xs btn-soft-danger btn-pill">{{ $address->type->name }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
