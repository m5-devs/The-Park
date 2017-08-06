<?php
$message = "Test Message";
$to = array("19802544246");
$data = json_encode(array("text"=>$message,"to"=>$to));
$authToken = "OrsBYBztOMe7hWZK0fWcZKF7DTELBQgxS1IPzuWHuC043Jr599qxs8DNGCGovIB5V.QlL";
 
$ch = curl_init();
 
curl_setopt($ch, CURLOPT_URL,            "https://api.clickatell.com/rest/message");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST,           1);
curl_setopt($ch, CURLOPT_POSTFIELDS,     $data);
curl_setopt($ch, CURLOPT_HTTPHEADER,     array(
    "X-Version: 1",
    "Content-Type: application/json",
    "Accept: application/json",
    "Authorization: Bearer $authToken"
));
 
$result = curl_exec($ch);

echo $result
?>
<?php
// $username = urlencode("alexwohlbruck");
// $password = urlencode("s25uVEoB");
// $api_id = urlencode("");
// $toList = array(urlencode("number 1"),urlencode("number 2"),urlencode("number 3"));
// $to = implode(',', $toList); $message = urlencode("Test Message");
// echo file_get_contents("https://api.clickatell.com/http/sendmsg" . "?user=$username&password=$password&api_id=$api_id&to=$to&text=$message");
?>