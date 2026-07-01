<?php
if(isset($_POST['profile_address']) && isset($_POST['profile_bio'])) {
    $address = $_POST['profile_address'];
    $bio = $_POST['profile_bio'];
    $sql = "UPDATE users SET address = '$address', bio = '$bio' WHERE id = $user_id";
    if(mysqli_query($conn, $sql)){
        header("Location: home.php?page=profile&success=Profile+updated+successfully");
    } else {
        header("Location: home.php?page=profile&error=Failed+to+update+profile");
    }
}
function availableConsultants($id){
    global $conn;
    $sql = "SELECT 1 FROM confirm_orders WHERE user_id = '$id' AND type = 'consultant' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    return mysqli_num_rows($result) > 0;
}
