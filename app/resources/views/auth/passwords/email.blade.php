@extends('auth.app')

@section("title") Lupa Password @endsection

@section('content')
<div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">

    <div class="card card-primary">
        <div class="card-header"><h4>{{ __('Lupa Password') }}</h4></div>

        @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show mx-4">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
            </button>
        </div>
        @endif

        <div class="card-body">
        <form method="POST" action="{{ route('password.email') }}">
        @csrf
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
            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                {{ __('Send Password Reset Link') }}
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
