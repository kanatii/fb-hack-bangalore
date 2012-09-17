<!DOCTYPE html>
<html lang="en"><?php
require_once(dirname(__FILE__).'/config.php');

$prefix_attribute = '';
if ( !empty($curie_prefix_mappings) ) {
  foreach( $curie_prefix_mappings as $prefix => $curie ) {
    $prefix_attribute .= $prefix . ': ' . $curie . ' ';
  }
  $prefix_attribute = rtrim($prefix_attribute);
}

?><head<?php
if ( $prefix_attribute ) {
  echo ' prefix="' . $prefix_attribute . '"';
} ?>>
  <meta charset="utf-8">
  <title>Indian cricket team | ICC World Twenty20</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta property="http://ogp.me/ns/fb#app_id" content="<?php echo $app_id; ?>">

  <!-- Define the language of the page in Facebook locales -->
  <meta property="og:locale" content="en_GB">
  <meta property="og:locale:alternate" content="ta_IN">

  <meta property="og:title" content="Indian T20 cricket team">
  <meta property="og:site_name" content="ICC World Twenty20">
  <meta property="og:description" content="Mahendra Singh Dhoni, Virat Kohli, and all the other members of the Indian cricket team.">

  <!-- collapse all references to the page into single references -->
  <meta property="og:url" content="<?php echo $base_url . 'india.php'; ?>">
  <link rel="canonical" href="<?php echo $base_url . 'india.php'; ?>">

  <meta property="og:image" content="<?php echo $base_url . 'img/india-crest.png'; ?>">
  <meta property="og:image:type" content="image/png">
  <meta property="og:image:width" content="500">
  <meta property="og:image:height" content="496">

  <meta property="og:type" content="<?php echo $app_namespace; ?>:team">
  <meta property="<?php echo $app_namespace; ?>:founded" property="1932-01-01">

  <link rel="icon" type="image/png" href="icon.png" sizes="16x16">
  <link rel="icon" type="image/vnd.microsoft.icon" href="favicon.ico" sizes="48x48 32x32 24x24 16x16">
  <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
</head>
<body>
<p>Support team India</p>
</body>
</html>