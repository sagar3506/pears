<?php
session_start();
require_once 'class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in()) {$user_home->redirect('login.php');}

$stmt = $user_home->runQuery("SELECT * FROM users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

include_once 'inc/header.php';

?>
  
 
      <div class="container ">
        <div class="col-container ">
         <aside data-layout-element="sidebar" class="sidebar col col-30-tablet-desktop">
          <ul id="sidebar-nav">
           <li class=" "><a href="/account">Profile Info</a></li>
           <li class=" "><a href="#">About us</a></li>
           <li class=" "><a href="#">Contact us</a></li>
           <li class=" "><a href="logout.php">Log out</a></li>
          </ul>
         </aside>

        <div class="col col-70-tablet-desktop">
        <!--  ------profile------------ -->
    <div id="profile-info" class="box">
     <figure>
         <div class="avatar-white-bg  avatar avatar-x-large" style="float:left;margin-right: 20%;">
          <div class="points-donut chart avatar-points"></div>
          <div class="avatar-container" style="margin: 0px 0px 0px 62px;">
           <img alt="sagar solanki" class="avatar-image" src="https://secure.gravatar.com/avatar/941e60b1652475db0fa71c11005be198?s=240&amp;d=https%3A%2F%2Fstatic.teamtreehouse.com%2Fassets%2Fcontent%2Fdefault_avatar-d5ee029fdb4c0604d314eb946dbf8e6a.png&amp;r=pg" />
          </div>
         </div>
       <figcaption style="padding: 5% 0% 0% 5%;">
       <h1 id="name">sagar solanki</h1>
       <h6 id="member-since">Member Since December 23, 2016</h6>
      </figcaption>
     </figure>
    </div>


<div class="grid-container">

<!-- Total Torrent Count -->

    <div class="grid-100">
      <div class="contained points-container">
        <div class="grid-100">
          <div class="total-points-container expanded">
            <div class="total-points">
			
			<?php
				$a=$row['userEmail'];
			    $b_id=$row['userID'];
			    $con = mysqli_connect("localhost","admin","dd932bb2ea7583b8c5d656f4db9b04768a4b2ae44e7f4c28");
			    mysqli_select_db($con,"pears");
	            $dupe = mysqli_query($con,"SELECT COUNT(*) FROM torrent WHERE userID='$b_id'") or die (mysqli_error());
                $num_rows = mysqli_fetch_row($dupe);
                
		     ?>
              <h1><?php echo $num_rows[0]; ?></h1>
              <p>Torrent</p>
            </div>
          </div>
        </div>
        <div class="points-breakdown">
		 <div class='grid-100'>
          <div id='membership-level' class='mixed-box'>
           <div class='box-header'>
           
             <table class='data'>
              <thead>
               <tr>
			   <th>No.</th>
                <th>Name</th>
                <th class='plan-cell'>Size</th>
                <th class='plan-cell'>Added On</th>
			   </tr>
              </thead>
			<tbody>
            </tbody>
           </table>
	      </div>
         
        </div>
       </div>
	</div>  
	  <div class="grid-100">
       <div class="disclaimer">
        <a class="icon icon-info" element="a" data-featurette="modal-trigger" data-target="user_points_explanation" href="#"></a>
        <p>Points are earned whenever you take an important action on pears.Learn more about when and how points are earned.</p>
       </div>
      </div>
     </div>
    </div>

    <div class="grid-100">
      <div class="secondary-heading">
        <h2>Account Type</h2>
      </div>

      <div class="contained">
        <div class="grid-100">
          <ul id="profile-experience">
            <li>
              <div class="grid-100 grid-parent">
                <h1>Free Tier</h1>
              </div>
             </li>
		    </ul>
           <a style="margin: 14px;" href="#" class="button icon-on-right">We Are Working on Payment gatway</svg></a>
        </div>
       </div>
    </div>
   </div>
  </div>
 </div>
 </div>
 
  <script>
    
 
 
 $(document).ready(function () {
				$.getJSON('info.php?hash=<?php echo $b_id; ?>',
				function (json) {
					var tr;
					for (var i = 0; i < json.length; i++) {
						console.log(json[i]);
						tr = $('<tr/>');
						tr.append("<td>" + json[i].id + "</td>");
						tr.append("<td>" + json[i].name + "</td>");
						tr.append("<td class='plan-cell'>" + json[i].size + "</td>");
						tr.append("<td class='plan-cell'>" + json[i].date + "</td>");
						$('tbody').append(tr);
					}
				});
			});
   </script>
 
 
<?php
include_once 'inc/footer.php';
?>
