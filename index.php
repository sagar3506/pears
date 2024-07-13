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
?>

<?php
include_once 'inc/header.php';
?>


<main class="content">
 <div class="container">
  <div class="alert-banner success with-icon with-action">
   <center><p>Top Download</p><center>
  </div>
  
  <div class="recommendations-container">
    <div class="section-heading first">
      <h2>Recommended Downloads</h2>
      <p>updated every week</p>
    </div>
    <ul class="card-list truncated">
	
	<!-- First Box -->
	
      <li class="card course syllabus topic-digital-literacy in-progress personalized">
      <div class="card-box">
       <div class="card-progress">
         <ul class="stage">
          <li class="card-action">
           <div class="card-action-button async-modal-trigger">1</div>
	      </li>		
         </ul>	  
	   
        <span class="card-estimate">51 min left</span>
       </div>
       <strong class="card-type">Course</strong>
        <h3 class="card-title">Computer Basics</h3>
      </div>
	  
	  <ul class="card-actions">
      <li class="card-action resume">
        <a class="button primary" href="#">Resume</a>
		
      </li>
      
	  <li class="card-action secondary card-action-trailer">
       <a class="card-action-button async-modal-trigger"></a>
	  </li>
     </ul>
    </li>
        
    <!-- Second Box -->
    <li class="card course syllabus topic-design bookmarked personalized">
     <div class="card-box" href="#">
       <div class="card-progress">
	     <ul class="stage">
          <li class="card-action">
           <div class="card-action-button async-modal-trigger">2</div>
	      </li>		
         </ul>	
		<span class="card-estimate">2 hours</span>
       </div>
    
	<strong class="card-type">Course</strong>
     <h3 class="card-title">Mobile Game Design</h3>
    </div>
   
    <ul class="card-actions">
      <li class="card-action resume">
        <a class="button primary" href="#">Start</a>
      </li>
      <li class="card-action secondary card-action-trailer">
        <a href="#" class="card-action-button async-modal-trigger"></a>
      </li>
    </ul>
   </li>
   
   <!-- 3rd Box -->
   
   <li class="card course syllabus topic-undefined bookmarked personalized">
  <div class="card-box" href="#">
    <div class="card-progress">
      <ul class="stage">
          <li class="card-action">
           <div class="card-action-button async-modal-trigger">3</div>
	      </li>		
         </ul>
      <span class="card-estimate">103 min</span>
    </div>
	
    <strong class="card-type">Bonus Series</strong>
    <h3 class="card-title">The Show (2017 - Present)</h3>
  </div>
<ul class="card-actions">
      <li class="card-action resume">
        <a class="button primary" href="#">Start</a>
      </li>
      <li class="card-action secondary card-action-trailer">
        <a href="#" class="card-action-button async-modal-trigger"></a>
      </li>
    </ul>
   </li> 
    
 
 
 
 
   

  </div>
 </div>
</main>























<?php
                
/* require __DIR__ . '/vendor/autoload.php';

	function array_orderby()
	{
	  $args = func_get_args();
	  $data = array_shift($args);
	  foreach ($args as $n => $field) {
		if (is_string($field)) 
		  {
			$tmp = array();
			foreach ($data as $key => $row)
					$tmp[$key] = $row[$field];
					$args[$n] = $tmp;
			}
		}
		$args[] = &$data;
		call_user_func_array('array_multisort', $args);
		return array_pop($args);
	}
	
    function duration ($sec) {return trim (m(3600,$sec,'hour').m(60,$sec,'minute').m(1,$sec,'second'));}
     
	function clean($string) {
      $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
      $string = preg_replace('/[^A-Za-z0-9\-]/', ' ', $string); // Removes special chars.
      return preg_replace('/-+/', ' ', $string); // Replaces multiple hyphens with single one.
     }
	 
	 

	$a=$row['userEmail'];
	$b_id=$row['userID'];
	$con = mysqli_connect("localhost","root","");
	mysqli_select_db($con,"pears");
	$dupe = mysqli_query($con,"SELECT torrent_hash,COUNT(*) FROM torrent GROUP BY torrent_hash") or die (mysqli_error($con));
    $d=mysqli_fetch_assoc($dupe);
	
    function formatBytes($size, $decimals = 0)
	{
      $unit = array('0' => 'Byte','1' => 'KB','2' => 'MB','3' => 'GB');
              for($i=0;$size>=1024&&$i<= count($unit);$i++){$size = $size/1024;}
               return round($size, $decimals).' '.$unit[$i];
             }
                
    foreach($dupe as $sp)
	    {
		  $tt = $sp['torrent_hash'];
		  $er [] = array("name" =>$tt , "no" => $sp['COUNT(*)']);
		  $sorted = array_orderby($er, 'no', SORT_DESC);
	    }
		
	$counter = 0;		
	foreach(array_slice($sorted, 0, 10) as $s)
		{
		   $counter++;
		   krsort($s);
		   
		   //transmission start
		   $transmission = new Transmission\Transmission();
		   
		   try{
               $torrent = $transmission->get($s['name']);
               $name = clean($torrent->getName());
               $sp = $torrent->getSize();
               $size = formatBytes($sp,2);
               $dir = "fs.php?val=".$torrent->getDownloadDir();
               }catch(Exception $e){
	                continue;
			   }
		
            echo $name."<br />";	
            echo $s['no']."<br />";			
		    echo $size."<br />";
			echo $dir."<br />";
		   
		   //echo $s['name']."<br />";
		   //echo $s['no']."<br />";
			
			
            			
					  
		}
		
		*/
?>

<?php
include_once 'inc/footer.php';
?>


