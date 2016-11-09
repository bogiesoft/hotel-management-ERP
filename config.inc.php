<?php
###  THIS FILE CONTAINS ALL POSSIBLE CONFIGURE SETTINGS OF THE SITE
### IN CASE OF SITE UPLOADING PLEASE MAKE THE CHANGES INTO THIS CONFIGURE FILE
### AND ONE CONNECTION FILE(db.inc.php) AVAILABLE INTO INCLUDES FOLDER. JUST CHANGE THE CONNECTION SETTINGS ONLY.
##

######## NUMBER OF RECORDS PER PAGE 
define("PAGING", 10);

####### SITE URL  
//define("SITEURL", "http://210.7.75.188/heldharmless/");

########### YOUR MERCHANT ACCOUNT NUMBER
//define("X_LOGIN","3380");

######## TABLE DEFINITIONS 
define("ADMIN", "admin"); 
define("COUNTRY", "master_country");
define("IDENTITY", "master_identity"); 
define("RESERV", "reservation"); 
define("ROOMTYPE", "master_room_type"); 
define("PAYMODE", "master_payment_mode"); 
define("ROOMS", "master_rooms");
define("RFACILITY", "master_room_facilities");
define("STOCKIN", "stockin"); 

$gender=array(
               ''   => 'Select Gender',
			   'm'  => 'Male',
			   'f'  => 'Female'
			   );
			   
$AchivementArea=array(
               ''   => 'Select Achivement Field',
			   'bb'  => 'Basket Ball',
			   'nb'  => 'Net Ball' ,
			   'vb'  => 'Volley Ball',
			   'tt'  => 'Table Tennis' ,
			   'bm'  => 'Bad Minton',
			   'tw'  => 'Taekwando'
			   );			   
			   
$stateArr = array(
				 ''   => '--Select Nation--' ,
				'AL'  => 'Indian' ,
				'AK'  => 'Jaypaness' ,
				'AS'  => 'AMERICAN ' ,
				'AZ'  => 'UK' ,
				'AR'  => 'ARKANSAS' ,
				'CA'  => 'CALIFORNIA' ,
				'CO'  => 'COLORADO' ,
				'CT'  => 'CONNECTICUT' ,
				'DE'  => 'DELAWARE' ,
				'DC'  => 'DISTRICT OF COLUMBIA' ,
				'FM'  => 'FEDERATED STATES OF MICRONESIA' ,
				'FL'  => 'FLORIDA' ,
				'GA'  => 'GEORGIA' ,
				'GU'  => 'GUAM' ,
				'HI'  => 'HAWAII' ,
				'ID'  => 'IDAHO' ,
				'IL'  => 'ILLINOIS' ,
				'IN'  => 'INDIANA' ,
				'IA'  => 'IOWA' ,
				'KS'  => 'KANSAS' ,
				'KY'  => 'KENTUCKY' ,
				'LA'  => 'LOUISIANA' ,
				'ME'  => 'MAINE' ,
				'MH'  => 'MARSHALL ISLANDS' ,
				'MD'  => 'MARYLAND' ,
				'MA'  => 'MASSACHUSETTS' ,
				'MI'  => 'MICHIGAN' ,
				'MN'  => 'MINNESOTA' ,
				'MS'  => 'MISSISSIPPI' ,
				'MO'  => 'MISSOURI' ,
				'MT'  => 'MONTANA' ,
				'NE'  => 'NEBRASKA' ,
				'NV'  => 'NEVADA' ,
				'NH'  => 'NEW HAMPSHIRE' ,
				'NJ'  => 'NEW JERSEY' ,
				'NM'  => 'NEW MEXICO' ,
				'NY'  => 'NEW YORK' ,
				'NC'  => 'NORTH CAROLINA' ,
				'ND'  => 'NORTH DAKOTA' ,
				'MP'  => 'NORTHERN MARIANA ISLANDS' ,
				'OH'  => 'OHIO' ,
				'OK'  => 'OKLAHOMA' ,
				'OR'  => 'OREGON' ,
				'PW'  => 'PALAU' ,
				'PA'  => 'PENNSYLVANIA' ,
				'PR'  => 'PUERTO RICO' 
				);

###### USED TO AVOID THE ERROR
error_reporting(1);
?>