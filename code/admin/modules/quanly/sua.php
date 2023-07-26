<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            color: #000000;
        }
        #container {
            margin-left:auto;
            margin-right: auto;
            text-align: center;
        }
        #form {
            width:100%;
            
        }
        #title{
            font-weight: bold;
        }
        .form-left{
            width:50%;
            text-align: right;
        }
        .form-right{
            width:10%;
            height: 25px;
            text-align: left;
        }
        .form-noti{
            width:40%;
            text-align:left;
        }
        .noti {
            color:red;
            font-style: italic;
            font-weight: bold;
            margin-left: 5px;
        }
    </style>
    <title>Sửa TT</title>
</head>
<body>
    <?php 
        $query= "SELECT * FROM sach WHERE maSach ='$_GET[masach]' LIMIT 1 ";
        $rs = mysqli_query($conn, $query);
    ?>
    <h1>Sửa thông tin sách</h1><hr>
    
    <?php while ($row = mysqli_fetch_array($rs)) { ?>
    <div id="container">
        <form method="POST" action="modules/quanly/xuly.php?masach=<?php echo $_GET['masach'] ?>" enctype="multipart/form-data">
            <table id="form" >
                    <tr>
                        <td class="form-left">Mã sách *</td>
                        <td class="form-right"><input type="text" value="<?php echo $row['maSach'] ?>" id="masach" name="ma_Sach" style="width: 280px"></td>
                        <td class="form-noti"><span class="noti" id="noti-masach"></span></td>
                    </tr>
                    <tr>
                        <td class="form-left">Tên sách *</td>
                        <td class="form-right"><input type="text"  value="<?php echo $row['tenSach'] ?>" id="tensach" name="ten_sach" style="width: 280px"></td>
                        <td class="form-noti"><span class="noti" id="noti-tensach"></span></td>
                    </tr>
                    
                    <tr>
                        <td class="form-left">Tác giả *</td>
                        <td class="form-right"><input type="text"  value="<?php echo $row['tacGia'] ?>" id="tacgia" name="tacGia" style="width: 280px"></td>
                        <td class="form-noti"><span class="noti" id="noti-tacgia"></span></td>
                    </tr>
                    <tr>
                        <td class="form-left">Năm xuất bản *</td>
                        <td class="form-right"><input type="text" value="<?php echo $row['namXuatBan'] ?>" id="namxuatban" name="namXuatBan" style="width: 280px"></td>
                        <td class="form-noti"><span class="noti" id="noti-namxuatban"></span></td>
                    </tr>
                    <tr>
                        <td class="form-left">Số lượng *</td>
                        <td class="form-right"><input type="text"  value="<?php echo $row['soLuong'] ?>" id="soluong" name="soLuong" style="width: 280px"></td>
                        <td class="form-noti"><span class="noti" id="noti-soluong"></span></td>
                    </tr>
                    <tr>
                        <td class="form-left">Đơn giá *</td>
                        <td class="form-right"><input type="text"  value="<?php echo $row['donGia'] ?>" name="donGia"   id="dongia" name="donGia" style="width: 280px"></td>
                        <td class="form-noti"><span class="noti" id="noti-dongia"></span></td>
                    </tr>
                    
                    <tr>
                        <td class="form-left">Hình ảnh *</td>
                        <td class="form-right">
                            <input type="file" name="hinhanh" value ="upload" id="hinhanh"/>
                            <img width="100px" src="modules/uploads/<?php echo $row['hinhanh'] ?>" >
                        </td>
                        <td class="form-noti"><span class="noti" id="noti-hinhanh"></span></td>
                    </tr>
                    <tr>
                        <td class="form-left">Mã loại *</td>
                        <td class="form-right">
                            <select id="maloai" value="<?php echo $row['maLoai'] ?>"  name="maLoai" >
                                <?php  
                                $query = "SELECT maLoai FROM theLoai;";

                                $rs = mysqli_query($conn,$query) ;
                                while ($row = mysqli_fetch_assoc($rs)) {
                                ?>
                                    <option><?php echo $row['maLoai']?> </option>';
                                <?php
                                }
                                ?>
                            </select>
                            <td class="form-noti"><span class="noti" id="noti-maloai"></span></td>
                        </td>
                    </tr>
                    <tr>
                        <td class="form-left">Mã nhà xuất bản *</td>
                        <td class="form-right">
                            <select id="manxb"  value="<?php echo $row['maNXB'] ?>" name="maNXB">
                                <?php
                                $query = "SELECT maNXB FROM nhaXuatBan;";

                                $rs = mysqli_query($conn,$query) ;
                                while ($row = mysqli_fetch_assoc($rs)) {
                                ?>
                                    <option  ><?php echo $row['maNXB']?> </option>';
                                <?php
                                }
                                ?>
                            </select>
                            <td class="form-noti"><span class="noti" id="noti-manxb"></span></td>
                        </td>
                    </tr>
                    <tr>
                        <td class="form-left"><input type="submit" name="suathongtinsach" value="Lưu thay đổi" onclick="checkValid()"/> </td>
                        <td class="form-right"><input type="button" value="Xóa" onclick="setClear()"></td>
                    </tr>
            <tr>
            </table>
            </div>
            <?php  } ?>
    
</body>
</html>