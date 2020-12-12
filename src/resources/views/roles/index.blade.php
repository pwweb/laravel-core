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
                        <a class="float-right" href="{{ route('core.roles.create') }}"><i class="fa fa-plus-square fa-lg"></i></a>
                    </div>
                    <div class="card-body">
                        @forelse ($roles as $role)
                        <div class="card card-accent-primary">
                            <header class="card-header">
                                <span class="h4">
                                    {{ $role->name .' Permissions' }} {!! isset($user) ? '<span class="text-danger">(' . $user->getDirectPermissions()->count() . ')</span>' : '' !!}
                                </span>
                                @can('delete_roles')
                                {!! Form::open(['route' => ['core.roles.destroy', $role->id], 'method' => 'delete']) !!}
                                <div class='btn-group card-header-actions'>
                                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                </div>
                                {!! Form::close() !!}
                                @endcan
                            </header>

                            {!! Form::model($role, ['method' => 'PUT', 'route' => ['core.roles.update', $role->id ], 'class' => 'm-b']) !!}

                            @if($role->name === 'Admin')
                                @include('core::roles.permissions', [
                                'title' => $role->name .' Permissions',
                                'options' => ['disabled', 'class' => 'c-switch-input'] ])
                                @else
                                @include('core::roles.permissions', [
                                'title' => $role->name .' Permissions',
                                'model' => $role ])
                                @endif

                                {!! Form::close() !!}

                        </div>
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
