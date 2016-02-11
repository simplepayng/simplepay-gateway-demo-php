<?php
/**
 * Verify SimplePay transaction
 */

$private_key = 'test_pr_demo';

// Retrieve data returned in payment gateway callback
$amount = $_POST["amount"];
$token = $_POST["token"];

$data = array (
	'token' => $token
);
$data_string = json_encode($data); 

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://checkout.simplepay.ng/v1/payments/verify/');
curl_setopt($ch, CURLOPT_USERPWD, $private_key . ':');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($data_string)                                                                       
));       

curl_exec($ch);
$responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch);

if ($responseCode == '200') {
	header('Location: success.html');

} else {
	header('Location: failed.html');
}
?>