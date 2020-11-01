<!-- Country Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('country_id', Lang::get('pwweb::core.Country')) !!}
    {!! Form::select('country_id', $countries->pluck('name', 'id'), null, ['class' => 'custom-select']) !!}
</div>

<!-- Type Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type_id', Lang::get('pwweb::core.Type')) !!}
    {!! Form::select('type_id', $types->pluck('name', 'id'), null, ['class' => 'custom-select']) !!}
</div>

<!-- Street Field -->
<div class="form-group col-sm-6">
    {!! Form::label('street', Lang::get('pwweb::core.Street')) !!}
    {!! Form::text('street', null, ['class' => 'form-control']) !!}
</div>

<!-- Street2 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('street2', Lang::get('pwweb::core.Street 2')) !!}
    {!! Form::text('street2', null, ['class' => 'form-control']) !!}
</div>

<!-- City Field -->
<div class="form-group col-sm-6">
    {!! Form::label('city', Lang::get('pwweb::core.City')) !!}
    {!! Form::text('city', null, ['class' => 'form-control']) !!}
</div>

<!-- State Field -->
<div class="form-group col-sm-6">
    {!! Form::label('state', Lang::get('pwweb::core.State')) !!}
    {!! Form::text('state', null, ['class' => 'form-control']) !!}
</div>

<!-- Postcode Field -->
<div class="form-group col-sm-6">
    {!! Form::label('postcode', Lang::get('pwweb::core.Postcode')) !!}
    {!! Form::text('postcode', null, ['class' => 'form-control']) !!}
</div>

<!-- Lat Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lat', Lang::get('pwweb::core.Latitude')) !!}
    {!! Form::number('lat', null, ['class' => 'form-control', 'step' => 'any']) !!}
</div>

<!-- Lng Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lng', Lang::get('pwweb::core.Longitude')) !!}
    {!! Form::number('lng', null, ['class' => 'form-control', 'step' => 'any']) !!}
</div>

<!-- Primary Field -->
<div class="form-group col-sm-6">
    {!! Form::label('primary', Lang::get('pwweb::core.Primary')) !!}
    <label class="checkbox-inline">
        {!! Form::hidden('primary', 0) !!}
        {!! Form::checkbox('primary', '1', null) !!}
    </label>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(Lang::get('pwweb::core.Save address'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('core.addresses.index') }}" class="btn btn-secondary">@lang("pwweb::core.cancel")</a>
</div>
