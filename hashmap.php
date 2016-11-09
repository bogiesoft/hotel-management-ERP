<?php
   $table_name = array('master_room_facilities','master_room_classes','master_room_type','master_rooms','food','master_food_categories','users','user_levels','user_rights','stockin','master_taxes','master_addons','date_prototypes','master_monetary_units','rate_prototypes');
   $b = $_POST['b'];
  
      if($b=='rfacilities'){$b = 0;}
      else if($b=='rclasses'){$b = 1;}
      else if($b=='rtypes'){$b = 2;}
      else if($b=='rooms'){$b = 3;}
      else if($b=='kitems'){$b = 4;}
      else if($b=='kcategories'){$b = 5;}
      else if($b=='users'){$b = 6;}
      else if($b=='userlevels'){$b = 7;}
      else if($b=='userrights'){$b = 8;}
      else if($b=='stockin'){$b = 9;}
      else if($b=='mtaxes'){$b = 10;}
      else if($b=='maddons'){$b = 11;}
      else if($b=='mprototypes'){$b = 12;}
      else if($b=='munits') {$b = 13;}
      else if($b=='mrates') {$b = 14;}
?>