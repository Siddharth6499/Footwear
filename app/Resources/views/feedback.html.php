<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');
?>
<html>
<head>
<script src='https://kit.fontawesome.com/a0 76d05399.js' crossorigin='anonymous'></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

input[type=text,email], select, textarea {
  width: 50%;
  padding: 18px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}

input[type=submit] {
  background-color: #471f16;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  margin-left: 38%;
margin-top: 10%;
}

button:hover {
  background-color: #471f16;
}

.container {
  margin-top: 22px;
    margin-left: 40%;
    border-radius: 31px;
    padding: 19px;
    margin-right: 37%;
}
</style>

</head>


<body>


<div class="container"><br>
		<h1 class="text-success text-center" style="color:white;">Give us your feedback...</h1><br>
		<div class="col-lg-8 m-auto d-block">
			<form action="#" onsubmit="return validation()" method = "post">

				<div class="form-group">
					<label style="color:white;"> Firstname: </label>
					<input type="text" name="firstname" class="form-control" id="user" autocomplete="off" required>
					<span id="username" class="text-danger font-weight-bold"></span>
				</div>
        <br>

        <div class="form-group">
					<label style="color:white;"> Lastname: </label>
					<input type="text" name="lastname" class="form-control" id="user" autocomplete="off">
					<span id="username" class="text-danger font-weight-bold"></span>
				</div>
        <br>

				<div class="form-group">
					<label style="color:white;"> Email:&emsp;&ensp;&nbsp;</label>
					<input type="email" name="email" class="form-control" id="emails" autocomplete="off" required>
					<span id="emailids" class="text-danger font-weight-bold"></span>
				</div>
         <br>

        <div class="form-group">
					<label style="color:white;"> Review:&ensp;&ensp;</label>
					<input type="textarea" name="comment" class="form-control" id="user" autocomplete="off">
					<span id="username" class="text-danger font-weight-bold"></span>
				</div>
				<input type="submit" name="submit" value="submit" class="btn btn-success">
				
			</form>
		</div>
		
	</div>
</div>
</body></html>
<?php
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $comment = $_POST['comment'];

            // if(isset($firstname)) {
            //   $feedback = new \Pimcore\Model\DataObject\Feedback();
      
            //   $feedback->setKey($firstname); 
            //   $feedback->setPublished(true); 
            //   $feedback->setParentId(36); 
            //   $feedback->setFirstname($_POST['firstname']); 
              
            //   $feedback->save();

            if(isset($firstname) && isset($lastname) 
            && isset($email) && isset($comment)) {
                $feedback = new \Pimcore\Model\DataObject\Feedback();
        
                $feedback->setKey($firstname); 
                $feedback->setPublished(true); 
                $feedback->setParentId(46); 
                $feedback->setFirstname($_POST['firstname']); 
                $feedback->setLastname($_POST['lastname']); 
                $feedback->setEmail($_POST['email']); 
                $feedback->setComment($_POST['comment']); 
                $feedback->save();



                $mail = new \Pimcore\Mail();
                // $mail->addTo('gargmansi24@gmail.com');
                // $mail->setSubject('Products Feedback');
                $mail->setDocument('/feedbackEmail');
                // $mail->setParams($params);
                $mail->send();

               
            }
            
            // dump ($firstname);
            // dump ($lastname);
            // dump ($email);
            // dump ($comment);
            // die();  
        ?>  

    <h1><?= $this->input("headline", ["width" => 540]); ?></h1>

    <?php while ($this->block("contentblock")->loop()) { ?>
        <h2><?= $this->input("subline"); ?></h2>
        <?= $this->wysiwyg("content"); ?>
    <?php } ?>

</html>