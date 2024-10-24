@extends('layouts.app')

@section('title', 'Form Anggota')

@section('contents')
<div class="container">
    <form action="{{ route('admin.update', $admin->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Username -->
        <div class="mb-3">
            <label for="name" class="form-label">Username</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Nama Depan" value="{{ $admin->name }}" required>
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword" placeholder="Password" required>
            @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <!-- Role -->
        <div class="col-md-6 mb-3">
            <label for="role" class="form-label">Role</label>
            <select name="role" class="form-select" id="role" required>
                @foreach ($role as $key => $value)
                <option value="{{ $key }}" {{ $key == $admin->role ? 'selected' : '' }}>{{ $value }}</option>
                @endforeach
            </select>
        </div>

        <!-- Save and Cancel Buttons -->
        <div class="d-flex align-items-center">
            <button type="submit" class="btn btn-primary mr-3">Save</button>
            <button type="reset" class="btn btn-secondary">Cancel</button>
        </div>
    </form>
</div>
@endsection
