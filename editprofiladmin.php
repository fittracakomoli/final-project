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
  $updateSQL = sprintf("UPDATE `user` SET nama=%s, username=%s, email=%s, telepon=%s, foto=%s, password=%s WHERE id=%s",
                       GetSQLValueString($_POST['nama'], "text"),
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['telepon'], "text"),
                       //GetSQLValueString($_POST['foto'], "text"),
					   GetSQLValueString($_FILES['foto']['name'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
					   GetSQLValueString($_POST['id'], "int"));
					   move_uploaded_file($_FILES['foto']['tmp_name'],"img/".$_FILES['foto']['name']);

  mysql_select_db($database_config, $config);
  $Result1 = mysql_query($updateSQL, $config) or die(mysql_error());

  $updateGoTo = "admin.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['id'])) {
  $colname_Recordset1 = $_GET['id'];
}
mysql_select_db($database_config, $config);
$query_Recordset1 = sprintf("SELECT * FROM `user` WHERE id = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $config) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil Admin</title>
    <link rel="shorcut icon" href="mentahan/logo.png">
    <link rel="stylesheet" href="editprofiladmin.css">
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
                <p><a href="admin.php">Dashboard</a> > <a href="admin.php">Admin List</a> > Edit Profil</p>
            </div>
            <div class="name-tag">
                <h2>Edit Profil Admin</h2>
            </div>
            <div class="box-menu">
                <form action="<?php echo $editFormAction; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
                    <div class="user-box">
                        <label for="nama">Full name</label>
                        <input type="text" name="nama" value="<?php echo htmlentities($row_Recordset1['nama'], ENT_COMPAT, 'UTF-8'); ?>" />
                    </div>
                    <div class="user-box">
                        <label for="username">Username</label>
                        <input type="text" name="username" value="<?php echo htmlentities($row_Recordset1['username'], ENT_COMPAT, 'UTF-8'); ?>" />
                    </div>
                    <div class="user-box">
                        <label for="email">Email Address</label>
                        <input type="text" name="email" value="<?php echo htmlentities($row_Recordset1['email'], ENT_COMPAT, 'UTF-8'); ?>" />
                    </div>
                    <div class="user-box">
                        <label for="telephone">Telephone Number</label>
                        <input type="text" name="telepon" value="<?php echo htmlentities($row_Recordset1['telepon'], ENT_COMPAT, 'UTF-8'); ?>" />
                    </div>
                    <div class="user-box">
                        <label for="password">Password</label>
                        <input type="password" name="password" value="<?php echo htmlentities($row_Recordset1['password'], ENT_COMPAT, 'UTF-8'); ?>" />
                    </div>
                    <div class="user-box">
                        <label for="foto">Foto 3x4</label>
                        <input type="file" name="foto" value="<?php echo htmlentities($row_Recordset1['foto'], ENT_COMPAT, 'UTF-8'); ?>" />
                    </div>
                    <div class="button">
                        <input class="tbl-login" type="submit" name="register" value="Edit Profil" />
                    </div>
                    <input type="hidden" name="MM_update" value="form1" />
      				<input type="hidden" name="id" value="<?php echo $row_Recordset1['id']; ?>" />
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
mysql_free_result($Recordset1);
?>
