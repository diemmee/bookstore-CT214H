<?php 
    $query= "SELECT maLoai, tenLoai FROM theLoai ORDER BY maLoai DESC; ";
    $rs = mysqli_query($conn, $query);
?>

    <p style="text-align: center; font-size: 25px; font-weight:bold ; ">Danh Sách Thể Loại</p>
    <div class=noname>
        <table style="width:100%;" border="1px" >
        <tr>
            <th>Mã thể loại</th>
            <th>Tên thể loại</th>
            <th>Thực thi</th>
        </tr> 
        <?php
            $i = 0;
            while($row = mysqli_fetch_array($rs)){
            $i++; ?>
                <tr>
                    <td><?php echo $row['maLoai'] ?></td>
                    <td><?php echo $row['tenLoai'] ?></td>
                    
                    <td>
                        <a href="modules/quanlytheloai/xuly.php?maloai=<?php echo $row['maLoai'] ?>"> Xóa </a> 
                        | <a href="?action=quanlytheloai&query=sua&maloai=<?php echo $row['maLoai'] ?>"> Sửa</a>
                    </td>
                </tr> 
            <?php } ?>
        </div>
    </table>