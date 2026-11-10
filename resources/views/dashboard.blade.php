@extends('layouts.app')

@section('title', 'Dashboard')
@section('heading', 'Dashboard')
@section('subtitle', 'Selamat datang, ' . session('user.nama') . '.')

@section('content')
<div class="summary">
    <div class="cell">
        <div class="label">Total donasi terkumpul</div>
        <div class="value">Rp {{ number_format($totalTerkumpul, 0, ',', '.') }}</div>
    </div>
    <div class="cell">
        <div class="label">Jumlah donatur</div>
        <div class="value">{{ number_format($totalDonatur, 0, ',', '.') }} orang</div>
    </div>
    <div class="cell">
        <div class="label">Program berjalan</div>
        <div class="value">{{ $programAktif }} program</div>
    </div>
</div>

<div class="box">
    <h2>Program yang sedang berjalan</h2>
    @foreach ($program as $p)
        <div class="item">
            <strong>{{ $p['judul'] }}</strong>
            <div class="muted">Batas waktu {{ $p['batas'] }}</div>
            <div class="rincian">
                <span>Donatur: <b>{{ $p['donatur'] }} orang</b></span>
                <span>Uang terkumpul: <b>Rp {{ number_format($p['terkumpul'], 0, ',', '.') }}</b></span>
                <span>Target: <b>Rp {{ number_format($p['target'], 0, ',', '.') }}</b></span>
            </div>
        </div>
    @endforeach
</div>

<div class="box">
    <h2>Donasi terbaru</h2>
    <div class="scroll">
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Donatur</th>
                    <th>Program</th>
                    <th class="num">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($donasiTerbaru as $d)
                    <tr>
                        <td>{{ $d['tanggal'] }}</td>
                        <td>{{ $d['nama'] }}</td>
                        <td>{{ $d['program'] }}</td>
                        <td class="num">Rp {{ number_format($d['jumlah'], 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
