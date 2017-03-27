<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

$ip = $_SERVER['REMOTE_ADDR'];
$url = "http://api.ipinfodb.com/v3/ip-country/?key=2308fa6cbbd6749a15310ab0cec32315dee944cca459c48674a79e3d3e9d04fd&ip=".$ip;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);
$country = explode(";", $output);
$country = trim($country[3]);
if($country == "UK"){
 header("Location: https://uk.naturalandhoney.com/");
 exit;
}

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define('WP_USE_THEMES', true);

/** Loads the WordPress Environment and Template */
require( dirname( __FILE__ ) . '/wp-blog-header.php' );
