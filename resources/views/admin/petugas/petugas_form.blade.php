@extends('layouts.template_admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">Tambah Petugas</h5>

                <div class="card-body">
                    {!! Form::model($model, ['route' => $route, 'method' => $method]) !!}
                    <div class="form-group">
                        <label for="name">Name</label>
                        {!! Form::text('name', null, ['class' => 'form-control', 'autofocus']) !!}
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    </div>

                    <div class="form-group mt-3">
                        <label for="email">Email</label>
                        {!! Form::text('email', null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="phone">phone</label>
                        {!! Form::text('phone', null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                    </div>

                    <div class="form-group mt-3">
                        <label for="password">password</label>
                        {!! Form::text('password', 'password', ['class' => 'form-control', 'type' => 'password']) !!}
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    </div>

                    <div class="form-group mt-3">
                        <label for="role">Akses</label>
                        {!! Form::select(
                            'akses',
                            [
                                'admin' => 'Admin',
                                'pimpinan' => 'Pimpinan',
                                'petugas' => 'Petugas',
                            ],
                            null,
                            ['class' => 'form-control'],
                        ) !!}
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    </div>

                    {!! Form::submit($button, ['class' => 'btn btn-primary mt-3']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
