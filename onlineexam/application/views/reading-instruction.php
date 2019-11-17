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
    
    
    <div>
            <h1>You will need to read quickly and efficiently, and manage your time</h1>

            <p>You will be asked to read three different passages and respond to related questions in your IELTS Reading test.</p>
            
            <p>The content of the Reading test is different for&nbsp;<a href="https://takeielts.britishcouncil.org/choose-ielts/ielts-academic-or-ielts-general-training">IELTS Academic and IELTS General Training</a>&nbsp;tests. Details of each version are given below.</p>
            
            <h2>Purpose of the test</h2>
            
            <p>The IELTS Reading test is designed to assess a wide range of reading skills, including how well you</p>
            
            <ul><li>read for the general sense of a passage</li>
            	<li>read for the main ideas</li>
            	<li>read for detail</li>
            	<li>understand inferences and implied meaning</li>
            	<li>recognise a writer’s opinions, attitudes and purpose</li>
            	<li>follow the development of an argument</li>
            </ul><p>This is the case for whichever version of the IELTS test you are taking.</p>
            
            <h3>Timing</h3>
            
            <p>The IELTS Reading test takes 60 minutes.</p>
            
            <p>You are not allowed any extra time to transfer your answers, so write them directly on to your answer sheet.</p>
            
            <p>You will need to manage your time during the test because you will not be told when to start or finish each section.</p>
            
            <h3>Three sections</h3>
            
            <p>You will be given three different passages to read, each with accompanying questions. You can expect to read 2,150 - 2,750 words in total during your test.</p>
            
            <h3>IELTS&nbsp;Academic&nbsp;Reading test</h3>
            
            <p>There are three sections to the IELTS Academic Reading test, and each contains one long text.</p>
            
            <p>These are taken from books, journals, magazines and newspapers. They have been written for a non-specialist audience and are on academic topics of general interest.</p>
            
            <p>They range from the descriptive and factual to the discursive and analytical.</p>
            
            <p>Each text might be accompanied by diagrams, graphs or illustrations, and you will be expected to show that you understand these too.</p>
            
            <p>A simple glossary is provided if the material contains technical terms.</p>
            
            <h3>IELTS General Training Reading test</h3>
            
            <p>There are three sections to the IELTS General Training Reading test.</p>
            
            <p>The texts used in each section are taken from notices, advertisements, company handbooks, official documents, books, magazines and newspapers.</p>
            
            <p>Section 1 contains two or three short factual texts, one of which may be made up of 6 - 8 short texts related by topic, e.g. hotel advertisements. The topics are relevant to everyday life in an English-speaking country.</p>
            
            <p>Section 2 contains two short factual texts focusing on work-related issues, e.g. applying for a job, company policies, pay and conditions, workplace facilities, staff development and training.</p>
            
            <p>Section 3 contains one longer, more complex text on a topic of general interest.</p>
            
            <h3>Questions</h3>
            
            <p>There are 40 questions. &nbsp;</p>
            
            <p>A variety of question types is used. You may be asked to</p>
            
            <ul><li>fill gaps in a passage of written text or in a table</li>
            	<li>match headings to written text to diagrams or charts</li>
            	<li>complete sentences</li>
            	<li>give short answers to open questions</li>
            	<li>answer multiple choice questions</li>
            </ul><p>Sometimes you will need to give one word as your answer, sometimes a short phrase, and sometimes simply a letter, number or symbol.</p>
            
            <p>Make sure you read the instructions carefully.</p>
            
            <h3>Marking</h3>
            
            <p>Each correct answer receives one mark.</p>
            
            <p>Scores out of 40 are converted to the IELTS 9-band scale. Scores are reported in whole and half bands.</p>
            <p>Instructions are taken from Britih Council's official <a href='britishcouncil.org'>website</a></p>

    </div>
    
  
  <?php
   echo "<a class='btn btn-info' href='".base_url()."index.php/Exampanel/readingmodule?ex_id=$ex_id'>Start Reading Exam</a>";
  ?>
</div>

</body>
</html>
