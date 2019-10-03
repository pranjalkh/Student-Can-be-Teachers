<?php include "database.php"; ?>
<?php session_start();
 if (isset($_SESSION['quizz'])) {
     $username =$_SESSION['login_user'];
 ?>
<?php
	//Set question number
	$number = (int) $_GET['n'];

	//Get total number of question2
	$query = "select * from question2";
	$results = $mysqli->query($query) or die($mysqli->error.__LINE__);
	$total=$results->num_rows;

	// Get Question
	$query = "select * from `question2` where question_number = $number";

	//Get result
	$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
	$question = $result->fetch_assoc();


	// Get choice2
	$query = "select * from `choice2` where question_number = $number";

	//Get results
	$choice2 = $mysqli->query($query) or die($mysqli->error.__LINE__);

 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>PHP Quizzer!</title>
    <link rel="stylesheet" href="css/style.css" type="text/css" />
  </head>
  <body>
    <div id="container">
      <header>
        <div class="container">
          <h1>PHP Quizzer</h1>
	</div>
      </header>


      <main>
      <div class="container">
        <div class="current">Question <?php echo $number; ?> of <?php echo $total; ?></div>
	<p class="question">
	   <?php echo $question['question'] ?>
	</p>
	<form method="post" action="process.php">
	      <ul class="choice2">
	        <?php while($row=$choice2->fetch_assoc()): ?>
		<li><input name="choice" type="radio" value="<?php echo $row['id']; ?>" />
		  <?php echo $row['choice']; ?>
		</li>
		<?php endwhile; ?>
            
        <?php 
     $_SESSION['qn'] ="q2";
     
              ?>
	      </ul>
	      <input type="submit" value="submit" />
	      <input type="hidden" name="number" value="<?php echo $number; ?>" />
        
	</form>
      </div>
    </div>
    </main>


  
  </body>
</html>
<?php
 }
 else {
   ?>
   Not logged in HTML and code here
   <?php
 }
?>