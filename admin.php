<?php
session_start();
include('includes/db_connect.php');

if (isset($_SESSION['email_address'])) {
    if ($_SESSION['email_address'] !== 'admin@destinote.com') {
        header("Location: index.php?status=error&message=Access%20denied.");
        exit();
    }
}

// Handle filters and searches
$search_dest = $_GET['search_dest'] ?? '';
$filter_tag = $_GET['tag'] ?? '';
$search_user = $_GET['search_user'] ?? '';

// === DESTINATIONS QUERY ===
$sql_dest = "SELECT d.id, d.destination_name, d.country, d.city, d.tag, d.created_at, 
                    u.first_name, u.last_name, u.email_address
             FROM destinations d
             JOIN users u ON d.user_id = u.id
             WHERE 1";

$params = [];
$types = '';

if (!empty($search_dest)) {
    $sql_dest .= " AND (d.destination_name LIKE ? OR u.first_name LIKE ? OR u.last_name LIKE ?)";
    $like = "%$search_dest%";
    $params[] = &$like;
    $params[] = &$like;
    $params[] = &$like;
    $types .= 'sss';
}
if (!empty($filter_tag)) {
    $sql_dest .= " AND d.tag = ?";
    $params[] = &$filter_tag;
    $types .= 's';
}

$sql_dest .= " ORDER BY d.created_at DESC";
$stmt_dest = $conn->prepare($sql_dest);

if (!empty($params)) {
    array_unshift($params, $types);
    call_user_func_array([$stmt_dest, 'bind_param'], $params);
}

$stmt_dest->execute();
$result_dest = $stmt_dest->get_result();

// === USERS QUERY ===
$sql_users = "SELECT id, first_name, last_name, email_address, created_at, status FROM users WHERE 1";
if (!empty($search_user)) {
    $sql_users .= " AND (first_name LIKE ? OR last_name LIKE ? OR email_address LIKE ?)";
    $stmt_users = $conn->prepare($sql_users);
    $like = "%$search_user%";
    $stmt_users->bind_param("sss", $like, $like, $like);
} else {
    $stmt_users = $conn->prepare($sql_users);
}
$stmt_users->execute();
$result_users = $stmt_users->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/style.css">
    <title>Admin Dashboard</title>
</head>

