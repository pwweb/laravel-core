<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', Lang::get('pwweb::core.Title')) !!}
    {!! Form::select('title', $titles, null, ['class' => 'custom-select']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', Lang::get('pwweb::core.Name')) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Middle name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('middle_name', Lang::get('pwweb::core.Middle name')) !!}
    {!! Form::text('middle_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Surname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('surname', Lang::get('pwweb::core.Surname')) !!}
    {!! Form::text('surname', null, ['class' => 'form-control']) !!}
</div>

<!-- Maiden name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('maiden_name', Lang::get('pwweb::core.Maiden name')) !!}
    {!! Form::text('maiden_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Gender Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gender', Lang::get('pwweb::core.Gender')) !!}
    {!! Form::select('gender', $genders, null, ['class' => 'custom-select']) !!}
</div>

<!-- Date of Birth Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dob', Lang::get('pwweb::core.Dob')) !!}
    {!! Form::date('dob', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(Lang::get('pwweb::core.Save person'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('core.persons.index') }}" class="btn btn-secondary">@lang("pwweb::core.cancel")</a>
</div>
