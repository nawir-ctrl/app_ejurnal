<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rekap Jurnal</title>
    <style>
        body { font-family: sans-serif; font-size: 11px; line-height: 1.4; }
        .kop { border-bottom: 3px double #000; padding-bottom: 10px; margin-bottom: 15px; }
        .kop table { width: 100%; border: none; }
        .school-name { font-size: 18px; font-weight: bold; text-transform: uppercase; text-align: center; margin: 0; }
        .school-info { text-align: center; font-size: 10px; margin: 0; }
        
        .data-table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        .data-table th, .data-table td { border: 1px solid #000; padding: 5px; }
        .data-table th { background: #f0f0f0; text-transform: uppercase; }
        
        .signature-table { width: 100%; border: none; margin-top: 40px; }
        .signature-table td { border: none; width: 50%; text-align: center; vertical-align: top; }
        .space { height: 60px; }
    </style>
</head>
<body>
    <div class="kop">
        <table style="width: 100%">
            <tr>
                @if($profile->logo_path)
                <td style="width: 15%"><img src="{{ public_path('storage/' . $profile->logo_path) }}" width="60"></td>
                @endif
                <td style="width: 85%">
                    <div class="school-name">{{ $profile->name }}</div>
                    <div class="school-info">
                        NPSN: {{ $profile->npsn }} | Tahun Ajaran: {{ $profile->academic_year }}<br>
                        {{ $profile->address }}
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <center><h3>REKAPITULASI HONOR MENGAJAR GURU</h3></center>
    <p>
        Periode: {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}<br>
        Status Kepegawaian: {{ $employmentStatus ?: 'Semua' }}
    </p>

    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Guru</th>
                <th>Kepegawaian</th>
                <th>Total Jurnal</th>
                <th>Total Jam</th>
                <th>Total Honor</th>
            </tr>
        </thead>
        <tbody>
            @php $totalJam = 0; $totalHonor = 0; @endphp
            @foreach($rekapData as $index => $data)
                @php 
                    $honor = $data->total_hours * $honorPerJam; 
                    $totalJam += $data->total_hours;
                    $totalHonor += $honor;
                @endphp
                <tr>
                    <td align="center">{{ $index + 1 }}</td>
                    <td>{{ $data->teacher->name }}<br><small>NIP: {{ $data->teacher->nip ?? '-' }}</small></td>
                    <td align="center">{{ $data->teacher->employment_status }}</td>
                    <td align="center">{{ $data->total_journals }}</td>
                    <td align="center">{{ $data->total_hours }}</td>
                    <td align="right">Rp {{ number_format($honor, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tr style="background: #f0f0f0; font-weight: bold">
            <td colspan="4" align="right">GRAND TOTAL</td>
            <td align="center">{{ $totalJam }}</td>
            <td align="right">Rp {{ number_format($totalHonor, 0, ',', '.') }}</td>
        </tr>
    </table>

    <table class="signature-table">
        <tr>
            <td>
                Mengetahui,<br>Kepala Sekolah
                <div class="space"></div>
                <strong><u>{{ $profile->principal_name ?? '(..........................................)' }}</u></strong><br>
                NIP. {{ $profile->principal_nip ?? '-' }}
            </td>
            <td>
                {{ $profile->city ?? 'Ditetapkan' }}, {{ now()->translatedFormat('d F Y') }}<br>
                Bendahara,
                <div class="space"></div>
                <strong><u>{{ $profile->treasurer_name ?? '(..........................................)' }}</u></strong><br>
                NIP. {{ $profile->treasurer_nip ?? '-' }}
            </td>
        </tr>
    </table>
</body>
</html>
