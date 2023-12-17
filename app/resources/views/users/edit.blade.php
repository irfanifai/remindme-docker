@extends('app')

@section('title')
    User
@endsection

@section('header')
    Edit User
@endsection

@section('breadcrumb')
    <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Halaman Utama</a></div>
    <div class="breadcrumb-item"><a href="{{ route('users.index') }}">User</a></div>
    <div class="breadcrumb-item active">Edit User</div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-6 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form enctype="multipart/form-data" method="POST"
                        action="{{ route('users.update', ['user' => $user->id]) }}">
                        @method('patch')
                        @csrf

                        <div class="row">
                            <div class="form-group col-md-8 col-8 mt-4">
                                <label for="name">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" id="name" value="{{ $user->name }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror <br>
                                <label for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" id="email" value="{{ $user->email }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror <br>
                                <label for="password">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" id="password" value="{{ $user->email }}">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror <br>
                            </div>
                        </div>

                        <button class="btn btn-primary" type="submit">Simpan</button>
                        <button class="btn btn-secondary" type="reset">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    @endsection
