@extends('layouts.app')

@section('title')
    Halaman Utama
@endsection

@section('header')
    Halaman Utama
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-file"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Reminder</h4>
                    </div>
                    <div class="card-body">
                        {{ $totalReminder }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total User</h4>
                    </div>
                    <div class="card-body">
                        {{ $totalUser }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h2 class="section-title mt-0">Last Reminder</h2>
    <div class="row text-center">
        <div class="col-12 col-md-6 col-lg-12">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-striped table-md">
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Remind_at</th>
                                <th>Event_at</th>
                                <th>Created_at</th>
                                <th>Updated_at</th>
                            </tr>
                            @foreach ($reminders as $reminder)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $reminder->title }}</td>
                                    <td>{{ $reminder->description }}</td>
                                    <td>{{ \Carbon\Carbon::parse($reminder->remind_at)->format('Y-m-d H:i:s') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($reminder->event_at)->format('Y-m-d H:i:s') }}</td>
                                    <td>{{ $reminder->created_at }}</td>
                                    <td>{{ $reminder->updated_at }}</td>
                                </tr>
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
