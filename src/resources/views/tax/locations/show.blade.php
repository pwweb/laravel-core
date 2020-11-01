@extends('layouts.app')

@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('core.tax.locations.index') }}">{{__('pwweb::core.tax.locations.singular')}}</a>
    </li>
    <li class="breadcrumb-item active">{{__('pwweb::core.detail')}}</li>
</ol>
<div class="container-fluid">
    <div class="animated fadeIn">
        @include('coreui-templates::common.errors')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>{{ __('pwweb::core.details') }}</strong>
                        <a href="{{ route('core.tax.locations.index') }}" class="btn btn-light">{{__('pwweb::core.back')}}</a>
                    </div>
                    <div class="card-body">
                        @include('core::tax.locations.show_fields')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
