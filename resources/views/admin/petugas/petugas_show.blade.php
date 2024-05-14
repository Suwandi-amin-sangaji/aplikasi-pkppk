@extends('layouts.template_admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card mb-4">
                        <h5 class="card-header">Profile Details</h5>
                        <!-- Account -->
                        <div class="card-body">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                <img src="https://surgassociates.com/wp-content/uploads/610-6104451_image-placeholder-png-user-profile-placeholder-image-png-1-286x300.jpg" alt="user-avatar" class="d-block rounded"
                                    height="100" width="100" id="uploadedAvatar" />
                                <div class="button-wrapper">
                                    <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                        <span class="d-none d-sm-block">Upload new photo</span>
                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                        <input type="file" id="upload" class="account-file-input" hidden
                                            accept="image/png, image/jpeg" />
                                    </label>

                                    <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-0">
                    <div class="card-body">
                        <form id="formAccountSettings" method="POST" onsubmit="return false">

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="firstName" class="form-label">Nama</label>
                                    <input class="form-control" type="text" id="firstName" name="firstName"
                                        value="{{$model->name }}" autofocus />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input class="form-control" type="text" id="email" name="email"
                                        value="{{ $model->email }}" />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="phoneNumber">Phone</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text">ID (+62)</span>
                                        <input type="text" id="phoneNumber" name="phoneNumber" class="form-control"
                                            placeholder="202 555 0111" value="{{ $model->phone }}"/>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="nip" class="form-label">Nip</label>
                                    <input type="text" class="form-control" id="nip" name="nip" value="{{$model->nip}}"
                                       />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="status" class="form-label">Status</label>
                                    <input class="form-control" type="text" id="status" name="status" value="{{$model->status}}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="pangkat" class="form-label">Pangkat/Golongan</label>
                                    <input type="text" class="form-control" id="pangkat" name="pangkat"
                                        value="{{$model->pangkat}}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="country">Tanggal Lahir</label>
                                    <input type="text" class="form-control" id="tanggal_lahr" name="tanggal_lahr"
                                        value="{{$model->tanggal_lahir}}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="usia" class="form-label">Usia</label>
                                    <input type="text" class="form-control" id="usia" name="usia"
                                    value="{{$model->usia}}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="pengabdian" class="form-label">Pengabdian</label>
                                    <input type="text" class="form-control" id="pengabdian" name="pengabdian"
                                    value="{{$model->pengabdian}}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="pengabdian" class="form-label">Pensiun</label>
                                    <input type="text" class="form-control" id="pengabdian" name="pengabdian"
                                    value="{{$model->pensiun}}" />
                                </div>
                            </div>

                            <div class="mt-2">
                                <a href="{{ route('petugas.index') }}" type="reset" class="btn btn-outline-danger">Kembali</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
