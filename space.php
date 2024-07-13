<?php

ini_set('display_errors', 1);

require_once 'vendor/autoload.php';
   
function formatBytes($size, $decimals = 0)
{
    $unit = array('0' => 'Byte',
                  '1' => 'KB',
                  '2' => 'MB',
                  '3' => 'GB');
    for($i=0;$size>=1024&&$i<= count($unit);$i++){
        $size = $size/1024;}
        return round($size, $decimals).' '.$unit[$i];
}

if(isset($_GET['hash'])){
$conn = mysqli_connect("localhost","admin","dd932bb2ea7583b8c5d656f4db9b04768a4b2ae44e7f4c28");
		mysqli_select_db($conn,"pears");
		
$post_id = mysqli_real_escape_string($conn,$_GET['hash']); //$_GET['hash'];

$get_posts="select * from torrent where userID='$post_id'";
$run_posts = mysqli_query($conn,$get_posts);

//torrent space

$total = 0;
$response = array();
while($row_posts = mysqli_fetch_array($run_posts))
  {
    $post_title=$row_posts['torrent_hash'];
	$transmission = new Transmission\Transmission();

   try{
       $torrent = $transmission->get($post_title);
       $sp = $torrent->getSize();
       $total = $total + $sp;
       
    }catch(Exception $e){
	continue;
}
}

$new = $total; //total torrent space 
$ts = formatBytes($total,2);

//user space

 
$get_posts="select * from free_space where user_id = '$post_id'";
$run_posts = mysqli_query($conn,$get_posts);

if (!$run_posts) { // add this check.
    die('Invalid query: ' . mysql_error());
}
$user_space ;
$user_space_old;
while($row_posts = mysqli_fetch_array($run_posts))
  {
    $space = $row_posts['maxUserSpace'];
	$user_space = $space; //user space
	$old =  formatBytes($space,2);
	$user_space_old = $old;
 }

//percentage

/* get disk space free (in bytes) */
$x = $new;
/* and get disk space total (in bytes)  */
$total = $user_space;

//echo $x;

//echo $space;

$dp = (int)(($x*100)/$total); 


//torrent remove if size > usersize


$s = 0;
if($new > $user_space)
{
 
 $query = "SELECT torrent_hash FROM torrent WHERE userID='$post_id' ORDER BY id DESC LIMIT 1"; 
 $torrnt_hash = mysqli_query($conn,$query);
 
 
while($row_posts = mysqli_fetch_array($torrnt_hash))
  {
    $del_torrent =$row_posts['torrent_hash'];

	try{
       $torrent = $transmission->get($del_torrent);
	   
       //$torrent->stop($torrent);
	    $transmission->stop($torrent);
	   //$torrent->remove($torrent, true);
	   
	   $query = "delete from torrent where userID='$post_id' && torrent_hash='$del_torrent'";
       $run_posts = mysqli_query($conn,$query);
	   if($run_posts)
	   {
		   $s = 1;
	   }
	   }catch(Exception $e){
	continue;
    }
}
}




 array_push($response,array("torrentspace"=>$ts,"userspace"=>$user_space_old,"percentage"=>$dp,"sp"=>$s));
 header("Content-Type: application/json");
}


echo json_encode($response);



?>