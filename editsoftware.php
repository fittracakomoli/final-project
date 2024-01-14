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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE softwareproduct SET nama=%s, deskripsi=%s, harga=%s, foto=%s WHERE id=%s",
                       GetSQLValueString($_POST['nama'], "text"),
                       GetSQLValueString($_POST['deskripsi'], "text"),
                       GetSQLValueString($_POST['harga'], "text"),
					   GetSQLValueString($_FILES['foto']['name'], "text"),
                       GetSQLValueString($_POST['id'], "int"));
					   move_uploaded_file($_FILES['foto']['tmp_name'],"productsoftware/".$_FILES['foto']['name']);

  mysql_select_db($database_config, $config);
  $Result1 = mysql_query($updateSQL, $config) or die(mysql_error());

  $updateGoTo = "productlistsoftware.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_productsoftware = "-1";
if (isset($_GET['id'])) {
  $colname_productsoftware = $_GET['id'];
}
mysql_select_db($database_config, $config);
$query_productsoftware = sprintf("SELECT * FROM softwareproduct WHERE id = %s", GetSQLValueString($colname_productsoftware, "int"));
$productsoftware = mysql_query($query_productsoftware, $config) or die(mysql_error());
$row_productsoftware = mysql_fetch_assoc($productsoftware);
$totalRows_productsoftware = mysql_num_rows($productsoftware);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
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
                <p><a href="dashboard.php">Dashboard</a> > <a href="categorylist.php">Category List</a> > <a href="productlistsoftware.php">Software Product</a> > Edit Product</p>
            </div>
            <div class="name-tag">
                <h2>Edit Product</h2>
            </div>
            <div class="box-menu">
                <form action="<?php echo $editFormAction; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
                    <div class="user-box">
                        <label for="nama">Nama Product</label>
                        <input type="text" name="nama" value="<?php echo htmlentities($row_productsoftware['nama'], ENT_COMPAT, 'UTF-8'); ?>" />
                    </div>
                    <div class="user-box">
                        <label for="nama">Harga Product</label>
                        <input type="text" name="harga" value="<?php echo htmlentities($row_productsoftware['harga'], ENT_COMPAT, 'UTF-8'); ?>" />
                    </div>
                    <div class="user-box">
                        <label for="username">Gambar Product</label>
                        <input class="foto" type="file" name="foto" value="<?php echo htmlentities($row_productsoftware['foto'], ENT_COMPAT, 'UTF-8'); ?>" />
                    </div>
                    <div class="user-box1">
                      <label>Deskripsi Produk</label>
                      <textarea class="sejarah" name="deskripsi"><?php echo htmlentities($row_productsoftware['deskripsi'], ENT_COMPAT, 'UTF-8'); ?></textarea>
                    </div>
                    <div class="button">
                      <input class="tbl-login" type="submit" name="register" value="Edit Product" />
                    </div>
                    <input type="hidden" name="MM_update" value="form1" />
      			    <input type="hidden" name="id" value="<?php echo $row_productsoftware['id']; ?>" />
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
mysql_free_result($productsoftware);
?>
