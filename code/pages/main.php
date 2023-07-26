<div class="content">
    <div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>      
    </div>
    <ul class="product">
        <?php 
            if(isset($_GET['click'])) {
                $temp = $_GET['click'];
            } else{
                $temp = '';
            }
             if($temp=='timkiem') {
                include("main/timkiem.php");
            } else {
                include("main/main-index.php");
            }
        ?>
    </div>   
</div>