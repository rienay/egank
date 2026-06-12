<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Pengantar Magang</title>
    <style>
        @page {
            size: 8.5in 13in; 
            margin: 1.0in 1.0in 1.0in 1.0in;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            line-height: 1.4;
            background-color: #ffffff;
            color: #000;
            font-size: 12pt;
        }

        .table-kop {
            width: 100%;
            margin-bottom: 0px;
        }

        .logo-col {
            width: 75px;
            text-align: center;
            vertical-align: middle;
        }

        .header-text {
            text-align: center;
            vertical-align: middle;
        }

        .isi-surat {
            text-align: justify;
            font-size: 12pt;
            line-height: 1.4;
        }

        .paragraf {
            text-indent: 1.25cm;
            margin-top: 6px;
            margin-bottom: 6px;
        }

        .tabel-data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .tabel-data th, .tabel-data td {
            border: 1px solid #000;
            padding: 5px 8px;
            font-size: 12pt;
        }

        .tabel-data th {
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>

@php
    $logoPath = null;
    if ($kampus && $kampus->logo_kampus && file_exists(public_path('storage/' . $kampus->logo_kampus))) {
        $logoPath = public_path('storage/' . $kampus->logo_kampus);
    } elseif (file_exists(public_path('img/logopnc.png'))) {
        $logoPath = public_path('img/logopnc.png');
    }

    $tanggalSurat = \Carbon\Carbon::parse($pengajuan->status === 'disetujui' ? $pengajuan->updated_at : now())->locale('id')->isoFormat('D MMMM YYYY');
    $tahunSurat = \Carbon\Carbon::parse($pengajuan->updated_at ?? now())->year;
    
    $tanggalMulai = $pengajuan->magang?->tgl_mulai ? \Carbon\Carbon::parse($pengajuan->magang->tgl_mulai)->locale('id')->isoFormat('D MMMM YYYY') : '-';
    $tanggalSelesai = $pengajuan->magang?->tgl_selesai ? \Carbon\Carbon::parse($pengajuan->magang->tgl_selesai)->locale('id')->isoFormat('D MMMM YYYY') : '-';
@endphp

<table class="table-kop" border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
    <tr>
        <td class="logo-col" style="width: 15%; vertical-align: middle;">
            @if($logoPath)
                <img src="{{ $logoPath }}" style="width: 70px; height: auto; display: block; margin: 0 auto;">
                <div style="font-size: 8pt; font-weight: bold; text-align: center; margin-top: 4px; line-height: 1.15; text-transform: uppercase; color: #000; white-space: nowrap;">
                    POLITEKNIK NEGERI<br>CILACAP
                </div>
            @endif
        </td>
        <td class="header-text" style="width: 70%; vertical-align: middle;">
            <div style="font-size: 15pt; font-weight: normal; margin: 0; line-height: 1.25; text-transform: uppercase; letter-spacing: 0.2px;">
                {!! nl2br(e($kampus?->kementerian ?? "KEMENTERIAN PENDIDIKAN TINGGI, SAINS,\nDAN TEKNOLOGI")) !!}
            </div>
            <div style="font-size: 15pt; font-weight: bold; margin: 3px 0; line-height: 1.25; text-transform: uppercase; letter-spacing: 0.2px;">
                {{ $kampus?->nama_kampus ?? 'POLITEKNIK NEGERI CILACAP' }}
            </div>
            <div style="font-size: 12pt; margin: 0; line-height: 1.35; font-weight: normal;">
                {{ $kampus?->alamat_kampus ?? 'Jalan Dr. Soetomo No. 1, Sidakaya - Cilacap 53212 Jawa Tengah' }}<br>
                Telepon: {{ $kampus?->telepon_kampus ?? '(0282) 533329' }}, Fax: {{ $kampus?->fax_kampus ?? '(0282) 537992' }}<br>
                <a href="http://{{ $kampus?->website ?? 'www.pnc.ac.id' }}" style="color: #00f; text-decoration: underline;">{{ $kampus?->website ?? 'www.pnc.ac.id' }}</a>, Email: <a href="mailto:{{ $kampus?->email_kampus ?? 'sekretariat@pnc.ac.id' }}" style="color: #00f; text-decoration: underline;">{{ $kampus?->email_kampus ?? 'sekretariat@pnc.ac.id' }}</a>
            </div>
        </td>
        <td class="logo-col" style="width: 15%; vertical-align: middle;">
            <!-- Kolom kosong penyeimbang agar teks tengah terpusat sempurna -->
        </td>
    </tr>
</table>
<div style="border-top: 3px solid #000; border-bottom: 1px solid #000; height: 2px; line-height: 2px; margin-top: 3px; margin-bottom: 15px;"></div>

<table style="width: 100%; margin-top: 10px; margin-bottom: 15px; font-size: 13pt; border-collapse: collapse;">
    <tr>
        <td style="width: 60%; vertical-align: top;">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="width: 70px; vertical-align: top; padding: 0;">Nomor</td>
                    <td style="width: 15px; vertical-align: top; padding: 0; text-align: center;">:</td>
                    <td style="vertical-align: top; padding: 0;">{{ $pengajuan->nomor_surat ?? '.../PL.43/PP.02.10/' . $tahunSurat }}</td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding: 0; padding-top: 4px;">Hal</td>
                    <td style="vertical-align: top; padding: 0; padding-top: 4px; text-align: center;">:</td>
                    <td style="vertical-align: top; padding: 0; padding-top: 4px; font-weight: bold;">Permohonan Izin Magang Industri</td>
                </tr>
            </table>
        </td>
        <td style="width: 40%; text-align: right; vertical-align: top; padding: 0;">
            {{ $tanggalSurat }}
        </td>
    </tr>
</table>

<div style="margin-bottom: 15px; font-size: 12pt; line-height: 1.4; padding-left: 0;">
    Yth.<br>
    HRD<br>
    {{ $pengajuan->magang?->perusahaan ?? 'Nama Instansi/Perusahaan' }}<br>
    Di - Tempat
</div>

<div class="isi-surat">
    <p style="margin: 0; margin-bottom: 5px;">Dengan hormat,</p>
    <p class="paragraf">
        Sesuai dengan kurikulum pendidikan Politeknik Negeri Cilacap bahwa setiap mahasiswa diwajibkan melaksanakan magang industri di Perusahaan/Instansi. Sehubungan dengan hal tersebut kami mohon izin untuk dapat melaksanakan Magang Industri/Praktek kerja lapangan (On The Job Training) di Instansi/Perusahaan Bpk/Ibu pada Tanggal <strong>{{ $tanggalMulai }} s.d. {{ $tanggalSelesai }}</strong> untuk mahasiswa sebagai berikut:
    </p>
</div>

<table class="tabel-data">
    <thead>
        <tr>
            <th style="width: 8%;">No</th>
            <th style="width: 42%; text-align: left;">Nama</th>
            <th style="width: 20%;">NIM</th>
            <th style="width: 30%; text-align: left;">Program Studi</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td align="center">1</td>
            <td>{{ $pengajuan->magang?->nama ?? '-' }}</td>
            <td align="center">{{ $pengajuan->magang?->nim ?? '-' }}</td>
            <td>{{ $pengajuan->magang?->prodi ?? '-' }}</td>
        </tr>
    </tbody>
</table>

<div class="isi-surat">
    <p class="paragraf">
        Dalam magang industri ini mahasiswa diharapkan dapat mengaplikasikan ilmu di lapangan, mengetahui terapan-terapan teori dan relevansinya, serta memperoleh masukan praktis untuk meningkatkan pengetahuan dan pengalamannya. Hasil dari Magang Industri (On The Job Training) hanya digunakan untuk kepentingan akademik dan tidak untuk dipublikasikan kepada umum.
    </p>
    <p class="paragraf">
        Besar harapan kami Bapak/Ibu dapat memberikan ijin dalam pelaksanaan program magang industri tersebut, adapun informasi/jawaban dapat di sampaikan melalui narahubung Sdr. Tanti Oki Maria Susanti (kiki) di 0811-2804-1000.
    </p>
    <p class="paragraf" style="text-indent: 0; margin-top: 10px;">
        Atas bantuan dan kerjasamanya kami sampaikan terima kasih.
    </p>
</div>

<div style="margin-top: 20px; page-break-inside: avoid;">
    <table style="width: 100%; border: none; border-collapse: collapse;">
        <tr>
            <td style="width: 55%; border: none; vertical-align: top; padding: 0;">
                <div class="tembusan" style="margin-top: 60px; font-size: 9.5pt; line-height: 1.3;">
                    Tembusan Yth :<br>
                    1. Ketua Jurusan Komputer dan Bisnis.<br>
                    2. Arsip.
                </div>
            </td>
            <td style="width: 45%; border: none; text-align: center; vertical-align: top; padding: 0;">
                <p style="margin: 0; line-height: 1.3;">a.n Direktur,</p>
                <p style="margin: 0; line-height: 1.3;">{{ $kampus?->jabatan_penandatangan ?? 'Wakil Direktur I' }}</p>
                
                <div style="margin: 8px 0; text-align: center;">
                    @if(!empty($qrCodeBase64))
                        <img src="data:image/png;base64,{{ $qrCodeBase64 }}" style="width: 80px; height: 80px;" alt="QR Code Verifikasi">
                    @else
                        <div style="height: 80px;"></div>
                    @endif
                </div>

                <p style="margin: 0; font-weight: bold; text-decoration: underline; line-height: 1.3;">{{ $kampus?->nama_penandatangan ?? 'Bayu Aji Girawan, S.T., M.T.' }}</p>
                <p style="margin: 0; line-height: 1.3;">NIP. {{ $kampus?->nip_penandatangan ?? '197903252021211002' }}</p>
            </td>
        </tr>
    </table>
</div>

</body>
</html>