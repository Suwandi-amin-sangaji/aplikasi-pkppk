<!-- resources/views/pdf/patient_detail.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1 class="title text-center mb-3">Hasil</h1><hr>
        <div class="d-flex justify-content-between">
            {{-- <div class="left float-start mb-5" style="width: 45%">
                <p><strong>Nama             :</strong> {{ $data_pasien->nama }}</p>
                <p><strong>Jenis Kelamin    :</strong> {{ $data_pasien->jenis_kelamin }}</p>
                <p><strong>No Rm            :</strong> {{ $data_pasien->no_rm }}</p>
            </div>
            <div class="left float-end mb-5" style="width: 45%">
                <p><strong>No telpon        :</strong> {{ $data_pasien->no_telpon }}</p>
                <p><strong>Alamat           :</strong> {{ $data_pasien->alamat }}</p>
                <p><strong>Tanggal Periksa  :</strong> {{ date("d F Y", strtotime($data_pasien->created_at)) }}</p>
                <br>
            </div> --}}
        </div>

        <h2 style="font-weight: bold">Pemeriksaan :</h2><hr>
        <table class="table table-bordered">

        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
