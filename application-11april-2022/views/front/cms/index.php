<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $record->meta_title?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="jumbotron text-center">
  <h1><?php echo $record->title?></h1>
   
</div>
  
<div class="container">
  <div class="row">
  <?php echo $record->content?>
  </div>
</div>

</body>
</html>
