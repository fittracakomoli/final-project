<?php require_once('Connections/config.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO feedback (nama, email, nohp, pesan) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['nama'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['nohp'], "text"),
                       GetSQLValueString($_POST['pesan'], "text"));

  mysql_select_db($database_config, $config);
  $Result1 = mysql_query($insertSQL, $config) or die(mysql_error());

  $insertGoTo = "contact.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_config, $config);
$query_companyprofile = "SELECT * FROM profile ORDER BY logo ASC";
$companyprofile = mysql_query($query_companyprofile, $config) or die(mysql_error());
$row_companyprofile = mysql_fetch_assoc($companyprofile);
$totalRows_companyprofile = mysql_num_rows($companyprofile);

mysql_select_db($database_config, $config);
$query_feedback = "SELECT * FROM feedback";
$feedback = mysql_query($query_feedback, $config) or die(mysql_error());
$row_feedback = mysql_fetch_assoc($feedback);
$totalRows_feedback = mysql_num_rows($feedback);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | <?php echo $row_companyprofile['nama']; ?></title>
    <link rel="shorcut icon" href="companyprofile/<?php echo $row_companyprofile['logo']; ?>">
    <link rel="stylesheet" href="contact.css">
    <!-- <script type="text/javascript" src="jquery-3.3.1.js"></script> -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script> 

	<script type="text/javascript">
		$(window).on("scroll", function(){
			if($(window).scrollTop() > 50){
				$("nav").addClass("active");
			} else {
				$("nav").removeClass("active");
			}
		});
	</script>
</head>
<script src="https://kit.fontawesome.com/897bda4642.js" crossorigin="anonymous"></script>
<body>
    <nav>
        <div class="container">
            <div class="logo">
                <a href="index.php"><img src="companyprofile/<?php echo $row_companyprofile['logo']; ?>" alt="" width="4.5%"></a>
            </div>
            <div class="title">
                <a href="index.php"><?php echo $row_companyprofile['nama']; ?></a>
            </div>
            <div class="menu">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="product.php">Product</a></li>
                    <li><a href="news.php">News</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="dashboard.php" target="_blank">Account</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="wrapper">
        <section id="home">
            <div class="bg1">
                <div class="box">
                    <h2>CONTACT US</h2>
                    <form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
                        <div class="user-box">
                            <label for="nama">Full name</label>
                            <input type="text" name="nama" value="" size="32" />
                        </div>
                        <div class="user-box">
                            <label for="email">Email Address</label>
                            <input type="text" name="email" value="" size="32" />
                        </div>
                        <div class="user-box">
                            <label for="telephone">Telephone Number</label>
                            <input type="text" name="nohp" value="" size="32" />
                        </div>
                        <div class="user-box">
                            <label for="message">Message</label>
                            <textarea type="text" name="pesan" value="" size="32" /></textarea>
                        </div>
                        <div class="button">
                            <input class="tbl-login" type="submit" name="register" value="Submit" />
                        </div>
                    <input type="hidden" name="MM_insert" value="form2" />
            		</form>
                </div>
            </div>
        </section>
        <section>
            <div class="bg4">
                <div class="box-bottom">
                    <div class="bottom">
                        <ul>
                            <li class="top">Experience</li>
                            <li><a href="">What is Experience?</a></li>
                            <li><a href="">Analytics</a></li>
                            <li><a href="">Experience Manager</a></li>
                            <li><a href="">Commerce</a></li>
                            <li><a href="">Market Engage</a></li>
                            <li><a href="">Workfront</a></li>
                        </ul>
                    </div>
                    <div class="bottom">
                        <ul>
                            <li class="top">Support</li>
                            <li><a href="">Download and install</a></li>
                            <li><a href="">Help Center</a></li>
                            <li><a href="">Adobe Support Community</a></li>
                            <li><a href="">Enterprise Support</a></li>
                            <li><a href="">Genuine software</a></li>
                        </ul>
                </div>
                <div class="bottom">
                    <ul>
                        <li class="top">Shop For</li>
                        <li><a href="">Document Cloud</a></li>
                        <li><a href="">Special offers</a></li>
                        <li><a href="">View plans and pricing</a></li>
                        <li><a href="">View all products</a></li>
                    </ul>
                </div>
                <div class="bottom">
                    <ul>
                        <li class="top">Your Account</li>
                        <li><a href="loginusername.php" target="_blank">Login to your account</a></li>
                    </ul>
                </div>
            </div>
        </section>
        <section>
            <div class="footer">
                <div class="socmed">
                    <a href="https://instagram.com/ftrmr_" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                    <a href="https://facebook.com/fittra.cakomoli" target="_blank"><i class="fa-brands fa-facebook"></i></a>
                    <a href="https://twitter.com/fittracakomoli" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                    <a href="https://www.youtube.com/channel/UCLByFmbDevLoDGa3avaBwmw" target="_blank"><i class="fa-brands fa-youtube"></i></a>
                </div>
                <div class="term">
                    <ul>
                        <li>Copyright © 2020 - 2022 <?php echo $row_companyprofile['nama']; ?> All Rights Reserved.</li>
                        <li>/</li>
                        <li><a href="">Privacy</a></li>
                        <li>/</li>
                        <li><a href="">Term of Use</a></li>
                        <li>/</li>
                        <li><a href="">Cookie preferences</a></li>
                    </ul>
                </div>
            </div>
        </section>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
   $(document).ready(function(){      
    $('body').find('img[src$="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"]').remove();
   }); 
</script>
</body>
</html>
<?php
mysql_free_result($companyprofile);

mysql_free_result($feedback);
?>
