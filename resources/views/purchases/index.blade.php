@extends('layouts.app')
@section('title', 'Paket kredit')
@section('content')
<div class="page-head">
    <h1>Pilih paket kredit</h1>
    <p>1 kredit untuk 1 kelas. Pilih paket, bayar, lalu kamu mendapat kode pelanggan untuk booking kelas.</p>
    <div class="flow"><span><b>1.</b> Pilih paket</span><span><b>2.</b> Bayar</span><span><b>3.</b> Terima kode</span><span><b>4.</b> Booking kelas</span></div>
</div>
<form method="POST" action="{{ route('purchases.store') }}">
    @csrf
    <div class="pkgs" role="radiogroup" aria-label="Paket kredit">
        @forelse ($packages as $package)
            <label class="pkg">
                <input type="radio" name="package_id" value="{{ $package->id }}" @checked(old('package_id') == $package->id) required>
                <span class="pkg-box">
                    <span class="pkg-name">{{ $package->name }}</span>
                    <span class="pkg-price">Rp{{ number_format($package->price, 0, ',', '.') }}</span>
                    <span class="pkg-credit">{{ $package->credits }} kredit kelas</span>
                    @if ($package->description)<span class="pkg-desc">{{ $package->description }}</span>@endif
                </span>
            </label>
        @empty
            <div class="empty">Belum ada paket kredit.</div>
        @endforelse
    </div>

    <div class="card" style="max-width:520px">
        <div class="seg" role="radiogroup" aria-label="Jenis pembeli">
            <label><input type="radio" name="buyer" value="new" checked><span>Pelanggan baru</span></label>
            <label><input type="radio" name="buyer" value="existing" @checked(old('buyer') === 'existing' || request()->filled('customer_code'))><span>Sudah punya kode</span></label>
        </div>
        <div class="field" id="newFields">
            <label for="name">Nama lengkap</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" autocomplete="name">
            <p class="hint">Kode pelanggan kamu dibuat otomatis setelah pembayaran berhasil.</p>
        </div>
        <div class="field" id="oldFields" hidden>
            <label for="customer_code">Kode pelanggan</label>
            <input id="customer_code" type="text" name="customer_code" value="{{ old('customer_code', request('customer_code')) }}" placeholder="YOGA-A7K9M2" autocapitalize="characters" disabled>
            <p class="hint">Kredit baru akan ditambahkan ke kode ini.</p>
        </div>
        <button class="btn btn-primary btn-block" type="submit">Bayar (simulasi)</button>
    </div>
</form>
@endsection
@push('scripts')
<script>
    (function () {
        const radios = document.querySelectorAll('input[name=buyer]');
        const nf = document.getElementById('newFields'), of = document.getElementById('oldFields');
        const name = document.getElementById('name'), code = document.getElementById('customer_code');
        function set(mode) {
            const old = mode === 'existing';
            nf.hidden = old; of.hidden = !old;
            name.disabled = old; code.disabled = !old;
            name.required = !old; code.required = old;
        }
        radios.forEach(r => r.addEventListener('change', () => set(r.value)));
        const hasCode = code.value.trim() !== '' || localStorage.getItem('yogaCode');
        const checked = document.querySelector('input[name=buyer]:checked').value;
        if (hasCode && checked === 'new' && !name.value) document.querySelector('input[name=buyer][value=existing]').checked = true;
        set(document.querySelector('input[name=buyer]:checked').value);
    })();
</script>
@endpush
