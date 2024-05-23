@extends('layouts.template_admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">Tambah {{ $title }}</h5>
                <div class="card-body">
                    {!! Form::model($model, ['route' => $route, 'method' => $method]) !!}
                    @csrf
                    <div class="form-group mt-3">
                        <label for="id_kendaraan">Jenis Kendaraan</label>
                        {!! Form::select('id_kendaraan', $kendaraan, null, [
                            'class' => 'form-control',
                            'id' => 'id_kendaraan',
                        ]) !!}
                        <span class="text-danger">{{ $errors->first('id_kendaraan') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Komponen</label>
                        {!! Form::text('nama', null, ['class' => 'form-control', 'autofocus']) !!}
                        <span class="text-danger">{{ $errors->first('nama') }}</span>
                    </div>
                    {!! Form::submit($button, ['class' => 'btn btn-primary mt-3']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
