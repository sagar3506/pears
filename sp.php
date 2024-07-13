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

<main class="content">
 <div class="container">
  <div class="grid-container" id="shake">
    <div class="grid-50 tablet-grid-70 centered">
      <div class="contained">
       <div class="grid-100">
	   
	   <?php
	   
	   //ini_set('display_errors', 1);
	   
		require_once 'vendor/autoload.php';
		use Transmission\Transmission;
		use PHP\BitTorrent\Torrent;
		
		function clean($string) {
            $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
            $string = preg_replace('/[^A-Za-z0-9\-]/', ' ', $string); // Removes special chars.

           return preg_replace('/-+/', ' ', $string); // Replaces multiple hyphens with single one.
           }

		$transmission = new Transmission();
		$a=$row['userEmail'];
		$b_id=$row['userID'];

		if(isset($_POST['btn-upload'])){
              if(empty($_POST['txthash'])){
			
			    echo "<script>
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
											}});
                                        return n;
								    }
                        function generateAll() {generate('error', 'plz Enter Something');}
						           $(document).ready(function () {
                                          setTimeout(function () {
                                                   generateAll();
                                                       }, 500);});
										</script>";
								    }
									
		else if($_POST['txthash'])
		{
		  $str = strtolower($_POST['txthash']);

            if(preg_match('/magnet:\?xt=urn:[a-z0-9]+:[a-z0-9]{32,40}/', $str))
		     {
                $string = strtolower($_POST['txthash']);
			    preg_match('#magnet:\?xt=urn:btih:(?<hash>.*?)&dn=(?<filename>.*?)$#', $string, $magnet_link);

			     //get hash VALUES
			    $tmh = $magnet_link['hash'];
                $con = mysqli_connect("localhost","admin","dd932bb2ea7583b8c5d656f4db9b04768a4b2ae44e7f4c28");
			    $tname = clean($magnet_link['filename']);
				
				$string345 = substr($tname,0,7);
				
				
				
				
				// Torrent Allready Inserted
			    
				mysqli_select_db($con,"pears");
	            $dupe = mysqli_query($con,"SELECT * FROM torrent WHERE userID='$b_id' && torrent_hash='$tmh'") or die (mysqli_error());
                $num_rows = mysqli_num_rows($dupe);
                    
			if ($num_rows > 0)
				
				{
                  echo "<script>
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
                        function generateAll() {generate('warning', 'You Allready Inserted this Toreent');}
						$(document).ready(function () {
                              setTimeout(function () {
                              generateAll();
                                    }, 500);});
                        </script>";
			$session = $transmission->getSession();
            $session->setDownloadDir('/var/www/html/download'.'/'.$tmh);
		    $session->save();

			//$transmission->add($string);
			$torrent = $transmission->add($string);
			$transmission->start($torrent, true);
			
        }
			else{
			     // Insert hash into database
			    mysqli_select_db($con,"pears");
	            mysqli_query($con,"INSERT INTO torrent (userID,torrent_hash) VALUES ('$b_id','$tmh')");
              
			  $session = $transmission->getSession();
              $session->setDownloadDir('/var/www/html/download'.'/'.$tmh);
			  $session->save();
              $torrent = $transmission->add($string);
			 $transmission->start($torrent, true);
			 
			 echo "<script>
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
                        function generateAll() {generate('success', '{$string345} Added');}
						$(document).ready(function () {
                              setTimeout(function () {
                              generateAll();
                                    }, 500);});
                        </script>";
			    
			  
		    }
	}else{
		    echo "<script>
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
                        function generateAll() {generate('error', 'Its Not Valid or Broken Torrent');}
						$(document).ready(function () {
                              setTimeout(function () {
                              generateAll();
                                    }, 500);});
                        </script>";
		}
	}
   }
 ?>
	    <form class="new_user_session" action="" accept-charset="UTF-8" id="main-form" method="post" enctype="multipart/form-data">
		 <div class="form-item grid-70">
            <input autofocus="autofocus" class="form-text-input input-text input-text" id="text-link-input" type="text" name="txthash" placeholder="Torrent Magnet Only"/>
		 </div>
		 
		 <button type="submit" id="submit" name="btn-upload" class="button primary full-on-mobile placeholder-processed sp">Upload</button>

        </form>
       </div>
 
		 <script>
		   
		   $('#submit').on('click', function() {
			  var animationName = 'animated shake';
			  var animationend = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
			  valid = true;
			
			 if ($('#text-link-input').val() == ''){
				valid = false;
				$('#shake').addClass(animationName).one(animationend,function(){
				$(this).removeClass(animationName);
				});
			 }
			});
		</script>
	   </div>
	  </div>
	 </div>
	
	
 <!--<div id="welcome-panel" class="box">
  <button id="welcome-panel-close" class="button  x-small square secondary">
    <img src="img/bcancel.png" style="width: 35%;"></img></button>
     <div class="grid-container">
	   
	  <div class="grid-40">
       <h2>Reliance Jio</h2>
        <p>
        Reliance Jio Infocomm Limited, doing business as Jio, is a LTE mobile network operator in India. 
		It is a wholly owned subsidiary of Reliance Industries headquartered in Navi Mumbai
        </p>
      <a class="button button-secondary" href="/home">View Techdegree</a>
      </div>
	
    <div class="grid-60 text-centered right-768">
      <img class="welcome-panel-img" src="https://static.teamtreehouse.com/assets/views/tracks/tracks-fa17565eed90a8d19873e4c812943a29.png">
    </div>
    
  </div>
 </div>-->
  
			<script>
				  $(document).ready(function(){
					$("#welcome-panel-close").click(function(){
						$("#welcome-panel").hide();
					});
					
				});
			</script>
  
  
