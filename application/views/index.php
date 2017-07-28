<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    <link rel="icon" href="<?php echo base_url(); ?>assets/images/favicon.ico" type="image/x-icon" sizes="16x16">
	<title>Radio X Live</title>
	<!-- Include the libraries -->
	<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.3.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.radiocoplayer.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/wow.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
	<script>
	    new WOW().init();
    </script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/style.css" />
</head>
<body>
    <div id="wrapper">
    	<header>
        	<div class="container">
                <div class="Logo">
                    <a href="index.html"><img src="<?php echo base_url();  ?>assets/images/logo.png" alt="Logo" /></a>
                </div>
                <div class="HeaderRight">
                    <div class="SocialLinks">
                        <a target="_blank" href="#" class="Facebook"></a>
                        <a target="_blank" href="#" class="Instagram"></a>
                        <a target="_blank" href="#" class="Twitter"></a>
                    </div>
                    <nav>
                        <ul>
                            <li class="active"><a href="javascript:void(0);">Home</a></li>
                            <li><a href="#Screenshots">Screenshots</a></li>
                            <li><a href="#Download">Download</a></li>
                        </ul>
                    </nav>
                   
                </div>
	            <div class="clearfix"></div>
            </div>
        </header>
        <main>
        	<section id="Banner">
            	<div class="container">
                	<h1>Listen to Radio X</h1>
                    <p>Simple, nice and user-friendly application of best beats 24/7</p>
                        <div class="radioplayer"
                        data-src="<?php echo base_url();  ?>assets/http://streaming.radio.co/s92c7d0a0b/low"
                        data-autoplay="false"
                        data-playbutton="true"
                        data-volumeslider="true"
                        data-elapsedtime="true"
                        data-nowplaying="true"
                        data-showplayer="true"
                        data-volume="50"></div>
                        <!--data-bg="images/bg.png"
						data-image="images/image.png"-->
                    
                    <div class="DownloadLink">
                    	<a target="_blank" href="#"><img src="<?php echo base_url();  ?>assets/images/app-store.svg" alt="App Store"/></a>
                        <a target="_blank" href="#"><img src="<?php echo base_url();  ?>assets/images/google-play.svg" alt="Google Play"/></a>
                    </div>
                    <a href="#Screenshots" class="IconScroll"></a>
                </div>
            </section>
 
			<section id="Screenshots">
            	<div class="media">
                    <div class="container">
                        <div class="wow media-middle bounceInLeft" data-wow-offset="300" data-wow-duration="1s">
                            <img src="<?php echo base_url();  ?>assets/images/img-home.png" alt="Ios Application" class="img-responsive" />
                        </div>
                        <div class="wow media-body slideInRight" data-wow-offset="200">
                            <h1>Awesome home</h1>
                            <p>Choose between high/low and auto frequency depending upon your internet connection, take a good look at amazing ablum arts and don’t forget you can message us anytime, just drag that bottom bar.</p>
                        </div>
                    </div>
                </div>
                <div class="media">
                    <div class="container">
                        <div class="wow media-body slideInLeft" data-wow-offset="200" >
                            <h1>top 10 from the charts</h1>
                            <p>Find the top 10’s from the chart, and listen right away, not just the audio, but video also, see stats of a particular song.</p>
                        </div>
                        <div class="wow media-middle bounceInRight" data-wow-offset="300" data-wow-duration="1s">
                            <img src="<?php echo base_url();  ?>assets/images/img-top-list.png" alt="Ios Application" class="img-responsive" />
                        </div>
                    </div>
                </div>
                <div class="media">
                    <div class="container">
                        <div class="wow media-middle bounceInLeft">
                            <img src="<?php echo base_url();  ?>assets/images/img-menu.png" alt="Ios Application" class="img-responsive" />
                        </div>
                        <div class="wow media-body slideInRight" data-wow-offset="300" data-wow-duration="1s">
                            <h1>many MORE features</h1>
                            <p>Sometimes the simplest things are the hardest to find. So we created a new line for everyday life.</p>
                        </div>
                    </div>
                </div>
            </section>
            
            <section id="Download">
            	<div class="container">
                	<div class="wow TextArea fadeInUp">
	                	<h1>How Download the app?</h1>
    	                <p>Just download the app from the store.
Simple, nice and user-friendly application of killing your boredom and feel free with the power of music</p>

                        <div class="DownloadLink">
                            <a target="_blank" href="#"><img src="<?php echo base_url();  ?>assets/images/app-store.svg" alt="App Store"/></a>
                            <a target="_blank" href="#"><img src="<?php echo base_url();  ?>assets/images/google-play.svg" alt="Google Play"/></a>
                        </div>
                    </div>
                    
	            	<img src="<?php echo base_url();  ?>assets/images/img-download.png" alt="Download" class="imgDownload" />
                    
                </div>
            </section>
        </main>
        <footer>
        	<div class="container">
            	<div class="Logo"><img src="<?php echo base_url();  ?>assets/images/logo.png" alt="Logo"/></div>
                <div class="FooterRight">
                	<div class="SocialLinks">
                        <a target="_blank" href="#" class="Facebook"></a>
                        <a target="_blank" href="#" class="Instagram"></a>
                        <a target="_blank" href="#" class="Twitter"></a>
                    </div>
                    
                    <ul>
                        <li><a href="#">About us</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">APP COPYRIGHTS</a></li>
                    </ul>
                    <div class="clearfix"></div>
                    <p>&copy; 2017 All rights reserved. radiox.com by Synergistics <a href="#top" class="IconScroll up"></a></p>
                </div>
                <div class="clearfix"></div>
            </div>
        </footer>
    </div>
    <script>
    	//initialise the plugin with the element
		$('.radioplayer').radiocoPlayer();
    </script>
</body>
</html>
