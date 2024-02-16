@extends('layouts.app')

@section('tittle', 'Kegiatan')

@section('content')
    <h1>Halaman Kegiatan</h1>
    <h3>Daftar Kegiatan</h3>
    <ol>
        @foreach ($kegiatanList as $data)
        <li>{{$data->nama_kegiatan}}</li>    
        @endforeach
    <ol>
@endsection