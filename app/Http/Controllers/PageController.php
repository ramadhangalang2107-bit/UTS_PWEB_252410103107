<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    
    private function akun(): array
    {
        return [
            'username'  => 'Andro',
            'password'  => 'AndroPenuhBencana',
            'nama'      => 'Andro Mahesa Aprian',
            'peran'     => 'Penguasa Lumajang',
            'telepon'   => '+62 822-3155-6612',
            'lembaga'   => 'Andro Peduli Lumajang',
            'alamat'    => 'Jl. Kalimantan No. 10, Jember, Jawa Timur',
            'bergabung' => '01-01-2001',
        ];
    }

    private function program(): array
    {
        $data = [
            ['id' => 1, 'judul' => 'Bantuan Korban Banjir Lumajang',  'kategori' => 'Bencana alam', 'target' => 30000000, 'terkumpul' => 25000000, 'donatur' => 25, 'batas' => '30 Nov 2026', 'status' => 'Berjalan'],
            ['id' => 2, 'judul' => 'Beasiswa Anak Desa Lumajang',          'kategori' => 'Pendidikan',   'target' => 20000000, 'terkumpul' => 15000000, 'donatur' => 20, 'batas' => '15 Des 2026', 'status' => 'Berjalan'],
            ['id' => 3, 'judul' => 'Operasi Katarak untuk Lumajang',     'kategori' => 'Kesehatan',    'target' => 15000000, 'terkumpul' => 15000000, 'donatur' => 30, 'batas' => '20 Okt 2026', 'status' => 'Selesai'],
            ['id' => 4, 'judul' => 'Perbaikan Musala Dusun Lumajang',    'kategori' => 'Rumah ibadah', 'target' => 30000000, 'terkumpul' => 12000000, 'donatur' => 10, 'batas' => '31 Jan 2027', 'status' => 'Berjalan'],
            ['id' => 5, 'judul' => 'Sembako untuk Warga Lumajang', 'kategori' => 'Sosial',       'target' => 10000000, 'terkumpul' => 10000000, 'donatur' => 15, 'batas' => '30 Sep 2026', 'status' => 'Selesai'],
            ['id' => 6, 'judul' => 'Sumur Bor Desa Lumajang',      'kategori' => 'Air bersih',   'target' => 25000000, 'terkumpul' => 10000000, 'donatur' => 15, 'batas' => '28 Feb 2027', 'status' => 'Berjalan'],
        ];

        return $data;
    }

    private function donasi(): array
    {
        return [
            ['nama' => 'Andre',    'program' => 'Bantuan Korban Banjir Lumajang', 'jumlah' => 300000,  'tanggal' => '9 Nov 2026', 'metode' => 'Transfer bank'],
            ['nama' => 'Andra',     'program' => 'Beasiswa Anak Desa Lumajang',         'jumlah' => 500000,  'tanggal' => '9 Nov 2026', 'metode' => 'QRIS'],
            ['nama' => 'Andri',    'program' => 'Sumur Bor Desa Lumajang',     'jumlah' => 100000,  'tanggal' => '8 Nov 2026', 'metode' => 'E-wallet'],
            ['nama' => 'Andru',     'program' => 'Perbaikan Musala Dusun Lumajang',   'jumlah' => 250000,  'tanggal' => '7 Nov 2026', 'metode' => 'Transfer bank'],
            ['nama' => 'Indri',  'program' => 'Bantuan Korban Banjir Lumajang', 'jumlah' => 150000,  'tanggal' => '7 Nov 2026', 'metode' => 'QRIS'],
            ['nama' => 'Indra',     'program' => 'Beasiswa Anak Desa Lumajang',         'jumlah' => 200000,  'tanggal' => '6 Nov 2026', 'metode' => 'E-wallet'],
            ['nama' => 'Indru',   'program' => 'Sumur Bor Desa Lumajang',     'jumlah' => 1000000, 'tanggal' => '5 Nov 2026', 'metode' => 'Transfer bank'],
            ['nama' => 'Indar', 'program' => 'Perbaikan Musala Dusun Lumajang',   'jumlah' => 50000,   'tanggal' => '4 Nov 2026', 'metode' => 'QRIS'],
        ];
    }

    /* ---------- Akses halaman ---------- */

    private function sudahLogin(): bool
    {
        return session()->has('user');
    }

    public function login()
    {
        if ($this->sudahLogin()) {
            return redirect()->route('dashboard');
        }

        return view('login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username harus diisi.',
            'password.required' => 'Kata sandi harus diisi.',
        ]);

        $akun = $this->akun();

        if ($request->username !== $akun['username'] || $request->password !== $akun['password']) {
            return back()->withInput($request->only('username'))
                         ->withErrors(['username' => 'Username atau kata sandi salah.']);
        }

        $request->session()->regenerate();
        session(['user' => ['nama' => $akun['nama'], 'username' => $akun['username']]]);

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function dashboard()
    {
        if (! $this->sudahLogin()) {
            return redirect()->route('login');
        }

        $program = $this->program();
        $donasi  = $this->donasi();

        return view('dashboard', [
            'totalTerkumpul' => array_sum(array_column($program, 'terkumpul')),
            'totalDonatur'   => array_sum(array_column($program, 'donatur')),
            'programAktif'   => count(array_filter($program, fn ($p) => $p['status'] === 'Berjalan')),
            'program'        => array_values(array_filter($program, fn ($p) => $p['status'] === 'Berjalan')),
            'donasiTerbaru'  => array_slice($donasi, 0, 5),
        ]);
    }

    public function pengelolaan(Request $request)
    {
        if (! $this->sudahLogin()) {
            return redirect()->route('login');
        }

        $status  = $request->query('status');
        $program = $this->program();

        if (in_array($status, ['Berjalan', 'Selesai'], true)) {
            $program = array_values(array_filter($program, fn ($p) => $p['status'] === $status));
        } else {
            $status = null;
        }

        return view('pengelolaan', [
            'program' => $program,
            'donasi'  => $this->donasi(),
            'status'  => $status,
        ]);
    }

    public function profile()
    {
        if (! $this->sudahLogin()) {
            return redirect()->route('login');
        }

        return view('profile', ['akun' => $this->akun()]);
    }
}
