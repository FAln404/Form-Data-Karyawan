<?php include 'koneksi.php';?>
#Ardi Kurniawan

<html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Karyawan</title>
</head>
<style>
  body{background:#d3d3d3; font-family:Arial; font-size:13px}
  .frame{width:650px; margin:20px auto; background:#f0f0f0; border:2px solid #999; padding:15px}
  .judul{text-align:center; font-weight:bold; font-size:18px; margin-bottom:10px; border-bottom:1px solid #999; padding-bottom:10px}
  .kiri{float:left; width:400px}
  .kanan{float:right; width:150px}
  .kanan button{width:100px; margin-bottom:8px; padding:5px}
  label{display:inline-block; width:120px; margin:5px 0}
  input, select{width:180px; padding:3px}
  table{width:100%; background:white; border-collapse:collapse; margin-top:15px}
  th,td{border:1px solid black; padding:4px; font-size:12px}
  .clear{clear:both}
</style>

<body>
<div class="frame">
    <div class="judul">Form Data Karyawan</div>
    <form id="formKaryawan" method="post">
        <div class="kiri">
            <label>NIK</label><input type="text" name="nik" id="nik"><br>
            <label>Nama Karyawan</label><input type="text" name="nama" id="nama"><br>
            <label>Jabatan</label>
            <select name="jabatan" id="">
                <option>IT Engineer</option>
                <option>HRD</option>
                <option>Finance</option>
                <option>Marketing</option>
            </select>
            <label>Alamat</label><input type="text" name="alamat" id="alamat"><br>
            <label>Email</label><input type="text" name="email" id="email"><br>
            <label>NO. telpon</label><input type="text" name="telpon" id="telpon"><br>
        </div>
        <div class="kanan">
            <button type="button" onclick="tambahData()">Tambah Data</button><br>
            <button type="submit" name="simpan">Simpan</button><br>
            <button type="submit" name="edit">Edit</button><br>
            <button type="submit" name="hapus">Hapus</button><br>
            <button type="button" onClick="batal()">batal</button><br>
            <button type="button" onClick="keluar()">Keluar</button><br>
        </div>
        <div class="clear"></div>
    </form>

    <table border="1" width="100%" cellpadding="5">
        <tr>
            <th>No.</th>
            <th>NIK</th>
            <th>Nama Karyawan</th>
            <th>Jabatan</th>
            <th>Alamat</th>
            <th>Email</th>
            <th>No. telepon</th>
        </tr>
        
    <?php
        $no=1; $q=mysqli_query($conn, "SELECT * FROM karyawan");
        while($d=mysqli_fetch_array($q)){
            echo "<tr onclick=\"pilih('$d[nik]','$d[nama_karyawan]','$d[jabatan]','$d[alamat]','$d[email]','$d[no_telpon]')\" style='cursor:pointer'>
            <td>$no</td><td>$d[nik]</td><td>$d[nama_karyawan]</td><td>$d[jabatan]</td><td>$d[alamat]</td><td>$d[email]</td><td>$d[no_telpon]</td></tr>";
            $no++;
        }

        ?>
    </table>

</div>

<script>
function tambahData(){
    document.getElementById('formKaryawan').reset();
    document.getElementById('nik').focus();
}
function batal(){ tambahData();}
function keluar(){
    if(confirm('Yakin mau keluar?'))window.close();
}

function pilih(nik,nama,jabatan,alamat,email,telp){
    document.getElementById('nik').value=nik;
    document.getElementById('nama').value=nama;
    document.getElementById('jabatan').value=jabatan;
    document.getElementById('alamat').value=alamat;
    document.getElementById('email').value=email;
    document.getElementById('telpon').value=telp;
}

</script>


<?php

if(isset($_POST['simpan'])){
    mysqli_query($conn,"INSERT INTO karyawan VALUES ('$_POST[nik]','$_POST[nama]','$_POST[jabatan]','$_POST[alamat]','$_POST[email]','$_POST[telpon]')");
    echo "<script>location='index.php'</script>";
}
if(isset($_POST['edit'])){
    mysqli_query($conn,"UPDATE karyawan SET nama_karyawan='$_POST[nama]',jabatan='$_POST[jabatan]',alamat='$_POST[alamat]',email='$_POST[email]',no_telpon='$_POST[telpon]' WHERE nik='$_POST[nik]'");
    echo "<script>location='index.php'</script>";
}
if(isset($_POST['hapus'])){
    mysqli_query($conn,"DELETE FROM karyawan WHERE nik='$_POST[nik]'");
    echo "<script>location='index.php'</script>";
}

?>


    
</body>
</html>
