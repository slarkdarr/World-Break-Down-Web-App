<nav>
    <ul>
        <li><a href="/register">Home</a></li>
        <li><a href="../Views/LogActivities.php">Log Activities</a></li>
        <li style="float:right"><a class="active" href="../Middlewares/logout.php">Logout</a></li>
        <li style="float:right">
            <div class="search-container">
                <form action="../search.php" method="GET">
                <input type="text" id="keyword" name="keyword" placeholder="Variant of product here .." minlength="2" required>
                <button type="submit" id="search-button">Submit</button>
                </form>
            </div>
        </li>
    </ul>
</nav>
