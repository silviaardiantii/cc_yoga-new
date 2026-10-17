@extends('layouts.app')
@section('title', 'Booking kelas')
@section('content')
@php $start = \Carbon\Carbon::parse($yogaClass->class_date.' '.$yogaClass->start_time); @endphp
<div class="narrow">
    <div class="page-head"><h1>Konfirmasi booking</h1></div>
    <div class="card stack">
        <div>
            <h2>{{ $yogaClass->name }}</h2>
            @if ($yogaClass->instructor)<p style="font-weight:600">Guru: {{ $yogaClass->instructor }}</p>@endif
            <p class="muted">{{ $start->translatedFormat('l, d F Y') }} · {{ substr($yogaClass->start_time, 0, 5) }}–{{ substr($yogaClass->end_time, 0, 5) }}</p>
        </div>
        <p>Biaya: <strong>1 kredit</strong>. Jadwal bisa diubah sampai 12 jam sebelum kelas dimulai.</p>
        <form action="{{ route('bookings.store') }}" method="POST">
            @csrf
            <input type="hidden" name="yoga_class_id" value="{{ $yogaClass->id }}">
            <div class="field">
                <label for="customer_code">Kode pelanggan</label>
                <input id="customer_code" type="text" name="customer_code" value="{{ old('customer_code', request('customer_code')) }}" placeholder="YOGA-A7K9M2" autocapitalize="characters" required>
            </div>
            <button class="btn btn-primary btn-block" type="submit">Booking dengan 1 kredit</button>
        </form>
        <p class="muted">Belum punya kode atau kredit kurang? <a href="{{ route('purchases.index') }}" style="text-decoration:underline">Beli paket kredit dulu</a> · <a href="{{ route('classes.index') }}" style="text-decoration:underline">Kembali ke jadwal</a></p>
    </div>
</div>
@endsection
