@extends('layouts.template_admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">Tambah {{ $title }}</h5>

                <div class="card-body">
                    {!! Form::model($model, ['route' => $route, 'method' => $method]) !!}
                    <div class="form-group">
                        <label for="jenis">Jenis Kendaraan</label>
                        {!! Form::text('jenis', null, ['class' => 'form-control', 'autofocus']) !!}
                        <span class="text-danger">{{ $errors->first('jenis') }}</span>
                    </div>

                    <div class="form-group mt-3">
                        <label for="plat">Plat Nomor</label>
                        {!! Form::text('plat', null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('plat') }}</span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="merk">Merk</label>
                        {!! Form::text('merk', null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('merk') }}</span>
                    </div>

                    <div class="form-group mt-3">
                        <label for="tahun">tahun</label>
                        {!! Form::text('tahun', null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('tahun') }}</span>
                    </div>

                    <div class="form-group mt-3">
                        <label for="jumlah">Jumlah</label>
                        {!! Form::text('jumlah', null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('jumlah') }}</span>
                    </div>


                    {!! Form::submit($button, ['class' => 'btn btn-primary mt-3']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
