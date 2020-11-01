<!-- Country Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('country_id', __('pwweb::core.Country')) !!}
    {!! Form::select('country_id', $countries->pluck('name', 'id'), null, ['class' => 'custom-select']) !!}
</div>

<!-- Tax Code Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tax_rate_id', __('pwweb::core.tax.rates.singular')) !!}
    {!! Form::select('tax_rate_id', $rates->pluck('name', 'id'), null, ['class' => 'custom-select']) !!}
</div>

<!-- State Field -->
<div class="form-group col-sm-6">
    {!! Form::label('state', __('pwweb::core.State')) !!}
    {!! Form::text('state', null, ['class' => 'form-control']) !!}
</div>

<!-- City Field -->
<div class="form-group col-sm-6">
    {!! Form::label('city', __('pwweb::core.City')) !!}
    {!! Form::text('city', null, ['class' => 'form-control']) !!}
</div>

<!-- Zip Field -->
<div class="form-group col-sm-6">
    {!! Form::label('zip', __('pwweb::core.Postcode')) !!}
    {!! Form::text('zip', null, ['class' => 'form-control']) !!}
</div>

<!-- Order Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order', __('pwweb::core.tax.locations.order')) !!}
    {!! Form::number('order', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('pwweb::core.tax.locations.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('core.tax.locations.index') }}" class="btn btn-secondary">{{__('pwweb::core.tax.locations.cancel')}}</a>
</div>
