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
                                ]) !!}
                                <span class="text-danger">{{ $errors->first('id_kendaraan') }}</span>
                            </div>


                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="waktu">Waktu Pelaksanaan</label>
                                {!! Form::time('waktu', now()->format('H:i'), ['class' => 'form-control']) !!}
                                <span class="text-danger">{{ $errors->first('waktu') }}</span>
                            </div>

                            <div class="form-group mt-3">
                                <label for="tanggal">Tanggal</label>
                                {!! Form::date('tanggal', now()->format('Y-m-d'), ['class' => 'form-control']) !!}
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
                            <tbody>
                                @foreach ($kegiatan as $kg)
                                    <tr>
                                        <td>{{ $kg->nama }}</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                {{ Form::radio($kg->id, 'Yes', false, ['class' => 'form-check-input']) }}
                                                {{ Form::label($kg->id . '_yes', 'Yes', ['class' => 'form-check-label yes-label']) }}
                                            </div>
                                            <div class="form-check form-check-inline">
                                                {{ Form::radio($kg->id, 'No', false, ['class' => 'form-check-input']) }}
                                                {{ Form::label($kg->id . '_no', 'No', ['class' => 'form-check-label no-label']) }}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                    <div class="row mt-3">
                        <label class="form-label" for="basic-default-message">BA SET</label>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="no_back_plate">No Back Plate</label>
                                {!! Form::text('no_back_plate', null, ['class' => 'form-control']) !!}
                                <span class="text-danger">{{ $errors->first('no_back_plate') }}</span>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="no_cylinder">No Cylinder</label>
                                {!! Form::text('no_cylinder',null, ['class' => 'form-control']) !!}
                                <span class="text-danger">{{ $errors->first('no_cylinder') }}</span>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="visual">Visual</label>
                                {!! Form::text('visual', null,['class' => 'form-control']) !!}
                                <span class="text-danger">{{ $errors->first('visual') }}</span>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="fungsi">Fungsi</label>
                                {!! Form::text('fungsi',null, ['class' => 'form-control']) !!}
                                <span class="text-danger">{{ $errors->first('fungsi') }}</span>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="tekanan">Tekanan</label>
                                {!! Form::text('tekanan',null, ['class' => 'form-control']) !!}
                                <span class="text-danger">{{ $errors->first('tekanan') }}</span>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="operator">Operator</label>
                                {!! Form::text('operator',null, ['class' => 'form-control']) !!}
                                <span class="text-danger">{{ $errors->first('operator') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                       <div class="col-md-12">
                            <label class="form-label" for="basic-default-message">Catatan Hasil Laporan</label>
                            <textarea
                              id="basic-default-message"
                              class="form-control"
                            ></textarea>
                          </div>
                       </div>
                    </div>
                    {!! Form::submit($button, ['class' => 'btn btn-primary mt-3']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
