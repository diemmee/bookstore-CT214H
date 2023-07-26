<?php 
    if(isset($_POST['key'])) {
        $key=$_POST['key'];
    }
    $query = "SELECT * FROM sach, theLoai where sach.maLoai = theLoai.maLoai 
    AND sach.tenSach LIKE'%".$key."%'";
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
    }
    li.showtimkiem {
        list-style: none;
        width: 170px;
        height: 330px;
        text-align: center;
    }
</style>
  <p style="font-size:25px; text-align:center ">kết quả tìm kiếm: "<?php echo $_POST['key']?>"</p>
        <ul>
            <?php
                while($row=mysqli_fetch_array($rs)) {
            ?>
            <li class='showtimkiem'>
                <a href="#">
                    <img src="./admin/modules/uploads/<?php echo $row['hinhanh'] ?>">
                    <p class="ten"><?php echo $row['tenSach']?></p>
                    <p class="gia"> <?php echo number_format($row['donGia']) . ' đ'?></p>
                </a>
            </li>
            <?php  } ?>
        </ul>
  
        


