<?php 
    include('../../data/connect.php');

    $ma_loai = $_POST['maloai'];
    $ten_loai= $_POST['tenloai'];

    if(isset($_POST['them'])) {
        $query = "INSERT INTO theLoai (maLoai,tenLoai) 
            VALUE ('".$ma_loai."', '".$ten_loai."'";
        mysqli_query($conn, $query);
        header('Location:../../index.php?action=quanlytheloai&query=them');
    } 
    elseif(isset($_POST['suathongtheloai'])) {
        $query1 = "UPDATE theLoai SET maLoai ='".$ma_loai."', tenLoai='".$ten_loai."' 
            WHERE maLoai ='$_GET[maloai]'";
            
        mysqli_query($conn, $query1);
        header('Location:../../index.php?action=quanlytheloai&query=them');
    }
    else {
        $ma_loai=$_GET['maloai'];
        $query1 = "SET FOREIGN_KEY_CHECKS=0;" ;
        mysqli_query($conn, $query1);
        $query2="DELETE FROM theLoai where maLoai='".$ma_loai."'";
        mysqli_query($conn, $query2);

        header('Location:../../index.php?action=quanlytheloai&query=them');
    }
?> 