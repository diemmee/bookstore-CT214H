<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <style>
        .form {
            font-size: 24px;
        }    
    </style>
    <title>Sửa TT Loại</title>
</head>
<body>
    <?php 
        $query= "SELECT * FROM theLoai WHERE maLoai ='$_GET[maloai]' LIMIT 1 ";
        $rs = mysqli_query($conn, $query);
    ?>
    <h1>Sửa Thông Tin Thể Loại</h1><hr>
    <table width="100%" border="1px" >
    <?php while ($row = mysqli_fetch_array($rs)) { ?>
        <form class=form method="POST" action="modules/quanlytheloai/xuly.php?maloai=<?php echo $_GET['maloai'] ?>" enctype="multipart/form-data">
            <tr>
                <td>Mã loại</td>
                <td><input type="text" value="<?php echo $row['maLoai'] ?>" name="maloai"  style="width: 50px"/></td>
            </tr> 
            <tr>   
                <td>Tên loại</td>
                <td><input type="text" value="<?php echo $row['tenLoai'] ?>" name="tenloai" style="width: 500px"/></td>
            </tr> 
            <tr>
                <td><input type="submit" name="suathongtheloai" value="Lưu thay đổi"/></td>
            </tr>
                                
            <?php  } ?>
    </table>
</body>
</html>