<body class="d-flex flex-column min-vh-100 pt-5">
    <div class="container my-5">
        <h1 class="text-center fw-bold mb-4">Admin Dashboard</h1>

        <nav class="navbar navbar-expand-lg navbar-shadow fixed-top w-100" style="background-color: #D2D4D8;">
            <div class="container-fluid px-4 d-flex justify-content-between align-items-center">
                <a class="navbar-brand fw-bold fs-3 ms-3" href="#">
                    <img src="images/destinote_logo.png" alt="Destinote Logo" width="40" height="40"
                        class="d-inline-block align-text-top me-2">
                    Destinote
                </a>
                <div class="d-flex align-items-center me-3">
                    <a href="profile.php" class="btn btn-outline-transparent me-2 fw-semibold">
                        <i class="bi bi-person-fill fs-5"></i> Profile
                    </a>
                    <a href="includes/signout.php" class="btn btn-primary fw-semibold" id="signOutBtn">Sign
                        out</a>
                </div>
            </div>
        </nav>

        <ul class="nav nav-tabs mb-4" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="destinations-tab" data-bs-toggle="tab"
                    data-bs-target="#destinations" type="button" role="tab">Destinations</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="users-tab" data-bs-toggle="tab" data-bs-target="#users" type="button"
                    role="tab">Users</button>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="destinations" role="tabpanel">
                <form method="GET" class="row g-3 mb-4">
                    <div class="col-md-5">
                        <input type="text" name="search_dest" class="form-control"
                            placeholder="Search destinations or users..." value="<?= htmlspecialchars($search_dest) ?>">
                    </div>
                    <div class="col-md-5">
                        <select name="tag" class="form-select">
                            <option value="">All Tags</option>
                            <option value="Beach" <?= $filter_tag == 'Beach' ? 'selected' : '' ?>>Beach</option>
                            <option value="Mountain" <?= $filter_tag == 'Mountain' ? 'selected' : '' ?>>Mountain</option>
                            <option value="City" <?= $filter_tag == 'City' ? 'selected' : '' ?>>City</option>
                            <option value="Adventure" <?= $filter_tag == 'Adventure' ? 'selected' : '' ?>>Adventure
                            </option>
                            <option value="Cultural" <?= $filter_tag == 'Cultural' ? 'selected' : '' ?>>Cultural</option>
                            <option value="Relaxation" <?= $filter_tag == 'Relaxation' ? 'selected' : '' ?>>Relaxation
                            </option>
                        </select>
                    </div>
                    <div class="col-md-2 d-grid">
                        <button class="btn btn-primary">Filter</button>
                    </div>
                </form>

                <div class="table-responsive bg-white rounded shadow-sm p-3">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>#</th>
                                <th>Destination</th>
                                <th>Tag</th>
                                <th>User</th>
                                <th>Email</th>
                                <th>Country</th>
                                <th>City</th>
                                <th>Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result_dest && $result_dest->num_rows > 0): ?>
                                <?php while ($row = $result_dest->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['id']) ?></td>
                                        <td><?= htmlspecialchars($row['destination_name']) ?></td>
                                        <td><span class="badge bg-primary"><?= htmlspecialchars($row['tag']) ?></span></td>
                                        <td><?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?></td>
                                        <td><?= htmlspecialchars($row['email_address']) ?></td>
                                        <td><?= htmlspecialchars($row['country']) ?></td>
                                        <td><?= htmlspecialchars($row['city']) ?></td>
                                        <td><?= htmlspecialchars($row['created_at']) ?></td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteDestModal"
                                                data-delete-url="includes/admin/delete_destination_admin.php?id=<?= $row['id'] ?>">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-3">No destinations found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ================= USERS TAB ================= -->
            <div class="tab-pane fade" id="users" role="tabpanel">
                <form method="GET" class="row g-3 mb-4">
                    <div class="col-md-10">
                        <input type="text" name="search_user" class="form-control" placeholder="Search users..."
                            value="<?= htmlspecialchars($search_user) ?>">
                    </div>
                    <div class="col-md-2 d-grid">
                        <button class="btn btn-primary">Search</button>
                    </div>
                </form>

                <div class="table-responsive bg-white rounded shadow-sm p-3">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark text-center">
                            <tr class="text-center">
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Created</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result_users && $result_users->num_rows > 0): ?>
                                <?php while ($user = $result_users->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($user['id']) ?></td>
                                        <td><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?></td>
                                        <td><?= htmlspecialchars($user['email_address']) ?></td>
                                        <td><?= htmlspecialchars($user['created_at']) ?></td>
                                        <td>
                                            <span
                                                class="badge <?= $user['status'] === 'active' ? 'bg-success' : 'bg-secondary' ?>">
                                                <?= ucfirst($user['status']) ?>
                                            </span>
                                        </td>
                                        <td class="d-flex align-items-center justify-content-center">
                                            <button class="btn btn-sm btn-outline-primary mx-4" data-bs-toggle="modal"
                                                data-bs-target="#editUserModal<?= $user['id'] ?>">
                                                <i class="bi bi-pencil"></i> Edit
                                            </button>
                                            <a href="includes/admin/toggle_user_status.php?id=<?= $user['id'] ?>&status=<?= $user['status'] ?>&tab=users"
                                                class="btn btn-sm <?= $user['status'] === 'active' ? 'btn-danger' : 'btn-success' ?>">
                                                <?= $user['status'] === 'active' ? 'Suspend' : 'Activate' ?>
                                            </a>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="editUserModal<?= $user['id'] ?>" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-0 shadow">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title fw-bold">Edit User Info</h5>
                                                    <button type="button" class="btn-close btn-close-white"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="includes/admin/edit_user.php" method="POST">
                                                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                                    <div class="modal-body p-4">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-semibold">First Name</label>
                                                            <input type="text" name="first_name" class="form-control"
                                                                value="<?= htmlspecialchars($user['first_name']) ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label fw-semibold">Last Name</label>
                                                            <input type="text" name="last_name" class="form-control"
                                                                value="<?= htmlspecialchars($user['last_name']) ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label fw-semibold">Email Address</label>
                                                            <input type="email" name="email_address" class="form-control"
                                                                value="<?= htmlspecialchars($user['email_address']) ?>"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer border-0">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary fw-semibold">Save
                                                            Changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-3">No users found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-dark text-center py-4 mt-auto" style="background-color: #EDEFF0;">
        <div class="container">
            <p class="mb-0">&copy; 2025 Destinote. All rights reserved.</p>
        </div>
    </footer>

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

    <div class="modal fade" id="deleteDestModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title fw-bold">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>Confirm Delete
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center fs-5">
                    Are you sure you want to delete this destination?<br>
                    This action <strong>cannot be undone</strong>.
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a id="confirmDeleteDestBtn" href="#" class="btn btn-danger px-4 fw-semibold">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const params = new URLSearchParams(window.location.search);
            const status = params.get("status");
            const message = params.get("message");

            if (status && message) {
                const modal = new bootstrap.Modal(document.getElementById("statusModal"));
                const header = document.getElementById("statusModalHeader");
                const title = document.getElementById("statusModalTitle");
                const body = document.getElementById("statusModalMessage");

                header.classList.remove("bg-success", "bg-danger");
                if (status === "success") {
                    header.classList.add("bg-success", "text-white");
                    title.textContent = "Success!";
                } else {
                    header.classList.add("bg-danger", "text-white");
                    title.textContent = "Error!";
                }

                body.textContent = decodeURIComponent(message);
                modal.show();

                const cleanUrl = window.location.origin + window.location.pathname;
                window.history.replaceState({}, document.title, cleanUrl);
            }
            //Keep same tab
            const activeTab = params.get("tab");

            if (activeTab) {
                const triggerEl = document.querySelector(`[data-bs-target="#${activeTab}"]`);
                if (triggerEl) {
                    new bootstrap.Tab(triggerEl).show();
                }
            }
            //Delete destination modal
            const deleteDestModal = document.getElementById("deleteDestModal");
            const confirmDeleteDestBtn = document.getElementById("confirmDeleteDestBtn");

            deleteDestModal.addEventListener("show.bs.modal", function (event) {
                const button = event.relatedTarget;
                const deleteUrl = button.getAttribute("data-delete-url");
                confirmDeleteDestBtn.setAttribute("href", deleteUrl);
            });
        });
    </script>

</body>

</html>