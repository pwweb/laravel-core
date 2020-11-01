@extends('layouts.app')

@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{!! route('core.tax.locations.index') !!}">{{__('pwweb::core.tax.locations.singular')}}</a>
    </li>
    <li class="breadcrumb-item active">{{__('pwweb::core.edit')}}</li>
</ol>
<div class="container-fluid">
    <div class="animated fadeIn">
        @include('coreui-templates::common.errors')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-edit fa-lg"></i>
                        <strong>{{__('pwweb::core.tax.locations.edit_location')}}</strong>
                    </div>
                    <div class="card-body">
                        {!! Form::model($location, ['route' => ['core.tax.locations.update', $location->id], 'method' => 'patch']) !!}

                        @include('core::tax.locations.fields')

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
