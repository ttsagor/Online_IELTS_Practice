"use strict";SJL.header=function(a){return a=a||{},SJL.add_config(this,a),this._component="header",this.text=a.text||"My header",this.text_align=a.text_align||"left",this.header_size=a.header_size||2,this.font_weight=a.font_weight||"normal",this.font_style=a.font_style||"normal",this.font_name=a.font_name||"",this.margin=a.margin||{},this.color=a.color||"black",this.data_value=a.data_value||"",this.init=function(){var b=this;b.base_id=SJL.generate_id(a.id);if(b.margin_top&&(b.margin.top=b.margin_top),b.margin_bottom&&(b.margin.bottom=b.margin_bottom),b.margin_left&&(b.margin.left=b.margin_left),b.margin_right&&(b.margin.right=b.margin_right),b.dom=SJL.create_element("div",{id:b.base_id+"-"+this._component+"-dom"}),b.header_size=SJL.intVal(b.header_size),(b.header_size<1||b.header_size>6)&&(b.header_size=2),b.h_header=SJL.create_element("h"+b.header_size.toString(),{id:b.base_id+"-"+this._component+"-h_header"}),b.h_header.innerHTML=b.text,b.data_value&&(b.h_header.innerHTML=b.data_value),SJL.set_style(b.dom,"text-align","left"==b.text_align||"center"==b.text_align||"right"==b.text_align?b.text_align:"left"),b.font_name&&SJL.set_style(b.h_header,"font-family",b.font_name),SJL.is_in_array(b.font_style,["normal","italic"])&&SJL.set_style(b.h_header,"font-style",b.font_style),SJL.is_in_array(b.font_weight,["normal","bold"])&&SJL.set_style(b.h_header,"font-weight",b.font_weight),""!=b.color&&SJL.set_style(b.h_header,"color",b.color),SJL.is_object(b.margin))for(var d in b.margin){var e=SJL.trim(d).toLowerCase();"left"!=e&&"right"!=e&&"top"!=e&&"bottom"!=e||(b.dom.style["margin"+SJL.ucfirst(d)]=SJL.generate_px_percent(b.margin[d]))}b.dom.appendChild(b.h_header)},this.get_text=function(){var a=this;return""!=a.data_value?a.data_value:a.text},this.set_text=function(a){var b=this,c=document.getElementById(b.h_header.id);c&&(c.innerHTML=a.toString(),b.text=a.toString())},this.set_text_align=function(a){var b=this;if("left"==a||"right"==a||"center"==a){var c=document.getElementById(b.dom.id);if(!c)return;return SJL.set_style(c,"text-align",a),void(b.text_align=a)}return!1},this.get_text_align=function(){var a=this;return a.text_align},this.get_header_size=function(){var a=this;return a.header_size},this.set_header_size=function(a){var b=this;if(a=SJL.intVal(a),!(a<1||a>6)){var c=document.getElementById(b.h_header.id);if(c){var d=c.innerHTML;if(c=document.getElementById(b.dom.id)){var e=SJL.create_element("h"+a.toString(),{id:b.id+"-h_header"});return e.innerHTML=d,c.innerHTML="",c.appendChild(e),c}}}},this.get_font_name=function(){var a=this;return a.font_name},this.get_font_style=function(){var a=this;return a.font_style},this.get_font_weight=function(){var a=this;return a.font_weight},this.set_font_name=function(a){var b=this,c=document.getElementById(b.h_header.id);if(c)return SJL.set_style(c,"font-family",a),b.font_name=a,b},this.set_font_style=function(a){var b=this;if(!SJL.is_in_array(a,["normal","italic"]))return!1;var c=document.getElementById(b.h_header.id);if(c)return SJL.set_style(c,"font-style",a),b.font_style=a,b},this.set_font_weight=function(a){var b=this;if(!SJL.is_in_array(a,["normal","bold"]))return!1;var c=document.getElementById(b.h_header.id);if(c)return SJL.set_style(c,"font-weight",a),b.font_weight=a,b},this.get_color=function(){var a=this;return a.color},this.init(),this};