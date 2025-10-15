<?php include 'header.php'; ?>
<?php
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if (!$id) { header('Location: employees.php'); exit; }
$stmt = $conn->prepare('SELECT * FROM employees WHERE employee_id = ?'); $stmt->bind_param('i',$id); $stmt->execute(); $emp = $stmt->get_result()->fetch_assoc();
if (!$emp) { header('Location: employees.php'); exit; }

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $position = trim($_POST['position']);
    $department = trim($_POST['department']);
    $email = trim($_POST['email']);
    $contact = trim($_POST['contact_number']);
    if ($name === '') $errors[] = 'Name is required.';
    if (empty($errors)) {
        $stmt = $conn->prepare('UPDATE employees SET name=?, position=?, department=?, email=?, contact_number=? WHERE employee_id=?');
        $stmt->bind_param('sssssi',$name,$position,$department,$email,$contact,$id);
        $stmt->execute();
        header('Location: employees.php'); exit;
    }
}
?>

<h3>Edit Employee</h3>
<?php if ($errors): ?><div class="alert alert-danger"><?= implode('<br>',$errors) ?></div><?php endif; ?>

<form method="post">
  <div class="mb-3"><label class="form-label">Name</label><input class="form-control" name="name" value="<?= htmlspecialchars($emp['name']) ?>" required></div>
  <div class="mb-3"><label class="form-label">Position</label><input class="form-control" name="position" value="<?= htmlspecialchars($emp['position']) ?>"></div>
  <div class="mb-3"><label class="form-label">Department</label><input class="form-control" name="department" value="<?= htmlspecialchars($emp['department']) ?>"></div>
  <div class="mb-3"><label class="form-label">Email</label><input class="form-control" name="email" type="email" value="<?= htmlspecialchars($emp['email']) ?>"></div>
  <div class="mb-3"><label class="form-label">Contact Number</label><input class="form-control" name="contact_number" value="<?= htmlspecialchars($emp['contact_number']) ?>"></div>
  <button class="btn btn-primary">Update</button>
  <a class="btn btn-secondary" href="employees.php">Cancel</a>
</form>

<?php include 'footer.php'; ?>