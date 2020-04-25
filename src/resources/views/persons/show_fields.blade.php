<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', Lang::get('pwweb::core.Name')) !!}
    <p>{{ $person->name }}</p>
</div>

<!-- Surname Field -->
<div class="form-group">
    {!! Form::label('surname', Lang::get('pwweb::core.Surname')) !!}
    <p>{{ $person->surname }}</p>
</div>
