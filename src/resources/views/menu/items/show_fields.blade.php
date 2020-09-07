<!-- System Menu Environments Id Field -->
<div class="form-group">
    {!! Form::label('environment_id', 'System Menu Environments Id:') !!}
    <p>{{ $item->environment_id }}</p>
</div>

<!--  Lft Field -->
<div class="form-group">
    {!! Form::label('_lft', ' Lft:') !!}
    <p>{{ $item->_lft }}</p>
</div>

<!--  Rgt Field -->
<div class="form-group">
    {!! Form::label('_rgt', ' Rgt:') !!}
    <p>{{ $item->_rgt }}</p>
</div>

<!-- Parent Id Field -->
<div class="form-group">
    {!! Form::label('parent_id', 'Parent Id:') !!}
    <p>{{ $item->parent_id }}</p>
</div>

<!-- Level Field -->
<div class="form-group">
    {!! Form::label('level', 'Level:') !!}
    <p>{{ $item->level }}</p>
</div>

<!-- Identifier Field -->
<div class="form-group">
    {!! Form::label('identifier', 'Identifier:') !!}
    <p>{{ $item->identifier }}</p>
</div>

<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $item->title }}</p>
</div>

<!-- Separator Field -->
<div class="form-group">
    {!! Form::label('separator', 'Separator:') !!}
    <p>{{ $item->separator }}</p>
</div>

<!-- Class Field -->
<div class="form-group">
    {!! Form::label('class', 'Class:') !!}
    <p>{{ $item->class }}</p>
</div>
