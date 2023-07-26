<?php 
    $query= "SELECT maSach, tenSach, hinhanh FROM sach ORDER BY maSach DESC; ";
    $rs = mysqli_query($conn, $query);
?>

    <p style="text-align: center; font-size: 25px; font-weight:bold ; ">Danh Sách Các Quyển Sách</p>
    <div class=noname>
        <table style="width:100%;" border="1px" >
        <tr>
            <th>Mã sách</th>
            <th>Tên sách</th>
            <th>Hình ảnh</th>
            <th>Thực thi</th>
        </tr> 
        <?php
            $i = 0;
            while($row = mysqli_fetch_array($rs)){
            $i++; ?>
                <tr>
                    <td><?php echo $row['maSach'] ?></td>
                    <td><?php echo $row['tenSach'] ?></td>
                    <td><img width="100px" src="modules/uploads/<?php echo $row['hinhanh'] ?>"  ></td>
                    <td>
                        <a href="modules/quanly/xuly.php?masach=<?php echo $row['maSach'] ?>"> Xóa </a> 
                        | <a href="?action=quanlysach&query=sua&masach=<?php echo $row['maSach'] ?>"> Sửa</a>
                    </td>
                </tr> 
            <?php } ?>
        </div>
    </table>