<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', Lang::get('pwweb::core.Name')) !!}
    <p>{{ $type->name }}</p>
</div>

<!-- Global Field -->
<div class="form-group">
    {!! Form::label('global', Lang::get('pwweb::core.Global')) !!}
    <p>{{ $type->global }}</p>
</div>
