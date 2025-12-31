<?php
// search.php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "db.php";

$results = [];
$search_term = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['input'])) {
    $search_term = trim($_POST['input']);
    if ($search_term !== "") {
        // Use prepared statement with LIKE
        $like = '%' . $search_term . '%';
        $stmt = $conn->prepare("SELECT name, email, phone, address, password FROM test WHERE name LIKE ? OR email LIKE ? LIMIT 100");
        $stmt->bind_param("ss", $like, $like);
        $stmt->execute();
        $res = $stmt->get_result();
        while ($row = $res->fetch_assoc()) {
            $results[] = $row;
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Search Engine</title>
</head>
<body>
    <h2>Search</h2>
    <form method="post" action="search.php">
        <input type="text" name="input" placeholder="Search by name or email" value="<?php echo htmlspecialchars($search_term); ?>">
        <input type="submit" name="search" value="Search">
    </form>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <h3>Results</h3>
        <?php if (empty($results)): ?>
            <p>No data found.</p>
        <?php else: ?>
            <table border="1" cellpadding="6">
                <tr>
                    <th>Name</th><th>Email</th><th>Phone</th><th>Address</th><th>Password (hashed)</th>
                </tr>
                <?php foreach ($results as $r): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($r['name']); ?></td>
                        <td><?php echo htmlspecialchars($r['email']); ?></td>
                        <td><?php echo htmlspecialchars($r['phone']); ?></td>
                        <td><?php echo htmlspecialchars($r['address']); ?></td>
                        <td><?php echo htmlspecialchars($r['password']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    <?php endif; ?>

</body>
</html>
