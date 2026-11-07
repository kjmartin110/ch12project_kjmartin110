
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Searching a Database with PHP and MySQL</title>
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>
    <h1>Searching a Database with PHP and MySQL</h1>

    <p>Name: Kevin Martin</p>
    <p>Date: <?php echo date("F j, Y"); ?></p>

    <h2>Search for a Student</h2>

    <form action="results.php" method="POST">
        <label for="email">Student Email Address:</label>
        <input type="email" id="email" name="email" required>

        <input type="submit" value="Search Student">
    </form>
</body>
</html>
