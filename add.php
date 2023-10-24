<?php
include_once("perpustakaan.php");
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
        <form action='add.php' method='post' name='book'>
            <table border='1' width='100%'>
                <thead>
                <tr>
                    <th colspan='2'>Formulir Buku</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Judul Buku:</td>
                    <td><input type='text' style='background-color: blanchedalmond' required name='judul' size='50'></td>
                </tr>
                <tr>
                    <td>Nama Pengarang:</td>
                    <td><input type='text' style='background-color: blanchedalmond' required name='pengarang' size='50'></td>
                </tr>
                <tr>
                    <td>Tahun Terbit:</td>
                    <td><input type='text' style='background-color: blanchedalmond' required name='tahun_terbit' size='4'></td>
                </tr>
                <tr>
                    <td>ISBN:</td>
                    <td><input type='text' style='background-color: blanchedalmond' required name='isbn' size='20'></td>
                </tr>
                <tr>
                    <td colspan='2' align='center'>
                        <input type='submit' name='simpan' value='Simpan'>
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
        <a href='index.php'><button >Back</button></a>
    <footer>
        <p>Hak Cipta &copy; 2023 TUNBudi06</p>
    </footer>
    </body>
    </html>";
} else {
    if (isset($_POST['simpan'])){
        // Get form data
        $judul = $_POST["judul"];
        $pengarang = $_POST["pengarang"];
        $tahun_terbit = $_POST["tahun_terbit"];
        $isbn = $_POST["isbn"];

        // Prepare the SQL statement using prepared statements
        $stmt = $koneksi->prepare("INSERT INTO perpustakaan (judul, pengarang, tahun_terbit, isbn) VALUES (?, ?, ?, ?)");

        // Bind the parameters and execute the statement
        $stmt->bind_param("ssis", $judul, $pengarang, $tahun_terbit, $isbn);

        // Execute the query
        if ($stmt->execute()) {
            echo "Data inserted successfully!";
            header("Refresh: 5; URL=index.php");

            // Output a message to the user
            echo "You will be redirected to the destination page in 5 seconds. If not, <a href='index.php'>click here</a>.";
        } else {
            echo "Error: " . $stmt->error;
            header("Refresh: 5; URL=add.php");

            // Output a message to the user
            echo "You will be redirected to the destination page in 5 seconds. If not, <a href='add.php'>click here</a>.";
        }

        // Close the statement and the database connection
        $stmt->close();
    }
}
?>
