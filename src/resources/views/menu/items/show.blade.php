@extends('layouts.app')

@section('content')
     <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('system.menu.items.index') }}">@lang("pwweb::core.Menu items")</a>
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
                                  <a href="{{ route('system.menu.items.index') }}" class="btn btn-light">@lang("pwweb::core.back")</a>
                             </div>
                             <div class="card-body">
                                 @include('system.menu.items.show_fields')
                             </div>
                         </div>
                     </div>
                 </div>
          </div>
    </div>
@endsection
