<?php
include "config.php";

$conn->query("CREATE TABLE IF NOT EXISTS notes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT NOT NULL
)");

if (isset($_POST['note'])) {
    $note = $_POST['note'];
    $conn->query("INSERT INTO notes (content) VALUES ('$note')");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM notes WHERE id=$id");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP Notes App</title>
</head>
<body>

<h2>Add Note</h2>

<form method="POST">
    <input type="text" name="note" required>
    <button type="submit">Add</button>
</form>

<h2>All Notes</h2>

<?php
$result = $conn->query("SELECT * FROM notes");

while ($row = $result->fetch_assoc()) {
    echo $row['content'] . " 
    <a href='?delete=".$row['id']."'>Delete</a><br>";
}
?>

</body>
</html>
