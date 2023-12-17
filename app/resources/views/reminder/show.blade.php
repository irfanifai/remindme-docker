@extends("app")

@section("title") Reminder @endsection

@section("header") Detail Reminder @endsection

@section("breadcrumb")
<div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Halaman Utama</a></div>
<div class="breadcrumb-item"><a href="{{ route('reminder.index') }}">Reminder</a></div>
<div class="breadcrumb-item active">Detail Reminder</div>
@endsection

@section("content")
<div class="row">
    <div class="col-12 col-md-6 col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-md">
                        <tr>
                            <th>ID</th>
                            <td>{{ $Reminder->id }}</td>
                        </tr>
                        <tr>
                            <th>Penulis</th>
                            <td>{{ $Reminder->user->name }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Upload</th>
                            <td>{{ $Reminder->published_at }}</td>
                        </tr>
                        <tr>
                            <th>Judul Reminder</th>
                            <td>{{ $Reminder->title }}</td>
                        </tr>
                        <tr>
                            <th>Isi Reminder</th>
                            <td>{!! $Reminder->body !!}</td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td>{{ $Reminder->category->title }}</td>
                        </tr>
                        <tr>
                            <th>Gambar Utama</th>
                            <td><img src="{{asset($Reminder->featured)}}" alt="Gambar Utama"  height="450" width="865"></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

