<!-- Country Id Field -->
<div class="form-group">
    {!! Form::label('country_id', __('pwweb::core.Country')) !!}
    <p>{{ $location->country->name }}</p>
</div>

<!-- Tax Code Id Field -->
<div class="form-group">
    {!! Form::label('tax_code_id', __('pwweb::core.tax.rates.singular')) !!}
    <p>{{ $location->rate->name }}</p>
</div>

<!-- State Field -->
<div class="form-group">
    {!! Form::label('state', __('pwweb::core.State')) !!}
    <p>{{ $location->state }}</p>
</div>

<!-- City Field -->
<div class="form-group">
    {!! Form::label('city', __('pwweb::core.City')) !!}
    <p>{{ $location->city }}</p>
</div>

<!-- Zip Field -->
<div class="form-group">
    {!! Form::label('zip', __('pwweb::core.Postcode')) !!}
    <p>{{ $location->zip }}</p>
</div>

<!-- Order Field -->
<div class="form-group">
    {!! Form::label('order', __('pwweb::core.tax.locations.order')) !!}
    <p>{{ $location->order }}</p>
</div>
