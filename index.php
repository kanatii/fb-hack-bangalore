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
  <title>England v India | ICC World Twenty20</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta property="http://ogp.me/ns/fb#app_id" content="<?php echo $app_id; ?>">

  <!-- Define the language of the page in Facebook locales -->
  <meta property="og:locale" content="en_GB">
  <meta property="og:locale:alternate" content="ta_IN">

  <meta property="og:title" content="England v India">
  <meta property="og:site_name" content="ICC World Twenty20">
  <meta property="og:description" content="The big matchup in Group A: England vs. India in Colombo, Sri Lanka.">

  <!-- collapse all references to the page into single references -->
  <meta property="og:url" content="<?php echo $base_url; ?>">
  <link rel="canonical" href="<?php echo $base_url; ?>">

  <meta property="og:image" content="<?php echo $base_url . 'img/icct20.png'; ?>">
  <meta property="og:image:type" content="image/png">
  <meta property="og:image:width" content="385">
  <meta property="og:image:height" content="462">

  <meta property="og:type" content="<?php echo $app_namespace; ?>:match">
  <link rel="icon" type="image/png" href="icon.png" sizes="16x16">
  <link rel="icon" type="image/vnd.microsoft.icon" href="favicon.ico" sizes="48x48 32x32 24x24 16x16">
  <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
  <style type="text/css">
body {
  padding-top: 60px; /* 60px to make the Bootstrap container go all the way to the bottom of the topbar */
}
  </style>
  <!--[if lt IE 9]>
    <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

  <!-- using jQuery Sizzle selectors, DOM builders, and event handlers -->
  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
  <script type="text/javascript">jQuery.ajaxSetup({cache:true});</script>
</head>
<body><?php
require_once(dirname(__FILE__).'/sdk/src/facebook.php');

$facebook = new Facebook(array(
  'appId' => $app_id,
  'secret' => $app_secret
));
?>

<header><div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
      <a class="brand" href="/">ICC World Twenty20</a>
      <div id="account" class="pull-right"><?php
$user_id = $facebook->getUser();
if ($user_id) { // logged in
  // request just the fields we need
  $me = $facebook->api('/me?fields=link,name','GET');
?><img alt="<?php echo $user_id . ' profile photo'; ?>" src="<?php

// specify pattern. Facebook will redirect
// @link 
echo "https://graph.facebook.com/{$user_id}/picture?type=small";

?>" width="50" height="50"><a class="fn navbar-text" href="<?php echo htmlspecialchars($me['link']); ?>"><?php echo $me['name'] ?></a>
        <a class="fb-logout-button btn btn-primary" rel="nofollow" href="<?php echo htmlspecialchars($facebook->getLogoutUrl()); ?>">Log out</a><?php
} else { ?>
        <a rel="nofollow" class="fb-login-button btn btn-primary" href="<?php echo htmlspecialchars( $facebook->getLoginUrl( array('scope'=>$scope) ) ); ?>">Log in</a>
<?php } ?></div>
    </div>
  </div>
</div></header>

<div class="container">
  <div class="row">
  <div class="span6" style="text-align:center"><img class="img-rounded" alt="ICC T20 Sri Lanka logo" src="img/icct20.png" width="385" height="462"></div>
  <div class="span6">
  <p>England v India</p>
  <p><time datetime="2012-09-23T19:30:00Z">September 23 19:30</time></p>
  <p style="margin-bottom:2em">R. Premadasa Stadium, Colombo, Sri Lanka</p>

  <?php
  if ($user_id) {

    if ( array_key_exists('attend',$_POST) && $_POST['attend']==='match' ) {
      try {
        $activity = $facebook->api('/me/' . $app_namespace . ':attend', 'post', array('match'=>$base_url,'fb:explicitly_shared'=>'true'));
        if ($activity && array_key_exists('id',$activity)){
          ?><p class="alert alert-success">Activity <?php echo '<a href="' . $me['link'] . '/activity/' . $activity['id'] . '" target="_blank">' . $activity['id'] . '</a>'; ?> created.</p><?php
        }
      } catch (FacebookApiException $e) {
        ?><div class="alert alert-error"><?php var_dump($e); ?></div><?php
      }
    } else if( array_key_exists('like',$_POST) && $_POST['like']==='fan' ) {
      try {
        $activity = $facebook->api('/me/' . $app_namespace . ':fan', 'post', array('team'=>$base_url.'india.php','fb:explicitly_shared'=>'true'));
        if ($activity && array_key_exists('id',$activity)){
          ?><p class="alert alert-success">Chak De! India: <a target="_blank" href="<?php echo $me['link'] . '/activity/' . $activity['id']; ?>"><?php echo $activity['id']; ?></a></p><?php
        }
      } catch (FacebookApiException $e) {
        ?><div class="alert alert-error"><?php var_dump($e); ?></div><?php
      }
    } else {
      ?>
      <form action="/" method="post"><input type="hidden" name="attend" value="match"><button class="btn btn-large" type="submit">I will attend the match!</button></form>
      <form action="/" method="post"><input type="hidden" name="like" value="fan"><button class="btn btn-large" type="submit"><img alt="India flag" src="img/india.png" width="22" height="15"> India to win it</button></form>
      <?php
    }
  } else {
    ?><p>We hope you will watch the match or attend in person.</p><?php
  } ?></div>
  </div>
</div>

  <div id="fb-root"></div>
  <script type="text/javascript">
    jQuery.getScript(document.location.protocol + "//connect.facebook.net/en_US/all.js",function(){
      FB.init({
        appId      : <?php echo json_encode($app_id); ?>, // App ID
        channelUrl : <?php echo json_encode($base_url.'/channel.html'); ?>, // Channel File
        status     : true, // check login status
        cookie     : true // enable cookies to allow the server to access the session
      });

      var account_el = jQuery("#account");
    <?php if ($user_id) { ?>
      account_el.find(".fb-logout-button").remove();
      account_el.append( jQuery("<button />").addClass("fb-logout-button btn btn-primary").attr("type","button").text("Log out").click(function(){FB.logout();}) );
    <?php } else { ?>
      account_el.empty();
      account_el.append( jQuery("<button />").addClass("fb-login-button btn btn-primary").attr("type","button").text("Log in").click( function(){
        FB.login(function(response) {
          if (response.authResponse) {
            // successful login. reload with new cookies
            document.location.reload();
          }
        }, {scope:<?php echo json_encode($scope); ?>});
      }) );
    <?php } ?>
    });
  </script>
</body>
</html>