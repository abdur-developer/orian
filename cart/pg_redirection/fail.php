<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="SSLCommerz">
    <title>Transaction Failed - SSLCommerz</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .transaction-card {
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            margin-top: 8vh;
            border-top: 4px solid #dc3545;
            border-left: none;
            border-right: none;
        }
        .status-icon {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            color: #dc3545;
        }
        .redirect-info {
            background-color: #f8f9fa;
            border-left: 4px solid #6c757d;
            padding: 15px;
            margin-top: 25px;
            border-radius: 4px;
        }
        .transaction-table {
            border-radius: 8px;
            overflow: hidden;
        }
        .transaction-table th {
            background-color: #343a40;
            color: white;
        }
        .text-label {
            font-weight: 600;
            color: #495057;
            width: 40%;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card transaction-card">
                    <div class="card-body text-center py-4 px-md-5">
                        <?php
                        // First check if the POST request is valid
                        if (empty($_POST['tran_id']) || empty($_POST['status'])) {
                            echo '<div class="status-icon"><i class="fas fa-exclamation-triangle"></i></div>';
                            echo '<h2 class="text-danger mb-3">Invalid Transaction Information</h2>';
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

                        if ($row['status'] == 'Pending' || $row['status'] == 'Failed') :
                            $sql = $ot->updateTransactionQuery($tran_id, 'Failed');

                            if ($conn->query($sql)) :
                        ?>
                                <div class="status-icon">
                                    <i class="fas fa-times-circle"></i>
                                </div>
                                <h2 class="text-danger mb-3">Transaction Failed</h2>
                                <p class="lead text-muted mb-4">Your payment was not completed successfully.</p>

                                <div class="table-responsive transaction-table">
                                    <table class="table table-bordered mb-4">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th colspan="2" class="text-center">Transaction Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-label">Error Reason</td>
                                                <td class="text-danger"><?php echo htmlspecialchars($_POST['error'] ?? 'Payment failed') ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-label">Transaction ID</td>
                                                <td><?php echo htmlspecialchars($_POST['tran_id']) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-label">Payment Method</td>
                                                <td><?php echo htmlspecialchars($_POST['card_issuer'] ?? 'N/A') ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-label">Bank Transaction ID</td>
                                                <td><?php echo htmlspecialchars($_POST['bank_tran_id'] ?? 'N/A') ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-label">Amount</td>
                                                <td><?php echo htmlspecialchars($_POST['amount'] ?? '0') . ' ' . htmlspecialchars($_POST['currency'] ?? 'BDT') ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="redirect-info text-left">
                                    <p><i class="fas fa-info-circle mr-2"></i>You will be redirected to homepage in <span id="countdown" class="font-weight-bold">5</span> seconds.</p>
                                    <p class="mb-0">If not redirected automatically, <a href="../../home.php" class="text-primary">click here</a>.</p>
                                </div>

                            <?php else : ?>
                                <div class="alert alert-danger text-left">
                                    <h4 class="alert-heading"><i class="fas fa-exclamation-triangle mr-2"></i>Error Updating Transaction</h4>
                                    <p class="mb-0"><?= htmlspecialchars($conn->error) ?></p>
                                </div>
                            <?php endif; ?>
                        <?php elseif ($row['status'] == 'Processing') : ?>
                            <div class="table-responsive transaction-table">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th colspan="2" class="text-center">Payment Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-label">Transaction ID</td>
                                            <td><?= htmlspecialchars($_POST['tran_id']) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-label">Transaction Time</td>
                                            <td><?= htmlspecialchars($_POST['tran_date']) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-label">Payment Method</td>
                                            <td><?= htmlspecialchars($_POST['card_issuer']) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-label">Bank Transaction ID</td>
                                            <td><?= htmlspecialchars($_POST['bank_tran_id']) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-label">Amount</td>
                                            <td><?= htmlspecialchars($_POST['amount']) . ' ' . htmlspecialchars($_POST['currency']) ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php else : ?>
                            <div class="status-icon">
                                <i class="fas fa-exclamation-circle"></i>
                            </div>
                            <h2 class="text-danger mb-3">Invalid Transaction Status</h2>
                            <p class="text-muted">The transaction status could not be determined.</p>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

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