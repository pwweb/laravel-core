@extends('layouts.app')

@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{!! route('core.tax.rates.index') !!}">{{__('pwweb::core.tax.rates.singular')}}</a>
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
                        <strong>{{__('pwweb::core.tax.rates.edit_rate')}}</strong>
                    </div>
                    <div class="card-body">
                        {!! Form::model($rate, ['route' => ['core.tax.rates.update', $rate->id], 'method' => 'patch']) !!}

                        @include('core::tax.rates.fields')

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
