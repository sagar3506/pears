<?php

require __DIR__ . '/vendor/autoload.php';


function duration ($sec) {

    return

     trim (

      m(3600,$sec,'hour')

      .m(60,$sec,'minute')
	  .m(1,$sec,'second')

     );

}

function m($cycle,&$seconds,$unit) {

  if ($seconds >= $cycle) {

    $r=($a=((int)($seconds/($cycle)))).' '.$unit;

    if ($a!=1) $r.='s';

    $seconds -= $a*$cycle;

    return $r.' ';

  } else return '';

}

function clean($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
   $string = preg_replace('/[^A-Za-z0-9\-]/', ' ', $string); // Removes special chars.

   return preg_replace('/-+/', ' ', $string); // Replaces multiple hyphens with single one.
}



function formatBytes($size, $decimals = 0){
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

if (!$run_posts) { // add this check.
    die('Invalid query: ' . mysql_error());
}
$response = array();

$counter = 0;
$total = 0;

while($row_posts = mysqli_fetch_array($run_posts))
{
$counter++;
$post_id1=$row_posts['userID'];
$post_title=$row_posts['torrent_hash'];

$insert_date = $row_posts['date_insert'];

$date = date('F j, Y,  g:i A',strtotime($insert_date));

$transmission = new Transmission\Transmission();
try{
$torrent = $transmission->get($post_title);

$name = clean($torrent->getName());
$sp = $torrent->getSize();



//$sp1[] = $sp;

$size = formatBytes($sp,2);

$total = $total + $sp;

$downloaded = $torrent->getDownloadedEver();
$downloaded_size = formatBytes($downloaded,2);
$sp1 = $torrent->getDownloadRate();
$download_r = formatBytes($sp1,2)." / s";
$ta= $torrent->getEta();



$eta = duration($ta);
if($torrent->getPercentDone() == 100)
{
	$eta = "Complete";
	$transmission->stop($torrent);
}
else if($torrent->getStatus() == 0)
{
	$eta = "Pause";
}

$seed = $torrent->getPeersConnected();

if($torrent->getPeersConnected() == 0)
{
	$seed = "Caching";
}

$del = "delete.php?del=".$torrent->getHash();
$dir = "fs.php?val=".$torrent->getDownloadDir();
if($torrent->isFinished()) {
	
	//$transmission->stop();
}
}catch(Exception $e){
	continue;
}
array_push($response,array("id"=>$counter,
                           "name"=>$name,
                           "progress"=>$torrent->getPercentDone(),
						   "size"=>$size,
						   "downloaded"=>$downloaded_size,
						   "hash"=>$torrent->getHash(),
						   "peer"=>$seed,
						   "delete"=>$del,
						   "speed"=>$download_r,
						   "eta"=>$eta,
						   "date"=>$date,
						   "path"=>$dir));
    header("Content-Type: application/json");
 
}
$ts = formatBytes($total,2);
echo json_encode($response);





}

?>
