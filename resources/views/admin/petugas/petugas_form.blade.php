@extends('layouts.template_admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">Tambah Personil</h5>

                <div class="card-body">
                    {!! Form::model($model, ['route' => $route, 'method' => $method, 'enctype' => 'multipart/form-data']) !!}
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
                        <label for="nip">Nip</label>
                        {!! Form::text('nip', null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('nip') }}</span>
                    </div>

                    <div class="form-group mt-3">
                        <label for="status">Status</label>
                        {!! Form::select(
                            'status',
                            [
                                'PNS' => 'PNS',
                                'PPNPN' => 'PPNPN',
                            ],
                            null,
                            ['class' => 'form-control'],
                        ) !!}
                        <span class="text-danger">{{ $errors->first('status') }}</span>
                    </div>

                    <div class="form-group mt-3">
                        <label for="pangkat">Pangkat/Golongan</label>
                        {!! Form::text('pangkat', null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('pangkat') }}</span>
                    </div>

                    <div class="form-group mt-3">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        {!! Form::date('tanggal_lahir', null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('tanggal_lahir') }}</span>
                    </div>

                    <div class="form-group mt-3">
                        <label for="usia">Usia</label>
                        {!! Form::text('usia', null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('usia') }}</span>
                    </div>

                    <div class="form-group mt-3">
                        <label for="pengabdian">Pengabdian</label>
                        {!! Form::text('pengabdian', null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('pengabdian') }}</span>
                    </div>

                    <div class="form-group mt-3">
                        <label for="pensiun">Pensiun</label>
                        {!! Form::text('pensiun', null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('pensiun') }}</span>
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
                                // 'admin' => 'Admin',
                                // 'pimpinan' => 'Pimpinan',
                                'petugas' => 'Petugas',
                            ],
                            null,
                            ['class' => 'form-control'],
                        ) !!}
                        <span class="text-danger">{{ $errors->first('akses') }}</span>
                    </div>

                    {{-- <div class="form-group mt-3">
                        <label for="photo">Photo</label>
                        {!! Form::file('photo', ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('photo') }}</span>
                    </div> --}}


                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            {{-- <img class="mb-3" src="images/{{ Session::get('image') }}" style="width: 250px;"> --}}
                            <img src="{{ $model->photo ? asset('storage/' . $model->photo) : 'https://surgassociates.com/wp-content/uploads/610-6104451_image-placeholder-png-user-profile-placeholder-image-png-1-286x300.jpg' }}"
                                alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                            <div class="button-wrapper">
                                {!! Form::file('photo', ['class' => 'form-control']) !!}
                                    <span class="text-danger">{{ $errors->first('photo') }}</span>
                                <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
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
