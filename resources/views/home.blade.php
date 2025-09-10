<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h2>Halo, {{ $admin->role }} {{ $admin->username }}</h2>
    <a href="{{ route('logout') }}">Logout</a>

    {{-- Jika role = guru --}}
    @if ($admin->role === 'guru')
        <p>Nama : {{ $admin->guru->nama ?? 'Belum diisi' }}</p>
        <p>Mapel : {{ $admin->guru->mapel ?? 'Belum diisi' }}</p>

        {{-- Jika guru adalah walas --}}
         @if (!empty($isWalas) && !empty($walas))
            <h3>Wali Kelas {{ $walas->jenjang }} {{ $walas->namakelas }} ({{ $walas->tahunajaran }})</h3>
            <ul>
                @foreach($walas->kelas as $k)
                    <li>
                        {{ $k->siswa->nama }} 
                        (TB: {{ $k->siswa->tb }}, BB: {{ $k->siswa->bb }})
                    </li>
                @endforeach
            </ul>
        @endif
    @endif

    {{-- Jika role = siswa --}}
    @if ($admin->role === 'siswa' && $admin->siswa)
        <p>Nama : {{ $admin->siswa->nama ?? 'Belum diisi' }}</p>
        <p>BB : {{ $admin->siswa->bb ?? 'Belum diisi' }}</p>
        <p>TB : {{ $admin->siswa->tb ?? 'Belum diisi' }}</p>

        {{-- Tampilkan kelas & wali kelas --}}
        @if (!empty($kelas))
            <h3>Kelas: {{ $kelas->walas->jenjang }} {{ $kelas->walas->namakelas }}</h3>
            <p>Wali Kelas: {{ $kelas->walas->guru->nama }}</p>
        @endif
    @endif

    {{-- Jika role = admin --}}
    @if ($admin->role === 'admin')
        <h2>Daftar Siswa</h2>
        <a href="{{ route('siswa.create') }}">
            <button>+ Tambah Siswa</button>
        </a>
        <table border="1" cellpadding="8">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tinggi Badan</th>
                    <th>Berat Badan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($siswa as $i => $s)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $s->nama }}</td>
                    <td>{{ $s->tb }}</td>
                    <td>{{ $s->bb }}</td>
                    <td>
                        <a href="{{ route('siswa.edit', $s->idsiswa) }}">Edit</a> |
                        <a href="{{ route('siswa.delete', $s->idsiswa) }}" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>
