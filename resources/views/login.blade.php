@extends('layouts.app')

@section('title', 'Masuk')

@section('content')
<div class="login-box">
    <div class="kepala">
        <b>Peduli Bersama Andro</b>
        <div>Pengolah Uang Masyarakat</div>
    </div>

    <form action="{{ route('login.process') }}" method="POST">
        @csrf

        @if ($errors->any())
            <div class="alert">{{ $errors->first() }}</div>
        @endif

        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="{{ old('username') }}" autocomplete="username" autofocus>

        <label for="password">Kata sandi</label>
        <input type="password" id="password" name="password">

        <button type="submit" class="btn">Masuk</button>
    </form>

    <p class="hint">Contoh Akun : Andro</p>
    <p class="hint">Contoh kata sandi: AndroPenuhBencana</p>
</div>
@endsection
