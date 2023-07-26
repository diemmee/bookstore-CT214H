<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Project</title>
</head>
<body>
    <div id="page">
    <?php 
        include('./admin/data/connect.php');
        include("./pages/banner.php");
        include("./pages/sidebar.php");
        include("./pages/main.php");
        // include("pages/main.php");

        ?>


    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
</body>
</html>