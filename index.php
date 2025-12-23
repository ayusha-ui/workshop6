<?php
require 'db.php';

try {
    $sql = "SELECT * FROM students ORDER BY id DESC";
    $stmt = $pdo->query($sql);
    $students = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Error fetching students: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        header {
            background: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
        }
        header h1 { font-size: 28px; }
        .add-btn {
            display: inline-block;
            margin: 20px;
            padding: 12px 24px;
            background: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: background 0.3s;
        }
        .add-btn:hover { background: #218838; }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th {
            background: #007bff;
            color: white;
            padding: 15px;
            text-align: left;
        }
        td {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }
        tr:hover {
            background: #f8f9fa;
        }
        .action a {
            color: #007bff;
            text-decoration: none;
            margin-right: 10px;
            font-weight: 500;
        }
        .action a:hover { text-decoration: underline; }
        .action a.delete {
            color: #dc3545;
        }
        .no-data {
            text-align: center;
            padding: 40px;
            color: #666;
            font-size: 18px;
        }
        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr { display: block; }
            thead tr { position: absolute; top: -9999px; left: -9999px; }
            tr { margin: 20px 0; border: 1px solid #ddd; border-radius: 8px; }
            td {
                border: none;
                position: relative;
                padding-left: 50%;
            }
            td:before {
                content: attr(data-label);
                position: absolute;
                left: 15px;
                width: 45%;
                font-weight: bold;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Student Management System</h1>
        </header>

        <a href="create.php" class="add-btn">+ Add New Student</a>

        <?php if (empty($students)): ?>
            <p class="no-data">No students found. Add one to get started!</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Course</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $s): ?>
                    <tr>
                        <td data-label="ID"><?= htmlspecialchars($s['id']) ?></td>
                        <td data-label="Name"><?= htmlspecialchars($s['name']) ?></td>
                        <td data-label="Email"><?= htmlspecialchars($s['email']) ?></td>
                        <td data-label="Course"><?= htmlspecialchars($s['course']) ?></td>
                        <td data-label="Actions" class="action">
                            <a href="edit.php?id=<?= $s['id'] ?>">Edit</a> |
                            <a href="delete.php?id=<?= $s['id'] ?>" class="delete"
                               onclick="return confirm('Are you sure you want to delete this student?')">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>