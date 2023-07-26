<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style_admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <title>UKI ADMIN</title>
</head>
<body>
    <div id="admin-page" ">
    
    <?php 
        include("data/connect.php");
        include("modules/banner.php");
        
        include("modules/sidebar.php");
        include("modules/main.php");
        ?>

   </div>
</body>
</html>