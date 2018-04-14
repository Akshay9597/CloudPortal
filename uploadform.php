<?php
session_start();
	if(!isset($_SESSION['user'])){
		   header("Location:/cloudfiles/index.html");
	}
	$user = $_SESSION["user"];
$bool = 1;
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
	<meta content="utf-8" http-equiv="encoding">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>List Files</title>

    <!-- Bootstrap Core CSS -->
    <link href="../WebApp/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS: You can use this stylesheet to override any Bootstrap styles and/or apply your own styles -->
    <link href="../WebApp/css/custom.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="center.css" rel="stylesheet">
</head>




<body>
<?php
	session_start();
	if(!isset($_SESSION['user'])){
		   header("Location:/cloudfiles/index.html");
	}
	$user = $_SESSION["user"];
	echo 'Welcome '.$user;
	
?>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Logo and responsive toggle -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../home.php">
                	<span class="glyphicon glyphicon-fire"></span>
                Cloud Portal
                </a>
            </div>
            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="./showfiles.php">My Files</a>
                    </li>

                    <li>
                        <a href="./logout.php">Sign Out</a>
                    </li>
 					<li>
                        <a href="./removeaccount.php">Delete my account</a>
                    </li>

               </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

<div class="jumbotron feature">
		<div class="container">
			<h1>Upload Files...</h1>
		</div>
</div>

<div class="panel panel-default" align=center>
<form action="upload.php" method="post" enctype="multipart/form-data">
	Title:<input type="text" name="title">
	<br><br>
    <input type="file" name="fileToUpload" id="fileToUpload" style="display:inline;width:500px;height:70px;background-color:blue;color:white">
    <input type="submit" value="UPLOAD" name="submit" class="btn btn-default" style="width:500px;height:70px;background-color:blue;color:white">
</form>
</div>
<!--
  <table class="data-table" id="data">
        <thead>
          <tr>
            <th style="padding:0 25px 0 25px;">File name</th>
            <th style="padding:0 25px 0 25px;">File size</th>
	    <th style="padding:0 25px 0 25px;">Download</th>
	    <th style="padding:0 25px 0 25px;">Delete</th>
          </tr>
        </thead>
        <div class="contain">
        <tbody>
          <?php
	include_once '../passdb.php';
	$dbname = "cloudportalDB";
	
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
  if($bool == 1)
  {
        $sql = "SELECT * FROM ".$user;
        $display_query = mysqli_query($conn, $sql);
        if (!$display_query) {
               die ('SQL Error: ' . mysqli_error($conn));
        }
        if(mysqli_num_rows($display_query) == 0){
          echo "NO MATCHING DATA";
        }
  while ($row = mysqli_fetch_array($display_query))
            {
	$downloadfile = $row['filename'];
		?>
        <tr>
        <td style="padding:0 25px 0 25px;"><?php echo $row['filename'] ?></td>
        <td style="padding:0 25px 0 25px;"><?php echo $row['filesize'] ?></td>
	<td style="padding:0 25px 0 25px;"><a href="./uploads/<?php echo $row['filename']; ?>" download>Download</a></td>
	<td style="padding:0 25px 0 25px;"><a href="delete.php?del=<?php echo $downloadfile; ?>">Delete</a></td>
        </tr>
<?php
            }
          }?>
        </tbody>
      </div>
       </table>
-->
   <!-- jQuery -->
    <script src="../WebApp/js/jquery-1.11.3.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../WebApp/js/bootstrap.min.js"></script>

	<!-- IE10 viewport bug workaround -->
	<script src="../WebApp/js/ie10-viewport-bug-workaround.js"></script>

	<!-- Placeholder Images -->
	<script src="../WebApp/js/holder.min.js"></script>

</body>

</html>
