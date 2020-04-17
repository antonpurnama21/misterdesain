<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]>
<!--><html class="no-js" lang="en"><!--<![endif]-->
<head>

	<!-- Page header
	================================================== -->
	<meta charset="utf-8">	
	<meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta name="author" content=""/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
	<!-- Page Title
	================================================== -->
	<title><?=$titleWeb?></title>
	
	<!-- CSS
	================================================== -->
	
	<!--A dead simple, responsive boilerplate-->
	<link rel="stylesheet" href="<?=base_url('assets-public/')?>css/base.css"/>
	<link rel="stylesheet" href="<?=base_url('assets-public/')?>css/skeleton.css"/>	
	
	<!--Icon font-->
	<link rel="stylesheet" href="<?=base_url('assets-public/')?>css/font-awesome.min.css" />
	<link rel="stylesheet" href="<?=base_url('assets-public/')?>fonts/Icon-font-7/pe-icon-7-stroke.css" />
	<link rel="stylesheet" href="<?=base_url('assets-public/')?>fonts/etlinefont/etlinefont.css" />
	<link rel="stylesheet" href="<?=base_url('assets-public/')?>css/owl.carousel.css"/>
	<link rel="stylesheet" href="<?=base_url('assets-public/')?>css/animsition.min.css"/>
	<link rel="stylesheet" href="<?=base_url('assets-public/')?>css/magnific-popup.css"/>
	<link rel="stylesheet" href="<?=base_url('assets-public/')?>css/index-carousel-slider.css"/>
	<link rel="stylesheet" href="<?=base_url('assets-public/')?>css/magnific-popup.css"/>
	<link rel="stylesheet" href="<?=base_url('assets-public/')?>css/style.css"/>

	<?php if(isset($_CSS) and !empty($_CSS)) echo $_CSS; ?>
	
	<!-- Favicons
	================================================== -->
	
	<link rel="shortcut icon" href="favicon.png">
	<link rel="apple-touch-icon" href="apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="apple-touch-icon-114x114.png">

	<style>
		/* Hide the file input using
		opacity */
		[type=file] {
			position: absolute;
			filter: alpha(opacity=0);
			opacity: 0;
		}
		input,
		[type=file] + label {
		border: 1px solid #CCC;
		border-radius: 3px;
		text-align: left;
		padding: 10px;
		width: 150px;
		margin: 0;
		left: 0;
		position: relative;
		}
		
		[type=file] + label {
		text-align: center;
		left: 0em;
		top: 0.5em;
		/* Decorative */
		background: #333;
		color: #fff;
		border: none;
		cursor: pointer;
		}
		[type=file] + label:hover {
		background: #3399ff;
		}
	</style>
		
</head>
<body>	
	
	<div class="animsition" data-animsition-in="fade-in" data-animsition-out="fade-out">
	
		<!-- Navigation panel
		================================================== -->		
		<?php $this->load->view('partials/public_nav')?>
		<!-- End Navigation panel -->
		 
		<!-- MAIN CONTENT
		================================================== -->		
		<main class="cd-main-content">
			
			<!-- HOME SECTION
			================================================== -->
			<?= $body ?>

			<!-- FOOTER
			================================================== -->	
			<?php $this->load->view('partials/public_footer')?>
	
		</main>		
		
	</div>
	
	<!-- JAVASCRIPT
    ================================================== -->
<script type="text/javascript" src="<?=base_url('assets-public/')?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?=base_url('assets-public/')?>js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="<?=base_url('assets-public/')?>js/modernizr.custom.js"></script> 
<script type="text/javascript" src="<?=base_url('assets-public/')?>js/jquery.sticky.js"></script>
<script type="text/javascript" src="<?=base_url('assets-public/')?>js/jquery.countTo.js"></script>
<script type="text/javascript" src="<?=base_url('assets-public/')?>js/jquery.appear.js"></script>
<script type="text/javascript" src="<?=base_url('assets-public/')?>js/jquery.easing.js"></script>	
<script type="text/javascript" src='<?=base_url('assets-public/')?>js/smooth-scroll.js'></script>
<script type="text/javascript" src="<?=base_url('assets-public/')?>js/owl.carousel.min.js"></script>
<script type='text/javascript' src="<?=base_url('assets-public/')?>js/jquery.magnific-popup.min.js"></script>
<script type="text/javascript" src="<?=base_url('assets-public/')?>js/jquery.parallax-1.1.3.js"></script>
<script type="text/javascript" src="<?=base_url('assets-public/')?>js/scrollReveal.min.js"></script>
<script type="text/javascript" src="<?=base_url('assets-public/')?>js/TweenMax.min.js"></script>
<script type="text/javascript" src="<?=base_url('assets-public/')?>js/share.js"></script>
<script type="text/javascript" src="<?=base_url('assets-public/')?>js/jquery.animsition.min.js"></script>

<script type="text/javascript">
(function($) { "use strict";
	$(document).ready(function() {

		$("[type=file]").on("change", function(){
		// Name of file and placeholder
		var file = this.files[0].name;
		var dflt = $(this).attr("placeholder");
		if($(this).val()!=""){
			$(this).next().text(file);
		} else {
			$(this).next().text(dflt);
		}
		});
	  
	  $(".animsition").animsition({
	  
		inClass               :   'fade-in',
		outClass              :   'fade-out',
		inDuration            :    1500,
		outDuration           :    800,
		linkElement           :   '.animsition-link', 
		// e.g. linkElement   :   'a:not([target="_blank"]):not([href^=#])'
		loading               :    true,
		loadingParentElement  :   'body', //animsition wrapper element
		loadingClass          :   'animsition-loading',
		unSupportCss          : [ 'animation-duration',
								  '-webkit-animation-duration',
								  '-o-animation-duration'
								],
		//"unSupportCss" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser. 
		//The default setting is to disable the "animsition" in a browser that does not support "animation-duration".
		
		overlay               :   false,
		
		overlayClass          :   'animsition-overlay-slide',
		overlayParentElement  :   'body'
	  });
	});  
})(jQuery);
</script>

<script type="text/javascript" src="<?=base_url('assets-public/')?>js/jquery.hoverdir.js"></script>
<script type="text/javascript" src="<?=base_url('assets-public/')?>js/script.js"></script> 
<script type="text/javascript" src="<?=base_url('assets-public/')?>js/index-carousel-slider.js"></script>
<?php if(isset($_JS) and !empty($_JS)) echo $_JS; ?>
<script type="text/javascript">
(function($) { "use strict";
	$(document).ready(function() {
		
		//About section block image height
		bx6_image_height();
			
		/* about hoverdir
		================================================= */		
		$('.about-bx2').each( function() { $(this).hoverdir(); } );
		
		/* Service hoverdir
		================================================= */		
		$('.service-block').each( function() { $(this).hoverdir(); } );
		
	});  	
	$(window).resize(function(){        
		bx6_image_height();
	});
	
	function bx6_image_height(){
		var bx6_image_height = $('.bx6_content').outerHeight();		
		$(".bx6_image").css("height", bx6_image_height);
	}
})(jQuery);
</script>
<!-- End Document
================================================== -->
</body>
</html>