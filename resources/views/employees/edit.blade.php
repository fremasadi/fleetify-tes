@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Karyawan</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('employees.update', $employee) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" value="{{ $employee->user->name }}" class="form-control" disabled>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="text" value="{{ $employee->user->email }}" class="form-control" disabled>
                </div>

                <div class="form-group">
                    <label>Departemen</label>
                    <select name="departement_id" class="form-control" required>
                        @foreach(\App\Models\Departement::all() as $departement)
                            <option value="{{ $departement->id }}" {{ $employee->departement_id == $departement->id ? 'selected' : '' }}>
                                {{ $departement->departement_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="address" class="form-control">{{ $employee->address }}</textarea>
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Update
                </button>
                <a href="{{ route('employees.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
