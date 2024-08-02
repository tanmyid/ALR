@extends('layouts.app')
@section('title', 'Manajemen User')
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
        <button type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target="#addUser">
            <i class="fas fa-plus"></i>
        </button>
        <table class="mt-4 table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    {{-- <th>Password</th> --}}
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data_user as $key => $user)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    {{-- <td>{{ $user->password }}</td> --}}
                    <td>{{ $user->status === 0 ? 'Non-Aktif' : 'Aktif' }}</td>

                    <td>
                        <button type="submit" class="btn btn-secondary">Role</button>
                        <button class="btn btn-warning" type="button" data-toggle="modal" data-target="#editRole{{ $user->id }}">Edit</button>
                        <form action="{{ route('role.del', $user->id) }}" method="POST" onsubmit="return confirmDelete();">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                <div class="modal fade" id="editRole{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="editRole{{ $user->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editRole{{ $user->id }}">Edit Role</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                                </button>
                            </div>
                            <form action="{{ route('role.edit', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <input type="text" name="role" class="form-control" required value="{{ $user->role }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="role">Deskripsi</label>
                                        <textarea name="deskripsi" class="form-control" cols="30" rows="10">{{ $user->desc }}</textarea>
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
<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahRole">Tambah User</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <form action="{{ route('user.add') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="role">Nama</label>
                        <input type="text" name="nama" class="form-control" required placeholder="Nama ...">
                    </div>
                    <div class="form-group">
                        <label for="role">Email</label>
                        <input type="email" name="email" class="form-control" required placeholder="Email ...">
                    </div>
                    <div class="form-group">
                        <label for="role">Password</label>
                        <input type="password" name="password" class="form-control" required placeholder="Password ...">
                    </div>
                    <div class="form-group">
                        <label for="">Sub Menu</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="subMenu" />
                            <label class="custom-control-label" for="subMenu">Non-Aktif</label>
                            <input type="hidden" id="subMenuValue" name="subMenuValue" value="0" />
                        </div>
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

    document.getElementById("subMenu").addEventListener("change", function() {
        var label = document.querySelector('label[for="subMenu"]');
        var hiddenInput = document.getElementById("subMenuValue");

        if (this.checked) {
            label.textContent = "Aktif";
            hiddenInput.value = "1";
        } else {
            label.textContent = "Non-Aktif";
            hiddenInput.value = "0";
        }
    });

</script>
@endsection
