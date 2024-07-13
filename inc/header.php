<!DOCTYPE html>
<html lang="en" class="application-layout person-sessions-new person-sessions-controller new-action visitor chrome webkit windows" id="layout" data-featurette="application-layout"  >
  <head>
    <title>Pears</title>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	<link rel="stylesheet" media="screen" href="css/vendor-85aafb4bb1a3e2aecda6887faf893dce.css" />
	<link rel="stylesheet" media="screen" href="css/animate.css" />
    <link rel="stylesheet" media="screen" href="css/application-1b78ec6179ff7c70a46950302e98dee3.css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:700" rel="stylesheet">
	<link rel="stylesheet" href="css/popup.css">
    

	
	<script  src="js/application_vendor-63a2f1fa50b4cb38d663ebbdca20f07d.js"></script>
    <script  src="js/application-140a627cd61ad3bc4497dafe1f12265e.js"></script>
    <script  src="https://cdnjs.cloudflare.com/ajax/libs/knockout/3.2.0/knockout-min.js"></script>
	<script  src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	
	
	<script  src="js/jquery.popup.js" type="text/javascript"></script>
	<script  src="js/notify.js" type="text/javascript"></script>
	
	<script type="text/javascript" src="js/jquery.noty.packaged.min.js"></script>
	
  
<style>
	body{
		font-family: 'Nunito', arial, serif;
	}
	input{
		font-family: 'Nunito', arial, serif;
	}
	button.sp{
		font-family: 'Nunito', arial, serif;
	}
	a.next{
		font-family: 'Nunito', arial, serif;
	}
	a.prev{
		font-family: 'Nunito', arial, serif;
	}
	a.isdo{
		font-family: 'Nunito', arial, serif;
	}
	
	.progress-status-green {
    background: #5fcf80;
    position: absolute;
    top: 0;
    bottom: 0;
    border-radius: 15px 0 0 15px;
    box-shadow: 0 1px 0 0 rgba(0,0,0,0.05) inset;
}

.progress-status-pur{
    background: #7D669E;
    position: absolute;
    top: 0;
    bottom: 0;
    border-radius: 15px 0 0 15px;
    box-shadow: 0 1px 0 0 rgba(0,0,0,0.05) inset;
}

.progress-status-red {
    background: #5fcf80;
    position: absolute;
    top: 0;
    bottom: 0;
    border-radius: 15px 0 0 15px;
    box-shadow: 0 1px 0 0 rgba(0,0,0,0.05) inset;
}

tbody div{
    overflow:scroll;
    height:100px;
}

	
</style>




</head>

<body id="signin" class="windows chrome webkit ">

 <!-- Google Tag Manager -->

<!-- End Google Tag Manager -->
<header class="header" role="banner" data-header>
  <nav class="header-nav container" role="navigation" data-nav>
    <button class="hamburger-button hamburger-button-inverse" aria-label="Navigation Menu" data-hamburger-button>
     <span class="hamburger"></span>
    </button>

	<ul class="header-nav-list ">
     <li class="header-nav-item  header-nav-item-primary header-nav-item-logo ">
      <h6 class="header-nav-item-logo-container">
       <a class="header-nav-link header-nav-item-logo-link" href="index.php">
        <img class="logo-icon header-nav-item-logo-icon" src="img/pikachu.png"></img>
          <span class="header-nav-item-logo-text header-nav-item-primary" href="index.php">Home</span>
	   </a>
	  </h6>
     </li>

<?php if(isset($_SESSION['userSession'])):?>
<li class="header-nav-item header-nav-item-tablet header-nav-item-primary header-nav-item-techdegrees ">
      <a class="header-nav-link" href="sp.php">My Files</a>
     </li>
	 <li class="header-nav-item header-nav-item-tablet header-nav-item-primary header-nav-item-techdegrees ">
      <a class="header-nav-link" href="#">About us</a>
     </li>
	 <li class="header-nav-item header-nav-item-tablet header-nav-item-primary header-nav-item-techdegrees ">
      <a class="header-nav-link" href="#">Contact us</a>
     </li>
	
   <li class="header-nav-item-tablet header-nav-item-primary" style="margin-top:30px;width:80%">
   
   <div class="capacity-container progress-container">


    <div class="capacity-status progress-status" id="pstatus"></div>
	</div>
	<div style="float:right;margin-top: 4px">
     <p style="color:#fff;font-size:11px;float:left" id="torrent_space"> 
	 <p style="float:left;color:#edeff0;margin-top:-3px;"> &nbsp;/&nbsp;</p> 
	 <p style="color:#5fcf80;font-size:11px;float:left" id="user_space"></p>
    </div>
   </li>
   
