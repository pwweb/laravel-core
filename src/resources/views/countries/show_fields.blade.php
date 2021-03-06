<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', Lang::get('pwweb::core.Name')) !!}
    <p>{{ $country->name }}</p>
</div>

<!-- Iso Field -->
<div class="form-group">
    {!! Form::label('iso', Lang::get('pwweb::core.Iso code')) !!}
    <p>{{ $country->iso }}</p>
</div>

<!-- Ioc Field -->
<div class="form-group">
    {!! Form::label('ioc', Lang::get('pwweb::core.Ioc code')) !!}
    <p>{{ $country->ioc }}</p>
</div>

<!-- Active Field -->
<div class="form-group">
    {!! Form::label('active', Lang::get('pwweb::core.Active')) !!}
    <p>{{ $country->active }}</p>
</div>
