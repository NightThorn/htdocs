<?php
class post extends MY_Controller
{

public function topic()
{

        $topic = $_POST['topic']; 

$url = "https://api.openai.com/v1/engines/text-davinci-002/completions";
$OPENAI_API_KEY = "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";
$data = array(
"prompt"=> "Write a post for" + $topic,
"temperature"=> 0.83,
"max_tokens"=> 483,
"top_p"=> 1,
"frequency_penalty"=> 0,
"presence_penalty"=> 2
);
$data_string = json_encode($data);

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt(
$curl,
CURLOPT_HTTPHEADER,
array("Content-type: application/json", "Authorization: Bearer $OPENAI_API_KEY")
);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

$json_response = curl_exec($curl);

$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

if (
$status != 201
) {
die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
}


curl_close($curl);

$response = json_decode($json_response, true);
return $response;

}
}