@extends('layouts.app')
@section('title', 'Jadwal kelas')
@section('content')
@php
    // Jika belum memilih tanggal, tampilkan hari terdekat yang punya kelas.
    $activeDate = $selectedDate
        ?? ($classesByDate->keys()->first(fn ($d) => $d >= now()->toDateString())
            ? \Carbon\Carbon::parse($classesByDate->keys()->first(fn ($d) => $d >= now()->toDateString()))
            : null);
    $activeClasses = $activeDate ? $classesByDate->get($activeDate->toDateString(), collect()) : collect();
@endphp
<div class="page-head">
    <h1>Jadwal kelas</h1>
    <p>Pilih jenis kelas dan tanggal. Titik menandakan ada kelas di hari itu.</p>
</div>

<div class="filters">
    @foreach (['Semua', 'Hatha', 'Vinyasa', 'Yin', 'Pernapasan'] as $type)
        <a class="pill {{ $selectedType === $type ? 'active' : '' }}"
           href="{{ route('classes.index', ['month' => $month->format('Y-m'), 'type' => $type]) }}">{{ $type }}</a>
    @endforeach
</div>

<div class="split">
    <section class="card" aria-label="Kalender">
        <div class="month-head">
            <a class="month-btn" aria-label="Bulan sebelumnya" href="{{ route('classes.index', ['month' => $month->copy()->subMonth()->format('Y-m'), 'type' => $selectedType]) }}">‹</a>
            <h2>{{ $month->translatedFormat('F Y') }}</h2>
            <a class="month-btn" aria-label="Bulan berikutnya" href="{{ route('classes.index', ['month' => $month->copy()->addMonth()->format('Y-m'), 'type' => $selectedType]) }}">›</a>
        </div>
        <div class="cal">
            @foreach (['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'] as $d)<div class="wd">{{ $d }}</div>@endforeach
            @for ($i = 1; $i < $monthStart->dayOfWeekIso; $i++)<div></div>@endfor
            @for ($n = 1; $n <= $month->daysInMonth; $n++)
                @php
                    $date = $month->copy()->day($n);
                    $key = $date->toDateString();
                    $has = $classesByDate->has($key);
                    $sel = $activeDate && $activeDate->toDateString() === $key;
                @endphp
                <a class="day {{ $sel ? 'selected' : '' }} {{ $date->isPast() && !$date->isToday() ? 'past' : '' }}"
                   href="{{ route('classes.index', ['month' => $month->format('Y-m'), 'date' => $key, 'type' => $selectedType]) }}">
                    {{ $n }}@if ($has)<span class="dot"></span>@endif
                </a>
            @endfor
        </div>
    </section>

    <section class="card" aria-live="polite">
        @if ($activeDate)
            <h2 style="font-size:22px">{{ $activeDate->translatedFormat('l, d F Y') }}</h2>
            <div style="margin-top:14px">
            @forelse ($activeClasses as $class)
                @php
                    $startAt = \Carbon\Carbon::parse($class->class_date.' '.$class->start_time);
                    $booked = \App\Models\Booking::where('yoga_class_id', $class->id)->whereIn('status', ['confirmed', 'rescheduled'])->count();
                    $left = max(0, $class->capacity - $booked);
                    $open = $left > 0 && $startAt->isFuture();
                @endphp
                <div class="sess">
                    <div class="sess-time">{{ substr($class->start_time, 0, 5) }}–{{ substr($class->end_time, 0, 5) }}</div>
                    <h3>{{ $class->name }}</h3>
                    @if ($class->instructor)<p style="font-weight:600;font-size:14px">Guru: {{ $class->instructor }}</p>@endif
                    @if ($class->description)<p class="muted">{{ $class->description }}</p>@endif
                    <div class="sess-foot">
                        <span class="muted">{{ $left }} tempat tersisa</span>
                        @if ($open)
                            <a class="btn btn-primary btn-sm" href="{{ route('bookings.create', $class->id) }}">Booking · 1 kredit</a>
                        @else
                            <span class="badge badge-grey">{{ $left < 1 ? 'Penuh' : 'Sudah lewat' }}</span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="empty">Tidak ada kelas di tanggal ini. Coba tanggal lain atau jenis kelas lain.</div>
            @endforelse
            </div>
        @else
            <div class="empty">Belum ada kelas di bulan ini. Coba bulan berikutnya.</div>
        @endif
    </section>
</div>
@endsection
