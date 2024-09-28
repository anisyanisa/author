<?php

    include "koneksi.php";
    // include "../../config/ubah_tanggal.php";

    $id_author=$_POST['id_author'];
    $nama_author=$_POST['nama_author'];
    $prodi=$_POST['prodi'];
    $afiliasi=$_POST['afiliasi'];
    $email=$_POST['email'];
    $wa=$_POST['wa'];
   

    $b=mysqli_query($conn,"INSERT INTO author VALUES(' $id_author','$nama_author','$prodi','$afiliasi','$email','$wa')") or die(mysqli_error($conn));

    if($b)
    {
        echo "<script>alert('Data Author Berhasil ditambahkan..!!')</script>";
        echo "<script>window.location.href='author.php';</script>";
      
    }
    else
    {
        echo "Gagal Menyimpan Data Satuan";
    }
?>