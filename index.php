<?php
require_once __DIR__ . '/auth.php';
require_login();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Assessment - Student Grading</title>
</head>

<body>
    <?php
    include "header.php";

    include "db.php";

    $search = $_GET['search'];

    $like = "%" . $search . "%";

   // $sql = $conn->prepare("SELECT * from results");

    $sql = $conn->prepare("SELECT * FROM results WHERE
    student_name LIKE ? OR
    matric_number LIKE ? OR
    subject_name LIKE ? OR
    subject_code LIKE ? OR
    ORDER BY student_name");

    $sql -> bind_param("ssss", $like, $like, $like, $like);

    $sql->execute();
    $result = $sql->get_result();

    ?>

    <h2>Student Records</h2>
    <a href="add.php">+ Add Results</a>
    <br>

    <br>
    <form method = 'get'>
    <input type="text" name = "search" placeholder="Search by name or matric_number" 
    value="<php echo $Search ?>">
    <input type = "submit" value = "Search">;
    <a href = "index.php">Show all</a>
    </form>

    <button> Search </button>
    <a href="">Show All</a>
    <br>

    <br>
    <table border="1">
        <tr>
            <th>No.</th>
            <th>Student Name</th>
            <th>Matric Number</th>
            <th>Subject</th>
            <th>Test 1 (20%)</th>
            <th>Test 2 (30%)</th>
            <th>Final (50%)</th>
            <th>Total (100%)</th>
            <th>Grade</th>
            <th>Actions</th>
        </tr>

        <?php

        $count = 1;
        
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";

        echo "<td>" . $count++ . "</td>";
        echo "<td>" . $row['student_name'] . "</td>";
        echo "<td>" . $row['matric_number'] . "</td>";
        echo "<td>" . $row['subject_name'] . "<br>" . $row['subject_code'] . "</td>";
        echo "<td>" . $row['test_1'] . "</td>";
        echo "<td>" . $row['test_2'] . "</td>";
        echo "<td>" . $row['final'] . "</td>";
        echo "<td>" . $row['total'] . "</td>";
        echo "<td>" . $row['grade'] . "</td>";

        echo "<button><a href='edit.php?id=" . $row['id'] . "'><button>Edit</button>";
        echo "<form method = 'post' action = 'delete.php' onsubmit = 'return confirm(\"Delete this?\")'>";
        echo "<input type = 'hidden' name = 'delete' value = '" . $row ['id'] . "'>";
        echo "<input type = 'submit' value = 'Delete'>";
        echo "</form>";
        
        echo "</tr>";
    }
    ?>

    </table>

</body>


</html>

<?php
if ($result->num_rows == 0)
    if($search !="") {
        echo "<p>No records match for $search .</p>";
    } else {
        echo "<p>No record match.</p>";
    }

include "footer.php";
?>