<script>

function auto_load(){
     
	 $.ajax({
          url: "space.php?hash=<?php echo $row['userID']; ?>",
          cache: false,
		  success: function(data){
			  $('#torrent_space').empty();
			  $('#user_space').empty();
		        for(i=0;i<data.length;i++)
				  { 
			        $('#torrent_space').append(data[i].torrentspace);
					$('#user_space').append(data[i].userspace);
					//$('#torrent_space').append(data[i].torrentspace);
					$('#pstatus').css('width',data[i].percentage + '%');
					
					if(data[i].sp === 1)
					{
						
						function generate(type, text) {
                         var n = noty({
                             text        : text,
                             type        : type,
                             dismissQueue: true,
                             progressBar : true,
                             timeout     : 5000,
                             layout      : 'bottomRight',
                             closeWith   : ['click'],
                             theme       : 'relax',
                             maxVisible  : 10,
                                   
								   animation   : {
                                         open  : 'animated bounceInLeft',
                                         close : 'animated bounceOutLeft',
                                         easing: 'swing',
                                         speed : 500
                                        }
                                    });
                                return n;
                               }
                        function generateAll() {generate('error', 'Sorry We Remove Your Torrent Due To Less Space You need To Remove Some Item From Your basket');}
						$(document).ready(function () {
                              setTimeout(function () {
                              generateAll();
                                    }, 500);});
						
					}
					
					
				  }
				}
         });
	}
 
$(document).ready(function(){
 
auto_load(); //Call auto_load() function when DOM is Ready
 
});
 
//Refresh auto_load() function after 10000 milliseconds
setInterval(auto_load,4000);
</script>

	<li id="dropd" class="header-nav-item header-nav-item-mobile header-nav-item-secondary header-nav-item-profile header-nav-item-current" data-nav-item="profile">
      <a class="header-nav-link">
	   <div class="header-nav-item-profile-avatar avatar-deep-blue-bg  avatar avatar-small" id="avatar-0934e0">
	    <div class="avatar-container">
<img alt="sagar solanki" class="avatar-image" src="https://secure.gravatar.com/avatar/941e60b1652475db0fa71c11005be198?s=72&amp;d=https%3A%2F%2Fstatic.teamtreehouse.com%2Fassets%2Fcontent%2Fdefault_avatar-d5ee029fdb4c0604d314eb946dbf8e6a.png&amp;r=pg" />
                 
		 </div>
       </div>
	   <span class="header-nav-item-profile-points" id="uclick"><?php echo $row['userName']; ?></span>
      <span class="header-nav-item-profile-text">View Profile</span>
	  <img src ="img/chevron-arrow-down.png" class="header-nav-item-profile-chevron" style="width: 13px;height: 12px;">
	</a>  
  <div class="header-nav-item-profile-dropdown dropdown dropdown-right">
  <h4 class="dropdown-title">
    <a href="#" class="header-nav-item-profile-dropdown-title-link">
      <strong class="header-nav-item-profile-dropdown-title-name"><?php echo "Hello ".$row['userEmail']; ?></strong>
      <!--<span class="header-nav-item-profile-dropdown-title-label">View Profile</span>-->
	  
    </a>
  </h4>
  <ul>
    <li><a href="profile.php">Account Settings</a></li>
      
  </ul>
  <a class="dropdown-secondary" href="logout.php">Sign Out</a>
</div>

</li>





<script>

$('#dropd').click(function(e) {
       $(this).toggleClass('dropdown-show');
});

</script>

 
  <li class="header-nav-item header-nav-item-mobile header-nav-item-secondary header-nav-item-settings ">
   <a class="header-nav-link " href="#">Settings</a>
  </li>
  <li class="header-nav-item header-nav-item-mobile header-nav-item-secondary header-nav-item-sign-out ">
   <a class="header-nav-link " href="logout.php">Sign Out</a>
  </li>  
 </ul>
</li>

<?php else: ?>
	 <li class="header-nav-item  header-nav-item-sign-up">
      <a class="header-nav-link" href="signup.php">Free Trial</a>
     </li>

	 <li class="header-nav-item header-nav-item-mobile header-nav-item-sign-in header-nav-item-current">
      <a class="header-nav-link" href="login.php">Sign In</a>
     </li>

	 
	 <?php endif ?>

</ul>

</nav>
</header>
