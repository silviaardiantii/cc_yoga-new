<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kode Pelanggan | Yoga Studio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f1e8;
            color: #344238;
            padding: 30px 16px;
        }
        .card {
            max-width: 500px;
            margin: 40px auto;
            padding: 28px;
            border-radius: 18px;
            background: #fffdf8;
        }
        .code {
            padding: 18px;
            background: #e7eddf;
            border-radius: 12px;
            text-align: center;
            font-size: 25px;
            font-weight: bold;
            letter-spacing: 2px;
            overflow-wrap: anywhere;
        }
        a {
            display: inline-block;
            margin: 8px 8px 0 0;
            color: #526b55;
        }
    </style>
</head>
<body>
<div class="card">
    <h1>Pendaftaran berhasil!</h1>
    <p>Simpan kode pelanggan berikut. Kode ini digunakan untuk
       membeli kredit dan mengakses riwayat booking.</p>

    <div class="code">{{ $customer->customer_code }}</div>

    <p>Saldo awal: <strong>0 kredit</strong></p>
    <p>Catat kode ini dengan aman. Siapa pun yang mengetahui kode
       ini dapat mencoba mengakses data pelanggan.</p>

    <a href="{{ route('purchases.index') }}">Beli kredit</a>
    <a href="{{ route('classes.index') }}">Lihat jadwal kelas</a>
</div>
</body>
</html>