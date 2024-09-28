<?php

include "koneksi.php";

$id_author=$_GET['id'];

$query=mysqli_query($conn,"DELETE FROM author WHERE id_author='$id_author'") or die(mysqli_error($conn));

if($query)
{
	echo "<script>alert('Data Author Berhasil dihapus..!!')</script>";
    echo "<script>window.location.href='../../main.php?modul=satuan';</script>";
	
}
else
{
	echo "Gagal Menghapus Data Satuan";
}
?>