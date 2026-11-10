<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Donasi') - Peduli Bersama</title>
    <style>
        :root {
            --laut: #0b5d82;        /* biru laut utama */
            --laut-tua: #083d57;    /* navbar, footer, judul */
            --laut-muda: #e3f0f6;   /* latar tabel, tag */
            --laut-pucat: #f1f6f9;  /* latar halaman */
            --garis: #c9dbe4;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: "Segoe UI", Tahoma, Arial, sans-serif;
            font-size: 15px;
            line-height: 1.5;
            color: #1f2d35;
            background: var(--laut-pucat);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        a { color: var(--laut); }

        /* navbar */
        .navbar { background: var(--laut-tua); }
        .navbar .inner {
            max-width: 960px; margin: 0 auto; padding: 0 20px;
            height: 54px; display: flex; align-items: center; justify-content: space-between;
        }
        .brand { font-weight: bold; font-size: 17px; color: #fff; text-decoration: none; }
        .menu { display: flex; align-items: center; gap: 22px; }
        .menu a { color: #b9d8e6; text-decoration: none; line-height: 52px; border-bottom: 3px solid transparent; }
        .menu a:hover { color: #fff; }
        .menu a.active { color: #fff; border-bottom-color: #6fc1dc; }
        .menu form { margin: 0; }
        .menu .link-btn {
            background: none; border: 0; padding: 0; font: inherit;
            color: #b9d8e6; cursor: pointer; text-decoration: underline;
        }
        .menu .link-btn:hover { color: #fff; }

        /* judul halaman */
        .judul-halaman { background: var(--laut-muda); border-bottom: 1px solid var(--garis); }
        .judul-halaman .inner { max-width: 960px; margin: 0 auto; padding: 18px 20px; }
        .judul-halaman h1 { font-size: 22px; margin: 0; color: var(--laut-tua); }
        .judul-halaman p { margin: 2px 0 0; color: #4c6674; }

        /* isi */
        .container { flex: 1; width: 100%; max-width: 960px; margin: 0 auto; padding: 24px 20px; }
        .container.tengah { display: flex; align-items: center; justify-content: center; }
        h2 { font-size: 17px; margin: 0 0 10px; color: var(--laut-tua); }

        .box { background: #fff; border: 1px solid var(--garis); padding: 16px; margin-bottom: 20px; }

        .summary { display: grid; grid-template-columns: repeat(3, 1fr); background: #fff; border: 1px solid var(--garis); margin-bottom: 20px; }
        .summary .cell { padding: 14px 16px; border-right: 1px solid var(--garis); }
        .summary .cell:last-child { border-right: 0; }
        .summary .label { color: #5b7280; font-size: 13px; }
        .summary .value { font-size: 20px; font-weight: bold; color: var(--laut); }

        table { width: 100%; border-collapse: collapse; }
        th, td { text-align: left; padding: 8px 10px; border-bottom: 1px solid #e2ebf0; font-size: 14px; vertical-align: top; }
        th { background: var(--laut-muda); color: var(--laut-tua); border-bottom: 1px solid var(--garis); }
        tbody tr:hover { background: #f6fafc; }
        td.num, th.num { text-align: right; white-space: nowrap; }
        .scroll { overflow-x: auto; }
        .muted { color: #6a808c; font-size: 13px; }

        .tag { font-size: 12px; padding: 1px 8px; border: 1px solid; }
        .tag.berjalan { background: var(--laut-muda); border-color: #8fc0d6; color: var(--laut); }
        .tag.selesai { background: #eef2f3; border-color: #b5c2c7; color: #4b5b61; }

        .filter { margin-bottom: 12px; font-size: 14px; }
        .filter a { margin-right: 14px; }
        .filter a.on { font-weight: bold; color: var(--laut-tua); text-decoration: none; }

        .item { padding: 10px 0; border-bottom: 1px solid #e2ebf0; }
        .item:last-child { border-bottom: 0; padding-bottom: 0; }
        .rincian { display: flex; flex-wrap: wrap; gap: 4px 28px; margin-top: 6px; font-size: 14px; }
        .rincian b { color: var(--laut); }

        dl.info { margin: 0; display: grid; grid-template-columns: 160px 1fr; row-gap: 8px; }
        dl.info dt { color: #5b7280; }
        dl.info dd { margin: 0; }

        /* login */
        .login-box { width: 100%; max-width: 360px; background: #fff; border: 1px solid var(--garis); }
        .login-box .kepala { background: var(--laut); color: #fff; padding: 12px 18px; }
        .login-box .kepala b { font-size: 17px; }
        .login-box .kepala div { font-size: 13px; color: #cfe6f0; }
        .login-box form { padding: 18px; }
        label { display: block; margin-bottom: 4px; font-size: 14px; }
        input[type=text], input[type=password] {
            width: 100%; padding: 8px; font-size: 14px; border: 1px solid #aebfc9; margin-bottom: 14px;
        }
        input:focus, button:focus-visible, a:focus-visible { outline: 2px solid var(--laut); outline-offset: 1px; }
        .btn { background: var(--laut); color: #fff; border: 0; padding: 9px 18px; font-size: 14px; cursor: pointer; }
        .btn:hover { background: var(--laut-tua); }
        .alert { background: #fbeeee; border: 1px solid #deb3b3; color: #8a2f2f; padding: 8px 12px; margin-bottom: 14px; font-size: 14px; }
        .hint { padding: 0 18px 16px; font-size: 13px; color: #5b7280; }

        footer { background: var(--laut-tua); text-align: center; padding: 18px 20px; color: #a9c9d8; font-size: 13px; }

        @media (max-width: 700px) {
            .summary { grid-template-columns: 1fr; }
            .summary .cell { border-right: 0; border-bottom: 1px solid var(--garis); }
            .summary .cell:last-child { border-bottom: 0; }
            .navbar .inner { height: auto; padding: 8px 20px; flex-direction: column; gap: 2px; }
            .menu a { line-height: 34px; }
            dl.info { grid-template-columns: 1fr; row-gap: 0; }
            dl.info dd { margin-bottom: 10px; }
        }
    </style>
</head>
<body>
    @if (session('user'))
        @include('components.navbar')

        <div class="judul-halaman">
            <div class="inner">
                <h1>@yield('heading', 'Peduli Bersama')</h1>
                @hasSection('subtitle')
                    <p>@yield('subtitle')</p>
                @endif
            </div>
        </div>
    @endif

    <main class="container {{ session('user') ? '' : 'tengah' }}">
        @yield('content')
    </main>

    @include('components.footer')
</body>
</html>
