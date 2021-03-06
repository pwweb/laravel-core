@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
          <li class="breadcrumb-item">
             <a href="{!! route('core.currencies.index') !!}">@lang("pwweb::core.Currencies")</a>
          </li>
          <li class="breadcrumb-item active">@lang("pwweb::core.edit")</li>
        </ol>
    <div class="container-fluid">
         <div class="animated fadeIn">
             @include('coreui-templates::common.errors')
             <div class="row">
                 <div class="col-lg-12">
                      <div class="card">
                          <div class="card-header">
                              <i class="fa fa-edit fa-lg"></i>
                              <strong>@lang("pwweb::core.Edit currency")</strong>
                          </div>
                          <div class="card-body">
                              {!! Form::model($currency, ['route' => ['core.currencies.update', $currency->id], 'method' => 'patch']) !!}

                              @include('core::currencies.fields')

                              {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
         </div>
    </div>
@endsection
