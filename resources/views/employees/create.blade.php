@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Tambah Karyawan</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('employees.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

               <input type="hidden" name="role" value="karyawan">


                <div class="form-group">
                    <label>Departemen</label>
                    <select name="departement_id" class="form-control" required>
                        @foreach(\App\Models\Departement::all() as $departement)
                            <option value="{{ $departement->id }}">{{ $departement->departement_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="address" class="form-control">{{ old('address') }}</textarea>
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="{{ route('employees.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
