<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  <title>Document</title>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-6 offset-3 mt-4">
        <form enctype='multipart/form-data' action='upload.php' method='post'>
          <div class="mb-5">
            <label class="form-label">Upload Product CSV file Here</label>
            <input class="form-control mb-3" size='50' type='file' name='filename'>
            <input type="submit" name='submit' value="Upload Products" class="btn btn-primary mr-5">
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>