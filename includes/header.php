<?php session_start();
            include_once("includes/db.inc.php");
            $a =  $_SESSION['user']['uname'];
            $b = mysql_query("SELECT privilege FROM users WHERE username = '$a'")or die(mysql_error());
            $c = mysql_fetch_object($b);
            $privilege = $c->privilege;
            $f = mysql_query("SELECT * FROM user_levels WHERE privilege ='$privilege'")or die(mysql_error());
            $g = mysql_fetch_object($f);
            $g = json_decode($g->rights);
  ?>
<div  style="background-image: url(../images/bg/pick_bg.jpg);" id="header">
    <ul id="nav">
        <li class="current" style='z-index:400;'><a href="membership.php?module=dashboard">Front Desk</a></li>
    
        
       <!-- <li><a href="#">Reservation</a>
            <ul style='z-index:400;'>
                <li><a href="membership.php?module=new_reservation">New</a></li>
                <li><a href="membership.php?module=groupreservation">Group Reservation</a></li>
            </ul>
        </li>
    -->

        <li><a href="#/resources/" id="operations" style='z-index:400;'>Room Operations</a>
            <ul style='z-index:400;'>
                <li><a href="#/resources/">Check-In List</a></li>
                <li><a href="#/resources/">Check-Out List</a></li>
                <li><a href="membership.php?module=reservation_list" >Reservation List</a></li>
                <li><a href="membership.php?module=house_keeping">House Keeping</a></li>
                <li><a href="#/resources/">Cancelled Reservation</a></li>
            </ul>
        </li>
       
       <li><a href="#/resources/" id="operations" style='z-index:400;'>Kitchen</a>
            <ul style='z-index:400;'>
                <li><a href="membership.php?module=kot">KOT</a></li>
            </ul>
        </li>

        <li><a href="#">Accounting</a>
            <ul style='z-index:400;'>
                <li><a href="membership.php?module=bills">Billing</a></li>
            </ul>
        </li>
        <li><a href="#">Reports</a>
            <ul style='z-index:400;'>
                <li><a href="membership.php?module=roomreports">Room Reports</a></li>
            </ul>
        </li>
        <?php
         if($g->AdminPanel==1){
           ?>
        <li  ><a href="#">AdminPanel</a>
            <ul style='z-index:400;'>
                <li><a href="membership.php?module=admin">Admin</a></li>
            </ul>
        </li>
        <li><a href="#">Inventory Management</a>
         <ul  style='z-index:400;'>
            <li><a href="membership.php?module=stockin">Stock In</a></li>
            <li><a href="membership.php?module=stockout">Stock Out</a></li>
            <li><a href="membership.php?module=stockdisplay">Stock Display</a></li>
          </ul>
        </li>
        <li style='margin-left:20%;' ><a href='logout.php' >Logout</a></li>
        <?php }
        ?>
    </ul>
     
</div>
