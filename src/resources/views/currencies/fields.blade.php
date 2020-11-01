<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', Lang::get('pwweb::core.Name')) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Iso Field -->
<div class="form-group col-sm-6">
    {!! Form::label('iso', Lang::get('pwweb::core.Iso code')) !!}
    {!! Form::text('iso', null, ['class' => 'form-control']) !!}
</div>

<!-- Numeric Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('numeric_code', Lang::get('pwweb::core.Numeric code')) !!}
    {!! Form::number('numeric_code', null, ['class' => 'form-control']) !!}
</div>

<!-- Entity Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('entity_code', Lang::get('pwweb::core.Entity code')) !!}
    {!! Form::text('entity_code', null, ['class' => 'form-control']) !!}
</div>

<!-- Active Field -->
<div class="form-group col-sm-6">
    {!! Form::label('active', Lang::get('pwweb::core.Active')) !!}
    <label class="checkbox-inline">
        {!! Form::hidden('active', 0) !!}
        {!! Form::checkbox('active', '1', null) !!}
    </label>
</div>


<!-- Standard Field -->
<div class="form-group col-sm-6">
    {!! Form::label('standard', Lang::get('pwweb::core.Standard')) !!}
    <label class="checkbox-inline">
        {!! Form::hidden('standard', 0) !!}
        {!! Form::checkbox('standard', '1', null) !!}
    </label>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(Lang::get('pwweb::core.Save currency'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('core.currencies.index') }}" class="btn btn-secondary">@lang("pwweb::core.cancel")</a>
</div>
