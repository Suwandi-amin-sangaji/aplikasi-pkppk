@extends('layouts.template_petugas')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">Pemeriksaan Kendaraan</h5>

                <div class="card-body">


                    <button class="btn btn-primary btn-sm mb-4" id="startScannerBtn">Start Scanner</button>
                    <a href="{{ route('pemeriksaan-kendaraan.create') }}" class="btn btn-primary btn-sm mb-4">Tambah
                        Data</a>
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
                                @foreach ($pemeriksaan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_operator }}</td>
                                        <td>{{ $item->nama_asisten }}</td>
                                        <td>{{ $item->waktu }}</td>
                                        <td>{{ $item->tanggal }}</td>
                                        @if ($item->status == 'baru')
                                            <td><span class="badge bg-label-warning me-1">{{ $item->status }}</span></td>
                                        @else
                                        <td><span class="badge bg-label-success me-1">{{ $item->status }}</span></td>
                                        @endif
                                        <td>
                                            <a href="{{ route('pemeriksaan-kendaraan.show', $item->id) }}"
                                                class="btn btn-secondary btn-sm"><i class="fa fa-eye"> </i></a>

                                                <a href="{{ route('cetak-laporan-petugas.cetak', $item->id) }}"
                                                    class="btn btn-danger btn-sm"><i class="fa fa-print"> </i></a>
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
                    {!! $pemeriksaan->links() !!}

                </div>
                <div class="row">
                    <div class="col-6-lg">
                        <div id="reader"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
