@extends('app')

@section('title')
    Pengguna
@endsection

@section('header')
    Daftar Pengguna
@endsection

@section('breadcrumb')
    <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Halaman Utama</a></div>
    <div class="breadcrumb-item active">Pengguna</div>
@endsection

@section('content')
    <div class="row text-center">
        <div class="col-12 col-md-6 col-lg-12">
            <div class="card">
                <div class="card-body">

                    @if (session('status'))
                        <div class="flash-data" data-flashdata="{{ session('status') }}">
                        </div>
                    @endif

                    <div class="float-left mb-4">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a href="{{ route('users.create') }}" class="btn btn-primary">Created New User</a>
                            </li>
                        </ul>
                    </div>
                    <div class="float-right mb-4">
                        <form action="{{ route('users.index') }}">
                            <div class="input-group">
                                <input type="text" class="form-control" value="{{ Request::get('keyword') }}"
                                    name="keyword" placeholder="Search By Name">
                                <div class="input-group-append">
                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>


                    <div class="table-responsive">
                        <table class="table table-striped table-md">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Creted At</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>
                                        <a href="{{ route('users.edit', ['user' => $user->id]) }}"
                                            class="btn btn-warning btn-action mr-1" data-toggle="tooltip" title="Edit"><i
                                                class="fas fa-pencil-alt"></i></a>
                                        <form onsubmit="return confirm('Delete User?')" class="d-inline"
                                            action="{{ route('users.destroy', ['user' => $user->id]) }}" method="POST">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-action" data-toggle="tooltip"
                                                title="Delete"><i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            <tfoot>
                                <tr>
                                    <td colspan=10>
                                        {{-- {{ $users->appends(Request::all())->links() }} --}}
                                    </td>
                                </tr>
                            </tfoot>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection
