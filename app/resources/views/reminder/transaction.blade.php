@extends('app')

@section('title')
    Reminder
@endsection

@section('header')
    Pembayaran Reminder Keluar
@endsection

@section('breadcrumb')
    <div class="breadcrumb-item"><a href="{{ route('dashboard') }}">Halaman Utama</a></div>
    <div class="breadcrumb-item"><a href="{{ route('reminder.index') }}">Reminder</a></div>
    <div class="breadcrumb-item active">Pembayaran Reminder Keluar</div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-6 col-lg-12">
            <div class="card">
                <div class="card-body">

                    @if (session('status'))
                        <div class="flash-data"
                            data-flashdata="{{ session('status') }}">
                        </div>
                    @endif

                    <form enctype="multipart/form-data" method="POST" action="{{ route('reminder.transaction') }}">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="id" value="{{ $reminder->id }}">
                            <div class="form-group col-md-6 col-12">
                                <label>Code</label>
                                <input type="text" class="form-control" name="code" id="code"
                                    value="{{ $reminder->code }}" readonly>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Plat Nomor</label>
                                <input type="text" class="form-control @error('plate_number') is-invalid @enderror"
                                    name="plate_number" id="plate_number" value="{{ $reminder->code }}" readonly>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Kendaraan</label>
                                <input type="text" class="form-control @error('type_vehicles') is-invalid @enderror"
                                    name="type_vehicles" id="type_vehicles" value="{{ $reminder->fare->type_vehicles }}" readonly>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Total Harga</label>
                                <input type="text" class="form-control @error('total') is-invalid @enderror" name="total"
                                    id="total" value="{{$totalCost}}" readonly>
                                @error('total')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Bayar</label>
                                <input type="text" class="form-control @error('paid') is-invalid @enderror" name="paid"
                                    id="paid" value="" placeholder="bayar">
                                @error('paid')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Kembalian</label>
                                <input type="text" class="form-control @error('change') is-invalid @enderror" name="change"
                                    id="change" value="" readonly>
                                @error('change')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                        <button class="btn btn-secondary" type="reset">Reset</button>
                    </form>                   
                </div>
            </div>
        </div>
    </div>
@endsection
