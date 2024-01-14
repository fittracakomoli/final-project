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
$query_productsoftware = "SELECT * FROM softwareproduct ORDER BY id ASC";
$productsoftware = mysql_query($query_productsoftware, $config) or die(mysql_error());
$row_productsoftware = mysql_fetch_assoc($productsoftware);
$totalRows_productsoftware = mysql_num_rows($productsoftware);

mysql_select_db($database_config, $config);
$query_companyprofile = "SELECT * FROM profile ORDER BY logo ASC";
$companyprofile = mysql_query($query_companyprofile, $config) or die(mysql_error());
$row_companyprofile = mysql_fetch_assoc($companyprofile);
$totalRows_companyprofile = mysql_num_rows($companyprofile);

mysql_select_db($database_config, $config);
$query_productpopular = "SELECT * FROM product ORDER BY id ASC";
$productpopular = mysql_query($query_productpopular, $config) or die(mysql_error());
$row_productpopular = mysql_fetch_assoc($productpopular);
$totalRows_productpopular = mysql_num_rows($productpopular);

mysql_select_db($database_config, $config);
$query_producthardware = "SELECT * FROM hardwareproduct ORDER BY id ASC";
$producthardware = mysql_query($query_producthardware, $config) or die(mysql_error());
$row_producthardware = mysql_fetch_assoc($producthardware);
$totalRows_producthardware = mysql_num_rows($producthardware);

mysql_select_db($database_config, $config);
$query_productaccessories = "SELECT * FROM accessoriesproduct ORDER BY id ASC";
$productaccessories = mysql_query($query_productaccessories, $config) or die(mysql_error());
$row_productaccessories = mysql_fetch_assoc($productaccessories);
$totalRows_productaccessories = mysql_num_rows($productaccessories);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product | <?php echo $row_companyprofile['nama']; ?></title>
    <link rel="shorcut icon" href="companyprofile/<?php echo $row_companyprofile['logo']; ?>">
    <link rel="stylesheet" href="product.css">
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
<body oncontextmenu="return false" onselectstart="return false" ondragstart="return false">
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
                        <h2>Popular Product</h2>
                    </div>
                    <div class="feed">
                        <?php do { ?>
                        <div class="product">
                            <img src="img/<?php echo $row_productpopular['foto']; ?>" width="100%">
                            <div class="desc">
                              <h4><?php echo $row_productpopular['nama']; ?></h4>
                              <p><?php echo $row_productpopular['harga']; ?></p>
                              </div>
                            <div class="button">
                              <a href="viewpopular.php?id=<?php echo $row_productpopular['id']; ?>" class="tbl-btn">See Details</a>
                              </div>
                            <div class="button1">
                              <a href="orderpopular.php?id=<?php echo $row_productpopular['id']; ?>" class="tbl-btn">Buy Now</a>
                              </div>
                          </div>
                          <?php } while ($row_productpopular = mysql_fetch_assoc($productpopular)); ?>
                    </div>
                    <div class="feed-title">
                        <h2>Software Product</h2>
                    </div>
                    <div class="feed">
                        <?php do { ?>
                        <div class="product">
                            <img src="productsoftware/<?php echo $row_productsoftware['foto']; ?>">
                            <div class="desc">
                              <h4><?php echo $row_productsoftware['nama']; ?></h4>
                              <p><?php echo $row_productsoftware['harga']; ?></p>
                              </div>
                            <div class="button">
                              <a href="viewsoftware.php?id=<?php echo $row_productsoftware['id']; ?>" class="tbl-btn">See Details</a>
                              </div>
                            <div class="button1">
                              <a href="ordersoftware.php?id=<?php echo $row_productsoftware['id']; ?>" class="tbl-btn">Buy Now</a>
                              </div>
                          </div>
                          <?php } while ($row_productsoftware = mysql_fetch_assoc($productsoftware)); ?>
                    </div>
                    <div class="feed-title">
                        <h2>Hardware Product</h2>
                    </div>
                    <div class="feed">
                        <?php do { ?>
                        <div class="product">
                            <img src="producthardware/<?php echo $row_producthardware['foto']; ?>">
                            <div class="desc">
                              <h4><?php echo $row_producthardware['nama']; ?></h4>
                              <p><?php echo $row_producthardware['harga']; ?></p>
                              </div>
                            <div class="button">
                              <a href="viewhardware.php?id=<?php echo $row_producthardware['id']; ?>" class="tbl-btn">See Details</a>
                              </div>
                            <div class="button1">
                              <a href="orderhardware.php?id=<?php echo $row_producthardware['id']; ?>" class="tbl-btn">Buy Now</a>
                              </div>
                          </div>
                          <?php } while ($row_producthardware = mysql_fetch_assoc($producthardware)); ?>
                    </div>
                    <div class="feed-title">
                        <h2>Accessories Product</h2>
                    </div>
                    <div class="feed">
                        <?php do { ?>
                        <div class="product">
                            <img src="productaccessories/<?php echo $row_productaccessories['foto']; ?>">
                            <div class="desc">
                              <h4><?php echo $row_productaccessories['nama']; ?></h4>
                              <p><?php echo $row_productaccessories['harga']; ?></p>
                              </div>
                            <div class="button">
                              <a href="viewaccessories.php?id=<?php echo $row_productaccessories['id']; ?>" class="tbl-btn">See Details</a>
                              </div>
                            <div class="button1">
                              <a href="orderaccessories.php?id=<?php echo $row_productaccessories['id']; ?>" class="tbl-btn">Buy Now</a>
                              </div>
                          </div>
                          <?php } while ($row_productaccessories = mysql_fetch_assoc($productaccessories)); ?>
                    </div>
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
mysql_free_result($productsoftware);

mysql_free_result($companyprofile);

mysql_free_result($productpopular);

mysql_free_result($producthardware);

mysql_free_result($productaccessories);
?>
