<?php 
    $query = "SELECT * FROM theLoai ORDER BY maLoai DESC";
    $rs = mysqli_query($conn, $query);
?>

<div class="sidebar">
        <p class="ten-theloai">THỂ LOẠI</p>
        <ul id="list-theloai">
            <?php 
                while($row_tenLoai = mysqli_fetch_array($rs)) {
            ?>
            <li><a href="index.php?click=menu&maloai=<?php echo $row_tenLoai['maLoai'] ?>">
               <?php echo $row_tenLoai['tenLoai']?></a>
            </li>
            <?php } ?>
            
            <!-- <li><a href="index.php?click=kinhte">Kinh Tế</a></li>
            <li><a href="index.php?click=tieuthuyet">Tiểu Thuyết</a></li>
            <li><a href="index.php?click=tongiao">Tôn Giáo</a></li>
            <li><a href="index.php?click=yhoc">Y Học</a></li> -->
        </ul>
</div>

