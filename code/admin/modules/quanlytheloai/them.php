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
    <title>Yoooo Thêm Thể Loại</title>
</head>
<body>
    <div id="container">
        <form class=form method="POST" action="modules/quanlytheloai/xuly.php" enctype="multipart/form-data">
            <table id="form">
                <tr><div id="title"><h1>Thêm Thể Loại</h1></div></tr>
                <tr>
                    <td class="form-left">Mã thể loại *:</td>
                    <td class="form-right"><input type="text" id="matheloai" name="ma_theloai" style="width: 280px"></td>
                    <td class="form-noti"><span class="noti" id="noti-matheloai"></span></td>
                </tr>
                <tr>
                    <td class="form-left">Tên thể loại *:</td>
                    <td class="form-right"><input type="text" id="tentheloai" name="ten_theloai" style="width: 280px"></td>
                    <td class="form-noti"><span class="noti" id="noti-tentheloai"></span></td>
                </tr>
                <tr>
                    <td class="form-left"><input type="submit" name="them" value="Thêm" onclick="checkValid()"></td>
                    <td class="form-right"><input type="button" value="Xóa" onclick="setClear()"></td>
                </tr>
            </table>
        </form>
    </div>
    <script>
        function setNull () {
            document.getElementById("noti-matheloai").innerHTML = "";
            document.getElementById("noti-tentheloai").innerHTML="";
        }
        function setClear (){
            setNull();
            document.getElementById("matheloai").value = "";
            document.getElementById('tentheloai').value ="";
        }
        function checkMaTheLoai(){
            if (document.getElementById("matheloai").value == "") {
                document.getElementById("noti-matheloai").innerHTML = "Mã thể không được để trống"
            }
        }
        function checkTenTheLoai(){
            if (document.getElementById("tentheloai").value=="") {
                document.getElementById("noti-tentheloai").innerHTML ="Tên thể loại không được để trống" 
            }
        }
        function checkValid (){
            setNull();
            checkMaTheLoai();
            checkTenTheLoai();
        }
    </script>
</body>
</html>