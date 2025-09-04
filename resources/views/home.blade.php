<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
</head>
<body>
    <h2>Halo, {{ $admin->role }} {{ $admin->username }}</h2>
    <a href="{{ route('logout') }}">Logout</a>

    {{-- Jika role = guru --}}
    @if ($admin->role === 'guru')
        <p>Nama : {{ $admin->guru->nama ?? 'Belum diisi' }}</p>
        <p>Mapel : {{ $admin->guru->mapel ?? 'Belum diisi' }}</p>
    @endif

    {{-- Jika role = siswa --}}
    @if ($admin->role === 'siswa')
        <p>Nama : {{ $admin->siswa->nama ?? 'Belum diisi' }}</p>
        <p>BB : {{ $admin->siswa->bb ?? 'Belum diisi' }}</p>
        <p>TB : {{ $admin->siswa->tb ?? 'Belum diisi' }}</p>
    @endif

    <h2>Daftar Siswa</h2>

    {{-- Tombol CRUD hanya untuk admin --}}
    @if ($admin->role === 'admin')
        <a href="{{ route('siswa.create') }}">
            <button>+ Tambah Siswa</button>
        </a>
    @endif

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tinggi Badan</th>
                <th>Berat Badan</th>
                @if ($admin->role === 'admin')
                    <th>Aksi</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($siswa as $i => $s)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $s->nama }}</td>
                <td>{{ $s->tb }}</td>
                <td>{{ $s->bb }}</td>
                @if ($admin->role === 'admin')
                    <td>
                        <a href="{{ route('siswa.edit', $s->id) }}">Edit</a> |
                        <a href="{{ route('siswa.delete', $s->id) }}" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
