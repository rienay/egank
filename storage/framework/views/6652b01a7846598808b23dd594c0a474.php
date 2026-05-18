<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <style>
        @page {
            size: A4;
            margin: 
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 2.5cm 2cm 2cm 2.5cm;
            line-height: 1.4;
            background-color: #ffffff;
            color: #000;
        }

        .table-kop {
            width: 100%;
            border-bottom: 3.5px solid #000; 
            padding-bottom: 2px;
            margin-bottom: 2px;
        }

        .logo-col {
            width: 80px;
            text-align: center;
            vertical-align: middle;
        }

        .header-text {
            text-align: center;
            vertical-align: middle;
        }

        .header-text h2 { margin: 0; font-size: 13pt; font-weight: normal; text-transform: uppercase; }
        .header-text h1 { margin: 0; font-size: 15pt; font-weight: bold; text-transform: uppercase; }
        .header-text p { margin: 1px 0; font-size: 9pt; }

        .line-thin {
            border-top: 1px solid #000;
            margin-top: 1px;
            margin-bottom: 20px;
        }

        .table-meta {
            width: 100%;
            margin-bottom: 20px;
            font-size: 11pt;
        }

        .isi-surat {
            text-align: justify;
            font-size: 11pt;
        }

        .paragraf {
            text-indent: 1.25cm;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .tabel-data {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }

        .tabel-data th, .tabel-data td {
            border: 1px solid #000;
            padding: 8px;
            font-size: 11pt;
        }

        .tabel-data th { background-color: #f2f2f2; text-align: center; }

        .keep-together {
            page-break-inside: avoid;
        }

        .table-ttd {
            width: 100%;
            margin-top: 20px;
        }

        .qr-box img {
            width: 75px;
            height: 75px;
            margin: 10px 0;
        }

        .qr-box img {
            width: 75px;
            height: 75px;
            margin: 10px 0;
        }

        .tembusan {
            margin-top: 30px;
            font-size: 9pt;
        }

        .tembusan ol { margin: 5px 0 0 20px; padding: 0; }
    </style>
</head>
<body>

<?php
    $logoPath = $kampus?->logo_kampus ? public_path('storage/' . $kampus->logo_kampus) : null;
    $tanggalSurat = \Carbon\Carbon::parse($pengajuan->created_at ?? now())->translatedFormat('d F Y');
    $tahunSurat = \Carbon\Carbon::parse($pengajuan->created_at ?? now())->year;
    $tanggalMulai = $pengajuan->magang?->tgl_mulai ? \Carbon\Carbon::parse($pengajuan->magang->tgl_mulai)->translatedFormat('d F Y') : '-';
    $tanggalSelesai = $pengajuan->magang?->tgl_selesai ? \Carbon\Carbon::parse($pengajuan->magang->tgl_selesai)->translatedFormat('d F Y') : '-';
?>

<table class="table-kop" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td class="logo-col">
            <?php if($logoPath && file_exists($logoPath)): ?>
                <img src="<?php echo e($logoPath); ?>" style="width: 75px;">
            <?php endif; ?>
        </td>
        <td class="header-text">
            <h2><?php echo e($kampus?->header_atas ?? 'KEMENTERIAN PENDIDIKAN TINGGI, SAINS, DAN TEKNOLOGI'); ?></h2>
            <h1><?php echo e($kampus?->nama_kampus ?? 'POLITEKNIK NEGERI CILACAP'); ?></h1>
            <p><?php echo e($kampus?->alamat_kampus ?? 'Jl. Dr. Soetomo No. 1 Sidakaya, Cilacap 53212'); ?></p>
            <p>Telepon: <?php echo e($kampus?->telepon_kampus ?? '-'); ?> | Email: <?php echo e($kampus?->email_kampus ?? '-'); ?></p>
            <p>Laman: <?php echo e($kampus?->website ?? 'www.politeknikcilacap.ac.id'); ?></p>
        </td>
    </tr>
</table>
<div class="line-thin"></div>

<table class="table-meta" border="0">
    <tr>
        <td width="60%">
            Nomor : <?php echo e($pengajuan->nomor_surat ?? '0001/PL.43/PP.02.01/' . $tahunSurat); ?><br>
            Lamp. : -<br>
            Hal &nbsp;&nbsp;&nbsp;: <strong>Permohonan Magang Industri</strong>
        </td>
        <td width="40%" style="text-align: right; vertical-align: top;">
            <?php echo e($tanggalSurat); ?>

        </td>
    </tr>
</table>

<div style="margin-bottom: 20px; font-size: 11pt;">
    Yth. <strong>Pimpinan / HRD</strong><br>
    <strong><?php echo e($pengajuan->magang?->perusahaan ?? 'Nama Instansi'); ?></strong><br>
    <?php echo e($pengajuan->magang?->alamat ?? 'Di Tempat'); ?>

</div>

<div class="isi-surat">
    <p>Dengan hormat,</p>
    <p class="paragraf">
        Sesuai dengan kurikulum pendidikan di <strong><?php echo e($kampus?->nama_kampus ?? 'Politeknik Negeri Cilacap'); ?></strong>, setiap mahasiswa diwajibkan melaksanakan kegiatan Magang Industri/Praktik Kerja Lapangan. Kegiatan ini dimaksudkan agar mahasiswa memperoleh pengalaman praktis serta mengenal dunia kerja secara nyata.
    </p>
    <p class="paragraf">
        Sehubungan dengan hal tersebut, kami memohon kesediaan Bapak/Ibu untuk menerima mahasiswa kami melaksanakan magang pada tanggal <strong><?php echo e($tanggalMulai); ?> s.d. <?php echo e($tanggalSelesai); ?></strong>. Adapun identitas mahasiswa tersebut adalah:
    </p>
</div>

<table class="tabel-data">
    <thead>
        <tr>
            <th width="8%">No</th>
            <th width="42%">Nama Mahasiswa</th>
            <th width="20%">NIM</th>
            <th width="30%">Program Studi</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td align="center">1</td>
            <td><?php echo e($pengajuan->magang?->nama ?? '-'); ?></td>
            <td align="center"><?php echo e($pengajuan->magang?->nim ?? '-'); ?></td>
            <td><?php echo e($pengajuan->magang?->prodi ?? '-'); ?></td>
        </tr>
    </tbody>
</table>

<div class="isi-surat">
    <p class="paragraf">
        Besar harapan kami agar Bapak/Ibu berkenan memberikan izin pelaksanaan magang tersebut. Atas bantuan dan kerjasama yang baik, kami sampaikan terima kasih.
    </p>
</div>

<div class="keep-together">
    <table class="table-ttd" border="0">
        <tr>
            <td width="60%"></td>
            <td width="40%" align="center">
                <p style="margin: 0;">a.n. Direktur,</p>
                <p style="margin: 0;">Ketua Jurusan,</p>
                
                <div class="qr-box">
                    <?php if(!empty($qrCodeBase64)): ?>
                        <img src="data:image/png;base64,<?php echo e($qrCodeBase64); ?>" alt="QR Code Verifikasi">
                    <?php else: ?>
                        <div style="height: 80px;"></div>
                    <?php endif; ?>
                </div>

                <p style="margin: 0;">NIP. .............................</p>
            </td>
        </tr>
    </table>

    <div class="tembusan">
        <strong>Tembusan:</strong>
        <ol>
            <li>Wakil Direktur Bidang Akademik;</li>
            <li>Arsip.</li>
        </ol>
    </div>
</div>

</body>
</html><?php /**PATH C:\laragon\www\gank\egank\resources\views/admin/pengajuan_surat/pdf.blade.php ENDPATH**/ ?>