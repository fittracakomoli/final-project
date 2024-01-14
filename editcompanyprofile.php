<?php require_once('Connections/config.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "loginusername.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE profile SET nama=%s, hashtag=%s, slogan1=%s, slogan2=%s, sejarah=%s, pendiri=%s, tanggalberdiri=%s, logo=%s, foto=%s, linkgmaps=%s, email=%s, telepon=%s, alamat=%s WHERE id=%s",
                       GetSQLValueString($_POST['nama'], "text"),
                       GetSQLValueString($_POST['hashtag'], "text"),
                       GetSQLValueString($_POST['slogan1'], "text"),
                       GetSQLValueString($_POST['slogan2'], "text"),
                       GetSQLValueString($_POST['sejarah'], "text"),
                       GetSQLValueString($_POST['pendiri'], "text"),
                       GetSQLValueString($_POST['tanggalberdiri'], "date"),
                       GetSQLValueString($_FILES['logo']['name'], "text"),
                       GetSQLValueString($_FILES['foto']['name'], "text"),
                       GetSQLValueString($_POST['linkgmaps'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['telepon'], "text"),
                       GetSQLValueString($_POST['alamat'], "text"),
                       GetSQLValueString($_POST['id'], "int"));
					   move_uploaded_file($_FILES['logo']['tmp_name'],"companyprofile/".$_FILES['logo']['name']);
					   move_uploaded_file($_FILES['foto']['tmp_name'],"companyprofile/".$_FILES['foto']['name']);

  mysql_select_db($database_config, $config);
  $Result1 = mysql_query($updateSQL, $config) or die(mysql_error());

  $updateGoTo = "dashboard.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_companyprofile = "-1";
if (isset($_GET['id'])) {
  $colname_companyprofile = $_GET['id'];
}
mysql_select_db($database_config, $config);
$query_companyprofile = sprintf("SELECT * FROM profile WHERE id = %s", GetSQLValueString($colname_companyprofile, "int"));
$companyprofile = mysql_query($query_companyprofile, $config) or die(mysql_error());
$row_companyprofile = mysql_fetch_assoc($companyprofile);
$totalRows_companyprofile = mysql_num_rows($companyprofile);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Company Profile</title>
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
                <a href="<?php echo $logoutAction ?>" class="logout">Logout</a>
            </div>
        </div>
        <div class="box">
            <div class="navigation">
                <p><a href="dashboard.php">Dashboard</a> > Edit Company Profile</p>
            </div>
            <div class="name-tag">
                <h2>Edit Company Profile</h2>
            </div>
            <div class="box-menu">
                <form action="<?php echo $editFormAction; ?>" method="post" enctype="multipart/form-data" name="form2" id="form2">
                    <div class="user-box">
                        <label>Nama Perusahaan</label>
                        <input type="text" name="nama" value="<?php echo htmlentities($row_companyprofile['nama'], ENT_COMPAT, 'UTF-8'); ?>" />
                    </div>
                    <div class="user-box">
                        <label>Pendiri</label>
                        <input type="text" name="pendiri" value="<?php echo htmlentities($row_companyprofile['pendiri'], ENT_COMPAT, 'UTF-8'); ?>" />
                    </div>
                    <div class="user-box">
                        <label>Tanggal Berdiri</label>
                        <input class="date" type="date" name="tanggalberdiri" value="<?php echo htmlentities($row_companyprofile['tanggalberdiri'], ENT_COMPAT, 'UTF-8'); ?>" />
                    </div>
                    <div class="user-box">
                        <label>Slogan 1</label>
                        <input type="text" name="slogan1" value="<?php echo htmlentities($row_companyprofile['slogan1'], ENT_COMPAT, 'UTF-8'); ?>" />
                    </div>
                    <div class="user-box">
                        <label>Slogan 2</label>
                        <input type="text" name="slogan2" value="<?php echo htmlentities($row_companyprofile['slogan2'], ENT_COMPAT, 'UTF-8'); ?>" />
                    </div>
                    <div class="user-box">
                        <label>Hashtag</label>
                        <input type="text" name="hashtag" value="<?php echo htmlentities($row_companyprofile['hashtag'], ENT_COMPAT, 'UTF-8'); ?>" />
                    </div>
                    <div class="user-box">
                        <label>Alamat Toko</label>
                        <input type="text" name="alamat" value="<?php echo htmlentities($row_companyprofile['alamat'], ENT_COMPAT, 'UTF-8'); ?>" size="32" />
                    </div>
                    <div class="user-box">
                        <label>No Telepon Toko</label>
                        <input type="text" name="telepon" value="<?php echo htmlentities($row_companyprofile['telepon'], ENT_COMPAT, 'UTF-8'); ?>" />
                    </div>
                    <div class="user-box">
                        <label>Email Toko</label>
                        <input type="text" name="email" value="<?php echo htmlentities($row_companyprofile['email'], ENT_COMPAT, 'UTF-8'); ?>" />
                    </div>
                    <div class="user-box">
                        <label>Link Google Maps</label>
                        <input type="text" name="linkgmaps" value="<?php echo htmlentities($row_companyprofile['linkgmaps'], ENT_COMPAT, 'UTF-8'); ?>" />
                    </div>
                    <div class="user-box">
                        <label>Logo</label>
                        <input type="file" name="logo" value="<?php echo htmlentities($row_companyprofile['logo'], ENT_COMPAT, 'UTF-8'); ?>" />
                    </div>
                    <div class="user-box">
                        <label>Gambar Gedung</label>
                        <input type="file" name="foto" value="<?php echo htmlentities($row_companyprofile['foto'], ENT_COMPAT, 'UTF-8'); ?>" />
                    </div>
                    <div class="user-box1">
                      <label>Sejarah Toko</label>
                      <textarea class="sejarah" name="sejarah"><?php echo htmlentities($row_companyprofile['sejarah'], ENT_COMPAT, 'UTF-8'); ?></textarea>
                    </div>
                    <div class="button">
                      <input class="tbl-login" type="submit" name="register" value="Edit Profil" />
                    </div>
                    <input type="hidden" name="MM_update" value="form2" />
      			        <input type="hidden" name="id" value="<?php echo $row_companyprofile['id']; ?>" />
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
mysql_free_result($companyprofile);
?>
