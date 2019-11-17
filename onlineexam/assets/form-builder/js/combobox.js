"use strict";SJL.combobox=function(a){return a=a||{},SJL.add_config(this,a),this._component="combobox",this.text=a.text||"My Combo",this.name=a.name||"",this.text_align=a.text_align||"",this.input_size=a.input_size||"",this.seperator=a.seperator||":",this.display=a.display||"inline",this.signals=a.signals||{},this.input_margin=a.input_margin||{},this.label_margin=a.label_margin||{},this.margin=a.margin||{},this.padding=a.padding||{},this.label_width=a.label_width||2,this.data_value=a.data_value||"",this.store=a.store||"[{key:'test1',value:'t1'},{key:'test2',value:'t2'},{key:'test3',value:'t3'}]",this.multiple=a.multiple||!1,this.init=function(){var b=this;b.base_id=SJL.generate_id(a.id);if(b.label=new SJL.label({text:b.text,text_align:b.text_align,seperator:b.seperator,display:b.display,label_width:b.label_width,font_name:b.font_name||"",font_style:b.font_style||"normal",font_weight:b.font_weight||"normal",font_size:b.font_size||"",color:b.color||"black"}),SJL.is_object(b.label_margin))for(var d in b.label_margin){var e=SJL.trim(d).toLowerCase();"left"!=e&&"right"!=e&&"top"!=e&&"bottom"!=e||SJL.set_style(b.label.dom,"margin"+SJL.ucfirst(d),SJL.generate_px_percent(b.label.dom[d]))}if(SJL.is_object(b.label_padding))for(var d in b.label_padding){var e=SJL.trim(d).toLowerCase();"left"!=e&&"right"!=e&&"top"!=e&&"bottom"!=e||SJL.set_style(b.dom,"padding"+SJL.ucfirst(d),SJL.generate_px_percent(b.label_padding[d]))}if(b.dom=SJL.create_element("div",{id:b.base_id+"-"+this._component+"-dom"}),b.dom.add_css_class("sjl_form-group"),SJL.is_object(b.margin))for(var d in b.margin){var e=SJL.trim(d).toLowerCase();"left"!=e&&"right"!=e&&"top"!=e&&"bottom"!=e||SJL.set_style(b.dom,"margin"+SJL.ucfirst(d),SJL.generate_px_percent(b.margin[d]))}if(SJL.is_object(b.padding))for(var d in b.padding){var e=SJL.trim(d).toLowerCase();"left"!=e&&"right"!=e&&"top"!=e&&"bottom"!=e||SJL.set_style(b.dom,"padding"+SJL.ucfirst(d),SJL.generate_px_percent(b.padding[d]))}if(b.div_combobox=SJL.create_element("div",{id:b.base_id+"-"+this._component+"-div_combobox"}),"inline"==b.display?b.div_combobox.add_css_class("sjl_col-sm-"+(12-b.label_width).toString()):b.div_combobox.add_css_class("sjl_col-sm-12"),b.select_combobox=SJL.create_element("select",{id:b.base_id+"-"+this._component+"-select_combobox"}),b.multiple&&SJL.set_attr(b.select_combobox,"multiple",!0),""!=b.name&&SJL.set_attr(b.select_combobox,"name",b.name),b.select_combobox.add_css_class("sjl_form-control"),b.select_combobox.add_css_class(""),b.input_size&&b.select_combobox.add_css_class("sjl_input-"+b.input_size),SJL.is_array(b.store))for(var f=0;f<b.store.length;++f){var g=SJL.create_element("option",{value:b.store[f].value});g.innerHTML=b.store[f].key,b.data_value==b.store[f].value&&g.setAttribute("selected","selected"),b.select_combobox.appendChild(g)}if(SJL.is_object(b.input_margin))for(var d in b.input_margin){var e=SJL.trim(d).toLowerCase();"left"!=e&&"right"!=e&&"top"!=e&&"bottom"!=e||SJL.set_style(b.div_combobox,"margin"+SJL.ucfirst(d),SJL.generate_px_percent(b.input_margin[d]))}if(b.div_combobox.appendChild(b.select_combobox),b.dom.appendChild(b.label.dom),b.dom.appendChild(b.div_combobox),SJL.is_object(b.signals))for(var h in b.signals)SJL.add_event(b.select_combobox,h,b.signals[h],[])},this.set_text=function(a){var b=this,c=document.getElementById(b.select_combobox.id);c.value=a.toString()},this.get_text=function(){var a=this,b=document.getElementById(a.select_combobox.id),c=b.selectedOptions,d=[];if(SJL.is_array(c)&&c.length>=1)for(var e=0;e<c.length;++e)d.push(c[e].text);return d},this.get_label=function(){var a=this;return a.label.get_text()},this.set_label=function(a){var b=this;return b.label.set_text(a),b},this.get_store=function(){var a=this;return a.store},this.set_store=function(a){var b=this;if(SJL.is_array(a)){var c=document.getElementById(b.select_combobox.id);c.innerHTML="";for(var d=0;d<a.length;++d)if(SJL.is_array(a)&&a[d].key&&a[d].value){var e=SJL.create_element("option",{value:a[d].value});e.innerHTML=a[d].key,c.appendChild(e)}b.store=a}return b},this.get_value=function(){var a=this,b=document.getElementById(a.select_combobox.id),c=b.selectedOptions,d=[];if(SJL.is_array(c)&&c.length>=1)for(var e=0;e<c.length;++e)d.push(c[e].value);return d},this.set_value=function(a){for(var b=this,e=(b.get_store(),document.getElementById(b.select_combobox.id)),f=e.options,g=0;g<f.length;++g)f[g].value==a&&(f[g].selected=!0,b.data_value=a);return b},this.set_key=function(a){for(var b=this,e=(b.get_store(),document.getElementById(b.select_combobox.id)),f=e.options,g=0;g<f.length;++g)f[g].innerHTML==a&&(f[g].selected=!0);return b},this.get_key=function(){var a=this,b=document.getElementById(a.select_combobox.id),c=b.selectedOptions,d=[];if(SJL.is_array(c)&&c.length>=1)for(var e=0;e<c.length;++e)d.push(c[e].text);return d},this.get_index=function(){var a=this,b=document.getElementById(a.select_combobox.id),c=b.selectedOptions;if(SJL.is_array(c)&&c.length>=1){for(var d=[],e=0;e<c.length;++e)d.push(c[e].index);return d}},this.set_input_size=function(a){var b=this,c=["mini","small","medium","large","xlarge","xxlarge","xxxlarge"],d=SJL.dom("#"+b.div_combobox.id);return c.every(function(a){d.remove_css_class("sjl_input-"+a)}),d.add_css_class("sjl_input-"+a),b.input_size=a,b},this.get_input_size=function(){var a=this;return a.input_size},this.set_label_weight=function(a){var b=this;if(a=SJL.intVal(a),!(a>12||a<0)){var c=document.getElementById(b.label.dom.id),d=document.getElementById(b.div_combobox.id);if(d&&c){var e=c.className;e=e.match(/sjl_col-sm-\d+/gi);for(var f=0;f<e.length;++f)SJL.remove_css_class(c,e[f]);SJL.add_css_class(c,"sjl_col-sm-"+a.toString()),e=d.className,e=e.match(/sjl_col-sm-\d+/gi);for(var f=0;f<e.length;++f)SJL.remove_css_class(d,e[f]);return SJL.add_css_class(d,"sjl_col-sm-"+(12-a).toString()),b}}},this.set_label_width=function(a){var b=this;if(a=SJL.intVal(a),!(a>12||a<0)){var c=document.getElementById(b.label.dom.id),d=document.getElementById(b.div_combobox.id);if(d&&c){var e=c.className;e=e.match(/sjl_col-sm-\d+/gi);for(var f=0;f<e.length;++f)SJL.remove_css_class(c,e[f]);SJL.add_css_class(c,"sjl_col-sm-"+a.toString()),e=d.className,e=e.match(/sjl_col-sm-\d+/gi);for(var f=0;f<e.length;++f)SJL.remove_css_class(d,e[f]);SJL.add_css_class(d,"sjl_col-sm-"+(12-a).toString()),b.label_width=a,b.label.label_width=a}}},this.get_label_width=function(){var a=this;return a.label_width},this.get_name=function(){var a=this;return a.name},this.set_name=function(a){var b=this;return b.name=a,b},this.init(),this};