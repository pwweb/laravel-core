<!-- System Menu Environments Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('environment_id', __('pwweb::core.Environments').':') !!}
    {!! Form::select('environment_id', $environments->pluck('name', 'id'), null, ['class' => 'custom-select', 'placeholder' => 'Please select...']) !!}
</div>

<!-- Parent Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('parent_id', __('pwweb::core.Parent ID').':') !!}
    {!! Form::select('parent_id', $nodes->pluck('name', 'id'), null, ['class' => 'custom-select', 'placeholder' => 'Please select...']) !!}
</div>

<!-- Level Field -->
<div class="form-group col-sm-6">
    {!! Form::label('level', __('pwweb::core.Level').':') !!}
    {!! Form::number('level', null, ['class' => 'form-control']) !!}
</div>

<!-- Identifier Field -->
<div class="form-group col-sm-6">
    {!! Form::label('identifier', __('pwweb::core.Identifier').':') !!}
    {!! Form::text('identifier', null, ['class' => 'form-control']) !!}
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

<!-- Class Field -->
<div class="form-group col-sm-6">
    {!! Form::label('class', __('pwweb::core.Class').':') !!}
    {!! Form::text('class', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('pwweb::core.Save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('core.menu.items.index') }}" class="btn btn-secondary">{{__('pwweb::core.Cancel')}}</a>
</div>
