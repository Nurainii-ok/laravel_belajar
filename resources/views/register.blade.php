<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <script>
        function showChoice(role) {
            let mapelInput = document.getElementById("form-guru");
            let siswaInput = document.getElementById("form-siswa");

            if (role === "guru") {
                mapelInput.style.display = "block";
                siswaInput.style.display = "none";
            } else if (role === "siswa") {
                mapelInput.style.display = "none";
                siswaInput.style.display = "block";
            } else {
                mapelInput.style.display = "none";
                siswaInput.style.display = "none";
            }
        }
    </script>
</head>
<body>
    <h2>Register</h2>
    @if(session('errors'))
        <p style="color:red">{{ session('errors') }}</p>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>

        <label>
            <input type="radio" name="role" value="admin" oninput="showChoice(this.value)" required> Admin
        </label>
        <label>
            <input type="radio" name="role" value="guru" oninput="showChoice(this.value)"> Guru
        </label>
        <label>
            <input type="radio" name="role" value="siswa" oninput="showChoice(this.value)"> Siswa
        </label>
        <br><br>

        {{-- Form tambahan untuk Guru --}}
        <div id="form-guru" style="display:none;">
            <label>Nama Guru</label><br>
            <input type="text" name="nama_guru"><br>
            <label>Mata Pelajaran</label><br>
            <input type="text" name="mapel"><br>
        </div>

        {{-- Form tambahan untuk Siswa --}}
        <div id="form-siswa" style="display:none;">
            <label>Nama Siswa</label><br>
            <input type="text" name="nama_siswa"><br>
            <label>Tinggi Badan</label><br>
            <input type="number" name="tb"><br>
            <label>Berat Badan</label><br>
            <input type="number" name="bb"><br>
        </div>

        <br>
        <button type="submit">Register</button>
    </form>
</body>
</html>
