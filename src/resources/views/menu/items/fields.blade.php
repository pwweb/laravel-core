<!-- System Menu Environments Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('system_menu_environments_id', 'System Menu Environments Id:') !!}
    {!! Form::number('system_menu_environments_id', null, ['class' => 'form-control']) !!}
</div>

<!--  Lft Field -->
<div class="form-group col-sm-6">
    {!! Form::label('_lft', ' Lft:') !!}
    {!! Form::number('_lft', null, ['class' => 'form-control']) !!}
</div>

<!--  Rgt Field -->
<div class="form-group col-sm-6">
    {!! Form::label('_rgt', ' Rgt:') !!}
    {!! Form::number('_rgt', null, ['class' => 'form-control']) !!}
</div>

<!-- Parent Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('parent_id', 'Parent Id:') !!}
    {!! Form::number('parent_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Level Field -->
<div class="form-group col-sm-6">
    {!! Form::label('level', 'Level:') !!}
    {!! Form::number('level', null, ['class' => 'form-control']) !!}
</div>

<!-- Identifier Field -->
<div class="form-group col-sm-6">
    {!! Form::label('identifier', 'Identifier:') !!}
    {!! Form::text('identifier', null, ['class' => 'form-control']) !!}
</div>

<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Separator Field -->
<div class="form-group col-sm-6">
    {!! Form::label('separator', 'Separator:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('separator', 0) !!}
        {!! Form::checkbox('separator', '1', null) !!}
    </label>
</div>


<!-- Class Field -->
<div class="form-group col-sm-6">
    {!! Form::label('class', 'Class:') !!}
    {!! Form::text('class', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('system.menu.items.index') }}" class="btn btn-secondary">Cancel</a>
</div>
