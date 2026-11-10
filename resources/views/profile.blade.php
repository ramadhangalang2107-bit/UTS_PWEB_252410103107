@extends('layouts.app')

@section('title', 'Profil')

@section('heading', 'Profil')
@section('subtitle', 'Data akun yang sedang masuk.')

@section('content')
<div class="box">
    <dl class="info">
        <dt>Nama</dt>
        <dd>{{ $akun['nama'] }}</dd>

        <dt>Peran</dt>
        <dd>{{ $akun['peran'] }}</dd>

        <dt>Username</dt>
        <dd>{{ $akun['username'] }}</dd>

        <dt>Telepon</dt>
        <dd>{{ $akun['telepon'] }}</dd>

        <dt>Lembaga</dt>
        <dd>{{ $akun['lembaga'] }}</dd>

        <dt>Alamat</dt>
        <dd>{{ $akun['alamat'] }}</dd>

        <dt>Bergabung sejak</dt>
        <dd>{{ $akun['bergabung'] }}</dd>
    </dl>
</div>
@endsection
