<!DOCTYPE html>
<html lang="en">
<?php error_reporting(0); ?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Author</title>

    <meta name="description" content="Pengelolaan Publikasi TEKNOIF">
    <meta name="author" content="Anisya">

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style type="text/css">
    .style15 {
        color: #2DB450;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12px;
    }

    .style16 {
        color: #2DB450;
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;

        font-size: 24px;
    }

    .bod {
        border-radius: 1cm;
    }
    </style>

</head>

<body>
    <div class="container">

        <?php
        include "koneksi.php";

        switch ($_GET['act']) {
            default:
        ?>
        <div class="page-header">
            <h1><img width="70px" src="imgauthor.png" alt="...">Data Author</h1>
        </div>
        <div class="panel panel-default">
            <?php  ?>
            <div class="panel-body">
                <table cellpadding="0" cellspacing="0" border="1" class="table table-striped table-bordered"
                    id="basic-datatable">
                    <div class="panel-heading"><a href="?modul=satuan&act=add" class="btn btn-primary">Tambah Data </a>
                    </div>
                    <div class="panel-body">
                        <table cellpadding="0" cellspacing="0" border="1" class="table table-striped table-bordered"
                            id="basic-datatable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>ID Author</th>
                                    <th>Nama</th>
                                    <th>Prodi</th>
                                    <th>Afiliasi</th>
                                    <th>Email</th>
                                    <th>WA</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                        $no = 1;
                                        $query = mysqli_query($conn, "SELECT * FROM author ORDER BY id_author ASC") or die(mysqli_error($conn));
                                        while ($row = mysqli_fetch_array($query)) {
                                        ?>
                                <tr class="odd gradeX">
                                    <td align="center"><?php echo $no; ?></td>
                                    <td align="center"><?php echo $row['id_author']; ?></td>
                                    <td align="center"><?php echo $row['nama_author']; ?></td>
                                    <td align="center"><?php echo $row['prodi']; ?></td>
                                    <td align="center"><?php echo $row['afiliasi']; ?></td>
                                    <td align="center"><?php echo $row['email']; ?></td>
                                    <td align="center"><?php echo $row['wa']; ?></td>
                                    <td align="center"><a href="?act=edit&idauthor=<?php echo $row['id_author']; ?>"> <i
                                                title="rubah" class="fa fa-edit">edit</i></a> |
                                        <a href="hapus.php?id=<?php echo $row['id_author']; ?>"
                                            onclick="return confirm('Are you sure you want to Remove?');"> <i
                                                title="hapus" class="fa fa-trash">hapus</i></a>
                                    </td>
                                </tr>
                                <?php $no++;
                                        } ?>
                                <!-- Akhir While-->
                            </tbody>
                        </table>
                    </div>
            </div>
            <?php

                break;
            case "add":

                $queryPeriksa = mysqli_query($conn, "SELECT * FROM author");
                $di = 1;
                $tot = array();
                while ($row = mysqli_fetch_row($queryPeriksa)) {
                    $tot[$di] = str_replace('AU000', '', $row[0]);
                    $di++;
                }
                if (count($tot) == 0) {
                    $akhir = 1;
                } else {
                    $akhir = max($tot);
                    $akhir++;
                }
                $kode = "AU000" . $akhir;

                ?>
            <script language='javascript'>
            function validAngka(a) {
                if (!/^[0-9.]+$/.test(a.value)) {
                    a.value = a.value.substring(0, a.value.length - 1000);
                }
            }

            function validHuruf(b) {
                if (!/^[a-zA-Z ]+(([\'\,\.\-\ ][a-zA-Z ])?[a-zA-Z]*)*$/.test(b.value)) {
                    b.value = b.value.substring(0, b.value.length - 1000);
                }
            }
            //var namaValid    = /^[a-zA-Z]+(([\'\,\.\- ][a-zA-Z ])?[a-zA-Z]*)*$/;
            function isNumberKey(evt) {
                var charCode = (evt.which) ? evt.which : event.keyCode
                if ((charCode < 65) || (charCode == 32))
                    return false;
                return true;
            }

            // function validasiEmail() {
            //     var rs = document.forms["formInput"]["email"].value;
            //     var atps = rs.indexOf("@");
            //     var dots = rs.lastIndexOf(".");
            //     if (atps < 1 || dots < atps + 2 || dots + 2 >= rs.length) {
            //         alert("Alamat email tidak valid.");
            //         return false;
            //     } else {
            //         alert("Alamat email valid.");
            //     }
            //}
            function validateEmail(x) {
                var test = x.Email.value.indexOf("@")
                //if didn't find @
                if (test == -1) {
                    errorStr = errorStr + "Please enter a valid E-Mail.\n\n"
                    trueOrFalse = false
                }
                //if @ is the first character
                if (test == 0) {
                    errorStr = errorStr +
                        "The E-Mail you have Entered is not valid. The '@' can't be the first Character.\n\n"
                    trueOrFalse = false
                }
                //if @ is the last character
                if (test == (x.Email.value.length - 1)) {
                    errorStr = errorStr +
                        "The E-Mail you have Entered is not valid. The '@' can't be the last Character.\n\n"
                    trueOrFalse = false
                }
            }
            </script>
            <div class="page-header">
                <h1>Data Author</h1>
            </div>

            <div class="row">

                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Input Data Author</div>
                        <div class="panel-body">

                            <form class="form-horizontal" role="form" action="simpan.php" method="POST">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">ID Author</label>
                                    <div class="col-sm-7">
                                        <input type="text" onkeyUp='' title="" class="form-control form-control-flat"
                                            autofocus placeholder='ID Author' maxlength="17" name="id_author"
                                            value="<?php echo $kode; ?>" required>
                                    </div>
                                </div>
                                <hr class="dotted">

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Nama Author</label>
                                    <div class="col-sm-7">
                                        <textarea type="text" onkeyUp='validHuruf(this)' title=""
                                            class="form-control form-control-flat" autofocus placeholder='Nama Author'
                                            maxlength="50" name="nama_author" value="" required></textarea>
                                        <!--onKeyPress="return goodchars(event,'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ ',this)
                                      
                                      onkeyup='return isNumberKey(event)'-->
                                    </div>
                                </div>
                                <hr class="dotted">

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Prodi</label>
                                    <div class="col-sm-7">
                                        <textarea type="text" onkeyUp='validHuruf(this)' title=""
                                            class="form-control form-control-flat" autofocus placeholder='Prodi'
                                            maxlength="45" name="prodi" value="" required></textarea>
                                    </div>
                                </div>
                                <hr class="dotted">

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Afiliasi</label>
                                    <div class="col-sm-7">
                                        <textarea type="text" onkeyUp='validHuruf(this)' title=""
                                            class="form-control form-control-flat" autofocus placeholder='Afiliasi'
                                            maxlength="100" name="afiliasi" value="" required> </textarea>

                                    </div>
                                </div>
                                <hr class="dotted">

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-7">
                                        <textarea type="text" onkeyUp='validateEmail(this)' title=""
                                            class="form-control form-control-flat" autofocus placeholder='Email'
                                            maxlength="" name="email" value="" required></textarea>
                                        <!--onKeyPress="return goodchars(event,'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ ',this)
                                      
                                      onkeyup='return isNumberKey(event)'-->
                                    </div>
                                </div>
                                <hr class="dotted">

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">WA</label>
                                    <div class="col-sm-7">
                                        <input type="text" onkeyUp='validAngka(this)' title=""
                                            class="form-control form-control-flat" autofocus placeholder='WA'
                                            maxlength="17" name="wa" value="">
                                    </div>
                                </div>
                                <hr class="dotted">

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-7">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <button type="button" class="btn btn-danger"
                                            onclick=location.href='?modul=satuan'>Batal</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>

            </div>

            <?php
                //Case untuk Mengedit Data.
                break;
            case "edit":

                $id = $_GET['idauthor'];

                $q = mysqli_query($conn, "SELECT * FROM author WHERE id_author='$id'") or die(mysqli_error($conn));
                $row = mysqli_fetch_array($q);

                ?>

            <div class="page-header">
                <h1>Data Author</h1>
            </div>

            <div class="row">

                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Ubah Data Author</div>
                        <div class="panel-body">

                            <form class="form-horizontal" role="form" action="ubah.php" method="POST">
                                <input type="hidden" name="id_author" value="<?php echo $row['id_author']; ?>">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">ID Author</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control form-control-flat" name="id_author"
                                            value="<?php echo $row['id_author']; ?>" disabled>
                                    </div>
                                </div>
                                <hr class="dotted">

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Nama Author</label>
                                    <div class="col-sm-7">
                                        <input type="text" onkeyup="validHuruf(this)"
                                            class="form-control form-control-flat" maxlength="" name="nama_author"
                                            value="<?php echo $row['nama_author']; ?>" required>
                                    </div>
                                </div>
                                <hr class="dotted">

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Prodi</label>
                                    <div class="col-sm-7">
                                        <textarea type="text" onkeyUp='validHuruf(this)' title=""
                                            class="form-control form-control-flat" autofocus placeholder='Prodi'
                                            maxlength="45" name="prodi" value=""
                                            required><?php echo $row['prodi']; ?></textarea>
                                        <!--onKeyPress="return goodchars(event,'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ ',this)
              
              onkeyup='return isNumberKey(event)'-->
                                    </div>
                                </div>
                                <hr class="dotted">

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Afiliasi</label>
                                    <div class="col-sm-7">
                                        <textarea type="text" onkeyUp='validHuruf(this)' title=""
                                            class="form-control form-control-flat" autofocus placeholder='Afiliasi'
                                            maxlength="100" name="afiliasi" value=""
                                            required><?php echo $row['afiliasi']; ?></textarea>

                                    </div>
                                </div>
                                <hr class="dotted">

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-7">
                                        <textarea type="text" onkeyUp='' title="" class="form-control form-control-flat"
                                            autofocus placeholder='Email' maxlength="" name="email" value=""
                                            required><?php echo $row['email']; ?></textarea>
                                    </div>
                                </div>
                                <hr class="dotted">

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">WA</label>
                                    <div class="col-sm-7">
                                        <input type="text" onkeyUp='validAngka(this)' title=""
                                            class="form-control form-control-flat" autofocus placeholder='WA'
                                            maxlength="17" name="wa" value="">
                                    </div>
                                </div>
                                <hr class="dotted">

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-7">
                                        <button type="submit" class="btn btn-primary">Ubah</button>
                                        <button type="button" class="btn btn-danger"
                                            onclick=location.href='?modul=satuan'>Batal</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php } //Tutup Kurung Switch pada baris
            ?>
</body>

</html>