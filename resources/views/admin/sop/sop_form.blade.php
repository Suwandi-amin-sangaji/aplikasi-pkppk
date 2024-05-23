@extends('layouts.template_admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">Tambah {{$title}}</h5>

                <div class="card-body">
                    {!! Form::model($model, ['route' => $route, 'method' => $method, 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-group">
                        <label for="title">Name</label>
                        {!! Form::text('title', null, ['class' => 'form-control', 'autofocus']) !!}
                        <span class="text-danger">{{ $errors->first('ttle') }}</span>
                    </div>

                    <div class="form-group mt-3">

                        {!! Form::file('file', ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('file') }}</span>
                        <p class="text-muted mb-0">Allowed PDF</p>

                    </div>

                    {!! Form::submit($button, ['class' => 'btn btn-primary mt-3']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
