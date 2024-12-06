@if (!Auth::check() || (Auth::user()->role !== 'keuangan' && Auth::user()->role !== 'super'))
    {{-- Redirect pengguna kembali --}}
    <script>
        window.location.href = "{{ url()->previous() }}";
    </script>
    @php
        exit;
    @endphp
@endif

@extends('layouts.appUang')
  
@section('title', 'Selamat Datang Admin Keuangan')
  
@section('contents')

@endsection