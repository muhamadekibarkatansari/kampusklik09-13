<?php
    include "koneksi.php";

    $id = $_GET['id'];

    $proses = mysqli_query($koneksi,"DELETE FROM mahasiswa WHERE id = $id") 
                or die (mysqli_error($koneksi));

        if($proses){
            echo "
                    <script>
                        alert('Data Berhasil Dihapus');
                        window.location.href='form.php';
                        </script>";
        } else echo "<script>
                        alert('Data Gagal Dihapus');
                        window.location.href='form.php';
                    </script>";

?>