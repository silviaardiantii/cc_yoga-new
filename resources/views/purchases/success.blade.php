@extends('layouts.app')
@section('title', 'Pembayaran berhasil')
@section('content')
<div class="narrow">
    <div class="card" data-save-code="{{ $purchase->customer->customer_code }}">
        <span class="badge">Pembayaran berhasil</span>
        <h1 style="margin-top:10px;font-size:30px">Terima kasih, {{ $purchase->customer->name }}!</h1>
        <p class="muted" style="margin-top:6px">Paket {{ $purchase->package->name }}: +{{ $purchase->credits_purchased }} kredit. Saldo kamu sekarang <strong>{{ $purchase->customer->credit_balance }} kredit</strong>.</p>
        <p style="margin-top:18px;font-weight:600">Kode pelanggan kamu</p>
        <div class="code-box">{{ $purchase->customer->customer_code }}</div>
        <p class="muted">Gunakan kode ini untuk booking kelas dan melihat riwayat. Kode sudah tersimpan di browser ini, tapi catat juga untuk jaga-jaga.</p>
        <div class="actions">
            <a class="btn btn-primary" href="{{ route('classes.index') }}">Pilih kelas</a>
            <a class="btn btn-outline" href="{{ route('history.index', ['customer_code' => $purchase->customer->customer_code]) }}">Lihat riwayat</a>
        </div>
    </div>
</div>
@endsection
