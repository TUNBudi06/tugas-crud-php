<?php
include_once("perpustakaan.php");

$data = $koneksi->query("select * from `perpustakaan`");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index table</title>
</head>
<body>
    <div>
        <h4>add book:<a href="add.php"><button style="background-color: aqua">Add User</button></a></h4>
        <table border="1" width="100%">
            <thead>
            <tr>
                <th>list</th>
                <th>judul buku</th>
                <th>nama pengarang</th>
                <th>tahun terbit</th>
                <th>isbn</th>
                <th>update or delete</th>
            </tr>
            </thead>
            <tbody>
                <?php
                    while($book = mysqli_fetch_array($data)){
                        echo "<tr>";
                        echo "<td>" . $book['id']."</td>";
                        echo "<td>" . $book['judul']."</td>";
                        echo "<td>" . $book['pengarang']."</td>";
                        echo "<td>" . $book['tahun_terbit']."</td>";
                        echo "<td>" . $book['isbn']."</td>";
                        echo "<td align='center'><h5><a href='update.php?id=$book[id]' ><button style='background-color: blue'>UPDATE</button></a>"
                        . " | <a href='delete.php?id=$book[id]' ><button style='background-color: red'>delete</button></a></h5></td>";
                    }
                ?>
            </tbody>
        </table>
    </div>
    <footer>
        <p>Hak Cipta &copy; 2023 TUNBudi06</p>
    </footer>
</body>
</html>
