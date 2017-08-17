<?php
$merchantId = '58e39d60100178000b3babb3';
$xSecurityTimestamp = '2017-04-10T15:03:36.257Z';
$xSecuritySignature = 'oUO1L7qj3sf9wNRL1cMViqyJ1w1G7Qb+np9pN4seExtIl3Gu9Vnd0nHnAfn3VzBZtVuE08+H92qKgEBPzJyfzItJXK3+IfyNEV87xQLj2kDRX5LJKEuJOlrpYF05ybdjvyk0zN4F7iHR6k5tbrPnDohXf/USYc5F1gBs0xAdBlU7w/CYthifN1cztSHa3HmkyIuoX77HsYjj9DvKKIscOTssHnCFf5+bjNbFpUuVKp5RuL0Ijop3fIMbcEHL2G126ov7usDjLXRJFkIu6gxN/lUQSdDxHwVXL1/9k5Lbl7Mwf49PN410mUmpbGJXlAa+P2NrbI2//7jW6lI0y8Rn/Q==';
$json = '{"_id":"58eb9ead15f970006d509589","status":"SUCCEEDED"}';


function check_signature($merchantId, $xSecurityTimestamp, $xSecuritySignature, $json) {
    $public_key = <<<EOD
    -----BEGIN PUBLIC KEY-----
    MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAtxS9KJhwYLQ88Y5B5ZRL
    QHuJLAbYUBk6aFKeTZvLLTYd+ptfcVzoL6tnF4TV1D/0kkweoVk5WuQEbL5kP9H4
    hqPUlg7anI4B6PZTQ37FysCmvPoxjJLKT7LQ0lDD9qGV7IbYZZ0Oep3Sp3i0chrn
    2ec4KpkTl1bbEueItMaJGZMJjQhDg6sOXPOFewn/OvttRzTSLkhzIQEbmcJXpk7L
    wf/u5dyM0Rx0cNJQZgmPDhqRKbRv7CtLt06rK78RRLAfZmwknP7pIV7MHtlX4yzk
    FDf1Ig/onw8x+ej/yb/IOed5BQkiyuwS0lCWnywncA1eVNcCI7o9OuJsiIklL5ku
    DwIDAQAB
    -----END PUBLIC KEY-----
    EOD;

    $algo = 'RSA-SHA256';

    $crcValue = dechex(crc32($json));
    //echo $crcValue;
    $binary_signature = '';
    $formattedSignature = $merchantId.'|'.$xSecurityTimestamp.'|'.$crcValue;
    //echo $formattedSignature;

    $result = openssl_verify($formattedSignature, base64_decode($xSecuritySignature), $public_key, $algo);
    echo $result;
    return $result;
}
?>