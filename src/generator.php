<?php
$secret_key = 'YOUR_SECRET_KEY_HERE';
function generateSignature($merchantId, $webhookId, $currency, $amount) {
    $signature = hash("sha256", utf8_encode($merchantId.$webhookId.$currency.$amount.$secret_key), true);
    return base64_encode($signature);
}
?>