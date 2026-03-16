<!DOCTYPE html>
<html>
<head>
    <title>Laporan Jurnal</title>
    <style>
        body { font-family: sans-serif; font-size: 11px; }
        .kop { text-align: center; border-bottom: 3px double #000; padding-bottom: 10px; margin-bottom: 20px; }
        .kop h2 { margin: 0; text-transform: uppercase; }
        .kop p { margin: 2px 0; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background: #eee; text-align: center; }
        .footer { margin-top: 30px; float: right; text-align: center; width: 250px; }
    </style>
</head>
<body>
    <div class="kop">
        <h2>{{ $profile->name }}</h2>
        <p>NPSN: {{ $profile->npsn }} | Tahun Ajaran: {{ $profile->academic_year }}</p>
        <p>{{ $profile->address }}</p>
    </div>
    
    <h3 style="text-align: center">LAPORAN JURNAL MENGAJAR GURU</h3>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Guru</th>
                <th>Mapel</th>
                <th>Kelas</th>
                <th>Materi</th>
                <th>Metode</th>
            </tr>
        </thead>
        <tbody>
            @foreach($journals as $index => $j)
            <tr>
                <td align="center">{{ $index+1 }}</td>
                <td>{{ \Carbon\Carbon::parse($j->date)->format('d/m/Y') }}</td>
                <td>{{ $j->teacher->name }}</td>
                <td>{{ $j->subject->name }}</td>
                <td>{{ $j->classroom->name }}</td>
                <td>{{ $j->material }}</td>
                <td>{{ $j->method }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Mengetahui,</p>
        <p>Kepala Sekolah</p>
        <br><br><br>
        <p><strong>{{ $profile->principal_name }}</strong></p>
    </div>
</body>
</html>