<div class="grid-container">
 <div class="grid-100" data-bind="foreach: Data">
  <div class="topic-java">
   <div class="box unqueued">
    <div id="track-progress" data-bind="css: $parent.className($index())">
	  <ul class="stages" style="color:white">Seed :</ul>
	  <ul class="stages" data-bind="text: Seed" style="color:white"></ul>
	  
	  <span style="margin: 0px 50px 0px 0px;" class="estimate add-topic-background-color" data-bind="text: eta">51 min left</span>
      
	  <a value="sagar.php" id="close" data-bind="attr:{href : hash}" type="submit" style="float:right;"><img src="img/close-browser.png" style="margin-top: 21px;width: 72%;"></img></a>
    </div>
	
	 
    <div id="track-meta">
     <h2 data-bind="text: Name">BOLLYGRAM 6th EDITION (UNPLUGGED)</h2>
	 <p data-bind="text: sp">Add On </p>
   <div class="capacity-container progress-container" style="margin-bottom:10px;">
    <div data-bind="value:width ,style : {width : width()+'%'},css: $parent.pcolor($index())"></div>
   </div>
  </div>
  
  <div class="box-content" style="padding-bottom: 28px;">
   <ul class="card-tags tags" style="bottom: 25px;left: 25px;margin: 0px -30px 0px 0px;">
    <li class="pro-content"><a><span data-bind="text: Speed">Speed</span></a></li>
	<li class="topics"><span data-bind="text: Size">Size</span></li>
   </ul>
   <a value="sagar.php" data-bind="attr: { href: URLPath },visible: width() == 100,css: $parent.buttoncolor($index())" type="submit"  style="float:right;border-color:#fff">Files</a>
   </div>
 
   </div>
  </div>
 </div>
 
 
 <div class="grid-100">
      <div class="mixed-box content-suggestions topic-digital-literacy">
        
        
        <div class="box-footer box-actions" style="border-radius: 4px 4px 4px 4px;">
		    <a data-bind="click: Next, visible: hasNext" class="button primary next"> Next <img src="img/move-to-next.png" class="right-arrow-icon" style="margin:0px 0px -2px 0px"></img></a>
            
			<span class="suggestion-time-estimate xyz">Page: <strong data-bind="text: $root.CurrentPage"></strong> / <strong data-bind="text: $root.totalPages"></strong></span>
	
           <a data-bind="click: Prev,visible: hasPrevious" class="button primary prev" style="float:right"><img src="img/move-to-next.png" class="right-arrow-icon" style="transform: rotateY(-180deg);margin:0px 0px -2px 0px;"></img> Prev </a>
        </div>
      </div>
    </div>
 

</div>

<script>

$('a.popup').popup();

$('#close').popup();


</script>

<script>
 function ExampleViewModel() {
  var self = this;
  self.ExampleData = ko.observableArray([]);
  self.CurrentPage = ko.observable(1);
  self.DataPerPage = ko.observable(2);
  
  self.Data = ko.pureComputed(function(){
   var startIndex = self.CurrentPage() === 1? 0 : (self.CurrentPage() - 1) * self.DataPerPage();
   return self.ExampleData().slice(startIndex, startIndex + self.DataPerPage ())
  });
  
  self.hasPrevious = ko.pureComputed(function() {
		return self.CurrentPage() !== 1;
	});
	self.hasNext = ko.pureComputed(function() {
		return self.CurrentPage() !== self.totalPages();
	});

  self.Next = function() {
    var currentPage = self.CurrentPage();
    if(currentPage < (Math.ceil(self.ExampleData().length / 2))) self.CurrentPage(currentPage + 1);
  };
  self.Prev = function() {
    var currentPage = self.CurrentPage();
    if(currentPage > 1) self.CurrentPage(currentPage - 1);
  };
 
 this.totalPages = ko.computed(function() {
		var div = Math.ceil(self.ExampleData().length / 2);
		
		return div;
	});

self.className = function(index) {
   // return index % 2 == 0 ? '' : ' ';
	
	
	switch (index) {
    case 0:
        return "has-topic-background-color add-java-background-color";
        break;
    case 1:
        return "has-topic-background-color add-php-background-color";
        break;
    case 2:
        return "has-topic-background-color add-ruby-background-color";
        break;
    case 3:
        return "has-topic-background-color add-html-background-color";
        break;
        }
	
	
  };
  
self.buttoncolor = function(index){
	return index % 2 === 0? 'button primary placeholder-processed popup isdo' : 'button primary popup isdo add-php-background-color';
};

self.pcolor = function(index){
	return index % 2 === 0? 'capacity-status progress-status' : 'capacity-status progress-status-pur';
};
  
self.update = function() {
    $.ajax("info.php?hash=<?php echo $b_id; ?>", {
      data: {
        json: ko.toJSON('info.php?hash=<?php echo $b_id; ?>')
      },
      
      success: function(allData) {
        var mappeddata = $.map(allData, function(item) {
          return new DataItem(item)
		 });
        self.ExampleData(mappeddata);
      }
    });
  }
}



function DataItem(data) {
  this.Name = ko.observable(data.name);
  this.Size = ko.observable(data.size);
  this.Seed = ko.observable(data.peer);
  this.URLPath = ko.observable(data.path);
  this.hash = ko.observable(data.delete);
  this.Speed = ko.observable(data.speed); 
  this.width = ko.observable(data.progress); 
  this.eta = ko.observable(data.eta);
  this.sp = ko.observable(data.date);
 // this.count = ko.observable(data.id);
  
}
  
var exampleViewModel = new ExampleViewModel();
window.setInterval(exampleViewModel.update, 2000);
ko.applyBindings(exampleViewModel);
</script>



</div>

<?php
include_once 'inc/footer.php';
?>
