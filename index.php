<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/style.css">

    <title>Destinote</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #D2D4D8;">
        <div class="container-fluid px-5">
            <a class="navbar-brand fw-bold fs-3" href="destinations.php">
                <img src="images/destinote_logo.png" alt="Destinote Logo" width="40" height="40"
                    class="d-inline-block align-text-top">
                Destinote
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false">
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
                    <button class="btn btn-outline-* btn-signin fw-semibold text-black me-4" data-bs-toggle="modal"
                        data-bs-target="#signInModal">Sign In</button>
                    <button class="btn btn-primary fw-semibold" data-bs-toggle="modal" data-bs-target="#signUpModal">Get
                        Started</button>
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
            <button class="btn" data-bs-toggle="modal" data-bs-target="#signInModal" id="start-journey-btn">
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
                <button class="btn btn-light btn-lg fw-semibold" data-bs-toggle="modal"
                    data-bs-target="#signUpModal">Get Started Free</button>
            </div>
        </div>
    </section>

    <div class="modal fade" data-bs-backdrop="static" tabindex="-1" id="signInModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Welcome to Destinote!</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <h2 class="text-center fs-5 mb-3">Sign in to your account</h2>
                    <div id="signinMessage" class="alert d-none text-center" role="alert"></div>
                    <form action="includes/signin_process.php" method="POST" class="fw-medium">
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" name="email_address" class="form-control" placeholder="Enter your email"
                                required>
                            <label class="form-label mt-3">Password</label>
                            <input type="password" name="password" class="form-control"
                                placeholder="Enter your password" required>
                        </div>
                        <div class="d-grid my-2">
                            <button type="submit" class="btn btn-primary">Sign In</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" data-bs-backdrop="static" tabindex="-1" id="signUpModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Welcome to Destinote!</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <h2 class="text-center fs-5 mb-3">Create your account</h2>
                    <div id="signupMessage" class="alert d-none text-center" role="alert"></div>
                    <form action="includes/signup_process.php" method="POST" class="fw-medium">
                        <div class="mb-3">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label class="form-label">First Name</label>
                                    <input type="text" name="first_name" class="form-control" placeholder="First Name"
                                        required>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" name="last_name" class="form-control" placeholder="Last Name"
                                        required>
                                </div>
                            </div>
                            <label class="form-label">Email address</label>
                            <input type="email" name="email_address" class="form-control" placeholder="Enter your email"
                                required>
                            <label class="form-label mt-3">Password</label>
                            <input type="password" name="password" class="form-control"
                                placeholder="Enter your password" required>
                            <label class="form-label mt-3">Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control"
                                placeholder="Re-enter your password" required>
                        </div>
                        <div class="d-grid my-2">
                            <button type="submit" class="btn btn-primary">Sign Up</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="statusModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header" id="statusModalHeader">
                    <h5 class="modal-title fw-bold" id="statusModalTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body fs-5 text-center" id="statusModalMessage"></div>
            </div>
        </div>
    </div>

    <div id="signinSuccessOverlay"
        class="d-none position-fixed top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center align-items-center bg-light"
        style="z-index: 2000; opacity: 0; transition: opacity 0.8s ease;">
        <div class="text-center">
            <div class="spinner-border text-success mb-3" style="width: 4rem; height: 4rem;" role="status"></div>
            <h3 class="fw-bold text-success">Signing you in...</h3>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const params = new URLSearchParams(window.location.search);
            const status = params.get("status");
            const message = params.get("message");
            const showModal = params.get("showModal");
            const email = params.get("email");
            const redirect = params.get("redirect");

            if (showModal === "signUpModal") {
                const signUpModalEl = document.getElementById("signUpModal");
                const signUpModal = new bootstrap.Modal(signUpModalEl);
                const msgBox = document.getElementById("signupMessage");

                signUpModal.show();
                if (msgBox && status && message) {
                    msgBox.classList.remove("d-none", "alert-success", "alert-danger");
                    msgBox.classList.add("alert", status === "success" ? "alert-success" : "alert-danger");
                    msgBox.textContent = decodeURIComponent(message);

                    if (status === "success") {
                        setTimeout(() => {
                            msgBox.style.transition = "opacity 0.6s ease";
                            msgBox.style.opacity = "0";
                        }, 1500);

                        setTimeout(() => {
                            msgBox.style.display = "none";
                            signUpModal.hide();
                            const signInModalEl = document.getElementById("signInModal");
                            const signInModal = new bootstrap.Modal(signInModalEl);
                            signInModal.show();
                            const emailInput = signInModalEl.querySelector("input[name='email_address']");
                            if (emailInput) {
                                if (email) emailInput.value = decodeURIComponent(email);
                                emailInput.focus();
                            }
                        }, 2300);
                    }
                }
            }

            if (showModal === "signInModal") {
                const signInModalEl = document.getElementById("signInModal");
                const signInModal = new bootstrap.Modal(signInModalEl);
                const msgBox = document.getElementById("signinMessage");

                signInModal.show();

                if (msgBox && status && message) {
                    msgBox.classList.remove("d-none", "alert-success", "alert-danger");
                    msgBox.classList.add("alert", status === "success" ? "alert-success" : "alert-danger");
                    msgBox.textContent = decodeURIComponent(message);

                    if (status === "success" && redirect === "dashboard") {
                        setTimeout(() => {
                            signInModal.hide();

                            const overlay = document.getElementById("signinSuccessOverlay");
                            overlay.classList.remove("d-none");
                            overlay.style.opacity = "1";

                            setTimeout(() => {
                                window.location.href = "destinations.php";
                            }, 1800);
                        }, 1200);
                    }
                }

                signInModalEl.addEventListener('shown.bs.modal', function () {
                    const emailInput = signInModalEl.querySelector("input[name='email_address']");
                    if (emailInput) emailInput.focus();
                });
            }

            const cleanUrl = window.location.origin + window.location.pathname;
            window.history.replaceState({}, document.title, cleanUrl);
        });
    </script>




    <footer class="text-dark text-center py-4" style="background-color: #EDEFF0;">
        <div class="container">
            <p class="mb-0">&copy; 2025 Destinote. All rights reserved.</p>
        </div>
    </footer>


</body>

</html>