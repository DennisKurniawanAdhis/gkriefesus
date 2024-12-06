@if (!Auth::check() || (Auth::user()->role !== 'keanggotaan' && Auth::user()->role !== 'super'))
    {{-- Redirect pengguna kembali --}}
    <script>
        window.location.href = "{{ url()->previous() }}";
    </script>
    @php
        exit;
    @endphp
@endif

@extends('layouts.appAgt')
  
@section('title', 'Selamat Datang Admin Anggota')
  
@section('contents')


@endsection

