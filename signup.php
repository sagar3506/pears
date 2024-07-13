<?php
session_start();
require_once 'class.user.php';

$reg_user = new USER();

if($reg_user->is_logged_in()!="")
{
	$reg_user->redirect('fp.php');
}


if(isset($_POST['btn-signup']))
{
	$uname = trim($_POST['txtuname']);
	$email = trim($_POST['txtemail']);
	$upass = trim($_POST['txtpass']);
	$code = md5(uniqid(rand()));
	
	$stmt = $reg_user->runQuery("SELECT * FROM users WHERE userEmail=:email_id");
	$stmt->execute(array(":email_id"=>$email));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if($stmt->rowCount() > 0)
	{
		$msg ="<div class='alert-banner error' data-featurette='alert' id='featurette-1'>
   <p><strong>Sorry !</strong> email allready exists , Please Try another one.</p>
   <button class='button  close-alert' data-close-alert='' title='Close'>
    <img class='close-icon' src='img/cancel.png'></img>
   </button>
  </div>";
  
	}
	else
	{
		if($reg_user->register($uname,$email,$upass,$code))
		{			
			$id = $reg_user->lasdID();		
			$key = base64_encode($id);
			$id = $key;
			
	$message = 					
		"<div marginwidth='0' marginheight='0' style='background:#edeff0;width:100%!important;margin:0;padding:0'>
		<center>
            <table border='0' cellpadding='0' cellspacing='0' height='100%' width='100%' style='background:#edeff0;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;height:100%!important;margin:0;padding:0;width:100%!important;font-size:14px;color:#9ba6b0'>
                <tbody><tr>
                    <td align='center' style='vertical-align:top;padding-bottom:15px;border-collapse:collapse'>
                        
                        <table class='m_-5415069015853883012flexible' border='0' cellpadding='0' cellspacing='0' style='width:90%;max-width:600px;margin-right:5%;margin-left:5%;display:block'>
                            <tbody><tr>
                                <td align='center' style='vertical-align:top;border-collapse:collapse'>
                                    
                                    <table border='0' cellpadding='0' cellspacing='0' style='width:100%'>
                                        <tbody><tr>
                                            <td align='left' width='192' style='width:192px;vertical-align:top;padding-top:21px;padding-bottom:21px;border-collapse:collapse'>
                                                   <a style='color:#3f8abf;text-decoration:none;font-weight:inherit'></a>
                                            </td>
                                            <td>
                                                &nbsp;&nbsp;
                                            </td>
                                        </tr>
                                    </tbody></table>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td align='center' style='vertical-align:top'>
                                    
                                    <table border='0' cellpadding='0' cellspacing='0' width='100%' style='width:100%;background-color:#fff;border-bottom-left-radius:5px;border-bottom-right-radius:5px;border-top-left-radius:5px;border-top-right-radius:5px'>
                                        
                                        <tbody><tr>
                                            <td align='center' style='vertical-align:top;border-collapse:collapse'>
                                                <table border='0' cellpadding='0' cellspacing='0' width='100%' style='border-top-left-radius:5px;border-top-right-radius:5px'>
                                                    <tbody><tr>
                                                        <td style='vertical-align:top;color:#9ba6b0;font-size:14px;line-height:150%;text-align:center;border-collapse:collapse'>
                                                            
                                                        </td>
                                                    </tr>
                                                </tbody></table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align='center' style='vertical-align:top;border-collapse:collapse;padding-right:7%;padding-left:7%;padding-bottom:3%'>
                                                <table border='0' cellpadding='0' cellspacing='0' style='padding-top:20px;padding-bottom:5px'>
                                                    <tbody><tr>
                                                        <td style='vertical-align:top;color:#9ba6b0;font-size:16px;line-height:150%;text-align:left;border-collapse:collapse'>
														 <h3 style='font-family:Helvetica,sans-serif;color:#384047;display:block;font-size:21px;font-weight:bold;line-height:130%;letter-spacing:normal;margin:15px 0 0 0'>We are waiting 
														  <img goomoji='1f557' data-goomoji='1f557' style='margin:0 0.2ex;vertical-align:middle;max-height:24px' alt='ðŸ•—' src='https://mail.google.com/mail/e/1f557' class='CToWUd'> $uname 
														 </h3>

<p style='padding-top:20px;font-family:Helvetica,sans-serif;line-height:1.6;margin-top:0px;color:#9ba6b0;font-size:14px'>
 <span id='m_-5415069015853883012docs-internal-guid-9c031124-f4d4-4845-37bb-f4c51319faeb'>Well done! You're almost ready to Download small package 
  <a style='color:#c25975;font-weight:bold;text-decoration:none'>Torrent</a>, 
  <a style='color:#3079ab;font-weight:bold;text-decoration:none'>Movies</a>,
  <a style='color:#f092b0;font-weight:bold;text-decoration:none'>Music</a>, 
  <a style='color:#53bbb4;font-weight:bold;text-decoration:none'>Game</a> and 
  <a style='color:#5cb860;font-weight:bold;text-decoration:none'>Tutorial</a>.
 </span><br>
<br>
<span id='m_-5415069015853883012docs-internal-guid-9c031124-f4d4-4845-37bb-f4c51319faeb'>However, you can't learn anything until you sign up for a 
 <a style='color:#3f8abf;text-decoration:none;font-weight:inherit'><strong>free trial</strong></a>.</span></p>

<h4 style='margin:0 0 15px'>Go ahead and get started!</h4>
<a class='m_-5415069015853883012button' href='http://68.183.165.114/verify.php?id=$id&code=$code' style='color:white!important;text-decoration:none;font-weight:bold;font-family:Helvetica,sans-serif;margin-top:15px;margin-bottom:20px;padding-top:13px;padding-right:22px;padding-bottom:12px;padding-left:22px;background:#3079ab;font-size:16px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;display:inline-block;vertical-align:middle;border-top-left-radius:5px;border-top-right-radius:5px;border-bottom-left-radius:5px;border-bottom-right-radius:5px' target='_blank'>Start Your Free Trial</a></td>
                                                   
													</tr>
                                                </tbody></table>
                                            </td>
                                        </tr>
                                    </tbody></table>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td align='left' style='vertical-align:top;border-collapse:collapse'>
                                    
                                    <table class='m_-5415069015853883012footer' border='0' cellpadding='0' cellspacing='0' style='width:100%'>
                                        <tbody><tr>
                                            <td class='m_-5415069015853883012contact-info' style='text-align:center;vertical-align:top;padding-top:25px;border-collapse:collapse'>
                                                <p style='font-family:Helvetica,sans-serif;line-height:160%;color:#b7c0c7;font-size:12px;margin-top:0px;margin-bottom:0!important'>
                                                     Pears Island Inc
                                                </p>
                                                
                                            </td>
                                        </tr>
                                    </tbody></table>
                                    <table class='m_-5415069015853883012footer' border='0' cellpadding='0' cellspacing='0' style='width:100%'>
                                        <tbody><tr>
                                            
                                        </tr>
                                    </tbody></table>
                                    
                                </td>
                            </tr>
                        </tbody></table>
                        
                    </td>
                </tr>
            </tbody></table>
        </center>
	   </div>";
						
$subject = "Confirm Registration";
						
			$reg_user->send_mail($email,$message,$subject);	
			$msg = "<div class='alert-banner success' data-featurette='alert' id='featurette-1'>
   <p><strong>Alright !</strong> Instructions to Active your Acoount have been emailed to you $email. Please check your email.</p>
   <button class='button  close-alert' data-close-alert='' title='Close'>
    <img class='close-icon' src='img/cancel.png'></img>
   </button>
  </div>";
  
  
  // $stmt = $this->conn->prepare("INSERT INTO `free_space` (userID,maxUserSpace) VALUES ('".$userRow['userID']."','524288000')");
   //$stmt->execute();
  

					
		}
		else
		{
			echo "sorry , Query could no execute...";
		}		
	}
}
?>

