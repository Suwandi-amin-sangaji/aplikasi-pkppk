@extends('layouts.template_admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">{{ $title }}</h5>

                <div class="card-body">
                    {!! Form::model($model, ['route' => $route, 'method' => $method]) !!}
                    @csrf
                    <div class="form-group mt-3">
                        <label for="id_compartment">Cmpartment</label>
                        {!! Form::select('id_compartment', $compartment, null, [
                            'class' => 'form-control',
                        ]) !!}
                        <span class="text-danger">{{ $errors->first('id_compartment') }}</span>
                    </div>

                    <div class="form-group mt-3">
                        <label for="item">Nama Item</label>
                        {!! Form::text('item', null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('item') }}</span>
                    </div>

                    <div class="form-group mt-3">
                        <label for="description">description</label>
                        {!! Form::text('description', null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    </div>

                    <div class="form-group mt-3">
                        <label for="jumlah">Jumlah</label>
                        {!! Form::number('jumlah', null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('jumlah') }}</span>
                    </div>

                    {!! Form::submit($button, ['class' => 'btn btn-primary mt-3']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
