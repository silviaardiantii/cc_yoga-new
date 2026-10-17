@extends('layouts.app')
@section('title', 'Riwayat')
@section('content')
<div class="page-head">
    <h1>Riwayat dan saldo kredit</h1>
    <p>Lihat booking, ubah jadwal, dan pantau penggunaan kreditmu.</p>
</div>

<form class="card" method="GET" action="{{ route('history.index') }}" style="max-width:520px;margin-bottom:24px">
    <div class="field">
        <label for="customer_code">Kode pelanggan</label>
        <input id="customer_code" type="text" name="customer_code" value="{{ request('customer_code') }}" placeholder="YOGA-A7K9M2" autocapitalize="characters" required>
    </div>
    <button class="btn btn-primary" type="submit">Lihat riwayat</button>
</form>

@if (request()->filled('customer_code') && !$customer)
    <div class="alert alert-err">Kode pelanggan tidak ditemukan. <a href="{{ route('purchases.index') }}" style="text-decoration:underline">Beli paket untuk mendapat kode</a></div>
@endif

@if ($customer)
<div class="stack" data-save-code="{{ $customer->customer_code }}">
    <div class="card">
        <h2>Halo, {{ $customer->name }}!</h2>
        <p class="muted">Kode: {{ $customer->customer_code }}</p>
        <div class="stats" style="margin-top:16px">
            <div class="stat"><span class="muted">Saldo kredit</span><b>{{ $customer->credit_balance }}</b></div>
            <div class="stat"><span class="muted">Kredit terpakai</span><b>{{ abs($transactions->where('type', 'use')->sum('credits')) }}</b></div>
        </div>
        <div class="actions">
            <a class="btn btn-primary btn-sm" href="{{ route('classes.index') }}">Cari kelas</a>
            <a class="btn btn-outline btn-sm" href="{{ route('purchases.index', ['customer_code' => $customer->customer_code]) }}">Tambah kredit</a>
        </div>
    </div>

    <div class="card">
        <h2 style="margin-bottom:8px">Booking</h2>
        @forelse ($bookings as $booking)
            @php
                $c = $booking->yogaClass;
                $startAt = $c ? \Carbon\Carbon::parse($c->class_date.' '.$c->start_time) : null;
                $active = in_array($booking->status, ['confirmed', 'rescheduled']);
                $can = $active && $startAt && now()->lt($startAt->copy()->subHours(12));
                $label = ['confirmed' => 'Terkonfirmasi', 'rescheduled' => 'Dijadwalkan ulang'][$booking->status] ?? ucfirst($booking->status);
            @endphp
            <div class="booking">
                <div class="booking-top">
                    <div>
                        <h3 style="font-size:20px">{{ $c->name ?? 'Kelas tidak tersedia' }}</h3>
                        @if ($c && $c->instructor)<p style="font-weight:600;font-size:14px">Guru: {{ $c->instructor }}</p>@endif
                        @if ($c)<p class="muted">{{ $startAt->translatedFormat('l, d F Y') }} · {{ substr($c->start_time, 0, 5) }}–{{ substr($c->end_time, 0, 5) }}</p>@endif
                        <p class="muted">Kode {{ $booking->booking_code }}</p>
                    </div>
                    <span class="badge {{ $booking->status === 'rescheduled' ? 'badge-terra' : ($active ? '' : 'badge-grey') }}" style="align-self:flex-start">{{ $label }}</span>
                </div>
                @if ($can)
                    <details>
                        <summary>Ubah jadwal</summary>
                        <form method="POST" action="{{ route('bookings.reschedule', $booking->id) }}">
                            @csrf
                            <input type="hidden" name="customer_code" value="{{ $customer->customer_code }}">
                            <label class="label" for="class-{{ $booking->id }}" style="width:100%">Pilih kelas pengganti (kredit tidak dipotong lagi)</label>
                            <select id="class-{{ $booking->id }}" name="yoga_class_id" required>
                                <option value="">Pilih kelas</option>
                                @foreach ($availableClasses as $a)
                                    @if ($a->id !== $booking->yoga_class_id && \Carbon\Carbon::parse($a->class_date.' '.$a->start_time)->isFuture())
                                        <option value="{{ $a->id }}">{{ $a->name }} · {{ \Carbon\Carbon::parse($a->class_date)->format('d M Y') }} {{ substr($a->start_time, 0, 5) }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <button class="btn btn-primary btn-sm" type="submit">Simpan jadwal baru</button>
                        </form>
                    </details>
                @elseif ($active)
                    <p class="hint">Jadwal tidak bisa diubah lagi (kurang dari 12 jam sebelum kelas).</p>
                @endif
            </div>
        @empty
            <div class="empty" style="margin-top:12px">Belum ada booking. <a href="{{ route('classes.index') }}" style="text-decoration:underline">Pilih kelas pertamamu</a></div>
        @endforelse
    </div>

    <div class="card">
        <h2 style="margin-bottom:8px">Riwayat kredit</h2>
        @if ($transactions->isEmpty())
            <p class="muted">Belum ada transaksi kredit.</p>
        @else
            <div class="table-wrap"><table>
                <thead><tr><th>Tanggal</th><th>Keterangan</th><th>Kredit</th><th>Saldo</th></tr></thead>
                <tbody>
                @foreach ($transactions as $t)
                    <tr><td>{{ $t->created_at->format('d/m/Y H:i') }}</td><td>{{ $t->description }}</td>
                        <td class="{{ $t->credits > 0 ? 'plus' : 'minus' }}">{{ $t->credits > 0 ? '+' : '' }}{{ $t->credits }}</td><td>{{ $t->balance_after }}</td></tr>
                @endforeach
                </tbody>
            </table></div>
        @endif
    </div>
</div>
@endif
@endsection