<?php
include_once 'inc/header.php';
?>

<main class="content">
 <div class="container">
  <div class="grid-container">
    <div class="grid-50 tablet-grid-70 centered">
      <div class="contained">
       <div class="grid-100">
	   
	    <?php if(isset($msg)) echo $msg;  ?>
		
        <form class="new_user_session" action="" accept-charset="UTF-8" method="post">
		 
		 <div class="form-item">
            <input autofocus="autofocus" class="form-text-input input-text input-text" type="text" name="txtuname" placeholder="Username" required/>
          </div>
		  
		  <div class="form-item">
            <input autofocus="autofocus" class="form-text-input input-text input-text" type="email" name="txtemail" placeholder="Email Address" required/>
          </div>
			  
          <div class="form-item">
            <input class="form-text-input input-text input-text" type="password" name="txtpass" placeholder="Password" required/>
          </div>
		  
		  <div class="form-item error" style='display:none'>
           <div class="field_with_errors"><label for="user_session_password" class="in-field-label-processed" style="opacity: 1;">Password</label></div>
           <div class="field_with_errors"><input class="form-text-input input-text input-text placeholder-processed" type="password" name="user_session[password]" id="user_session_password"></div>
           <p class="error-message">cannot be blank</p>
		  </div>
          
		 <button type="submit" style="float:right" name="btn-signup" class="button primary full-on-mobile placeholder-processed sp">Join Pears Inc.</button>
        </form>   
		
       </div>
      </div>
     </div>
    </div>
   </div>
<?php
include_once 'inc/footer.php';
?>


