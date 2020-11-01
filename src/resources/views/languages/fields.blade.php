<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', Lang::get('pwweb::core.Name')) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Locale Field -->
<div class="form-group col-sm-6">
    {!! Form::label('locale', Lang::get('pwweb::core.Locale')) !!}
    {!! Form::text('locale', null, ['class' => 'form-control']) !!}
</div>

<!-- Abbreviation Field -->
<div class="form-group col-sm-6">
    {!! Form::label('abbreviation', Lang::get('pwweb::core.Abbreviation')) !!}
    {!! Form::text('abbreviation', null, ['class' => 'form-control']) !!}
</div>

<!-- Installed Field -->
<div class="form-group col-sm-6">
    {!! Form::label('installed', Lang::get('pwweb::core.Installed')) !!}
    <label class="checkbox-inline">
        {!! Form::hidden('installed', 0) !!}
        {!! Form::checkbox('installed', '1', null) !!}
    </label>
</div>


<!-- Active Field -->
<div class="form-group col-sm-6">
    {!! Form::label('active', Lang::get('pwweb::core.Active')) !!}
    <label class="checkbox-inline">
        {!! Form::hidden('active', 0) !!}
        {!! Form::checkbox('active', '1', null) !!}
    </label>
</div>


<!-- Standard Field -->
<div class="form-group col-sm-6">
    {!! Form::label('standard', Lang::get('pwweb::core.Standard')) !!}
    <label class="checkbox-inline">
        {!! Form::hidden('standard', 0) !!}
        {!! Form::checkbox('standard', '1', null) !!}
    </label>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(Lang::get('pwweb::core.Save language'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('core.languages.index') }}" class="btn btn-secondary">@lang("pwweb::core.cancel")</a>
</div>
