<?php 

    session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include('data/connect.php');
    if(isset($_POST['dangnhap'])) {
        $user = $_POST['user_name'];
        $pass = md5($_POST['passwd']);

        $query="SELECT * FROM admin WHERE user_name ='".$user."' AND passwd ='".$pass."' LIMIT 1 ";
        $rs = mysqli_query($conn, $query);

        $count = mysqli_num_rows($rs);
        // if($count>0) {
        //     $_SESSION['dangnhap'] = $user;
        //     // header("Location:index.php");
        // } elseif($count = 0) {
        //     $error = "Tên đăng nhập hoặc mật khẩu không chính xác.";
        
        //     // header("Location:login.php");
        //} 
          if($count = 1) {
            $_SESSION['success'] = 'Đăng nhập thành công';
            $_SESSION['dangnhap'] = $user;
            header('Location:index.php');
            exit;
        } else {
            $_SESSION['error'] = 'Sai tên đăng nhập hoặc mật khẩu';
            header('Location:login.php');
            exit;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            color: #000000;
        }
        .wrapper {
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
</head>
<body>
    <div class="wrapper">
        <form class=form action="" method="POST" autocomplete="off">
            <table id="form">
                <tr><div id="title"><h1>ADMIN UKI</h1></div></tr>
                <tr>
                    <td class="form-left">Tên đăng nhập *</td>
                    <td class="form-right"><input type="text" name="user_name" style="width: 280px"></td>
                    <td class="form-noti"></td>
                </tr>
                <tr>
                    <td class="form-left">Mật khẩu *</td>
                    <td class="form-right"><input type="text" name="passwd" style="width: 280px"></td>
                </tr>
                <tr>
                    <td class="form-left"><input type="submit" name="dangnhap" value="Đăng nhập"></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>