<?php

include_once 'inc/header.php';


require_once 'class.user.php';
$user = new USER();

if(empty($_GET['id']) && empty($_GET['code']))
{
	$user->redirect('index.php');
}

if(isset($_GET['id']) && isset($_GET['code']))
{
	$id = base64_decode($_GET['id']);
	$code = $_GET['code'];
	
	$stmt = $user->runQuery("SELECT * FROM users WHERE userID=:uid AND tokenCode=:token");
	$stmt->execute(array(":uid"=>$id,":token"=>$code));
	$rows = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if($stmt->rowCount() == 1)
	{
		if(isset($_POST['btn-reset-pass']))
		{
			$pass = $_POST['pass'];
			$cpass = $_POST['confirm-pass'];
			
			if($cpass!==$pass)
			{
				$msg = "<div class='alert alert-block'>
						<button class='close' data-dismiss='alert'>&times;</button>
						<strong>Sorry!</strong>  Password Doesn't match. 
						</div>";
			}
			else
			{
				$password = md5($cpass);
				$stmt = $user->runQuery("UPDATE users SET userPass=:upass WHERE userID=:uid");
				$stmt->execute(array(":upass"=>$password,":uid"=>$rows['userID']));
				
				$msg = "<div class='alert alert-success'>
						<button class='close' data-dismiss='alert'>&times;</button>
						Password Changed.
						</div>";
				header("refresh:5;index.php");
			}
		}	
	}
	else
	{
		$msg = "<div class='alert alert-success'>
				<button class='close' data-dismiss='alert'>&times;</button>
				No Account Found, Try again
				</div>";
				
	}
	
	
}

?>



<main class="content " role="main" data-content="">
  <div class="container ">
    <div class="grid-container">
     <div class="grid-40 centered">
      <div class="contained">
       <div class="grid-100">
        <div class="secondary-heading">
          <h1>Change Password</h1>
          <p>Hey <strong><?php echo $rows['userName'] ?></strong> Enter your desired password.</p>
        </div>

         <form class="standard" accept-charset="UTF-8" method="post">
		 
		 <?php
			if(isset($msg)){
				echo $msg;
			}
		?>
		   
           <div class="form-item">
            <input class="form-text-input input-text input-text" type="password" placeholder="New Password" name="pass" required>
           </div>
		   
		   <div class="form-item">
            <input class="form-text-input input-text input-text" type="password" placeholder="Confirm New Password" name="confirm-pass" required>
           </div>
		   
		   <div class="form-footer">
            <button type="submit" class="button" name="btn-reset-pass">Change Password</button>
          </div>
         </form>  
		</div>
       </div>
      </div>
     </div>
    </div>
   </main>




