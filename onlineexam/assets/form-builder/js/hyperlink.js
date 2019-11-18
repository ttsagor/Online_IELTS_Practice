"use strict";SJL.hyperlink=function(a){return a=a||{},SJL.add_config(this,a),this._component="hyperlink",this.text=a.text||"link text",this.decoration=a.decoration||"underline",this.text_align=a.text_align||"",this.href=a.href||"#",this.edit_mode=a.edit_mode||!0,this.font_size=a.font_size||"",this.margin=a.margin||{},this.init=function(b){var c=this;c.base_id=SJL.generate_id(a.id);if(c.margin_top&&(c.margin.top=c.margin_top),c.margin_bottom&&(c.margin.bottom=c.margin_bottom),c.margin_left&&(c.margin.left=c.margin_left),c.margin_right&&(c.margin.right=c.margin_right),c.dom=SJL.create_element("div",{id:c.base_id+"-"+this._component+"-dom"}),c.a_hyperlink=SJL.create_element("a",{href:c.href,id:c.base_id+"-"+this._component+"-a_hyperlink"}),SJL.set_style(c.a_hyperlink,"text-decoration",c.decoration),SJL.set_html(c.a_hyperlink,c.text),c.edit_mode,"center"==c.text_align||"right"==c.text_align||"left"==c.text_align?SJL.set_style(c.dom,"text-align",c.text_align):SJL.set_style(c.dom,"text-align",""),SJL.is_number(c.font_size)?SJL.set_style(c.a_hyperlink,"font-size",SJL.generate_px_percent(c.font_size)):SJL.set_style(c.a_hyperlink,"font-size",""),SJL.is_object(c.margin))for(var e in c.margin){var f=SJL.trim(e).toLowerCase();"left"!=f&&"right"!=f&&"top"!=f&&"bottom"!=f||(c.dom.style["margin"+SJL.ucfirst(e)]=SJL.generate_px_percent(c.margin[e]))}if(c.dom.appendChild(c.a_hyperlink),SJL.is_object(c.signals))for(var g in c.signals)SJL.add_event(c.input_textbox,g,c.signals[g],[])},this.get_text=function(){var a=this;return a.text},this.get_href=function(){var a=this;return a.href},this.get_decoration=function(){var a=this;return a.decoration},this.get_text_align=function(){var a=this;return a.text_align},this.get_font_size=function(){var a=this;return a.font_size},this.init(),this};