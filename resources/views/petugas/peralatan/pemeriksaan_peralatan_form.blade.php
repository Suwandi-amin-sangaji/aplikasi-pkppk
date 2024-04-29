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
                                <label for="jenis_peralatan">Jenis Peralatan</label>
                                {!! Form::select(
                                    'jenis_peralatan',
                                    [
                                        'f1' => 'F1',
                                        'f2' => 'F2',
                                        'apar' => 'Apar',
                                    ],
                                    null,
                                    ['class' => 'form-control'],
                                ) !!}
                                <span class="text-danger">{{ $errors->first('jenis_peralatan') }}</span>
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
                            <tbody>
                                @foreach ($peralatan as $compartment => $items)
                                    <tr>
                                        <td><strong>{{ $compartment }}</strong></td>
                                        <td><strong>Jumlah</strong></td>
                                        <td><strong>Kondisi</strong></td>
                                    </tr>
                                    @foreach ($items as $kg)
                                        <tr>
                                            <td>{{ $kg->item }}</td>
                                            <td>{{ $kg->jumlah }}</td>
                                            <td>
                                                <div class="form-check form-check-inline">
                                                    {{ Form::checkbox($kg->id, 'Baik', false, ['class' => 'form-check-input']) }}
                                                    {{ Form::label($kg->id . '_baik', 'Baik', ['class' => 'form-check-label yes-label']) }}
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    {{ Form::checkbox($kg->id, 'Rusak', false, ['class' => 'form-check-input']) }}
                                                    {{ Form::label($kg->id . '_rusak', 'Rusak', ['class' => 'form-check-label no-label']) }}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach

                            </tbody>
                        </table>
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
    </div>
@endsection
