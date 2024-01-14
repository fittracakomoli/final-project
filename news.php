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

mysql_select_db($database_config, $config);
$query_companyprofile = "SELECT * FROM profile ORDER BY logo ASC";
$companyprofile = mysql_query($query_companyprofile, $config) or die(mysql_error());
$row_companyprofile = mysql_fetch_assoc($companyprofile);
$totalRows_companyprofile = mysql_num_rows($companyprofile);

mysql_select_db($database_config, $config);
$query_news = "SELECT * FROM berita ORDER BY id ASC";
$news = mysql_query($query_news, $config) or die(mysql_error());
$row_news = mysql_fetch_assoc($news);
$totalRows_news = mysql_num_rows($news);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News & Update | <?php echo $row_companyprofile['nama']; ?></title>
    <link rel="shorcut icon" href="companyprofile/<?php echo $row_companyprofile['logo']; ?>.png">
    <link rel="stylesheet" href="news.css">
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
                    <div class="feed-title">
                        <h2>News & Update</h2>
                    </div>
                    <?php do { ?>
                    <div class="feed">
                        <div class="image">
                          <a href="<?php echo $row_news['link']; ?>" target="_blank">
                          <img src="news/<?php echo $row_news['foto']; ?>" alt="" width="100%">
                          </a>
                          </div>
                        <div class="kolom">
                          <h2><a href="<?php echo $row_news['link']; ?>" target="_blank"><?php echo $row_news['judul']; ?></a></h2>
                          <h4><?php echo $row_news['penulis']; ?> - <?php echo $row_news['tanggal']; ?></h4>
                          <p><?php  
								 if (strlen($row_news['isi'])<=185) {
								 echo $row_news['isi'];
								 }
								 else{
								 $y=substr($row_news['isi'],0,185) . ' ...&nbsp;<a href=?id='.$row_news['id'].'>Read more</a>';
    							 echo $y;
								 }
								 ?></p>
                          </div>
                      </div>
                      <?php } while ($row_news = mysql_fetch_assoc($news)); ?>
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

mysql_free_result($news);
?>
