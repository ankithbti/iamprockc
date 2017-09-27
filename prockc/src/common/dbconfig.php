<?php
	/*  Server Database */
	DEFINE('DBUSER','root');
	DEFINE('DBPW','saring');
	DEFINE('DBHOST','localhost:/tmp/mysql.sock');
	DEFINE('DBNAME','prokc');
	DEFINE('PAGE_TITLE_PREFIX', 'PROCKC');


	// Local Database 
	// DEFINE('DBUSER','root');
	// DEFINE('DBPW','saring');
	// DEFINE('DBHOST','localhost');
	// DEFINE('DBNAME','arrivu');
	// DEFINE('ARRIVU_CONTACT_MAILING_LIST','ankithbti007@gmail.com');
	

	function getBaseUrl() 
	{
	    // output: /myproject/index.php
	    $currentPath = $_SERVER['PHP_SELF']; 
	    
	    // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index ) 
	    $pathInfo = pathinfo($currentPath); 
	    
	    // output: localhost
	    $hostName = $_SERVER['HTTP_HOST']; 
	    
	    // output: http://
	    $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
	    
	    // return: http://localhost/myproject/
	    return $protocol.$hostName.$pathInfo['dirname']."/";
	}
	
	
	if($dbc = mysql_connect(DBHOST, DBUSER, DBPW)){
		if(!mysql_select_db(DBNAME)){
			trigger_error("Could not select the database" . mysql_errno());
			exit();
		}
	}else{
		trigger_error("Could not connect to MYSQL");
		exit();
	}
	function escape_data($data){
		if(function_exists('mysql_real_escape_string')){
			global $dbc;
			$data = mysql_real_escape_string(trim($data),$dbc);
			$data = strip_tags($data);
		}else{
			$data = mysql_escape_string(trim($data));
			$data = strip_tags($data);			
		}
		return $data ;
	}
?>