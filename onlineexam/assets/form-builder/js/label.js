"use strict";SJL.label=function(a){return a=a||{},SJL.add_config(this,a),this._component="label",this.text=a.text||"My Label",this.text_align=a.text_align||"",this.font_weight=a.font_weight||"normal",this.font_style=a.font_style||"normal",this.required=1==a.required,this.seperator=a.seperator||"",this.label_width=a.label_width||12,this.font_name=a.font_name||"",this.margin=a.margin||{},this.color=a.color||"black",this.font_size=a.font_size||"",this.required_symbol=a.required_symbol||"*",this.display=a.display||"block",this.init=function(){var b=this;b.base_id=SJL.generate_id(a.id);if(b.margin_top&&(b.margin.top=b.margin_top),b.margin_bottom&&(b.margin.bottom=b.margin_bottom),b.margin_left&&(b.margin.left=b.margin_left),b.margin_right&&(b.margin.right=b.margin_right),b.dom=SJL.create_element("div",{id:b.base_id+"-"+this._component+"-dom"}),b.label_label=SJL.create_element("label",{id:b.base_id+"-"+this._component+"-label_label"}),b.div_label=SJL.create_element("div",{id:b.base_id+"-"+this._component+"-div_label"}),"inline"==b.display?b.dom.add_css_class("sjl_col-sm-"+b.label_width.toString()):"block"==b.display&&b.dom.add_css_class("sjl_col-sm-12"),b.label_label.add_css_class("sjl_control-label"),"normal"!=b.font_weight&&"bold"!=b.font_weight||SJL.set_style(b.label_label,"font-weight",b.font_weight),"normal"!=b.font_sytle&&"italic"!=b.font_style||SJL.set_style(b.label_label,"font-style",b.font_style),""!=b.font_name&&SJL.set_style(b.label_label,"font-family",b.font_name),""!=b.font_size&&SJL.set_style(b.label_label,"font-size",SJL.generate_px_percent(b.font_size)),""!=b.color&&SJL.set_style(b.label_label,"color",b.color),"center"==b.text_align||"right"==b.text_align||"left"==b.text_align?SJL.set_style(b.div_label,"text-align",b.text_align):SJL.set_style(b.div_label,"text-align",""),b.label_span_label=SJL.create_element("span",{id:b.base_id+"-"+this._component+"-label_span_label"}),b.required_span_label=SJL.create_element("span",{id:b.base_id+"-"+this._component+"-required_span_label"}),b.required_span_label.add_css_class("sjl-textbox-required"),SJL.set_html(b.required_span_label,b.required_symbol),b.required||SJL.set_style(b.required_span_label,"display","none"),b.seperator_span_label=SJL.create_element("span",{id:b.base_id+"-"+this._component+"-seperator_span_label"}),b.seperator_span_label.add_css_class("sjl-textbox-seperator"),SJL.set_html(b.seperator_span_label,b.seperator),SJL.is_object(b.margin))for(var d in b.margin){var e=SJL.trim(d).toLowerCase();"left"!=e&&"right"!=e&&"top"!=e&&"bottom"!=e||(b.dom.style["margin"+SJL.ucfirst(d)]=SJL.generate_px_percent(b.margin[d]))}SJL.set_html(b.label_span_label,b.text),b.label_label.appendChild(b.label_span_label),b.label_label.appendChild(b.seperator_span_label),b.label_label.appendChild(b.required_span_label),b.dom.appendChild(b.div_label),b.div_label.appendChild(b.label_label)},this.set_label=function(a){throw new Error("not implemented yet")},this.get_label=function(){var a=this;return a.text},this.set_padding=function(a,b){var c=this;if(b=b||0,a&&(a=a.toLowerCase(),"left"==a||"right"==a||"bottom"==a||"top"==a)){a=SJL.ucfirst(a),b=SJL.generate_px_percent(b);var d=SJL.dom("#"+c.div_label.id);return d?(d.each(function(){this.style["margin"+a]=b}),d):(SJL.logger("SJL.label:set_padding","can not get DOM by Id"),-1)}},this.set_margin=function(a,b){var c=this;if(b=b||0,a&&(a=a.toLowerCase(),"left"==a||"right"==a||"bottom"==a||"top"==a)){a=SJL.ucfirst(a),b=SJL.generate_px_percent(b);var d=SJL.dom("#"+c.div_label.id);return d?(d.each(function(){this.style["margin"+a]=b}),d):(SJL.logger("SJL.label:set_margin","can not get DOM by Id"),-1)}},this.set_text=function(a){var b=this;return b.set_label(a)},this.get_text=function(){var a=this;return a.get_label()},this.get_required_symbol=function(){var a=this;return a.required_symbol},this.get_seperator=function(){var a=this;return a.seperator},this.set_seperator=function(a){throw new Error("not implemented yet")},this.set_required_symbol=function(a){throw new Error("not implemented yet")},this.get_font_weight=function(){var a=this;return a.font_weight},this.get_font_style=function(){var a=this;return a.font_style},this.set_font_style=function(a){var b=this;if(SJL.is_in_array(a,["normal","italic"])){var c=document.getElementById(b.label_label.id);if(!c)return;return SJL.set_style(c,"font-style",a),b.font_style=a,b}return!1},this.set_font_weight=function(a){var b=this;if(SJL.is_in_array(a,["normal","bold"])){var c=document.getElementById(b.label_label.id);if(!c)return;return SJL.set_style(c,"font-weight",a),b.font_weight=a,b}return!1},this.set_font_size=function(a){var b=this;a=SJL.intVal(a);var c=document.getElementById(b.label_label.id);if(c)return a=SJL.generate_px_percent(a),SJL.set_style(c,"font-size",a),b.font_size=SJL.intVal(a),b},this.set_font_name=function(a){var b=this,c=document.getElementById(b.label_label.id);if(c)return SJL.set_style(c,"font-family",a),b.font_name=a,b},this.get_font_size=function(a){var b=this;return b.font_size},this.get_font_name=function(a){var b=this;return b.font_name},this.get_color=function(){var a=this;return a.color},this.init(),this};