<?php include 'header.php'; ?>
<?php
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id) {
    $stmt = $conn->prepare('DELETE FROM employees WHERE employee_id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
}
header('Location: employees.php');
exit;
?>