<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>
		<?php echo __('PicHub'); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Le styles -->
	<?php echo $this->Html->css('bootstrap.min'); ?>
	<?php //echo $this->Html->css('/usermgmt/css/umstyle'); ?>
        <?php echo $this->Html->script(array('jquery', 'jquery-ui')); ?>
        <?php echo $this->Html->css('jquery-ui.css'); ?>
        <script>

        $(function() {
            $('form').submit(function() {
        	$(this).submit(function () {
        	    return false;});
        	});
        });

        jQuery(function($){
	    $("#datepicker").datepicker({
		dateFormat: 'yy-mm-dd'
	    });
        });
        </script>
	<style>
        html,
        body {
          height: 100%;
          /* The html and body elements cannot have any padding or margin. */
        }
	#wrap {
	        min-height: 100%;
	        height: auto !important;
	        height: 100%;
	        /* Negative indent footer by it's height */
	        margin: 0 auto -60px;	
	}
        #push,
        #footer {
               height: 60px;
        }
        #footer {
               background-color: #f5f5f5;
        }
        @media (max-width: 767px) {
          #footer {
	            margin-left: -20px;
	            margin-right: -20px;
	            padding-left: 20px;
	            padding-right: 20px;
	          }
	}
	body {
		padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
	}
	</style>
	<?php echo $this->Html->css('bootstrap-responsive.min'); ?>

	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Le fav and touch icons -->
	<!--
	<link rel="shortcut icon" href="/ico/favicon.ico">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="/ico/apple-touch-icon-57-precomposed.png">
	-->
	<?php
	echo $this->fetch('meta');
	echo $this->fetch('css');
	?>
</head>

<body>

	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="#"><?php echo __('PicHub (beta)'); ?></a>
				<div class="nav-collapse">
					<ul class="nav">
                                                <?php if(isset($authUser)): ?> 
						<?php   echo "<li><a href=\"".$this->webroot."dashboard"."\">Home</a></li>"; ?>
                                                <?php   if(isAdminUser($authUser)): ?> 
						<?php     echo "<li><a href=\"".$this->webroot."projects\">Projects</a></li>"; ?>
						<?php     echo "<li><a href=\"".$this->webroot."users\">Users</a></li>"; ?>
	                                        <?php   endif; ?>
	                                        <?php if(isAdminUser($authUser)): ?>
						<?php echo "<li><a href=\"".$this->webroot."allGroups\">Groups</a></li>"; ?>
						<?php echo "<li><a href=\"".$this->webroot."permissions?c=-1\">Permissions</a></li>"; ?>
	                                        <?php endif; ?>
	                                        <?php endif; ?>

	<!--
                                               	<li><a href="<?php echo $this->webroot.'/about' ?>">About</a></li>
						<li><a href="<?php echo $this->webroot.'/contact' ?>">Contact</a></li>
-->
					</ul>
                                        <ul class="nav pull-right">
                                        <li class="dropdown" >
                                            <a class="dropdown-toggle"
                                               data-toggle="dropdown"
                                               href="#">
                                                  <?php
                                        	  if(isset($authUser)) {
                                        	          echo $authUser['User']['username'];
                                        	  }
                                        	  else echo "Guest";
                                                  ?>
                                                <b class="caret"></b>
                                              </a>
                                            <ul class="dropdown-menu pull-right">
                                                  <?php
                                                  if(isset($authUser)) {
                                                          echo "<li><a href=\"".$this->webroot."users/view/".$authUser['User']['id']."\">プロフィール確認</a></li>";
                                                          echo "<li><a href=\"".$this->webroot."users/edit/".$authUser['User']['id']."\">プロフィール編集</a></li>";
                                                          echo "<li><a href=\"".$this->webroot."changePassword"."\">パスワード変更</a></li>";
                                                          echo "<li class='divider'></li>";
                                                          echo "<li><a href=\"".$this->webroot."logout"."\">Logout</a></li>";
                                                  }
                                        	  else {
                                        	      echo "<li><a href=\"".$this->webroot."/login"."\">Login</a></li>";
                                                      echo "<li><a href=\"".$this->webroot."/register"."\">Registration</a></li>";
                                        	  }
                                                  ?>
                                              <!-- links -->
                                            </ul>
                                          </li>
                                        </ul>

				</div><!--/.nav-collapse -->
<!--
                                <div class="notices pull-right">
                                        <?php
	                                if(isset($authUser)) {
	                                        echo "<p class=\"navbar-text\">".$authUser['User']['username']."</p>";
					}
	                                else echo "<p class=\"navbar-text\">Guest</p>"
                                        ?>
                                </div>
-->
			</div>
		</div>
	</div>


        <div id="wrap">
	    <div class="container">

	    	<!--<h1>Bootstrap starter template</h1>-->

	    	<?php echo $this->Session->flash(); ?>

	    	<?php echo $this->fetch('content'); ?>

	    </div> <!-- /container -->
          <div id="push"></div>
	</div>

<div id="footer">
  <div class="container" align="center">
     <p><small>(c) copyright 2013 株式会社Freedom Speech.</small></p>
  </div>
</div>
	<!-- Le javascript
    ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
	<?php echo $this->Html->script('bootstrap.min'); ?>
	<?php echo $this->fetch('script'); ?>

</body>
</html>
