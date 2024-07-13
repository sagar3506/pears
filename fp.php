<?php

include_once 'inc/header.php';

session_start();
require_once 'class.user.php';
$user = new USER();

if($user->is_logged_in()!="")
{
	$user->redirect('sp.php');
}

if(isset($_POST['btn-submit']))
{
	$email = $_POST['txtemail'];
	
	$stmt = $user->runQuery("SELECT userID FROM users WHERE userEmail=:email LIMIT 1");
	$stmt->execute(array(":email"=>$email));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);	
	if($stmt->rowCount() == 1)
	{
		$id = base64_encode($row['userID']);
		$code = md5(uniqid(rand()));
		
		$stmt = $user->runQuery("UPDATE users SET tokenCode=:token WHERE userEmail=:email");
		$stmt->execute(array(":token"=>$code,"email"=>$email));
		
		
$message = "<center>
 <table border='0' cellpadding='0' cellspacing='0' height='100%' width='100%' style='background:#edeff0;color:#9ba6b0;font-family:Helvetica,sans-serif;font-size:14px;height:100%!important;margin:0;padding:0;width:100%!important' bgcolor='#edeff0'>
  <tbody>
   <tr>
     <td align='center' style='border-collapse:collapse;padding-bottom:15px;vertical-align:top' valign='top'>
       <table border='0' cellpadding='0' cellspacing='0' style='display:block;margin-left:5%;margin-right:5%;max-width:600px;width:90%'>
        <tbody>
		 <tr>
          <td align='center' style='border-collapse:collapse;vertical-align:top' valign='top'>
           <table border='0' cellpadding='0' cellspacing='0' style='width:100%'>
            <tbody>
			 <tr>
              
              <td> &nbsp;&nbsp; </td>
             </tr>
            </tbody>
		   </table> 
          </td>
         </tr>
         <tr>
         <td align='center' style='border-collapse:collapse;vertical-align:top' valign='top'>
         <table border='0' cellpadding='0' cellspacing='0' style='background:#fff;border-top-left-radius:5px;border-top-right-radius:5px' bgcolor='#FFF'>
          <tbody>
		   <tr>
            <td align='center' style='border-collapse:collapse;padding-left:7%;padding-right:7%;padding-top:3%;vertical-align:top' valign='top'>
             <table border='0' cellpadding='0' cellspacing='0'>
              <tbody>
			   <tr>
                <td style='border-collapse:collapse;font-size:18px;font-weight:bold;line-height:100%;padding-bottom:25px;text-align:left;vertical-align:top' align='left' valign='top'>
                 
				 <h1 style='color:#384047;display:block;font-family:Helvetica,sans-serif;font-size:24px;font-weight:bold;letter-spacing:normal;line-height:130%;margin:15px 0;text-align:left' align='left'>
                   Hi $email , here's how to reset your password.
                 </h1>
				 
                <h2 style='color:#8d9aa5;display:block;font-family:Helvetica,sans-serif;font-size:18px;font-weight:normal;letter-spacing:normal;line-height:150%;margin:15px 0 10px;text-align:left' align='left'>
                   We have received a request to have your password reset for 
				<a style='color:#657380;font-family:Helvetica,sans-serif;font-weight:bold;text-decoration:none' href='#' target='_blank' rel='noreferrer'>Pears.com</a>.
				If you did not make this request, please ignore this email.
               </h2>
			   
			   <h2 style='color:#8d9aa5;display:block;font-family:Helvetica,sans-serif;font-size:18px;font-weight:normal;letter-spacing:normal;line-height:150%;margin:15px 0 10px;text-align:left' align='left'>
                To reset your password, please 
			   <a style='color:#3f8abf;font-weight:bold;text-decoration:none' href='http://68.183.165.114/reset.php?id=$id&code=$code'>visit this link</a>.
               </h2>
              </td>
			  
			  
            <td style='border-collapse:collapse;color:#8d9aa5;font-size:14px;padding-left:20px;padding-top:22px;text-align:right;vertical-align:top;width:55x' align='right' valign='top'>
             
			 <div style='min-height:55px;width:55px'>
              <img width='55' height='55' style='border:0;display:block;min-height:auto;line-height:100%;outline:none;text-decoration:none;width:55px' src='https://email-images.teamtreehouse.com/global/icon-settings2x.png'>
             </div>
            </td>
           </tr>
		  </tbody>
         </table>
        </td>
       </tr>
      </tbody>
	 </table>
    </td>
   </tr>

  <tr>
  <td align='center' style='vertical-align:top' valign='top'>
  <table border='0' cellpadding='0' cellspacing='0' width='100%' style='background:#fff;border-bottom-left-radius:5px;border-bottom-right-radius:5px;width:100%' bgcolor='#FFF'>
   <tbody>
    <tr>
     <td align='center' style='border-collapse:collapse;padding-bottom:3%;padding-left:7%;padding-right:7%;vertical-align:top' valign='top'>
      <table border='0' cellpadding='0' cellspacing='0'>
       <tbody>
	    <tr>
         <td style='border-collapse:collapse;border-top-color:#e2e5e8;border-top-style:solid;border-top-width:1px;color:#8d9aa5;font-size:14px;line-height:150%;padding-bottom:10px;padding-top:20px;text-align:left;vertical-align:top' align='left' valign='top'>
          <h4 style='color:#384047;display:block;font-family:Helvetica,sans-serif;font-size:16px;font-weight:bold;letter-spacing:normal;line-height:130%;margin:15px 0;text-align:left' align='left'>
            Having trouble?
          </h4>
		  
        <p style='font-family:Helvetica,sans-serif;line-height:160%;margin-bottom:15px;margin-top:13px'>If the above link does not work try copying and pasting this link into your browser:</p>
        
		<pre style='background:#f3f5f6;border-bottom-left-radius:5px;border-bottom-right-radius:5px;border-top-left-radius:5px;border-top-right-radius:5px;color:#8d9aa5;font-family:Helvetica,sans-serif;font-size:14px;line-height:160%;padding:15px 20px 13px;white-space:normal'>                                
		
		<a href='http://68.183.165.114/resetpass.php?id=$id&code=$code' target='_blank' rel='noreferrer'>http://68.183.165.114/resetpass.php?id=$id&code=$code</a>
        
		</pre>
	   </td>
      </tr>
     </tbody>
	</table>
   </td>
  </tr>
   </tbody>
  </table>
 </td>
</tr>

</tbody>
</table>
</td>
</tr>
</tbody></table>
</center>";		   
		   
				   
				   
				   
				   
		$subject = "Password Reset";
		
		$user->send_mail($email,$message,$subject);
		
	$msg = "<div class='alert-banner success' data-featurette='alert' id='featurette-1'>
     <p><strong>Alright !</strong> I sent an email to $email. Please click on the password reset link in the email to generate new password.</p>
   </div>";		
				
	}
	else
	{
		
				
		$msg = "<div class='form-item error'>
                 <p class='error-message' style='border-radius:5px 5px 5px 5px'>Sorry This Email Not Found</p>
                </div>";		
	}
}
?>

