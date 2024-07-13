<?php
session_start();
require_once 'class.user.php';
$user_login = new USER();



if($user_login->is_logged_in()!="")
{
	$user_login->redirect('sp.php');
}

if(isset($_POST['btn-login']))
{
	$email = trim($_POST['txtemail']);
	$upass = trim($_POST['txtupass']);
	
	if($user_login->login($email,$upass))
	{
		//$currentDate = date('Y-m-d H:i:s', time());
		
		//mysqli_query("UPDATE 'users' SET 'lastvisit_at' = ".$currentDate." WHERE userEmail = '".$email."' ");
		
		$user_login->redirect('sp.php');
	}
}
?>


<?php
include_once 'inc/header.php';
?>

<main class="content " role="main" data-content="">
 <div class="container ">
  <div class="grid-container">
    <div class="grid-50 tablet-grid-70 centered">
      <div class="contained">
       <div class="grid-100">
	   
	   
  
  <?php 
		if(isset($_GET['inactive']))
		{
			?>
			
			<div class="alert-banner error " data-featurette="alert" id="featurette-1">
   <p><strong>Sorry !</strong> This Account is not Activated Go to your Inbox and Activate it.</p>
   <button class="button  close-alert" data-close-alert="" title="Close">
    <img class="close-icon" src="img/cancel.png"></img>
   </button>
  </div>
<?php
		}
		?>
  
        <form class="new_user_session" action="" accept-charset="UTF-8" method="post">
		
		<?php
        if(isset($_GET['error']))
		{
			?>
  <div class="alert-banner error " data-featurette="alert" id="featurette-1">
   <p><strong>Wrong Details</strong></p>
   <button class="button  close-alert" data-close-alert="" title="Close">
    <img class="close-icon" src="img/cancel.png"></img>
   </button>
  </div>
 <?php
		}
		?>
		  <div class="form-item">
            <input autofocus="autofocus" class="form-text-input input-text input-text" type="email" name="txtemail" placeholder="Email Address"/>
          </div>
			  
          <div class="form-item">
            <input class="form-text-input input-text input-text" type="password" name="txtupass" id="user_session_password" placeholder="Password"/>
          </div>
		  <div class="form-item error" style='display:none'>
           <div class="field_with_errors"><label for="user_session_password" class="in-field-label-processed" style="opacity: 1;">Password</label></div>
           <div class="field_with_errors"><input class="form-text-input input-text input-text placeholder-processed" type="password" name="user_session[password]" id="user_session_password"></div>
           <p class="error-message">cannot be blank</p>
		  </div>
          
		  <p class="forgot-password"><a href="fp.php">I forgot my password</a></p>
          
		  <button type="submit" name="btn-login" class="button primary sp">Sign in</button>
        </form>      
       </div>
      </div>
     </div>
    </div>
   </div>
   
  

<?php
include_once 'inc/footer.php';
?>


