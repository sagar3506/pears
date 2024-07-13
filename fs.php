<?php

ini_set('display_errors', 1);

echo "<link rel='stylesheet' media='screen' href='css/application-1b78ec6179ff7c70a46950302e98dee3.css' />";

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
					   
function array_orderby()
{
    $args = func_get_args();
    $data = array_shift($args);
    foreach ($args as $n => $field) {
        if (is_string($field)) {
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

error_reporting(0);

$dir = substr($_GET['val'],14);




class MyRecursiveFilterIterator extends RecursiveFilterIterator {
    public function accept() {
        if (substr($this->current()->getFilename(), 0, 1) !== '.') {
          return true;
        } else {
          return false;
        }
    }

}
//$dir = 'download/a176b8a9f5575a08eac602adfdc78f666e3695a2';
$dirItr = new RecursiveDirectoryIterator($dir);
$dirItr->setFlags(RecursiveDirectoryIterator::SKIP_DOTS);
$filterItr = new MyRecursiveFilterIterator($dirItr);
$itr = new RecursiveIteratorIterator($filterItr, RecursiveIteratorIterator::SELF_FIRST);
$itr->setFlags(RecursiveDirectoryIterator::SKIP_DOTS);

foreach ($itr as $filePath => $fileInfo) {
  if ($fileInfo->isFile()) 
  {
    $final[] =array("name"=>$fileInfo->getFilename(),"size"=>$fileInfo->getSize(),"path"=>$fileInfo->getPathName()); //alternatively you can use $fileInfo->getFilename();
    $sorted = array_orderby($final, 'size', SORT_DESC);
  }
}





echo "<div class='grid-100'>
       <div>
        <div id='membership-level' class='mixed-box'>
         <div class='box-header'>
          <div style='height:170px;overflow:auto;margin-top:20px;'>
           <table class='data'>
  <thead>
    <tr>
      <th>Name</th>
      <th class='plan-cell'>Size</th>
      <th class='plan-cell'>Download</th>
      
    </tr>
  </thead>

  <tbody style='overflow:scroll;height:100px;'>";
  foreach($sorted as $s)
  {
	  krsort($s);
	  echo "<tr>";
	  echo "<td><strong>".$string = substr($s['name'],0,30)."</strong></td>";
      echo "<td class='plan-cell'>".formatBytes($s['size'],2)."</td>";
      echo "<td class='plan-cell'><a class='button primary next' href='".$s['path']."'> Download</a></td>";
	  echo "</tr>";
	}
	
echo "</tbody>
     </table>
	 </div>
    </div>
    <div class='box-footer secondary'>
      <p><span class='icon icon-info'></span>You can <a href='#'> update your payment information</a> here or you may <a href='#'>cancel your account</a>.
          For more information about your Basic membership, <a href='#'>contact support</a>.</p>
       </div>
      </div>
     </div>
	</div>";
?>

