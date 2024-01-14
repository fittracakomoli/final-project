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
  $insertSQL = sprintf("INSERT INTO `user` (nama, username, email, telepon, foto, password) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['nama'], "text"),
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['telepon'], "text"),
                       GetSQLValueString($_FILES['foto']['name'], "text"),
                       GetSQLValueString($_POST['password'], "text"));
					   move_uploaded_file($_FILES['foto']['tmp_name'],"img/".$_FILES['foto']['name']);

  mysql_select_db($database_config, $config);
  $Result1 = mysql_query($insertSQL, $config) or die(mysql_error());

  $insertGoTo = "loginusername.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_config, $config);
$query_user = "SELECT * FROM `user`";
$user = mysql_query($query_user, $config) or die(mysql_error());
$row_user = mysql_fetch_assoc($user);
$totalRows_user = mysql_num_rows($user);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="login.css">
    <link rel="shorcut icon" href="mentahan/logo.png">
</head>
<body>
<div class="container">
        <section>
          <div class="bg">
                <div class="login-box">
                    <h2>REGISTER</h2>
                    <form action="<?php echo $editFormAction; ?>" method="post" enctype="multipart/form-data" name="form2" id="form2">
                        <div class="user-box">
                            <label for="nama">Full name</label>
                            <input type="text" name="nama" autocomplete="name">
                        </div>
                        <div class="user-box">
                            <label for="username">Username</label>
                            <input type="text" name="username" autocomplete="username">
                        </div>
                        <div class="user-box">
                            <label for="email">Email Address</label>
                            <input type="text" name="email" autocomplete="email">
                        </div>
                        <div class="user-box">
                            <label for="telephone">Telephone Number</label>
                            <input type="text" name="telepon" autocomplete="cc-number">
                        </div>
                        <div class="user-box">
                            <label for="foto">Foto</label>
                            <input type="file" name="foto" accept=".jpg,.png">
                        </div>
                      <div class="user-box">
                            <label for="password">Password</label>
                            <input type="password" name="password">
                        </div>
                        <div class="button">
                            <input class="tbl-login" type="submit" name="register" value="Register" />
                        </div>
                    	<input type="hidden" name="MM_insert" value="form2" />
						</form>
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
mysql_free_result($user);
?>
