<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/CSS/style.css">
    <title>Destinote</title>
</head>

<body class="d-flex flex-column min-vh-100 pt-5">

    <nav class="navbar navbar-expand-lg bg-white navbar-shadow fixed-top w-100">
        <div class="container d-flex justify-content-between align-items-center pe-3">
            <a class="navbar-brand fw-bold fs-3" href="#">
                <img src="images/destinote_logo.png" alt="Destinote Logo" width="40" height="40"
                    class="d-inline-block align-text-top">
                Destinote
            </a>
            <a class="nav-link text-dark fs-5 fw-bold" href="index.php">Destinations Dashboard</a>
            <div>
                <button class="btn btn-outline-transparent me-2 fw-semibold"><i
                        class="bi bi-person-fill fst-normal fs-5">
                        Profile</i></button>
                <button class="btn btn-primary fw-semibold">Sign out</button>
            </div>
        </div>
    </nav>

    <section class="container-fluid my-5">
        <div class="row justify-content-center">
            <div class="col-7">
                <h1>Destinations</h1>
                <p class="text-secondary">Explore and manage amazing travel destinations</p>
                <form class="row" action="">
                    <div class="col-10">
                        <input type="text" class="form-control mb-3" placeholder="Search destinations...">
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-primary btn-sm fs-5">Add destination</button>
                    </div>

                </form>
            </div>
        </div>

    </section>

    <footer class="text-dark text-center py-4 mt-auto" style="background-color: #EDEFF0;">
        <div class="container">
            <p class="mb-0">&copy; 2025 Destinote. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>