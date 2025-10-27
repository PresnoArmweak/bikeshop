<?php
    require __DIR__ . DIRECTORY_SEPARATOR . "bootstrapcdnlinks.php";
?>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-link" aria-current="page" href="?report=available">Available Bikes</a>
            <a class="nav-link" aria-current="page" href="?report=top3">Top 3 Bikes by Hourly Rate</a>
            <a class="nav-link" aria-current="page" href="?report=open">Open Rentals</a>
            <a class="nav-link" aria-current="page" href="?report=multi">Rentals + Customers + Bikes (JOIN)</a>
            <a class="nav-link" aria-current="page" href="?report=customers">All Customers (sorted by last, first)</a>
            <a class="nav-link" aria-current="page" href="?report=completed">Completed Rentals</a>
        </div>
        </div>
    </div>
    </nav>