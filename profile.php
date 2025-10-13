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

<body class="d-flex flex-column min-vh-100 pt-5">

    <nav class="navbar navbar-expand-lg bg-white navbar-shadow fixed-top w-100">
        <div class="container d-flex justify-content-between align-items-center pe-3">
            <a class="navbar-brand fw-bold fs-3" href="#">
                <img src="images/destinote_logo.png" alt="Destinote Logo" width="40" height="40"
                    class="d-inline-block align-text-top">
                Destinote
            </a>
            <a class="nav-link text-dark fs-5 fw-bold" href="destinations.php">Destinations Dashboard</a>
            <div>
                <a href="profile.php"><button class="btn btn-outline-transparent me-2 fw-semibold"><i
                            class="bi bi-person-fill fst-normal fs-5">Profile</i></button></a>
                <button class="btn btn-primary fw-semibold">Sign out</button>
            </div>
        </div>
    </nav>

    <section class="container my-5">
        <div class="mb-4">
            <h1>My Profile</h1>
            <p class="text-secondary">Manage your account and track your travel dreams</p>
            <div>
                <div class="card border-dark mb-4 shadow">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="position-relative me-3">
                                <div class="rounded-circle bg-primary bg-gradient text-white d-flex justify-content-center align-items-center"
                                    style="width: 80px; height: 80px; font-size: 24px; font-weight: 600;">
                                    JD
                                </div>
                                <button class="btn btn-sm btn-light position-absolute bottom-0 end-0 rounded-circle">
                                    <i class="bi bi-camera"></i>
                                </button>
                            </div>
                            <div>
                                <h5 class="mb-1">John Doe</h5>
                                <p class="text-muted mb-0">john.doe@example.com</p>
                            </div>
                        </div>
                        <button class="btn btn-outline-primary">Edit Profile</button>
                    </div>
                </div>
                <div class="card mb-4 shadow">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-graph-up"></i> Travel Progress Tracker</h5>
                        <p class="text-muted">Your journey to dream destinations</p>
                        <div class="progress mb-3" style="height: 8px;">
                            <div class="progress-bar bg-info" style="width: 33%;"></div>
                        </div>
                        <div class="d-flex justify-content-between text-center">
                            <div>
                                <h5 class="text-primary">24</h5>
                                <p class="text-muted">Total Destinations</p>
                            </div>
                            <div>
                                <h5 class="text-success">8</h5>
                                <p class="text-muted">Completed</p>
                            </div>
                            <div>
                                <h5 class="text-warning">4</h5>
                                <p class="text-muted">Planned</p>
                            </div>
                            <div>
                                <h5 class="text-secondary">12</h5>
                                <p class="text-muted">Dreams</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow">
                    <div class="card-body">
                        <ul class="nav nav-tabs w-100" id="profileTabs" role="tablist">
                            <li class="nav-item flex-fill text-center" role="presentation">
                                <button class="nav-link active w-100" id="info-tab" data-bs-toggle="tab"
                                    data-bs-target="#info" type="button" role="tab" aria-controls="info"
                                    aria-selected="true">
                                    Personal Information
                                </button>
                            </li>
                            <li class="nav-item flex-fill text-center" role="presentation">
                                <button class="nav-link w-100" id="security-tab" data-bs-toggle="tab"
                                    data-bs-target="#security" type="button" role="tab" aria-controls="security"
                                    aria-selected="false">
                                    Security
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content mt-4 w-100" id="profileTabsContent">
                            <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                                <h5 class="fw-bold">Personal Information</h5>
                                <p class="text-muted">Update your personal details and contact information.</p>
                                <form>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">First Name</label>
                                            <input type="text" class="form-control" value="John" disabled readonly>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Last Name</label>
                                            <input type="text" class="form-control" value="Doe" disabled readonly>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email Address</label>
                                        <input type="email" class="form-control" value="john.doe@example.com" disabled
                                            readonly>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                                <h5 class="fw-bold">Change Password</h5>
                                <p class="text-muted">Ensure your account is using a strong password.</p>
                                <form>
                                    <div class="mb-3">
                                        <label class="form-label">Current Password</label>
                                        <input type="password" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">New Password</label>
                                        <input type="password" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Confirm New Password</label>
                                        <input type="password" class="form-control">
                                    </div>
                                    <button class="btn btn-primary w-100" type="submit">
                                        <i class="bi bi-lock-fill me-2"></i> Update Password
                                    </button>
                                </form>
                            </div>
                        </div>
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