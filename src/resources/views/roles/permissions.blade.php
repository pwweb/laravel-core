<div class="card card-accent-primary">
    <h4 class="card-header">
        {{ $title ?? 'Override Permissions' }} {!! isset($user) ? '<span class="text-danger">(' . $user->getDirectPermissions()->count() . ')</span>' : '' !!}
        @can('delete_roles')
        {!! Form::open(['route' => ['core.roles.destroy', $role->id], 'method' => 'delete']) !!}
        <div class='btn-group'>
            {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
        </div>
        {!! Form::close() !!}
        @endcan
    </h4>
    <div class="card-body">
        <div class="card-text">
            <div class="row">
                @foreach($permissions as $perm)
                <?php
                    $per_found = null;

                    if( isset($role) ) {
                        $per_found = $role->hasPermissionTo($perm->name);
                    }

                    if( isset($user)) {
                        $per_found = $user->hasDirectPermission($perm->name);
                    }
                ?>

                <div class="col-md-3">
                    <div class="checkbox">
                        <label class="{{ str_contains($perm->name, 'delete') ? 'text-danger' : '' }}">
                            {!! Form::checkbox("permissions[]", $perm->name, $per_found, isset($options) ? $options : []) !!} {{ $perm->name }}
                        </label>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
