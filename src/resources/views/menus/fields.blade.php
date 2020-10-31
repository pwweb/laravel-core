<!-- Parent Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('parent_id', __('pwweb::core.Parent ID').':') !!}
    {!! Form::select('parent_id', $nodes->pluck('name', 'id'), null, ['class' => 'custom-select', 'placeholder' => 'Please select...']) !!}
</div>

<!-- Identifier Field -->
<div class="form-group col-sm-6">
    {!! Form::label('route', __('pwweb::core.Route').':') !!}
    {!! Form::text('route', null, ['class' => 'form-control']) !!}
</div>

<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('pwweb::core.Name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Separator Field -->
<div class="form-group col-sm-6">
    {!! Form::label('separator', __('pwweb::core.Separator').':') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('separator', 0) !!}
        {!! Form::checkbox('separator', '1', null) !!}
    </label>
</div>

<!-- Visible Field -->
<div class="form-group col-sm-6">
    {!! Form::label('visible', __('pwweb::core.Visible').':') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('visible', 0) !!}
        {!! Form::checkbox('visible', '1', true) !!}
    </label>
</div>

<!-- Class Field -->
<div class="form-group col-sm-6">
    {!! Form::label('class', __('pwweb::core.Class').':') !!}
    {!! Form::text('class', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('pwweb::core.Save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('core.menus.index') }}" class="btn btn-secondary">{{__('pwweb::core.Cancel')}}</a>
</div>
