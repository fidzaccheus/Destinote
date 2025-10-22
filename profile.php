<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

include_once 'includes/db_connect.php';

$user_id = $_SESSION['id'];

// Fetch user info
$sql = "SELECT first_name, last_name, email_address, password FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "<p class='text-danger text-center mt-5'>User not found.</p>";
    exit();
}

// Fetch destinations stats
$sql_total = "SELECT COUNT(*) AS total FROM destinations WHERE user_id = ?";
$stmt_total = $conn->prepare($sql_total);
$stmt_total->bind_param("i", $user_id);
$stmt_total->execute();
$total_destinations = $stmt_total->get_result()->fetch_assoc()['total'] ?? 0;

$sql_completed = "SELECT COUNT(*) AS completed FROM destinations WHERE user_id = ? AND status='Completed'";
$stmt_completed = $conn->prepare($sql_completed);
$stmt_completed->bind_param("i", $user_id);
$stmt_completed->execute();
$completed = $stmt_completed->get_result()->fetch_assoc()['completed'] ?? 0;

$sql_planned = "SELECT COUNT(*) AS planned FROM destinations WHERE user_id = ? AND status='Noted'";
$stmt_planned = $conn->prepare($sql_planned);
$stmt_planned->bind_param("i", $user_id);
$stmt_planned->execute();
$planned = $stmt_planned->get_result()->fetch_assoc()['planned'] ?? 0;

$remaining = max(0, $total_destinations - ($completed + $planned));

// Progress percentages
$completed_percent = $total_destinations > 0 ? round(($completed / $total_destinations) * 100) : 0;
$planned_percent = $total_destinations > 0 ? round(($planned / $total_destinations) * 100) : 0;
$remaining_percent = 100 - ($completed_percent + $planned_percent);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/style.css">
    <title>Destinote - Profile</title>
</head>

