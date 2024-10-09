<?php
include("header.php");
include("../DB/conn.php");
session_start();
// Delete category
if (isset($_GET['D_id'])) {
    $Delete_id = $_GET['D_id'];
    $query = "DELETE FROM category WHERE category_id = $Delete_id";
    $result = mysqli_query($connect, $query);
}

// Initialize search term
$search = '';
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($connect, $_GET['search']);
}

// Pagination setup
$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Modify the query to include search functionality and pagination
$query = "SELECT * FROM category";
if ($search) {
    $query .= " WHERE category_name LIKE '%$search%'";
}
$query .= " LIMIT $limit OFFSET $offset";

$data = mysqli_query($connect, $query);

// Get total number of categories for pagination
$total_query = "SELECT COUNT(*) as total FROM category";
if ($search) {
    $total_query .= " WHERE category_name LIKE '%$search%'";
}
$total_result = mysqli_query($connect, $total_query);
$total_row = mysqli_fetch_assoc($total_result);
$total_categories = $total_row['total'];

// Calculate total pages
$total_pages = ceil($total_categories / $limit);

if (!$data) {
    die("Failed to get Category: " . mysqli_error($connect));
}
?>

<div class="bg-secondary p-4">
    <div class="container-fluid">
        <div class="row shadow bg-white">
            <div class="col-md-12 p-3">
                <div>
                    <h4 class="float-start">Category List</h4>
                    <a href="add_category.php" class="btn btn-sm btn-success float-end"><i class="fa-solid fa-plus"></i> Add Category</a>
                </div>
            </div>
            <hr>
            <div class="col-md-12">
                <div class="float-end">
                    <form action="" method="get">
                        <label for="search" class="hi">Search :</label>
                        <input type="text" name="search" class="search_inp" value="<?= htmlspecialchars($search) ?>">
                    </form>
                </div>
                <table class="table table-bordered table-striped table-hover mt-5">
                    <thead>
                        <tr>
                            <th scope="col">SN</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($data) > 0) {
                            foreach ($data as $key => $row) {
                        ?>
                                <tr>
                                    <th scope="row"><?= $offset + $key + 1 ?></th>
                                    <td><?= htmlspecialchars($row['category_name']) ?></td>
                                    <td><?= htmlspecialchars($row['category_status']) ?></td>
                                    <td>
                                        <a href="edit_category.php?id=<?= $row['category_id']; ?>" class="text-decoration-none">
                                            <i class="fa-solid fa-pen-to-square text-success"></i>
                                        </a>
                                        <a href="category_list.php?D_id=<?= $row['category_id']; ?>" class="text-decoration-none">
                                            <i class="fa-solid fa-trash text-danger"></i>
                                        </a>
                                    </td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='4' class='text-center'>No categories found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <div class="d-flex justify-content-between">
                    <!-- Total Entries Display -->
                    <div class="text-start mb-3">
                        <p>Total Entries: <?= $total_categories ?></p>
                    </div>
                    <!-- Pagination Links -->
                    <nav>
                        <ul class="pagination justify-content-end">
                            <?php if ($page > 1) : ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?= $page - 1 ?>&search=<?= urlencode($search) ?>">Previous</a>
                                </li>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                                <li class="page-item <?= ($i === $page) ? 'active' : '' ?>">
                                    <a class="page-link" href="?page=<?= $i ?>&search=<?= urlencode($search) ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>

                            <?php if ($page < $total_pages) : ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?= $page + 1 ?>&search=<?= urlencode($search) ?>">Next</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include("footer.php");
?>