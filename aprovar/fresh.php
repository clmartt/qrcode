<?php

$api_key = "6Rt16gfHONeNi4MiodvY";
$password = "x";
$yourdomain = "suporte.kvminformatica";

$ticket_data = json_encode(array(
  "description" => "Some details on the issue ...",
  "subject" => "Support needed..",
  "email" => "tom@outerspace.com",
  "priority" => 1,
  "status" => 2,
  "cc_emails" => array("ram@freshdesk.com", "diana@freshdesk.com")
));

$url = "https://$yourdomain.freshdesk.com/api/v2/tickets";

$ch = curl_init($url);

$header[] = "Content-type: application/json";
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_USERPWD, "$api_key:$password");
curl_setopt($ch, CURLOPT_POSTFIELDS, $ticket_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec($ch);
$info = curl_getinfo($ch);
$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
$headers = substr($server_output, 0, $header_size);
$response = substr($server_output, $header_size);

if($info['http_code'] == 201) {
  echo "Ticket created successfully, the response is given below \n";
  echo "Response Headers are \n";
  echo $headers."\n";
  echo "Response Body \n";
  echo "$response \n";
} else {
  if($info['http_code'] == 404) {
    echo "Error, Please check the end point \n";
  } else {
    echo "Error, HTTP Status Code : " . $info['http_code'] . "\n";
    echo "Headers are ".$headers;
    echo "Response are ".$response;
    echo $info['error'];
  }
}

curl_close($ch);

?>