<body class="d-flex flex-column min-vh-100 pt-5">

    <nav class="navbar navbar-expand-lg bg-white navbar-shadow fixed-top w-100">
        <div class="container d-flex justify-content-between align-items-center pe-3">
            <a class="navbar-brand fw-bold fs-3" href="#">
                <img src="images/destinote_logo.png" alt="Destinote Logo" width="40" height="40"
                    class="d-inline-block align-text-top"> Destinote
            </a>
            <a class="nav-link text-dark fs-5 fw-bold" href="destinations.php">Destinations Dashboard</a>
            <div>
                <a href="profile.php"><button class="btn btn-outline-transparent me-2 fw-semibold"><i
                            class="bi bi-person-fill fst-normal fs-5">Profile</i></button></a>
                <a href="includes/signout_process.php" class="btn btn-primary fw-semibold" id="signOutBtn">Sign out</a>
            </div>
        </div>
    </nav>

    <section class="container my-5">
        <h1>My Profile</h1>
        <p class="text-secondary">Manage your account and track your travel dreams</p>

        <!-- User Card -->
        <div class="card border-dark mb-4 shadow">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="position-relative me-3">
                        <div class="rounded-circle bg-primary bg-gradient text-white d-flex justify-content-center align-items-center"
                            style="width: 80px; height: 80px; font-size: 24px; font-weight: 600;">
                            <?php
                            $initials = strtoupper(substr($user['first_name'], 0, 1) . substr($user['last_name'], 0, 1));
                            echo $initials;
                            ?>
                        </div>
                        <button class="btn btn-sm btn-light position-absolute bottom-0 end-0 rounded-circle">
                            <i class="bi bi-camera"></i>
                        </button>
                    </div>
                    <div>
                        <h5 class="mb-1"><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></h5>
                        <p class="text-muted mb-0"><?= htmlspecialchars($user['email_address']); ?></p>
                    </div>
                </div>
            </div>
        </div>


        <!-- Travel Progress Tracker -->
        <div class="card mb-4 shadow">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-graph-up"></i> Travel Progress Tracker</h5>
                <p class="text-muted">Your journey to dream destinations</p>
                <div class="progress mb-3" style="height: 12px;">
                    <?php if ($completed_percent > 0): ?>
                        <div class="progress-bar bg-success" style="width: <?= $completed_percent ?>%"></div><?php endif; ?>
                    <?php if ($planned_percent > 0): ?>
                        <div class="progress-bar bg-warning" style="width: <?= $planned_percent ?>%"></div><?php endif; ?>
                    <?php if ($remaining_percent > 0): ?>
                        <div class="progress-bar bg-secondary" style="width: <?= $remaining_percent ?>%"></div>
                    <?php endif; ?>
                </div>
                <div class="d-flex justify-content-between text-center">
                    <div>
                        <h5 class="text-primary"><?= $total_destinations ?></h5>
                        <p class="text-muted">Total Destinations</p>
                    </div>
                    <div>
                        <h5 class="text-success"><?= $completed ?></h5>
                        <p class="text-muted">Completed</p>
                    </div>
                    <div>
                        <h5 class="text-warning"><?= $planned ?></h5>
                        <p class="text-muted">Noted / Planned</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs: Personal Info & Password -->
        <div class="card shadow">
            <div class="card-body">
                <ul class="nav nav-tabs w-100" id="profileTabs" role="tablist">
                    <li class="nav-item flex-fill text-center" role="presentation">
                        <button class="nav-link active w-100" id="info-tab" data-bs-toggle="tab" data-bs-target="#info"
                            type="button" role="tab" aria-controls="info" aria-selected="true">Personal Information
                        </button>
                    </li>
                    <li class="nav-item flex-fill text-center" role="presentation">
                        <button class="nav-link w-100" id="security-tab" data-bs-toggle="tab" data-bs-target="#security"
                            type="button" role="tab" aria-controls="security" aria-selected="false">Security
                        </button>
                    </li>
                </ul>
                <div class="tab-content mt-4 w-100" id="profileTabsContent">
                    <!-- Personal Info -->
                    <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                        <h5 class="fw-bold">Personal Information</h5>
                        <p class="text-muted">Your account details.</p>
                        <form>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control"
                                        value="<?= htmlspecialchars($user['first_name']); ?>" disabled readonly>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control"
                                        value="<?= htmlspecialchars($user['last_name']); ?>" disabled readonly>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" class="form-control"
                                    value="<?= htmlspecialchars($user['email_address']); ?>" disabled readonly>
                            </div>
                        </form>
                    </div>

                    <!-- Security / Password Update -->
                    <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                        <h5 class="fw-bold">Change Password</h5>
                        <p class="text-muted">Ensure your account is using a strong password.</p>
                        <div id="securityAlert"></div>
                        <form action="includes/update_password_process.php" method="POST">
                            <div class="mb-3">
                                <label class="form-label">Current Password</label>
                                <input type="password" class="form-control" name="current_password" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">New Password</label>
                                <input type="password" class="form-control" name="new_password" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" name="confirm_password" required>
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

    <div id="signoutOverlay"
        class="position-fixed top-0 start-0 w-100 h-100 d-none bg-dark bg-opacity-75 d-flex justify-content-center align-items-center"
        style="z-index: 1050; transition: opacity 0.5s;">
        <div class="text-center text-white">
            <div class="spinner-border text-light mb-3" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <h5>Signing out...</h5>
        </div>
    </div>


    <footer class="text-dark text-center py-4 mt-auto" style="background-color: #EDEFF0;">
        <div class="container">
            <p class="mb-0">&copy; 2025 Destinote. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const signOutBtn = document.getElementById("signOutBtn");
            const overlay = document.getElementById("signoutOverlay");

            if (signOutBtn && overlay) {
                signOutBtn.addEventListener("click", function (e) {
                    e.preventDefault();

                    overlay.classList.remove("d-none");
                    overlay.style.opacity = "1";

                    setTimeout(() => {
                        window.location.href = signOutBtn.getAttribute("href");
                    }, 1000);
                });
            }

            const params = new URLSearchParams(window.location.search);
            const tab = params.get("tab");
            const status = params.get("status");
            const message = params.get("message");

            if (tab === "security") {
                const trigger = document.querySelector('#security-tab');
                const tabObj = new bootstrap.Tab(trigger);
                tabObj.show();
            }

            if (status && message) {
                const alertContainer = document.getElementById("securityAlert");
                if (alertContainer) {
                    alertContainer.innerHTML = `
                        <div class="alert alert-${status === "success" ? "success" : "danger"} alert-dismissible fade show" role="alert">
                            ${decodeURIComponent(message)}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>`;
                }

                const cleanUrl = window.location.origin + window.location.pathname;
                window.history.replaceState({}, document.title, cleanUrl);
            }
        });
    </script>

</body>

</html>