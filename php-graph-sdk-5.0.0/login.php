<?php
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
$permissions = ['email', 'user_likes','user_friends','user_birthday', 'user_location', 'user_website','publish_actions','manage_pages','ads_management','read_page_mailboxes']; // optional
$loginUrl = $helper->getLoginUrl('http://freefood.co.in/php-graph-sdk-5.0.0/login-callback.php', $permissions);

echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
?>