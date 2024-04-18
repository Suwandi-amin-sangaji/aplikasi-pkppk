@extends('layouts.template_petugas')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">Pemeriksaan {{ $title }}</h5>

                <div class="card-body">
                    {!! Form::model($model, ['route' => $route, 'method' => $method]) !!}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_operator">Nama Operator</label>
                                {!! Form::text('nama_operator', Auth::user()->name, ['class' => 'form-control', 'autofocus']) !!}
                                <span class="text-danger">{{ $errors->first('nama_operator') }}</span>
                            </div>

                            <div class="form-group mt-3">
                                <label for="plat">Asisten</label>
                                {!! Form::text('plat', null, ['class' => 'form-control']) !!}
                                <span class="text-danger">{{ $errors->first('plat') }}</span>
                            </div>

                            <div class="form-group mt-3">
                                <label for="plat">Jenis Kendaraan</label>
                                {!! Form::text('plat', null, ['class' => 'form-control']) !!}
                                <span class="text-danger">{{ $errors->first('plat') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="merk">Waktu Pelaksanaan</label>
                                {!! Form::text('merk', null, ['class' => 'form-control']) !!}
                                <span class="text-danger">{{ $errors->first('merk') }}</span>
                            </div>

                            <div class="form-group mt-3">
                                <label for="jumlah">Hari Dan Tanggal</label>
                                {!! Form::text('jumlah', null, ['class' => 'form-control']) !!}
                                <span class="text-danger">{{ $errors->first('jumlah') }}</span>
                            </div>

                            <div class="form-group mt-3">
                                <label for="jumlah">Mengetahui</label>
                                {!! Form::text('jumlah', null, ['class' => 'form-control']) !!}
                                <span class="text-danger">{{ $errors->first('jumlah') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive mt-5">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Kegiatan</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        Testing
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            {{ Form::radio('active', 'true', true, ['class' => 'form-check-input']) }}
                                            {{ Form::label('active', 'Yes', ['class' => 'form-check-label']) }}
                                            {{ Form::radio('active', 'false', ['class' => 'form-check-input']) }}
                                            {{ Form::label('active', 'No', ['class' => 'form-check-label']) }}
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Testing
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            {{ Form::radio('active', 'true', true, ['class' => 'form-check-input']) }}
                                            {{ Form::label('active', 'Yes', ['class' => 'form-check-label']) }}
                                            {{ Form::radio('active', 'false', ['class' => 'form-check-input']) }}
                                            {{ Form::label('active', 'No', ['class' => 'form-check-label']) }}
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                    {!! Form::submit($button, ['class' => 'btn btn-primary mt-3']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
