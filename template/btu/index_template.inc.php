<?php

if (!defined('INDEX_AUTH')) {
	die("can not access this file directly");
} elseif (INDEX_AUTH != 1) {
	die("can not access this file directly");
}

$p = 'home';

if (isset($_GET['p']))
{
	if ($_GET['p'] == 'thong-tin-thu-vien') {
		$p = 'thong-tin-thu-vien';
	} elseif ($_GET['p'] == 'ho-tro-tim-kiem') {
		$p = 'ho-tro-tim-kiem';
	} elseif ($_GET['p'] == 'member') {
		$p = 'member';
	} elseif ($_GET['p'] == 'login') {
		$p = 'login';
	} else {
		$p = strtolower(trim($_GET['p']));
	}
}

/*----------------------------------------------------
  menu list
  you may modified as you need
  ----------------------------------------------------*/
$menus = array (
	'home' 		=> array(	'url'  => 'index.php',
							'text' => __('Home'),
                            'target' => ''
					),
    'thong-tin-thu-vien' 	=> array(	'url'  => 'index.php?p=thong-tin-thu-vien',
      						'text' => __('Library Information'),
                            'target' => ''
					),
    'member'	=> array(	'url'  => 'index.php?p=member',
							'text' => __('Member Area'),
                            'target' => ''
      					),
	/*
    'librarian'   => array(	'url'  => 'index.php?p=librarian',
							'text' => __('Librarian')
      ),
	*/
    'ho-tro-tim-kiem'   	=> array(	'url'  => 'huong-dan-su-dung/huong-dan-tra-cuu-opac.html',
							'text' => __('Help on Search'),
                            'target' => '_blank'
      				),
    /*                    
    'login'   	=> array(	'url'  => 'index.php?p=login',
      						'text' => __('Librarian LOGIN')
      				)
    */
    );

/*----------------------------------------------------
  social button
  you may modified as you need.
  ----------------------------------------------------*/
  $social = array (
    'facebook'  => array('url'  => 'http://www.facebook.com/groups/senayan.slims/',
      'text' => 'Facebook'
      ),
    'twitter'  => array('url'  => 'http://twitter.com/#!/slims_official',
      'text' => 'Twitter'
      ),
    'youtube'  => array('url'  => 'http://www.youtube.com/user/senayanslims',
      'text' => 'Youtube'
      ),
    'gihub'  => array('url'  => 'https://github.com/slims/',
      'text' => 'Github'
      ),
    'forum'  => array('url'  => 'http://slims.web.id/forum/',
      'text' => 'Forum'
      )
    );
  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title><?php echo $page_title; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="description" content="Thư viện Trường Cao đẳng Cộng đồng Bình Thuận">
        <meta name="keywords" content="thư viện cao đẳng cộng đồng bình thuận, thư viện btu, thư viện cao đẳng cộng đồng">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="robots" content="index, nofollow">
        
        
		<link rel="shortcut icon" href="webicon.ico" type="image/x-icon" />
        <link href="<?php echo $sysconf['template']['dir']; ?>/core.style.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo JWB; ?>colorbox/colorbox.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $sysconf['template']['css']; ?>" rel="stylesheet" type="text/css" />
        <link type="text/css" rel="stylesheet" media="all" href="<?php echo SWB; ?>template/btu/css/tango/skin.css"/>

        <?php echo $metadata; ?>  
        <script type="text/javascript" src="<?php echo JWB; ?>jquery.js"></script>
		<script type="text/javascript" src="<?php echo JWB; ?>form.js"></script>
        <script type="text/javascript" src="<?php echo JWB; ?>gui.js"></script>
        <script type="text/javascript" src="<?php echo $sysconf['template']['dir'].'/'.$sysconf['template']['theme']; ?>/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo JWB; ?>colorbox/jquery.colorbox-min.js"></script>
        <script type="text/javascript" src="<?php echo SWB; ?>template/btu/js/jquery.jcarousel.min.js"></script>
        
    </head>
    
    <body>   
<?php
	$is_member_login = utility::isMemberLogin();
