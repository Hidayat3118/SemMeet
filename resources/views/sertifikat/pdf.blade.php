<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Sertifikat</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Montserrat:wght@700&display=swap"
        rel="stylesheet">
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
            padding: 40px;
            margin: auto;
            background-image: url('{{ public_path('img/pola-2.jpeg') }}');
            /* GANTI ke nama filemu */
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
        }

        .border-kedua {
            box-sizing: border-box;
            height: 590px;
            padding: 40px 50px;
            margin: auto;
            background-color: rgba(255, 255, 255, 0.9);
            /* semi transparan agar pola tetap terlihat */
            border: 1px solid #2B7EC1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            border-radius: 1%;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: start;
        }

        .header img {
            display: flex;
            justify-content: space-between;
            align-items: start;
            position: absolute;
            top: 30px;
            left: 20px;
        }


        .partisipasi {
            position: absolute;
            top: 30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 20px;
            /* jarak antar logo */
            align-items: center;
        }

        .partisipasi img {
            height: 60px;
            width: auto;
            object-fit: contain;
           
           
        }



        .logo-partisipan {
            width: 50px;
        }

        .logo {
            width: 70px;
        }

        .badge {
            position: absolute;
            top: 30px;
            right: 20px;
            padding: 10px 20px;
            background-color: #FFD046;
            /* kuning pastel */
            /* color: white; */
            font-weight: bold;
            text-transform: uppercase;
            transform: skew(-20deg);
            /* miringkan */
            font-family: Arial, sans-serif;
            font-size: 10px;
        }

        .content {
            text-align: center;
            margin-top: 120px;
        }

        .content h1 {
            font-size: 42px;
            margin-bottom: 30px;
            letter-spacing: 2px;
            color: #2B7EC1;
            font-family: 'Playfair Display', serif;
        }

        .content p {
            margin-bottom: 10px;
            color: #555;
        }

        .nama {
            font-size: 26px;
            font-weight: bold;
            margin: 30px 0 15px 0;
            color: #2B7EC1;
            font-family: 'Montserrat', sans-serif;
        }

        .seminar {
            font-size: 18px;
            font-weight: bold;
            margin: 30px 0 15px 0;
            font-family: 'Montserrat', sans-serif;

        }

        .footer {
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
            color: #333;
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
        <div class="border-kedua">
            <div class="header">
                <img src="{{ public_path('img/icon.jpg') }}" alt="Logo" class="logo">
            </div>
            {{-- logo partisipasi --}}
            @if (!empty($fotoMulti))
                <div class="partisipasi">
                    @foreach ($fotoMulti as $gambar)
                        <img src="{{ public_path('storage/' . $gambar) }}" alt="Gambar"
                            style="width: 60px; margin: 5px;">
                    @endforeach
                </div>
            @endif


            <div class="badge">SERTIFIKAT PARTISIPASI</div>

            <div class="content">
                <h1>SERTIFIKAT</h1>
                <p>Diberikan kepada:</p>
                <div class="nama">{{ $sertifikat->pendaftaran->peserta->user->name }}</div>
                <p>Atas partisipasi dan kehadiran di dalam seminar <span
                        class="seminar">{{ $sertifikat->pendaftaran->seminar->judul }}</span></p>
                {{-- <p class="seminar"></p> --}}
                <p>yang diselenggarakan pada tanggal
                    <strong
                        class="">{{ \Carbon\Carbon::parse($sertifikat->pendaftaran->seminar->waktu)->translatedFormat('d F Y') }}</strong>
                </p>
            </div>

            <div class="footer">
                <div class="ttd">
                    @php
                        $pembicara = $sertifikat->pendaftaran->seminar->pembicara ?? null;
                    @endphp

                    @if ($pembicara && $pembicara->tanda_tangan)
                        <img src="{{ public_path('storage/' . $pembicara->tanda_tangan) }}" alt="Tanda Tangan">
                        <div class="garis"></div>
                    @else
                        <div class="garis"></div>
                    @endif

                    <p>{{ $pembicara->user->name ?? 'Nama Pembicara' }}</p>
                    <p><em>Pembicara</em></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
