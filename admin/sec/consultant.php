<style>
  .pricing-section {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }
  .form-control {
      border-radius: 8px;
      padding: 10px 15px;
  }
  .btn-primary {
      border-radius: 8px;
      font-weight: 600;
  }
  .card {
      border-radius: 12px;
      border: none;
  }
</style>
<?php
// Fetch current data
$sql = "SELECT * FROM consultant WHERE id = 2";
$result = mysqli_query($conn, $sql);
$consultant = mysqli_fetch_assoc($result);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = 2;
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $validity = mysqli_real_escape_string($conn, $_POST['validity']);
    
    $update_sql = "UPDATE consultant SET title = '$title',price = '$price',validity = '$validity'WHERE id = $id";
    
    if (mysqli_query($conn, $update_sql)) {
        $success = "Record updated successfully";
        // Refresh data
        $result = mysqli_query($conn, $sql);
        $consultant = mysqli_fetch_assoc($result);
    } else {
        $error = "Error updating record: " . mysqli_error($conn);
    }
}
?>

<section class="pricing-section py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="text-center mb-5">Update Consultant Plan</h2>
                
                <?php if(isset($success)): ?>
                    <div class="alert alert-success"><?php echo $success; ?></div>
                <?php endif; ?>
                
                <?php if(isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                
                <form method="POST" class="card shadow p-4">
                    <div class="mb-3">
                        <label for="title" class="form-label">Plan Title</label>
                        <input type="text" class="form-control" id="title" name="title" 
                               value="<?php echo htmlspecialchars($consultant['title']); ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="price" class="form-label">Price (৳)</label>
                        <input type="number" class="form-control" id="price" name="price" 
                               value="<?php echo htmlspecialchars($consultant['price']); ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="validity" class="form-label">Validity (days)</label>
                        <input type="number" class="form-control" id="validity" name="validity" 
                               value="<?php echo htmlspecialchars($consultant['validity']); ?>" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100 py-2">Update Plan</button>
                </form>
              </div>
        </div>
    </div>
</section>
