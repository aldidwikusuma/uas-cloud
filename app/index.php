<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Aldi Image</title>
  </head>
  <body>
    <form class="container mt-3" action="upload.php" method="post" enctype="multipart/form-data">
      <label for="file" class="form-label">Upload Your Image Here</label>
      <div class="input-group mb-3">
        <input type="file" class="form-control" name="file" id="file" accept="image/png, image/gif, image/jpeg">
        <button class="btn btn-primary" type="submit" name="submit">Submit</button>
      </div>
    </form>
    <div class="container mt-3">
        <h2 class="text-center">Data Image</h2>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Image</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
                use Aws\S3\S3Client;

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

                $objects = $s3->getIterator('ListObjects', [
                  'Bucket' => 'utsawanaldi'
                ]);

                $nomer = 1;
                foreach ($objects as $object) {
                  echo "<tr>";
                  echo '<th scope="row">' . $nomer++ . '</th>';
                  echo '<td style="max-width: 75% !important;"><img width="200" height="200" src="https://utsawanaldi.s3.ap-southeast-1.amazonaws.com/' . $object['Key'] . '" class="img-fluid" alt="Gambar"></td>';
                  echo "<td><a href='delete.php?file=" . $object['Key'] . "' class='btn btn-danger'>Hapus</a></td>";
                  echo "</tr>";
                }
                
              ?>
            </tbody>
        </table>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>