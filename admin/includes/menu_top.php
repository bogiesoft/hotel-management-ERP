
<script type="text/javascript" src="../js/jquery.min.js"></script>

<!-- Other Main CSS -->

<link rel="stylesheet" type="text/css" href="css/menu.css" />
<link rel="stylesheet" type="text/css" href="css/menu-v.css" />

<!-- Other Main Js -->

<script type="text/javascript" src="../js/menu.js"></script>
<script type="text/javascript">
ddsmoothmenu.init({
	mainmenuid: "smoothmenu1", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

ddsmoothmenu.init({
	mainmenuid: "smoothmenu2", //Menu DIV id
	orientation: 'v', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu-v', //class added to menu's outer DIV
	method: 'toggle', // set to 'hover' (default) or 'toggle'
	arrowswap: true, // enable rollover effect on menu arrow images?
	//customtheme: ["#804000", "#482400"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})
</script>


<div id="smoothmenu1" class="ddsmoothmenu">
<ul>
<li><a href="index.php">Home</a></li>
<li><a href="master.php">Masters</a>
  <ul>
  <li><a href="#">Reservation</a>
      <ul>
      <li><a href="membership.php?module=country_add">Country</a></li>
      <li><a href="membership.php?module=master_identity">Identity</a></li>
      <li><a href="membership.php?module=master_pay_mode">Payment Mode</a></li>
      </ul>
  </li>
  <li><a href="master_hskeeping.php">Rooms</a>
      <ul>
      <li><a href="membership.php?module=master_room_add">Add Room</a></li>
     <li><a href="membership.php?module=master_room_listing">Room Listing</a></li>
     <li><a href="membership.php?module=master_room_type">Room Type</a></li>
      <li><a href="membership.php?module=master_room_facilities">Room Faclity</a></li>
      </ul>
  </li>
  
  <li><a href="master_hskeeping.php">House Keeping</a>
      <ul>
      <li><a href="master_laundary.php">Laundry</a></li>
      <li><a href="master_outlets.php">Outlets</a></li>
      <li><a href="master_linen.php">Linen</a></li>
      </ul>
  </li>
  <li><a href="master_kot.php">KOT</a>
      <ul>
      <li><a href="master_food_cat.php">Food/Item Category</a></li>
      <li><a href="master_food_item.php">Food/Item Detail</a></li>
      <!--<li><a href="master_fnb.php">F-'n'-B</a></li>-->
      </ul>
  </li>
  <li><a href="master_room.php">Rooms</a>
      <ul>
      <li><a href="master_rfacality.php">Room Facalities</a></li>
      <li><a href="master_rtype.php">Room Type</a></li>
      <li><a href="master_rManage.php">Room Managment</a></li>
      <li><a href="master_rrack.php">Room Rack</a></li>
      <li><a href="master_rPrice.php">Room Charge</a></li>
      </ul>
  </li>
  <li><a href="master_fntoffice.php">Front-Office</a>
      <ul>
      <li><a href="javascript:;">Check-In</a></li>
      <li><a href="javascript:;">Check-Out</a></li>
      </ul>
  </li>
  <li><a href="master_other.php">Other</a>
      <ul>
      <li><a href="javascript:;">Offer</a></li>
      <li><a href="javascript:;">Store</a></li>
      <li><a href="master_currency.php">Currancy</a></li>
      <li><a href="master_travel.php">Travel Agent</a></li>
      </ul>
  </li>
  </ul>
</li>
<li><a href="javascript:;">Booking</a>
  <ul>
  <li><a href="javascript:;">Add New Entry</a></li>
  <li><a href="javascript:;">Cancel Booking</a></li>
  <li><a href="javascript:;">View Booking Reports</a></li>
  </ul>
</li>
<li><a href="javascript:;">Check-in</a>
  <ul>
  <li><a href="javascript:;">Make New Entry</a></li>
  <li><a href="javascript:;">View Report</a></li>
  </ul>
</li>
<li><a href="javascript:;">Check-out</a>
  <ul>
  <li><a href="javascript:;">Make New Entry</a></li>
  <li><a href="javascript:;">View Report</a></li>
  </ul>
</li>
<li><a href="javascript:;">Billing</a>
  <ul>
  <li><a href="javascript:;">Make New Entry</a></li>
  <li><a href="javascript:;">View Report</a></li>
  </ul>
</li>
<li><a href="javascript:;">Reports</a>
  <ul>
  <li><a href="javascript:;">Reseption</a></li>
  <li><a href="javascript:;">Accounts</a></li>
  <li><a href="javascript:;">KOT</a></li>
  <li><a href="javascript:;">Laundry</a></li>
  <li><a href="javascript:;">Billing</a></li>
  <li><a href="javascript:;">Check-in</a></li>
  <li><a href="javascript:;">Check-out</a></li>
  </ul>
</li>
<li  style="float:right"><a href="javascript:;">Admin Settings</a>
  <ul>
  <li><a href="admin_setting.php?module=login">Login Settings</a></li>
  <li><a href="logout.php">Log out</a></li>

  </ul>
</li>

</ul>

<br style="clear: left" />
</div>

