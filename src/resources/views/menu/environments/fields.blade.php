<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', Lang::get('pwweb::core.Name')) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(Lang::get('pwweb::core.Save environment'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('core.menu.environments.index') }}" class="btn btn-secondary">@lang("pwweb::core.cancel")</a>
</div>
