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
$sql = "SELECT * FROM system_structure WHERE id = 1";
$result = mysqli_query($conn, $sql);
$system_structure = mysqli_fetch_assoc($result);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = 1;
    $center = mysqli_real_escape_string($conn, $_POST['center']);
    $inside = mysqli_real_escape_string($conn, $_POST['inside']);
    $outside = mysqli_real_escape_string($conn, $_POST['outside']);
    
    $update_sql = "UPDATE system_structure SET center = '$center',inside = '$inside',outside = '$outside'WHERE id = $id";
    
    if (mysqli_query($conn, $update_sql)) {
        $success = "Record updated successfully";
        // Refresh data
        $result = mysqli_query($conn, $sql);
        $system_structure = mysqli_fetch_assoc($result);
    } else {
        $error = "Error updating record: " . mysqli_error($conn);
    }
}
?>

<section class="pricing-section py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="text-center mb-5">Update Delivery Plan</h2>
                
                <?php if(isset($success)): ?>
                    <div class="alert alert-success"><?php echo $success; ?></div>
                <?php endif; ?>
                
                <?php if(isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                
                <form method="POST" class="card shadow p-4">
                    <div class="mb-3">
                        <label for="center" class="form-label">Main hub</label>
                        <!-- <input type="text" class="form-control" id="center" name="center" 
                               value="" required> -->
                        <select name="center" class="form-control" id="district_select" required>
                            <option value="" selected disabled>Select your District</option>
                            <option value="Bagerhat">Bagerhat</option>
                            <option value="Bandarban">Bandarban</option>
                            <option value="Barguna">Barguna</option>
                            <option value="Barisal">Barisal</option>
                            <option value="Bhola">Bhola</option>
                            <option value="Bogra">Bogra</option>
                            <option value="Brahmanbaria">Brahmanbaria</option>
                            <option value="Chandpur">Chandpur</option>
                            <option value="Chittagong">Chittagong</option>
                            <option value="Chuadanga">Chuadanga</option>
                            <option value="Comilla">Comilla</option>
                            <option value="Cox'sBazar">Cox'sBazar</option>
                            <option value="Dhaka">Dhaka</option>
                            <option value="Dinajpur">Dinajpur</option>
                            <option value="Faridpur">Faridpur</option>
                            <option value="Feni">Feni</option>
                            <option value="Gaibandha">Gaibandha</option>
                            <option value="Gazipur">Gazipur</option>
                            <option value="Gopalganj">Gopalganj</option>
                            <option value="Habiganj">Habiganj</option>
                            <option value="Jaipurhat">Jaipurhat</option>
                            <option value="Jamalpur">Jamalpur</option>
                            <option value="Jessore">Jessore</option>
                            <option value="Jhalokati">Jhalokati</option>
                            <option value="Jhenaidah">Jhenaidah</option>
                            <option value="Khagrachari">Khagrachari</option>
                            <option value="Khulna">Khulna</option>
                            <option value="Kishoreganj">Kishoreganj</option>
                            <option value="Kurigram">Kurigram</option>
                            <option value="Kushtia">Kushtia</option>
                            <option value="Lakshmipur">Lakshmipur</option>
                            <option value="Lalmonirhat">Lalmonirhat</option>
                            <option value="Madaripur">Madaripur</option>
                            <option value="Magura">Magura</option>
                            <option value="Manikganj">Manikganj</option>
                            <option value="Maulvibazar">Maulvibazar</option>
                            <option value="Meherpur">Meherpur</option>
                            <option value="Munshiganj">Munshiganj</option>
                            <option value="Mymensingh">Mymensingh</option>
                            <option value="Naogaon">Naogaon</option>
                            <option value="Narail">Narail</option>
                            <option value="Narayanganj">Narayanganj</option>
                            <option value="Narsingdi">Narsingdi</option>
                            <option value="Natore">Natore</option>
                            <option value="Nawabganj">Nawabganj</option>
                            <option value="Netrokona">Netrokona</option>
                            <option value="Nilphamari">Nilphamari</option>
                            <option value="Noakhali">Noakhali</option>
                            <option value="Pabna">Pabna</option>
                            <option value="Panchagarh">Panchagarh</option>
                            <option value="Patuakhali">Patuakhali</option>
                            <option value="Pirojpur">Pirojpur</option>
                            <option value="Rajbari">Rajbari</option>
                            <option value="Rajshahi">Rajshahi</option>
                            <option value="Rangamati">Rangamati</option>
                            <option value="Rangpur">Rangpur</option>
                            <option value="Satkhira">Satkhira</option>
                            <option value="Shariatpur">Shariatpur</option>
                            <option value="Sherpur">Sherpur</option>
                            <option value="Sirajganj">Sirajganj</option>
                            <option value="Sunamganj">Sunamganj</option>
                            <option value="Sylhet">Sylhet</option>
                            <option value="Tangail">Tangail</option>
                            <option value="Thakurgaon">Thakurgaon</option>
                        </select>
                        <script>
                            const district_select = document.getElementById("district_select");
                            district_select.value = "<?= htmlspecialchars($system_structure['center']); ?>";
                            district_select.dispatchEvent(new Event('change'));
                        </script>
                    </div>
                    
                    <div class="mb-3">
                        <label for="outside" class="form-label">Outside (৳)</label>
                        <input type="number" class="form-control" id="outside" name="outside" 
                               value="<?php echo htmlspecialchars($system_structure['outside']); ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="inside" class="form-label">Inside (৳)</label>
                        <input type="number" class="form-control" id="inside" name="inside" 
                               value="<?php echo htmlspecialchars($system_structure['inside']); ?>" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100 py-2">Update Rate</button>
                </form>
              </div>
        </div>
    </div>
</section>
