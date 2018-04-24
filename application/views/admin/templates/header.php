<?php if(!defined('admin_assets')){
	define("admin_assets", base_url()."assets/admin/"); 
}?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Web</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="<?php echo admin_assets; ?>css/bootstrap.min.css" />
<link rel="stylesheet" href="<?php echo admin_assets; ?>css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="<?php echo admin_assets; ?>css/maruti-style.css" />
<link rel="stylesheet" href="<?php echo admin_assets; ?>css/select2.css" />
<link rel="stylesheet" href="<?php echo admin_assets; ?>css/maruti-media.css" class="skin-color" />


<script src="<?php echo admin_assets; ?>js/jquery-1.7.2.min.js"></script>
<script src="<?php echo admin_assets; ?>js/bootstrap.min.js"></script>
<script src="<?php echo admin_assets; ?>/js/bootstrap3-typeahead.js"></script>
</head>

<body onLoad="show_clock()">

<!--Header-part-->

<div id="header">
  <h1><a href="<?php echo base_url(); ?>"><i></i></a></h1>
</div>

<!--close-Header-part--> 

<!--top-Header-messaages-->

<div class="btn-group rightzero"> <a class="top_message tip-left" title="Manage Files"><i class="icon-file"></i></a> <a class="top_message tip-bottom" title="Manage Users"><i class="icon-user"></i></a> <a class="top_message tip-bottom" title="Manage Comments"><i class="icon-comment"></i><span class="label label-important">5</span></a> <a class="top_message tip-bottom" title="Manage Orders"><i class="icon-shopping-cart"></i></a> </div>

<!--close-top-Header-messaages--> 

<!--top-Header-menu-->

<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li class="" ><a title="" href="javascript:void(0);"><i class="icon icon-time"></i> <span class="text"> 
      <script language="javascript" src="<?php echo admin_assets; ?>js/liveclock.js"></script> 
      <?php echo date('d, F Y'); ?></span></a></li>
   
    <li class=""><a title="Logout" href="<?php echo base_url(); ?>admin/login/logout"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
  </ul>
</div>

<!--close-top-Header-menu-->

<div id="sidebar"><a href="javascript:void(0);" class="visible-phone"><i class="icon icon-home"></i> DASHBOARD</a>
  <ul>
    <?php if(!empty($front_menu)){
	foreach($front_menu as $menu){ 
	$CI =& get_instance();


		$query = $CI->db->query("select * from access_pages where parent_id='".$menu['id']."' and status=1");
		$submenu = $query->result_array();
	
	?>
    <li class="submenu"> <a href="<?php if($menu['page_link']==''){?>javascript:void(0);<?php }else{?><?php echo base_url(); ?><?php echo $menu['page_link']; }?>"><i class="<?php echo $menu['icon']; ?>"></i> <span><?php echo strtoupper($menu['title']); ?></span></a>
      <?php if(!empty($submenu)){ ?>
      <ul class="ul-2">
        <?php foreach($submenu as $sub){ ?>
        <li><a href="<?php echo base_url(); ?><?php echo $sub['page_link']; ?>"><?php echo strtoupper($sub['title']); ?></a></li>
        <?php } ?>
      </ul>
      <?php } ?>
    </li>
    <?php }} ?>
    
  </ul>
</div>
