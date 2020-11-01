<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', Lang::get('pwweb::core.Name')) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Global Field -->
<div class="form-group col-sm-6">
    {!! Form::label('global', Lang::get('pwweb::core.Global')) !!}
    <label class="checkbox-inline">
        {!! Form::hidden('global', 0) !!}
        {!! Form::checkbox('global', '1', null) !!}
    </label>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(Lang::get('pwweb::core.Save address type'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('core.address.types.index') }}" class="btn btn-secondary">@lang("pwweb::core.cancel")</a>
</div>
