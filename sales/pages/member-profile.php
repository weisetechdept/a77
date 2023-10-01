<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>jQuery File Upload Test</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="vendor/mocha.css" />
  </head>
  <body>
    <form enctype="multipart/form-data" method="post" action="/sales/system/upload.php">
      <input type="file" size="32" name="image_field" value="">
      <input type="submit" name="Submit" value="upload">
    </form>
  </body>
</html>