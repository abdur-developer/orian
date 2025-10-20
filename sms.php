<?php
    $message = "(Protisheba) Your OTP for password reset is: $otp";
    $api_key = 'OJSONNUUGT97U9Z';
    $sender_id = '8809601004808';
    $number = '8801709409266';
    $url = "https://api.mimsms.com/api/SmsSending/Send";
    $params = [
        'Apikey' => $api_key,
        'UserName' => 'alaminfiverr548@gmail.com',
        'SenderName' => $sender_id,
        'CampaignId' => 'null',
        'MobileNumber' => $number,
        'TransactionType' => 'T',
        'Message' => $message
    ];

    $url_with_params = $url . '?' . http_build_query($params);

    // $ch = curl_init($url_with_params);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // $response = curl_exec($ch);
    // curl_close($ch);

    // var_dump($response);
    // exit();