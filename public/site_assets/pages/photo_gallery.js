var PhotoGallery = function () {

	var mixGrid = function () {
		 $('.mix-grid').mixitup();						 		
	}
	
    return {
        //main function to initiate the module
        init: function () {
            mixGrid();

        }

    };

}();

jQuery(document).ready(function() {    
	PhotoGallery.init();
});