<!-- resources/views/admin/laporan/pdf/cetakLaporanKendaraan.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Kendaraan</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h1>Laporan Semua Kendaraan</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Kendaraan</th>
                <th>Hari/Tanggal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kendaraan as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->kendaraan->jenis }}</td>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $item->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
