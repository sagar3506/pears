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
	
	$statusY = "Y";
	$statusN = "N";
	
	$stmt = $user->runQuery("SELECT userID,userStatus FROM users WHERE userID=:uID AND tokenCode=:code LIMIT 1");
	$stmt->execute(array(":uID"=>$id,":code"=>$code));
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	if($stmt->rowCount() > 0)
	{
		if($row['userStatus']==$statusN)
		{
			$stmt = $user->runQuery("UPDATE users SET userStatus=:status WHERE userID=:uID");
			
			$stmt->bindparam(":status",$statusY);
			$stmt->bindparam(":uID",$id);
			$stmt->execute();	
			
			//insert free space in user panel
			
		    $stmt = $user->runQuery("INSERT INTO free_space(user_id,maxUserSpace) VALUES($id,'1368709120')");
			$stmt->execute();
			
			$msg = "<strong>WoW !</strong>  Your Account is Now Activated : <a href='index.php'>Login here</a>";	
				   
		    
		}
		else
		{
			$msg = "
		           
				   
				   <strong>sorry !</strong>  Your Account is allready Activated : <a href='index.php'>Login here</a>
			       
			       ";
		}
	}
	else
	{
		$msg = "
		      
			   <strong>sorry !</strong>  No Account Found : <a href='signup.php'>Signup here</a>
			   
			   ";
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
        </div>
         <?php if(isset($msg)) { echo $msg; } ?>
		 
		 
		 
		 
        </div>
    </div>
  </div>
</div>

</div></main>

