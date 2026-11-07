
<?php
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"] ?? "");
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Please enter a valid email address.";
    } else {

        try {
            $conn = mysqli_connect("db", "db", "db", "taus_data");
        } catch (mysqli_sql_exception $e) {
            $conn = false;
        }

        if (!$conn) {
            $message = "Database connection failed. Check your database setup.";
        } else {
            try {
                $sql = "SELECT firstName, lastName, email
                        FROM tbl_student
                        WHERE email = ?";

                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);

                $result = mysqli_stmt_get_result($stmt);

                if ($student = mysqli_fetch_assoc($result)) {
                    $name = htmlspecialchars(
                        $student["firstName"] . " " . $student["lastName"]
                    );
                    $foundEmail = htmlspecialchars($student["email"]);

                    $message = "Student Found! Name: $name, Email: $foundEmail";
                } else {
                    $message = "The email address was not found.";
                }

                mysqli_stmt_close($stmt);
            } catch (mysqli_sql_exception $e) {
                $message = "Database search failed. Check the student table.";
            }

            mysqli_close($conn);
        }
    }
} else {
    $message = "Please submit the search form first.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Search Results</title>
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>

    <h1>Student Search Results</h1>

    <?php
        echo '<div class="message">' . $message . '</div>';
    ?>

    <a href="index.php">Return to Search</a>

</body>
</html>
