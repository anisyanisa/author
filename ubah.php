<?php

    include "koneksi.php";

    $id_author=$_POST['id_author'];
    $nama_author=$_POST['nama_author'];
    $prodi=$_POST['prodi'];
    $afiliasi=$_POST['afiliasi'];
    $email=$_POST['email'];
    $wa=$_POST['wa'];
	
    /*$nama_kasir=$_POST['nama_kasir'];
    $jekel=$_POST['jekel'];
    $tempat_lahir=$_POST['tempat_lahir'];
	$tanggal_lahir=ubahFormatB($_POST['tanggal_lahir']);
    $alamat_kasir=$_POST['alamat_kasir'];
    $nohp_kasir=$_POST['nohp_kasir'];
    $tgl_bergabung=ubahFormatB($_POST['tgl_bergabung']);*/

    $b=mysqli_query($conn,"UPDATE author SET nama_author='$nama_author',prodi='$prodi',afiliasi='$afiliasi',email='$email',wa='$wa' WHERE id_author='$id_author'") or die(mysqli_error($conn));

    if($b)
    {
        echo "<script>alert('Data Author Berhasil dirubah..!!');</script>";
        echo "<script>window.location.href='../../main.php?modul=satuan';</script>";
       
    }
    else
    {
        echo "Gagal Mengubah Data Satuan.";
    }
?>