@extends('layouts.template_petugas')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">Pemeriksaan {{ $title }}</h5>

                <div class="card-body">
                    {!! Form::model($model, ['route' => $route, 'method' => $method]) !!}
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_operator">Nama Operator</label>
                                {!! Form::text('nama_operator', Auth::user()->name, ['class' => 'form-control', 'autofocus']) !!}
                                <span class="text-danger">{{ $errors->first('nama_operator') }}</span>
                            </div>

                            <div class="form-group mt-3">
                                <label for="nama_asisten">Asisten</label>
                                {!! Form::text('nama_asisten', null, ['class' => 'form-control']) !!}
                                <span class="text-danger">{{ $errors->first('nama_asisten') }}</span>
                            </div>

                            <div class="form-group mt-3">
                                <label for="id_kendaraan">Jenis Kendaraan</label>
                                {!! Form::select('id_kendaraan', $kendaraan, null, [
                                    'class' => 'form-control',
                                    'placeholder' => 'Pilih kendaraan',
                                    'id' => 'id_kendaraan',
                                ]) !!}
                                <span class="text-danger">{{ $errors->first('id_kendaraan') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="waktu">Waktu Pelaksanaan</label>
                                {!! Form::time('waktu', now()->timezone('Asia/jayapura')->format('H:i'), ['class' => 'form-control']) !!}
                                <span class="text-danger">{{ $errors->first('waktu') }}</span>
                            </div>
                            <div class="form-group mt-3">
                                <label for="tanggal">Hari Dan Tanggal</label>
                                {!! Form::text('tanggal', now()->locale('id')->isoFormat('dddd, D MMMM Y'), [
                                    'class' => 'form-control',
                                    'readonly',
                                ]) !!}
                                <span class="text-danger">{{ $errors->first('tanggal') }}</span>
                            </div>

                            <div class="form-group mt-3">
                                <label for="mengetahui">Mengetahui</label>
                                {!! Form::text('mengetahui', null, ['class' => 'form-control']) !!}
                                <span class="text-danger">{{ $errors->first('mengetahui') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive mt-5">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Kegiatan</th>
                                    <th>Checklist</th>
                                </tr>
                            </thead>
                            <tbody id="kegiatan-table-body">
                                <!-- Dynamically populated rows go here -->
                                @foreach ($kegiatan as $kg)
                                    <tr>
                                        <td>{{ $kg->nama }}</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" name="kegiatan[{{ $kg->id }}]" value="Yes"
                                                    class="form-check-input" id="kegiatan_{{ $kg->id }}_yes">
                                                <label class="form-check-label yes-label"
                                                    for="kegiatan_{{ $kg->id }}_yes">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" name="kegiatan[{{ $kg->id }}]" value="No"
                                                    class="form-check-input" id="kegiatan_{{ $kg->id }}_no">
                                                <label class="form-check-label no-label"
                                                    for="kegiatan_{{ $kg->id }}_no">No</label>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                    <!-- Input BA SET 1 -->
                    <div id="ba_set_1" class="row mt-3" style="display: none;">
                        <label class="form-label" for="basic-default-message">BA SET 1</label>
                        @foreach (['no_back_plate', 'no_cylinder', 'visual', 'fungsi', 'tekanan', 'operator'] as $field)
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="{{ $field }}">{{ ucfirst(str_replace('_', ' ', $field)) }}</label>
                                    {!! Form::text($field, null, ['class' => 'form-control']) !!}
                                    <span class="text-danger">{{ $errors->first($field) }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Input BA SET 2 -->
                    <div id="ba_set_2" class="row mt-3" style="display: none;">
                        <label class="form-label" for="basic-default-message">BA SET 2</label>
                        @foreach (['no_back_plate', 'no_cylinder', 'visual', 'fungsi', 'tekanan', 'operator'] as $field)
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="{{ $field }}">{{ ucfirst(str_replace('_', ' ', $field)) }}</label>
                                    {!! Form::text($field, null, ['class' => 'form-control']) !!}
                                    <span class="text-danger">{{ $errors->first($field) }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="form-label" for="basic-default-message">Catatan Hasil Laporan</label>
                            <textarea id="catatan" name="catatan" class="form-control" rows="10"></textarea>
                        </div>
                    </div>
                </div>
                {!! Form::submit($button, ['class' => 'btn btn-primary mt-3']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
