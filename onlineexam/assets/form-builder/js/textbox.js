"use strict";SJL.textbox=function(a){return a=a||{},SJL.add_config(this,a),this._component="textbox",this.text=a.text||"My Label",this.name=a.name||"",this.text_align=a.text_align||"",this.input_size=a.input_size||"",this.place_holder=a.place_holder||"Enter your text here",this.seperator=a.seperator||":",this.money_symbol=a.money_symbol||"$",this.display=a.display||"block",this.input_margin=a.input_margin||{},this.label_margin=a.label_margin||{},this.margin=a.margin||{},this.has_icon=1==a.has_icon,this.icon=a.icon||"fa-pencil",this.padding=a.padding||{},this.signals=a.signals||{},this.required=1==a.required,this.data_value=a.data_value||"",this.input_color=a.input_color||"black",this.normal_color=a.normal_color||"white",this.required_symbol=a.required_symbol||"*",this.type=a.type||"text",this.validity_func=a.validity_func||null,this.validity_color=a.validity_color||"#FF7700",this.label_width=a.label_width||2,this.validity_message=a.validity_message||"Wrong data entry...",this.icon_click=a.icon_click||null,this.input_bg_color=a.input_bg_color||"",this.input_bg_gradient=a.input_bg_gradient||"",this.has_label=0!=a.has_label,this.init=function(){var b=this;b.base_id=SJL.generate_id(a.id);if(b.margin_top&&(b.margin.top=b.margin_top),b.margin_bottom&&(b.margin.bottom=b.margin_bottom),b.margin_left&&(b.margin.left=b.margin_left),b.margin_right&&(b.margin.right=b.margin_right),0==b.has_label&&(b.label_width=0),b.label=new SJL.label({text:b.text,required:b.required,required_symbol:b.required_symbol,text_align:b.text_align,seperator:b.seperator,display:b.display,label_width:b.label_width,font_name:b.font_name||"",font_style:b.font_style||"normal",font_weight:b.font_weight||"normal",font_size:b.font_size||"",color:b.color||"black"}),b.has_label||SJL.dom(b.label.dom).hide(),SJL.is_object(b.label_margin)){var d=b.label_margin;d.left&&SJL.set_style(b.label.dom,"margin-left",SJL.generate_px_percent(d.left)),d.right&&SJL.set_style(b.label.dom,"margin-right",SJL.generate_px_percent(d.right)),d.top&&SJL.set_style(b.label.dom,"margin-top",SJL.generate_px_percent(d.top)),d.bottom&&SJL.set_style(b.label.dom,"margin-bottom",SJL.generate_px_percent(d.bottom))}if(SJL.is_object(b.label_padding)){var d=b.label_padding;d.left&&SJL.set_style(b.label.dom,"padding-left",SJL.generate_px_percent(d.left)),d.right&&SJL.set_style(b.label.dom,"padding-right",SJL.generate_px_percent(d.right)),d.top&&SJL.set_style(b.label.dom,"padding-top",SJL.generate_px_percent(d.top)),d.bottom&&SJL.set_style(b.label.dom,"padding-bottom",SJL.generate_px_percent(d.bottom))}if(b.dom=SJL.create_element("div",{id:b.base_id+"-"+this._component+"-dom"}),b.dom.add_css_class("sjl_form-group"),b.input_textbox=SJL.create_element("input",{id:b.base_id+"-"+this._component+"-input_textbox",type:b.type,placeholder:b.place_holder}),""!=b.input_bg_color&&SJL.set_style(b.input_textbox,"background-color",b.input_bg_color),""!=b.input_bg_gradient&&SJL.set_style(b.input_textbox,"background",b.input_bg_gradient),SJL.set_attr(b.input_textbox,"value",b.data_value),""!=b.name&&SJL.set_attr(b.input_textbox,"name",b.name),b.input_textbox.add_css_class("sjl_form-control"),""!=b.input_color&&SJL.set_style(b.input_textbox,"color",b.input_color),b.div_textbox_inner=SJL.create_element("div",{id:b.base_id+"-"+this._component+"-div_textbox_inner"}),b.i_textbox=SJL.create_element("i",{id:b.base_id+"-"+this._component+"-i_textbox"}),"password"==b.type&&(b.icon=b.icon||"fa-lock"),"number"==b.type&&(b.icon=b.icon||"fa-slack"),"email"==b.type&&(b.icon=b.icon||"fa-envelope"),"money"==b.type&&(b.icon=b.icon||"fa-money"),"mellicode"==b.type&&(b.icon=b.icon||"fa-picture-o"),b.has_icon&&(b.i_textbox.add_css_class("sjl_fa"),b.i_textbox.add_css_class(b.icon),b.div_textbox_inner.add_css_class("sjl_inner-addon"),b.div_textbox_inner.add_css_class("sjl_left-addon"),b.icon_click&&SJL.is_function(b.icon_click)&&(SJL.dom(b.i_textbox).set_style("cursor","pointer"),SJL.add_event(b.i_textbox,"click",b.icon_click,[b.input_textbox]))),b.div_input_textbox=SJL.create_element("div",{id:b.base_id+"-"+this._component+"-div_input_textbox"}),SJL.is_object(b.input_margin))for(var e in b.input_margin){var f=SJL.trim(e).toLowerCase();"left"!=f&&"right"!=f&&"top"!=f&&"bottom"!=f||SJL.set_style(b.div_input_textbox,"margin"+SJL.ucfirst(e),SJL.generate_px_percent(b.input_margin[e]))}if(SJL.is_object(b.margin))for(var e in b.margin){var f=SJL.trim(e).toLowerCase();"left"!=f&&"right"!=f&&"top"!=f&&"bottom"!=f||SJL.set_style(b.dom,"margin"+SJL.ucfirst(e),SJL.generate_px_percent(b.margin[e]))}if(SJL.is_object(b.padding))for(var e in b.padding){var f=SJL.trim(e).toLowerCase();"left"!=f&&"right"!=f&&"top"!=f&&"bottom"!=f||SJL.set_style(b.dom,"padding"+SJL.ucfirst(e),SJL.generate_px_percent(b.padding[e]))}if("inline"==b.display?b.div_input_textbox.add_css_class("sjl_col-sm-"+(12-b.label_width).toString()):b.div_input_textbox.add_css_class("sjl_col-sm-12"),b.input_size&&""!=b.input_size&&b.input_textbox.add_css_class("sjl_input-"+b.input_size),b.dom.appendChild(b.label.dom),b.div_input_textbox.appendChild(b.div_textbox_inner),b.div_textbox_inner.appendChild(b.i_textbox),b.div_textbox_inner.appendChild(b.input_textbox),b.dom.appendChild(b.div_input_textbox),b.validity_func?(SJL.add_event(b.input_textbox,"change",b.validity_func,[b,b.input_textbox]),SJL.add_event(b.input_textbox,"focus",function(a,b){SJL.set_style(a.input_textbox,"background-color",a.normal_color)},[b,b.input_textbox])):"email"==b.type?(SJL.add_event(b.input_textbox,"change",b.email_validity,[b,b.input_textbox]),SJL.add_event(b.input_textbox,"focus",function(a,b,c){SJL.set_style(b.input_textbox,"background-color",b.normal_color)},[b,b.input_textbox])):"number"==b.type?(SJL.add_event(b.input_textbox,"change",b.number_validity,[b,b.input_textbox]),SJL.add_event(b.input_textbox,"focus",function(a,b){SJL.set_style(a.input_textbox,"background-color",a.normal_color)},[b,b.input_textbox])):"money"==b.type?(SJL.add_event(b.input_textbox,"change",b.money_validity,[b,b.input_textbox]),SJL.add_event(b.input_textbox,"focus",function(a,b){SJL.set_style(a.input_textbox,"background-color",a.normal_color)},[b,b.input_textbox])):"mellicode"==b.type&&(SJL.add_event(b.input_textbox,"change",b.mellicode_validity,[b,b.input_textbox]),SJL.add_event(b.input_textbox,"focus",function(a,b){SJL.set_style(a.input_textbox,"background-color",a.normal_color)},[b,b.input_textbox])),b.required&&(SJL.dom(b.input_textbox).set_attr("required","true"),SJL.add_event(b.input_textbox,"change",b.required_validity,[b,b.input_textbox])),SJL.is_object(b.signals))for(var g in b.signals)SJL.add_event(b.input_textbox,g,b.signals[g],[b.input_textbox])},this.required_validity=function(a,b){var c=b.value;return!a.required||""!=c||(SJL.message.alert("Warning",a.validity_message.toString()),!1)},this.email_validity=function(a,b,c){var d=c.value;SJL.valid_field_email(d,!1,"")||(SJL.set_style(b.input_textbox,"background-color",b.validity_color),b.validity_message&&SJL.message.alert("Warning",b.validity_message.toString()))},this.money_validity=function(a,b){var c=b.value,d="";try{c=c.replace(/,/g,"");for(var e=0;e<c.length;++e)d+=c[e]==a.money_symbol?"":c[e];if(d=SJL.trim(d),c=d,!SJL.is_number(c))return SJL.set_style(a.input_textbox,"background-color",a.validity_color),void(a.validity_message&&SJL.message.alert("Warning",a.validity_message.toString()));for(var f="",g=0,e=c.length;e>0;e--)g<3?(f+=c[e-1],g++):(f+=",",f+=c[e-1],g=1);f=f.split("").reverse().join(""),b.value=f+" "+a.money_symbol}catch(a){return-1}},this.number_validity=function(a,b){console.log("number of arguments is : "+arguments.length),console.log(a);var c=SJL.dom("#"+b.id),d=c.get_val();SJL.is_number(d)||(SJL.set_style(a.input_textbox,"background-color",a.validity_color),a.validity_message&&SJL.message.alert("Warning",a.validity_message.toString()))},this.get_name=function(){var a=this;return a.name},this.set_name=function(a){var b=this;return b.name=a,b},this.mellicode_validity=function(a,b){var c=b.value;if(""!=c)return!!SJL.valid_field_mellicode(c,!1,"")||(SJL.set_style(a.input_textbox,"background-color",a.validity_color),a.validity_message&&SJL.message.alert("Warning",a.validity_message.toString()),!1)},this.set_text=function(a){var b=this,c=document.getElementById(b.input_textbox.id);c.value=a},this.get_place_holder=function(){var a=this;return a.place_holder},this.get_text=function(){var a=this,b=document.getElementById(a.input_textbox.id);return b.value},this.get_text_length=function(){var a=this,b=document.getElementById(a.input_textbox.id);return b.value.length},this.set_label_width=function(a){var b=this;if(a=SJL.intVal(a),!(a>12||a<0)){var c=document.getElementById(b.label.dom.id),d=document.getElementById(b.div_input_textbox.id);if(d&&c){var e=c.className;e=e.match(/sjl_col-sm-\d+/gi);for(var f=0;f<e.length;++f)SJL.remove_css_class(c,e[f]);SJL.add_css_class(c,"sjl_col-sm-"+a.toString()),e=d.className,e=e.match(/sjl_col-sm-\d+/gi);for(var f=0;f<e.length;++f)SJL.remove_css_class(d,e[f]);SJL.add_css_class(d,"sjl_col-sm-"+(12-a).toString()),b.label.label_widht=a,b.label_width=a}}},this.get_label_width=function(){var a=this;return a.label_width},this.set_input_size=function(a){var b=this,c=["mini","small","medium","large","xlarge","xxlarge","xxxlarge"];if(!SJL.is_in_array(a,c))return!1;var d=SJL.dom("#"+b.input_textbox.id);return c.every(function(a){d.remove_css_class("sjl_input-"+a)}),d.add_css_class("sjl_input-"+a),b.input_size=a,b},this.get_input_size=function(){var a=this;return a.input_size},this.set_value=function(a){var b=this;return b.set_text(a)},this.set_required=function(a){me.required=!!a,me.label.required=!!a},this.get_required=function(){var a=this;return a.required},this.get_input_color=function(){var a=this;return a.input_color},this.get_has_icon=function(){var a=this;return a.has_icon},this.set_has_icon=function(a){var b=this;return b.has_icon=!!a,b},this.set_icon=function(a){var b=this;return b.icon=a,b},this.get_icon=function(){var a=this;return a.icon},this.get_input_bg_color=function(){var a=this;return a.input_bg_color},this.get_input_bg_gradient=function(){var a=this;return a.input_bg_gradient},this.get_has_label=function(){var a=this;return a.has_label},this.init(),this};