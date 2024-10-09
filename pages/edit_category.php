<?php
include("header.php");
include("../DB/conn.php");

// Get Category from database With ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM category WHERE category_id = $id";
    $result = mysqli_query($connect, $query);
    if (!$result) {
        die("Failed to get category: " . mysqli_error($connect));
    } else {
        $row = mysqli_fetch_array($result);
    }
}

// Update Category
if (isset($_POST['update_category'])) {
    $category_name = $_POST['category_name'];
    $category_status = $_POST['category_status'];

    $query = "UPDATE category SET category_name = '$category_name', category_status='$category_status' WHERE category_id=$id";
    $result = mysqli_query($connect, $query);
    if (!$result) {
        die("Failed to update category: " . mysqli_error($connect));
    } else {
        header("Location: category_list.php");
        exit();
    }
}
?>
<div class="bg-secondary p-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 p-3 shadow bg-white">
                <h3>Update Category</h3>
                <hr>
                <form action="edit_category.php?id=<?php echo $id; ?>" method="POST">
                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <label for="categoryName" class="float-end">Category Name <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control w-50" name="category_name" value="<?php echo htmlspecialchars($row['category_name']); ?>" placeholder="Category Name" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <label class="form-label float-end">Status <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check d-flex align-items-center">
                                <input class="form-check-input" type="radio" name="category_status" value="Active" required <?php echo ($row['category_status'] == 'Active') ? 'checked' : ''; ?>>
                                <label class="form-check-label ms-2">Active</label>
                            </div>
                            <div class="form-check d-flex align-items-center">
                                <input class="form-check-input" type="radio" name="category_status" value="InActive" required <?php echo ($row['category_status'] == 'InActive') ? 'checked' : ''; ?>>
                                <label class="form-check-label ms-2">InActive</label>
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-success float-end" name="update_category" value="UPDATE">
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include("footer.php");
?>