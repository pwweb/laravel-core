<div class="card-body">
    <div class="card-text">

        <div class="row">
            @foreach($permissions as $perm)
            <?php
                    $per_found = null;

                    if (isset($role)) {
                        $per_found = $role->hasPermissionTo($perm->name);
                    }

                    if (isset($user)) {
                        $per_found = $user->hasDirectPermission($perm->name);
                    }
                ?>

            <div class="col-md-1">
                <label class="c-switch c-switch-3d c-switch-success c-switch-sm">
                    {!! Form::checkbox("permissions[]", $perm->name, $per_found, isset($options) ? $options : ['class' => 'c-switch-input']) !!}
                    <span class="c-switch-slider"></span>
                </label>
            </div>
            <div class="col-md-2">
                <span class="{{ str_contains($perm->name, 'delete') ? 'text-danger' : '' }}">
                    {{ $perm->name }}
                </span>
            </div>
            @endforeach
        </div>
    </div>
</div>
<footer class="card-footer">
    <div class="row">
        <div class="col-sm-1">
            <label class="c-switch c-switch-3d c-switch-success c-switch-sm">
                {!! Form::checkbox("select[]", '*', false, isset($options) ? array_merge($options, ['onChange' => 'select(this.value);']) : ['class' => 'c-switch-input']) !!}
                <span class="c-switch-slider"></span>
            </label>
        </div>
        <div class="col-sm-1">all</div>

        @foreach($abilities as $ability)
        <div class="col-sm-1">
            <label class="c-switch c-switch-3d c-switch-success c-switch-sm">
                {!! Form::checkbox("select[]", $ability.'_', false, isset($options) ? $options : ['class' => 'c-switch-input']) !!}
                <span class="c-switch-slider"></span>
            </label>
        </div>
        <div class="col-sm-1">{{$ability}}_*</div>
        @endforeach
    </div>
</footer>
@can('edit_roles')
<div class="card-footer text-right">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
</div>
@endcan
