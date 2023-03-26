<?php
if ($_SERVER['REMOTE_ADDR'] != '127.0.0.1' && $_SERVER['REMOTE_ADDR'] != '::1') {
    header('HTTP/1.0 403 Forbidden');
    exit('Access Forbidden');
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gtlauncher";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "UPDATE users SET username='$username', password='$password' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Kullanıcı verileri başarıyla güncellendi.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $sql = "SELECT * FROM users WHERE id='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
   
        $row = $result->fetch_assoc();
        $username = $row["username"];
        $password = $row["password"];
    } else {
        echo "Kullanıcı bulunamadı.";
    }
} else {
    echo "Kullanıcı ID belirtilmedi.";
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Kullanıcı Düzenleme Sayfası</title>
</head>
<body>
    <h1>Kullanıcı Düzenleme Sayfası</h1>
    <form method="post">
        <label for="id">Hdd Serial:</label>
        <input type="text" name="id" value="<?php echo $id; ?>" readonly><br><br>
        <label for="username">Kullanıcı Adı:</label>
        <input type="text" name="username" value="<?php echo $username; ?>" required><br><br>
        <label for="password">Parola:</label>
        <input type="password" name="password" value="<?php echo $password; ?>" required><br><br>
        <input type="submit" value="Kaydet">
    </form>
</body>
</html>
