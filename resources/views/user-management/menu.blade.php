@extends('layouts.app') @section('title', 'Manajemen User | Menu')
@section('content')
<div class="card shadow mb-2">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Manajemen User | Menu</h6>
    </div>
    <div class="card-body">
        @if (session('success'))
        <p>{{ session('success') }}</p>
        @endif
        <button type="button" class="btn btn-success btn-circle" data-toggle="modal" data-target="#menuModal">
            <i class="fas fa-plus"></i>
        </button>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>URI</th>
                </tr>
            </thead>
            <tbody>
                @foreach($routesInfo as $key => $route)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $route["uri"] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Modal Menu --}}
<div class="modal fade" id="menuModal" tabindex="-1" role="dialog" aria-labelledby="menuModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="menuModal">Manajeman Menu</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <form action="{{ route('menu.add') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Menu</label>
                        <input type="text" name="menu" class="form-control" placeholder="Tulis Menu" />
                    </div>
                    <div class="form-group">
                        <label for="">Jenis Menu</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch1" />
                            <label class="custom-control-label" for="customSwitch1">Parent</label>
                            <input type="hidden" id="switchValue" name="switchValue" value="P" />
                        </div>
                    </div>
                    <div class="form-group" id="urlDropdown" style="display: none;">
                        <label for="">Parent</label>
                        <select name="parent_id" class="form-control">
                            <option> Pilih </option>
                            @foreach($parent as $key => $list)
                            <option value="{{ $list->id }}">{{ $list->type }} - {{ $list->menu }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Sub Menu</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="subMenu" />
                            <label class="custom-control-label" for="subMenu">Tidak</label>
                            <input type="hidden" id="subMenuValue" name="subMenuValue" value="0" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">URL</label>
                        <select name="url" class="form-control">
                            <option> Pilih </option>
                            @foreach($routesInfo as $key => $route)
                            <option value="{{ $route["uri"] }}">{{ $route["uri"] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Icon</label>
                        <input type="text" name="icon" class="form-control" placeholder="Masukkan Icon" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">
                        Tutup
                    </button>
                    <button class="btn btn-primary" type="submit">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.getElementById("customSwitch1").addEventListener("change", function() {
        var label = document.querySelector('label[for="customSwitch1"]');
        var hiddenInput = document.getElementById("switchValue");
        var urlDropdown = document.getElementById("urlDropdown");

        if (this.checked) {
            label.textContent = "Children";
            hiddenInput.value = "C";
            urlDropdown.style.display = "block";
        } else {
            label.textContent = "Parent";
            hiddenInput.value = "P";
            urlDropdown.style.display = "none";
        }
    });


    document.getElementById("subMenu").addEventListener("change", function() {
        var label = document.querySelector('label[for="subMenu"]');
        var hiddenInput = document.getElementById("subMenuValue");

        if (this.checked) {
            label.textContent = "Ya";
            hiddenInput.value = "1";
        } else {
            label.textContent = "Tidak";
            hiddenInput.value = "0";
        }
    });

</script>

@endsection
