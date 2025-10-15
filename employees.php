<?php include 'header.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <h3>Employees</h3>
  <a class="btn btn-success" href="add_employee.php">Add Employee</a>
</div>

<?php
// search and filter
$search = isset($_GET['q']) ? $conn->real_escape_string($_GET['q']) : '';
$dept = isset($_GET['department']) ? $conn->real_escape_string($_GET['department']) : '';

$sql = "SELECT * FROM employees WHERE 1";
if ($search !== '') {
    $sql .= " AND (name LIKE '%$search%' OR position LIKE '%$search%' OR email LIKE '%$search%')";
}
if ($dept !== '') {
    $sql .= " AND department = '$dept'";
}

// 🟢 sort by employee_id ASC — newest added employee goes to the bottom
$sql .= " ORDER BY employee_id ASC";
$result = $conn->query($sql);

// departments for filter
$departmentsRes = $conn->query("SELECT DISTINCT department FROM employees WHERE department IS NOT NULL AND department!=''");
$departments = [];
while($d = $departmentsRes->fetch_assoc()) $departments[] = $d['department'];
?>

<form method="get" class="row g-2 mb-3">
  <div class="col-md-6">
    <input type="text" name="q" class="form-control" placeholder="Search name, position, email" value="<?= htmlspecialchars($search) ?>">
  </div>
  <div class="col-md-4">
    <select name="department" class="form-select">
      <option value="">-- All Departments --</option>
      <?php foreach($departments as $d): ?>
        <option value="<?= htmlspecialchars($d) ?>" <?= $d === $dept ? 'selected' : '' ?>><?= htmlspecialchars($d) ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="col-md-2">
    <button class="btn btn-outline-secondary w-100">Filter</button>
  </div>
</form>

<table class="table table-bordered">
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Position</th>
      <th>Department</th>
      <th>Email</th>
      <th>Contact</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php while($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= $row['employee_id'] ?></td>
      <td><?= htmlspecialchars($row['name']) ?></td>
      <td><?= htmlspecialchars($row['position']) ?></td>
      <td><?= htmlspecialchars($row['department']) ?></td>
      <td><?= htmlspecialchars($row['email']) ?></td>
      <td><?= htmlspecialchars($row['contact_number']) ?></td>
      <td>
        <a class="btn btn-sm btn-primary" href="edit_employee.php?id=<?= $row['employee_id'] ?>">Edit</a>
        <a class="btn btn-sm btn-danger" href="delete_employee.php?id=<?= $row['employee_id'] ?>" onclick="return confirm('Delete this employee?')">Delete</a>
      </td>
    </tr>
  <?php endwhile; ?>
  </tbody>
</table>

<?php include 'footer.php'; ?>