?>
    	<div id="wrap">
            <div class="navbar-wrapper">
                <div class="container">
                    <div class="navbar" role="navigation">
                        <div class="container">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand" href="index.php">
                                    <div class="sitename"><?php echo $sysconf['library_name']; ?></div>
                                    <div class="subname"><?php echo $sysconf['library_subname']; ?></div>
                                </a>
                            </div>
                            <div class="navbar-collapse collapse navbar-right">
                                <ul class="nav navbar-nav">
                                    <?php foreach ($menus as $path => $menu) { ?>
                                    <li <?php if ($p == $path) {echo ' class="active"';} ?>>
                                        <a target="<?php echo $menu['target'] ?>" href="<?php echo $menu['url']; ?>" title="<?php echo $menu['text']; ?>">
                                            <?php echo ucwords($menu['text']); ?>
                                        </a>
                                    </li>
                                    <?php } ?>						
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  <!--// End Menu //-->        
        
        
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-sm-8">
                        	<div class="panel panel-btu">
                            	<div class="panel-heading tagline">
                                <?php																		
									if(!isset($_GET['p'])) {
										if(isset($_GET['search'])) {
											echo __('Collections');
										}else {
											echo  __('Tra cuu');
										}
									}else {
										if ($_GET['p'] == 'show_detail') {
											echo __("Record Detail");
										}elseif ($_GET['p'] == 'member') {
											if ($is_member_login) {
												echo __('Member Detail');
											} else {
												echo __('Library Member Login');
											}
										} else {
											echo $page_title;
										}
									}
								?>
                                <!--
								 <?php if(!isset($_GET['p'])) { ?>
            						<?php echo __('Collections'); ?>
            					<?php } elseif ($_GET['p'] == 'show_detail') { ?>
            						<?php echo __("Record Detail"); ?>
            					<?php } else { ?>
            						<?php echo $page_title; ?>
            					<?php } ?>            						
                                -->
                                <?php
                                if(isset($_GET['p'])) {
                                ?>
                                    <a href="javascript: history.back();" class="btn btn-mini btn-danger pull-right"><i class="icon icon-white icon-circle-arrow-left"></i> <?php echo __('Back'); ?> </a>
                                <?php
                                }
                                ?>
								</div>
								<div class="panel-body">
                                <?php 
								if(isset($_GET['search']) || isset($_GET['title']) || isset($_GET['keywords']) || isset($_GET['p'])) {
                                   	 if(isset($_GET['p'])) {
            							if($_GET['p'] == 'member') {
              								echo $main_content;
            							} else {
											echo $main_content;
            							}
          							} else {          
										if(isset($_GET['search'])) {
											include('tmp/form-search.php');
										}
										echo $main_content;
          							}
								} else {
									include('tmp/form-search.php');
								} 
								?>          
                                                            
                            	</div>
                            </div>
                            
                            <?php
                            // Promoted titles
                            // Only show at the homepage
                            if(  !( isset($_GET['search']) || isset($_GET['title']) || isset($_GET['keywords']) || isset($_GET['p']) ) ) :
                                // query top book
                                $topbook = $dbs->query('SELECT biblio_id, title, image FROM biblio WHERE
                                                        promoted=1 ORDER BY last_update LIMIT 10');
                                if ($num_rows = $topbook->num_rows) :
                            ?>
                                <div class="panel panel-btu">
                                    <div class="panel-heading tagline">
                                        <?php echo __('Sach moi'); ?>
                                    </div>
                                    <div class="panel-body">
                                    <ul id="topbook" class="jcarousel-skin-tango">
                                          <?php
                                          while ($book = $topbook->fetch_assoc()) {
                                            if (!empty($book['image'])) :
                                            ?>
                                                <li class="book">                                                    
                                                    <a href="./index.php?p=show_detail&id=<?php echo $book['biblio_id'] ?>" title="<?php echo $book['title'] ?>"><img src="images/docs/<?php echo $book['image'] ?>" /><span class="jcarousel-title"><?php echo $book['title'] ?></span></a>
                                                </li>
                                            <?php
                                            else:
                                            ?>
                                            <li class="book"><a href="./index.php?p=show_detail&id=<?php echo $book['biblio_id'] ?>" title="<?php echo $book['title'] ?>"><img src="./template/default/img/nobook.png" /><span class="jcarousel-title"><?php echo $book['title'] ?></span></a></li>
                                            <?php
                                            endif;
                                          }
                                          ?>
                                        </ul>
                                    </div>
                                </div>
                                  
                                <?php endif; ?>
                            <?php endif; ?>
                            
                            <?php
                                if(!(isset($_GET['search']) || isset($_GET['title']) || isset($_GET['keywords']) || isset($_GET['p'])))
                                {
                            ?>
                            <div class="panel panel-btu">
                            	<div class="panel-heading tagline">
                                    <?php echo __('Huong dan opac'); ?>
                                </div>
                                <div class="panel-body">
                                    <?php include_once('huong-dan-opac.php'); ?>
                                </div>
                            </div>
                            <?php
                                }
                            ?>
                            
                        </div>
                        
                        <div class="col-lg-4 col-sm-4">
                            <?php include('tmp/sidebar.php'); ?>
                        </div>                         
                    </div>                    
                </div>
                
            </div>
            
		</div> <!-- END WRAP -->
                
        <div id="footer">
            <div class="container">
                <p class="footer-info">Trung tâm Thông tin - Thư viện - Thiết bị
                                    <br/>Trường Cao đẳng Cộng đồng Bình Thuận</p>
            </div>
        </div>
        
        
        		    
<script type="text/javascript" src="<?php echo $sysconf['template']['dir'].'/'.$sysconf['template']['theme']; ?>/js/supersized.3.2.7.min.js"></script>
<script type="text/javascript" src="./js/highlight.js"></script>
<script type="text/javascript">

$(document).ready(function()
{
  $('#keyword').keyup(function(){
    $('#title').val();
    $('#title').val($('#keyword').val());
  });

  $('#title').keyup(function(){
    $('#keyword').val();
    $('#keyword').val($('#title').val());
  });

  $('#advSearchForm input').attr('autocomplete','off');
  $('#title').attr('style','');

  $('#show_advance').click(function(){
    if ($("#advance-search").is(":hidden"))
    {
      $("#advance-search").slideDown('normal');
      $('#simply-search').slideUp('normal');
    } else {
      $("#advance-search").slideUp('normal');
      $('#simply-search').slideDown('normal');
    }
  });

  $('#title').keypress(function(e){
    if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
      this.form.submit();
    }
  });

  $(window).load(function () {
    $('#keyword').focus();
  });

  function mycarousel_initCallback(carousel)
  {
    // Disable autoscrolling if the user clicks the prev or next button.
    carousel.buttonNext.bind('click', function() {
      carousel.startAuto(0);
    });

    carousel.buttonPrev.bind('click', function() {
      carousel.startAuto(0);
    });

    // Pause autoscrolling if the user moves with the cursor over the clip.
    carousel.clip.hover(function() {
      carousel.stopAuto();
    }, function() {
      carousel.startAuto();
    });
  };

  jQuery('#topbook').jcarousel({
      auto: 5,
      wrap: 'last',
      initCallback: mycarousel_initCallback
  });

  jQuery('.container .item .detail-list, .coll-detail .title, .abstract, .coll-detail .controls').highlight(<?php echo $searched_words_js_array; ?>);

});
</script>
    </body>
</html>
