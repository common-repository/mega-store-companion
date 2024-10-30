wp.customize.controlConstructor['themefarmer-range'] = wp.customize.Control.extend({

    ready: function() {
        'use strict';
        var control = this;
  		var container = this.container;
        var responsive = control.params.responsive;
        var data_collector = container.find('.themefarmer-range-data');
        // data_collector.val(45345345);


        function updateValue() {
        	// console.log('fired');
        	var values = {};
        	if(responsive === true){
        		var desk_selector = container.find('.themefarmer-range-slider[data-device=desktop]');
        		var tabl_selector = container.find('.themefarmer-range-slider[data-device=tablet]');
        		var mobl_selector = container.find('.themefarmer-range-slider[data-device=mobile]');
        		if(desk_selector.length){
        			values.desktop = desk_selector.val();
        		}
        		if(tabl_selector.length){
        			values.tablet = tabl_selector.val();
        		}
        		if(mobl_selector.length){
        			values.mobile = mobl_selector.val();
        		}
        		data_collector.val(JSON.stringify(values)); 
        	}else{
        		var value = container.find('.themefarmer-range-slider').val();
        		data_collector.val(value); 
        	}
            data_collector.trigger('change');
        	
        }

        updateValue();
        // control.find('.themefarmer-range-data')
        $(document).on('input change', '.themefarmer-range-slider', function(event) {
            var value = $(this).val();
            $(this).siblings('.themefarmer-range-value').val(value);
        	updateValue();
        	// console.log('range');
            /*
            var device = $(this).data('device');
            var $data_collector = $(this).parents('.themefarmer-range-slider-controls-con').find('.themefarmer-range-data');
            if(responsive === true){
            	var previousVal = $data_collector.val();
	            if (isNaN(previousVal)) {
	                fontSize = JSON.parse(previousVal);
	            }
	            fontSize[device] = value;
	            $data_collector.val(JSON.stringify(fontSize));
            }else{
            	$data_collector.val(value);
            }
            $data_collector.trigger('change');*/

        });

        $(document).on('input change', '.themefarmer-range-value', function(event) {
            var value = $(this).val();
            $(this).siblings('.themefarmer-range-slider').val(value);
        	updateValue();
        	// console.log('value');
            /*var value = $(this).val();
            var device = $(this).data('device');
            var $data_collector = $(this).parents('.themefarmer-range-slider-controls-con').find('.themefarmer-range-data');
            if(responsive === true){
            	var previousVal = $data_collector.val();
	            if (isNaN(previousVal)) {
	                fontSize = JSON.parse(previousVal);
	            }
	            fontSize[device] = value;
	            $data_collector.val(JSON.stringify(fontSize));
            }else{
            	$data_collector.val(value);
            }
            $data_collector.trigger('change');*/
        });


        $(document).on('click', '.range-slider-reset', function(event) {
            var value = $(this).data('value');
            $(this).siblings('.themefarmer-range-slider').val(value);
            $(this).siblings('.themefarmer-range-value').val(value).trigger('change');
        });

        $(document).on('click', '.themefarmer-device-controls button', function(event) {
            var device = $(this).data('device');
            $(this).parent().siblings('.themefarmer-range-slider-controls-con').find('.themefarmer-range-slider-controls').removeClass('active');
            $(this).parent().siblings('.themefarmer-range-slider-controls-con').find('.themefarmer-range-slider-controls.range-slider-' + device).addClass('active');
            $(document).find('.themefarmer-device-controls').children('button').removeClass('active');
            $(document).find('.themefarmer-device-controls').children('button.preview-' + device).addClass('active');
            $('.wp-full-overlay-footer .devices').find('button.preview-' + device).trigger('click');
        });




    },
    /*updateValue:function(control) {
    	
    }*/
});