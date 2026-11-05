<h2>Tambah Data Penyewa Baru</h2>
<form action="index.php?controller=penyewa&action=tambah" method="POST">
    <div>
        <label>Username (user_plg):</label><br>
        <input type="text" name="user_plg" required>
    </div><br>

    <div>
        <label>Password:</label><br>
        <input type="password" name="sandi" required>
    </div><br>

    <div>
        <label>NIK:</label><br>
        <input type="text" name="nik" required>
    </div><br>

    <div>
        <label>Nama Lengkap:</label><br>
        <input type="text" name="nm_lngkp" required>
    </div><br>

    <div>
        <label>No HP:</label><br>
        <input type="text" name="no_hp" required>
    </div><br>

    <div>
        <label>Alamat Lengkap:</label><br>
        <textarea name="almt_lngkp" rows="3" required></textarea>
    </div><br>

    <button type="submit">Simpan Data</button>
    <a href="index.php?controller=penyewa&action=index">Batal</a>
</form>