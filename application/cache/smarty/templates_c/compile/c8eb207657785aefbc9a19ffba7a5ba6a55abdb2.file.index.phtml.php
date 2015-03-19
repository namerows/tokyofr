<?php /* Smarty version Smarty-3.1.11, created on 2012-09-16 02:35:47
         compiled from "/var/www/tokyofr/application/views/scripts/index/index.phtml" */ ?>
<?php /*%%SmartyHeaderCode:543332441503f9c84979e90-84882210%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c8eb207657785aefbc9a19ffba7a5ba6a55abdb2' => 
    array (
      0 => '/var/www/tokyofr/application/views/scripts/index/index.phtml',
      1 => 1346686388,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '543332441503f9c84979e90-84882210',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_503f9c849c3ac6_00545573',
  'variables' => 
  array (
    'prefecutre' => 0,
    'city' => 0,
    'region' => 0,
    'zipcode' => 0,
    'prefecture' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_503f9c849c3ac6_00545573')) {function content_503f9c849c3ac6_00545573($_smarty_tpl) {?><!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My first Zend Framework App</title>
<script type='text/javascript' src='http://www.google.com/jsapi'></script>
<script type='text/javascript'>google.load('jquery', '1.3.2');</script>
<script type='text/javascript' src='http://maps.google.com/maps/api/js?sensor=false&language=ja' charset='UTF-8'></script>
<script type='text/javascript' charset='UTF-8'>
$(document).ready(function() {
  var mapdiv = document.getElementById('map_canvas');
  var geocoder = new google.maps.Geocoder();
//  var org_lat = $('#lat').val();
//  var org_lng = $('#lng').val();

//  var point = new google.maps.LatLng(org_lat, org_lng);
  var myOptions = {
      zoom: 16,
//      center: point,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      scaleControl: true
  };

  var map = new google.maps.Map(mapdiv, myOptions);
  var marker = new google.maps.Marker({
//      position: point,
      map: map,
      draggable: true
  });

// google.maps.event.addListener(marker, 'dragend', function() {
//      var p = marker.position;
//      $('#lat').val(p.lat());
//      $('#lng').val(p.lng());
//  });

//  $('#getad').click(function() {

    var sad = "<?php echo $_smarty_tpl->tpl_vars['prefecutre']->value;?>
<?php echo $_smarty_tpl->tpl_vars['city']->value;?>
<?php echo $_smarty_tpl->tpl_vars['region']->value;?>
";
    var geocoder = new google.maps.Geocoder();

    geocoder.geocode({ 'address': sad}, function(results, status) {

      if (status == google.maps.GeocoderStatus.OK) {

        map.setCenter(results[0].geometry.location);
        marker.setPosition(results[0].geometry.location);

alert(results[0].geometry.location);
//        var p = marker.position;
//        $('#lat').val(p.lat());
//        $('#lng').val(p.lng());

      } else {
        alert('住所から場所を特定できませんでした。最初にビル名などを省略し、番地までの検索などでお試しください。');
      }
    });

//    return false;
//  });
});

  </script>
</head>
<body>
    <h1>Hello,World!</h1>
	郵便番号 <?php echo $_smarty_tpl->tpl_vars['zipcode']->value;?>
<br />
	都道府県 <?php echo $_smarty_tpl->tpl_vars['prefecture']->value;?>
<br />
	市区町村 <?php echo $_smarty_tpl->tpl_vars['city']->value;?>
<br/ >
	町名 <?php echo $_smarty_tpl->tpl_vars['region']->value;?>
<br />

	<div id='map_canvas'></div>

</body>
</html>
<?php }} ?>