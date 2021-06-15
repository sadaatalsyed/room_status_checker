
<?php
// define("DBHOST","localhost");
// define("DBUSER","root");
// define("DBPASS","");
// define("DBName","links");
// $con=mysqli_connect(DBHOST,DBUSER,DBPASS,DBName);
$dbhost='localhost';
$dbuser='root';
$dbpass='';
$dbname='links';
$con=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
if($con){
    echo "Connection Successful";
}
else{
    echo "error";
}

$dbhost1='sql310.epizy.com';
$dbuser1='epiz_28691799';
$dbpass1='';
$dbname1='epiz_28691799_wp';
$con1=mysqli_connect($dbhost1,$dbuser1,$dbpass1,$dbname1);



if($con1){
    echo "Connection  one is Successful";
}
else{
    echo "error".mysqli_connect_error();
}
?>

<?php
    if(isset($_POST) && !empty($_POST['submit'])){
        $rs = $_POST['submit']; 
      $rmid=substr($rs,0,3);
      $stid=substr($rs,-1);
        
        $qry="insert into dn(days,night) values($rmid,$stid)";
        $res=mysqli_query($con,$qry);
        echo $rmid . " and this " . $stid;

        exit();
    }
?>
<!DOCTYPE HTML PUBLIC  "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
  <title>Housekeeping Room Status</title>
 
 

</head>

<body>
<!-- Content goes here! -->


<font size = +2>.: Housekeeping Room Status :.</font>
<!-- <form action="indeed.php" method="post"> -->


<!--  <input type="submit" name="submit" value="Submit">  -->
  	  <hr>
	  <table border="1">
      <tr><!-- Row 1 -->
           <th>Room Number</th><!-- Col 1 -->
           <th>Inspected</th><!-- Col 2 -->
           <th>Occupied Clean</th><!-- Col 3 -->
           <th>Occupied Dirty</th><!-- Col 4 -->
           <th>Vacant Dirty</th><!-- Col 6 -->
           <th>Vacant Clean</th><!-- Col 5 --> 
           <th>Out Of Order</th><!-- Col 7 -->
       </tr>
	 
    
      <tr>	  
	 <?php
     $room_start=100;
     $room_end=113;
     $status_start=0;
     $status_end=6;
     $status_array=['Inspected','Occupied Clean','Occupied Dirty','Vacant Dirty','Vacant Clean','Out of order'];
     for($room_no=100;$room_no<$room_end;$room_no++){?>
     <td><?php echo $room_no;?></td>
       <?php
       for($status=$status_start;$status<$status_end;$status++){
       ?>  
         <td>

<button name="submit"  data-bind="<?php echo $status_array[$status];?>" 
id="<?php echo $room_no."_".$status;?>" onclick="colorchange(this)"><?php echo $status_array[$status];?></button> </td>
     <?php
       }
       ?>
          </tr>
     <?php    
     }
     ?>
    

</table>

<div id="div" class="count">

</div>



</body>
<script src="jquery.js"></script>

<script language="javascript" type="text/javascript">

function colorchange(pressed){
   
    var id=pressed.id;
     console.log(id);

    var rid = id.slice(0, 3);
    var sid = id.slice(-1);
    // var color={'c0'=>'red','c1'=>'green','c2'=>'blue','c3'=>'yellow'};
     console.log(rid);
     console.log(sid);
//    pressed.style.background='#fe23450';

//changing color of the button
	document.getElementById(id).style.background='red';

    var p= document.createElement('p');
   
    var result=document.createTextNode(
    	'Pressed Button is: '+id+' Room is: '+rid+' status is: '+sid);
   p.setAttribute('id',id);
   p.appendChild(result);
   console.log(p);
   document.getElementById('div').appendChild(p);


   var base_url = $("#base").val();
            $.ajax({
                type: 'post',
                url: base_url,
                data: {'submit':id}, //$("#frmsbmt").serialize(), //form serialize will send all the data to the server side in json formate, so there is no need to send data seperately.
                success: function( data ) {
                    console.log(data);
                    //alert(data);
                    // It will write the response in developer tools console tab or you can alert it.
                }
            });


}
</script>
<script>
            
      
    
</script>
</html>
<?php ?>