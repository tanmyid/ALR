@extends('layouts.app')
@section('title', 'Manajemen User | Role')
@section('content')
    <h1 class="h3 mb-4 text-gray-800">Manajemen User | Role</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
        </div>
        @if (session('success'))
            <p>{{ session('success') }}</p>
        @endif
        <div class="card-body">
            <button type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target="#addRole">
                <i class="fas fa-plus"></i>
            </button>
            <table class="mt-4 table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Role</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $data)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $data->role }}</td>
                            <td>{{ $data->desc }}</td>
                            <td>
                                <button class="btn btn-warning" type="button" data-toggle="modal" data-target="#editRole{{ $data->id }}">Edit</button>
                                <form action="{{ route('role.del', $data->id) }}" method="POST" onsubmit="return confirmDelete();">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        <div class="modal fade" id="editRole{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="editRole{{ $data->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editRole{{ $data->id }}">Edit Role</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true"><i class="fas fa-times"></i></span>
                                        </button>
                                    </div>
                                    <form action="{{ route('role.edit', $data->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="role">Role</label>
                                                <input type="text" name="role" class="form-control" required value="{{ $data->role }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="role">Deskripsi</label>
                                                <textarea name="deskripsi" class="form-control" cols="30" rows="10">{{ $data->desc }}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Tutup</button>
                                            <button class="btn btn-primary" type="submit">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- Modal --}}
    <div class="modal fade" id="addRole" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahRole">Tambah Role</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                </div>
                <form action="{{ route('role.add') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="role">Role</label>
                            <input type="text" name="role" class="form-control" required placeholder="Masukkan Role">
                        </div>
                        <div class="form-group">
                            <label for="role">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Tutup</button>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function confirmDelete() {
            return confirm('Apakah Anda yakin ingin menghapus data ini?');
        }
    </script>
@endsection
