@extends("app")

@section("title") Pengguna @endsection

@section("header") Detail Pengguna @endsection

@section("breadcrumb")
<div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Halaman Utama</a></div>
<div class="breadcrumb-item"><a href="{{ route('users.index') }}">Pengguna</a></div>
<div class="breadcrumb-item active">Detail Pengguna</div>
@endsection

@section("content")
<div class="row">
    <div class="col-12 col-md-12 col-lg-5">
        <div class="card" style="width: 18rem;">
        <img src="{{ asset($user->photo) }}" class="card-img-top" alt="Foto User">
        <div class="card-body text-center">
            <h6 class="card-title">{{ $user->name }}</h6>
            <h6 class="card-title">{{ $user->email }}</h6>
            <p class="card-text">Post Artikel : {{ $user->post()->count() }}</p>
        </div>
        </div>
    </div>
</div>
@endsection

