@extends('app')

@section('title')
    Reminder
@endsection

@section('header')
    Daftar Reminder
@endsection

@section('breadcrumb')
    <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Halaman Utama</a></div>
    <div class="breadcrumb-item active">Reminder</div>
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

                    <div class=" col-md-8 float-left mb-3">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a href="{{ route('reminder.create') }}" class="btn btn-primary">Create Reminder</a>
                            </li>
                        </ul>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-md">
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Remind_at</th>
                                <th>Event_at</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($reminders as $reminder)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td
                                        style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                        {{ $reminder->title }}</td>
                                    <td
                                        style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                        {{ $reminder->description }}</td>
                                    <td>{{ \Carbon\Carbon::parse($reminder->remind_at)->format('Y-m-d H:i:s') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($reminder->event_at)->format('Y-m-d H:i:s') }}</td>
                                    <td>
                                        <a href="{{ route('reminder.edit', ['reminder' => $reminder->id]) }}"
                                            class="btn btn-warning btn-action mr-1" data-toggle="tooltip" title="Edit"><i
                                                class="fas fa-pencil-alt"></i></a>
                                        <form onsubmit="return confirm('Delete User?')" class="d-inline"
                                            action="{{ route('reminder.destroy', ['reminder' => $reminder->id]) }}"
                                            method="POST">
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
                                        {{-- {{ $reminders->appends(Request::all())->links() }} --}}
                                    </td>
                                </tr>
                            </tfoot>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