<main class="content " role="main">
      <div class="container ">
        
 <div class="grid-container">
  <div class="grid-40 centered">
    <div class="contained">
      <div class="grid-100">
        <div class="secondary-heading">
          <h1>Reset Password</h1>
          <p>Enter your email address and we’ll send you an email with instructions to reset your password.</p>
        </div>
       
	    <form class="standard" id="new_person" action="#" accept-charset="UTF-8" method="post">
		<?php
			if(isset($msg))
			{
				echo $msg;
			}
			else
			{
				
			}
		?>
	    
		<div class="form-item">
		<label for="person_email" class="in-field-label-processed" placeholder="Email Address"></label>
        <input class="form-text-input input-text input-text placeholder-processed" type="email" name="txtemail" id="person_email" required>
		</div> 
		
	     <div class="form-footer">
         <button class="button" type="submit" name="btn-submit">Reset Password</button>
        </div>
       </form>
      </div>
	  
	  
	  
	  
	 <div class="grid-100">
        <div class="disclaimer" style="margin-top: 30px">
          <span class="icon icon-info"></span>
          <p>If you don't receive an email from us within a few minutes, check your spam filter as sometimes they end up in there. The email will be from <strong>test@test.com</strong>.</p>
        </div>
      </div>

    </div>
  </div>
</div>



</div>

</main>


