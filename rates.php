<?php

class DB{
	protected $user = '';
	protected $pass = '';
	protected $host = '';
	protected $db = '';
	protected $result = '';
	protected $columnarray = array();
	public function __construct($user,$pass,$host,$db){
		$this->user = $user;
		$this->pass = $pass;
		$this->host = $host;
		$this->db = $db;
		$this->connect($this->host,$this->user,$this->pass);
		$this->selectdb($this->db);
	}

	public function connect($a,$b,$c){
		if($a!==''&&$b!==''&&$c!=='') $result = mysql_connect($a,$b,$c)or die(mysql_error());
	}

	public function selectdb($d){
        if($d!=='') $database = mysql_select_db($d) or die(mysql_error());
	}

	public function querydb($query){
        $this->result = mysql_query($query) or die(mysql_error());
        return $this->result;
	}

	public function arrangeres($query,$columns){
        $resarray = $this->querydb($query);
        $obj = array();
        $obj['columns'] = $columns;
        while($s = mysql_fetch_object($resarray)){
        	var_dump($s);
           $temparr = array();
           foreach ($s as $key => $value) {
              $temparr[$key] = $value ;  	
           }
           $obj[count($obj)] = $temparr;   
        }
        return $obj;
	}

	public function getcolumns($r){	
		$i = 0;
         while($i< mysql_num_fields($r)){
               $meta =  mysql_fetch_field($r);
               $columnarray[$i] = $meta->name;
               $i++;
         }

         return $columnarray;
	}
    
    public function displayarr($arr){
    	
            foreach ($arr as $key => $value) {
            	if(is_array($arr[$key])){
	               foreach ($arr[$key] as $k => $val) {
	            		echo $arr[$key][$k]."<br>";
	            	}	
                }
               else{
               	echo $arr[$key]."<br>";
               }
            }
    }
    
}

$db_conn = new DB('root','toor','localhost:3306','hotel');

$table = 'food';
$query = "select * from ".$table;
$res = $db_conn->querydb($query);
$colarray = $db_conn->getcolumns($res);


$query = "select * from ".$table." where id=5"; 
$res = $db_conn->querydb($query);
$resarray = $db_conn->arrangeres($query,$colarray);

$db_conn->displayarr($resarray);
?>