<?php
include "koneksi.php"; 
include "tampilkan_data.php";
include "edit_data.php";

$data_edit = mysqli_fetch_assoc($proses_ambil);

// Handle search query
$search_query = "";
if (isset($_GET['search'])) {
    $search_query = $_GET['search'];
    if (!ctype_digit($search_query)) {
        echo "<script>alert('NPM harus angka');</script>";
    } elseif (strlen($search_query) < 13) {
        echo "<script>alert('NPM kurang dari 13 angka');</script>";
    } elseif (strlen($search_query) > 13) {
        echo "<script>alert('Digit NPM lebih dari 13 angka');</script>";
    } else {
        $search_query = mysqli_real_escape_string($koneksi, $search_query);
        $query = "SELECT * FROM mahasiswa WHERE  NPM LIKE '%$search_query%' OR nama_mahasiswa LIKE '%$search_query%' OR id LIKE '%$search_query%' OR prodi LIKE '%$search_query%'";
        $proses = mysqli_query($koneksi, $query);
    }
} else {
    $query = "SELECT * FROM mahasiswa";
    $proses = mysqli_query($koneksi, $query);
}
?>

<html>
<head>
    <title>Form Input Data Mahasiswa</title>

    <link href="library/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="library/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="library/assets/styles.css" rel="stylesheet" media="screen">
    <script src="library/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
</head>
        
<body>

    <div class="span9" id="content">
        <div class="row-fluid">
            <div class="block">
                <div class="navbar navbar-inner block-header">
                    <div class="muted pull-left">Input prodi Mahasiswa</div>
                </div>
                <div class="block-content collapse in">
                    <div class="span12">
                      
                    <?php
                        if (isset($_GET['NPM']) && $_GET['NPM'] != ''){
                            //proses edit data
                    ?> 
                        <form action="edit_data.php?id=<?php echo $data_edit['id'] ?>&proses=1" method="POST">
                    <?php
                        }else{
                    ?>
                      <form action="proses.php" method="POST">
                    <?php
                        }
                    ?>
                      
                          <fieldset>
                            <legend>Input prodi Mahasiswa</legend>

                            <div class="control-group">
                              <label class="control-label" for="NPM">NPM: </label>
                              <div class="controls">
                                <input type="hidden" class="input-xlarge focused" id="NPM" name="NPM" 
                                value="<?php if($data_edit['NPM'] != "") echo $data_edit['NPM'];?>">

                                <input type="text" class="input-xlarge focused" id="NPM" name="NPM" 
                                value="<?php if (isset($data_edit['NPM']) && $data_edit['NPM'] != "") echo $data_edit['NPM']; ?>">
                              </div>
                            </div>
                            <div class="control-group">
                              <label class="control-label" for="nama">NAMA MAHASISWA : </label>
                              <div class="controls">
                                <input type="hidden" class="input-xlarge focused" id="nama" name="nama" 
                                value="<?php if($data_edit['id'] != "") echo $data_edit['id'];?>">

                                <input type="text" class="input-xlarge focused" id="nama" name="nama" 
                                value="<?php if (isset($data_edit['nama_mahasiswa']) && $data_edit['nama_mahasiswa'] != "") echo $data_edit['nama_mahasiswa']; ?>">
                              </div>
                            </div>
                                
                            <div class="control-group">
                                  <label class="control-label" for="prodi">PRODI MAHASISWA : </label>
                                  <div class="controls">
                                    <input type="text" class="input-xlarge focused" id="prodi" name="prodi" 
                                    value="<?php if (isset($data_edit['prodi']) && $data_edit['prodi'] != "") echo $data_edit['prodi'];?>">
                              </div>

                            <div class="control-group">
                              <label class="control-label" for="ulangi">ULANGI : </label>
                              <div class="controls">
                                <input type="text" class="input-xlarge focused" id="ulangi" name="ulangi" value="">
                                </div>
                            </div>

                            <div class="form-actions">
                              <button type="submit" class="btn btn-primary">PROSES</button>
                              <button type="reset" class="btn">Cancel</button>
                            </div>
                    </form>

                    </div>
                    
                    <div class="row-fluid">
            <div class="block">
                <div class="navbar navbar-inner block-header">
                    <div class="muted pull-left">Data Mahasiswa</div>
                    <div class="pull-right">
                        <form class="form-inline" method="GET" action="" onsubmit="return validateSearch()">
                            <input type="text" name="search" id="search" class="input-medium" placeholder="Cari Mahasiswa" value="<?php echo htmlspecialchars($search_query); ?>">
                            <button type="submit" class="btn">Search</button>
                        </form>
                    </div>
                </div>
                <div class="block-content collapse in">
                    <div class="span12">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>NPM</th>
                              <th>Nama Mahasiswa</th>
                              <th>Prodi Mahasiswa</th>
                              <th>Aksi</th>
                            </tr>
                          </thead>
                          <tbody>

                          <?php
                                while($data = mysqli_fetch_assoc($proses)){
                          ?>

                            <tr>
                              <td><?php echo $data['NPM'] ?></td>
                              <td><?php echo $data['nama_mahasiswa'] ?></td>
                              <td><?php echo $data['prodi'] ?></td>
                              <td><a href="form.php?id=<?php echo $data['id']; ?>"> Edit </a>|
                              <a href="hapus_data.php?id=<?php echo $data['id']; ?>"> Hapus </a></td>
                            </tr>
                          <?php
                                }
                          ?>
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

                </div>
            </div>
        </div>
    </div> 

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
        if (searchInput.length  13) {
            alert('Berhasil Input');
            return false;
        }

        return true;
    }
    </script>

</body>
</html>