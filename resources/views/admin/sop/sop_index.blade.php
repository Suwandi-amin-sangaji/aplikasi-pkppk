@extends('layouts.template_admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">{{ $title }}</h5>

                <div class="card-body">
                    <a href="{{ route('sop.create') }}" class="btn btn-primary btn-sm mb-4">Tambah Data</a>
                    <div class="table-responsive">
                        <table class="table  table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>title</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sop as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>
                                            {!! Form::open([
                                                'route' => ['sop.destroy', $item->id],
                                                'method' => 'DELETE',
                                                'onsubmit' => 'return confirm("Apakah anda yakin ingin menghapus data ini?")',
                                            ]) !!}

                                            <a href="{{ route('sop.show', $item->id) }}" class="btn btn-secondary btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#exLargeModal"><i class="fa fa-eye">
                                                </i></a>
                                            <a href="{{ route('sop.edit', $item->id) }}" class="btn btn-success btn-sm"><i
                                                    class="fa fa-edit"> </i></a>
                                            {{-- {!! Form::submit('Hapus', ['class' => 'btn btn-danger btn-sm']) !!} --}}
                                            <button type="submit" class="btn btn-danger btn-sm"> <i class="fa fa-trash">
                                                </i></button>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                    @empty($item)
                                        <tr>
                                            <td colspan="5">Data Sop tidak ditemukan</td>
                                        </tr>
                                    @endempty
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3 text-right">
                        {!! $sop->links() !!}
                    </div>
                </div>
            </div>


            <div class="modal fade" id="exLargeModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    @foreach ($sop as $item)
                                        <iframe src="{{ $item->file }}" frameborder="0" class="w-100"
                                            height="500"></iframe>
                                    @endforeach
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary"
                                    data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
