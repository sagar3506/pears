<?php
session_start();
require_once 'class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('login.php');
}

$stmt = $user_home->runQuery("SELECT * FROM users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

include_once 'inc/header.php';?>

    <div class="grid-100">
      <div class="mixed-box content-suggestions topic-digital-literacy">
        <div class="box-header">
            <h3>You're doing great, sagar!</h3>
        </div>
		<div class="box-content secondary">
	<div class="box-footer box-actions" style="border-radius:4px 4px 4px 4px;padding-bottom: 5px;">
		   <h3 style="float:left;"> BOLLYGRAM 6th </h3>
           <p style="float:left;padding-left: 10%;">&nbsp;&nbsp; 60 MB</p>
		   <a style="float:right;margin-top: -8px;" class="button primary"><img src='img/cloud-computing.png'></img></a>
		</div>
		</div>
		<div class="box-footer box-actions">
		   <h3 style="float:left;"> CopyRight By Sagar Solanki </h3>
		</div>
      </div>
    </div>










































	
	<script>
	
	// function bytesToSize(bytes) {
    // var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    // if (bytes == 0) return 'n/a';
    // var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
    // if (i == 0) return bytes + ' ' + sizes[i]; 
    // return (bytes / Math.pow(1024, i)).toFixed(1) + ' ' + sizes[i];
// };
	  
  // $("input[type=submit]").click(function () {
	 // $("<tr>").html(''); 
	  
   // $.post('fs.php', 'val=' + $(this).val(), function (data) {
	   
	   // var items = [];
		 // $.each(data,function(key,val){
			 // items.push("<tr>");
			 // items.push("<td id=''" +key+ "''>" + val.name +"</td>");
			 // items.push("<td id=''" +key+ "''>" + bytesToSize(val.size) +"</td>");
			 // items.push("<td>");
			 // items.push("<a href='" + val.path + "' download='"+ val.name +"' >" + "Download" + "</a>");
			 // console.log("<a href='" + val.path + "' download='"+ val.name +"'>" + "Download" + "</a>");
			 // items.push("</td>");
			 // items.push("</tr>");
			 // });
		 // $('<tbody/>',{html:items.join("")}).appendTo("table");
      
   // });
// });
	
	
	 </script>
	
