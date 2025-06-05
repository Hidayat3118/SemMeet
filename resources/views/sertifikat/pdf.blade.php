{{-- <!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Sertifikat</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        .sertifikat-container {
            width: 100%;
            height: 100%;
            padding: 40px 60px;
            box-sizing: border-box;
            position: relative;
            background: white;
            border: 10px solid #2c3e50;
        }

        .logo {
            width: 150px;
        }

        .badge {
            position: absolute;
            top: 0;
            right: 40px;
            background: #2c3e50;
            color: white;
            padding: 20px 10px;
            writing-mode: vertical-rl;
            text-align: center;
            font-weight: bold;
        }

        .judul {
            margin-top: 80px;
            text-align: center;
            font-size: 32px;
            font-weight: bold;
        }

        .nama {
            margin-top: 50px;
            text-align: center;
            font-size: 28px;
        }

        .deskripsi {
            margin-top: 30px;
            text-align: center;
            font-size: 18px;
        }

        .ttd {
            position: absolute;
            bottom: 60px;
            right: 60px;
            text-align: center;
        }

        .ttd img {
            height: 50px;
        }

        .ttd .nama {
            font-weight: bold;
            margin-top: 5px;
        }

        .ttd .jabatan {
            font-size: 14px;
            color: gray;
        }
    </style>
</head>

<body>
    <div class="sertifikat-container">
        <img src="{{ public_path('logo.png') }}" class="logo" alt="Logo">

        <div class="badge">SERTIFIKAT KELULUSAN</div>

        <div class="judul">SERTIFIKAT</div>

        <div class="deskripsi">Diberikan kepada:</div>

        <div class="nama">{{ $sertifikat->pendaftaran->peserta->user->name }}</div>

        <div class="deskripsi">
            Atas partisipasi dan kehadiran dalam seminar:<br>
            <strong>{{ $sertifikat->pendaftaran->seminar->judul }}</strong><br>
            pada tanggal
            {{ \Carbon\Carbon::parse($sertifikat->pendaftaran->seminar->waktu)->translatedFormat('d F Y') }}
        </div>

        <div class="ttd">
            <img src="{{ public_path('tanda-tangan.png') }}" alt="Tanda Tangan">
            <div class="nama">{{ $sertifikat->pendaftaran->seminar->pembicara->user->name }}</div>
            <div class="jabatan">{{ $sertifikat->pendaftaran->seminar->pembicara->instansi }}</div>
        </div>
    </div>
</body>

</html> --}}

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Sertifikat</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #fff;
        }

        .sertifikat-container {
            box-sizing: border-box;
            width: 26cm;
            height: 18cm;
            padding: 40px 50px;
            border: 15px solid #2c3e50;
            margin: auto;
            background-color: #fff;

            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;

        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: start;
        }

        .logo {
            width: 150px;
        }

        .badge {
            position: absolute;
            top: 30px;
            right: 50px;
            background-color: #2c3e50;
            color: white;
            padding: 10px 20px;
            writing-mode: vertical-rl;
            /* transform: rotate(180deg); */
            font-weight: bold;
            font-size: 12px;
        }

        .content {
            text-align: center;
            margin-top: 200px;
        }

        .content h1 {
            font-size: 32px;
            margin-bottom: 20px;
        }

        .content p {
            margin: 4px 0;
            font-size: 14px;
        }

        .nama {
            font-size: 24px;
            font-weight: bold;
            margin: 30px 0 15px 0;
        }

        .footer {
            /* display: flex;
            justify-content: center;
            align-items: center; */
            position: absolute;
            bottom: 40px;
            left: 60px;
            right: 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .ttd {
            text-align: center;
        }

        .ttd p {
            margin: 4px 0;
        }

        .ttd .garis {
            border-bottom: 1px solid #000;
            margin: 10px auto 5px auto;
            width: 200px;
        }

        .ttd img {
            max-height: 60px;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="sertifikat-container">
        <div class="header">
            <img src="{{ asset('img/icon.jpg') }}" alt="Logo" class="logo">
        </div>

        <div class="badge">SERTIFIKAT KELULUSAN</div>

        <div class="content">
            <h1>SERTIFIKAT</h1>
            <p>Diberikan kepada:</p>
            <div class="nama">{{ $sertifikat->pendaftaran->peserta->user->name }}</div>
            <p>Atas partisipasi dan kehadiran dalam seminar:</p>
            <p><strong>{{ $sertifikat->pendaftaran->seminar->judul }}</strong></p>
            <p>yang diselenggarakan pada tanggal
                <strong>{{ \Carbon\Carbon::parse($sertifikat->pendaftaran->seminar->waktu)->translatedFormat('d F Y') }}</strong>
            </p>
        </div>

        <div class="footer">
            <div class="ttd">
                {{-- Cek apakah tanda tangan ada --}}
                @php
                    $pembicara = $sertifikat->pendaftaran->seminar->pembicara ?? null;
                @endphp

                @if ($pembicara && $pembicara->tanda_tangan)
                    <img src="{{ public_path('storage/' . $pembicara->tanda_tangan) }}" alt="Tanda Tangan">
                @else
                    <div class="garis"></div>
                @endif
                <div class="garis"></div>
                <p>{{ $pembicara->user->name ?? 'Nama Pembicara' }}</p>
                <p><em>Pembicara</em></p>
                {{-- <div class="garis"></div>
                <p>{{ $sertifikat->pendaftaran->seminar->pembicara->user->name ?? 'Nama Pembicara' }}</p>
                <p><em>Pembicara</em></p> --}}
            </div>
        </div>
    </div>
</body>

</html>
