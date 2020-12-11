@extends('layouts.app')

@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        @lang("pwweb::core.Roles")
    </li>
</ol>
<div class="container-fluid">
    <div class="animated fadeIn">
        @include('flash::message')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>
                        @lang("pwweb::core.Roles")
                        <a class="pull-right" href="{{ route('core.roles.create') }}"><i class="fa fa-plus-square fa-lg"></i></a>
                    </div>
                    <div class="card-body">
                        @forelse ($roles as $role)
                        {!! Form::model($role, ['method' => 'PUT', 'route' => ['core.roles.update', $role->id ], 'class' => 'm-b']) !!}

                        @if($role->name === 'Admin')
                            @include('core::roles.permissions', [
                            'title' => $role->name .' Permissions',
                            'options' => ['disabled'] ])
                            @else
                            @include('core::roles.permissions', [
                            'title' => $role->name .' Permissions',
                            'model' => $role ])
                            @can('edit_roles')
                            <div class="card-footer text-right">
                                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                            </div>
                            @endcan
                            @endif
                    </div>

                    {!! Form::close() !!}

                    @empty
                    <p>No Roles defined, please run <code>php artisan db:seed</code> to seed some dummy data.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
