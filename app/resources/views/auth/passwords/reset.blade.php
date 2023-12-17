@extends('auth.app')

@section("title") Reset Password @endsection

@section('content')
<div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">

    <div class="card card-primary">
        <div class="card-header"><h4>{{ __('Reset Password') }}</h4></div>

        <div class="card-body">
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
            <label for="email">{{ __('E-Mail Address') }}</label>
                <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus tabindex="1">

            @error('email')
                <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </div>
            @enderror
            </div>

            <div class="form-group">
            <label for="password">{{ __('Password Baru') }}</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

            @error('password')
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
            @enderror
            </div>

            <div class="form-group">
                <label for="password-confirm" class="d-block">{{ __('Konfirmasi Password') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>

            <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                {{ __('Reset Password') }}
            </button>
            </div>
        </form>
        </div>
    </div>
    <div class="simple-footer">
        Copyright &copy; <a href="{{ url('/') }}">Reminder</a> {{ date('Y') }}
    </div>
</div>
@endsection
