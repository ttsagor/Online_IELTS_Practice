<!DOCTYPE html>
<html lang="en">
<head>
  <title>IELTS Practice Zone</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Upload Audio File</h2>
  <form action="<?php echo base_url()."/index.php/Exampanel/submituploadrecordedaudio";?>" method='post' enctype="multipart/form-data">
    <div class="form-group">
      <label for="file">MP3 file</label>
      <input type="file" class="form-control" id="file" name="file" accept=".mp3,audio/*">
      <input type='hidden' name='ex_id' value='<?php echo $ex_id; ?>'/>
	  <input type='hidden' name='mt_id' value='<?php echo $mt_id; ?>'/>
	  <input type='hidden' name='part' value='<?php echo $part; ?>'/>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>

</body>
</html>
