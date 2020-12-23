@extends('layouts.app')

@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{!! route('core.tax.locations.index') !!}">{{__('pwweb::core.tax.locations.singular')}}</a>
    </li>
    <li class="breadcrumb-item active">{{__('pwweb::core.create')}}</li>
</ol>
<div class="container-fluid">
    <div class="animated fadeIn">
        @include('coreui-templates::common.errors')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-plus-square-o fa-lg"></i>
                        <strong>{{__('pwweb::core.tax.locations.create_location')}}</strong>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'core.tax.locations.store']) !!}

                        @include('core::tax.locations.fields')

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
