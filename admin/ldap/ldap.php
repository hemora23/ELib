<!---
1. User AD dummy untuk testing
    username: user.01
    password: 12345678
2. AD Parameter :
- AD Server:
     LDAP://192.168.88.33/DC=hanabank,DC=com
- AD Domain dan DN
    Domain: hanabank.com
-->

<?php
if(isset($_POST['btnSubmit'])){
$username = $_POST['username'];
$password = $_POST['password'];

$ldapconfig['host'] = 'LDAP://192.168.88.33/'; //'LDAP SERVER';//CHANGE THIS TO THE CORRECT LDAP SERVER
$ldapconfig['port'] = '389';
$ldapconfig['basedn'] ='DC=hanabank,DC=com'; //'dc=LDAP_SERVER,dc=com';//CHANGE THIS TO THE CORRECT BASE DN
$ldapconfig['usersdn'] ='cn=user.01'; //'cn=users';//CHANGE THIS TO THE CORRECT USER OU/CN
$ds=ldap_connect($ldapconfig['host'], $ldapconfig['port']);


ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);
ldap_set_option($ds, LDAP_OPT_NETWORK_TIMEOUT, 10);

$dn="uid=".$username.",".$ldapconfig['usersdn'].",".$ldapconfig['basedn'];
if(isset($_POST['username'])){
if ($bind=ldap_bind($ds, $dn, $password)) {
  echo("Login correct");//REPLACE THIS WITH THE CORRECT FUNCTION LIKE A REDIRECT;
} else {

 echo "Login Failed: Please check your username or password";
}
}
}
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
<form action="" method="post">
<input name="username">
<input type="password" name="password">
<input type="submit" value="Submit" name="btnSubmit">
</form>
</body>
</html>