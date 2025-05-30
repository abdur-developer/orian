<?php
error_reporting(0);
ini_set('display_errors', 0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="SSLCommerz">
    <title>Payment Successful - SSLCommerz</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --primary-light: #ebf0ff;
            --success: #4cc9f0;
            --success-light: #e6f7fd;
            --danger: #f72585;
            --text: #2b2d42;
            --text-light: #8d99ae;
            --border: #edf2f4;
            --bg: #f8f9fa;
            --white: #ffffff;
            --radius: 12px;
            --radius-sm: 8px;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg);
            color: var(--text);
            line-height: 1.6;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }

        .payment-card {
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            margin-top: 5%;
        }

        .payment-header {
            background-color: var(--primary);
            color: white;
            padding: 24px;
            text-align: center;
        }

        .payment-header.success {
            background-color: #4cc9f0;
        }

        .payment-header.danger {
            background-color: var(--danger);
        }

        .payment-header i {
            font-size: 48px;
            margin-bottom: 16px;
        }

        .payment-header h2 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .payment-body {
            padding: 32px;
            text-align: center;
        }

        .payment-details {
            width: 100%;
            border-collapse: collapse;
        }

        .payment-details tr:not(:last-child) {
            border-bottom: 1px solid var(--border);
        }

        .payment-details td {
            padding: 16px;
        }

        .payment-details td:first-child {
            font-weight: 500;
            color: var(--text-light);
            width: 40%;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
        }

        .status-success {
            background-color: var(--success-light);
            color: #0d96b6;
        }

        .status-danger {
            background-color: #fde8ef;
            color: var(--danger);
        }

        @media (max-width: 768px) {
            .payment-details td:first-child {
                width: 50%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="payment-card">
            <?php
            require_once(__DIR__ . "/../lib/SslCommerzNotification.php");
            include_once(__DIR__ . "/../../include/dbcon.php");
            include_once(__DIR__ . "/../OrderTransaction.php");

            use SslCommerz\SslCommerzNotification;

            $sslc = new SslCommerzNotification();
            $tran_id = $_POST['tran_id'];
            $amount = $_POST['amount'];
            $currency = $_POST['currency'];

            $ot = new OrderTransaction();
            $sql = $ot->getRecordQuery($tran_id);
            $result = $conn->query($sql);
            $row = $result->fetch_array(MYSQLI_ASSOC);

            if ($row['status'] == 'Pending' || $row['status'] == 'Processing') {
                $validated = $sslc->orderValidate($_POST, $tran_id, $amount, $currency);

                if ($validated) {
                    $sql = $ot->updateTransactionQuery($tran_id, 'Processing');

                    if ($conn->query($sql) === TRUE) { ?>
                        <div class="payment-header success">
                            <i class="fas fa-check-circle"></i>
                            <h2>Payment Successful!</h2>
                            <p>Thank you for your purchase</p>
                        </div>
                        <div class="payment-body">
                            <table class="payment-details">
                                <tr>
                                    <td>Transaction Status</td>
                                    <td><span class="status-badge status-success">Completed</span></td>
                                </tr>
                                <tr>
                                    <td>Transaction ID</td>
                                    <td><?= $_POST['tran_id'] ?></td>
                                </tr>
                                <tr>
                                    <td>Transaction Time</td>
                                    <td><?= $_POST['tran_date'] ?></td>
                                </tr>
                                <tr>
                                    <td>Payment Method</td>
                                    <td><?= $_POST['card_issuer'] ?></td>
                                </tr>
                                <tr>
                                    <td>Bank Transaction ID</td>
                                    <td><?= $_POST['bank_tran_id'] ?></td>
                                </tr>
                                <tr>
                                    <td>Amount Paid</td>
                                    <td><strong><?= $_POST['amount'] . ' ' . $_POST['currency'] ?></strong></td>
                                </tr>
                            </table>
                        </div>
                    <?php } else { ?>
                        <div class="payment-header danger">
                            <i class="fas fa-exclamation-circle"></i>
                            <h2>Error Processing Payment</h2>
                        </div>
                        <div class="payment-body">
                            <p>There was an error updating your payment record. Please contact support with your transaction ID.</p>
                            <p><strong>Error:</strong> <?= $conn->error ?></p>
                            
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <div class="payment-header danger">
                        <i class="fas fa-times-circle"></i>
                        <h2>Payment Verification Failed</h2>
                    </div>
                    <div class="payment-body">
                        <p>The payment could not be validated. Please contact the merchant with your transaction details.</p>
                        <p><strong>Transaction ID:</strong> <?= $tran_id ?></p>
                        
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="payment-header danger">
                    <i class="fas fa-exclamation-triangle"></i>
                    <h2>Invalid Transaction</h2>
                </div>
                <div class="payment-body">
                    <p>This transaction has already been processed or is invalid.</p>
                </div>
            <?php } ?>
            <div class="payment-body">
                <p>Redirecting... wait <span id="countdown">5</span> seconds.</p>
            </div>
        </div>
    </div>
    <script>
    let seconds = 4; // 5 seconds countdown
    const countdownEl = document.getElementById('countdown');

    const countdown = setInterval(() => {
      countdownEl.textContent = seconds;
      seconds--;
      if (seconds < 0) {
        clearInterval(countdown);
        countdownEl.textContent = "Time's up!";
      }else if (seconds == 1) {
        window.location.replace('http://localhost:8080/orian/home.php', '_self'); // Replace with your redirect URL
      }
    }, 1000);
  </script>
</body>
</html>