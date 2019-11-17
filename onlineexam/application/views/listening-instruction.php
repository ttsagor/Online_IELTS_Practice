<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $mt_name; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container" style='margin:auto;width:100%'> 
  <h1 class="display-4"><?php echo $mt_name; ?></h1>
    <p>The four parts of this practice Listening test are presented over four separate web pages. Make sure you move swiftly from one page to the next so that your practice is as realistic as possible.</p>
    <p>Download the question paper and blank answer sheet before you start, and write your answers on the question paper while you are listening. Use a pencil.</p>
    <p>Listen to the instructions for each section of the test carefully. Answer all of the questions.</p>
    <p>There are 40 questions altogether. Each question carries one mark.</p>
    <p>For each part of the test, there will be time for you to look through the questions and time for you to check your answers.</p>
    <p>When you have completed all four parts of the Listening test you will have ten minutes to copy your answers on to a separate answer sheet.</p>
    <p>Instructions are taken from Britih Council's official <a href='britishcouncil.org'>website</a></p>
  
  <?php
   echo "<a class='btn btn-info' href='".base_url()."index.php/Exampanel/listeningmodule?ex_id=$ex_id'>Start Listening Exam</a>";
  ?>
</div>

</body>
</html>
