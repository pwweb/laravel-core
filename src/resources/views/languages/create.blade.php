@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
         <a href="{!! route('core.languages.index') !!}">@lang("pwweb::core.Languages")</a>
      </li>
      <li class="breadcrumb-item active">@lang("pwweb::core.create")</li>
    </ol>
     <div class="container-fluid">
          <div class="animated fadeIn">
                @include('coreui-templates::common.errors')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-plus-square-o fa-lg"></i>
                                <strong>@lang("pwweb::core.Create language")</strong>
                            </div>
                            <div class="card-body">
                                {!! Form::open(['route' => 'localisation.languages.store']) !!}

                                   @include('core::languages.fields')

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
           </div>
    </div>
@endsection
