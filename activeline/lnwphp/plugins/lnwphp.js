/** f0ska lnwphp v.1.6.20; 06/2014 */
/** object */
var lnwphp = {
	config: function(key) {
		if (lnwphp_config[key] !== undefined) {
			return lnwphp_config[key];
		} else {
			return key;
		}
	},
	lang: function(key) {
		if (lnwphp_config['lang'][key] !== undefined) {
			return lnwphp_config['lang'][key];
		} else {
			return key;
		}
	},
	current_task: null,
	request: function(container, data, success_callback) {
		//jQuery(container).trigger("lnwphpbeforerequest");
		jQuery(document).trigger("lnwphpbeforerequest", [container, data]);
		jQuery.ajax({
			type: "post",
			url: lnwphp.config('url'),
			beforeSend: function() {
				lnwphp.current_task = data.task;
				lnwphp.show_progress(container);
			},
			data: {
				"lnwphp": data
			},
			success: function(response) {
				jQuery(container).html(response);
				//jQuery(container).trigger("lnwphpafterrequest");
				jQuery(document).trigger("lnwphpafterrequest", [container, data]);
				if (success_callback) {
					success_callback(container);
				}
			},
			complete: function() {
				lnwphp.hide_progress(container);
			},
			dataType: "html",
			cache: false
		});
	},
	new_window_request: function(container, data) {
		var html = lnwphp.data2form(data);
		var w = window.open("", "lnwphp_request", "scrollbars,resizable,height=400,width=600");
		w.document.open();
		w.document.write(html);
		w.document.close();
		jQuery(w.document.body).find('form').submit();
	},
	data2form: function(data) {
		var html = '<!DOCTYPE HTML><html><head><meta http-equiv="content-type" content="text/html;charset=utf-8" /></head><body>';
		html += '<form method="post" action="' + lnwphp.config('url') + '">';
		jQuery.map(data, function(value, key) {
			if (!jQuery.isPlainObject(value)) {
				html += '<input type="hidden" name="lnwphp[' + key + ']" value="' + value + '" />';
			}
		});
		html += '</form></body></html>';
		return html;
	},
	unique_check: function(container, data, success_callback) {
		data.unique = {};
		data.task = "unique";
		if (jQuery(container).find('.lnwphp-input[data-unique]').size()) {
			jQuery(container).find('.lnwphp-input[data-unique]').each(function(index, element) {
				data.unique[jQuery(element).attr('name')] = jQuery(element).val();
			});
			jQuery.ajax({
				type: "post",
				url: lnwphp.config('url'),
				beforeSend: function() {
					lnwphp.show_progress(container);
				},
				data: {
					"lnwphp": data
				},
				dataType: "json",
				success: function(response) {
					//jQuery(container).find(".lnwphp-data[name=key]:first").val(response.key);
					if (response.error) {
						jQuery(container).find(response.error.selector).addClass('validation-error');
						//alert(lnwphp.lang('unique_error'));
						lnwphp.show_message(container, lnwphp.lang('unique_error'), 'error');
						return false;
					}
					if (success_callback) {
						success_callback(container);
					}
				},
				complete: function() {
					lnwphp.hide_progress(container);
				},
				cache: false
			});
		} else {
			if (success_callback) {
				success_callback(container);
			}
		}
	},
	show_progress: function(container) {
		jQuery(container).closest(".lnwphp").find(".lnwphp-overlay").width(jQuery(container).closest(".lnwphp-container").width()).stop(true, true).fadeTo(300, 0.6);
	},
	hide_progress: function(container) {
		jQuery(container).closest(".lnwphp").find(".lnwphp-overlay").stop(true, true).css("display", "none");
	},
	get_container: function(element) {
		return jQuery(element).closest(".lnwphp-ajax");
	},
	list_data: function(container, element) {
		var data = {};
		lnwphp.validation_error = 0;
		lnwphp.save_editor_content(container);
		jQuery(container).find(".lnwphp-data").each(function() {
			if (lnwphp.check_container(this, container)) {
				data[jQuery(this).attr("name")] = lnwphp.prepare_val(this);
			}
		});
        if (element && jQuery.isPlainObject(element)) {
			jQuery.extend(data, element);
		} else if (element) {
			jQuery.extend(data, jQuery(element).data());
		}
		data.postdata = {};
        var validation = data.task == 'save' ? true : false;
        if(validation){
            jQuery(document).trigger("lnwphpbeforevalidate",[container]);
        }
		jQuery(container).find('.lnwphp-input:not([type="checkbox"],[type="radio"],[disabled])').each(function() {
			if (lnwphp.check_container(this, container)) {
				var val = lnwphp.prepare_val(this);
				data.postdata[jQuery(this).attr("name")] = val;
				var required = jQuery(this).data('required');
				var pattern = jQuery(this).data('pattern');
				if (validation && required && !lnwphp.validation_required(val, required)) {
					lnwphp.validation_error = 1;
					jQuery(this).addClass('validation-error');
				} else if (validation && pattern && !lnwphp.validation_pattern(val, pattern)) {
					lnwphp.validation_error = 1;
					jQuery(this).addClass('validation-error');
				} else {
					jQuery(this).removeClass('validation-error');
				}
			}
		});
		jQuery(container).find('.lnwphp-input[data-type="checkboxes"]:not([disabled])').each(function() {
			if (data.postdata[jQuery(this).attr("name")] === undefined) {
				data.postdata[jQuery(this).attr("name")] = '';
			}
			if (lnwphp.check_container(this, container) && jQuery(this).prop('checked')) {
				if (!data.postdata[jQuery(this).attr("name")]) {
					data.postdata[jQuery(this).attr("name")] = lnwphp.prepare_val(this);
				} else {
					data.postdata[jQuery(this).attr("name")] += "," + lnwphp.prepare_val(this);
				}
			}
		});
		jQuery(container).find('.lnwphp-input[type="radio"]:not([disabled])').each(function() {
			if (lnwphp.check_container(this, container) && jQuery(this).prop('checked')) {
				data.postdata[jQuery(this).attr("name")] = lnwphp.prepare_val(this);
			}
		});
		jQuery(container).find('.lnwphp-input[data-type="bool"]:not([disabled])').each(function() {
			if (lnwphp.check_container(this, container)) {
				data.postdata[jQuery(this).attr("name")] = jQuery(this).prop('checked') ? 1 : 0;
			}
		});
		jQuery(container).find(".lnwphp-searchdata.lnwphp-search-active").each(function() {
			if (lnwphp.check_container(this, container)) {
				data[jQuery(this).attr("name")] = lnwphp.prepare_val(this);
			}
		});
		
        if(validation){
            jQuery(document).trigger("lnwphpaftervalidate",[container,data]);
        }
		return data;
	},
	list_controls_data: function(container, element) {
		var data = {};
		jQuery(container).find(".lnwphp-data").each(function() {
			if (lnwphp.check_container(this, container)) {
				data[jQuery(this).attr("name")] = lnwphp.prepare_val(this);
			}
		});
		return data;
	},
	check_container: function(element, container) {
		return jQuery(element).closest(".lnwphp-ajax").attr('id') == jQuery(container).attr('id') ? true : false;
	},
	save_editor_content: function(container) {
		if (jQuery(container).find('.lnwphp-texteditor').size()) {
			if (typeof(tinyMCE) != 'undefined') {
				tinyMCE.triggerSave();
/*for (instance in tinyMCE.editors) {
					if (tinyMCE.editors[instance] && isNaN(instance * 1)) {
						if (jQuery('#' + instance).size()) {
							tinyMCE.editors[instance].save();
						} else {
							//tinyMCE.editors[instance].destroy();
							//tinyMCE.editors[instance] = null;
						}
					}
				}*/
			}
			if (typeof(CKEDITOR) != 'undefined') {
				for (instance in CKEDITOR.instances) {
					if (jQuery('#' + instance).size()) {
						CKEDITOR.instances[instance].updateElement();
					}
/*else {
						CKEDITOR.instances[instance].destroy();
					}*/
				}
			}
		}
	},
	prepare_val: function(element) {
		switch (jQuery(element).data("type")) {
		case 'datetime':
		case 'timestamp':
		case 'date':
		case 'time':
			if (jQuery(element).val()) {
				var d = jQuery(element).datepicker("getDate");
				return d ? Math.round(d.getTime() / 1000) - d.getTimezoneOffset() * 60 : '';
			} else
			return '';
			break;
		default:
			return jQuery.trim(jQuery(element).val());
			break;
		}
	},
	change_filter: function(type, container, fieldname) {
		jQuery(container).find(".lnwphp-searchdata").hide().removeClass("lnwphp-search-active");
		var name_selector = '';
		switch (type) {
		case 'datetime':
		case 'timestamp':
		case 'date':
		case 'time':
			var fieldtype = 'date';
			break;
		case 'bool':
			var fieldtype = 'bool';
			break;
		case 'select':
		case 'multiselect':
		case 'radio':
		case 'checkboxes':
			var fieldtype = 'dropdown';
			name_selector = '[data-fieldname="' + fieldname + '"]';
			break;
		default:
			var fieldtype = 'default';
			break;
		}
		jQuery(container).find('.lnwphp-searchdata[data-fieldtype="' + fieldtype + '"]' + name_selector).show().addClass("lnwphp-search-active");
		if (fieldtype == 'date') {
			lnwphp.init_datepicker_range(type, container);
		}
	},
	init_datepicker_range: function(type, container) {
		jQuery(container).find('.lnwphp-datepicker-from.hasDatepicker,.lnwphp-datepicker-to.hasDatepicker').datepicker("destroy");
		var datepicker_config = {
			changeMonth: true,
			changeYear: true,
			showSecond: true,
			dateFormat: lnwphp.config('date_format'),
			timeFormat: lnwphp.config('time_format')
		};
		switch (type) {
		case 'datetime':
		case 'timestamp':
			// to
			datepicker_config.onClose = function(selectedDate) {
				jQuery(container).find('.lnwphp-datepicker-from').datetimepicker("option", "maxDate", selectedDate);
			}
			datepicker_config.onSelect = datepicker_config.onClose;
			jQuery(container).find('.lnwphp-datepicker-to').datetimepicker(datepicker_config);
			// from
			datepicker_config.maxDate = jQuery(container).find('.lnwphp-datepicker-to').val();
			datepicker_config.onClose = function(selectedDate) {
				jQuery(container).find('.lnwphp-datepicker-to').datetimepicker("option", "minDate", selectedDate);
			}
			datepicker_config.onSelect = datepicker_config.onClose;
			jQuery(container).find('.lnwphp-datepicker-from').datetimepicker(datepicker_config);
			break;
		case 'date':
			// to
			datepicker_config.onClose = function(selectedDate) {
				jQuery(container).find('.lnwphp-datepicker-from').datepicker("option", "maxDate", selectedDate);
			}
			datepicker_config.onSelect = datepicker_config.onClose;
			jQuery(container).find('.lnwphp-datepicker-to').datepicker(datepicker_config);
			// from
			datepicker_config.maxDate = jQuery(container).find('.lnwphp-datepicker-to').val();
			datepicker_config.onClose = function(selectedDate) {
				jQuery(container).find('.lnwphp-datepicker-to').datepicker("option", "minDate", selectedDate);
			}
			datepicker_config.onSelect = datepicker_config.onClose;
			jQuery(container).find('.lnwphp-datepicker-from').datepicker(datepicker_config);
			break;
		case 'time':
			jQuery(container).find('.lnwphp-datepicker-from,.lnwphp-datepicker-to').timepicker(datepicker_config);
			break;
		}
		jQuery(".ui-datepicker").css("font-size", "0.9em"); // reset ui size
	},
	init_datepicker: function(container) {
		if (jQuery(container).find(".lnwphp-datepicker").size()) {
			jQuery(container).find(".lnwphp-datepicker").each(function() {
				var element = jQuery(this);
				var format_id = jQuery(this).data("type");
				switch (format_id) {
				case 'datetime':
				case 'timestamp':
					element.datetimepicker({
						showSecond: true,
						timeFormat: lnwphp.config('time_format'),
						dateFormat: lnwphp.config('date_format'),
						firstDay: lnwphp.config('date_first_day'),
						changeMonth: true,
						changeYear: true
					});
					break;
				case 'time':
					element.timepicker({
						showSecond: true,
						dateFormat: lnwphp.config('date_format'),
						timeFormat: lnwphp.config('time_format')
					});
					break;
				case 'date':
				default:
					element.datepicker({
						dateFormat: lnwphp.config('date_format'),
						firstDay: lnwphp.config('date_first_day'),
						changeMonth: true,
						changeYear: true,
						onClose: function(selectedDate) {
							var range_start = element.data("rangestart");
							var range_end = element.data("rangeend");
							if (range_start) {
								var target = element.closest(".lnwphp-ajax").find('input[name="' + range_start + '"]');
								jQuery(target).datepicker("option", "maxDate", selectedDate);
							}
							if (range_end) {
								var target = element.closest(".lnwphp-ajax").find('input[name="' + range_end + '"]');
								jQuery(target).datepicker("option", "minDate", selectedDate);
							}
						}
					});
					var range_start = element.data("rangestart");
					var range_end = element.data("rangeend");
					if (range_start && element.val()) {
						var target = element.closest(".lnwphp-ajax").find('input[name="' + range_start + '"]');
						jQuery(target).datepicker("option", "maxDate", element.val());
					}
					if (range_end && element.val()) {
						var target = element.closest(".lnwphp-ajax").find('input[name="' + range_end + '"]');
						jQuery(target).datepicker("option", "minDate", element.val());
					}
				}
			});
		}
	},
	init_texteditor: function(container) {
		var elements = jQuery(container).find(".lnwphp-texteditor:not(.editor-loaded)");
		if (jQuery(elements).size()) {
			if (lnwphp.config('editor_url') || lnwphp.config('force_editor')) {
				jQuery(elements).addClass("editor-loaded").addClass("editor-instance");
				if (lnwphp.config('editor_init_url')) {
					window.setTimeout(function() {
						jQuery.ajax({
							url: lnwphp.config('editor_init_url'),
							type: "get",
							dataType: "script",
							success: function(js) {
								jQuery(".lnwphp-overlay").stop(true, true).css("display", "none");
								jQuery(elements).removeClass("editor-instance");
							},
							cache: true
						});
					}, 300);
				} else {
					if (typeof(tinyMCE) != 'undefined') {
						tinyMCE.init({
							mode: "textareas",
							editor_selector: "editor-instance",
							height: "250"
						});
					} else if (typeof(CKEDITOR) != 'undefined') {
						CKEDITOR.replaceAll('editor-instance');
					}
					jQuery(elements).removeClass("editor-instance");
				}
			}
		}
	},
	upload_file: function(element, data, container) {
		var upl_container = jQuery(element).closest('.lnwphp-upload-container');
		data.field = jQuery(element).data("field");
		data.oldfile = jQuery(upl_container).find('.lnwphp-input').val();
		data.task = "upload";
		data.type = jQuery(element).data("type");
		var ext = lnwphp.get_extension(jQuery(element).val());
		if (data.type == 'image') {
			switch (ext.toLowerCase()) {
			case 'jpg':
			case 'jpeg':
			case 'gif':
			case 'png':
				break;
			default:
				lnwphp.show_message(container, lnwphp.lang('image_type_error'), 'error');
				jQuery(element).val('');
				return false;
				break;
			}
		}
		jQuery(document).trigger("lnwphpbeforeupload", [container, data]);
		lnwphp.show_progress(container);
		jQuery.ajaxFileUpload({
			secureuri: false,
			fileElementId: jQuery(element).attr('id'),
			data: {
				"lnwphp": data
			},
			url: lnwphp.config('url'),
			success: function(out) {
				lnwphp.hide_progress(container);
				jQuery(upl_container).replaceWith(out);
				jQuery(document).trigger("lnwphpafterupload", [container, data]);
				var crop_img = jQuery(out).find("img.lnwphp-crop");
				if (jQuery(crop_img).size()) {
					lnwphp.show_crop_window(crop_img, container);
				}
			},
			error: function() {
				lnwphp.hide_progress(container);
				lnwphp.show_message(container, lnwphp.lang('undefined_error'), 'error');
			}
		});
	},
	show_crop_window: function(crop_img, container) {
		var upl_container = jQuery(container).find('img.lnwphp-crop').closest('.lnwphp-upload-container');
		jQuery(crop_img).dialog({
			resizable: false,
			height: 'auto',
			width: 'auto',
			modal: true,
			closeOnEscape: false,
			buttons: {
				"OK": function() {
					var data = lnwphp.list_data(container,{"task":"crop_image"});
					jQuery(upl_container).find('.xrud-crop-data').each(function() {
						data[jQuery(this).attr('name')] = jQuery(this).val();
					});
					//data.task = "crop_image";
					jQuery(document).trigger("lnwphpbeforeecrop", [container, data]);
					lnwphp.show_progress(container);
					jQuery.ajax({
						data: {
							"lnwphp": data
						},
						success: function(out) {
							lnwphp.hide_progress(container);
							jQuery(upl_container).replaceWith(out);
							jQuery(document).trigger("lnwphpaftercrop", [container, data]);
						},
						error: function() {
							lnwphp.hide_progress(container);
							lnwphp.show_message(container, lnwphp.lang('undefined_error'), 'error');
						},
						type: "post",
						url: lnwphp.config('url'),
						dataType: "html",
						cache: false,
					});
					jQuery(this).dialog("destroy");
					jQuery(".lnwphp-crop").remove();
				}
			},
			close: function(event, ui) {
				var data = lnwphp.list_data(container,{"task":"crop_image"});
				jQuery(upl_container).find('.xrud-crop-data').each(function() {
					data[jQuery(this).attr('name')] = jQuery(this).val();
				});
				//data.task = "crop_image";
				data.w = 0;
				data.h = 0;
				lnwphp.show_progress(container);
				jQuery.ajax({
					data: {
						"lnwphp": data
					},
					success: function(out) {
						lnwphp.hide_progress(container);
						jQuery(upl_container).replaceWith(out);
					},
					error: function() {
						lnwphp.hide_progress(container);
						lnwphp.show_message(container, lnwphp.lang('undefined_error'), 'error');
					},
					type: "post",
					url: lnwphp.config('url'),
					dataType: "html",
					cache: false,
				});
				jQuery(this).dialog("destroy");
				jQuery(".lnwphp-crop").remove();
			},
			open: function(event, ui) {
				lnwphp.load_image(crop_img.attr('src'), function(imageObject) {
					var t_w = parseInt(jQuery(crop_img).data('width'));
					var t_h = parseInt(jQuery(crop_img).data('height'));
					var ratio = parseFloat(jQuery(crop_img).data('ratio'));
					var cropset = {};
					cropset.boxWidth = t_w;
					cropset.boxHeight = t_h;
					if (t_h > 500) {
						cropset.boxHeight = 500;
						cropset.boxWidth = Math.round(t_w * 500 / t_h)
					}
					if (cropset.boxWidth > 550) {
						cropset.boxWidth = 550;
						cropset.boxHeight = Math.round(t_h * 550 / t_w);
					}
					/*jQuery(crop_img).css({
						"width": cropset.boxWidth,
						"height": cropset.boxHeight,
						"min-height": cropset.boxHeight
					});*/
					var left = Math.round((jQuery(window).width() - jQuery(".ui-dialog.ui-widget").width()) / 2);
					var top = Math.round((jQuery(window).height() - jQuery(".ui-dialog.ui-widget").height()) / 2);
					jQuery(".ui-dialog.ui-widget").css({
						"position": "fixed",
						"left": left + "px",
						"top": top + "px"
					});
					cropset.minSize = [50, 50];
					if (ratio) {
						cropset.aspectRatio = ratio;
					}
					cropset.onChange = lnwphp.get_coordinates;
					cropset.keySupport = false;
					cropset.trueSize = [t_w, t_h];
					var w1 = t_w / 4;
					var h1 = t_h / 4;
					var w2 = w1 * 3;
					var h2 = h1 * 3;
					cropset.setSelect = [w1, h1, w2, h2];
					cropset.allowSelect = false;
					jQuery(".ui-dialog img.lnwphp-crop").Jcrop(cropset);
				});
			}
		});
	},
	load_image: function(url, callback) {
		var imageObject = new Image();
		imageObject.src = url;
		if (imageObject.complete) {
			if (callback) {
				callback(imageObject);
			}
		} else {
			jQuery(document).trigger("startload");
			imageObject.onload = function() {
				jQuery(document).trigger("stopload");
				if (callback) {
					callback(imageObject);
				}
			}
			imageObject.onerror = function() {
				jQuery(document).trigger("stopload");
				if (callback) {
					callback(false);
				}
			}
		}
	},
	remove_file: function(element, data, container) {
		var upl_container = jQuery(element).closest('.lnwphp-upload-container');
		data.field = jQuery(element).data("field");
		data.file = jQuery(upl_container).find('.lnwphp-input').val();
		data.task = "remove_upload";
		lnwphp.show_progress(container);
		jQuery.ajax({
			data: {
				"lnwphp": data
			},
			success: function(data) {
				lnwphp.hide_progress(container);
				jQuery(upl_container).replaceWith(data);
			},
			type: "post",
			url: lnwphp.config('url'),
			dataType: "html",
			cache: false,
			error: function() {
				lnwphp.hide_progress(container);
				lnwphp.show_message(container, lnwphp.lang('undefined_error'), 'error');
			}
		});
	},
	get_coordinates: function(c) {
		jQuery(".lnwphp").find("input.xrud-crop-data[name=x]").val(Math.round(c.x));
		jQuery(".lnwphp").find("input.xrud-crop-data[name=y]").val(Math.round(c.y));
		jQuery(".lnwphp").find("input.xrud-crop-data[name=x2]").val(Math.round(c.x2));
		jQuery(".lnwphp").find("input.xrud-crop-data[name=y2]").val(Math.round(c.y2));
		jQuery(".lnwphp").find("input.xrud-crop-data[name=w]").val(Math.round(c.w));
		jQuery(".lnwphp").find("input.xrud-crop-data[name=h]").val(Math.round(c.h));
	},
	validation_required: function(val, length) {
		return jQuery.trim(val).length >= length;
	},
	validation_pattern: function(val, pattern) {
		if (val === '') {
			return true;
		}
		switch (pattern) {
		case 'email':
			reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
			return reg.test(jQuery.trim(val));
			break;
		case 'alpha':
			reg = /^([a-z])+$/i;
			return reg.test(jQuery.trim(val));
			break;
		case 'alpha_numeric':
			reg = /^([a-z0-9])+$/i;
			return reg.test(jQuery.trim(val));
			break;
		case 'alpha_dash':
			reg = /^([-a-z0-9_-])+$/i;
			return reg.test(jQuery.trim(val));
			break;
		case 'numeric':
			reg = /^[\-+]?[0-9]*\.?[0-9]+$/;
			return reg.test(jQuery.trim(val));
			break;
		case 'integer':
			reg = /^[\-+]?[0-9]+$/;
			return reg.test(jQuery.trim(val));
			break;
		case 'decimal':
			reg = /^[\-+]?[0-9]+\.[0-9]+$/;
			return reg.test(jQuery.trim(val));
			break;
		case 'point':
			reg = /^[\-+]?[0-9]+\.{0,1}[0-9]*\,[\-+]?[0-9]+\.{0,1}[0-9]*$/;
			return reg.test(jQuery.trim(val));
			break;
		case 'natural':
			reg = /^[0-9]+$/;
			return reg.test(jQuery.trim(val));
			break;
		default:
			reg = new RegExp(pattern);
			return reg.test(jQuery.trim(val));
			break;
		}
		return true;
	},
	pattern_callback: function(e, element) {
		var pattern = jQuery(element).data('pattern');
		if (pattern) {
			var code = e.which;
			if (code < 32 || e.ctrlKey || e.altKey) return true;
			var val = String.fromCharCode(code);
			switch (pattern) {
			case 'alpha':
				reg = /^([a-z])+$/i;
				return reg.test(val);
				break;
			case 'alpha_numeric':
				reg = /^([a-z0-9])+$/i;
				return reg.test(val);
				break;
			case 'alpha_dash':
				reg = /^([-a-z0-9_-])+$/i;
				return reg.test(val);
				break;
			case 'numeric':
			case 'integer':
			case 'decimal':
				reg = /^[0-9\.\-+]+$/;
				return reg.test(val);
				break;
			case 'natural':
				reg = /^[0-9]+$/;
				return reg.test(val);
				break;
			case 'point':
				reg = /^[0-9\.\,\-+]+$/;
				return reg.test(val);
				break;
			}
		}
		return true;
	},
	validation_error: false,
	get_extension: function(filename) {
		var parts = filename.split('.');
		return parts[parts.length - 1];
	},
	check_fixed_buttons: function() {
		jQuery(".lnwphp").each(function() {
			if (jQuery(this).find(".lnwphp-list:first").width() > jQuery(this).find(".lnwphp-list-container:first").width()) {
				var w = jQuery(this).find(".lnwphp-actions:not(.lnwphp-fix):first").width();
				jQuery(this).find(".lnwphp-actions:not(.lnwphp-fix):first").css({
					"width": w,
					"min-width": w
				});
				jQuery(this).find(".lnwphp-list:first .lnwphp-actions.lnwphp-fix:not(.lnwphp-actions-fixed)").addClass("lnwphp-actions-fixed");
			} else
			jQuery(this).find(".lnwphp-list:first .lnwphp-actions").removeClass("lnwphp-actions-fixed");
		});
	},
	block_query: {},
	depend_init: function(container) {
		jQuery(container).off('change.depend');
		var dependencies = {};
		jQuery(container).find('.lnwphp-input[data-depend]').each(function() {
			var container = lnwphp.get_container(this);
			var data = lnwphp.list_controls_data(container, this);
			var depend_on = jQuery(this).data("depend");
			data.task = "depend";
			data.name = jQuery(this).attr('name');
			data.value = jQuery(this).val();
			jQuery(container).on('change.depend', '.lnwphp-input[name="' + depend_on + '"]', function() {
				if (lnwphp.check_container(this, container)) {
					data.dependval = jQuery(this).val();
					lnwphp.depend_query(data, depend_on, container);
				}
			});
			if (depend_on) dependencies[depend_on] = depend_on;
		});
		jQuery.map(dependencies, function(val, key) {
			window.setTimeout(function() {
				jQuery(container).find('.lnwphp-input[name="' + val + '"]:not([data-depend])').trigger('change.depend');
			}, 100);
		});
	},
	depend_query: function(data, depend_on, container) {
		if (lnwphp.block_query[data.name + depend_on]) {
			return;
		}
		lnwphp.block_query[data.name + depend_on] = 1;
		jQuery(document).trigger("lnwphpbeforedepend", [container, data]);
		jQuery.ajax({
			data: {
				"lnwphp": data
			},
			type: 'post',
			url: lnwphp.config('url'),
			success: function(input) {
				jQuery(container).find('.lnwphp-input[name="' + data.name + '"]').replaceWith(input);
				window.setTimeout(function() {
					jQuery(document).trigger("lnwphpafterdepend", [container, data]);
					jQuery(container).find('.lnwphp-input[name="' + data.name + '"]').trigger('change.depend');
					lnwphp.block_query[data.name + depend_on] = 0;
				}, 50);
			},
			cache: false
		});
	},
	parse_latlng: function(string) {
		var coords = string.split(',');
		if (coords.length != 2) {
			return null;
		}
		var LatLng = new google.maps.LatLng(parseFloat(coords[0]), parseFloat(coords[1]));
		return LatLng;
	},
	create_map: function(selector, center, zoom, type) {
		var params = {
			zoom: zoom,
			center: center,
			mapTypeId: google.maps.MapTypeId[type]
		}
		var map = new google.maps.Map(jQuery(selector)[0], params);
		return map;
	},
	place_marker: function(map, point, draggable, infowindow, point_field) {
		var marker = new google.maps.Marker({
			position: point,
			map: map,
			animation: google.maps.Animation.DROP,
			draggable: (draggable ? true : false)
		});
		if (infowindow) {
			google.maps.event.addListener(marker, 'click', function() {
				var currentmarker = this;
				var infoWindow = new google.maps.InfoWindow({
					maxWidth: 320
				});
				infoWindow.setContent('<p class="lnwphp-infowinow">' + infowindow + '</p>');
				infoWindow.open(map, currentmarker);
			});
		}
		if (draggable && jQuery(point_field).size()) {
			google.maps.event.addListener(marker, 'dragend', function() {
				jQuery(point_field).val(this.getPosition().lat() + ',' + this.getPosition().lng());
			});
			google.maps.event.addListener(map, 'click', function(event) {
				//console.log(oMap);
				marker.setPosition(event.latLng);
				jQuery(point_field).val(marker.getPosition().lat() + ',' + marker.getPosition().lng());
			});
		}
		return marker;
	},
	move_marker: function(map, marker, point, dragable, infowindow) {
		if (marker) {
			marker.setPosition(point);
		} else {
			this.place_marker(map, point, dragable, infowindow)
		}
		map.setCenter(point);
		return marker;
	},
	find_point: function(address, callback) {
		return this.geocode({
			address: address
		}, callback);
	},
	find_address: function(point, callback) {
		return this.geocode({
			latLng: point
		}, callback);
	},
	geocode: function(geocoderRequest, callback, callback_single) {
		var geocoder = new google.maps.Geocoder();
		geocoder.geocode(geocoderRequest, function(results, status) {
			//console.log(results);
			var output = {};
			if (status == google.maps.GeocoderStatus.OK) {
				for (var i = 0; i < results.length; i++) {
					if (results[i].formatted_address) {
						//console.log(results[i]);
						output[i] = {};
						output[i].lat = results[i].geometry.location.lat();
						output[i].lng = results[i].geometry.location.lng();
						output[i].address = results[i].formatted_address;
						if (callback_single) {
							return callback_single(output[i]);
						}
					}
				}
				if (callback) {
					callback(output);
				}
			}
		});
	},
	map_instances: [],
	marker_instances: [],
	map_init: function(container) {
		lnwphp.map_instances = [];
		jQuery(container).find('.lnwphp-map').each(function() {
			var cont = this;
			var point_field = jQuery(cont).parent().children('.lnwphp-input');
			var search_field = jQuery(cont).parent().children('.lnwphp-map-search');
			var point = lnwphp.parse_latlng(jQuery(point_field).val());
			var map = lnwphp.create_map(cont, point, jQuery(cont).data('zoom'), 'ROADMAP');
			var marker = lnwphp.place_marker(map, point, jQuery(cont).data('draggable'), jQuery(cont).data('text'), point_field);
			jQuery(point_field).on("keyup", function() {
				var point = lnwphp.parse_latlng(jQuery(point_field).val());
				lnwphp.move_marker(map, marker, point, jQuery(cont).data('draggable'), jQuery(cont).data('text'));
				return false;
			});
			if (jQuery(search_field).size()) {
				jQuery(search_field).on("keyup", function() {
					var value = jQuery.trim(jQuery(search_field).val());
					if (value) {
						lnwphp.find_point(value, function(results) {
							lnwphp.map_dropdown(search_field, results, map, marker, point_field, cont);
						});
					}
					return false;
				});
			}
			lnwphp.map_instances.push(map);
			lnwphp.marker_instances.push(marker);
		});
	},
	map_dropdown: function(element, results, map, marker, point_field, cont) {
		var m_left = jQuery(element).outerWidth();
		var m_top = jQuery(element).outerHeight();
		var pos = jQuery(element).offset();
		jQuery(element).prev(".lnwphp-map-dropdown").remove();
		if (results) {
			var list = '<ul class="lnwphp-map-dropdown">';
			jQuery.map(results, function(value) {
				list += '<li data-val="' + value.lat + ',' + value.lng + '">' + value.address + '</li>';
			});
			list += '</ul>';
			jQuery(element).before(list);
			jQuery(element).prev(".lnwphp-map-dropdown").offset(pos).css({
				"marginTop": m_top + "px",
				"minWidth": m_left + "px"
			}).children('li').on("click", function() {
				var point = lnwphp.parse_latlng(jQuery(this).data("val"));
				jQuery(element).val(jQuery(this).text());
				marker = lnwphp.move_marker(map, marker, point, jQuery(cont).data('draggable'), jQuery(cont).data('text'));
				jQuery(point_field).val(marker.getPosition().lat() + ',' + marker.getPosition().lng());
				jQuery(this).parent('ul').remove();
				return false;
			});
		}
	},
	map_resize_all: function() {
		if (jQuery(".lnwphp-map").size() && lnwphp.map_instances.length) {
			for (i = 0; i < lnwphp.map_instances.length; i++) {
				var map = lnwphp.map_instances[i];
				var marker = lnwphp.marker_instances[i];
				google.maps.event.trigger(map, 'resize');
				map.setZoom(map.getZoom());
				map.setCenter(marker.position)
			}
		}
	},
	reload: function(selector_or_object) {
		if (!selector_or_object) {
			selector_or_object = 'body';
		}
		jQuery(selector_or_object).find(".lnwphp-ajax").each(function() {
			lnwphp.request(this, lnwphp.list_data(this));
		});
	},
	bootstrap_modal: function(header, content) {
		jQuery("#lnwphp-modal-window").remove();
		jQuery("body").append('<div id="lnwphp-modal-window" class="modal"><div class="modal-dialog"><div class="modal-content"></div></div></div>');
		jQuery("#lnwphp-modal-window .modal-content").html('<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h4 class="modal-title">' + header + '</h4></div>');
		jQuery("#lnwphp-modal-window .modal-content").append('<div class="modal-body">' + content + '</div>');
		jQuery("#lnwphp-modal-window").modal();
		jQuery('#myModal').on('hidden.bs.modal', function() {
			jQuery("#lnwphp-modal-window").remove();
		});
	},
	ui_modal: function(header, content) {
		jQuery("#lnwphp-modal-window").remove();
		jQuery("body").append('<div id="lnwphp-modal-window">' + content + '</div>');
		jQuery("#lnwphp-modal-window").dialog({
			resizable: false,
			height: 'auto',
			width: 'auto',
			modal: true,
			closeOnEscape: true,
			close: function(event, ui) {
				jQuery("#lnwphp-modal-window").remove();
			},
			title: header
		});
	},
	modal: function(header, content) {
		if (typeof(jQuery.fn.modal) != 'undefined') {
            if(jQuery(content).first().prop("tagName") == 'IMG'){
                lnwphp.load_image(jQuery(content).first().attr('src'),function(imgObj){
                    lnwphp.bootstrap_modal(header, content);
                })
            }else{
                lnwphp.bootstrap_modal(header, content);
            }
		} else {
            if(jQuery(content).first().prop("tagName") == 'IMG'){
                lnwphp.load_image(jQuery(content).first().attr('src'),function(imgObj){
                    lnwphp.ui_modal(header, content);
                })
            }else{
                lnwphp.ui_modal(header, content);
            }
		}
	},
	init_tabs: function(container) {
		if (jQuery(container).find('.lnwphp-tabs').size()) {
			if (typeof(jQuery.fn.tab) != 'undefined') {
				jQuery(container).find('.lnwphp-tabs > ul:first > li > a').on("click", function() {
					jQuery(this).tab('show');
					return false;
				});
				jQuery('.lnwphp .nav-tabs a').on('shown.bs.tab', function(e) {
					lnwphp.map_resize_all();
				});
			} else {
				jQuery(container).find('.lnwphp-tabs').tabs({
					activate: function(event, ui) {
						lnwphp.map_resize_all();
					}
				});
			}
		}
	},
	init_tooltips: function(container) {
		if (jQuery(container).find('.lnwphp-tooltip').size()) {
			jQuery(container).find('.lnwphp-tooltip').tooltip();
		}
	},
	show_message: function(container, text, classname, delay) {
		if (container && text) {
			if (!classname) classname = 'info';
			if (!delay) delay = 3;
			var cont = jQuery(container).closest(".lnwphp-container");
			jQuery(cont).children('.lnwphp-message').stop(true, true).remove();
			jQuery(cont).append('<div class="lnwphp-message ' + (classname ? classname : '') + '">' + text + '</div>');
			jQuery(cont).children('.lnwphp-message').on("click", function() {
				jQuery(this).stop(true).slideUp(200, function() {
					jQuery(this).remove();
				});
			}).slideDown().delay(delay * 1000).slideUp(200, function() {
				jQuery(this).remove();
			});
		}
	},
	check_message: function(container) {
		var elements = jQuery(container).find(".lnwphp-callback-message");
		if (jQuery(elements).size()) {
			elements.each(function() {
				var element = this;
				if (lnwphp.check_container(element, container)) {
					lnwphp.show_message(container, jQuery(element).val(), jQuery(element).attr("name"));
					jQuery(element).remove();
				}
			});
		}
	}
}; /** events */
jQuery(document).on("ready lnwphpreinit", function() {
	var $ = jQuery;
	if ($(".lnwphp").size()) {
		$(".lnwphp").on("change", ".lnwphp-actionlist", function() {
			var container = lnwphp.get_container(this);
			var data = lnwphp.list_data(container);
			lnwphp.request(container, data);
		});
		$(".lnwphp").on("change", ".lnwphp-daterange", function() {
			var container = lnwphp.get_container(this);
			if ($(this).val()) {
				$(container).find(".lnwphp-datepicker-from").datepicker("setDate", new Date($(this).find('option:selected').data('from') * 1000));
				$(container).find(".lnwphp-datepicker-to").datepicker("setDate", new Date($(this).find('option:selected').data('to') * 1000));
			} else {
				$(container).find(".lnwphp-datepicker-from,.lnwphp-datepicker-to").val('');
			}
		});
		$(".lnwphp").on("change", ".lnwphp-columns-select", function() {
			var container = lnwphp.get_container(this);
			var type = $(this).children("option:selected").data('type');
			var fieldname = $(this).children("option:selected").val();
			lnwphp.change_filter(type, container, fieldname);
		});
		$(".lnwphp").on("click", ".lnwphp-action", function() {
			var confirm_text = $(this).data('confirm');
			if (confirm_text && !window.confirm(confirm_text)) {
				return;
			} else {
				var container = lnwphp.get_container(this);
				var data = lnwphp.list_data(container, this);
				if ($(this).hasClass('lnwphp-in-new-window')) {
					lnwphp.new_window_request(container, data);
				} else {
					if (data.task == 'save') {
						if (!lnwphp.validation_error) {
							lnwphp.unique_check(container, data, function(container) {
								data.task = 'save';
								lnwphp.request(container, data);
							});
						} else {
							lnwphp.show_message(container, lnwphp.lang('validation_error'), 'error');
						}
					} else {
						lnwphp.request(container, data);
					}
				}
			}
			return false;
		});
		$(".lnwphp").on("click", ".lnwphp-toggle-show", function() {
			var container = $(this).closest(".lnwphp").find(".lnwphp-container:first");
			var closed = $(this).hasClass("lnwphp-toggle-down");
			if (closed) {
				$(container).stop(true, true).delay(100).slideDown(200, function() {
					$(document).trigger("lnwphpslidedown");
					$(container).trigger("lnwphpslidedown");
				});
				//$(this).removeClass("lnwphp-toggle-down");
				//$(this).addClass("lnwphp-toggle-up");
				$(this).closest(".lnwphp").find(".lnwphp-main-tab").slideUp(200);
			} else {
				$(container).stop(true, true).slideUp(200, function() {
					$(document).trigger("lnwphpslideup");
					$(container).trigger("lnwphpslideup");
				});
				//$(this).removeClass("lnwphp-toggle-up");
				//$(this).addClass("lnwphp-toggle-down");
				$(this).closest(".lnwphp").find(".lnwphp-main-tab").delay(100).slideDown(200);
			}
			return false;
		});
		$(".lnwphp").on("keypress", ".lnwphp-input", function(e) {
			return lnwphp.pattern_callback(e, this);
		});
		$(".lnwphp").on("click", ".lnwphp-search-toggle", function() {
			$(this).hide(200);
			$(this).closest(".lnwphp-ajax").find(".lnwphp-search").show(200);
			return false;
		});
		$(".lnwphp").on("keydown", ".lnwphp-searchdata", function(e) {
			if (e.which == 13) {
				var container = lnwphp.get_container(this);
				var data = lnwphp.list_data(container);
				data.search = 1;
				lnwphp.request(container, data);
				return false;
			}
		});
		$(".lnwphp").on("change", ".lnwphp-upload", function() {
			var container = lnwphp.get_container(this);
			var data = lnwphp.list_data(container);
			lnwphp.upload_file(this, data, container);
			return false;
		});
		$(".lnwphp").on("click", ".lnwphp-remove-file", function() {
			var container = lnwphp.get_container(this);
			var data = lnwphp.list_data(container);
			lnwphp.remove_file(this, data, container);
			return false;
		});
		$(".lnwphp").on("click", ".lnwphp_modal", function() {
			var content = $(this).data("content");
			var header = $(this).data("header");
			lnwphp.modal(header, content);
			return false;
		});
		$(".lnwphp-ajax").each(function() {
			lnwphp.init_datepicker(this);
			lnwphp.init_datepicker_range($(this).find('.lnwphp-columns-select option:selected').data('type'), this);
			lnwphp.depend_init(this);
			lnwphp.map_init(this);
			lnwphp.check_fixed_buttons();
			lnwphp.init_tooltips(this);
			lnwphp.init_tabs(this);
			lnwphp.check_message(this);
			lnwphp.hide_progress(this);
		});
	}
});
jQuery(window).on("resize load lnwphpslidetoggle", function() {
	lnwphp.check_fixed_buttons();
});
jQuery(window).on("load", function() {
	jQuery(".lnwphp-ajax").each(function() {
		lnwphp.init_texteditor(this);
	});
});
jQuery(document).on("lnwphpbeforerequest", function(event, container) {});
jQuery(document).on("lnwphpafterrequest", function(event, container) {
	lnwphp.init_datepicker(container);
	lnwphp.init_texteditor(container);
	lnwphp.init_datepicker_range(jQuery(container).find('.lnwphp-columns-select option:selected').data('type'), container);
	lnwphp.depend_init(container);
	lnwphp.map_init(container);
	lnwphp.check_fixed_buttons();
	lnwphp.init_tooltips(container);
	lnwphp.init_tabs(container);
	lnwphp.check_message(container);
});
jQuery(document).on("lnwphpafterupload", function(event, container) {
	lnwphp.check_message(container);
});
//
/** print */
jQuery.extend({
	print_window: function(print_win, lnwphp) {
		var data = {};
		jQuery(lnwphp).find(".lnwphp-data").each(function() {
			data[jQuery(this).attr("name")] = jQuery(this).val();
		});
		data.task = 'print';
		jQuery.ajax({
			data: data,
			success: function(out) {
				print_win.document.open();
				print_win.document.write(out);
				print_win.document.close();
				jQuery(lnwphp).find(".lnwphp-data[name=key]:first").val(jQuery(print_win.document).find(".lnwphp-data[name=key]:first").val());
				var ua = navigator.userAgent.toLowerCase();
				if ((ua.indexOf("opera") != -1)) { // opera fix
					jQuery(print_win).load(function() {
						print_win.print();
					});
				} else {
					jQuery(print_win).ready(function() {
						print_win.print();
					});
				}
			}
		});
	}
});
// 
/** upload */
jQuery.extend({
	createUploadIframe: function(id, uri) {
		var frameId = 'jUploadFrame' + id;
		var iframeHtml = '<iframe id="' + frameId + '" name="' + frameId + '" style="position:absolute; top:-9999px; left:-9999px"';
		if (window.ActiveXObject) {
			if (typeof uri == 'boolean') {
				iframeHtml += ' src="' + 'javascript:false' + '"';
			} else if (typeof uri == 'string') {
				iframeHtml += ' src="' + uri + '"';
			}
		}
		iframeHtml += ' />';
		jQuery(iframeHtml).appendTo(document.body);
		return jQuery('#' + frameId).get(0);
	},
	createUploadForm: function(id, fileElementId, data) {
		var formId = 'jUploadForm' + id;
		var fileId = 'jUploadFile' + id;
		var form = jQuery('<form  action="" method="POST" name="' + formId + '" id="' + formId + '" enctype="multipart/form-data"></form>');
		if (data) {
			for (var i in data.lnwphp) {
				if (data.lnwphp[i] == 'postdata') {
/*for (var j in data.lnwphp.postdata) {
			             jQuery('<input type="hidden" name="lnwphp[postdata][' + j + ']" value="' + data.lnwphp.postdata[j] + '" />').appendTo(form);
			         }*/
				} else
				jQuery('<input type="hidden" name="lnwphp[' + i + ']" value="' + data.lnwphp[i] + '" />').appendTo(form);
			}
		}
		var oldElement = jQuery('#' + fileElementId);
		var newElement = jQuery(oldElement).clone();
		jQuery(oldElement).attr('id', fileId);
		jQuery(oldElement).before(newElement);
		jQuery(oldElement).appendTo(form);
		jQuery(form).css('position', 'absolute');
		jQuery(form).css('top', '-1200px');
		jQuery(form).css('left', '-1200px');
		jQuery(form).appendTo('body');
		return form;
	},
	ajaxFileUpload: function(s) {
		s = jQuery.extend({}, jQuery.ajaxSettings, s);
		var id = new Date().getTime();
		var form = jQuery.createUploadForm(id, s.fileElementId, (typeof(s.data) == 'undefined' ? false : s.data));
		var io = jQuery.createUploadIframe(id, s.secureuri);
		var frameId = 'jUploadFrame' + id;
		var formId = 'jUploadForm' + id;
		if (s.global && !jQuery.active++) {
			jQuery.event.trigger("ajaxStart");
		}
		var requestDone = false;
		var xml = {};
		if (s.global) jQuery.event.trigger("ajaxSend", [xml, s]);
		var uploadCallback = function(isTimeout) {
			var io = document.getElementById(frameId);
			try {
				if (io.contentWindow) {
					xml.responseText = io.contentWindow.document.body ? io.contentWindow.document.body.innerHTML : null;
					xml.responseXML = io.contentWindow.document.XMLDocument ? io.contentWindow.document.XMLDocument : io.contentWindow.document;
				} else if (io.contentDocument) {
					xml.responseText = io.contentDocument.document.body ? io.contentDocument.document.body.innerHTML : null;
					xml.responseXML = io.contentDocument.document.XMLDocument ? io.contentDocument.document.XMLDocument : io.contentDocument.document;
				}
			} catch (e) {}
			if (xml || isTimeout == "timeout") {
				requestDone = true;
				var status;
				try {
					status = isTimeout != "timeout" ? "success" : "error";
					if (status != "error") {
						var data = jQuery.uploadHttpData(xml, s.dataType);
						if (s.success) s.success(data, status);
						if (s.global) jQuery.event.trigger("ajaxSuccess", [xml, s]);
					} else {}
				} catch (e) {
					status = "error";
				}
				if (s.global) jQuery.event.trigger("ajaxComplete", [xml, s]);
				if (s.global && !--jQuery.active) jQuery.event.trigger("ajaxStop");
				if (s.complete) s.complete(xml, status);
				jQuery(io).unbind();
				setTimeout(function() {
					try {
						jQuery(io).remove();
						jQuery(form).remove();
					} catch (e) {}
				}, 100);
				xml = null
			}
		};
		if (s.timeout > 0) {
			setTimeout(function() {
				if (!requestDone) uploadCallback("timeout");
			}, s.timeout);
		}
		try {
			var form = jQuery('#' + formId);
			jQuery(form).attr('action', s.url);
			jQuery(form).attr('method', 'POST');
			jQuery(form).attr('target', frameId);
			if (form.encoding) {
				jQuery(form).attr('encoding', 'multipart/form-data');
			} else {
				jQuery(form).attr('enctype', 'multipart/form-data');
			}
			jQuery(form).submit();
		} catch (e) {}
		var ttt = 0;
		var ua = navigator.userAgent.toLowerCase();
		if ((ua.indexOf("opera") != -1)) { // opera fix
			jQuery('#' + frameId).load(function() {
				ttt++;
				if (ttt == 2) {
					uploadCallback();
				}
			});
		} else {
			jQuery('#' + frameId).on("load", uploadCallback);
		}
		return {
			abort: function() {}
		};
	},
	uploadHttpData: function(r, type) {
		data = (type == "xml" && !type) ? r.responseXML : r.responseText;
		if (type == "script") jQuery.globalEval(data);
		if (type == "json") eval("data = " + data);
		return data;
	}
});