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
    <title>News List</title>
    <link rel="shorcut icon" href="mentahan/logo.png">
    <link rel="stylesheet" href="newslist.css">
</head>
<body>
    <div class="header">
        <h2>Admin Panel</h2>
    </div>
    <div class="container">
        <div class="panel">
            <div class="hit">
                <a href="dashboard.php">Dashboard</a>
            </div>
            <div class="hit">
                <a href="editcompanyprofile.php">Company Profile</a>
            </div>
            <div class="hit">
                <a href="categorylist.php">Product</a>
            </div>
            <div class="hit">
                <a href="orderlist.php">Order</a>
            </div>
            <div class="hit">
                <a href="newslist.php">News & Update</a>
            </div>
            <div class="hit">
                <a href="feedbacklist.php">Feedback</a>
            </div>
            <div class="blank">
            </div>
            <div class="hit">
                <a href="" class="logout">Logout</a>
            </div>
        </div>
        <div class="box">
            <div class="navigation">
                <p><a href="dashboard.php">Dashboard</a> > <a href="newslist.php">News List</a></p>
            </div>
            <div class="name-tag">
                <h2>News List</h2>
            </div>
            <div class="insert-btn">
                <a href="insertnews.php">+ Insert News</a>
            </div>
            <div class="feed">
                <?php do { ?>
                <div class="product">
                    <img src="news/<?php echo $row_news['foto']; ?>" width="100%">
                    <div class="desc">
                      <h4><?php echo $row_news['judul']; ?></h4>
                      <h5><?php echo $row_news['penulis']; ?> - <?php echo $row_news['tanggal']; ?></h5>
                      <p><?php  
								 if (strlen($row_news['isi'])<=100) {
								 echo $row_news['isi'];
								 }
								 else{
								 $y=substr($row_news['isi'],0,100) . '...';
    							 echo $y;
								 }
								 ?></p>
                      <div class="button">
                        <a href="editnews.php?id=<?php echo $row_news['id']; ?>">Edit News</a>
                      </div>
                      <div class="button1">
                        <a href="deletenews.php?id=<?php echo $row_news['id']; ?>">Delete News</a>
                      </div>
                      </div>
                  </div>
                  <?php } while ($row_news = mysql_fetch_assoc($news)); ?>
            </div>
        </div>
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
mysql_free_result($news);
?>
