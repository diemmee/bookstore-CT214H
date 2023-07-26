<?php 
        include('../../data/connect.php');

    $ma_sach = $_POST['ma_Sach'];
    $tensach = $_POST['ten_sach'];
    $ma_loai = $_POST['maLoai'];
    $ma_tg = $_POST['tacGia'];
    $namxb = $_POST['namXuatBan'];
    $soluong = $_POST['soLuong'];
    $dongia = $_POST['donGia'];
    $manxb = $_POST['maNXB'];
    $hinh_anh=$_FILES['hinhanh']['name'];
    $hinh_anh_tmp=$_FILES['hinhanh']['tmp_name'];
    move_uploaded_file($hinh_anh_tmp,'../uploads/' .$hinh_anh);

    if(isset($_POST['them'])) {
        $query = "INSERT INTO sach (maSach,tenSach,maLoai,tacGia,namXuatBan,soLuong,donGia,maNXB,hinhanh) 
            VALUE ('".$ma_sach."', '".$tensach."','".$ma_loai."', '".$ma_tg."', '".$namxb."','".$soluong."', '".$dongia."', '".$manxb."',  '".$hinh_anh."')";
        
        mysqli_query($conn, $query);
        header('Location:../../index.php?action=quanlysach&query=them');
    } 
    elseif(isset($_POST['suathongtinsach'])) {
        if($hinh_anh!=''){
            $query1 = "UPDATE sach SET tenSach ='".$tensach."', maLoai='".$ma_loai."', 
                tacGia='".$ma_tg."', namXuatBan='".$namxb."', soLuong='".$soluong."', donGia='".$dongia."', maNXB ='".$manxb."', hinhanh='".$hinh_anh."'
                WHERE maSach='$_GET[masach]'";
        }
        else {
            $query1 = "UPDATE sach SET tenSach='".$tensach."', maLoai='".$ma_loai."', 
                tacGia='".$ma_tg."', namXuatBan='".$namxb."', soLuong='".$soluong."', donGia='".$dongia."', maNXB ='".$manxb."'
                WHERE maSach='$_GET[masach]'";
                
        }
        mysqli_query($conn, $query1);
        header('Location:../../index.php?action=quanlysach&query=them');
    }

    else {
        $ma_sach=$_GET['masach'];
        $query1 = "SET FOREIGN_KEY_CHECKS=0;" ;
        mysqli_query($conn, $query1);
        $query3 ="SELECT * FROM sach WHERE maSach='$ma_sach' LIMIT 1";
        $rs = mysqli_query($conn, $query3);
        while($row = mysqli_fetch_array($rs)) {
            unlink("../uploads/".$row['hinhanh']);
        }
        $query2="DELETE FROM sach where maSach='".$ma_sach."'";
        mysqli_query($conn, $query2);

        header('Location:../../index.php?action=quanlysach&query=them');
    }
?> 