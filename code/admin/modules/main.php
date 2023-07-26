<div class="main">
    <?php 
        if(isset($_GET['action']) && $_GET['query']) {
            $temp = $_GET['action'];
            $query = $_GET['query'];
        } else {
            $temp = '';
            $query = '';
        
        } if($temp=='quanlysach' && $query=='them') {
            include("modules/quanly/them.php");
            include("modules/quanly/lietke.php");
        } elseif($temp == 'quanlysach' && $query == 'sua')
            include("modules/quanly/sua.php");
        else {
            include("modules/dashboard.php");
        }

        if($temp=='quanlytheloai' && $query=='them') {
            include("modules/quanlytheloai/them.php");
            include("modules/quanlytheloai/lietke.php");
        } elseif($temp == 'quanlytheloai' && $query == 'sua')
            include("modules/quanlytheloai/sua.php");
        else {
            include("modules/dashboard.php");
        }
    ?>
</div>