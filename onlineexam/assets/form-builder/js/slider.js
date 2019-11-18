"use strict";SJL.slider=function(a){return a=a||{},SJL.add_config(this,a),this._component="slider",this.name=a.name||"",this.step=SJL.intVal(a.step)||"1",this.max=SJL.intVal(a.max)||"100",this.min=SJL.intVal(a.min)||"0",this.data_value=SJL.intVal(a.data_value)||"",this.margin=a.margin||{},this.width=a.width||"",this.padding=a.padding||{},this.init=function(){var b=this;b.base_id=SJL.generate_id(a.id);if(b.margin_top&&(b.margin.top=b.margin_top),b.margin_bottom&&(b.margin.bottom=b.margin_bottom),b.margin_left&&(b.margin.left=b.margin_left),b.margin_right&&(b.margin.right=b.margin_right),b.dom=SJL.create_element("div",{id:b.base_id+"-"+this._component+"-dom"}),b.input_slider=SJL.create_element("input",{id:b.base_id+"-"+this._component+"-input_slider",max:b.max,min:b.min,value:b.data_value,step:b.step,name:b.name,type:"range"}),""!=b.width&&SJL.set_style(b.input_slider,"width",SJL.generate_px_percent(b.width)),SJL.is_object(b.signals))for(var d in b.signals)SJL.add_event(b.input_slider,d,b.signals[d],[b.input_slider]);if(SJL.is_object(b.margin))for(var e in b.margin){var f=SJL.trim(e).toLowerCase();"left"!=f&&"right"!=f&&"top"!=f&&"bottom"!=f||(b.dom.style["margin"+SJL.ucfirst(e)]=SJL.generate_px_percent(b.margin[e]))}if(SJL.is_object(b.padding))for(var e in b.padding){var f=SJL.trim(e).toLowerCase();"left"!=f&&"right"!=f&&"top"!=f&&"bottom"!=f||(b.dom.style["padding"+SJL.ucfirst(e)]=SJL.generate_px_percent(b.padding[e]))}b.dom.appendChild(b.input_slider)},this.get_value=function(){var a=this;return a.data_value},this.init(),this};