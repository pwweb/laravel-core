<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', Lang::get('pwweb::core.Email')) !!}
    <p>{{ $user->email }}</p>
</div>

<!-- Email Verified At Field -->
<div class="form-group">
    {!! Form::label('email_verified_at', Lang::get('pwweb::core.Email verified at')) !!}
    <p>{{ $user->email_verified_at }}</p>
</div>
