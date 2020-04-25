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

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(Lang::get('pwweb::core.Save user'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('core.users.index') }}" class="btn btn-secondary">@lang("pwweb::core.cancel")</a>
</div>
