"use strict";SJL.form=function(a){return a=a||{},SJL.add_config(this,a),this._component="form",this.form_name=a.form_name||"",this.disabled=1==a.disabled,this.margin=a.margin||{},this.padding=a.padding||{},this.has_header=0!=a.has_header,this.has_footer=0!=a.has_footer,this.header_text=a.header_text||"",this.footer_text=a.footer_text||"",this.form_width=a.form_width||"",this.form_bg_color=a.form_bg_color||"",this.form_bg_gradient=a.form_bg_gradient||"",this.form_align=a.form_align||"",this.items=a.items||[],this.header_bg_color=a.header_bg_color||"",this.footer_bg_color=a.footer_bg_color||"",this.form_max_width=a.form_max_width||"",this.form_min_width=a.form_min_width||"",this.form_border_size=a.form_border_size||"",this.form_border_color=a.form_border_color||"",this.form_action=a.form_action||"",this.form_method=a.form_method||"",this.form_enctype=a.form_enctype||"application/x-www-form-urlencoded",this.init=function(){var b=this;b.base_id=SJL.generate_id(a.id);if(b.margin_top&&(b.margin.top=b.margin_top),b.margin_bottom&&(b.margin.bottom=b.margin_bottom),b.margin_left&&(b.margin.left=b.margin_left),b.margin_right&&(b.margin.right=b.margin_right),b.dom=SJL.create_element("div",{id:b.base_id+"-"+this._component+"-dom"}),b.dom.add_css_class("sjl_panel"),b.dom.add_css_class("sjl_panel-primary"),b.form_header_div=SJL.create_element("div",{id:b.base_id+"-"+this._component+"-header-div"}),b.form_header_div.add_css_class("sjl_panel-heading"),b.form_header_div_h3=SJL.create_element("h3",{id:b.base_id+"-"+this._component+"-header-div-h3"}),b.form_header_div_h3.add_css_class("sjl_panel-title"),b.form_header_div_h3.add_css_class("sjl_form-title"),b.form_header_div_h3_span=SJL.create_element("span",{id:b.base_id+"-"+this._component+"-header-div-h3-span"}),b.form_header_div_h3_span.add_css_class("sjl_user_select_text_none"),b.form_footer_div=SJL.create_element("div",{id:b.base_id+"-"+this._component+"-footer-div"}),b.form_footer_div.add_css_class("sjl_panel-footer"),b.form_footer_div_span=SJL.create_element("span",{id:b.base_id+"-"+this._component+"-footer-div-span"}),b.form_footer_div_span.add_css_class("sjl_user_select_text_none"),b.form_body_div=SJL.create_element("div",{id:b.base_id+"-"+this._component+"-body-div"}),b.form_body_div.add_css_class("sjl_panel-body"),""!=b.form_bg_color&&SJL.set_style(b.form_body_div,"background-color",b.form_bg_color),""!=b.form_bg_gradient&&SJL.set_style(b.form_body_div,"background",b.form_bg_gradient),b.form_body_div_form=SJL.create_element("form",{id:b.base_id+"-"+this._component+"-body-div-form"}),b.form_body_div_form.add_css_class("sjl_form-horizontal"),""!=SJL.trim(b.form_name)&&(b.form_body_div_form.name=b.form_name),""!=SJL.trim(b.form_action)&&(b.form_body_div_form.action=b.form_action),""!=SJL.trim(b.form_method)&&(b.form_body_div_form.method=b.form_method),""!=SJL.trim(b.form_enctype)&&(b.form_body_div_form.enctype=b.form_enctype),SJL.is_array(b.items)&&b.items.length>0)for(var d=0;d<b.items.length;++d)if(SJL.is_component(b.items[d]))b.form_body_div_form.append(b.items[d].dom);else if(!SJL.is_component(b.items[d])&&SJL.is_dom(b.items[d]))b.form_body_div_form.append(b.items[d]);else{if(SJL.is_component(b.items[d])||SJL.is_dom(b.items[d])||!SJL.is_object(b.items[d]))throw new Error("form.js : items must be DOM or Component");if(b.items[d]._component){var e=new SJL[b.items[d]._component](b.items[d]);b.form_body_div_form.append(e.dom)}else{if(!b.items[d].type)throw new Error("form.js : items must be DOM or Component");var f=b.items[d].type;if("text"==f||"textbox"==f||"email"==f||"money"==f||"mellicode"==f||"password"==f||"number"==f)if("text"==f||"textbox"==f){b.items[d].type="text";var e=new SJL.textbox(b.items[d]);b.form_body_div_form.append(e.dom)}else{var e=new SJL.textbox(b.items[d]);b.form_body_div_form.append(e.dom)}else{var e=new SJL[f](b.items[d]);b.form_body_div_form.append(e.dom)}}}if(""!=b.header_text&&SJL.set_html(b.form_header_div_h3_span,b.header_text),""!=b.footer_text&&SJL.set_html(b.form_footer_div_span,b.footer_text),SJL.intVal(b.form_width)>0&&SJL.set_style(b.dom,"width",SJL.generate_px_percent(b.form_width)),SJL.is_object(b.margin))for(var g in b.margin){var h=g.trim().toLowerCase();"left"!=h&&"right"!=h&&"top"!=h&&"bottom"!=h||(b.dom.style["margin"+SJL.ucfirst(g)]=SJL.generate_px_percent(b.margin[g]))}if(SJL.is_object(b.padding))for(var g in b.padding){var h=g.trim().toLowerCase();"left"!=h&&"right"!=h&&"top"!=h&&"bottom"!=h||(b.dom.style["padding"+SJL.ucfirst(g)]=SJL.generate_px_percent(b.padding[g]))}0==b.has_header&&SJL.set_style(b.form_header_div,"display","none"),0==b.has_footer&&SJL.set_style(b.form_footer_div,"display","none"),""!=b.form_align&&("right"==b.form_align&&SJL.set_style(b.dom,"margin-left","auto"),"center"==b.form_align&&(SJL.set_style(b.dom,"margin-left","auto"),SJL.set_style(b.dom,"margin-right","auto")),"left"==b.form_align),""!=b.header_bg_color&&SJL.set_style(b.form_header_div,"background-color",b.header_bg_color),""!=b.footer_bg_color&&SJL.set_style(b.form_footer_div,"background-color",b.footer_bg_color),""!=b.form_max_width&&SJL.set_style(b.dom,"max-width",SJL.generate_px_percent(b.form_max_width)),""!=b.form_min_width&&SJL.set_style(b.dom,"min-width",SJL.generate_px_percent(b.form_min_width)),""!=b.form_border_color&&SJL.set_style(b.dom,"border-color",b.form_border_color),""!=b.form_border_size&&SJL.set_style(b.dom,"border-width",SJL.generate_px_percent(b.form_border_size)),b.form_header_div_h3.appendChild(b.form_header_div_h3_span),b.form_header_div.appendChild(b.form_header_div_h3),b.form_footer_div.appendChild(b.form_footer_div_span),b.form_body_div.appendChild(b.form_body_div_form),b.dom.appendChild(b.form_header_div),b.dom.appendChild(b.form_body_div),b.dom.appendChild(b.form_footer_div)},this.get_form_footer=function(){var a=this;return a.footer_text},this.get_form_header=function(){var a=this;return a.header_text},this.get_form_name=function(){var a=this;return a.form_name},this.get_form_width=function(){var a=this;return a.form_width},this.get_has_footer=function(){var a=this;return a.has_footer},this.get_has_header=function(){var a=this;return a.has_header},this.get_form_bg_color=function(){var a=this;return a.form_bg_color},this.get_form_bg_gradient=function(){var a=this;return a.form_bg_gradient},this.get_form_align=function(){var a=this;return a.form_align},this.get_header_bg_color=function(){var a=this;return a.header_bg_color},this.get_footer_bg_color=function(){var a=this;return a.footer_bg_color},this.get_form_max_width=function(){var a=this;return a.form_max_width},this.get_form_min_width=function(){var a=this;return a.form_min_width},this.get_form_border_size=function(){var a=this;return a.form_border_size},this.get_form_border_color=function(){var a=this;return a.form_border_color},this.get_form_action=function(){var a=this;return a.form_action},this.get_form_method=function(){var a=this;return a.form_method},this.get_form_enctype=function(){var a=this;return a.form_enctype},this.init(),this};