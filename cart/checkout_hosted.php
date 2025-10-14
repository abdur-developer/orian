<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

# This is a sample page to understand how to connect payment gateway

require_once(__DIR__ . "/lib/SslCommerzNotification.php");

include("../include/dbcon.php");
include("OrderTransaction.php");

use SslCommerz\SslCommerzNotification;
// getting cart data from database
$cod = isset($_REQUEST['cod']) ? $_REQUEST['cod'] : '';
$coupon_code = isset($_REQUEST['coupon_code']) ? $_REQUEST['coupon_code'] : '';

$address = isset($_REQUEST['address']) ? $_REQUEST['address'] : '';
$address .= isset($_REQUEST['district']) ? " , ".$_REQUEST['district'] : '';

$discount_amount = $_REQUEST['delivery_amount'] ?? 0;

$user_id = $conn->real_escape_string(isset($_COOKIE['user_id']) ? decryptSt($_COOKIE['user_id']) : '');

$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id = '$user_id'"));
$sql = "SELECT * FROM cart WHERE user_id = '$user_id' AND is_running = 1";

$result = $conn->query($sql);
$total_amount = 0;

$product_category = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $sql = "SELECT * FROM {$row['type']} WHERE id = '{$row['ref_id']}'";
        $item = mysqli_fetch_assoc($conn->query($sql));
        $total_amount += ($item['price'] * $row['quantity']);
        $product_category .= $row['type'] . ",";
    }
    $total_amount += $discount_amount;
    
    if(!empty($coupon_code)){
        $sql = "SELECT COUNT(id) AS total FROM orders WHERE user_id = '$user_id' AND coupon = '$coupon_code'";
        $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));

        if ($result['total'] != 0) {
            header("Location: index.php?msg=Coupon+code+already+used+previously.");
            exit;
        }
        $coupon = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM coupons WHERE code = '$coupon_code'"));
        if(!empty($coupon)){
            $total_amount -= $coupon['discount'];
        }
    }
} else {
    header("Location: ../index.php?msg=Your+cart+is+empty.+Please+add+items+to+your+cart.");
    exit;
}

// die($total_amount);
# Organize the submitted/inputted data
$post_data = array();

$post_data['total_amount'] = $total_amount;
$post_data['currency'] = "BDT";
$post_data['tran_id'] = "ORDER_" . uniqid();

# CUSTOMER INFORMATION
$post_data['user_id'] = $user_id;
$post_data['cus_name'] = $user['name'];
$post_data['cus_email'] = $user['email'];
$post_data['cus_add1'] = $address;
$post_data['cus_add2'] = "Dhaka";
$post_data['cus_city'] = "Dhaka";
$post_data['cus_postcode'] = "1000";
$post_data['cus_country'] = "Bangladesh";
$post_data['cus_phone'] = $user['number'];

# SHIPMENT INFORMATION
$post_data["shipping_method"] = "YES";
$post_data['ship_name'] = "Store Test";
$post_data['ship_add1'] = "Dhaka";
$post_data['ship_city'] = "Dhaka";
$post_data['ship_postcode'] = "1000";
$post_data['ship_country'] = "Bangladesh";

$post_data["product_category"] = $product_category;
$post_data["product_profile"] = "general";
$post_data["product_name"] = "Computer";
$post_data["num_of_item"] = "1";

$post_data['coupon'] = $coupon_code;

$query = new OrderTransaction();
$sql = $query->saveTransactionQuery($post_data);

if ($conn->query($sql) === TRUE) {
    
    if($total_amount < 1){ ?>
        <form id="redirectForm" action="pg_redirection/success.php" method="post">
            <input type="hidden" name="tran_id" value="<?= htmlspecialchars($post_data['tran_id']); ?>">
            <input type="hidden" name="amount" value="0">
            <input type="hidden" name="currency" value="BDT">
            <input type="hidden" name="bank_tran_id" value="null">
            <input type="hidden" name="card_issuer" value="null">
            <input type="hidden" name="tran_date" value="<?= date('Y-m-d H:i:s'); ?>">
            <input type="hidden" name="zero" value="1">
            <input type="hidden" name="cod" value="0">
        </form>
        
        <script>
            document.getElementById('redirectForm').submit();
        </script>
    <?php
    }elseif($cod == "555"){?>
        <form id="redirectForm" action="pg_redirection/success.php" method="post">
            <input type="hidden" name="tran_id" value="<?= htmlspecialchars($post_data['tran_id']); ?>">
            <input type="hidden" name="amount" value="0">
            <input type="hidden" name="currency" value="BDT">
            <input type="hidden" name="bank_tran_id" value="null">
            <input type="hidden" name="card_issuer" value="null">
            <input type="hidden" name="tran_date" value="<?= date('Y-m-d H:i:s'); ?>">
            <input type="hidden" name="zero" value="0">
            <input type="hidden" name="cod" value="1">
        </form>
        
        <script>
            document.getElementById('redirectForm').submit();
        </script>
    <?php
    }else{
        # Call the Payment Gateway Library
        $sslcz = new SslCommerzNotification();

        $msg = $sslcz->makePayment($post_data, 'hosted');
        if (!is_array($msg)) {
            echo $msg;
        }
    }

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

