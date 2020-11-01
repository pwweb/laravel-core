<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', Lang::get('pwweb::core.Name')) !!}
    <p>{{ $currency->name }}</p>
</div>

<!-- Iso Field -->
<div class="form-group">
    {!! Form::label('iso', Lang::get('pwweb::core.Iso code')) !!}
    <p>{{ $currency->iso }}</p>
</div>

<!-- Numeric Code Field -->
<div class="form-group">
    {!! Form::label('numeric_code', Lang::get('pwweb::core.Numeric code')) !!}
    <p>{{ $currency->numeric_code }}</p>
</div>

<!-- Entity Code Field -->
<div class="form-group">
    {!! Form::label('entity_code', Lang::get('pwweb::core.Entity code')) !!}
    <p>{{ $currency->entity_code }}</p>
</div>

<!-- Active Field -->
<div class="form-group">
    {!! Form::label('active', Lang::get('pwweb::core.Active')) !!}
    <p>{{ $currency->active }}</p>
</div>

<!-- Standard Field -->
<div class="form-group">
    {!! Form::label('standard', Lang::get('pwweb::core.Standard')) !!}
    <p>{{ $currency->standard }}</p>
</div>
