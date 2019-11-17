(function ($) {
	"use strict";

	$(document).ready(function () {
		thim_courses_collection.init();
	});

	var thim_courses_collection = window.thim_courses_collection = {

		init: function () {
			var $frame = $('.collection-frame');

			$frame.each(function (index, ele) {

				$next = $prev = null;

				if ($(ele).parent().hasClass('squared-courses-collection')) {
					var $next = $(ele).find('.controls .next');
					var $prev = $(ele).find('.controls .prev');
				}

				$(ele).sly({
					horizontal   : 1,
					itemNav      : 'centered',
					smart        : 1,
					scrollBy     : 1,
					mouseDragging: true,
					swingSpeed   : 0.2,
					scrollBar    : $(ele).parent().find('.scrollbar'),
					dragHandle   : true,
					touchDragging: true,
					clickBar     : 1,
					elasticBounds: false,
					speed        : 400,
					startAt      : 0,
					nextPage     : $next,
					prevPage     : $prev
				});
			});
		}
	}

})(jQuery);