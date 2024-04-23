@extends('layouts.template_petugas')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">{{ $title }}</h5>

                <div class="card-body">
                    <!-- Form fields -->
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Nama Operator -->
                            <div class="form-group">
                                <label for="nama_operator">Nama Operator</label>
                                <input type="text" name="nama_operator" class="form-control"
                                    value="{{ $model->nama_operator }}" autofocus>
                                <span class="text-danger">{{ $errors->first('nama_operator') }}</span>
                            </div>

                            <!-- Asisten -->
                            <div class="form-group mt-3">
                                <label for="nama_asisten">Asisten</label>
                                <input type="text" name="nama_asisten" class="form-control"
                                    value="{{ $model->nama_asisten }}">
                                <span class="text-danger">{{ $errors->first('nama_asisten') }}</span>
                            </div>

                            <!-- Jenis Kendaraan -->
                            <div class="form-group mt-3">
                                <label for="id_kendaraan">Jenis Kendaraan</label>
                                {!! Form::select('id_kendaraan', $kendaraan, $model->id_kendaraan, ['class' => 'form-control']) !!}
                                <span class="text-danger">{{ $errors->first('id_kendaraan') }}</span>
                            </div>
                            <!-- Waktu Pelaksanaan, Tanggal, Mengetahui -->
                            <!-- Continue with the remaining fields -->
                            ...
                        </div>
                    </div>
                    <!-- Kegiatan -->
                    <div class="table-responsive mt-5">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Kegiatan</th>
                                    <th>Checklist</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kegiatan as $kg)
                                    <tr>
                                        <td>{{ $kg->nama }}</td>
                                        <td>
                                            @php
                                                $isChecked =
                                                    isset($hasilPemeriksaan[$kg->id]) &&
                                                    $hasilPemeriksaan[$kg->id]->hasil == 'Yes';
                                            @endphp
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" name="kegiatan[{{ $kg->id }}]" value="Yes"
                                                    {{ $isChecked ? 'checked' : '' }} readonly onclick="return false;">
                                                <label class="form-check-label">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="checkbox" name="kegiatan[{{ $kg->id }}]" value="No"
                                                    {{ !$isChecked ? 'checked' : '' }} readonly onclick="return false;">
                                                <label class="form-check-label">No</label>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- resources/views/petugas/kendaraan/pemeriksaan_show.blade.php --}}
                    <h3>Data BaSet1</h3>
                    <ul>
                        <li>No Back Plate: {{ $baSet1->no_back_plate1 }}</li>
                        <li>No Cylinder: {{ $baSet1->no_cylinder1 }}</li>
                        <li>Visual: {{ $baSet1->visual1 }}</li>
                        <li>Fungsi: {{ $baSet1->fungsi1 }}</li>
                        <li>Tekanan: {{ $baSet1->tekanan1 }}</li>
                        <li>Operator: {{ $baSet1->operator1 }}</li>
                    </ul>

                    <h3>Data BaSet2</h3>
                    <ul>
                        <li>No Back Plate: {{ $baSet2->no_back_plate2 }}</li>
                        <li>No Cylinder: {{ $baSet2->no_cylinder2 }}</li>
                        <li>Visual: {{ $baSet2->visual2 }}</li>
                        <li>Fungsi: {{ $baSet2->fungsi2 }}</li>
                        <li>Tekanan: {{ $baSet2->tekanan2 }}</li>
                        <li>Operator: {{ $baSet2->operator2 }}</li>
                    </ul>
                    <!-- Catatan Hasil Laporan -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="form-label" for="basic-default-message">Catatan Hasil Laporan</label>
                            <textarea id="catatan" name="catatan" class="form-control" rows="10">{{ $model->catatan }}</textarea>
                        </div>
                    </div>


                    <div class="row mt-3">
                        <div class="col-md-12">
                            <a href="{{ route('pemeriksaan.index') }}" class="btn btn-primary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
