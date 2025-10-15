<?php include 'header.php'; ?>
<h3>Add Employee</h3>
<?php
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $position = trim($_POST['position']);
    $department = trim($_POST['department']);
    $email = trim($_POST['email']);
    $contact = trim($_POST['contact_number']);

    if ($name === '') $errors[] = 'Name is required.';

    if (empty($errors)) {
        $stmt = $conn->prepare('INSERT INTO employees (name, position, department, email, contact_number) VALUES (?,?,?,?,?)');
        $stmt->bind_param('sssss', $name, $position, $department, $email, $contact);
        $stmt->execute();
        header('Location: employees.php'); exit;
    }
}
?>

<?php if ($errors): ?><div class="alert alert-danger"><?= implode('<br>',$errors) ?></div><?php endif; ?>

<form method="post">
  <div class="mb-3"><label class="form-label">Name</label><input class="form-control" name="name" required></div>
  <div class="mb-3"><label class="form-label">Position</label><input class="form-control" name="position"></div>
  <div class="mb-3"><label class="form-label">Department</label><input class="form-control" name="department"></div>
  <div class="mb-3"><label class="form-label">Email</label><input class="form-control" name="email" type="email"></div>
  <div class="mb-3"><label class="form-label">Contact Number</label><input class="form-control" name="contact_number"></div>
  <button class="btn btn-success">Save</button>
  <a class="btn btn-secondary" href="employees.php">Cancel</a>
</form>

<?php include 'footer.php'; ?>