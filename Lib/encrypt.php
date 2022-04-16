<?php 
function encrypt(string $value)
{
    $secret_key = 'stark_encyption';
    $secret_iv = '9886162566';
    $encrypt_method = "AES-256-CBC";
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    return base64_encode(openssl_encrypt($value, $encrypt_method, $key, 0, $iv));
}
function decrypt(string $value)
{
    $secret_key = 'stark_encyption';
    $secret_iv = '9886162566';
    $encrypt_method = "AES-256-CBC";
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    return openssl_decrypt(base64_decode($value), $encrypt_method, $key, 0, $iv);
}