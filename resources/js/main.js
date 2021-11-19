/* Custom-JS */

(function($){
	"use strict";
	
	/*$(document).ready(function(){  });*/
	
	jQuery(document).ready(function($){
		
		// Show & Hide any html block
		$.fn.BlockVisible = function(selector){
			if( $(selector).hasClass("d-none") ){ $(selector).removeClass("d-none"); }
		}
		$.fn.BlockHidden = function(selector){
			if( ! $(selector).hasClass('d-none') ){ $(selector).addClass('d-none'); }
		};
		
		
		$(document).on('click', function(e){
			e = e || window.Event;
			let target = e.target || e.srcElement;
			let targetClass = target.classList;
			
			// Hide Accordion-Item Remove-Icon
			if( target.id !== "removeAccordionItem-btn" && (! targetClass.contains("remove-accordion-item") ) ){
				$("#Accordion-Parent .accordion-item .remove-accordion-item").each(function(){
					$.fn.BlockHidden($(this));
				});
			}
			
			// Hide Parts-List
			if( ! targetClass.contains("item_name") ){
				$.fn.BlockHidden(".parts-purchase #Vehicle-Parts-List");
			}
			
		});
		
		
		// Escape-Key & Tab-Key - Exit from any block / window
		// $(document).on('keyup', function(e){});
		$(document).on('keydown', function(e){
			if( e.key === "Escape" ){
				// Hide Parts-List
				$.fn.BlockHidden(".parts-purchase #Vehicle-Parts-List");
			}
			
			if( e.key === "Tab" ){
				// Hide Parts-List
				$.fn.BlockHidden(".parts-purchase #Vehicle-Parts-List");
			}
		});
		
		
		// Header Navbar
		// $("#Site-Header .navbar-header .nav-link.dropdown-toggle");
		
		
		// For Date-Picker
		$(".date-select .input-date").datepicker({
			dateFormat: 'dd-mm-yy',
			changeMonth: true,
			changeYear: true,
			showOtherMonths: true,
			selectOtherMonths: false,
			showAnim: "slideDown",
		});
		$(".date-select .input-date").datepicker().on("show", function(e){
			if( ! $("body").hasClass("datepicker-timepicker") ){
				$("body").addClass("datepicker-timepicker");
			}
		});
		$(".date-select .input-date").datepicker().on("hide", function(e){
			if( $("body").hasClass("datepicker-timepicker") ){
				$("body").removeClass("datepicker-timepicker");
			}
		});
		
		
		// Overlay-Scrollbar
		$('.overlay-scrollbar').overlayScrollbars({
			className: "os-theme-dark",
			scrollbars: {
				autoHide: "leave",
				autoHideDelay: 300,
				clickScrolling: true,
				snapHandle: true,
			},
			overflowBehavior: {
				x: "hidden"
			}
		});
		
		
	
	});
}(jQuery));

