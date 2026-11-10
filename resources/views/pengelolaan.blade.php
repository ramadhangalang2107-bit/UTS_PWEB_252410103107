@extends('layouts.app')

@section('title', 'Pengelolaan')

@section('heading', 'Pengelolaan donasi')
@section('subtitle', 'Daftar program dan riwayat donasi yang masuk.')

@section('content')
<div class="box">
    <h2>Program donasi</h2>

    <div class="filter">
        <a href="{{ route('pengelolaan') }}" class="{{ $status === null ? 'on' : '' }}">Semua</a>
        <a href="{{ route('pengelolaan', ['status' => 'Berjalan']) }}" class="{{ $status === 'Berjalan' ? 'on' : '' }}">Berjalan</a>
        <a href="{{ route('pengelolaan', ['status' => 'Selesai']) }}" class="{{ $status === 'Selesai' ? 'on' : '' }}">Selesai</a>
    </div>

    <div class="scroll">
        <table>
            <thead>
                <tr>
                    <th>Program</th>
                    <th>Kategori</th>
                    <th class="num">Donatur</th>
                    <th class="num">Uang terkumpul</th>
                    <th class="num">Target</th>
                    <th>Batas</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($program as $p)
                    <tr>
                        <td>{{ $p['judul'] }}</td>
                        <td>{{ $p['kategori'] }}</td>
                        <td class="num">{{ $p['donatur'] }} orang</td>
                        <td class="num">Rp {{ number_format($p['terkumpul'], 0, ',', '.') }}</td>
                        <td class="num">Rp {{ number_format($p['target'], 0, ',', '.') }}</td>
                        <td>{{ $p['batas'] }}</td>
                        <td><span class="tag {{ strtolower($p['status']) }}">{{ $p['status'] }}</span></td>
                    </tr>
                @empty
                    <tr><td colspan="7">Tidak ada program dengan status ini.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="box">
    <h2>Riwayat donasi masuk</h2>
    <div class="scroll">
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Donatur</th>
                    <th>Program</th>
                    <th>Metode</th>
                    <th class="num">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($donasi as $d)
                    <tr>
                        <td>{{ $d['tanggal'] }}</td>
                        <td>{{ $d['nama'] }}</td>
                        <td>{{ $d['program'] }}</td>
                        <td>{{ $d['metode'] }}</td>
                        <td class="num">Rp {{ number_format($d['jumlah'], 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
