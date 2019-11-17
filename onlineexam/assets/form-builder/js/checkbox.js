"use strict";SJL.checkbox=function(a){return a=a||{},SJL.add_config(this,a),this._component="checkbox",this.label_margin=a.label_margin||{},this.margin=a.margin||{},this.input_margin=a.input_margin||{},this.padding=a.padding||{},this.items=a.items||[{name:"no_name",text:"default",value:"true",checked:!1}],this.label_padding=a.label_padding||{},this.margin_left=a.margin_left||"0",this.margin_right=a.margin_right||"0",this.init=function(){var b=this;b.base_id=SJL.generate_id(a.id);b.margin_left=SJL.generate_px_percent(SJL.intVal(b.margin_left)),b.margin_right=SJL.generate_px_percent(SJL.intVal(b.margin_right)),b.dom=SJL.create_element("div",{id:b.base_id+"-"+this._component+"-dom"}),b.dom.style.marginLeft=b.margin_left,b.dom.style.marginRight=b.margin_right;for(var d=0;d<b.items.length;++d)b.label_checkbox=SJL.create_element("label",{id:b.base_id+"-"+this._component+"-label_checkbox-"+d.toString()}),b.label_checkbox.add_css_class("sjl_checkbox-inline"),SJL.set_style(b.label_checkbox,"position","relative"),SJL.set_style(b.label_checkbox,"margin-left","3px"),SJL.set_style(b.label_checkbox,"margin-right","3px"),b.input_checkbox=SJL.create_element("input",{id:b.base_id+"-"+this._component+"-input_checkbox-"+d.toString(),type:"checkbox"}),b.span_checkbox=SJL.create_element("span",{id:b.base_id+"-"+this._component+"-span_checkbox-"+d.toString()}),b.items[d]&&"undefined"!=typeof b.items[d].checked&&1==b.items[d].checked?SJL.set_attr(b.input_checkbox,"checked",!0):SJL.remove_attr(b.input_checkbox,"checked"),b.items[d]&&"undefined"!=typeof b.items[d].disabled&&1==b.items[d].disabled&&(b.input_checkbox.disabled=!0),b.items[d]&&"undefined"!=typeof b.items[d].name&&"string"==typeof b.items[d].name&&(b.input_checkbox.name=b.items[d].name),b.items[d]&&"undefined"!=typeof b.items[d].value&&(b.input_checkbox.value=b.items[d].value),b.items[d]&&"undefined"!=typeof b.items[d].text&&"string"==typeof b.items[d].text&&SJL.set_html(b.span_checkbox,b.items[d].text),SJL.add_event(b.input_checkbox,"change",function(){this.value=this.checked?"on":"off"},[]),b.label_checkbox.appendChild(b.input_checkbox),b.label_checkbox.appendChild(b.span_checkbox),b.dom.appendChild(b.label_checkbox);if(SJL.is_object(b.margin))for(var e in b.margin){var f=e.trim().toLowerCase();"left"!=f&&"right"!=f&&"top"!=f&&"bottom"!=f||(b.dom.style["margin"+SJL.ucfirst(e)]=SJL.generate_px_percent(b.margin[e]))}if(SJL.is_object(b.padding))for(var e in b.padding){var f=e.trim().toLowerCase();"left"!=f&&"right"!=f&&"top"!=f&&"bottom"!=f||(b.dom.style["padding"+SJL.ucfirst(e)]=SJL.generate_px_percent(b.padding[e]))}},this.is_checked=function(){},this.is_disabled=function(){},this.set_check=function(a){},this.set_disabled=function(a){},this.get_label=function(){},this.set_label=function(a){},this.init(),this};