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
    <title>Yoooo Thêm Sach</title>
</head>
<body>
    <div id="container">
        <form class=form method="POST" action="modules/quanly/xuly.php" enctype="multipart/form-data">
            <table id="form">
                <tr><div id="title"><h1>Thêm Sách</h1><hr></div></tr>
                <tr>
                    <td class="form-left">Mã sách *</td>
                    <td class="form-right"><input type="text" id="masach" name="ma_Sach" style="width: 280px"></td>
                    <td class="form-noti"><span class="noti" id="noti-masach"></span></td>
                </tr>
                <tr>
                    <td class="form-left">Tên sách *</td>
                    <td class="form-right"><input type="text" id="tensach" name="ten_sach" style="width: 280px"></td>
                    <td class="form-noti"><span class="noti" id="noti-tensach"></span></td>
                </tr>
                <tr>
                    <td class="form-left">Mã loại *</td>
                    <td class="form-right">
                        <select id="maloai" name="maLoai" >
                            <option value="Choose-MaNXB">Chọn mã loại</option>
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
                    <td class="form-left">Tác giả *</td>
                    <td class="form-right"><input type="text" id="tacgia" name="tacGia" style="width: 280px"></td>
                    <td class="form-noti"><span class="noti" id="noti-tacgia"></span></td>
                </tr>
                <tr>
                    <td class="form-left">Năm xuất bản *</td>
                    <td class="form-right"><input type="text" id="namxuatban" name="namXuatBan" style="width: 280px"></td>
                    <td class="form-noti"><span class="noti" id="noti-namxuatban"></span></td>
                </tr>
                <tr>
                    <td class="form-left">Số lượng *</td>
                    <td class="form-right"><input type="text" id="soluong" name="soLuong" style="width: 280px"></td>
                    <td class="form-noti"><span class="noti" id="noti-soluong"></span></td>
                </tr>
                <tr>
                    <td class="form-left">Đơn giá *</td>
                    <td class="form-right"><input type="text" id="dongia" name="donGia" style="width: 280px"></td>
                    <td class="form-noti"><span class="noti" id="noti-dongia"></span></td>
                </tr>
                <tr>
                    <td class="form-left">Mã nhà xuất bản *</td>
                    <td class="form-right">
                        <select id="manxb" name="maNXB">
                            <option value="Choose-MaNXB">Chọn mã NXB</option>
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
                    <td class="form-left">Hình ảnh *</td>
                    <td class="form-right"><input type="file" name="hinhanh" value ="upload" id="hinhanh"/></td>
                    <td class="form-noti"><span class="noti" id="noti-hinhanh"></span></td>
                </tr>
                <tr>
                    <td class="form-left"><input type="submit" name="them" value="Thêm sách" onclick="checkValid()"></td>
                    <td class="form-right"><input type="button" value="Xóa" onclick="setClear()"></td>
                </tr>
            </table>
        </form>
    </div>
    <script>
        function setNull () {
            document.getElementById("noti-masach").innerHTML = "";
            document.getElementById("noti-tensach").innerHTML="";
            document.getElementById("noti-maloai").innerHTML ="";
            document.getElementById("noti-tacgia").innerHTML ="";
            document.getElementById("noti-namxuatban").innerHTML ="";
            document.getElementById("noti-soluong").innerHTML ="";
            document.getElementById("noti-dongia").innerHTML="";
            document.getElementById("noti-manxb").innerHTML ="";
            document.getElementById("noti-hinhanh").innerHTML ="";
        }
        function setClear (){
            setNull();
            document.getElementById("masach").value = "";
            document.getElementById('tensach').value ="";
            document.getElementById("maloai").value ="Choose-MaLoai";
            document.getElementById("tacgia").value = "";
            document.getElementById("namxuatban").value="";
            document.getElementById("soluong").value = "";
            document.getElementById("dongia").value = "";
            document.getElementById("manxb").value ="Choose-MaNXB";
            document.getElementById("hinhanh").innerHTML ="upload";
        }

        function checkMaSach(){
            if (document.getElementById("masach").value == "") {
                document.getElementById("noti-masach").innerHTML = "Mã sách không được để trống"
            }
        }

        function checkTenSach(){
            if (document.getElementById("tensach").value=="") {
                document.getElementById("noti-tensach").innerHTML ="Tên sách không được để trống" 
            }
        }
        function checkMaLoai() {
            if(document.getElementById("maloai").value =="Choose-MaLoai"){
                document.getElementById("noti-maloai").innerHTML = "Chọn mã loại"
            }
        }
        function checkTacGia() {
            if (document.getElementById("tacgia").value=="")
                document.getElementById("noti-tacgia").innerHTML ="Tên tác giả không được để trống"  
        }
        function checkNamXuatBan() {
            if (document.getElementById("namxuatban").value=="")
                document.getElementById("noti-namxuatban").innerHTML ="Năm xuất bản không được để trống"
            else if (isNaN(document.getElementById("namxuatban").value))
                document.getElementById("noti-namxuatban").innerHTML ="Năm phải là số"
            else if(document.getElementById("namxuatban").value.length != 4)
                document.getElementById("noti-namxuatban").innerHTML ="Năm có độ dài là 4"
        }

        function checkSoLuong(){
            if (document.getElementById("soluong").value == "") 
                document.getElementById("noti-soluong").innerHTML ="Số lượng không được để trống"
            else if (isNaN(document.getElementById("soluong").value))
                document.getElementById("noti-soluong").innerHTML ="Phải là số"
        }
        function checkDonGia() {
            if(document.getElementById("dongia").value == "")
                document.getElementById("noti-dongia").innerHTML = "Đơn giá không được để trống"
            else if (isNaN(document.getElementById("dongia").value))
                document.getElementById("noti-dongia").innerHTML ="Phải là số"
        }
        function checkMaNXB() {
            if(document.getElementById("manxb").value =="Choose-MaNXB"){
                document.getElementById("noti-manxb").innerHTML = "Chọn mã nhà xuất bản"
            }
        }
    
        function checkHinhAnh() {
            if(document.getElementById("hinhanh").value == "upload"){
                document.getElementById("noti-hinhanh").innerHTML = "Thêm hình ảnh"
            }
        }
        function checkValid (){
            setNull();
            checkMaSach();
            checkTenSach();
            checkMaLoai();
            checkTacGia();
            checkNamXuatBan();
            checkSoLuong();  
            checkHinhAnh();
            checkSoLuong();
            checkDonGia();
            checkMaNXB();
        }
    </script>
</body>
</html>