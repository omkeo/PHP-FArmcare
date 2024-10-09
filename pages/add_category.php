<?php
include("header.php");
?>
<?php
include("../DB/conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category = $_POST["categoryName"];
    $status = $_POST['status'];

    $sql = "INSERT INTO category (category_name, category_status) VALUES ('$category', '$status')";

    if (mysqli_query($connect, $sql)) {
        echo "<script>alert('Category added successfully');</script>";
        echo "<script>window.location.href='category_list.php';</script>";
    } else {
        echo "<div class='alert alert-danger'>Error adding category: " . mysqli_error($connect) . "</div>";
    }
}
?>
<div class="bg-secondary p-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 p-3 shadow bg-white">
                <h3>Add Category</h3>
                <hr>
                <form action="add_category.php" method="POST">
                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <label for="categoryName" class="float-end">Category Name <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control w-50" name="categoryName" placeholder="Category Name" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <label class="form-label float-end">Status <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check d-flex align-items-center">
                                <input class="form-check-input" type="radio" name="status" value="Active" required>
                                <label class="form-check-label ms-2" for="Active">Active</label>
                            </div>
                            <div class="form-check d-flex align-items-center">
                                <input class="form-check-input" type="radio" name="status" value="InActive" required>
                                <label class="form-check-label ms-2" for="InActive">InActive</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success float-end">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include("footer.php");
?>