<?php

class OrderTransaction {

    public function getRecordQuery($tran_id)
    {
        $sql = "select * from orders WHERE transaction_id='" . $tran_id . "'";
        return $sql;
    }

    public function saveTransactionQuery($post_data)
    {
        $user_id = $post_data['user_id'];
        $name = $post_data['cus_name'];
        $email = $post_data['cus_email'];
        $phone = $post_data['cus_phone'];
        $transaction_amount = $post_data['total_amount'];
        $address = $post_data['cus_add1'];
        $transaction_id = $post_data['tran_id'];
        $currency = $post_data['currency'];
        $coupon = $post_data['coupon'];

        $sql = "INSERT INTO orders (user_id, name, email, phone, amount, address, status, transaction_id, currency, coupon)
                                    VALUES ('$user_id', '$name', '$email', '$phone','$transaction_amount','$address','Pending', '$transaction_id','$currency', '$coupon')";

        return $sql;
    }

    public function updateTransactionQuery($tran_id, $type = 'Success')
    {
        $sql = "UPDATE orders SET status='$type' WHERE transaction_id='$tran_id'";

        return $sql;
    }
}

