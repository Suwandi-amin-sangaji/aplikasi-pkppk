@extends('layouts.template_petugas')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">{{$title}}</h5>

                <div class="card-body">

                    <div class="d-flex justify-content-between mb-3">
                        <div class="d-flex align-items-start">
                            <button class="btn btn-primary btn-sm mx-2" id="startScannerBtn">Scanner QrCode</button>
                            <a href="{{ route('pemeriksaan-peralatan.create') }}" class="btn btn-primary btn-sm">Pemeriskaan Peralatan</a>
                        </div>
                        {!! Form::open(['method' => 'GET', 'class' => 'd-flex']) !!}
                        {!! Form::text('search', request('search'), ['class' => 'form-control', 'placeholder' => 'Search...']) !!}
                        <button type="submit" class="btn btn-primary btn-sm">Search</button>
                        {!! Form::close() !!}
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Operator</th>
                                    <th>Asisten</th>
                                    <th>Waktu</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($peralatan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_operator }}</td>
                                        <td>{{ $item->nama_asisten }}</td>
                                        <td>{{ $item->waktu }}</td>
                                        <td>{{ $item->tanggal }}</td>
                                        @if ($item->status)
                                            <td><span class="badge bg-label-warning me-1">{{ $item->status }}</span></td>
                                        @else
                                        @endif
                                        <td>
                                            <a href="{{ route('pemeriksaan-peralatan.show', $item->id) }}"
                                                class="btn btn-secondary btn-sm"><i class="fa fa-eye"> </i></a>
                                        </td>
                                    </tr>
                                    @empty($item)
                                        <tr>
                                            <td colspan="5">Data Kendaraan tidak ditemukan</td>
                                        </tr>
                                    @endempty
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- {!! $pemeriksaan->links() !!} --}}
                </div>
            </div>
        </div>
    </div>
@endsection
