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
                                <label for="role">Jenis Kendaraan</label>
                                {!! Form::select('kendaraan', $kendaraan, null, [
                                    'class' => 'form-control',
                                ]) !!}
                                <span class="text-danger">{{ $errors->first('jenis') }}</span>
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
                                    <th></th>
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
                    {!! Form::submit($button, ['class' => 'btn btn-primary mt-3']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
