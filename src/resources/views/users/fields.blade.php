<!-- Email Name -->
<div class="form-group col-sm-6">
    {!! Form::label('name', Lang::get('pwweb::core.Name')) !!}
    {!! Form::text('person[name]', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Surname -->
<div class="form-group col-sm-6">
    {!! Form::label('surname', Lang::get('pwweb::core.Surname')) !!}
    {!! Form::text('person[surname]', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', Lang::get('pwweb::core.Email')) !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', Lang::get('pwweb::core.Password')) !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>

<!-- Role Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('role_id', Lang::get('pwweb::core.Role')) !!}
    {!! Form::select('role_id', $roles, $user->roles()->first()->id, ['class' => 'custom-select']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(Lang::get('pwweb::core.Save user'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('core.users.index') }}" class="btn btn-secondary">
        @lang("pwweb::core.cancel")
    </a>
</div>
