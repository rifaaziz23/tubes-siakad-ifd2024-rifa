<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>KRS - {{ $mahasiswa->nama }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11px;
            color: #1a1a2e;
            margin: 0;
            padding: 20px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #6366f1;
            margin-bottom: 20px;
            padding-bottom: 14px;
        }

        .header h1 {
            font-size: 18px;
            font-weight: 800;
            color: #6366f1;
            margin: 0 0 4px;
        }

        .header p {
            margin: 2px 0;
            font-size: 11px;
            color: #555;
        }

        .info-box {
            background: #f5f5ff;
            border: 1px solid #d4d4f5;
            border-radius: 6px;
            padding: 12px 16px;
            margin-bottom: 18px;
        }

        .info-box table {
            width: 100%;
        }

        .info-box td {
            padding: 3px 8px;
            vertical-align: top;
        }

        .info-box td:first-child {
            font-weight: 700;
            width: 130px;
            color: #555;
        }

        table.data {
            width: 100%;
            border-collapse: collapse;
        }

        table.data thead tr {
            background: #6366f1;
            color: #fff;
        }

        table.data thead th {
            padding: 8px 10px;
            text-align: left;
            font-size: 10px;
        }

        table.data tbody tr:nth-child(even) {
            background: #f5f5ff;
        }

        table.data tbody td {
            padding: 7px 10px;
            border-bottom: 1px solid #e0e0f0;
        }

        .tanda-tangan {
            margin-top: 40px;
            width: 100%;
            border-collapse: collapse;
            border: none;
        }

        .tanda-tangan td {
            border: none;
            width: 50%;
            vertical-align: top;
        }

        .total-row {
            background: #6366f1 !important;
            color: #fff;
            font-weight: 700;
        }

        .total-row td {
            padding: 8px 10px !important;
        }

        .footer {
            text-align: right;
            margin-top: 30px;
            font-size: 10px;
            color: #888;
        }

        .ttd-box {
            text-align: center;
            width: 200px;
        }

        .ttd-line {
            border-top: 1px solid #333;
            margin-top: 50px;
            padding-top: 5px;
            font-size: 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>SIAKAD — Kartu Rencana Studi</h1>
        <p>Sistem Informasi Akademik | Tahun Akademik 2026/2027</p>
    </div>

    <div class="info-box">
        <table>
            <tr>
                <td>NPM</td>
                <td>: {{ $mahasiswa->npm }}</td>
            </tr>
            <tr>
                <td>Nama Mahasiswa</td>
                <td>: {{ $mahasiswa->nama }}</td>
            </tr>
            <tr>
                <td>Dosen Pembimbing</td>
                <td>: {{ $mahasiswa->dosen->nama ?? '-' }}</td>
            </tr>
            <tr>
                <td>Tanggal Cetak</td>
                <td>: {{ now()->isoFormat('D MMMM Y') }}</td>
            </tr>
        </table>
    </div>

    <table class="data">
        <thead>
            <tr>
                <th width="40">No</th>
                <th width="100">Kode MK</th>
                <th>Nama Mata Kuliah</th>
                <th width="60">SKS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($krs as $i => $k)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $k->kode_matakuliah }}</td>
                    <td>{{ $k->matakuliah->nama_matakuliah ?? '-' }}</td>
                    <td>{{ $k->matakuliah->sks ?? 0 }}</td>
                </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="3" style="text-align:right">Total SKS yang diambil:</td>
                <td>{{ $totalSks }} SKS</td>
            </tr>
        </tbody>
    </table>

    <table class="tanda-tangan">
        <tr>
            <td style="text-align: left;">
                <div class="ttd-box" style="display: inline-block;">
                    <div>Mengetahui,</div>
                    <div>Dosen Pembimbing</div>
                    <div class="ttd-line">{{ $mahasiswa->dosen->nama ?? '___________________' }}</div>
                </div>
            </td>
            <td style="text-align: right;">
                <div class="ttd-box" style="display: inline-block;">
                    <div>Mahasiswa,</div>
                    <div>&nbsp;</div>
                    <div class="ttd-line">{{ $mahasiswa->nama }}</div>
                </div>
            </td>
        </tr>
    </table>

    <div class="footer">
        Dokumen ini dicetak secara otomatis oleh SIAKAD &nbsp;|&nbsp; {{ now()->format('d/m/Y H:i') }}
    </div>
</body>

</html>
