<?php


use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

require 'vendor/autoload.php';

$s3 = new S3Client([
    'version' => 'latest',
    'region'  => 'ap-southeast-1',
    'endpoint' => 'https://s3.ap-southeast-1.amazonaws.com',
    'credentials' => [
        'key'    => 'AKIAULHRUF53UZ26GF7R',
        'secret' => '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',
    ],
]);

$files = $_FILES['file'];

if (isset($_POST['submit'])) {
    $file = $_FILES['file']['tmp_name'];
    $fileName = $_FILES['file']['name'];
    $fileType = $_FILES['file']['type'];

    $key = 'uploads/' . $fileName;

    try {
        $result = $s3->putObject([
            'Bucket' => 'utsawanaldi',
            'Key'    => $key,
            'Body'   => fopen($file, 'rb'),
            'ACL'    => 'public-read',
            'ContentType' => $fileType
        ]);

        header('Location: index.php');
    } catch (S3Exception $e) {
        echo $e->getMessage() . PHP_EOL;
    }
}
