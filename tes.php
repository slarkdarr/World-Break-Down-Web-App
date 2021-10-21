<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="Assets/css/index.css" />
    <link rel="stylesheet" href="Assets/css/style.css" />
    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/55c10e2ab9.js" crossorigin="anonymous"></script>

    <title>Jajan.id</title>
</head>

<?php

?>

<body>
    <!-- Navbar -->
    <?php include 'partials/navbar.php'; ?>
    <!-- End navbar -->

    <!-- Content -->
    <div class="content">
        <form action="../search.php" method="GET">
            <input type="text" id="keyword" name="keyword" placeholder="Variant of product here .." minlength="2" required>
            <input type="submit" value="Submit">
        </form>


    </div>
    <!-- end content -->


    <!-- Footer -->
    <?php include 'partials/footer.php'; ?>
    <!-- End Footer -->

</body>

</html>