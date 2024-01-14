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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO berita (judul, isi, tanggal, penulis, link, foto) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['judul'], "text"),
                       GetSQLValueString($_POST['isi'], "text"),
                       GetSQLValueString($_POST['tanggal'], "date"),
                       GetSQLValueString($_POST['penulis'], "text"),
                       GetSQLValueString($_POST['link'], "text"),
                       GetSQLValueString($_FILES['foto']['name'], "text"));
					   move_uploaded_file($_FILES['foto']['tmp_name'],"news/".$_FILES['foto']['name']);

  mysql_select_db($database_config, $config);
  $Result1 = mysql_query($insertSQL, $config) or die(mysql_error());

  $insertGoTo = "newslist.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_config, $config);
$query_news = "SELECT * FROM berita";
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
    <title>Insert News</title>
    <link rel="shorcut icon" href="mentahan/logo.png">
    <link rel="stylesheet" href="editcompanyprofile.css">
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
                <p><a href="dashboard.php">Dashboard</a> > <a href="newslist.php">News List</a> > Insert News</p>
            </div>
            <div class="name-tag">
                <h2>Insert News</h2>
            </div>
            <div class="box-menu">
            	<form action="<?php echo $editFormAction; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
            		<div class="user-box">
                    	<label for="sejarah">Judul Berita</label>
                    	<input type="text" name="judul" value="" size="32" />
                	</div>
                    <div class="user-box">
                        <label for="nama">Penulis Berita</label>
                        <input type="text" name="penulis" value="" size="32" />
                    </div>
                    <div class="user-box">
                        <label for="nama">Tanggal Berita</label>
                        <input class="date" type="date" name="tanggal" value="" size="32" />
                    </div>
                    <div class="user-box">
                        <label for="nama">Link Berita</label>
                        <input type="text" name="link" value="" size="32" />
                    </div>
                    <div class="user-box">
                        <label for="username">Gambar</label>
                        <input class="foto" type="file" name="foto" value="" size="32" />
                    </div>
                    <div class="user-box1">
                      <label>Isi Berita</label>
                      <textarea class="sejarah" name="isi"></textarea>
                    </div>
                    <div class="button">
                      <input class="tbl-login" type="submit" name="register" value="Input News" />
                    </div>
                    <input type="hidden" name="MM_insert" value="form1" />
                </form>
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
