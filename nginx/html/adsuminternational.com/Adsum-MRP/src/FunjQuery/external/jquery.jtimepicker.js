/*
 * jTimepicker plugin 1.4.1
 *
 * http://www.radoslavdimov.com/jquery-plugins/jquery-plugin-jtimepicker/
 *
 * Copyright (c) 2009 Radoslav Dimov
 *
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 * Depends:
 *      ui.core.js
 *      ui.slider.js
 */

(function($) {
    $.fn.extend({
		
        jtimepicker: function(options) {
            
            var defaults = {
                clockIcon: 'temas/themes/redmond/images/icon_clock_2.gif',
                orientation: 'horizontal',
                // set hours
                hourCombo: 'hourcombo',
                hourMode: 13,
                hourminMode: 1,
                hourInterval: 1,
                hourDefaultValue: 1,
                hourSlider: 'hourSlider',
                hourLabel: 'hora',
                // set minutes
                minCombo: 'mincombo',
                minLength: 60,
                minLengthmin: 0,
                minInterval: 5,
                minDefaultValue: 0,
                minSlider: 'minSlider',
                minLabel: 'min.',
                // set seconds
                secView: false,
                secCombo: 'seccombo',
                secLength: 60,
                secLengthmin: 0,
                secInterval: 5,
                secDefaultValue: 0,
                secSlider: 'secSlider',
                secLabel: 'sec',
            	// set AMPM
            	ampmView: true,
            	ampmCombo: 'ampmcombo',
        		ampmDefaultValue: 1
            };

            var options = $.extend(defaults, options);
            
            return this.each(function() {
                var o = options;
                var $this = $(this);
                var html = '';
                var orientation = (o.orientation == 'horizontal') ? 'auto' : 'vertical';
                var sliderData = [
                                    {'label':o.hourLabel, 'slider':o.hourSlider, 'combo':o.hourCombo},
                                    {'label':o.minLabel, 'slider':o.minSlider, 'combo':o.minCombo}
                                    ];

                
                
                html += $this.createCombo(o.hourCombo, o.hourminMode, o.hourMode, o.hourInterval, o.hourDefaultValue);
                html += $this.createCombo(o.minCombo, o.minLengthmin, o.minLength, o.minInterval, o.minDefaultValue);
                if (o.secView) {
                    sliderData.push({'label':o.secLabel, 'slider':o.secSlider, 'combo':o.secCombo});
                    html += $this.createCombo(o.secCombo, o.secLengthmin, o.secLength, o.secInterval, o.secDefaultValue);
                }
                
                if (o.ampmView) {
                    html += $this.createAMPMCombo(o.ampmCombo, o.ampmDefaultValue);
                }
                
                html += '<img src="' + o.clockIcon + '" align="middle" class="clock" />';
                html += $this.createSliderWrap(sliderData);
                $this.html(html);
                
                $('#sliderWrap').addClass(orientation);
                
                $this.createSlider(o.hourSlider, o.hourminMode, o.hourMode, o.hourCombo, o.hourInterval, o.hourDefaultValue, o.orientation);
                $this.createSlider(o.minSlider, o.minLengthmin, o.minLength, o.minCombo, o.minInterval, o.minDefaultValue, o.orientation);
                if (o.secView) {
                    $this.createSlider(o.secSlider, o.secLengthmin, o.secLength, o.secCombo, o.secInterval, o.secDefaultValue, o.orientation);
                }

                $.each(sliderData, function(i, item) {
                    $('.' + item.combo).change(function() {
                        var val = $(this).val();
                        $('.' + item.slider).slider('option', 'value', val);
                    });
                });                

                $this.find('.clock').click(function() {
                    $this.find('#sliderWrap').toggle(function() {
                        $(document).click(function(event) {
                            if (!($(event.target).is('#sliderWrap') || $(event.target).parents('#sliderWrap').length || $(event.target).is('.clock'))) {
                                $this.find('#sliderWrap').hide(500);
                            }
                        });
                    });  
                });              
            }); 
        }     
    });

    $.fn.createCombo = function(id, min, length, interval, defValue) {
        var html = '<select class="' + id + ' combo" name="' + id + '">';
        for(i = min; i < length; i += interval) {
            var selected = i == defValue ? ' selected="selected"' : '';
            var txt = i < 10 ? '0' + i : i;
            if(i < 10)
            	html += '<option value="0' + i + '"' + selected + '>' + txt + '</option>';
            else
            	html += '<option value="' + i + '"' + selected + '>' + txt + '</option>';
        }
        html += "</select>";

        return html;
    }

    $.fn.createAMPMCombo = function(id, defValue) {
    	var selectedam;
    	var selectedpm;
    	
        var html = '<select class="' + id + ' combo" name="' + id + '">';
        if(defValue == 1)
        	selectedam = 'selected="selected"';
        else
        	selectedpm = 'selected="selected"';
        
        html += '<option value="1"' + selectedam + '>am</option>';
        html += '<option value="2"' + selectedpm + '>pm</option>';
        html += "</select>";

        return html;
    }
    
    $.fn.createSliderWrap = function(data) {
        var html = '<div id="sliderWrap">';
        $.each(data, function(i, item) {
            html += '   <div><label>' + item.label + ':</label> <p class="' + item.slider + '"></p></div>';
        });
            html += '</div>';

        return html;
    }

    $.fn.createSlider = function(id, minValue, maxValue, combo, stepValue, defValue, orientation) {
        var $this = $(this);
        $this.find('.' + id).slider({
            orientation: orientation,
            range: "min",
            min: minValue,
            max: maxValue - stepValue,
            value: defValue,
            step: stepValue,
            animate: true ,
            slide: function(event, ui) {
                $this.find('.' + combo).val(ui.value);
            }            
        });
    }


})(jQuery);
