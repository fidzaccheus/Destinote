<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/style.css">
    <title>Destinote Dashboard</title>
</head>

<body class="d-flex flex-column min-vh-100 pt-5">

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
                <a href="includes/signout_process.php" class="btn btn-primary fw-semibold" id="signOutBtn">Sign out</a>
            </div>
        </div>
    </nav>

    <section class="container my-5">
        <div class="text-center mb-4">
            <h1 class="fw-bold">Destinations</h1>
            <p class="text-secondary">Explore and manage your travel plans and dream destinations.</p>
        </div>

        <div class="row justify-content-center mb-4">
            <div class="col-md-8">
                <form class="row g-2 align-items-center">
                    <div class="col-md-9">
                        <input type="text" class="form-control" placeholder="Search destinations...">
                    </div>
                    <div class="col-md-3 text-md-end text-center">
                        <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal"
                            data-bs-target="#addDestinationModal">
                            <i class="bi bi-plus-circle me-2"></i> Add Destination
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- ===== DISPLAY EXISTING DESTINATIONS ===== -->
        <?php
        include_once 'includes/db_connect.php';
        $user_id = $_SESSION['id'] ?? null;

        if ($user_id) {
            $sql = "SELECT * FROM destinations WHERE user_id = ? ORDER BY created_at DESC";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0) {
                echo '<div class="row g-4 mt-4">';

                while ($row = $result->fetch_assoc()) {
                    $id = (int) $row['id'];
                    $name = htmlspecialchars($row['destination_name']);
                    $country = htmlspecialchars($row['country']);
                    $city = htmlspecialchars($row['city']);
                    $tag = htmlspecialchars($row['tag']);
                    $description = nl2br(htmlspecialchars($row['description']));
                    $budget = !empty($row['budget']) ? '₱' . number_format($row['budget']) : '—';
                    $date = !empty($row['travel_date']) ? htmlspecialchars($row['travel_date']) : 'Not set';
                    $created = htmlspecialchars($row['created_at']);
                    $status = htmlspecialchars($row['status'] ?? 'Noted');
                    $statusBadge = $status === 'Completed' ? '<span class="badge bg-success">Completed</span>'
                        : '<span class="badge bg-secondary">Noted</span>';
                    $completeButton = '';
                    if ($status === 'Noted') {
                        $completeButton = "
                        <a href='includes/mark_complete.php?id={$id}' class='btn btn-sm btn-success'>
                            <i class='bi bi-check-circle'></i> Mark as Completed
                        </a>";
                    }

                    echo <<<HTML
                    <div class="col-md-4">
                        <div class="card destination-card border-0 shadow-lg h-100 overflow-hidden">
                            <img src="includes/view_image.php?id={$id}" class="card-img-top" alt="{$name}" style="height:220px; object-fit:cover;">
                            <div class="position-absolute top-0 start-0 m-2 d-flex align-items-center gap-1">
                                <span class="badge bg-primary">{$tag}</span>
                                {$statusBadge}
                            </div>
                            <div class="card-body">
                                <h5 class="card-title fw-bold mb-1">{$name}</h5>
                                <p class="text-secondary mb-2"><i class="bi bi-geo-alt"></i> {$city}, {$country}</p>
                                <p class="card-text small text-muted mb-3">{$description}</p>
                                <ul class="list-unstyled small text-dark">
                                    <li><strong>Budget:</strong> {$budget}</li>
                                    <li><strong>Travel Date:</strong> {$date}</li>
                                    <li><small class="text-muted">Created: {$created}</small></li>
                                </ul>
                            </div>
                            <div class="card-footer bg-white border-top-0 d-flex justify-content-between align-items-center">
                                <div class="d-flex gap-2">
                                    {$completeButton}
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editDestinationModal{$id}">
                                        <i class="bi bi-pencil"></i> Edit
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#deleteConfirmModal" 
                                        data-delete-url="includes/delete_destination_process.php?id={$id}">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editDestinationModal{$id}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content border-0 shadow">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title fw-bold">Edit Destination</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="includes/edit_destination_process.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="{$id}">
                                    <div class="modal-body p-4">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Destination Name</label>
                                                <input type="text" name="destination_name" class="form-control" value="{$name}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Country</label>
                                                <input type="text" name="country" class="form-control" value="{$country}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">City</label>
                                                <input type="text" name="city" class="form-control" value="{$city}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Travel Date</label>
                                                <input type="date" name="travel_date" class="form-control travel-date" value="{$row['travel_date']}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Estimated Budget (PHP)</label>
                                                <input type="number" name="budget" class="form-control" value="{$row['budget']}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Category / Tag</label>
                                                <select class="form-select" name="tag">
                                                <option value="Beach" <?php if ($tag == 'Beach') echo 'selected'; ?>Beach</option>
                                                <option value="Mountain" <?php if ($tag == 'Mountain') echo 'selected'; ?>Mountain</option>
                                                <option value="City" <?php if ($tag == 'City') echo 'selected'; ?>City</option>
                                                <option value="Adventure" <?php if ($tag == 'Adventure') echo 'selected'; ?>Adventure</option>
                                                <option value="Cultural" <?php if ($tag == 'Cultural') echo 'selected'; ?>Cultural</option>
                                                <option value="Relaxation" <?php if ($tag == 'Relaxation') echo 'selected'; ?>Relaxation</option>
                                            </select>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label fw-semibold">Description</label>
                                                <textarea name="description" class="form-control" rows="3">{$row['description']}</textarea>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label fw-semibold">Change Image</label>
                                                <input type="file" name="image" class="form-control" accept="image/*">
                                                <small class="text-muted">Leave blank to keep current image.</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary fw-semibold">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                HTML;
                }
                echo '</div>';
            } else {
                echo '
                <div class="text-center mt-5 text-secondary">
                    <i class="bi bi-map fs-1 d-block mb-2"></i>
                    <p class="fs-5">You haven’t added any destinations yet. Start by clicking <strong>“Add Destination”</strong>.</p>
                </div>';
            }
            $stmt->close();
        }
        ?>
    </section>

    <div class="modal fade" data-bs-backdrop="static" tabindex="-1" aria-hidden="true" id="addDestinationModal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold">Add a New Destination</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <form action="includes/add_destination_process.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Destination Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="destination_name" class="form-control"
                                    placeholder="e.g. Mountain Fuji" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Country <span class="text-danger">*</span></label>
                                <input type="text" name="country" class="form-control" placeholder="e.g. Japan"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">City</label>
                                <input type="text" name="city" class="form-control" placeholder="e.g. Tokyo">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Travel Date<span
                                        class="text-danger">*</span></label>
                                <input type="date" name="travel_date" class="form-control travel-date" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Estimated Budget (PHP)<span
                                        class="text-danger">*</span></label>
                                <input type="number" name="budget" class="form-control" placeholder="e.g. 50000"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Category / Tag</label>
                                <select class="form-select" name="tag">
                                    <option value="" selected>Select a tag</option>
                                    <option value="Beach">Beach</option>
                                    <option value="Mountain">Mountain</option>
                                    <option value="City">City</option>
                                    <option value="Adventure">Adventure</option>
                                    <option value="Cultural">Cultural</option>
                                    <option value="Relaxation">Relaxation</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Description</label>
                                <textarea name="description" class="form-control" rows="3"
                                    placeholder="Describe your travel goals..."></textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Upload Image</label>
                                <input type="file" name="image" id="destinationImage" class="form-control"
                                    accept="image/*">
                                <div class="text-center mt-3">
                                    <img id="imagePreview" src="#" alt="Preview"
                                        class="img-fluid rounded shadow-sm d-none"
                                        style="max-height: 200px; object-fit: cover;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary fw-semibold">Add Destination</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title fw-bold"><i class="bi bi-exclamation-triangle-fill me-2"></i>Confirm Deletion
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body fs-5 text-center">
                    Are you sure you want to delete this destination? <br>
                    This action <strong>cannot be undone</strong>.
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a href="#" id="confirmDeleteBtn" class="btn btn-danger px-4 fw-semibold">Delete</a>
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
            const imgInput = document.getElementById("destinationImage");
            if (imgInput) {
                imgInput.addEventListener("change", function (event) {
                    const [file] = event.target.files;
                    const preview = document.getElementById("imagePreview");
                    if (file) {
                        preview.src = URL.createObjectURL(file);
                        preview.classList.remove("d-none");
                        preview.style.opacity = "1";
                    } else {
                        preview.classList.add("d-none");
                    }
                });
            }

            const deleteModal = document.getElementById("deleteConfirmModal");
            const confirmDeleteBtn = document.getElementById("confirmDeleteBtn");
            if (deleteModal && confirmDeleteBtn) {
                deleteModal.addEventListener("show.bs.modal", function (event) {
                    const button = event.relatedTarget;
                    const deleteUrl = button.getAttribute("data-delete-url");
                    confirmDeleteBtn.setAttribute("href", deleteUrl);
                });
            }

            const today = new Date().toISOString().split("T")[0];
            document.querySelectorAll(".travel-date").forEach(input => {
                input.setAttribute("min", today);
            });

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
        });
    </script>
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
        });
    </script>



</body>

</html>