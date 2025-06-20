<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="SSLCommerz">
    <title>Transaction Failed - SSLCommerz</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .transaction-card {
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            margin-top: 10vh;
            border-top: 4px solid #dc3545;
        }
        .status-icon {
            font-size: 5rem;
            margin-bottom: 20px;
        }
        .redirect-message {
            background-color: #f8d7da;
            border-left: 4px solid #dc3545;
            padding: 15px;
            margin-top: 20px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card transaction-card">
                    <div class="card-body text-center py-4">
                        <?php
                        // First check if the POST request is real!
                        if (empty($_POST['tran_id']) || empty($_POST['status'])) {
                            echo '<h2 class="text-danger">Invalid Transaction Information</h2>';
                            echo '<p class="text-muted">The transaction details could not be verified.</p>';
                            exit;
                        }

                        // Connect to database after confirming the request
                        include(__DIR__ . "/../../include/dbcon.php");
                        include(__DIR__ . "/../OrderTransaction.php");

                        $tran_id = trim($_POST['tran_id']);
                        $ot = new OrderTransaction();
                        $sql = $ot->getRecordQuery($tran_id);
                        $result = $conn->query($sql);
                        $row = $result->fetch_array(MYSQLI_ASSOC);

                        if ($row['status'] == 'Pending' || $row['status'] == 'Canceled') :
                            $sql = $ot->updateTransactionQuery($tran_id, 'Canceled');

                            if ($conn->query($sql) === TRUE) :
                        ?>
                                <div class="status-icon text-danger">
                                    <i class="fas fa-times-circle"></i>
                                </div>
                                <h2 class="text-danger">Transaction Cancelled</h2>
                                <p class="text-muted mb-4">Your payment was not completed successfully.</p>

                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="thead-light">
                                            <tr>
                                                <th colspan="2" class="text-center">Transaction Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="font-weight-bold">Reason</td>
                                                <td class="text-danger"><?php echo htmlspecialchars($_POST['error'] ?? 'Payment cancelled by user') ?></td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Transaction ID</td>
                                                <td><?php echo htmlspecialchars($_POST['tran_id']) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Amount</td>
                                                <td><?php echo htmlspecialchars($_POST['amount'] ?? '0') . ' ' . htmlspecialchars($_POST['currency'] ?? 'BDT') ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="redirect-message text-left">
                                    <p>You will be redirected to the homepage in <span id="countdown" class="font-weight-bold">5</span> seconds.</p>
                                    <p>If you are not redirected automatically, <a href="../../home.php" class="text-danger">click here</a>.</p>
                                </div>

                            <?php else : ?>
                                <div class="alert alert-danger">
                                    <h4 class="alert-heading">Error Updating Transaction</h4>
                                    <p><?= $conn->error; ?></p>
                                </div>
                            <?php endif; ?>
                        <?php elseif ($row['status'] == 'Processing') : ?>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th colspan="2" class="text-center">Payment Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="font-weight-bold">Transaction ID</td>
                                            <td><?= htmlspecialchars($_POST['tran_id']) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Transaction Time</td>
                                            <td><?= htmlspecialchars($_POST['tran_date']) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Payment Method</td>
                                            <td><?= htmlspecialchars($_POST['card_issuer']) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Bank Transaction ID</td>
                                            <td><?= htmlspecialchars($_POST['bank_tran_id']) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Amount</td>
                                            <td><?= htmlspecialchars($_POST['amount']) . ' ' . htmlspecialchars($_POST['currency']) ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php else : ?>
                            <h2 class="text-danger">Invalid Transaction Status</h2>
                            <p class="text-muted">The transaction status could not be determined.</p>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Font Awesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    
    <!-- Redirect script -->
    <script>
        let seconds = 5; // Countdown from 5 seconds
        const countdownEl = document.getElementById('countdown');
        
        if (countdownEl) {
            const countdown = setInterval(() => {
                countdownEl.textContent = seconds;
                seconds--;
                
                if (seconds < 0) {
                    clearInterval(countdown);
                    window.location.replace('../../home.php', '_self');
                }
            }, 1000);
        }
    </script>
</body>
</html>