<?php
date_default_timezone_set('Asia/Kolkata');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once  'src/Facebook/autoload.php';
$fb = new Facebook\Facebook([
  'app_id' => '223569131310902',
  'app_secret' => '5f71ae0268d942a8361b9ce538e0e7c2',
  'default_graph_version' => 'v2.5',
]);

$helper = $fb->getRedirectLoginHelper();
//  $accessToken = $helper->getAccessToken();
try {
   $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (isset($accessToken)) {
  // Logged in!
  $_SESSION['facebook_access_token'] = (string) $accessToken;

  // Now you can redirect to another page and use the
  // access token from $_SESSION['facebook_access_token']
}
// OAuth 2.0 client handler
//$oAuth2Client = $fb->getOAuth2Client();

// Exchanges a short-lived access token for a long-lived one
//$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken('{access-token}');
// Sets the default fallback access token so we don't have to pass it to each request
$fb->setDefaultAccessToken('{access-token}');
//$response = $fb->get('/me?fields=id,name,email', $accessToken);
$response = $fb->get('/me/taggable_friends?fields=id,name,email,first_name,birthday,website,location&limit=100', $accessToken);
// $linkData = [
  // 'link' => 'http://www.tigeensolutions.com',
  // 'message' => 'User Srinivas send test message',
  // ];


  // try {
  // // Returns a `Facebook\FacebookResponse` object
  // $response = $fb->post('/me/feed', $linkData, $accessToken);
// } catch(Facebook\Exceptions\FacebookResponseException $e) {
  // echo 'Graph returned an error: ' . $e->getMessage();
  // exit;
// } catch(Facebook\Exceptions\FacebookSDKException $e) {
  // echo 'Facebook SDK returned an error: ' . $e->getMessage();
  // exit;
// }

// $graphNode = $response->getGraphNode();

// echo 'Posted with id: ' . $graphNode['id'];
 echo "<pre>";
print_r($response)


?>