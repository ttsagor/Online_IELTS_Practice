"use strict";SJL.paragraph=function(a){return a=a||{},SJL.add_config(this,a),this._component="paragraph",this.text=a.text||"Your Paragraph here...",this.text_color=a.text_color||"",this.text_class=a.text_class||"",this.bg_color_class=a.bg_color_class||"",this.text_align=a.text_align||"left",this.font_name=a.font_name||"",this.font_size=a.font_size||"",this.margin=a.margin||{},this.padding=a.padding||{},this.init=function(){var b=this;b.base_id=SJL.generate_id(a.id);if(b.margin_top&&(b.margin.top=b.margin_top),b.margin_bottom&&(b.margin.bottom=b.margin_bottom),b.margin_left&&(b.margin.left=b.margin_left),b.margin_right&&(b.margin.right=b.margin_right),b.padding_top&&(b.padding.top=b.padding_top),b.padding_bottom&&(b.padding.bottom=b.padding_bottom),b.padding_left&&(b.padding.left=b.padding_left),b.padding_right&&(b.padding.right=b.padding_right),b.dom=SJL.create_element("div",{id:b.base_id+"-"+this._component+"-dom"}),"center"==b.text_align||"right"==b.text_align||"left"==b.text_align?SJL.set_style(b.dom,"text-align",b.text_align):SJL.set_style(b.dom,"text-align",""),b.p_paragraph=SJL.create_element("p",{id:b.base_id+"-"+this._component+"-p_paragraph"}),SJL.set_html(b.p_paragraph,b.text),b.text_class&&b.p_paragraph.add_css_class(b.text_class),b.bg_color_class&&b.p_paragraph.add_css_class(b.bg_color_class),b.text_color?SJL.set_style(b.p_paragraph,"color",b.text_color):SJL.remove_style(b.p_paragraph,"text-color"),b.font_name?SJL.set_style(b.p_paragraph,"font-family",b.font_name):SJL.remove_style(b.p_paragraph,"font-family"),SJL.is_number(b.font_size)?SJL.set_style(b.p_paragraph,"font-size",SJL.generate_px_percent(b.font_size)):SJL.remove_style(b.p_paragraph,"font-size"),SJL.is_object(b.margin))for(var d in b.margin){var e=SJL.trim(d).toLowerCase();"left"!=e&&"right"!=e&&"top"!=e&&"bottom"!=e||SJL.set_style(b.dom,"margin"+SJL.ucfirst(d),SJL.generate_px_percent(b.margin[d]))}if(SJL.is_object(b.padding))for(var d in b.padding){var e=SJL.trim(d).toLowerCase();"left"!=e&&"right"!=e&&"top"!=e&&"bottom"!=e||SJL.set_style(b.dom,"padding"+SJL.ucfirst(d),SJL.generate_px_percent(b.padding[d]))}b.dom.appendChild(b.p_paragraph)},this.get_text=function(){var a=this;return a.text},this.set_html=function(a){var b=this,c=SJL.dom("#"+b.p_paragraph.id);if(c)return c.set_html(a),b.text=a,b},this.set_text=function(a){var b=this,c=SJL.dom("#"+b.p_paragraph.id);if(c)return c.set_text(a),b.text=a,b},this.set_text_align=function(a){var b=this,c=SJL.dom("#"+b.dom.id);if(c)return c.set_style("text-align",a),b.text_align=a,b},this.get_text_align=function(){var a=this;return a.text_align},this.get_text_color=function(){var a=this;return a.text_color},this.set_text_color=function(a){var b=this,c=SJL.dom("#"+b.p_paragraph.id);if(c)return c.set_style("text-color",a),b.text_color=a,b},this.get_text_class=function(){var a=this;return a.text_class},this.get_bg_color_class=function(){var a=this;return a.bg_color_class},this.get_font_name=function(){var a=this;return a.font_name},this.get_font_size=function(){var a=this;return a.font_size},this.init(),this};