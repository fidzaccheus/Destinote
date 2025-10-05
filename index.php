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

<body>

    <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #D2D4D8;">
        <div class="container-fluid px-5">
            <a class="navbar-brand fw-bold fs-3" href="#">
                <img src="images/destinote_logo.png" alt="Destinote Logo" width="40" height="40"
                    class="d-inline-block align-text-top">
                Destinote
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav mx-auto fs-5">
                    <li class="nav-item"><a class="nav-link text-black px-3" href="#features">Features</a></li>
                    <li class="nav-item"><a class="nav-link text-black px-3" href="#how-it-works">How It Works</a></li>
                    <li class="nav-item"><a class="nav-link text-black px-3" href="#">About</a></li>
                </ul>
                <div
                    class="d-flex flex-lg-row flex-column align-items-lg-center align-items-stretch fs-5 pe-5 gap-2 mt-3 mt-lg-0">
                    <a href="login.html" class="btn btn-outline-* btn-signin fw-semibold text-black me-4">Sign In</a>
                    <a href="register.html" class="btn btn-primary fw-semibold">Get Started</a>
                </div>
            </div>
        </div>
    </nav>

    <section class="hero-section">
        <div class="hero-overlay d-flex flex-column justify-content-center align-items-center text-center">
            <span><img src="images/destinote_logo.png" alt="Destinote Logo" width="80" height="80"
                    class="floating-logo">
            </span>
            <h1 class="text-white display-2 fw-bold">Destinote</h1>
            <p class="text-white mb-4">Dream it. Note it. Live it.</p>
            <p class="text-white fs-4 mb-4">
                Your private space to track, organize, and conquer your dream travel destinations.
            </p>
            <button class="btn start-journey-btn">
                <i class="bi bi-geo-alt-fill me-2"></i>
                Start Your Journey
            </button>
        </div>
    </section>

    <section class="container my-5" id="features">
        <h2 class="text-center display-4 fw-bold pt-5 pb-2">Everything You Need</h2>
        <p class="text-center text-secondary fs-5 mb-5">Powerful features to help you organize and track your travel
            dreams
        </p>
        <div class="row pt-5 gx-5">
            <div class="col-lg-3 mb-4">
                <div class="card h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-bottom justify-content-center bg-info text-white rounded-3 mx-auto my-4"
                            style="width: 60px; height: 60px;"><i class="bi bi-geo-alt-fill fs-1 mb-3"></i>
                        </div>
                        <h3 class="card-title fs-4 mb-3">Track Destinations</h3>
                        <p class="card-text text-secondary">Add your dream destinations with detailed information,
                            photos, and
                            categorize them by type - beaches, mountains, cities, and more.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-4">
                <div class="card h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-bottom justify-content-center bg-success text-white rounded-3 mx-auto my-4"
                            style="width: 60px; height: 60px;"><i class="bi bi-flag-fill fs-1 mb-3"></i>
                        </div>
                        <h3 class="card-title fs-4 mb-3">Mark Your Progress</h3>
                        <p class="card-text text-secondary">Track your travel journey from dream to reality. Mark
                            destinations as
                            dreaming, planned, or completed and celebrate your achievements.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-bottom justify-content-center bg-warning text-white rounded-3 mx-auto my-4"
                            style="width: 60px; height: 60px;"><i class="bi bi-bar-chart-fill fs-1 mb-3"></i>
                        </div>
                        <h3 class="card-title fs-4 mb-3">Visualize Your Journey</h3>
                        <p class="card-text text-secondary">See your progress at a glance with beautiful visualizations
                            showing how
                            many destinations you've conquered and what's next.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-bottom justify-content-center bg-danger text-white rounded-3 mx-auto my-4"
                            style="width: 60px; height: 60px;"><i class="bi bi-shield-lock-fill fs-1 mb-3"></i>
                        </div>
                        <h3 class="card-title fs-4 mb-3">Private & Secure</h3>
                        <p class="card-text text-secondary">Your travel dreams are yours alone. All your
                            destinations and plans
                            are
                            completely private and secure, accessible only by you.</p>
                    </div>
                </div>
            </div>
    </section>



    <section class="container-fluid bg-white pb-5 mt-5" id="how-it-works">
        <div class="container">
            <h2 class="text-center display-4 fw-bold pt-5 pb-2">How It Works</h2>
            <p class="text-center text-secondary fs-5 mb-5">Three simple steps to start tracking your travel dreams</p>
            <div class="row text-center justify-content-center gx-5">
                <div class="col-4">
                    <div class="d-flex align-items-center justify-content-center bg-info text-white rounded-circle mx-auto my-4"
                        style="width: 80px; height: 80px; box-shadow: 0 0 15px rgba(0, 191, 255, 0.6)">
                        <i class="bi bi-person-plus display-5"></i>
                    </div>
                    <h3 class="mb-3">Create Your Account</h3>
                    <p class="text-secondary">Sign up in seconds and start building your personal travel collection.
                    </p>
                </div>
                <div class="col-4">
                    <div class="d-flex align-items-center justify-content-center bg-info text-white rounded-circle mx-auto my-4"
                        style="width: 80px; height: 80px; box-shadow: 0 0 15px rgba(0, 191, 255, 0.6)">
                        <i class="bi bi-geo-alt display-5"></i>
                    </div>
                    <h3 class="mb-3">Add Destinations</h3>
                    <p class="text-secondary">Add places you dream of visiting with photos, categories, and
                        details.
                    </p>
                </div>
                <div class="col-4">
                    <div class="d-flex align-items-center justify-content-center bg-info text-white rounded-circle mx-auto my-4"
                        style="width: 80px; height: 80px; box-shadow: 0 0 15px rgba(0, 191, 255, 0.6)">
                        <i class="bi bi-bullseye display-5"></i>
                    </div>
                    <h3 class="mb-3">Track & Achieve</h3>
                    <p class="text-secondary">Mark destinations as planned or completed and watch your progress
                        grow.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="container-fluid cust-gradient text-white py-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-4 text-center">
                <i class="bi bi-airplane floating-logo display-5"></i>
                <h2 class="display-4 fw-bold pt-5 pb-2">Ready to Start Your Adventure?</h2>
                <p class="fs-5 mb-5">Join Destinote today and turn your travel dreams into reality.
                    Create your private collection of dream destinations and track your journey around the world.</p>
                <button class="btn btn-light btn-lg fw-semibold">Get Started Free</button>
            </div>
        </div>
    </section>

    <footer class="text-dark text-center py-4" style="background-color: #EDEFF0;">
        <div class="container">
            <p class="mb-0">&copy; 2025 Destinote. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>