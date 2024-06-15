<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Pencarian</title>
</head>
<body>
    <form action="cari_data.php" method="GET">
        <label for="NPM">NPM:</label>
        <input type="text" id="id" name="npm">
        <label for="nama_mahasiswa">Nama Belakang:</label>
        <input type="text" id="nama_mahasiswa" name="nama">
        <label for="prodi">Prodi:</label>
        <input type="text" id="prodi" name="prodi">
        <button type="submit">Cari</button>
    </form>
    <script>
    function validateSearch() {
        var searchInput = document.getElementById('search').value;

        if (searchInput === '') {
            return true; // allow empty search
        }

        if (!/^\d+$/.test(searchInput)) {
            alert('NPM harus angka');
            return false;
        }
        
        if (searchInput.length < 13) {
            alert('NPM kurang dari 13 angka');
            return false;
        }
        
        if (searchInput.length > 13) {
            alert('Digit NPM lebih dari 13 angka');
            return false;
        }

        return true;
    }
    </script>
</body>
</html>
