/* Custom-JS */

(function($){
	"use strict";
	
	/*$(document).ready(function(){  });*/
	
	jQuery(document).ready(function($){
		
		$(document).on('click', function(e){
			e = e || window.Event;
			let target = e.target || e.srcElement;
			let targetClass = target.classList;
			
			// Cancel-Remove-Icon-From-Accordion-Item
			if( target.id !== "removeAccordionItem-btn" && (! targetClass.contains("remove-accordion-item") ) ){
			// || ! target.closest(".remove-accordion-item")
				$("#accordionParent .accordion-item .remove-accordion-item").each(function(){
					if( ! $(this).hasClass("d-none") ){
						$(this).addClass("d-none");
					}
				});
			}
			
		});
		
		
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

