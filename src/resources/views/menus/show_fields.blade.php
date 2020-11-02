<!--  Lft Field -->
<div class="form-group">
    {!! Form::label('_lft'__('pwweb::core.Lft').':') !!}
    <p>{{ $item->_lft }}</p>
</div>

<!--  Rgt Field -->
<div class="form-group">
    {!! Form::label('_rgt'__('pwweb::core.Rgt').':') !!}
    <p>{{ $item->_rgt }}</p>
</div>

<!-- Parent Id Field -->
<div class="form-group">
    {!! Form::label('parent_id', 'Parent Id:') !!}
    <p>{{ $item->parent_id }}</p>
</div>

<!-- Identifier Field -->
<div class="form-group">
    {!! Form::label('route'__('pwweb::core.Identifier').':') !!}
    <p>{{ $item->route }}</p>
</div>

<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title'__('pwweb::core.Title').':') !!}
    <p>{{ $item->title }}</p>
</div>

<!-- Separator Field -->
<div class="form-group">
    {!! Form::label('separator'__('pwweb::core.Separator').':') !!}
    <p>{{ $item->separator }}</p>
</div>

<!-- Visible Field -->
<div class="form-group">
    {!! Form::label('visible'__('pwweb::core.Visible').':') !!}
    <p>{{ $item->visible }}</p>
</div>

<!-- Class Field -->
<div class="form-group">
    {!! Form::label('class'__('pwweb::core.Class').':') !!}
    <p>{{ $item->class }}</p>
</div>
