@extends('layouts.app')

@section('content')
     <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('core.countries.index') }}">@lang("pwweb::core.Countries")</a>
            </li>
            <li class="breadcrumb-item active">@lang("pwweb::core.detail")</li>
     </ol>
     <div class="container-fluid">
          <div class="animated fadeIn">
                 @include('coreui-templates::common.errors')
                 <div class="row">
                     <div class="col-lg-12">
                         <div class="card">
                             <div class="card-header">
                                 <strong>@lang("pwweb::core.details")</strong>
                                  <a href="{{ route('core.countries.index') }}" class="btn btn-light">@lang("pwweb::core.back")</a>
                             </div>
                             <div class="card-body">
                                 @include('core::countries.show_fields')
                             </div>
                         </div>
                     </div>
                 </div>
          </div>
    </div>
@endsection
