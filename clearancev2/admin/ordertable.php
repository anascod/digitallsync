<?php

?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Table 05</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


	</head>
	<body>
	<section>
  <!--for demo wrap-->
  <h1>D/O Table </h1>
  <div class="tbl-header">
    <table cellpadding="0" cellspacing="0" border="0">
      <thead>
        <tr>
          
<th >S</th>
<th >DRAFT</th>
<th >JOB </th>
<th >TRANSPORTER</th>
<th >FROM</th>
<th >TO</th>
<th >CONTRACT</th>
<th >TRUCK TYPE</th>
<th >TRUCK NO</th>
<th >DRIVER NAME</th>
<th >DRIVER MOBILE</th>
<th >Date</th>
<th >Status</th>
<th >Action</th>
        </tr>
      </thead>
    </table>
  </div>
  <div class="tbl-content">
    <table cellpadding="0" cellspacing="0" border="0">
      <tbody>
      <?php
require("config/sys.php");
SetSession();

TableView();
foreach   ($newresult as $row) {
?>
        <tr>
        <td><?php   echo $row['id'];	  ?></td>
                                                <td><?php  echo $row['DRAFT_NO']; ?></td>
                                                <td><?php  echo $row['JOB_NO']; ?></td>
                                                <td><?php  echo $row['TRANSPORTER']; ?></td>
                                                <td><?php  echo $row['FROMP']; ?></td>
                                                <td><?php  echo $row['TOPL']; ?></td>
                                                <td><?php  echo $row['CONTRACT_NO']; ?></td>
                                                <td><?php  echo $row['TYPE_OF_TRUCK']; ?></td>
                                                <td><?php  echo $row['TRUCK_NO']; ?></td>
                                                <td><?php  echo $row['DRIVER_NAME']; ?></td>
                                                <td><?php  echo $row['DRIVER_MOBILE']; ?></td>
                                                <td><?php  echo $row['Date']; ?></td>
                                                <td><?php  echo $row['auth']; ?></td>
                                                <?php  $url=urldecode('edform.php?id='.''.$row['id']); ?>
                                                <td><?php if ($row['auth']=='Deleverd'){ echo "<a class='btnnnn' style='background: #f8035f; color: white' href='#'> </a>";}
                                                else{ echo "<a class='btnnnn' style='background: #f8035f; color: white' href='$url'>Edit </a>";}
                                                
                                               
                                                ?> </td>
        </tr>
        <?php   }?>

      </tbody>
    </table>
  </div>
</section>




				   <style>

h1{
  font-size: 30px;
  color: #fff;
  text-transform: uppercase;
  font-weight: 300;
  text-align: center;
  margin-bottom: 15px;
}
table{
  width:100%;
  table-layout: fixed;
}
.tbl-header{
  background-color: rgba(255,255,255,0.3);
 }
.tbl-content{
  height:700px;
  overflow-x:auto;
  margin-top: 0px;
  border: 1px solid rgba(255,255,255,0.3);
}
th{
  padding: 20px 15px;
  text-align: left;
  font-weight: 500;
  font-size: 12px;
  color: #fff;
  text-transform: uppercase;
}
td{
  padding: 15px;
  text-align: left;
  vertical-align:middle;
  font-weight: 300;
  font-size: 18px;
  color: #fff;
  border-bottom: solid 1px rgba(255,255,255,0.1);
}


/* demo styles */

@import url(https://fonts.googleapis.com/css?family=Roboto:400,500,300,700);
body{
  background: #fff;
  background: #fff;
  font-family: 'Roboto', sans-serif;
}
section{
  margin: 50px;
}


/* follow me template */
.made-with-love {
  margin-top: 40px;
  padding: 10px;
  clear: left;
  text-align: center;
  font-size: 10px;
  font-family: arial;
  color: #000000;
}
.made-with-love i {
  font-style: normal;
  color: #000000;
  font-size: 14px;
  position: relative;
  top: 2px;
}
.made-with-love a {
  color: #000000;
  text-decoration: none;
}
.made-with-love a:hover {
  text-decoration: underline;
}


/* for custom scrollbar for webkit browser*/

::-webkit-scrollbar {
    width: 6px;
} 
::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
} 
::-webkit-scrollbar-thumb {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
}

td{
  color: black;
}

h1{
  color: black;
}
.btnnnn {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}
				   </style>
	<script>
        // '.tbl-content' consumed little space for vertical scrollbar, scrollbar width depend on browser/os/platfrom. Here calculate the scollbar width .
$(window).on("load resize ", function() {
  var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
  $('.tbl-header').css({'padding-right':scrollWidth});
}).resize();
    </script>

	</body>
</html>

