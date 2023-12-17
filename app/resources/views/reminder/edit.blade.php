@extends('app')

@section('title')
    Reminder
@endsection

@section('header')
    Edit Reminder
@endsection

@section('breadcrumb')
    <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Halaman Utama</a></div>
    <div class="breadcrumb-item"><a href="{{ route('reminder.index') }}">Reminder</a></div>
    <div class="breadcrumb-item active">Edit Reminder</div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-6 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form enctype="multipart/form-data" method="POST"
                        action="{{ route('reminder.update', ['reminder' => $reminder->id]) }}">
                        @method('patch')
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                                id="title" value="{{ $reminder->title }}" placeholder="plate number">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control @error('description') is-invalid @enderror"
                                name="description" id="description" value="{{ $reminder->description }}"
                                placeholder="plate number">
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-12 col-12">
                            <label for="remind_at">Remind at</label>
                            @php
                                $remindAt = \Carbon\Carbon::createFromTimestamp($reminder->remind_at);
                                $formattedRemindAt = $remindAt->format('yyyy-mm-dd');
                            @endphp
                            <input type="text" class="form-control datetimepicker"
                                name="remind_at" id="remind_at" value="{{ $formattedRemindAt }}">
                            @error('remind_at')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-12 col-12">
                            <label for="event_at">Event at</label>
                            @php
                                $eventAt = \Carbon\Carbon::createFromTimestamp($reminder->event_at);
                                $formattedEventAt = $eventAt->format('yyyy-mm-dd');
                            @endphp
                            <input type="text" class="form-control datetimepicker"
                                name="event_at" id="event_at" value="{{ $formattedEventAt }}">
                            @error('event_at')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                        <button class="btn btn-secondary" type="reset">Reset</button>
                </div>
            </div>
        </div>
    </div>
@endsection
