<?php
include_once 'inc/header.php';
?>
<div id = "name">  </div><br />
<div id="path"></div>
<div id="size"></div>

<a href="C:/xampp/htdocs/final/download/bffe600ae08ba8e55db30dae6acd86979e30ce15" > download </a> 

<script>

// function bytesToSize(bytes) {
    // var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    // if (bytes == 0) return 'n/a';
    // var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
    // if (i == 0) return bytes + ' ' + sizes[i]; 
    // return (bytes / Math.pow(1024, i)).toFixed(1) + ' ' + sizes[i];
// };


 // $.ajax({
   // method: "POST",
   // url: "fs.php",
   // type:'post',
   // success: function(data) {
       // ko.applyBindings({ 
          // rows : data
       // });
   // }
// });



</script>



<script>

function bytesToSize(bytes) {
           var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
           if (bytes == 0) return '0 Byte';
            var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
            return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
          }
        
 $('a').click(function () {
	 var data_bind = $(this).attr('href');
   $.post('fs.php', 'val=' + data_bind, function (data) {
      
   });
});
        
 </script>
