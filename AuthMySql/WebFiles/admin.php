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

    $sql = "INSERT INTO users (id, username, password) VALUES ('$id', '$username', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo "Kullanıcı başarıyla oluşturuldu.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql = "SELECT id, username, password FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>ID</th><th>Kullanıcı Adı</th><th>Parola</th><th>İşlemler</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td><td>".$row["username"]."</td><td>".$row["password"]."</td><td><a href='edit.php?id=".$row["id"]."'>Düzenle</a></td></tr>";
    }
    echo "</table>";
} else {
    echo "Kayıtlı kullanıcı yok.";
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Sayfası</title>
</head>
<body>
    <h1>Admin Sayfası</h1>
    <form method="post">
        <label for="id">Hdd Serial:</label>
        <input type="text" name="id" required><br><br>
        <label for="username">Kullanıcı Adı:</label>
        <input type="text" name="username" required><br><br>
        <label for="password">Parola:</label>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Kaydet">
    </form>
</body>
</html>
