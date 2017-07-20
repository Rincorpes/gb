<?php
require_once 'mailchimp-api-config.php';

/**
 * Subscribe form action
 *
 * @since 1.0
 */
function gb_subscribe()
{
	$apiKey = MAILCHIMP_API_KEY;
	$listId = MAILCHIMP_LIST_ID;

	$data['status'] = 'pending';
	$data['email'] = $_POST['email'];
	$data['name'] = (! empty($_POST['name'])) ? $_POST['name'] : '';

	$dataCenter = substr($apiKey,strpos($apiKey,'-')+1);
	$memberId = md5(strtolower($data['email']));
	$url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listId . '/members/' . $memberId;
	$json = json_encode([
		'apykey' => $apiKey,
		'email_address' => $data['email'],
		'status' => $data['status'], // "subscribed","unsubscribed","cleaned","pending"
	]);

	if (! empty($data['name'])) $json['merge_fields'] = array('FNAME' => $data['name']);

	$auth = base64_encode( 'user:' . $apiKey );

	$headers[] = 'Content-Type: application/json';
	$headers[] = 'Content-Length: ' . $auth;

	$ch = curl_init($url);

	curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apiKey);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array($headers));
    curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-MCAPI/3.0');
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);

	$result = curl_exec($ch);
	//$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	$curlInfo = curl_getinfo($ch);

	curl_close($ch);

	echo json_encode($result, true);
	wp_die();
}
add_action('wp_ajax_gb_subscribe', 'gb_subscribe');
add_action('wp_ajax_nopriv_gb_subscribe', 'gb_subscribe');
?>