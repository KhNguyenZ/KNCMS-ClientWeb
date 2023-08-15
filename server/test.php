<?php
$apiKey = 'ZwjZ_7tgedDJmA-gosA1MZq_lOU-oh7svDNxsljnU6t7pGhli4InGBcxQ_Wj_VH4lE_MqA.';

// Set the endpoint URL
$endpoint = 'https://bard.ai/api/v1/generate';

// Set the request payload
$data = array(
'key' => $apiKey,
'context' => 'Hello',
'num_completions' => 5
);

// Send the request
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $endpoint);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

// Parse the response
$result = json_decode($response, true);

// Output the suggestions
if (isset($result['suggestion']['completion'])) {
foreach ($result['suggestion']['completion'] as $completion) {
echo $completion['text'] . PHP_EOL;
}
} else {
echo 'No suggestions found.' . PHP_EOL;
}


?>
