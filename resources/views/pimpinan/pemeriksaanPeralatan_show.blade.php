@extends('layouts.template_pimpinan')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h4 class="card-header text-center">{{ $title }}</h4>

                <div class="card-body">
                    <!-- Form fields -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_operator">Nama Operator</label>
                                {!! Form::text('nama_operator', $model->nama_operator, ['class' => 'form-control', 'autofocus', 'disabled']) !!}
                                <span class="text-danger">{{ $errors->first('nama_operator') }}</span>
                            </div>

                            <div class="form-group mt-3">
                                <label for="nama_asisten">Asisten</label>
                                {!! Form::text('nama_asisten', $model->nama_asisten, ['class' => 'form-control', 'disabled']) !!}
                                <span class="text-danger">{{ $errors->first('nama_asisten') }}</span>
                            </div>

                            <div class="form-group mt-3">
                                <label for="jenis_peralatan">Jenis Kendaraan</label>
                                {!! Form::text('jenis_peralatan', $model->jenis_peralatan, ['class' => 'form-control', 'disabled']) !!}
                                <span class="text-danger">{{ $errors->first('jenis_peralatan') }}</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="waktu">Waktu Pelaksanaan</label>
                                {!! Form::time('waktu', $model->waktu, ['class' => 'form-control', 'disabled']) !!}
                                <span class="text-danger">{{ $errors->first('waktu') }}</span>
                            </div>
                            <div class="form-group mt-3">
                                <label for="tanggal">Tanggal</label>
                                {!! Form::text('tanggal', $model->tanggal, ['class' => 'form-control', 'disabled']) !!}
                                <span class="text-danger">{{ $errors->first('tanggal') }}</span>
                            </div>

                            <div class="form-group mt-3">
                                <label for="mengetahui">Mengetahui</label>
                                {!! Form::text('mengetahui', $model->mengetahui, ['class' => 'form-control', 'disabled']) !!}
                                <span class="text-danger">{{ $errors->first('mengetahui') }}</span>
                            </div>
                        </div>
                    </div>


                    <div class="table-responsive mt-5">
                        <table class="table table-bordered">
                            <tbody>
                                @foreach ($peralatan as $compartment => $items)
                                    <tr>
                                        <td colspan="3"><strong>{{ $compartment }}</strong></td>
                                    </tr>
                                    @foreach ($items as $peralatan)
                                        <tr>
                                            <td>{{ $peralatan->item }}</td>
                                            <td>{{ $peralatan->jumlah }}</td>
                                            <td>
                                                @php
                                                    $isCheckedBaik =
                                                        isset($hasilPeralatan[$peralatan->id]) &&
                                                        $hasilPeralatan[$peralatan->id]->hasil == 'Baik';
                                                    $isCheckedRusak =
                                                        isset($hasilPeralatan[$peralatan->id]) &&
                                                        $hasilPeralatan[$peralatan->id]->hasil == 'Rusak';
                                                @endphp
                                                <div class="form-check form-check-inline">
                                                    <input type="checkbox" name="peralatan[{{ $peralatan->id }}]"
                                                        value="Baik" {{ $isCheckedBaik ? 'checked' : '' }}
                                                        {{ $isCheckedBaik ? 'readonly' : 'disabled' }}
                                                        onclick="toggleReadOnly(this)">
                                                    <label class="form-check-label">Baik</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input type="checkbox" name="peralatan[{{ $peralatan->id }}]"
                                                        value="Rusak" {{ $isCheckedRusak ? 'checked' : '' }}
                                                        {{ $isCheckedRusak ? 'readonly' : 'disabled' }}
                                                        onclick="toggleReadOnly(this)">
                                                    <label class="form-check-label">Rusak</label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Catatan Hasil Laporan -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="form-label" for="basic-default-message">Catatan Hasil Laporan</label>
                            <textarea id="catatan" name="catatan" class="form-control" rows="10" disabled>{{ $model->catatan }}</textarea>
                        </div>
                    </div>


                    <div class="row mt-3">
                        <div class="col-md-12">
                            <a href="{{ route('pemeriksaan-peralatan-pimpinan.index') }}" class="btn btn-danger">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
