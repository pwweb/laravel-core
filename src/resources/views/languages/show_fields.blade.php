<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', Lang::get('pwweb::core.Name')) !!}
    <p>{{ $language->name }}</p>
</div>

<!-- Locale Field -->
<div class="form-group">
    {!! Form::label('locale', Lang::get('pwweb::core.Locale')) !!}
    <p>{{ $language->locale }}</p>
</div>

<!-- Abbreviation Field -->
<div class="form-group">
    {!! Form::label('abbreviation', Lang::get('pwweb::core.Abbreviation')) !!}
    <p>{{ $language->abbreviation }}</p>
</div>

<!-- Installed Field -->
<div class="form-group">
    {!! Form::label('installed', Lang::get('pwweb::core.Installed')) !!}
    <p>{{ $language->installed }}</p>
</div>

<!-- Active Field -->
<div class="form-group">
    {!! Form::label('active', Lang::get('pwweb::core.Active')) !!}
    <p>{{ $language->active }}</p>
</div>

<!-- Standard Field -->
<div class="form-group">
    {!! Form::label('standard', Lang::get('pwweb::core.Standard')) !!}
    <p>{{ $language->standard }}</p>
</div>
