
<?php

	ob_start();
    session_start();
    require_once('common/dbconfig.php');

    error_reporting(E_ALL | E_WARNING | E_NOTICE);
    ini_set('display_errors', TRUE);
    //flush();
    ini_set('allow_url_fopen', "1");
    date_default_timezone_set('UTC');
    $curr_date = date(DATE_RFC822);
    $datetime = date('Y-m-d H:i:s') ;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>YouC</title>
<link rel="stylesheet" type="text/css" href="../resources/bootstrap-3.3.5/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="../resources/bootstrap-3.3.5/css/bootstrap-theme.min.css" />
<link rel="stylesheet" type="text/css" href="../resources/css/common.css" />
<link rel="stylesheet" type="text/css" href="../resources/css/youc.css" />


<script src="../resources/js/jquery-3.1.0.min.js"></script>
<script src="../resources/bootstrap-3.3.5/js/bootstrap.min.js"></script>
<script src="../resources/js/common.js"></script>
</head>

<body>

<?php


$user="";
$pass="";
if(isset($_POST["userName"])){
	//echo "<h1>TEST SUBMIT </h1>" . $_POST["userName"];
	$user = $_POST["userName"];
	$pass = $_POST["password"];
	
	$query = "select * from users where username='" . $user . "'";
	$result = mysql_query ($query) or trigger_error("Query fails. Contact us to report the issue.");
    if (mysql_affected_rows() > 0){
        while($row = mysql_fetch_array($result, MYSQL_NUM)){
            if($row[6] == $pass){
            	
            }else{
            	die("Pass failed");
            }
        }

        //mysql_close(); // Close the database connection.
    }
    else{
        die(" Invalid UserName" );
    }

}else{
	die("Can not open if you not logged in");
}

?>

<div class="youcHeader">
	
	<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    
	    <div class="navbar-header">
	      <a class="navbar-brand" href="#">YouC</a>
	    </div>

	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      		<ul class="nav navbar-nav">
        		<li><a>CurrenC: $10</a></li>
        		<li><a href="#">Earnings: $0</a></li>
        		<li><a href="#">InstructorLevel</a></li>
        		<li><a href="#">StudentLevel</a></li>
        		<li><a href="#">CalC</a></li>
        	</ul>

        	<ul class="nav navbar-nav navbar-right">
        		<li class="dropdown userIcon">
        			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
        			<img src="http://placehold.it/25" class="img-circle"/> <?php echo $user ; ?> <span class="caret"></span></a>
        			<ul class="dropdown-menu">
        				<li><a href="#">Logout</a></li>
        			</ul>
        		</li>
        		<li><a>Home</a></li>
        	</ul>
        </div>

	  </div>
	</nav>
</div>

<div class="container">
	<div class="row">
	  <div class="col-lg-6">
	    <div class="input-group">
	      <input type="text" class="form-control" placeholder="Search for...">
	      <span class="input-group-btn">
	        <button class="btn btn-default" type="button">Go!</button>
	      </span>
	    </div><!-- /input-group -->
	  </div><!-- /.col-lg-6 -->
	  <div class="col-lg-2">
	    <div class="input-group">
	    	<!-- <input class="btn btn-default" value="Filters"/> -->
	      	<button type="button" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-lg">
	      		Filters
	      	</button>
			<!-- <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			  <div class="modal-dialog modal-lg" role="document">
			    <div class="modal-content">
			      ...
			    </div>
			  </div>
			</div> -->

			<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title">Filters</h4>
			      </div>
			      <div class="modal-body">
			        <p>Some Filter Settings will come here&hellip;</p>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Reset</button>
			        <button type="button" class="btn btn-primary">Save</button>
			      </div>
			    </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
			</div><!-- /.modal -->





	    </div><!-- /input-group -->
	  </div><!-- /.col-lg-2 -->
	</div><!-- /.row -->
</div>

<hr>

<div class="container">
	<div class="row">
	  <div class="col-lg-8">
  		<ul class="nav nav-pills">
  			<li role="presentation" class="active"><a href="#">My List</a></li>
			<li role="presentation"><a href="#">Trending</a></li>
			<li role="presentation"><a href="#">Promotional</a></li>
			<li role="presentation"><a href="#">Saved</a></li>
			<li role="presentation"><a href="#">Latest</a></li>
		</ul>
		<hr>

		<div class="media">
		  	<div class="media-left media-middle">
			    <a href="#" data-toggle="modal" data-target=".videoModal">
			      	<img class="media-object" src="http://placehold.it/250" alt="YouC"/>
			    </a>
			    <p></p>
			    <button type="button" class="btn btn-default btn-xs">
			      	<span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>
			      	  Downalod
			    </button>
				<button type="button" class="btn btn-default btn-xs">
					<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
					 Watch Later
				</button>
			</div>
			<div class="media-body">
				<h4 class="media-heading">Cracking the IAS - Secret Revealed</h4>
				<h5>Prashant Mohan Johari</h5>
				<h6>Platinum Instructor</h6>
				<h6>Subscribers: 60</h6>
				<h6>Your Connections: 30</h6>
				<h6>View: 1000000</h6>
				<h6>Comments: 1000</h6>
				<h6>Cost of View: $5</h6>
			</div>

			<div class="modal fade videoModal" tabindex="-1" role="dialog">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title">Cracking the IAS - Secret Revealed</h4>
			      </div>
			      <div class="modal-body">
			        <video controls preload="auto" src="playVideo.php" width="100%" height="200px"></video>
			      </div>
			    </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
			</div><!-- /.modal -->

		</div>
		<hr>


	  </div><!-- /.col-lg-6 -->

	  <div class="col-lg-4">

	  	<div class="panel panel-info">
		  <div class="panel-heading">
		    <h3 class="panel-title">ProkC Activites</h3>
		  </div>
		  <div class="panel-body">
		    <div class="list-group">
			  <a href="#" class="list-group-item">
			    <p class="list-group-item-text">Prashant uploaded new Video on SoC</p>
			  </a>
			  <a href="#" class="list-group-item">
			    <p class="list-group-item-text">Prashant will start session on WeC</p>
			  </a>
			</div>
		  </div>
		</div>

		<div class="panel panel-success">
		  <div class="panel-heading">
		    <h3 class="panel-title">Notifications</h3>
		  </div>
		  <div class="panel-body">
		    <ul class="nav bs-docs-sidenav">
	    		<li><a href="#"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Inbox <span class="badge">42</span></a></li>
	    		<li><a href="#"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Chat <span class="badge">2</span></a></li>
	    	</ul>

	    	<!-- <button class="btn btn-success" type="button">
			  New Chat Messages <span class="badge">4</span>
			</button> -->

		  </div>
		</div>


	    <div class="panel panel-info">
		  <div class="panel-heading">
		    <h3 class="panel-title">Imp Links</h3>
		  </div>
		  <div class="panel-body">
		    <ul class="nav bs-docs-sidenav">
	    		<li><a href="#">MyClass</a></li>
	    		<li><a href="#">MyPlan</a></li>
	    		<li><a href="#">MyTheme</a></li>
	    		<li><a href="#">MyChoice</a></li>
	    		<li><a href="#">MyTeacher</a></li>
	    		<li><a href="#">MyHistory</a></li>
	    	</ul>
		  </div>
		</div>

	  </div><!-- /.col-lg-2 -->
	</div>
</div>


</div>



<div class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <p>One fine body&hellip;</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

</body>

</html>