<?php 
    $query = "SELECT * FROM theLoai,sach where sach.maLoai=theLoai.maLoai
    AND sach.maLoai ='$_GET[maloai]' ORDER BY sach.maSach DESC";
    $rs = mysqli_query($conn, $query);
?>
<style>
     a p{
        font-size: 20px;
        text-align: center;
    }
    p.ten{
        color: #000 ;
    }
    p.gia{
        color: red;
        font-weight: bold ;
    }li.showsach{
        list-style: none;
        width: 180px;
        height: 330px;
        text-align: center;
    }
    
</style>
  <p style="font-size:25px; text-align:center ">DANH SÁCH</p>
        <ul>
            <?php
                while($row=mysqli_fetch_array($rs)) {
            ?>
            <li class= "showsach">
                <a href="#">
                    <img src="admin/modules/uploads/<?php echo $row['hinhanh'] ?>">
                    <p class="ten"><?php echo $row['tenSach']?></p>
                    <p class="gia"> <?php echo number_format($row['donGia']) . ' đ'?></p>
                </a>
            </li>
            <?php  } ?>
        </ul>
  
        