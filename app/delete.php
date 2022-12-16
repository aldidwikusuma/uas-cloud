<?php
require 'vendor/autoload.php';

use Aws\S3\S3Client;

$file = $_GET['file'];

$client = new S3Client([
    'version' => 'latest',
    'region'  => 'ap-southeast-1',
    'endpoint' => 'https://s3.ap-southeast-1.amazonaws.com',
    'credentials' => [
        'key'    => 'AKIAULHRUF53UZ26GF7R',
        'secret' => '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',
    ],
]);

$client->deleteObject([
    'Bucket' => 'utsawanaldi',
    'Key'    => $file
]);

header('Location: index.php');
