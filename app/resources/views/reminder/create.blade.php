@extends('app')

@section('title')
    Reminder
@endsection

@section('header')
    Create Reminder
@endsection

@section('breadcrumb')
    <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Halaman Utama</a></div>
    <div class="breadcrumb-item"><a href="{{ route('reminder.index') }}">Reminder</a></div>
    <div class="breadcrumb-item active">Reminder</div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-6 col-lg-12">
            <div class="card">
                <div class="card-body">

                    @if (session('status'))
                        <div class="flash-data" data-flashdata="{{ session('status') }}">
                        </div>
                    @endif

                    <h6>Create Reminder</h6>
                    <form enctype="multipart/form-data" method="POST" action="{{ route('reminder.store') }}">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-12 col-12">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title" id="title"
                                    value="{{ old('title') }}">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <label>Description</label>
                                <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <label>Remind at</label>
                                <input type="text" class="form-control datetimepicker"  name="remind_at" id="remind_at">
                                @error('remind_at')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <label>Event at</label>
                                <input type="text" class="form-control datetimepicker"  name="event_at" id="event_at">
                                @error('event_at')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button class="btn btn-primary" type="submit">Simpan</button>
                            <button class="btn btn-secondary" type="reset">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
