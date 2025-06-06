

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
            border: 15px solid #3D90D7;
            margin: auto;
            background-color: #F2F2F2;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;

        }

        .border-kedua {
            box-sizing: border-box;
            height: 590px;
            padding: 40px 50px;
            border: 3px solid #3D90D7;
            margin: auto;
            background-color: #F2F2F2;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            border-radius: 4%
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: start;
        }

        .logo {
            width: 90px;
        }

        .badge {
            position: absolute;
            top: 30px;
            right: 50px;
            background-color: #3D90D7;
            color: white;
            padding: 10px 20px;
            writing-mode: vertical-rl;
            /* transform: rotate(180deg); */
            font-weight: bold;
            font-size: 15px;
            border-radius: 4%
        }

        .content {
            text-align: center;
            margin-top: 50px;
        }

        .content h1 {
            font-size: 32px;
            margin-bottom: 20px;
        }


        .nama {
            font-size: 24px;
            font-weight: bold;
            margin: 30px 0 15px 0;
            color: #3D90D7
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

        .seminar {
            font-size: 24px;
            font-weight: bold;
            margin: 30px 0 15px 0;
            color: #3D90D7
        }

        
    </style>
</head>

<body>
    <div class="sertifikat-container">
        {{-- border kedua --}}
        <div class="border-kedua">
            <div class="header">
                <img src="{{ public_path('img/icon.jpg') }}" alt="Logo" class="logo">
            </div>

            <div class="badge">SERTIFIKAT PARTISIPASI</div>

            <div class="content">
                <h1>SERTIFIKAT</h1>
                <p class="tes">Diberikan kepada:</p>
                <div class="nama">{{ $sertifikat->pendaftaran->peserta->user->name }}</div>
                <p>Atas partisipasi dan kehadiran dalam seminar:</p>
                {{-- Judul Seminar --}}
                <p class="seminar">{{ $sertifikat->pendaftaran->seminar->judul }}</p>
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

    </div>
</body>

</html>
