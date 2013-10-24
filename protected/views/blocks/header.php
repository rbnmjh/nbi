<div class="header_top">
	<div class="page_wrap">
		<ul class="social_icon">
			<li><a href="https://www.facebook.com" title="Facebook">f</a></li>
			<li><a href="#" title="Twitter">l</a></li>
			<li><a href="#" title="Google+">g</a></li>
			<li class="last" title="Linkedin"><a href="#">n</a></li>
		</ul>
	</div>
</div><!-- end header_top -->
<div class="main_header">
	<div class="page_wrap">
		<nav id="nav">
			<ul>
				<?php $home_url =Yii::app()->baseUrl;
					  $about_url=Yii::app()->baseUrl.'/page/pages/about-us';
				 ?>
				<li><a href="<?php echo $home_url;?>" title="Home" class="active">Home</a></li>				
				<li> <a href="<?php echo $about_url;?>" title="About">About</a></li>
				<li><a href="#" title="Activities">Activites</a></li>
				<li><a href="#" title="Services">Services</a></li>
				<li><a href="#" title="Partner">Partner</a></li>
				<li><a href="#" title="Contact">Contact</a></li>
				<li><a href="#" title="CSR">CSR</a></li>
				<li class="last" title="Publication"><a href="#">Publication</a></li>
			</ul>
		</nav><!-- end nav -->
		<div id="logo">
			<h1><a href="index.html" title="NBI">NBI</a></h1>
		</div><!-- end logo -->
	</div>
</div><!-- end main_header -->