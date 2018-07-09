<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <head>
    <meta charset="UTF-8"> 
    <title>Kreg Art</title>
        <!--JQUERY-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <!--BOOTSTRAP CSS-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">   
        <!--BOOTSTRAP JAVASCRIPT-->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="css/styles.css">
		<link rel='shortcut icon' type='image/x-icon' href='favicon.ico' />    
	</head>
    
    <body>
	<?php

	//$mysqli = new mysqli("localhost","mylevtjd","4ZyiWXj7K3-?6","mylevtjd_mydatabase");
	
	$mysqli = new mysqli('localhost','root','root','mamp_database');
	
	if ($mysqli->connect_error) { 
		die('Database Error');
	}
		
	$results = $mysqli->query("SELECT * FROM kregart"); 
	
	$kregart_array = array();
	
	if ($results) {
		while ($kregart = mysqli_fetch_assoc($results)) {
			$kregart_array[] = $kregart;
		}
	}
		
	?>
    <!--GALLERY-->    
		<div class="col-md-2 hidden-sm hidden-xs" id="gallery">
			<h1 id="gallery-header"><img src="assets/images/titles/kregart-logo.svg" alt="Kreg Art logo"></h1>
			<h2><img src="assets/images/titles/select-gallery.svg" alt="Select an image"></h2>
			<div class="thumbnail-wrap" id="thumbnail-wrap">
			</div>
		</div>  
		
		<!--MOBILE HEADER-->    

		<div id="mobile-header-wrap"><h1 id="mobile-header"><img src="assets/images/titles/kregart-logo.svg" alt="Kreg Art logo"></h1></div>
		
		<!--DISPLAY IMAGE-->  		
		<div class="col-md-10 col-xs-12" id="display-image">
		</div>  
        <div id='expander-wrap'><a id='expander' class='glyphicon glyphicon-plus' data-toggle='collapse' href='#description' role='button' aria-expanded='false' aria-controls='description'></a></div>
		<!--BOTTOM GALLERY-->    
		<div id="bottom-gallery-wrap" class="col-xs-12 hidden-md hidden-lg"> 
			<h2><img src="assets/images/titles/select-gallery.svg" alt="Select an image"></h2>		
			<div id="bottom-gallery">
			</div>
		</div> 
    
    <!--MENU/NAV-->
       
   <a href="" id="hamburger" class=""><span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span></a>
    <div id="more-info-wrap">
	    <a href="" id="close-x"><span class="glyphicon glyphicon-remove-circle"></span></a>
        <section id="more-info">
			<h3><img src="assets/images/titles/welcome.svg" alt="Welcome"></h3>
			<img src="assets/images/kreg-square.jpg" alt="Kreg Zembal" id="kreg">
			<div id="more-info-text" class="vcard">
				<p>Hey, welcome to the site! I'm <span class="fn">Kreg</span>, here are some doodles for your viewing pleasure. If you have questions or comments feel free to <a href="mailto:kregzem@gmail.com">digitally mail me</a>, or check out my instagram @kregzembal.</a></p> 
				<p>I retain all rights to my artwork. Please contact me for information about it's use. </p>
				<p>Special thanks to the great <a href="http://mylesmalloy.com/">Myles Malloy</a> for this amazing website design. The countless hours go largely un-rewarded.
			</div>
		</section>
		<span id="credit"><p>Site by Myles Malloy <?php print date('Y');?> All rights reserved.</p></span>
    </div>
        <script src="js/script.js"></script>
		<script>
			var $kregartArray= <?php echo json_encode($kregart_array ); ?>;
			//console.log($kregartArray);
			
			//DETERMINE SITE STATE//
			
			if ($(window).width() <= 991) {
					$siteState = "vertical";
				} else {
					$siteState = "horizontal";
			}			
					
			//INITIAL SIZING OF MOBILE HEADER-WRAP//
			
			function sizeMobileHeader() {		
				if ($("#hamburger span").height() == 45) {
					$("#mobile-header-wrap").css("height","70px");
				} else {
					$("#mobile-header-wrap").css("height","145px");
				}
			}
			
			//HORIZONTAL RESIZE FUNCTION: SIZES DISPLAY IMAGE DIV AND MOBILE-HEADER WRAP WIDTH//
			
			function horizontalResize() {
				$("#display-image").css("width",$(window).width() - $("#gallery").width() - 30);
			}
						
			//VERTICAL RESIZE FUNCTION: SETS DISPLAY IMAGE DIV HEIGHT//
			
			function verticalResize() {
				$("#display-image").css("height",$(window).height() - $("#bottom-gallery").height() -12 - $("#mobile-header-wrap").height());

			}
			
			//THUMBNAILS FUNCTION//

			$kregartArray.reverse();
			
			$.each($kregartArray, function($kregartArray,$arrayItem) {
				
				//CONVERT ARRAY ITEMS INTO VARIABLES//
				$title = JSON.stringify($arrayItem['title']).replace(/\"/g, '');
				$url = JSON.stringify($arrayItem['url']).replace(/\"/g, '');
				$description = JSON.stringify($arrayItem['description']).replace(/\"/g, '');
				$dimension = JSON.stringify($arrayItem['dimension']).replace(/\"/g, '');
				$year = JSON.stringify($arrayItem['year']).replace(/\"/g, '');
				$svg = JSON.stringify($arrayItem['svg']).replace(/\"/g, '');
				
				if ($svg == 0) {
					$("#thumbnail-wrap").append("<a href='' class='thumb-link' id='image-" + $arrayItem['ID'] + "'><img src='assets/images/" + $url + "-thumb.jpg' alt='Thumbnail of " + $title + " by Kreg Zembal'></a>");
					$("#bottom-gallery").append("<a href='' class='thumb-link' id='image-" + $arrayItem['ID'] + "'><img src='assets/images/" + $url + "-thumb.jpg' alt='Thumbnail of " + $title + " by Kreg Zembal'></a>");
				} else {
					$("#thumbnail-wrap").append("<a href='' class='thumb-link' id='image-" + $arrayItem['ID'] + "'><img src='assets/images/svgs/" + $url + "-thumb.svg' alt='Thumbnail of " + $title + " by Kreg Zembal'></a>");
					$("#bottom-gallery").append("<a href='' class='thumb-link' id='image-" + $arrayItem['ID'] + "'><img src='assets/images/svgs/" + $url + "-thumb.svg' alt='Thumbnail of " + $title + " by Kreg Zembal'></a>");
				}	
			});
			
			setTimeout(function() {
				horizontalResize();
				verticalResize();	
				if ($siteState == "vertical") {
					$("#display-image").css("height" , $("#display-image").height() - 6.484);
				}
				sizeMobileHeader(); 
			},100);
						
			//END THUMBNAILS FUNCTION//
			
			//
			
			//RANDOM IMAGE FUNCTION//
			
			$randomizedKregartArray = $kregartArray.sort(function(a,b){return 0.5 - Math.random()});
			$arrayItem = $randomizedKregartArray[0];
			
				$title = JSON.stringify($arrayItem['title']).replace(/\"/g, '');
				$url = JSON.stringify($arrayItem['url']).replace(/\"/g, '');
				$description = JSON.stringify($arrayItem['description']).replace(/\"/g, '');
				$dimension = JSON.stringify($arrayItem['dimension']).replace(/\"/g, '');
				$year = JSON.stringify($arrayItem['year']).replace(/\"/g, '');
				$svg = JSON.stringify($arrayItem['svg']).replace(/\"/g, '');
			
			function setDimension() {
				if ($dimension =='') {
					$dimension = "equal";
				}else if ($dimension ==0){
					$dimension = "wide";
				}else {
					$dimension = "tall";
				}
			}
				
			function setYear(){		
				if ($year!="0000") {
					$year = ": " + $year;
				} else {
					$year = '';
				}
			}
				
			function setSvg(){				
				if ($svg == 0) {
					$url = "assets/images/" + $url + "-art.jpg";
				} else {
					$svg = " svg";
					$url = "assets/images/svgs/" + $url + "-art.svg";
				}				
			}
					
			function outputData() {
				$("#display-image").empty();
				$("#display-image").append("<img src='"+ $url + "' alt='"+ $title + " by Kreg Zembal.' class='" + $dimension +  $svg + "' style='opacity:0;'>");
				if ($description != '') {
					$("#display-image").append("<div id='collapse' class='timeout'><h4>" + $title + $year + "</h4><div class='collapse' id='description'><div class=''><div id='caption'><p>" + $description + "</p></div></div></div></div>");
				}
			}
		
			function giveOpacity() {
				if ($('#collapse').length){
					setTimeout(function() {
						$("#expander-wrap").css("opacity","1");
						$("#collapse").css("opacity","1");
					},500);
				} else {
					setTimeout(function() {									
						$("#expander-wrap").css("opacity","0");
						$("#collapse").css("opacity","0");
					},500);
				};
				setTimeout(function() {
					$("#display-image img").css("opacity","1");
				},500);
			};				
			setDimension();
			setYear();		
			setSvg();
			outputData();				
			giveOpacity();
			
			//END RANDOM IMAGE FUNCTION
			
			//
			
			//THUMB LINK FUNCTION (GET DISPLAY IMAGE)//
			
			$(document).on('click','.thumb-link',function(e){
			//$(".thumb-link").bind("click touchstart", function(e){
				e.preventDefault();			
				$("#display-image img").css("opacity","0");
				$("#collapse").css("opacity","0");
				$("#expander-wrap").css("opacity","0");
				$id = $(this).attr('id').replace('image-','');	
				setTimeout(function(){
					if ($("#expander").hasClass("glyphicon-minus")) {
						$("#expander").addClass("glyphicon-plus");
						$("#expander").removeClass("glyphicon-minus");
					}
					$.each($kregartArray, function($kregartArray,$arrayItem) {
						if ( $arrayItem['ID'] == $id ) {
							$title = JSON.stringify($arrayItem['title']).replace(/\"/g, '');
							$url = JSON.stringify($arrayItem['url']).replace(/\"/g, '');
							$description = JSON.stringify($arrayItem['description']).replace(/\"/g, '');
							$dimension = JSON.stringify($arrayItem['dimension']).replace(/\"/g, '');
							$year = JSON.stringify($arrayItem['year']).replace(/\"/g, '');
							$svg = JSON.stringify($arrayItem['svg']).replace(/\"/g, '');			
							setDimension();
							setYear();		
							setSvg();
							outputData();				
							giveOpacity();
							timeoutCheck();
						};							
					});
				},500);
			});
			
			//END THUMB LINK FUNCTION//
			
			//
			
			//CAPTION FUNCTIONALITY//
			
			function timeOut() {
				$("#collapse").addClass("timeout");	
			}
			
			function hide() {
				$(".timeout").addClass("disappear");
			}
			
			function removeShit() {
				$("#collapse").removeClass("timeout");
				$("#collapse").removeClass("disappear");
			}
			
			function timeoutCheck() {
				if ($('#collapse').hasClass("timeout")) {
					timeOut();
					setTimeout(function() {
						hide();
					},2500);
				} else {
					removeShit();
				}
			}
			
			timeoutCheck();
			
			$(document).on('click','#expander',function(e) {
				$(this).toggleClass("glyphicon-plus");
				$(this).toggleClass("glyphicon-minus");
				$("#collapse").toggleClass("timeout");
				timeoutCheck();
			});
		</script>
    </body>
</html>