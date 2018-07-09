$(document).ready(function() {
										
			//SIZING OF MOBILE HEADER-WRAP//
			
			function sizeMobileHeader() {		
				if ($("#hamburger span").height() == 45) {
					$("#mobile-header-wrap").css("height","70px");
				} else {
					$("#mobile-header-wrap").css("height","145px");
				}
				//alert('size-mobile-header function');
			}
			
			//HORIZONTAL RESIZE FUNCTION: SIZES DISPLAY IMAGE DIV AND MOBILE-HEADER WRAP WIDTH//
			
			function horizontalResize() {
				$("#display-image").css("width",$(window).width() - $("#gallery").width() - 30);
				//alert('horizontal-resize function');
			}
						
			//VERTICAL RESIZE FUNCTION: SETS DISPLAY IMAGE DIV HEIGHT//
			
			function verticalResize() {
				$("#display-image").css("height",$(window).height() - $("#bottom-gallery").height() -12 - $("#mobile-header-wrap").height());
				//alert('vertical-resize function');

			}
							
			//WINDOW RESIZE FUNCTION	
			
			$(window).resize(function() {
				horizontalResize();						
				verticalResize();	
				sizeMobileHeader();
			});
		
			//GALLERY FUNCTIONALITY//
			$(".thumb-link").bind("mouseenter touchstart", function(){
			//$(document).on('mouseenter','.thumb-link',function(e){
				$(this).append("<img src='assets/images/svgs/select-square.svg' class='hover-image' style='opacity:1;'>");
			});
			$(".thumb-link").bind("mouseleave touchend", function(){
			//$(document).on('mouseleave','.thumb-link',function(e){
				$(this).find(".hover-image").remove();
			});			
			
			//MENU FUNCTIONALITY//
			
            $("#hamburger").click(function(event) {
                event.preventDefault();
                $("#more-info-wrap").addClass("opened");
            });
            $("#close-x").click(function(event) {
                event.preventDefault();
                $("#more-info-wrap").removeClass("opened");
            });		
	   
        });