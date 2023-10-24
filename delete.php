<?php
include_once("perpustakaan.php");
$id = $_GET["id"];
$data = $koneksi->query("SELECT * FROM perpustakaan WHERE `id` = '$id'");

while ($result = mysqli_fetch_array($data)) {
    $judul = $result["judul"];
    $pengarang = $result["pengarang"];
    $tahun_terbit = $result["tahun_terbit"];
    $isbn = $result["isbn"];
}
if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    echo"<!DOCTYPE html>
    <html lang='en'>
    
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Judul Halaman Anda</title>
    </head>
    <body style='background-color: aqua'>
    <div style='background-color: lavenderblush'>
        <form action='delete.php?id=".$id."' method='post' name='book'>
            <table border='1' width='100%'>
                <thead>
                <tr>
                    <th colspan='2'>Formulir Buku</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Judul Buku:</td>
                    <td><input type='text' style='background-color: blanchedalmond' required readonly value='". $judul ."' name='judul' size='50'></td>
                </tr>
                <tr>
                    <td>Nama Pengarang:</td>
                    <td><input type='text' style='background-color: blanchedalmond' required readonly name='pengarang' value='$pengarang' size='50'></td>
                </tr>
                <tr>
                    <td>Tahun Terbit:</td>
                    <td><input type='text' style='background-color: blanchedalmond' required readonly name='tahun_terbit' value='$tahun_terbit' size='4'></td>
                </tr>
                <tr>
                    <td>ISBN:</td>
                    <td><input type='text' style='background-color: blanchedalmond' required readonly name='isbn' value='$isbn' size='20'></td>
                </tr>
                <tr>
                    <td colspan='2' align='center'>
                        <h3>SURE WANT DELETE: <input type='submit' name='delete' value='delete'></h3>
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
        <a href='index.php'><button>cancel</button></a>
    <footer>
        <p>Hak Cipta &copy; 2023 TUNBudi06</p>
    </footer>
    </body>
    </html>";
} else {
    if (isset($_POST['delete'])){

        $stmt = $koneksi->prepare("DELETE FROM perpustakaan WHERE id = ?");

        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "Data deleted successfully!";
            header("Refresh: 2; URL=index.php");
            echo "You will be redirected to the destination page in 2 seconds. If not, <a href='index.php'>click here</a>.";
        } else {
            echo "Error: " . $stmt->error;
            header("Refresh: 2; URL=delete.php");
            echo "You will be redirected to the destination page in 2 seconds. If not, <a href='delete.php'>click here</a>.";
        }

        $stmt->close();
    }
}
?>
