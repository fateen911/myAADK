"use strict";function _typeof(t){return(_typeof="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function _typeof(t){return(_typeof="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}!function(r){var t=function(t,e){var n=e.getElementsByClassName(t)[0];if(!n&&((n=document.createElement("canvas")).className=t,n.style.direction="ltr",n.style.position="absolute",n.style.left="0px",n.style.top="0px",e.appendChild(n),!n.getContext))throw new Error("Canvas is not available.");this.element=n;var i=this.context=n.getContext("2d");this.pixelRatio=r.plot.browser.getPixelRatio(i);var o=r(e).width(),a=r(e).height();this.resize(o,a),this.SVGContainer=null,this.SVG={},this._textCache={}};function f(e,t){e.transform.baseVal.clear(),t&&t.forEach(function(t){e.transform.baseVal.appendItem(t)})}t.prototype.resize=function(t,e){t=t<10?10:t,e=e<10?10:e;var n=this.element,i=this.context,o=this.pixelRatio;this.width!==t&&(n.width=t*o,n.style.width=t+"px",this.width=t),this.height!==e&&(n.height=e*o,n.style.height=e+"px",this.height=e),i.restore(),i.save(),i.scale(o,o)},t.prototype.clear=function(){this.context.clearRect(0,0,this.width,this.height)},t.prototype.render=function(){var t=this._textCache;for(var e in t)if(hasOwnProperty.call(t,e)){var n=this.getSVGLayer(e),i=t[e],o=n.style.display;for(var a in n.style.display="none",i)if(hasOwnProperty.call(i,a)){var r=i[a];for(var s in r)if(hasOwnProperty.call(r,s)){for(var l,c=r[s],u=c.positions,p=0;u[p];p++)if((l=u[p]).active)l.rendered||(n.appendChild(l.element),l.rendered=!0);else if(u.splice(p--,1),l.rendered){for(;l.element.firstChild;)l.element.removeChild(l.element.firstChild);l.element.parentNode.removeChild(l.element)}0===u.length&&(c.measured?c.measured=!1:delete r[s])}}n.style.display=o}},t.prototype.getSVGLayer=function(t){var e,n=this.SVG[t];n||(this.SVGContainer?e=this.SVGContainer.firstChild:(this.SVGContainer=document.createElement("div"),this.SVGContainer.className="flot-svg",this.SVGContainer.style.position="absolute",this.SVGContainer.style.top="0px",this.SVGContainer.style.left="0px",this.SVGContainer.style.height="100%",this.SVGContainer.style.width="100%",this.SVGContainer.style.pointerEvents="none",this.element.parentNode.appendChild(this.SVGContainer),(e=document.createElementNS("http://www.w3.org/2000/svg","svg")).style.width="100%",e.style.height="100%",this.SVGContainer.appendChild(e)),(n=document.createElementNS("http://www.w3.org/2000/svg","g")).setAttribute("class",t),n.style.position="absolute",n.style.top="0px",n.style.left="0px",n.style.bottom="0px",n.style.right="0px",e.appendChild(n),this.SVG[t]=n);return n},t.prototype.getTextInfo=function(t,e,n,i,o){var a,r,s,l;e=""+e,a="object"===_typeof(n)?n.style+" "+n.variant+" "+n.weight+" "+n.size+"px/"+n.lineHeight+"px "+n.family:n,null==(r=this._textCache[t])&&(r=this._textCache[t]={}),null==(s=r[a])&&(s=r[a]={});var c=e.replace(/0|1|2|3|4|5|6|7|8|9/g,"0");if(!(l=s[c])){var u=document.createElementNS("http://www.w3.org/2000/svg","text");if(-1!==e.indexOf("<br>"))m(e,u,-9999);else{var p=document.createTextNode(e);u.appendChild(p)}u.style.position="absolute",u.style.maxWidth=o,u.setAttributeNS(null,"x",-9999),u.setAttributeNS(null,"y",-9999),"object"===_typeof(n)?(u.style.font=a,u.style.fill=n.fill):"string"==typeof n&&u.setAttribute("class",n),this.getSVGLayer(t).appendChild(u);var h=u.getBBox();for(l=s[c]={width:h.width,height:h.height,measured:!0,element:u,positions:[]};u.firstChild;)u.removeChild(u.firstChild);u.parentNode.removeChild(u)}return l.measured=!0,l},t.prototype.addText=function(t,e,n,i,o,a,r,s,l,c){var u=this.getTextInfo(t,i,o,a,r),p=u.positions;"center"===s?e-=u.width/2:"right"===s&&(e-=u.width),"middle"===l?n-=u.height/2:"bottom"===l&&(n-=u.height),n+=.75*u.height;for(var h,d=0;p[d];d++){if((h=p[d]).x===e&&h.y===n&&h.text===i)return h.active=!0,void f(h.element,c);if(!1===h.active)return h.active=!0,-1!==(h.text=i).indexOf("<br>")?(n-=.25*u.height,m(i,h.element,e)):h.element.textContent=i,h.element.setAttributeNS(null,"x",e),h.element.setAttributeNS(null,"y",n),h.x=e,h.y=n,void f(h.element,c)}h={active:!0,rendered:!1,element:p.length?u.element.cloneNode():u.element,text:i,x:e,y:n},p.push(h),-1!==i.indexOf("<br>")?(n-=.25*u.height,m(i,h.element,e)):h.element.textContent=i,h.element.setAttributeNS(null,"x",e),h.element.setAttributeNS(null,"y",n),h.element.style.textAlign=s,f(h.element,c)};var m=function(t,e,n){var i,o,a,r=t.split("<br>");for(o=0;o<r.length;o++)e.childNodes[o]?i=e.childNodes[o]:(i=document.createElementNS("http://www.w3.org/2000/svg","tspan"),e.appendChild(i)),i.textContent=r[o],a=(0===o?0:1)+"em",i.setAttributeNS(null,"dy",a),i.setAttributeNS(null,"x",n)};t.prototype.removeText=function(t,e,n,i,o,a){var r,s;if(null==i){var l=this._textCache[t];if(null!=l)for(var c in l)if(hasOwnProperty.call(l,c)){var u=l[c];for(var p in u)if(hasOwnProperty.call(u,p)){var h=u[p].positions;h.forEach(function(t){t.active=!1})}}}else(h=(r=this.getTextInfo(t,i,o,a)).positions).forEach(function(t){s=n+.75*r.height,t.x===e&&t.y===s&&t.text===i&&(t.active=!1)})},t.prototype.clearCache=function(){var t=this._textCache;for(var e in t)if(hasOwnProperty.call(t,e))for(var n=this.getSVGLayer(e);n.firstChild;)n.removeChild(n.firstChild);this._textCache={}},window.Flot||(window.Flot={}),window.Flot.Canvas=t}(jQuery),function(a){a.color={},a.color.make=function(t,e,n,i){var o={};return o.r=t||0,o.g=e||0,o.b=n||0,o.a=null!=i?i:1,o.add=function(t,e){for(var n=0;n<t.length;++n)o[t.charAt(n)]+=e;return o.normalize()},o.scale=function(t,e){for(var n=0;n<t.length;++n)o[t.charAt(n)]*=e;return o.normalize()},o.toString=function(){return 1<=o.a?"rgb("+[o.r,o.g,o.b].join(",")+")":"rgba("+[o.r,o.g,o.b,o.a].join(",")+")"},o.normalize=function(){function t(t,e,n){return e<t?t:n<e?n:e}return o.r=t(0,parseInt(o.r),255),o.g=t(0,parseInt(o.g),255),o.b=t(0,parseInt(o.b),255),o.a=t(0,o.a,1),o},o.clone=function(){return a.color.make(o.r,o.b,o.g,o.a)},o.normalize()},a.color.extract=function(t,e){var n;do{if(""!==(n=t.css(e).toLowerCase())&&"transparent"!==n)break;t=t.parent()}while(t.length&&!a.nodeName(t.get(0),"body"));return"rgba(0, 0, 0, 0)"===n&&(n="transparent"),a.color.parse(n)},a.color.parse=function(t){var e,n=a.color.make;if(e=/rgb\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*\)/.exec(t))return n(parseInt(e[1],10),parseInt(e[2],10),parseInt(e[3],10));if(e=/rgba\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]+(?:\.[0-9]+)?)\s*\)/.exec(t))return n(parseInt(e[1],10),parseInt(e[2],10),parseInt(e[3],10),parseFloat(e[4]));if(e=/rgb\(\s*([0-9]+(?:\.[0-9]+)?)%\s*,\s*([0-9]+(?:\.[0-9]+)?)%\s*,\s*([0-9]+(?:\.[0-9]+)?)%\s*\)/.exec(t))return n(2.55*parseFloat(e[1]),2.55*parseFloat(e[2]),2.55*parseFloat(e[3]));if(e=/rgba\(\s*([0-9]+(?:\.[0-9]+)?)%\s*,\s*([0-9]+(?:\.[0-9]+)?)%\s*,\s*([0-9]+(?:\.[0-9]+)?)%\s*,\s*([0-9]+(?:\.[0-9]+)?)\s*\)/.exec(t))return n(2.55*parseFloat(e[1]),2.55*parseFloat(e[2]),2.55*parseFloat(e[3]),parseFloat(e[4]));if(e=/#([a-fA-F0-9]{2})([a-fA-F0-9]{2})([a-fA-F0-9]{2})/.exec(t))return n(parseInt(e[1],16),parseInt(e[2],16),parseInt(e[3],16));if(e=/#([a-fA-F0-9])([a-fA-F0-9])([a-fA-F0-9])/.exec(t))return n(parseInt(e[1]+e[1],16),parseInt(e[2]+e[2],16),parseInt(e[3]+e[3],16));var i=a.trim(t).toLowerCase();return"transparent"===i?n(255,255,255,0):n((e=o[i]||[0,0,0])[0],e[1],e[2])};var o={aqua:[0,255,255],azure:[240,255,255],beige:[245,245,220],black:[0,0,0],blue:[0,0,255],brown:[165,42,42],cyan:[0,255,255],darkblue:[0,0,139],darkcyan:[0,139,139],darkgrey:[169,169,169],darkgreen:[0,100,0],darkkhaki:[189,183,107],darkmagenta:[139,0,139],darkolivegreen:[85,107,47],darkorange:[255,140,0],darkorchid:[153,50,204],darkred:[139,0,0],darksalmon:[233,150,122],darkviolet:[148,0,211],fuchsia:[255,0,255],gold:[255,215,0],green:[0,128,0],indigo:[75,0,130],khaki:[240,230,140],lightblue:[173,216,230],lightcyan:[224,255,255],lightgreen:[144,238,144],lightgrey:[211,211,211],lightpink:[255,182,193],lightyellow:[255,255,224],lime:[0,255,0],magenta:[255,0,255],maroon:[128,0,0],navy:[0,0,128],olive:[128,128,0],orange:[255,165,0],pink:[255,192,203],purple:[128,0,128],violet:[128,0,128],red:[255,0,0],silver:[192,192,192],white:[255,255,255],yellow:[255,255,0]}}(jQuery),function(K){var $=window.Flot.Canvas;function tt(t){var e,n=[],i=K.plot.saturated.saturate(K.plot.saturated.floorInBase(t.min,t.tickSize)),o=0,a=Number.NaN;for(i===-Number.MAX_VALUE&&(n.push(i),i=K.plot.saturated.floorInBase(t.min+t.tickSize,t.tickSize));e=a,a=K.plot.saturated.multiplyAdd(t.tickSize,o,i),n.push(a),++o,a<t.max&&a!==e;);return n}function et(t,e,n){var i=e.tickDecimals;if(-1!==(""+t).indexOf("e"))return l(t,e,n);0<n&&(e.tickDecimals=n);var o=e.tickDecimals?parseFloat("1e"+e.tickDecimals):1,a=""+Math.round(t*o)/o;if(null!=e.tickDecimals){var r=a.indexOf("."),s=-1===r?0:a.length-r-1;if(s<e.tickDecimals)a=(s?a:a+".")+(""+o).substr(1,e.tickDecimals-s)}return e.tickDecimals=i,a}function l(t,e,n){var i=(""+t).indexOf("e"),o=parseInt((""+t).substr(i+1)),a=-1!==i?o:0<t?Math.floor(Math.log(t)/Math.LN10):0,r=parseFloat("1e"+a),s=t/r;if(n){var l=c(t,n);return(t/r).toFixed(l)+"e"+a}return 0<e.tickDecimals?s.toFixed(c(t,e.tickDecimals))+"e"+a:s.toFixed()+"e"+a}function c(t,e){var n=Math.log(Math.abs(t))*Math.LOG10E,i=Math.abs(n+e);return i<=20?Math.floor(i):20}function i(l,t,e,i){var y=[],f={colors:["#edc240","#afd8f8","#cb4b4b","#4da74d","#9440ed"],xaxis:{show:null,position:"bottom",mode:null,font:null,color:null,tickColor:null,transform:null,inverseTransform:null,min:null,max:null,autoScaleMargin:null,autoScale:"exact",windowSize:null,growOnly:null,ticks:null,tickFormatter:null,showTickLabels:"major",labelWidth:null,labelHeight:null,reserveSpace:null,tickLength:null,showMinorTicks:null,showTicks:null,gridLines:null,alignTicksWithAxis:null,tickDecimals:null,tickSize:null,minTickSize:null,offset:{below:0,above:0},boxPosition:{centerX:0,centerY:0}},yaxis:{autoScaleMargin:.02,autoScale:"loose",growOnly:null,position:"left",showTickLabels:"major",offset:{below:0,above:0},boxPosition:{centerX:0,centerY:0}},xaxes:[],yaxes:[],series:{points:{show:!1,radius:3,lineWidth:2,fill:!0,fillColor:"#ffffff",symbol:"circle"},lines:{lineWidth:1,fill:!1,fillColor:null,steps:!1},bars:{show:!1,lineWidth:2,horizontal:!1,barWidth:.8,fill:!0,fillColor:null,align:"left",zero:!0},shadowSize:3,highlightColor:null},grid:{show:!0,aboveData:!1,color:"#545454",backgroundColor:null,borderColor:null,tickColor:null,margin:0,labelMargin:5,axisMargin:8,borderWidth:1,minBorderMargin:null,markings:null,markingsColor:"#f4f4f4",markingsLineWidth:2,clickable:!1,hoverable:!1,autoHighlight:!0,mouseActiveRadius:15},interaction:{redrawOverlayInterval:1e3/60},hooks:{}},x=null,n=null,o=null,g=null,a=null,m=[],v=[],b={left:0,right:0,top:0,bottom:0},w=0,T=0,k={processOptions:[],processRawData:[],processDatapoints:[],processOffset:[],setupGrid:[],adjustSeriesDataRange:[],setRange:[],drawBackground:[],drawSeries:[],drawAxis:[],draw:[],findNearbyItems:[],axisReserveSpace:[],bindEvents:[],drawOverlay:[],resize:[],shutdown:[]},M=this,r={},s=null;M.setData=c,M.setupGrid=A,M.draw=W,M.getPlaceholder=function(){return l},M.getCanvas=function(){return x.element},M.getSurface=function(){return x},M.getEventHolder=function(){return o[0]},M.getPlotOffset=function(){return b},M.width=function(){return w},M.height=function(){return T},M.offset=function(){var t=o.offset();return t.left+=b.left,t.top+=b.top,t},M.getData=function(){return y},M.getAxes=function(){var n={};return K.each(m.concat(v),function(t,e){e&&(n[e.direction+(1!==e.n?e.n:"")+"axis"]=e)}),n},M.getXAxes=function(){return m},M.getYAxes=function(){return v},M.c2p=function(t){var e,n,i={};for(e=0;e<m.length;++e)(n=m[e])&&n.used&&(i["x"+n.n]=n.c2p(t.left));for(e=0;e<v.length;++e)(n=v[e])&&n.used&&(i["y"+n.n]=n.c2p(t.top));void 0!==i.x1&&(i.x=i.x1);void 0!==i.y1&&(i.y=i.y1);return i},M.p2c=function(t){var e,n,i,o={};for(e=0;e<m.length;++e)if((n=m[e])&&n.used&&(i="x"+n.n,null==t[i]&&1===n.n&&(i="x"),null!=t[i])){o.left=n.p2c(t[i]);break}for(e=0;e<v.length;++e)if((n=v[e])&&n.used&&(i="y"+n.n,null==t[i]&&1===n.n&&(i="y"),null!=t[i])){o.top=n.p2c(t[i]);break}return o},M.getOptions=function(){return f},M.triggerRedrawOverlay=Q,M.pointOffset=function(t){return{left:parseInt(m[N(t,"x")-1].p2c(+t.x)+b.left,10),top:parseInt(v[N(t,"y")-1].p2c(+t.y)+b.top,10)}},M.shutdown=u,M.destroy=function(){u(),l.removeData("plot").empty(),y=[],m=[],v=[],M=k=a=g=o=n=x=f=null},M.resize=function(){var t=l.width(),e=l.height();x.resize(t,e),n.resize(t,e),C(k.resize,[t,e])},M.clearTextCache=function(){x.clearCache(),n.clearCache()},M.autoScaleAxis=E,M.computeRangeForDataSeries=function(t,e,n){for(var i=t.datapoints.points,o=t.datapoints.pointsize,a=t.datapoints.format,r=Number.POSITIVE_INFINITY,s=Number.NEGATIVE_INFINITY,l={xmin:r,ymin:r,xmax:s,ymax:s},c=0;c<i.length;c+=o)if(null!==i[c]&&("function"!=typeof n||n(i[c])))for(var u=0;u<o;++u){var p=i[c+u],h=a[u];null!=h&&(("function"!=typeof n||n(p))&&(e||h.computeRange)&&p!==1/0&&p!==-1/0&&(!0===h.x&&(p<l.xmin&&(l.xmin=p),p>l.xmax&&(l.xmax=p)),!0===h.y&&(p<l.ymin&&(l.ymin=p),p>l.ymax&&(l.ymax=p))))}return l},M.adjustSeriesDataRange=function(t,e){if(t.bars.show){var n,i=t.bars.barWidth[1];t.datapoints&&t.datapoints.points&&!i&&function(t){var e=[],n=t.datapoints.pointsize,i=Number.MAX_VALUE;t.datapoints.points.length<=n&&(i=1);for(var o=t.bars.horizontal?1:0;o<t.datapoints.points.length;o+=n)isFinite(t.datapoints.points[o])&&null!==t.datapoints.points[o]&&e.push(t.datapoints.points[o]);(e=e.filter(function(t,e,n){return n.indexOf(t)===e})).sort(function(t,e){return t-e});for(var a=1;a<e.length;a++){var r=Math.abs(e[a]-e[a-1]);r<i&&isFinite(r)&&(i=r)}"number"==typeof t.bars.barWidth?t.bars.barWidth=t.bars.barWidth*i:t.bars.barWidth[0]=t.bars.barWidth[0]*i}(t);var o=t.bars.barWidth[0]||t.bars.barWidth;switch(t.bars.align){case"left":n=0;break;case"right":n=-o;break;default:n=-o/2}t.bars.horizontal?(e.ymin+=n,e.ymax+=n+o):(e.xmin+=n,e.xmax+=n+o)}if(t.bars.show&&t.bars.zero||t.lines.show&&t.lines.zero){var a=t.datapoints.pointsize;a<=2&&(e.ymin=Math.min(0,e.ymin),e.ymax=Math.max(0,e.ymax))}return e},M.findNearbyItem=function(t,e,n,i,o){var a=_(t,e,n,i,o);return void 0!==a[0]?a[0]:null},M.findNearbyItems=_,M.findNearbyInterpolationPoint=function(t,e,n){var i,o,a,r,s,l,c,u=Number.MAX_VALUE;for(i=0;i<y.length;++i)if(n(i)){var p=y[i].datapoints.points;l=y[i].datapoints.pointsize;var h=p[p.length-l]<p[0]?function(t,e){return e<t}:function(t,e){return t<e};if(!h(t,p[0])){for(o=l;o<p.length&&!h(t,p[o]);o+=l);var d=p[o-l],f=p[o-l+1],m=p[o],g=p[o+1];void 0!==d&&void 0!==m&&void 0!==f&&void 0!==g&&(e=d===m?g:f+(g-f)*(t-d)/(m-d),r=Math.abs(y[i].xaxis.p2c(m)-t),s=Math.abs(y[i].yaxis.p2c(g)-e),(a=r*r+s*s)<u&&(u=a,c=[t,e,i,o]))}}if(c)return i=c[2],o=c[3],l=y[i].datapoints.pointsize,p=y[i].datapoints.points,d=p[o-l],f=p[o-l+1],m=p[o],g=p[o+1],{datapoint:[c[0],c[1]],leftPoint:[d,f],rightPoint:[m,g],seriesIndex:i};return null},M.computeValuePrecision=I,M.computeTickSize=O,M.addEventHandler=function(t,e,n,i){var o=n+t,a=r[o]||[];a.push({event:t,handler:e,eventHolder:n,priority:i}),a.sort(function(t,e){return e.priority-t.priority}),a.forEach(function(t){t.eventHolder.unbind(t.event,t.handler),t.eventHolder.bind(t.event,t.handler)}),r[o]=a},M.hooks=k;var S=K.plot.uiConstants.MINOR_TICKS_COUNT_CONSTANT,P=K.plot.uiConstants.TICK_LENGTH_CONSTANT;function C(t,e){e=[M].concat(e);for(var n=0;n<t.length;++n)t[n].apply(this,e)}function c(t){var e=y;y=function(t){for(var e=[],n=0;n<t.length;++n){var i=K.extend(!0,{},f.series);null!=t[n].data?(i.data=t[n].data,delete t[n].data,K.extend(!0,i,t[n]),t[n].data=i.data):i.data=t[n],e.push(i)}return e}(t),function(){var t,e=y.length,n=-1;for(t=0;t<y.length;++t){var i=y[t].color;null!=i&&(e--,"number"==typeof i&&n<i&&(n=i))}e<=n&&(e=n+1);var o,a=[],r=f.colors,s=r.length,l=0,c=Math.max(0,y.length-e);for(t=0;t<e;t++)o=K.color.parse(r[(c+t)%s]||"#666"),t%s==0&&t&&(l=0<=l?l<.5?-l-.2:0:-l),a[t]=o.scale("rgb",1+l);var u,p=0;for(t=0;t<y.length;++t){if(null==(u=y[t]).color?(u.color=a[p].toString(),++p):"number"==typeof u.color&&(u.color=a[u.color].toString()),null==u.lines.show){var h,d=!0;for(h in u)if(u[h]&&u[h].show){d=!1;break}d&&(u.lines.show=!0)}null==u.lines.zero&&(u.lines.zero=!!u.lines.fill),u.xaxis=L(m,N(u,"x")),u.yaxis=L(v,N(u,"y"))}}(),function(t){var e,n,i,o,a,r,s,l,c,u,p,h,d=Number.POSITIVE_INFINITY,f=Number.NEGATIVE_INFINITY;function m(t,e,n){e<t.datamin&&e!==-1/0&&(t.datamin=e),n>t.datamax&&n!==1/0&&(t.datamax=n)}function g(t,e){return t&&t[e]&&t[e].datapoints&&t[e].datapoints.points?t[e].datapoints.points:[]}for(K.each(z(),function(t,e){!0!==e.options.growOnly?(e.datamin=d,e.datamax=f):(void 0===e.datamin&&(e.datamin=d),void 0===e.datamax&&(e.datamax=f)),e.used=!1}),e=0;e<y.length;++e)(a=y[e]).datapoints={points:[]},0===a.datapoints.points.length&&(a.datapoints.points=g(t,e)),C(k.processRawData,[a,a.data,a.datapoints]);for(e=0;e<y.length;++e){if(a=y[e],p=a.data,!(h=a.datapoints.format)){if((h=[]).push({x:!0,y:!1,number:!0,required:!0,computeRange:"none"!==a.xaxis.options.autoScale,defaultValue:null}),h.push({x:!1,y:!0,number:!0,required:!0,computeRange:"none"!==a.yaxis.options.autoScale,defaultValue:null}),a.stack||a.bars.show||a.lines.show&&a.lines.fill){var x=null!=a.datapoints.pointsize?a.datapoints.pointsize:a.data&&a.data[0]&&a.data[0].length?a.data[0].length:3;2<x&&h.push({x:a.bars.horizontal,y:!a.bars.horizontal,number:!0,required:!1,computeRange:"none"!==a.yaxis.options.autoScale,defaultValue:0})}a.datapoints.format=h}if(a.xaxis.used=a.yaxis.used=!0,null==a.datapoints.pointsize){for(a.datapoints.pointsize=h.length,s=a.datapoints.pointsize,r=a.datapoints.points,n=i=0;n<p.length;++n,i+=s){var v=null==(u=p[n]);if(!v)for(o=0;o<s;++o)l=u[o],(c=h[o])&&(c.number&&null!=l&&(l=+l,isNaN(l)&&(l=null)),null==l&&(c.required&&(v=!0),null!=c.defaultValue&&(l=c.defaultValue))),r[i+o]=l;if(v)for(o=0;o<s;++o)null!=(l=r[i+o])&&(c=h[o]).computeRange&&(c.x&&m(a.xaxis,l,l),c.y&&m(a.yaxis,l,l)),r[i+o]=null}r.length=i}}for(e=0;e<y.length;++e)a=y[e],C(k.processDatapoints,[a,a.datapoints]);for(e=0;e<y.length;++e)if(a=y[e],!(h=a.datapoints.format).every(function(t){return!t.computeRange})){var b=M.adjustSeriesDataRange(a,M.computeRangeForDataSeries(a));C(k.adjustSeriesDataRange,[a,b]),m(a.xaxis,b.xmin,b.xmax),m(a.yaxis,b.ymin,b.ymax)}K.each(z(),function(t,e){e.datamin===d&&(e.datamin=null),e.datamax===f&&(e.datamax=null)})}(e)}function N(t,e){var n=t[e+"axis"];return"object"===_typeof(n)&&(n=n.n),"number"!=typeof n&&(n=1),n}function z(){return m.concat(v).filter(function(t){return t})}function L(t,e){return t[e-1]||(t[e-1]={n:e,direction:t===m?"x":"y",options:K.extend(!0,{},t===m?f.xaxis:f.yaxis)}),t[e-1]}function u(){s&&clearTimeout(s),C(k.shutdown,[o])}function p(t){function e(t){return t}var n,i,o=t.options.transform||e,a=t.options.inverseTransform;i="x"===t.direction?(n=isFinite(o(t.max)-o(t.min))?t.scale=w/Math.abs(o(t.max)-o(t.min)):t.scale=1/Math.abs(K.plot.saturated.delta(o(t.min),o(t.max),w)),Math.min(o(t.max),o(t.min))):(n=-(n=isFinite(o(t.max)-o(t.min))?t.scale=T/Math.abs(o(t.max)-o(t.min)):t.scale=1/Math.abs(K.plot.saturated.delta(o(t.min),o(t.max),T))),Math.max(o(t.max),o(t.min))),t.p2c=o===e?function(t){return isFinite(t-i)?(t-i)*n:(t/4-i/4)*n*4}:function(t){var e=o(t);return isFinite(e-i)?(e-i)*n:(e/4-i/4)*n*4},t.c2p=a?function(t){return a(i+t/n)}:function(t){return i+t/n}}function h(n){C(k.axisReserveSpace,[n]);var t=n.labelWidth,e=n.labelHeight,i=n.options.position,o="x"===n.direction,a=n.options.tickLength,r=n.options.showTicks,s=n.options.showMinorTicks,l=n.options.gridLines,c=f.grid.axisMargin,u=f.grid.labelMargin,p=!0,h=!0,d=!1;K.each(o?m:v,function(t,e){e&&(e.show||e.reserveSpace)&&(e===n?d=!0:e.options.position===i&&(d?h=!1:p=!1))}),h&&(c=0),null==a&&(a=P),null==r&&(r=!0),null==s&&(s=!0),null==l&&(l=!!p),isNaN(+a)||(u+=r?+a:0),o?(e+=u,"bottom"===i?(b.bottom+=e+c,n.box={top:x.height-b.bottom,height:e}):(n.box={top:b.top+c,height:e},b.top+=e+c)):(t+=u,"left"===i?(n.box={left:b.left+c,width:t},b.left+=t+c):(b.right+=t+c,n.box={left:x.width-b.right,width:t})),n.position=i,n.tickLength=a,n.showMinorTicks=s,n.showTicks=r,n.gridLines=l,n.box.padding=u,n.innermost=p}function d(t,e,n){"x"===t.direction?("bottom"===t.position&&n(e.bottom)&&(t.box.top-=Math.ceil(e.bottom)),"top"===t.position&&n(e.top)&&(t.box.top+=Math.ceil(e.top))):("left"===t.position&&n(e.left)&&(t.box.left+=Math.ceil(e.left)),"right"===t.position&&n(e.right)&&(t.box.left-=Math.ceil(e.right)))}function A(a){var t,e,n=z(),i=f.grid.show;for(e in b)b[e]=0;for(e in C(k.processOffset,[b]),b)"object"===_typeof(f.grid.borderWidth)?b[e]+=i?f.grid.borderWidth[e]:0:b[e]+=i?f.grid.borderWidth:0;if(K.each(n,function(t,e){var n,i,o=e.options;e.show=null==o.show?e.used:o.show,e.reserveSpace=null==o.reserveSpace?e.show:o.reserveSpace,i=(n=e).options,n.tickFormatter||("function"==typeof i.tickFormatter?n.tickFormatter=function(){var t=Array.prototype.slice.call(arguments);return""+i.tickFormatter.apply(null,t)}:n.tickFormatter=et),C(k.setRange,[e,a]),function(t,e){var n="number"==typeof t.options.min?t.options.min:t.min,i="number"==typeof t.options.max?t.options.max:t.max,o=t.options.offset;e&&(E(t),n=t.autoScaledMin,i=t.autoScaledMax);if(n=(null!=n?n:-1)+(o.below||0),(i=(null!=i?i:1)+(o.above||0))<n){var a=n;n=i,i=a,t.options.offset={above:0,below:0}}t.min=K.plot.saturated.saturate(n),t.max=K.plot.saturated.saturate(i)}(e,a)}),i){w=x.width-b.left-b.right,T=x.height-b.bottom-b.top;var o=K.grep(n,function(t){return t.show||t.reserveSpace});for(K.each(o,function(t,e){var n,i,o,a;!function(t){var e,n=t.options;e=R(t.direction,x,n.ticks),t.delta=K.plot.saturated.delta(t.min,t.max,e);var i=M.computeValuePrecision(t.min,t.max,t.direction,e,n.tickDecimals);t.tickDecimals=Math.max(0,null!=n.tickDecimals?n.tickDecimals:i),t.tickSize=function(t,e,n,i,o){var a;a="number"==typeof i.ticks&&0<i.ticks?i.ticks:.3*Math.sqrt("x"===n?x.width:x.height);var r=O(t,e,a,o);return null!=i.minTickSize&&r<i.minTickSize&&(r=i.minTickSize),i.tickSize||r}(t.min,t.max,t.direction,n,n.tickDecimals),t.tickGenerator||("function"==typeof n.tickGenerator?t.tickGenerator=n.tickGenerator:t.tickGenerator=tt);if(null!=n.alignTicksWithAxis){var o=("x"===t.direction?m:v)[n.alignTicksWithAxis-1];if(o&&o.used&&o!==t){var a=t.tickGenerator(t,M);if(0<a.length&&(null==n.min&&(t.min=Math.min(t.min,a[0])),null==n.max&&1<a.length&&(t.max=Math.max(t.max,a[a.length-1]))),t.tickGenerator=function(t){var e,n,i=[];for(n=0;n<o.ticks.length;++n)e=(o.ticks[n].v-o.min)/(o.max-o.min),e=t.min+e*(t.max-t.min),i.push(e);return i},!t.mode&&null==n.tickDecimals){var r=Math.max(0,1-Math.floor(Math.log(t.delta)/Math.LN10)),s=t.tickGenerator(t,M);1<s.length&&/\..*0$/.test((s[1]-s[0]).toFixed(r))||(t.tickDecimals=r)}}}}(e),function(t){var e,n,i=t.options.ticks,o=[];null==i||"number"==typeof i&&0<i?o=t.tickGenerator(t,M):i&&(o=K.isFunction(i)?i(t):i);for(t.ticks=[],e=0;e<o.length;++e){var a=null,r=o[e];"object"===_typeof(r)?(n=+r[0],1<r.length&&(a=r[1])):n=+r,isNaN(n)||t.ticks.push(D(n,a,t,"major"))}}(e),i=(n=e).ticks,o=y,"loose"===n.options.autoScale&&0<i.length&&o.some(function(t){return 0<t.datapoints.points.length})&&(n.min=Math.min(n.min,i[0].v),n.max=Math.max(n.max,i[i.length-1].v)),p(e),function(e,t){if("endpoints"===e.options.showTickLabels)return!0;if("all"!==e.options.showTickLabels)return"major"!==e.options.showTickLabels&&"none"!==e.options.showTickLabels&&void 0;var n=t.filter(function(t){return t.bars.horizontal?t.yaxis===e:t.xaxis===e}),i=n.some(function(t){return!t.bars.show});return 0===n.length||i}(a=e,y)&&(a.ticks.unshift(D(a.min,null,a,"min")),a.ticks.push(D(a.max,null,a,"max"))),function(t){for(var e=t.options,n="none"!==e.showTickLabels&&t.ticks?t.ticks:[],i="major"===e.showTickLabels||"all"===e.showTickLabels,o="endpoints"===e.showTickLabels||"all"===e.showTickLabels,a=e.labelWidth||0,r=e.labelHeight||0,s=t.direction+"Axis "+t.direction+t.n+"Axis",l="flot-"+t.direction+"-axis flot-"+t.direction+t.n+"-axis "+s,c=e.font||"flot-tick-label tickLabel",u=0;u<n.length;++u){var p=n[u],h=p.label;if(p.label&&!(!1===i&&0<u&&u<n.length-1)&&(!1!==o||0!==u&&u!==n.length-1)){"object"===_typeof(p.label)&&(h=p.label.name);var d=x.getTextInfo(l,h,c);a=Math.max(a,d.width),r=Math.max(r,d.height)}}t.labelWidth=e.labelWidth||a,t.labelHeight=e.labelHeight||r}(e)}),t=o.length-1;0<=t;--t)h(o[t]);!function(){var t,e=f.grid.minBorderMargin;if(null==e)for(t=e=0;t<y.length;++t)e=Math.max(e,2*(y[t].points.radius+y[t].points.lineWidth/2));var n,i={},o={left:e,right:e,top:e,bottom:e};for(n in K.each(z(),function(t,e){e.reserveSpace&&e.ticks&&e.ticks.length&&("x"===e.direction?(o.left=Math.max(o.left,e.labelWidth/2),o.right=Math.max(o.right,e.labelWidth/2)):(o.bottom=Math.max(o.bottom,e.labelHeight/2),o.top=Math.max(o.top,e.labelHeight/2)))}),o)i[n]=o[n]-b[n];K.each(m.concat(v),function(t,e){d(e,i,function(t){return 0<t})}),b.left=Math.ceil(Math.max(o.left,b.left)),b.right=Math.ceil(Math.max(o.right,b.right)),b.top=Math.ceil(Math.max(o.top,b.top)),b.bottom=Math.ceil(Math.max(o.bottom,b.bottom))}(),K.each(o,function(t,e){var n;"x"===(n=e).direction?(n.box.left=b.left-n.labelWidth/2,n.box.width=x.width-b.left-b.right+n.labelWidth):(n.box.top=b.top-n.labelHeight/2,n.box.height=x.height-b.bottom-b.top+n.labelHeight)})}if(f.grid.margin){for(e in b){var r=f.grid.margin||0;b[e]+="number"==typeof r?r:r[e]||0}K.each(m.concat(v),function(t,e){d(e,f.grid.margin,function(t){return null!=t})})}w=x.width-b.left-b.right,T=x.height-b.bottom-b.top,K.each(n,function(t,e){p(e)}),i&&K.each(z(),function(t,i){var e,o,a,r,s,l,c,u=i.box,n=i.direction+"Axis "+i.direction+i.n+"Axis",p="flot-"+i.direction+"-axis flot-"+i.direction+i.n+"-axis "+n,h=i.options.font||"flot-tick-label tickLabel",d={x:NaN,y:NaN,width:NaN,height:NaN},f=[],m=function(t,e,n,i,o,a,r,s){return(t<=o&&o<=n||o<=t&&t<=r)&&(e<=a&&a<=i||a<=e&&e<=s)},g=function(t,e){return!t||!t.label||t.v<i.min||t.v>i.max?d:(l=x.getTextInfo(p,t.label,h),"x"===i.direction?(r="center",o=b.left+i.p2c(t.v),"bottom"===i.position?a=u.top+u.padding-i.boxPosition.centerY:(a=u.top+u.height-u.padding+i.boxPosition.centerY,s="bottom")):(s="middle",a=b.top+i.p2c(t.v),"left"===i.position?(o=u.left+u.width-u.padding-i.boxPosition.centerX,r="right"):o=u.left+u.padding+i.boxPosition.centerX),c={x:o-l.width/2-3,y:a-3,width:l.width+6,height:l.height+6},n=c,e.some(function(t){return m(n.x,n.y,n.x+n.width,n.y+n.height,t.x,t.y,t.x+t.width,t.y+t.height)})?d:(x.addText(p,o,a,t.label,h,null,null,r,s),c));var n};if(x.removeText(p),C(k.drawAxis,[i,x]),i.show)switch(i.options.showTickLabels){case"none":break;case"endpoints":f.push(g(i.ticks[0],f)),f.push(g(i.ticks[i.ticks.length-1],f));break;case"major":for(f.push(g(i.ticks[0],f)),f.push(g(i.ticks[i.ticks.length-1],f)),e=1;e<i.ticks.length-1;++e)f.push(g(i.ticks[e],f));break;case"all":for(f.push(g(i.ticks[0],[])),f.push(g(i.ticks[i.ticks.length-1],f)),e=1;e<i.ticks.length-1;++e)f.push(g(i.ticks[e],f))}}),C(k.setupGrid,[])}function E(t){var e,n=t.options,i=n.min,o=n.max,a=t.datamin,r=t.datamax;switch(n.autoScale){case"none":i=+(null!=n.min?n.min:a),o=+(null!=n.max?n.max:r);break;case"loose":if(null!=a&&null!=r){i=a,o=r,e=K.plot.saturated.saturate(o-i);var s="number"==typeof n.autoScaleMargin?n.autoScaleMargin:.02;i=K.plot.saturated.saturate(i-e*s),o=K.plot.saturated.saturate(o+e*s),i<0&&0<=a&&(i=0)}else i=n.min,o=n.max;break;case"exact":i=null!=a?a:n.min,o=null!=r?r:n.max;break;case"sliding-window":o<r&&(o=r,i=Math.max(r-(n.windowSize||100),i))}var l=function(t,e){var n=void 0===t?null:t,i=void 0===e?null:e;if(0==i-n){var o=0===i?1:.01,a=null;null==n&&(a-=o),null!=i&&null==n||(i+=o),null!=a&&(n=a)}return{min:n,max:i}}(i,o);i=l.min,o=l.max,!0===n.growOnly&&"none"!==n.autoScale&&"sliding-window"!==n.autoScale&&(i=i<a?i:null!==a?a:i,o=r<o?o:null!==r?r:o),t.autoScaledMin=i,t.autoScaledMax=o}function I(t,e,n,i,o){var a=R(n,x,i),r=K.plot.saturated.delta(t,e,a),s=-Math.floor(Math.log(r)/Math.LN10);o&&o<s&&(s=o);var l=r/parseFloat("1e"+-s);return 2.25<l&&l<3&&(null==o||s+1<=o)&&++s,isFinite(s)?s:0}function O(t,e,n,i){var o=K.plot.saturated.delta(t,e,n),a=-Math.floor(Math.log(o)/Math.LN10);i&&i<a&&(a=i);var r,s=parseFloat("1e"+-a),l=o/s;return l<1.5?r=1:l<3?(r=2,2.25<l&&(null==i||a+1<=i)&&(r=2.5)):r=l<7.5?5:10,r*=s}function R(t,e,n){return"number"==typeof n&&0<n?n:.3*Math.sqrt("x"===t?e.width:e.height)}function D(t,e,n,i){if(null===e)switch(i){case"min":case"max":var o=(a=t,r=n,s=Math.floor(r.p2c(a)),l="x"===r.direction?s+1:s-1,c=r.c2p(s),u=r.c2p(l),I(c,u,r.direction,1));isFinite(o),e=n.tickFormatter(t,n,o,M);break;case"major":e=n.tickFormatter(t,n,void 0,M)}var a,r,s,l,c,u;return{v:t,label:e}}function W(){x.clear(),C(k.drawBackground,[g]);var t=f.grid;t.show&&t.backgroundColor&&(g.save(),g.translate(b.left,b.top),g.fillStyle=J(f.grid.backgroundColor,T,0,"rgba(255, 255, 255, 0)"),g.fillRect(0,0,w,T),g.restore()),t.show&&!t.aboveData&&H();for(var e=0;e<y.length;++e)C(k.drawSeries,[g,y[e],e,J]),V(y[e]);C(k.draw,[g]),t.show&&t.aboveData&&H(),x.render(),Q()}function F(t,e){for(var n,i,o,a,r=z(),s=0;s<r.length;++s)if((n=r[s]).direction===e&&(t[a=e+n.n+"axis"]||1!==n.n||(a=e+"axis"),t[a])){i=t[a].from,o=t[a].to;break}if(t[a]||(n="x"===e?m[0]:v[0],i=t[e+"1"],o=t[e+"2"]),null!=i&&null!=o&&o<i){var l=i;i=o,o=l}return{from:i,to:o,axis:n}}function Y(t){var e=t.box,n=0,i=0;return"x"===t.direction?(n=0,i=e.top-b.top+("top"===t.position?e.height:0)):(i=0,n=e.left-b.left+("left"===t.position?e.width:0)+t.boxPosition.centerX),{x:n,y:i}}function X(t,e){return t%2!=0?Math.floor(e)+.5:e}function G(t){g.lineWidth=1;var e=Y(t),n=e.x,i=e.y;if(t.show){var o=0,a=0;g.strokeStyle=t.options.color,g.beginPath(),"x"===t.direction?o=w+1:a=T+1,"x"===t.direction?i=X(g.lineWidth,i):n=X(g.lineWidth,n),g.moveTo(n,i),g.lineTo(n+o,i+a),g.stroke()}}function B(t){var e=t.tickLength,n=t.showMinorTicks,i=S,o=Y(t),a=o.x,r=o.y,s=0;for(g.strokeStyle=t.options.color,g.beginPath(),s=0;s<t.ticks.length;++s){var l,c=t.ticks[s].v,u=0,p=0,h=0,d=0;if(!isNaN(c)&&c>=t.min&&c<=t.max&&("x"===t.direction?(a=t.p2c(c),p=e,"top"===t.position&&(p=-p)):(r=t.p2c(c),u=e,"left"===t.position&&(u=-u)),"x"===t.direction?a=X(g.lineWidth,a):r=X(g.lineWidth,r),g.moveTo(a,r),g.lineTo(a+u,r+p)),!0===n&&s<t.ticks.length-1){var f=t.ticks[s].v,m=(t.ticks[s+1].v-f)/(i+1);for(l=1;l<=i;l++){if("x"===t.direction){if(d=e/2,a=X(g.lineWidth,t.p2c(f+l*m)),"top"===t.position&&(d=-d),a<0||w<a)continue}else if(h=e/2,r=X(g.lineWidth,t.p2c(f+l*m)),"left"===t.position&&(h=-h),r<0||T<r)continue;g.moveTo(a,r),g.lineTo(a+h,r+d)}}}g.stroke()}function j(t){var e,n,i;for(g.strokeStyle=f.grid.tickColor,g.beginPath(),e=0;e<t.ticks.length;++e){var o=t.ticks[e].v,a=0,r=0,s=0,l=0;isNaN(o)||o<t.min||o>t.max||(n=o,void 0,i=f.grid.borderWidth,(!("object"===_typeof(i)&&0<i[t.position]||0<i)||n!==t.min&&n!==t.max)&&("x"===t.direction?(s=t.p2c(o),r=-(l=T)):(s=0,l=t.p2c(o),a=w),"x"===t.direction?s=X(g.lineWidth,s):l=X(g.lineWidth,l),g.moveTo(s,l),g.lineTo(s+a,l+r)))}g.stroke()}function H(){var t,e,n,i;g.save(),g.translate(b.left,b.top),function(){var t,e,n=f.grid.markings;if(n)for(K.isFunction(n)&&((t=M.getAxes()).xmin=t.xaxis.min,t.xmax=t.xaxis.max,t.ymin=t.yaxis.min,t.ymax=t.yaxis.max,n=n(t)),e=0;e<n.length;++e){var i=n[e],o=F(i,"x"),a=F(i,"y");if(null==o.from&&(o.from=o.axis.min),null==o.to&&(o.to=o.axis.max),null==a.from&&(a.from=a.axis.min),null==a.to&&(a.to=a.axis.max),!(o.to<o.axis.min||o.from>o.axis.max||a.to<a.axis.min||a.from>a.axis.max)){o.from=Math.max(o.from,o.axis.min),o.to=Math.min(o.to,o.axis.max),a.from=Math.max(a.from,a.axis.min),a.to=Math.min(a.to,a.axis.max);var r=o.from===o.to,s=a.from===a.to;if(!r||!s)if(o.from=Math.floor(o.axis.p2c(o.from)),o.to=Math.floor(o.axis.p2c(o.to)),a.from=Math.floor(a.axis.p2c(a.from)),a.to=Math.floor(a.axis.p2c(a.to)),r||s){var l=i.lineWidth||f.grid.markingsLineWidth,c=l%2?.5:0;g.beginPath(),g.strokeStyle=i.color||f.grid.markingsColor,g.lineWidth=l,r?(g.moveTo(o.to+c,a.from),g.lineTo(o.to+c,a.to)):(g.moveTo(o.from,a.to+c),g.lineTo(o.to,a.to+c)),g.stroke()}else g.fillStyle=i.color||f.grid.markingsColor,g.fillRect(o.from,a.to,o.to-o.from,a.from-a.to)}}}(),t=z(),e=f.grid.borderWidth;for(var o=0;o<t.length;++o){var a=t[o];a.show&&(G(a),!0===a.showTicks&&B(a),!0===a.gridLines&&j(a))}e&&(n=f.grid.borderWidth,i=f.grid.borderColor,"object"===_typeof(n)||"object"===_typeof(i)?("object"!==_typeof(n)&&(n={top:n,right:n,bottom:n,left:n}),"object"!==_typeof(i)&&(i={top:i,right:i,bottom:i,left:i}),0<n.top&&(g.strokeStyle=i.top,g.lineWidth=n.top,g.beginPath(),g.moveTo(0-n.left,0-n.top/2),g.lineTo(w,0-n.top/2),g.stroke()),0<n.right&&(g.strokeStyle=i.right,g.lineWidth=n.right,g.beginPath(),g.moveTo(w+n.right/2,0-n.top),g.lineTo(w+n.right/2,T),g.stroke()),0<n.bottom&&(g.strokeStyle=i.bottom,g.lineWidth=n.bottom,g.beginPath(),g.moveTo(w+n.right,T+n.bottom/2),g.lineTo(0,T+n.bottom/2),g.stroke()),0<n.left&&(g.strokeStyle=i.left,g.lineWidth=n.left,g.beginPath(),g.moveTo(0-n.left/2,T+n.bottom),g.lineTo(0-n.left/2,0),g.stroke())):(g.lineWidth=n,g.strokeStyle=f.grid.borderColor,g.strokeRect(-n/2,-n/2,w+n,T+n))),g.restore()}function V(t){t.lines.show&&K.plot.drawSeries.drawSeriesLines(t,g,b,w,T,M.drawSymbol,J),t.bars.show&&K.plot.drawSeries.drawSeriesBars(t,g,b,w,T,M.drawSymbol,J),t.points.show&&K.plot.drawSeries.drawSeriesPoints(t,g,b,w,T,M.drawSymbol,J)}function _(t,e,n,i,o){for(var a=function(t,e,n,i,o){var a,r=[],s=[],l=i*i+1;for(a=y.length-1;0<=a;--a)if(n(a)){var c=y[a];if(!c.datapoints)return;var u=!1;if(c.lines.show||c.points.show){var p=q(c,t,e,i,o);p&&(s.push({seriesIndex:a,dataIndex:p.dataIndex,distance:p.distance}),u=!0)}if(c.bars.show&&!u){var h=U(c,t,e);0<=h&&s.push({seriesIndex:a,dataIndex:h,distance:l})}}for(a=0;a<s.length;a++){var d=s[a].seriesIndex,f=s[a].dataIndex,m=s[a].distance,g=y[d].datapoints.pointsize;r.push({datapoint:y[d].datapoints.points.slice(f*g,(f+1)*g),dataIndex:f,series:y[d],seriesIndex:d,distance:Math.sqrt(m)})}return r}(t,e,n,i,o),r=0;r<y.length;++r)n(r)&&C(k.findNearbyItems,[t,e,y,r,i,o,a]);return a.sort(function(t,e){return void 0===e.distance?-1:void 0===t.distance&&void 0!==e.distance?1:t.distance-e.distance})}function q(t,e,n,i,o){var a=t.xaxis.c2p(e),r=t.yaxis.c2p(n),s=i/t.xaxis.scale,l=i/t.yaxis.scale,c=t.datapoints.points,u=t.datapoints.pointsize,p=Number.POSITIVE_INFINITY;t.xaxis.options.inverseTransform&&(s=Number.MAX_VALUE),t.yaxis.options.inverseTransform&&(l=Number.MAX_VALUE);for(var h=null,d=0;d<c.length;d+=u){var f=c[d],m=c[d+1];if(null!=f&&!(s<f-a||f-a<-s||l<m-r||m-r<-l)){var g=Math.abs(t.xaxis.p2c(f)-e),x=Math.abs(t.yaxis.p2c(m)-n),v=o?o(g,x):g*g+x*x;v<p&&(h={dataIndex:d/u,distance:p=v})}}return h}function U(t,e,n){var i,o,a=t.bars.barWidth[0]||t.bars.barWidth,r=t.xaxis.c2p(e),s=t.yaxis.c2p(n),l=t.datapoints.points,c=t.datapoints.pointsize;switch(t.bars.align){case"left":i=0;break;case"right":i=-a;break;default:i=-a/2}o=i+a;for(var u=t.bars.fillTowards||0,p=u>t.yaxis.min?Math.min(t.yaxis.max,u):t.yaxis.min,h=-1,d=0;d<l.length;d+=c){var f=l[d],m=l[d+1];if(null!=f){var g=3===c?l[d+2]:p;(t.bars.horizontal?r<=Math.max(g,f)&&r>=Math.min(g,f)&&m+i<=s&&s<=m+o:f+i<=r&&r<=f+o&&s>=Math.min(g,m)&&s<=Math.max(g,m))&&(h=d/c)}}return h}function Q(){var t=f.interaction.redrawOverlayInterval;-1!==t?s||(s=setTimeout(function(){Z(M)},t)):Z()}function Z(t){if(s=null,a){n.clear(),C(k.drawOverlay,[a,n]);var e=new CustomEvent("onDrawingDone");t.getEventHolder().dispatchEvent(e),t.getPlaceholder().trigger("drawingdone")}}function J(t,e,n,i){if("string"==typeof t)return t;for(var o=g.createLinearGradient(0,n,0,e),a=0,r=t.colors.length;a<r;++a){var s=t.colors[a];if("string"!=typeof s){var l=K.color.parse(i);null!=s.brightness&&(l=l.scale("rgb",s.brightness)),null!=s.opacity&&(l.a*=s.opacity),s=l.toString()}o.addColorStop(a/(r-1),s)}return o}!function(){for(var t={Canvas:$},e=0;e<i.length;++e){var n=i[e];n.init(M,t),n.options&&K.extend(!0,f,n.options)}}(),function(){l.css("padding",0).children().filter(function(){return!K(this).hasClass("flot-overlay")&&!K(this).hasClass("flot-base")}).remove(),"static"===l.css("position")&&l.css("position","relative");x=new $("flot-base",l[0]),n=new $("flot-overlay",l[0]),g=x.context,a=n.context,o=K(n.element).unbind();var t=l.data("plot");t&&(t.shutdown(),n.clear());l.data("plot",M)}(),function(t){K.extend(!0,f,t),t&&t.colors&&(f.colors=t.colors);null==f.xaxis.color&&(f.xaxis.color=K.color.parse(f.grid.color).scale("a",.22).toString());null==f.yaxis.color&&(f.yaxis.color=K.color.parse(f.grid.color).scale("a",.22).toString());null==f.xaxis.tickColor&&(f.xaxis.tickColor=f.grid.tickColor||f.xaxis.color);null==f.yaxis.tickColor&&(f.yaxis.tickColor=f.grid.tickColor||f.yaxis.color);null==f.grid.borderColor&&(f.grid.borderColor=f.grid.color);null==f.grid.tickColor&&(f.grid.tickColor=K.color.parse(f.grid.color).scale("a",.22).toString());var e,n,i,o=l.css("font-size"),a=o?+o.replace("px",""):13,r={style:l.css("font-style"),size:Math.round(.8*a),variant:l.css("font-variant"),weight:l.css("font-weight"),family:l.css("font-family")};for(i=f.xaxes.length||1,e=0;e<i;++e)(n=f.xaxes[e])&&!n.tickColor&&(n.tickColor=n.color),n=K.extend(!0,{},f.xaxis,n),(f.xaxes[e]=n).font&&(n.font=K.extend({},r,n.font),n.font.color||(n.font.color=n.color),n.font.lineHeight||(n.font.lineHeight=Math.round(1.15*n.font.size)));for(i=f.yaxes.length||1,e=0;e<i;++e)(n=f.yaxes[e])&&!n.tickColor&&(n.tickColor=n.color),n=K.extend(!0,{},f.yaxis,n),(f.yaxes[e]=n).font&&(n.font=K.extend({},r,n.font),n.font.color||(n.font.color=n.color),n.font.lineHeight||(n.font.lineHeight=Math.round(1.15*n.font.size)));for(e=0;e<f.xaxes.length;++e)L(m,e+1).options=f.xaxes[e];for(e=0;e<f.yaxes.length;++e)L(v,e+1).options=f.yaxes[e];for(var s in K.each(z(),function(t,e){e.boxPosition=e.options.boxPosition||{centerX:0,centerY:0}}),k)f.hooks[s]&&f.hooks[s].length&&(k[s]=k[s].concat(f.hooks[s]));C(k.processOptions,[f])}(e),c(t),A(!0),W(),C(k.bindEvents,[o])}K.plot=function(t,e,n){return new i(K(t),e,n,K.plot.plugins)},K.plot.version="3.0.0",K.plot.plugins=[],K.fn.plot=function(t,e){return this.each(function(){K.plot(this,t,e)})},K.plot.linearTickGenerator=tt,K.plot.defaultTickFormatter=et,K.plot.expRepTickFormatter=l}(jQuery),function(t){var a={saturate:function(t){return t===1/0?Number.MAX_VALUE:t===-1/0?-Number.MAX_VALUE:t},delta:function(t,e,n){return(e-t)/n==1/0?e/n-t/n:(e-t)/n},multiply:function(t,e){return a.saturate(t*e)},multiplyAdd:function(t,e,n){if(isFinite(t*e))return a.saturate(t*e+n);for(var i=n,o=0;o<e;o++)i+=t;return a.saturate(i)},floorInBase:function(t,e){return e*Math.floor(t/e)}};t.plot.saturated=a}(jQuery),function(t){var e={getPageXY:function(t){var e=document.documentElement;return{X:t.clientX+(window.pageXOffset||e.scrollLeft)-(e.clientLeft||0),Y:t.clientY+(window.pageYOffset||e.scrollTop)-(e.clientTop||0)}},getPixelRatio:function(t){return(window.devicePixelRatio||1)/(t.webkitBackingStorePixelRatio||t.mozBackingStorePixelRatio||t.msBackingStorePixelRatio||t.oBackingStorePixelRatio||t.backingStorePixelRatio||1)},isSafari:function(){return/constructor/i.test(window.top.HTMLElement)||"[object SafariRemoteNotification]"===(!window.top.safari||void 0!==window.top.safari&&window.top.safari.pushNotification).toString()},isMobileSafari:function(){return navigator.userAgent.match(/(iPod|iPhone|iPad)/)&&navigator.userAgent.match(/AppleWebKit/)},isOpera:function(){return!!window.opr&&!!opr.addons||!!window.opera||0<=navigator.userAgent.indexOf(" OPR/")},isFirefox:function(){return"undefined"!=typeof InstallTrigger},isIE:function(){return!!document.documentMode},isEdge:function(){return!e.isIE()&&!!window.StyleMedia},isChrome:function(){return!!window.chrome&&!!window.chrome.webstore},isBlink:function(){return(e.isChrome()||e.isOpera())&&!!window.CSS}};t.plot.browser=e}(jQuery),function(s){s.plot.drawSeries=new function(){function f(t,e,n,i,o,a,r,s,l,c,u){var p,h,d,f,m=t+i,g=t+o,x=n,v=e,b=!1;p=h=d=!0,c?(b=h=d=!0,p=!1,v=e+i,x=e+o,(g=t)<(m=n)&&(f=g,g=m,m=f,h=!(p=!0))):(p=h=d=!0,b=!1,m=t+i,g=t+o,(v=e)<(x=n)&&(f=v,v=x,x=f,d=!(b=!0))),g<r.min||m>r.max||v<s.min||x>s.max||(m<r.min&&(m=r.min,p=!1),g>r.max&&(g=r.max,h=!1),x<s.min&&(x=s.min,b=!1),v>s.max&&(v=s.max,d=!1),m=r.p2c(m),x=s.p2c(x),g=r.p2c(g),v=s.p2c(v),a&&(l.fillStyle=a(x,v),l.fillRect(m,v,g-m,x-v)),0<u&&(p||h||d||b)&&(l.beginPath(),l.moveTo(m,x),p?l.lineTo(m,v):l.moveTo(m,v),d?l.lineTo(g,v):l.moveTo(g,v),h?l.lineTo(g,x):l.moveTo(g,x),b?l.lineTo(m,x):l.moveTo(m,x),l.stroke()))}function m(t,e,n,i,o){var a=t.fill;if(!a)return null;if(t.fillColor)return o(t.fillColor,n,i,e);var r=s.color.parse(e);return r.a="number"==typeof a?a:.4,r.normalize(),r.toString()}this.drawSeriesLines=function(t,e,n,i,o,a,r){e.save(),e.translate(n.left,n.top),e.lineJoin="round",t.lines.dashes&&e.setLineDash&&e.setLineDash(t.lines.dashes);var s={format:t.datapoints.format,points:t.datapoints.points,pointsize:t.datapoints.pointsize};t.decimate&&(s.points=t.decimate(t,t.xaxis.min,t.xaxis.max,i,t.yaxis.min,t.yaxis.max,o));var l=t.lines.lineWidth;e.lineWidth=l,e.strokeStyle=t.color;var c=m(t.lines,t.color,0,o,r);c&&(e.fillStyle=c,function(t,e,n,i,o,a){for(var r=t.points,s=t.pointsize,l=i>n.min?Math.min(n.max,i):n.min,c=0,u=1,p=!1,h=0,d=0,f=null,m=null;!(0<s&&c>r.length+s);){var g=r[(c+=s)-s],x=r[c-s+u],v=r[c],b=r[c+u];if(-2===s&&(x=b=l),p){if(0<s&&null!=g&&null==v){d=c,s=-s,u=2;continue}if(s<0&&c===h+s){o.fill(),p=!1,u=1,c=h=d+(s=-s);continue}}if(null!=g&&null!=v){if(a&&(null!==f&&null!==m?(v=g,b=x,g=f,x=m,m=f=null,c-=s):x!==b&&g!==v&&(f=v,m=b=x)),g<=v&&g<e.min){if(v<e.min)continue;x=(e.min-g)/(v-g)*(b-x)+x,g=e.min}else if(v<=g&&v<e.min){if(g<e.min)continue;b=(e.min-g)/(v-g)*(b-x)+x,v=e.min}if(v<=g&&g>e.max){if(v>e.max)continue;x=(e.max-g)/(v-g)*(b-x)+x,g=e.max}else if(g<=v&&v>e.max){if(g>e.max)continue;b=(e.max-g)/(v-g)*(b-x)+x,v=e.max}if(p||(o.beginPath(),o.moveTo(e.p2c(g),n.p2c(l)),p=!0),x>=n.max&&b>=n.max)o.lineTo(e.p2c(g),n.p2c(n.max)),o.lineTo(e.p2c(v),n.p2c(n.max));else if(x<=n.min&&b<=n.min)o.lineTo(e.p2c(g),n.p2c(n.min)),o.lineTo(e.p2c(v),n.p2c(n.min));else{var y=g,w=v;x<=b&&x<n.min&&b>=n.min?(g=(n.min-x)/(b-x)*(v-g)+g,x=n.min):b<=x&&b<n.min&&x>=n.min&&(v=(n.min-x)/(b-x)*(v-g)+g,b=n.min),b<=x&&x>n.max&&b<=n.max?(g=(n.max-x)/(b-x)*(v-g)+g,x=n.max):x<=b&&b>n.max&&x<=n.max&&(v=(n.max-x)/(b-x)*(v-g)+g,b=n.max),g!==y&&o.lineTo(e.p2c(y),n.p2c(x)),o.lineTo(e.p2c(g),n.p2c(x)),o.lineTo(e.p2c(v),n.p2c(b)),v!==w&&(o.lineTo(e.p2c(v),n.p2c(b)),o.lineTo(e.p2c(w),n.p2c(b)))}}else m=f=null}}(s,t.xaxis,t.yaxis,t.lines.fillTowards||0,e,t.lines.steps)),0<l&&function(t,e,n,i,o,a,r){var s=t.points,l=t.pointsize,c=null,u=null,p=0,h=0,d=0,f=0,m=null,g=null,x=0;for(a.beginPath(),x=l;x<s.length;x+=l)if(p=s[x-l],h=s[x-l+1],d=s[x],f=s[x+1],null!==p&&null!==d)if(isNaN(p)||isNaN(d)||isNaN(h)||isNaN(f))u=c=null;else{if(r&&(null!==m&&null!==g?(d=p,f=h,p=m,h=g,g=m=null,x-=l):h!==f&&p!==d&&(m=d,g=f=h)),h<=f&&h<o.min){if(f<o.min)continue;p=(o.min-h)/(f-h)*(d-p)+p,h=o.min}else if(f<=h&&f<o.min){if(h<o.min)continue;d=(o.min-h)/(f-h)*(d-p)+p,f=o.min}if(f<=h&&h>o.max){if(f>o.max)continue;p=(o.max-h)/(f-h)*(d-p)+p,h=o.max}else if(h<=f&&f>o.max){if(h>o.max)continue;d=(o.max-h)/(f-h)*(d-p)+p,f=o.max}if(p<=d&&p<i.min){if(d<i.min)continue;h=(i.min-p)/(d-p)*(f-h)+h,p=i.min}else if(d<=p&&d<i.min){if(p<i.min)continue;f=(i.min-p)/(d-p)*(f-h)+h,d=i.min}if(d<=p&&p>i.max){if(d>i.max)continue;h=(i.max-p)/(d-p)*(f-h)+h,p=i.max}else if(p<=d&&d>i.max){if(p>i.max)continue;f=(i.max-p)/(d-p)*(f-h)+h,d=i.max}p===c&&h===u||a.moveTo(i.p2c(p)+e,o.p2c(h)+n),c=d,u=f,a.lineTo(i.p2c(d)+e,o.p2c(f)+n)}else g=m=null;a.stroke()}(s,0,0,t.xaxis,t.yaxis,e,t.lines.steps),e.restore()},this.drawSeriesPoints=function(t,d,e,n,i,o,a){function r(t,e,n,i,o,a){t.moveTo(e+i,n),t.arc(e,n,i,0,o?Math.PI:2*Math.PI,!1)}r.fill=!0,d.save(),d.translate(e.left,e.top);var s={format:t.datapoints.format,points:t.datapoints.points,pointsize:t.datapoints.pointsize};t.decimatePoints&&(s.points=t.decimatePoints(t,t.xaxis.min,t.xaxis.max,n,t.yaxis.min,t.yaxis.max,i));var l,c=t.points.lineWidth,u=t.points.radius,p=t.points.symbol;"circle"===p?l=r:"string"==typeof p&&o&&o[p]?l=o[p]:"function"==typeof o&&(l=o),0===c&&(c=1e-4),d.lineWidth=c,d.fillStyle=m(t.points,t.color,null,null,a),d.strokeStyle=t.color,function(t,e,n,i,o,a,r,s){var l=t.points,c=t.pointsize;d.beginPath();for(var u=0;u<l.length;u+=c){var p=l[u],h=l[u+1];null==p||p<a.min||p>a.max||h<r.min||h>r.max||(p=a.p2c(p),h=r.p2c(h)+i,s(d,p,h,e,o,n))}s.fill&&!o&&d.fill(),d.stroke()}(s,u,!0,0,!1,t.xaxis,t.yaxis,l),d.restore()},this.drawSeriesBars=function(h,d,t,e,n,i,o){d.save(),d.translate(t.left,t.top);var a,r={format:h.datapoints.format,points:h.datapoints.points,pointsize:h.datapoints.pointsize};h.decimate&&(r.points=h.decimate(h,h.xaxis.min,h.xaxis.max,e)),d.lineWidth=h.bars.lineWidth,d.strokeStyle=h.color;var s=h.bars.barWidth[0]||h.bars.barWidth;switch(h.bars.align){case"left":a=0;break;case"right":a=-s;break;default:a=-s/2}!function(t,e,n,i,o,a){for(var r=t.points,s=t.pointsize,l=h.bars.fillTowards||0,c=l>a.min?Math.min(a.max,l):a.min,u=0;u<r.length;u+=s)if(null!=r[u]){var p=3===s?r[u+2]:c;f(r[u],r[u+1],p,e,n,i,o,a,d,h.bars.horizontal,h.bars.lineWidth)}}(r,a,a+s,h.bars.fill?function(t,e){return m(h.bars,h.color,t,e,o)}:null,h.xaxis,h.yaxis),d.restore()},this.drawBar=f}}(jQuery),function(p){function e(t,e,n,i){if(e.points.errorbars){var o=[{x:!0,number:!0,required:!0},{y:!0,number:!0,required:!0}],a=e.points.errorbars;"x"!==a&&"xy"!==a||(e.points.xerr.asymmetric&&o.push({x:!0,number:!0,required:!0}),o.push({x:!0,number:!0,required:!0})),"y"!==a&&"xy"!==a||(e.points.yerr.asymmetric&&o.push({y:!0,number:!0,required:!0}),o.push({y:!0,number:!0,required:!0})),i.format=o}}function M(t,e){var n=t.datapoints.points,i=null,o=null,a=null,r=null,s=t.points.xerr,l=t.points.yerr,c=t.points.errorbars;"x"===c||"xy"===c?s.asymmetric?(i=n[e+2],o=n[e+3],"xy"===c&&(l.asymmetric?(a=n[e+4],r=n[e+5]):a=n[e+4])):(i=n[e+2],"xy"===c&&(l.asymmetric?(a=n[e+3],r=n[e+4]):a=n[e+3])):"y"===c&&(l.asymmetric?(a=n[e+2],r=n[e+3]):a=n[e+2]),null==o&&(o=i),null==r&&(r=a);var u=[i,o,a,r];return s.show||(u[0]=null,u[1]=null),l.show||(u[2]=null,u[3]=null),u}function S(t,e,n,i,o,a,r,s,l,c,u){i+=c,o+=c,a+=c,"x"===e.err?(n+l<o?h(t,[[o,i],[Math.max(n+l,u[0]),i]]):r=!1,a<n-l?h(t,[[Math.min(n-l,u[1]),i],[a,i]]):s=!1):(o<i-l?h(t,[[n,o],[n,Math.min(i-l,u[0])]]):r=!1,i+l<a?h(t,[[n,Math.max(i+l,u[1])],[n,a]]):s=!1),l=null!=e.radius?e.radius:l,r&&("-"===e.upperCap?"x"===e.err?h(t,[[o,i-l],[o,i+l]]):h(t,[[n-l,o],[n+l,o]]):p.isFunction(e.upperCap)&&("x"===e.err?e.upperCap(t,o,i,l):e.upperCap(t,n,o,l))),s&&("-"===e.lowerCap?"x"===e.err?h(t,[[a,i-l],[a,i+l]]):h(t,[[n-l,a],[n+l,a]]):p.isFunction(e.lowerCap)&&("x"===e.err?e.lowerCap(t,a,i,l):e.lowerCap(t,n,a,l)))}function h(t,e){t.beginPath(),t.moveTo(e[0][0],e[0][1]);for(var n=1;n<e.length;n++)t.lineTo(e[n][0],e[n][1]);t.stroke()}function n(t,n){var e=t.getPlotOffset();n.save(),n.translate(e.left,e.top),p.each(t.getData(),function(t,e){e.points.errorbars&&(e.points.xerr.show||e.points.yerr.show)&&function(t,e,n){var i,o=n.datapoints.points,a=n.datapoints.pointsize,r=[n.xaxis,n.yaxis],s=n.points.radius,l=[n.points.xerr,n.points.yerr],c=!1;r[0].p2c(r[0].max)<r[0].p2c(r[0].min)&&(c=!0,i=l[0].lowerCap,l[0].lowerCap=l[0].upperCap,l[0].upperCap=i);var u=!1;r[1].p2c(r[1].min)<r[1].p2c(r[1].max)&&(u=!0,i=l[1].lowerCap,l[1].lowerCap=l[1].upperCap,l[1].upperCap=i);for(var p=0;p<n.datapoints.points.length;p+=a)for(var h=M(n,p),d=0;d<l.length;d++){var f=[r[d].min,r[d].max];if(h[d*l.length]){var m=o[p],g=o[p+1],x=[m,g][d]+h[d*l.length+1],v=[m,g][d]-h[d*l.length];if("x"===l[d].err&&(g>r[1].max||g<r[1].min||x<r[0].min||v>r[0].max))continue;if("y"===l[d].err&&(m>r[0].max||m<r[0].min||x<r[1].min||v>r[1].max))continue;var b=!0,y=!0;x>f[1]&&(b=!1,x=f[1]),v<f[0]&&(y=!1,v=f[0]),("x"===l[d].err&&c||"y"===l[d].err&&u)&&(i=v,v=x,x=i,i=y,y=b,b=i,i=f[0],f[0]=f[1],f[1]=i),m=r[0].p2c(m),g=r[1].p2c(g),x=r[d].p2c(x),v=r[d].p2c(v),f[0]=r[d].p2c(f[0]),f[1]=r[d].p2c(f[1]);var w=l[d].lineWidth?l[d].lineWidth:n.points.lineWidth,T=null!=n.points.shadowSize?n.points.shadowSize:n.shadowSize;if(0<w&&0<T){var k=T/2;e.lineWidth=k,e.strokeStyle="rgba(0,0,0,0.1)",S(e,l[d],m,g,x,v,b,y,s,k+k/2,f),e.strokeStyle="rgba(0,0,0,0.2)",S(e,l[d],m,g,x,v,b,y,s,k/2,f)}e.strokeStyle=l[d].color?l[d].color:n.color,e.lineWidth=w,S(e,l[d],m,g,x,v,b,y,s,0,f)}}}(0,n,e)}),n.restore()}p.plot.plugins.push({init:function(t){t.hooks.processRawData.push(e),t.hooks.draw.push(n)},options:{series:{points:{errorbars:null,xerr:{err:"x",show:null,asymmetric:null,upperCap:null,lowerCap:null,color:null,radius:null},yerr:{err:"y",show:null,asymmetric:null,upperCap:null,lowerCap:null,color:null,radius:null}}}},name:"errorbars",version:"1.0"})}(jQuery),jQuery.plot.uiConstants={SNAPPING_CONSTANT:20,PANHINT_LENGTH_CONSTANT:10,MINOR_TICKS_COUNT_CONSTANT:4,TICK_LENGTH_CONSTANT:10,ZOOM_DISTANCE_MARGIN:25},function(v){var b=t(Number.MAX_VALUE,10),y=t(Number.MAX_VALUE,4);function t(t,e){for(var n,i,o=Math.floor(Math.log(t)*Math.LOG10E)-1,a=[],r=-o;r<=o;r++){i=parseFloat("1e"+r);for(var s=1;s<9;s+=e)n=i*s,a.push(n)}return a}var o=function(t,e,n){var i=[],o=-1,a=-1,r=t.getCanvas(),s=b,l=w(e,t),c=e.max;n||(n=.3*Math.sqrt("x"===e.direction?r.width:r.height)),b.some(function(t,e){return l<=t&&(o=e,!0)}),b.some(function(t,e){return c<=t&&(a=e,!0)}),-1===a&&(a=b.length-1),a-o<=n/4&&s.length!==y.length&&(s=y,o*=2,a*=2);var u,p,h,d=null,f=1/n;if(n/4<=a-o){for(var m=a;o<=m;m--)u=s[m],p=(Math.log(u)-Math.log(l))/(Math.log(c)-Math.log(l)),h=u,null===d?d={pixelCoord:p,idealPixelCoord:p}:Math.abs(p-d.pixelCoord)>=f?d={pixelCoord:p,idealPixelCoord:d.idealPixelCoord-f}:h=null,h&&i.push(h);i.reverse()}else{var g=t.computeTickSize(l,c,n),x={min:l,max:c,tickSize:g};i=v.plot.linearTickGenerator(x)}return i},w=function(t,e){var n=t.min,i=t.max;return n<=0&&i<(n=null===t.datamin?t.min=.1:h(e,t))&&(t.max=null!==t.datamax?t.datamax:t.options.max,t.options.offset.below=0,t.options.offset.above=0),n},a=function(t,e,n){var i=0<t?Math.floor(Math.log(t)/Math.LN10):0;if(n)return-4<=i&&i<=7?v.plot.defaultTickFormatter(t,e,n):v.plot.expRepTickFormatter(t,e,n);if(-4<=i&&i<=7){var o=i<0?t.toFixed(-i):t.toFixed(i+2);if(-1!==o.indexOf(".")){for(var a=o.lastIndexOf("0");a===o.length-1;)a=(o=o.slice(0,-1)).lastIndexOf("0");o.indexOf(".")===o.length-1&&(o=o.slice(0,-1))}return o}return v.plot.expRepTickFormatter(t,e)},r=function(t){return t<b[0]&&(t=b[0]),Math.log(t)},s=function(t){return Math.exp(t)},l=function(t){return-t},c=function(t){return-r(t)},u=function(t){return s(-t)};function p(t,e){"log"===e.options.mode&&e.datamin<=0&&(null===e.datamin?e.datamin=.1:e.datamin=h(t,e))}function h(e,n){var t=e.getData().filter(function(t){return t.xaxis===n||t.yaxis===n}).map(function(t){return e.computeRangeForDataSeries(t,null,d)}),i="x"===n.direction?Math.min(.1,t&&t[0]?t[0].xmin:.1):Math.min(.1,t&&t[0]?t[0].ymin:.1);return n.min=i}function d(t){return 0<t}v.plot.plugins.push({init:function(t){t.hooks.processOptions.push(function(i){v.each(i.getAxes(),function(t,e){var n=e.options;"log"===n.mode?(e.tickGenerator=function(t){return o(i,t,11)},"function"!=typeof e.options.tickFormatter&&(e.options.tickFormatter=a),e.options.transform=n.inverted?c:r,e.options.inverseTransform=n.inverted?u:s,e.options.autoScaleMargin=0,i.hooks.setRange.push(p)):n.inverted&&(e.options.transform=l,e.options.inverseTransform=l)})})},options:{xaxis:{}},name:"log",version:"0.1"}),v.plot.logTicksGenerator=o,v.plot.logTickFormatter=a}(jQuery),function(t){var e=function(t,e,n,i,o){var a=i*Math.sqrt(Math.PI)/2;t.rect(e-a,n-a,a+a,a+a)},n=function(t,e,n,i,o){var a=i*Math.sqrt(Math.PI)/2;t.rect(e-a,n-a,a+a,a+a)},i=function(t,e,n,i,o){var a=i*Math.sqrt(Math.PI/2);t.moveTo(e-a,n),t.lineTo(e,n-a),t.lineTo(e+a,n),t.lineTo(e,n+a),t.lineTo(e-a,n),t.lineTo(e,n-a)},o=function(t,e,n,i,o){var a=i*Math.sqrt(2*Math.PI/Math.sin(Math.PI/3)),r=a*Math.sin(Math.PI/3);t.moveTo(e-a/2,n+r/2),t.lineTo(e+a/2,n+r/2),o||(t.lineTo(e,n-r/2),t.lineTo(e-a/2,n+r/2),t.lineTo(e+a/2,n+r/2))},a=function(t,e,n,i,o,a){o||(t.moveTo(e+i,n),t.arc(e,n,i,0,2*Math.PI,!1))},r={square:e,rectangle:n,diamond:i,triangle:o,cross:function(t,e,n,i,o){var a=i*Math.sqrt(Math.PI)/2;t.moveTo(e-a,n-a),t.lineTo(e+a,n+a),t.moveTo(e-a,n+a),t.lineTo(e+a,n-a)},ellipse:a,plus:function(t,e,n,i,o){var a=i*Math.sqrt(Math.PI/2);t.moveTo(e-a,n),t.lineTo(e+a,n),t.moveTo(e,n+a),t.lineTo(e,n-a)}};a.fill=o.fill=i.fill=n.fill=e.fill=!0,t.plot.plugins.push({init:function(t){t.drawSymbol=r},name:"symbols",version:"1.0"})}(jQuery),function(t){function e(t,e,n,i){if(!0===e.flatdata){var o=e.start||0,a="number"==typeof e.step?e.step:1;i.pointsize=2;for(var r=0,s=0;r<n.length;r++,s+=2)i.points[s]=o+r*a,i.points[s+1]=n[r];void 0!==i.points?i.points.length=2*n.length:i.points=[]}}jQuery.plot.plugins.push({init:function(t){t.hooks.processRawData.push(e)},name:"flatdata",version:"0.0.2"})}(),function(S){var t={zoom:{interactive:!1,active:!1,amount:1.5},pan:{interactive:!1,active:!1,cursor:"move",frameRate:60,mode:"smart"},recenter:{interactive:!0},xaxis:{axisZoom:!0,plotZoom:!0,axisPan:!0,plotPan:!0,panRange:[void 0,void 0],zoomRange:[void 0,void 0]},yaxis:{axisZoom:!0,plotZoom:!0,axisPan:!0,plotPan:!0,panRange:[void 0,void 0],zoomRange:[void 0,void 0]}},P=S.plot.saturated,C=S.plot.browser,N=S.plot.uiConstants.SNAPPING_CONSTANT,z=S.plot.uiConstants.PANHINT_LENGTH_CONSTANT;function e(y,t){var s=null,o=!1,a="manual"===t.pan.mode,i="smartLock"===t.pan.mode,r=i||"smart"===t.pan.mode;var l,c="default",w=null,u=null,p={x:0,y:0},h=!1;function d(t,e){var n=Math.abs(t.originalEvent.deltaY)<=1?1+Math.abs(t.originalEvent.deltaY)/50:null;if(h&&v(t),y.getOptions().zoom.active)return t.preventDefault(),function(t,e,n){var i=C.getPageXY(t),o=y.offset();o.left=i.X-o.left,o.top=i.Y-o.top;var a=y.getPlaceholder().offset();a.left=i.X-a.left,a.top=i.Y-a.top;var r=y.getXAxes().concat(y.getYAxes()).filter(function(t){var e=t.box;if(void 0!==e)return a.left>e.left&&a.left<e.left+e.width&&a.top>e.top&&a.top<e.top+e.height});0===r.length&&(r=void 0),e?y.zoomOut({center:o,axes:r,amount:n}):y.zoom({center:o,axes:r,amount:n})}(t,e<0,n),!1}function f(t){o=!0}function m(t){o=!1}function g(t){if(!o||0!==t.button)return!1;h=!0;var e=C.getPageXY(t),n=y.getPlaceholder().offset();n.left=e.X-n.left,n.top=e.Y-n.top,0===(s=y.getXAxes().concat(y.getYAxes()).filter(function(t){var e=t.box;if(void 0!==e)return n.left>e.left&&n.left<e.left+e.width&&n.top>e.top&&n.top<e.top+e.height})).length&&(s=void 0);var i=y.getPlaceholder().css("cursor");i&&(c=i),y.getPlaceholder().css("cursor",y.getOptions().pan.cursor),r?l=y.navigationState(e.X,e.Y):a&&(p.x=e.X,p.y=e.Y)}function x(t){if(h){var e=C.getPageXY(t),n=y.getOptions().pan.frameRate;-1!==n?!u&&n&&(u=setTimeout(function(){r?y.smartPan({x:l.startPageX-e.X,y:l.startPageY-e.Y},l,s,!1,i):a&&(y.pan({left:p.x-e.X,top:p.y-e.Y,axes:s}),p.x=e.X,p.y=e.Y),u=null},1/n*1e3)):r?y.smartPan({x:l.startPageX-e.X,y:l.startPageY-e.Y},l,s,!1,i):a&&(y.pan({left:p.x-e.X,top:p.y-e.Y,axes:s}),p.x=e.X,p.y=e.Y)}}function v(t){if(h){u&&(clearTimeout(u),u=null),h=!1;var e=C.getPageXY(t);y.getPlaceholder().css("cursor",c),r?(y.smartPan({x:l.startPageX-e.X,y:l.startPageY-e.Y},l,s,!1,i),y.smartPan.end()):a&&(y.pan({left:p.x-e.X,top:p.y-e.Y,axes:s}),p.x=0,p.y=0)}}function b(t){if(y.activate(),y.getOptions().recenter.interactive){var e,n=y.getTouchedAxis(t.clientX,t.clientY);y.recenter({axes:n[0]?n:null}),e=n[0]?new S.Event("re-center",{detail:{axisTouched:n[0]}}):new S.Event("re-center",{detail:t}),y.getPlaceholder().trigger(e)}}function T(t){return y.activate(),h&&v(t),!1}y.navigationState=function(t,e){var n=this.getAxes(),i={};return Object.keys(n).forEach(function(t){var e=n[t];i[t]={navigationOffset:{below:e.options.offset.below||0,above:e.options.offset.above||0},axisMin:e.min,axisMax:e.max,diagMode:!1}}),i.startPageX=t||0,i.startPageY=e||0,i},y.activate=function(){var t=y.getOptions();t.pan.active&&t.zoom.active||(t.pan.active=!0,t.zoom.active=!0,y.getPlaceholder().trigger("plotactivated",[y]))},y.zoomOut=function(t){t||(t={}),t.amount||(t.amount=y.getOptions().zoom.amount),t.amount=1/t.amount,y.zoom(t)},y.zoom=function(t){t||(t={});var e=t.center,n=t.amount||y.getOptions().zoom.amount,i=y.width(),o=y.height(),a=t.axes||y.getAxes();e||(e={left:i/2,top:o/2});var r=e.left/i,s=e.top/o,l={x:{min:e.left-r*i/n,max:e.left+(1-r)*i/n},y:{min:e.top-s*o/n,max:e.top+(1-s)*o/n}};for(var c in a)if(a.hasOwnProperty(c)){var u=a[c],p=u.options,h=l[u.direction].min,d=l[u.direction].max,f=u.options.offset;if((p.axisZoom||!t.axes)&&(t.axes||p.plotZoom)){if(h=S.plot.saturated.saturate(u.c2p(h)),(d=S.plot.saturated.saturate(u.c2p(d)))<h){var m=h;h=d,d=m}if(p.zoomRange){if(d-h<p.zoomRange[0])continue;if(d-h>p.zoomRange[1])continue}var g=S.plot.saturated.saturate(f.below-(u.min-h)),x=S.plot.saturated.saturate(f.above-(u.max-d));p.offset={below:g,above:x}}}y.setupGrid(!0),y.draw(),t.preventEvent||y.getPlaceholder().trigger("plotzoom",[y,t])},y.pan=function(l){var c={x:+l.left,y:+l.top};isNaN(c.x)&&(c.x=0),isNaN(c.y)&&(c.y=0),S.each(l.axes||y.getAxes(),function(t,e){var n=e.options,i=c[e.direction];if((n.axisPan||!l.axes)&&(n.plotPan||l.axes)){var o=e.p2c(n.panRange[0])-e.p2c(e.min),a=e.p2c(n.panRange[1])-e.p2c(e.max);if(void 0!==n.panRange[0]&&a<=i&&(i=a),void 0!==n.panRange[1]&&i<=o&&(i=o),0!==i){var r=P.saturate(e.c2p(e.p2c(e.min)+i)-e.c2p(e.p2c(e.min))),s=P.saturate(e.c2p(e.p2c(e.max)+i)-e.c2p(e.p2c(e.max)));isFinite(r)||(r=0),isFinite(s)||(s=0),n.offset={below:P.saturate(r+(n.offset.below||0)),above:P.saturate(s+(n.offset.above||0))}}}}),y.setupGrid(!0),y.draw(),l.preventEvent||y.getPlaceholder().trigger("plotpan",[y,l])},y.recenter=function(n){S.each(n.axes||y.getAxes(),function(t,e){n.axes?"x"===this.direction?e.options.offset={below:0}:"y"===this.direction&&(e.options.offset={above:0}):e.options.offset={below:0,above:0}}),y.setupGrid(!0),y.draw()};var k=null,M={x:0,y:0};y.smartPan=function(a,t,r,e,n){var s,i,o,l,c,u,p,h,d,f,m,g,x,v=!!n||(i=a,Math.abs(i.y)<N&&Math.abs(i.x)>=N||Math.abs(i.x)<N&&Math.abs(i.y)>=N),b=y.getAxes();a=n?function(t){switch(!k&&Math.max(Math.abs(t.x),Math.abs(t.y))>=N&&(k=Math.abs(t.x)<Math.abs(t.y)?"y":"x"),k){case"x":return{x:t.x,y:0};case"y":return{x:0,y:t.y};default:return{x:0,y:0}}}(a):(o=a,Math.abs(o.x)<N&&Math.abs(o.y)>=N?{x:0,y:o.y}:Math.abs(o.y)<N&&Math.abs(o.x)>=N?{x:o.x,y:0}:o),l=a,0<Math.abs(l.x)&&0<Math.abs(l.y)&&(t.diagMode=!0),v&&!0===t.diagMode&&(t.diagMode=!1,c=b,u=t,p=a,Object.keys(c).forEach(function(t){h=c[t],0===p[h.direction]&&(h.options.offset.below=u[t].navigationOffset.below,h.options.offset.above=u[t].navigationOffset.above)})),w=v?{start:{x:t.startPageX-y.offset().left+y.getPlotOffset().left,y:t.startPageY-y.offset().top+y.getPlotOffset().top},end:{x:t.startPageX-a.x-y.offset().left+y.getPlotOffset().left,y:t.startPageY-a.y-y.offset().top+y.getPlotOffset().top}}:{start:{x:t.startPageX-y.offset().left+y.getPlotOffset().left,y:t.startPageY-y.offset().top+y.getPlotOffset().top},end:!1},isNaN(a.x)&&(a.x=0),isNaN(a.y)&&(a.y=0),r&&(b=r),Object.keys(b).forEach(function(t){if(d=b[t],f=d.min,m=d.max,s=d.options,x=a[d.direction],g=M[d.direction],(s.axisPan||!r)&&(r||s.plotPan)){var e=g+d.p2c(s.panRange[0])-d.p2c(f),n=g+d.p2c(s.panRange[1])-d.p2c(m);if(void 0!==s.panRange[0]&&n<=x&&(x=n),void 0!==s.panRange[1]&&x<=e&&(x=e),0!==x){var i=P.saturate(d.c2p(d.p2c(f)-(g-x))-d.c2p(d.p2c(f))),o=P.saturate(d.c2p(d.p2c(m)-(g-x))-d.c2p(d.p2c(m)));isFinite(i)||(i=0),isFinite(o)||(o=0),d.options.offset.below=P.saturate(i+(d.options.offset.below||0)),d.options.offset.above=P.saturate(o+(d.options.offset.above||0))}}}),M=a,y.setupGrid(!0),y.draw(),e||y.getPlaceholder().trigger("plotpan",[y,a,r,t])},y.smartPan.end=function(){k=w=null,M={x:0,y:0},y.triggerRedrawOverlay()},y.getTouchedAxis=function(t,e){var n=y.getPlaceholder().offset();return n.left=t-n.left,n.top=e-n.top,y.getXAxes().concat(y.getYAxes()).filter(function(t){var e=t.box;if(void 0!==e)return n.left>e.left&&n.left<e.left+e.width&&n.top>e.top&&n.top<e.top+e.height})},y.hooks.drawOverlay.push(function(t,e){if(w){e.strokeStyle="rgba(96, 160, 208, 0.7)",e.lineWidth=2,e.lineJoin="round";var n,i,o=Math.round(w.start.x),a=Math.round(w.start.y);if(s?"x"===s[0].direction?(i=Math.round(w.start.y),n=Math.round(w.end.x)):"y"===s[0].direction&&(n=Math.round(w.start.x),i=Math.round(w.end.y)):(n=Math.round(w.end.x),i=Math.round(w.end.y)),e.beginPath(),!1===w.end)e.moveTo(o,a-z),e.lineTo(o,a+z),e.moveTo(o+z,a),e.lineTo(o-z,a);else{var r=a===i;e.moveTo(o-(r?0:z),a-(r?z:0)),e.lineTo(o+(r?0:z),a+(r?z:0)),e.moveTo(o,a),e.lineTo(n,i),e.moveTo(n-(r?0:z),i-(r?z:0)),e.lineTo(n+(r?0:z),i+(r?z:0))}e.stroke()}}),y.hooks.bindEvents.push(function(t,e){var n=t.getOptions();n.zoom.interactive&&e.mousewheel(d),n.pan.interactive&&(t.addEventHandler("dragstart",g,e,0),t.addEventHandler("drag",x,e,0),t.addEventHandler("dragend",v,e,0),e.bind("mousedown",f),e.bind("mouseup",m)),e.dblclick(b),e.click(T)}),y.hooks.shutdown.push(function(t,e){e.unbind("mousewheel",d),e.unbind("mousedown",f),e.unbind("mouseup",m),e.unbind("dragstart",g),e.unbind("drag",x),e.unbind("dragend",v),e.unbind("dblclick",b),e.unbind("click",T),u&&clearTimeout(u)})}S.plot.plugins.push({init:function(t){t.hooks.processOptions.push(e)},options:t,name:"navigate",version:"1.3"})}(jQuery),jQuery.plot.plugins.push({init:function(t){t.hooks.processRawData.push(function(i,t,e,n){if(null!=t.fillBetween){var o=n.format;o||((o=[]).push({x:!0,number:!0,computeRange:"none"!==t.xaxis.options.autoScale,required:!0}),o.push({y:!0,number:!0,computeRange:"none"!==t.yaxis.options.autoScale,required:!0}),void 0!==t.fillBetween&&""!==t.fillBetween&&function(t){for(var e=i.getData(),n=0;n<e.length;n++)if(e[n].id===t)return!0;return!1}(t.fillBetween)&&t.fillBetween!==t.id&&o.push({x:!1,y:!0,number:!0,required:!1,computeRange:"none"!==t.yaxis.options.autoScale,defaultValue:0}),n.format=o)}}),t.hooks.processDatapoints.push(function(t,e,n){if(null!=e.fillBetween){var i=function(t,e){var n;for(n=0;n<e.length;++n)if(e[n].id===t.fillBetween)return e[n];return"number"==typeof t.fillBetween?t.fillBetween<0||t.fillBetween>=e.length?null:e[t.fillBetween]:null}(e,t.getData());if(i){for(var o,a,r,s,l,c,u,p,h=n.pointsize,d=n.points,f=i.datapoints.pointsize,m=i.datapoints.points,g=[],x=e.lines.show,v=2<h&&n.format[2].y,b=x&&e.lines.steps,y=!0,w=0,T=0;!(w>=d.length);){if(u=g.length,null==d[w]){for(p=0;p<h;++p)g.push(d[w+p]);w+=h}else if(T>=m.length){if(!x)for(p=0;p<h;++p)g.push(d[w+p]);w+=h}else if(null==m[T]){for(p=0;p<h;++p)g.push(null);y=!0,T+=f}else{if(o=d[w],a=d[w+1],s=m[T],l=m[T+1],c=0,o===s){for(p=0;p<h;++p)g.push(d[w+p]);c=l,w+=h,T+=f}else if(s<o){if(x&&0<w&&null!=d[w-h]){for(r=a+(d[w-h+1]-a)*(s-o)/(d[w-h]-o),g.push(s),g.push(r),p=2;p<h;++p)g.push(d[w+p]);c=l}T+=f}else{if(y&&x){w+=h;continue}for(p=0;p<h;++p)g.push(d[w+p]);x&&0<T&&null!=m[T-f]&&(c=l+(m[T-f+1]-l)*(o-s)/(m[T-f]-s)),w+=h}y=!1,u!==g.length&&v&&(g[u+2]=c)}if(b&&u!==g.length&&0<u&&null!==g[u]&&g[u]!==g[u-h]&&g[u+1]!==g[u-h+1]){for(p=0;p<h;++p)g[u+h+p]=g[u+p];g[u+1]=g[u-h+1]}}n.points=g}}})},options:{series:{fillBetween:null}},name:"fillbetween",version:"1.0"}),function(s){function e(t,e,n,i){var o="categories"===e.xaxis.options.mode,a="categories"===e.yaxis.options.mode;if(o||a){var r=i.format;if(!r){var s=e;if((r=[]).push({x:!0,number:!0,required:!0,computeRange:!0}),r.push({y:!0,number:!0,required:!0,computeRange:!0}),s.bars.show||s.lines.show&&s.lines.fill){var l=!!(s.bars.show&&s.bars.zero||s.lines.show&&s.lines.zero);r.push({y:!0,number:!0,required:!1,defaultValue:0,computeRange:l}),s.bars.horizontal&&(delete r[r.length-1].y,r[r.length-1].x=!0)}i.format=r}for(var c=0;c<r.length;++c)r[c].x&&o&&(r[c].number=!1),r[c].y&&a&&(r[c].number=!1,r[c].computeRange=!1)}}function l(t){var e=[];for(var n in t.categories){var i=t.categories[n];i>=t.min&&i<=t.max&&e.push([i,n])}return e.sort(function(t,e){return t[0]-e[0]}),e}function i(t,e,n){if("categories"===t[e].options.mode){if(!t[e].categories){var i={},o=t[e].options.categories||{};if(s.isArray(o))for(var a=0;a<o.length;++a)i[o[a]]=a;else for(var r in o)i[r]=o[r];t[e].categories=i}t[e].options.ticks||(t[e].options.ticks=l),function(t,e,n){for(var i=t.points,o=t.pointsize,a=t.format,r=e.charAt(0),s=function(t){var e=-1;for(var n in t)t[n]>e&&(e=t[n]);return e+1}(n),l=0;l<i.length;l+=o)if(null!=i[l])for(var c=0;c<o;++c){var u=i[l+c];null!=u&&a[c][r]&&(u in n||(n[u]=s,++s),i[l+c]=n[u])}}(n,e,t[e].categories)}}function n(t,e,n){i(e,"xaxis",n),i(e,"yaxis",n)}s.plot.plugins.push({init:function(t){t.hooks.processRawData.push(e),t.hooks.processDatapoints.push(n)},options:{xaxis:{categories:null},yaxis:{categories:null}},name:"categories",version:"1.0"})}(jQuery),jQuery.plot.plugins.push({init:function(t){t.hooks.processDatapoints.push(function(t,e,n){if(null!=e.stack&&!1!==e.stack){var i=e.bars.show||e.lines.show&&e.lines.fill,o=2<n.pointsize&&(e.bars.horizontal?n.format[2].x:n.format[2].y);i&&!o&&function(t,e){for(var n=[],i=0;i<e.points.length;i+=2)n.push(e.points[i]),n.push(e.points[i+1]),n.push(0);e.format.push({x:t.bars.horizontal,y:!t.bars.horizontal,number:!0,required:!1,computeRange:"none"!==t.yaxis.options.autoScale,defaultValue:0}),e.points=n,e.pointsize=3}(e,n);var a=function(t,e){for(var n=null,i=0;i<e.length&&t!==e[i];++i)e[i].stack===t.stack&&(n=e[i]);return n}(e,t.getData());if(a){for(var r,s,l,c,u,p,h,d,f=n.pointsize,m=n.points,g=a.datapoints.pointsize,x=a.datapoints.points,v=[],b=e.lines.show,y=e.bars.horizontal,w=b&&e.lines.steps,T=!0,k=y?1:0,M=y?0:1,S=0,P=0;!(S>=m.length);){if(h=v.length,null==m[S]){for(d=0;d<f;++d)v.push(m[S+d]);S+=f}else if(P>=x.length){if(!b)for(d=0;d<f;++d)v.push(m[S+d]);S+=f}else if(null==x[P]){for(d=0;d<f;++d)v.push(null);T=!0,P+=g}else{if(r=m[S+k],s=m[S+M],c=x[P+k],u=x[P+M],p=0,r===c){for(d=0;d<f;++d)v.push(m[S+d]);v[h+M]+=u,p=u,S+=f,P+=g}else if(c<r){if(b&&0<S&&null!=m[S-f]){for(l=s+(m[S-f+M]-s)*(c-r)/(m[S-f+k]-r),v.push(c),v.push(l+u),d=2;d<f;++d)v.push(m[S+d]);p=u}P+=g}else{if(T&&b){S+=f;continue}for(d=0;d<f;++d)v.push(m[S+d]);b&&0<P&&null!=x[P-g]&&(p=u+(x[P-g+M]-u)*(r-c)/(x[P-g+k]-c)),v[h+M]+=p,S+=f}T=!1,h!==v.length&&i&&(v[h+2]+=p)}if(w&&h!==v.length&&0<h&&null!==v[h]&&v[h]!==v[h-f]&&v[h+1]!==v[h-f+1]){for(d=0;d<f;++d)v[h+f+d]=v[h+d];v[h+1]=v[h-f+1]}}n.points=v}}})},options:{series:{stack:null}},name:"stack",version:"1.2"}),function(c){var m=c.plot.uiConstants.ZOOM_DISTANCE_MARGIN;function e(u,t){var i,o,a,p,h={zoomEnable:!1,prevDistance:null,prevTapTime:0,prevPanPosition:{x:0,y:0},prevTapPosition:{x:0,y:0}},d={prevTouchedAxis:"none",currentTouchedAxis:"none",touchedAxis:null,navigationConstraint:"unconstrained",initialState:null},n=t.pan.interactive&&"manual"===t.pan.touchMode,r="smartLock"===t.pan.touchMode,s=t.pan.interactive&&(r||"smart"===t.pan.touchMode);function f(t,e,n){d.touchedAxis=function(t,e,n,i){{if("pinchstart"!==e.type)return"panstart"===e.type?t.getTouchedAxis(e.detail.touches[0].pageX,e.detail.touches[0].pageY):"pinchend"===e.type?t.getTouchedAxis(e.detail.touches[0].pageX,e.detail.touches[0].pageY):i.touchedAxis;var o=t.getTouchedAxis(e.detail.touches[0].pageX,e.detail.touches[0].pageY),a=t.getTouchedAxis(e.detail.touches[1].pageX,e.detail.touches[1].pageY);if(o.length===a.length&&o.toString()===a.toString())return o}}(u,t,0,d),g(d)?d.navigationConstraint="unconstrained":d.navigationConstraint="axisConstrained"}i={start:function(t){if(f(t,"pan",h),l(t,"pan",h,d),s){var e=y(t,"pan");d.initialState=u.navigationState(e.x,e.y)}},drag:function(t){if(f(t,"pan",h),s){var e=y(t,"pan");u.smartPan({x:d.initialState.startPageX-e.x,y:d.initialState.startPageY-e.y},d.initialState,d.touchedAxis,!1,r)}else n&&(u.pan({left:-b(t,"pan",h).x,top:-b(t,"pan",h).y,axes:d.touchedAxis}),v(t,"pan",h,d))},end:function(t){var e;f(t,"pan",h),s&&u.smartPan.end(),e=t,h.zoomEnable&&1===e.detail.touches.length&&updateprevPanPosition(t,"pan",h,d)}},o={start:function(t){var e;p&&(clearTimeout(p),p=null),f(t,"pinch",h),e=t,h.prevDistance=x(e),l(t,"pinch",h,d)},drag:function(c){p||(p=setTimeout(function(){f(c,"pinch",h),u.pan({left:-b(c,"pinch",h).x,top:-b(c,"pinch",h).y,axes:d.touchedAxis}),v(c,"pinch",h,d);var t,e,n,i,o,a,r,s,l=x(c);(h.zoomEnable||Math.abs(l-h.prevDistance)>m)&&(e=c,n=h,i=d,o=(t=u).offset(),a={left:0,top:0},r=x(e)/n.prevDistance,s=x(e),a.left=y(e,"pinch").x-o.left,a.top=y(e,"pinch").y-o.top,t.zoom({center:a,amount:r,axes:i.touchedAxis}),n.prevDistance=s,h.zoomEnable=!0),p=null},1e3/60))},end:function(t){p&&(clearTimeout(p),p=null),f(t,"pinch",h),h.prevDistance=null}},a={recenterPlot:function(t){t&&t.detail&&"touchstart"===t.detail.type&&function(t,e,n,i){if(a=t,r=e,s=i,l=a.getTouchedAxis(r.detail.firstTouch.x,r.detail.firstTouch.y),void 0!==l[0]&&(s.prevTouchedAxis=l[0].direction),void 0!==(l=a.getTouchedAxis(r.detail.secondTouch.x,r.detail.secondTouch.y))[0]&&(s.touchedAxis=l,s.currentTouchedAxis=l[0].direction),g(s)&&(s.touchedAxis=null,s.prevTouchedAxis="none",s.currentTouchedAxis="none"),"x"===i.currentTouchedAxis&&"x"===i.prevTouchedAxis||"y"===i.currentTouchedAxis&&"y"===i.prevTouchedAxis||"none"===i.currentTouchedAxis&&"none"===i.prevTouchedAxis){var o;t.recenter({axes:i.touchedAxis}),o=i.touchedAxis?new c.Event("re-center",{detail:{axisTouched:i.touchedAxis}}):new c.Event("re-center",{detail:e}),t.getPlaceholder().trigger(o)}var a,r,s,l}(u,t,0,d)}},!0!==t.pan.enableTouch&&!0!==t.zoom.enableTouch||(u.hooks.bindEvents.push(function(t,e){var n=t.getOptions();n.zoom.interactive&&n.zoom.enableTouch&&(e[0].addEventListener("pinchstart",o.start,!1),e[0].addEventListener("pinchdrag",o.drag,!1),e[0].addEventListener("pinchend",o.end,!1)),n.pan.interactive&&n.pan.enableTouch&&(e[0].addEventListener("panstart",i.start,!1),e[0].addEventListener("pandrag",i.drag,!1),e[0].addEventListener("panend",i.end,!1)),n.recenter.interactive&&n.recenter.enableTouch&&e[0].addEventListener("doubletap",a.recenterPlot,!1)}),u.hooks.shutdown.push(function(t,e){e[0].removeEventListener("panstart",i.start),e[0].removeEventListener("pandrag",i.drag),e[0].removeEventListener("panend",i.end),e[0].removeEventListener("pinchstart",o.start),e[0].removeEventListener("pinchdrag",o.drag),e[0].removeEventListener("pinchend",o.end),e[0].removeEventListener("doubletap",a.recenterPlot)}))}function g(t){return!t.touchedAxis||0===t.touchedAxis.length}function l(t,e,n,i){var o,a=y(t,e);switch(i.navigationConstraint){case"unconstrained":i.touchedAxis=null,n.prevTapPosition={x:n.prevPanPosition.x,y:n.prevPanPosition.y},n.prevPanPosition={x:a.x,y:a.y};break;case"axisConstrained":o=i.touchedAxis[0].direction,i.currentTouchedAxis=o,n.prevTapPosition[o]=n.prevPanPosition[o],n.prevPanPosition[o]=a[o]}}function x(t){var e,n,i,o,a=t.detail.touches[0],r=t.detail.touches[1];return e=a.pageX,n=a.pageY,i=r.pageX,o=r.pageY,Math.sqrt((e-i)*(e-i)+(n-o)*(n-o))}function v(t,e,n,i){var o=y(t,e);switch(i.navigationConstraint){case"unconstrained":n.prevPanPosition.x=o.x,n.prevPanPosition.y=o.y;break;case"axisConstrained":n.prevPanPosition[i.currentTouchedAxis]=o[i.currentTouchedAxis]}}function b(t,e,n){var i=y(t,e);return{x:i.x-n.prevPanPosition.x,y:i.y-n.prevPanPosition.y}}function y(t,e){return"pinch"===e?{x:(t.detail.touches[0].pageX+t.detail.touches[1].pageX)/2,y:(t.detail.touches[0].pageY+t.detail.touches[1].pageY)/2}:{x:t.detail.touches[0].pageX,y:t.detail.touches[0].pageY}}c.plot.plugins.push({init:function(t){t.hooks.processOptions.push(e)},options:{zoom:{enableTouch:!1},pan:{enableTouch:!1,touchMode:"manual"},recenter:{enableTouch:!0}},name:"navigateTouch",version:"0.3"})}(jQuery),function(y){var w=y.plot.browser,e="click",T="hover";y.plot.plugins.push({init:function(g){var n,x=[];function i(t){var e=g.getOptions(),n=new CustomEvent("mouseevent");return n.pageX=t.detail.changedTouches[0].pageX,n.pageY=t.detail.changedTouches[0].pageY,n.clientX=t.detail.changedTouches[0].clientX,n.clientY=t.detail.changedTouches[0].clientY,e.grid.hoverable&&o(n,T,30),!1}function o(t,e,n){var i=g.getData();if(void 0!==t&&0<i.length&&void 0!==i[0].xaxis.c2p&&void 0!==i[0].yaxis.c2p){var o=e+"able";c("plot"+e,t,function(t){return!1!==i[t][o]},n)}}function a(t){n=t,o(g.getPlaceholder()[0].lastMouseMoveEvent=t,T)}function r(t){n=void 0,g.getPlaceholder()[0].lastMouseMoveEvent=void 0,c("plothover",t,function(t){return!1})}function s(t){o(t,e)}function l(){g.unhighlight(),g.getPlaceholder().trigger("plothovercleanup")}function c(t,e,n,i){var o=g.getOptions(),a=g.offset(),r=w.getPageXY(e),s=r.X-a.left,l=r.Y-a.top,c=g.c2p({left:s,top:l}),u=void 0!==i?i:o.grid.mouseActiveRadius;c.pageX=r.X,c.pageY=r.Y;for(var p=g.findNearbyItems(s,l,n,u),h=p[0],d=1;d<p.length;++d)(void 0===h.distance||p[d].distance<h.distance)&&(h=p[d]);if(h?(h.pageX=parseInt(h.series.xaxis.p2c(h.datapoint[0])+a.left,10),h.pageY=parseInt(h.series.yaxis.p2c(h.datapoint[1])+a.top,10)):h=null,o.grid.autoHighlight){for(var f=0;f<x.length;++f){var m=x[f];(m.auto!==t||h&&m.series===h.series&&m.point[0]===h.datapoint[0]&&m.point[1]===h.datapoint[1])&&h||b(m.series,m.point)}h&&v(h.series,h.datapoint,t)}g.getPlaceholder().trigger(t,[c,h,p])}function v(t,e,n){if("number"==typeof t&&(t=g.getData()[t]),"number"==typeof e){var i=t.datapoints.pointsize;e=t.datapoints.points.slice(i*e,i*(e+1))}var o=u(t,e);-1===o?(x.push({series:t,point:e,auto:n}),g.triggerRedrawOverlay()):n||(x[o].auto=!1)}function b(t,e){if(null==t&&null==e)return x=[],void g.triggerRedrawOverlay();if("number"==typeof t&&(t=g.getData()[t]),"number"==typeof e){var n=t.datapoints.pointsize;e=t.datapoints.points.slice(n*e,n*(e+1))}var i=u(t,e);-1!==i&&(x.splice(i,1),g.triggerRedrawOverlay())}function u(t,e){for(var n=0;n<x.length;++n){var i=x[n];if(i.series===t&&i.point[0]===e[0]&&i.point[1]===e[1])return n}return-1}function p(){l(),o(n,T)}function h(){o(n,T)}function d(t,e,n){var i,o,a=t.getPlotOffset();for(e.save(),e.translate(a.left,a.top),i=0;i<x.length;++i)(o=x[i]).series.bars.show?m(o.series,o.point,e):f(o.series,o.point,e,t);e.restore()}function f(t,e,n,i){var o=e[0],a=e[1],r=t.xaxis,s=t.yaxis,l="string"==typeof t.highlightColor?t.highlightColor:y.color.parse(t.color).scale("a",.5).toString();if(!(o<r.min||o>r.max||a<s.min||a>s.max)){var c=t.points.radius+t.points.lineWidth/2;n.lineWidth=c,n.strokeStyle=l;var u=1.5*c;o=r.p2c(o),a=s.p2c(a),n.beginPath();var p=t.points.symbol;"circle"===p?n.arc(o,a,u,0,2*Math.PI,!1):"string"==typeof p&&i.drawSymbol&&i.drawSymbol[p]&&i.drawSymbol[p](n,o,a,u,!1),n.closePath(),n.stroke()}}function m(t,e,n){var i,o="string"==typeof t.highlightColor?t.highlightColor:y.color.parse(t.color).scale("a",.5).toString(),a=o,r=t.bars.barWidth[0]||t.bars.barWidth;switch(t.bars.align){case"left":i=0;break;case"right":i=-r;break;default:i=-r/2}n.lineWidth=t.bars.lineWidth,n.strokeStyle=o;var s=t.bars.fillTowards||0,l=s>t.yaxis.min?Math.min(t.yaxis.max,s):t.yaxis.min;y.plot.drawSeries.drawBar(e[0],e[1],e[2]||l,i,i+r,function(){return a},t.xaxis,t.yaxis,n,t.bars.horizontal,t.bars.lineWidth)}g.hooks.bindEvents.push(function(t,e){var n=t.getOptions();(n.grid.hoverable||n.grid.clickable)&&(e[0].addEventListener("touchevent",l,!1),e[0].addEventListener("tap",i,!1)),n.grid.clickable&&e.bind("click",s),n.grid.hoverable&&(e.bind("mousemove",a),e.bind("mouseleave",r))}),g.hooks.shutdown.push(function(t,e){e[0].removeEventListener("tap",i),e[0].removeEventListener("touchevent",l),e.unbind("mousemove",a),e.unbind("mouseleave",r),e.unbind("click",s),x=[]}),g.hooks.processOptions.push(function(t,e){t.highlight=v,t.unhighlight=b,(e.grid.hoverable||e.grid.clickable)&&(t.hooks.drawOverlay.push(d),t.hooks.processDatapoints.push(p),t.hooks.setupGrid.push(h)),n=t.getPlaceholder()[0].lastMouseMoveEvent})},options:{grid:{hoverable:!1,clickable:!1}},name:"hover",version:"0.1"})}(jQuery),function(t){function e(n,t){var i,o={twoTouches:!1,currentTapStart:{x:0,y:0},currentTapEnd:{x:0,y:0},prevTap:{x:0,y:0},currentTap:{x:0,y:0},interceptedLongTap:!1,isUnsupportedGesture:!1,prevTapTime:null,tapStartTime:null,longTapTriggerId:null},a=20,r=500;function s(t){var e=n.getOptions();(e.pan.active||e.zoom.active)&&(3<=t.touches.length?o.isUnsupportedGesture=!0:o.isUnsupportedGesture=!1,i.dispatchEvent(new CustomEvent("touchevent",{detail:t})),v(t)?l(t,"pinch"):(l(t,"pan"),x(t)||(function(t){var e=(new Date).getTime(),n=e-o.prevTapTime;if(0<=n&&n<r&&g(o.prevTap.x,o.prevTap.y,o.currentTap.x,o.currentTap.y)<a)return t.firstTouch=o.prevTap,t.secondTouch=o.currentTap,!0;return o.prevTapTime=e,!1}(t)&&l(t,"doubleTap"),l(t,"tap"),l(t,"longTap"))))}function l(t,e){switch(e){case"pan":c[t.type](t);break;case"pinch":u[t.type](t);break;case"doubleTap":p.onDoubleTap(t);break;case"longTap":h[t.type](t);break;case"tap":d[t.type](t)}}var c={touchstart:function(t){var e;o.prevTap={x:o.currentTap.x,y:o.currentTap.y},f(t),e=t,o.tapStartTime=(new Date).getTime(),o.interceptedLongTap=!1,o.currentTapStart={x:e.touches[0].pageX,y:e.touches[0].pageY},o.currentTapEnd={x:e.touches[0].pageX,y:e.touches[0].pageY},i.dispatchEvent(new CustomEvent("panstart",{detail:t}))},touchmove:function(t){var e;m(t),f(t),e=t,o.currentTapEnd={x:e.touches[0].pageX,y:e.touches[0].pageY},o.isUnsupportedGesture||i.dispatchEvent(new CustomEvent("pandrag",{detail:t}))},touchend:function(t){var e;m(t),x(t)?(i.dispatchEvent(new CustomEvent("pinchend",{detail:t})),i.dispatchEvent(new CustomEvent("panstart",{detail:t}))):(e=t).touches&&0===e.touches.length&&i.dispatchEvent(new CustomEvent("panend",{detail:t}))}},u={touchstart:function(t){i.dispatchEvent(new CustomEvent("pinchstart",{detail:t}))},touchmove:function(t){m(t),o.twoTouches=v(t),o.isUnsupportedGesture||i.dispatchEvent(new CustomEvent("pinchdrag",{detail:t}))},touchend:function(t){m(t)}},p={onDoubleTap:function(t){m(t),i.dispatchEvent(new CustomEvent("doubletap",{detail:t}))}},h={touchstart:function(t){h.waitForLongTap(t)},touchmove:function(t){},touchend:function(t){o.longTapTriggerId&&(clearTimeout(o.longTapTriggerId),o.longTapTriggerId=null)},isLongTap:function(t){return 1500<=(new Date).getTime()-o.tapStartTime&&!o.interceptedLongTap&&g(o.currentTapStart.x,o.currentTapStart.y,o.currentTapEnd.x,o.currentTapEnd.y)<20&&(o.interceptedLongTap=!0)},waitForLongTap:function(t){o.longTapTriggerId||(o.longTapTriggerId=setTimeout(function(){h.isLongTap(t)&&i.dispatchEvent(new CustomEvent("longtap",{detail:t})),o.longTapTriggerId=null},1500))}},d={touchstart:function(t){o.tapStartTime=(new Date).getTime()},touchmove:function(t){},touchend:function(t){d.isTap(t)&&(i.dispatchEvent(new CustomEvent("tap",{detail:t})),m(t))},isTap:function(t){return(new Date).getTime()-o.tapStartTime<=125&&g(o.currentTapStart.x,o.currentTapStart.y,o.currentTapEnd.x,o.currentTapEnd.y)<20}};function f(t){o.currentTap={x:t.touches[0].pageX,y:t.touches[0].pageY}}function m(t){o.isUnsupportedGesture||(t.preventDefault(),n.getOptions().propagateSupportedGesture||t.stopPropagation())}function g(t,e,n,i){return Math.sqrt((t-n)*(t-n)+(e-i)*(e-i))}function x(t){return o.twoTouches&&1===t.touches.length}function v(t){return!!(t.touches&&2<=t.touches.length&&t.touches[0].target===n.getEventHolder()&&t.touches[1].target===n.getEventHolder())}(!0===t.pan.enableTouch||t.zoom.enableTouch)&&(n.hooks.bindEvents.push(function(t,e){i=e[0],e[0].addEventListener("touchstart",s,!1),e[0].addEventListener("touchmove",s,!1),e[0].addEventListener("touchend",s,!1)}),n.hooks.shutdown.push(function(t,e){e[0].removeEventListener("touchstart",s),e[0].removeEventListener("touchmove",s),e[0].removeEventListener("touchend",s),o.longTapTriggerId&&(clearTimeout(o.longTapTriggerId),o.longTapTriggerId=null)}))}jQuery.plot.plugins.push({init:function(t){t.hooks.processOptions.push(e)},options:{propagateSupportedGesture:!1},name:"navigateTouch",version:"0.3"})}(),function(e){var y=e.plot.saturated.floorInBase,o=function(t,e){var n=new t(e),i=n.setTime.bind(n);n.update=function(t){t=Math.round(1e3*t)/1e3,i(t),this.microseconds=1e3*(t-Math.floor(t))};var o=n.getTime.bind(n);return n.getTime=function(){return o()+this.microseconds/1e3},n.setTime=function(t){this.update(t)},n.getMicroseconds=function(){return this.microseconds},n.setMicroseconds=function(t){var e=o()+t/1e3;this.update(e)},n.setUTCMicroseconds=function(t){this.setMicroseconds(t)},n.getUTCMicroseconds=function(){return this.getMicroseconds()},n.microseconds=null,n.microEpoch=null,n.update(e),n};function d(t,e,n,i){if("function"==typeof t.strftime)return t.strftime(e);var o,a=function(t,e){return e=""+(null==e?"0":e),1===(t=""+t).length?e+t:t},r=function(t,e,n){var i,o=1e3*t+e;if(n<6&&0<n){var a=parseFloat("1e"+(n-6));i=("00000"+(o=Math.round(Math.round(o*a)/a))).slice(-6,-(6-n))}else i=("00000"+(o=Math.round(o))).slice(-6);return i},s=[],l=!1,c=t.getHours(),u=c<12;n||(n=["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"]),i||(i=["Sun","Mon","Tue","Wed","Thu","Fri","Sat"]),o=12<c?c-12:0===c?12:c;for(var p=-1,h=0;h<e.length;++h){var d=e.charAt(h);if(!isNaN(Number(d))&&0<Number(d))p=Number(d);else if(l){switch(d){case"a":d=""+i[t.getDay()];break;case"b":d=""+n[t.getMonth()];break;case"d":d=a(t.getDate());break;case"e":d=a(t.getDate()," ");break;case"h":case"H":d=a(c);break;case"I":d=a(o);break;case"l":d=a(o," ");break;case"m":d=a(t.getMonth()+1);break;case"M":d=a(t.getMinutes());break;case"q":d=""+(Math.floor(t.getMonth()/3)+1);break;case"S":d=a(t.getSeconds());break;case"s":d=""+r(t.getMilliseconds(),t.getMicroseconds(),p);break;case"y":d=a(t.getFullYear()%100);break;case"Y":d=""+t.getFullYear();break;case"p":d=u?"am":"pm";break;case"P":d=u?"AM":"PM";break;case"w":d=""+t.getDay()}s.push(d),l=!1}else"%"===d?l=!0:s.push(d)}return s.join("")}function a(t){function e(t,e,n,i){t[e]=function(){return n[i].apply(n,arguments)}}var n={date:t};void 0!==t.strftime&&e(n,"strftime",t,"strftime"),e(n,"getTime",t,"getTime"),e(n,"setTime",t,"setTime");for(var i=["Date","Day","FullYear","Hours","Minutes","Month","Seconds","Milliseconds","Microseconds"],o=0;o<i.length;o++)e(n,"get"+i[o],t,"getUTC"+i[o]),e(n,"set"+i[o],t,"setUTC"+i[o]);return n}function w(t,e){var n=864e13;if(e&&"seconds"===e.timeBase?t*=1e3:"microseconds"===e.timeBase&&(t/=1e3),n<t?t=n:t<-n&&(t=-n),"browser"===e.timezone)return o(Date,t);if(e.timezone&&"utc"!==e.timezone){if("undefined"==typeof timezoneJS||void 0===timezoneJS.Date)return a(o(Date,t));var i=o(timezoneJS.Date,t);return i.setTimezone(e.timezone),i.setTime(t),i}return a(o(Date,t))}var T={microsecond:1e-6,millisecond:.001,second:1,minute:60,hour:3600,day:86400,month:2592e3,quarter:7776e3,year:525949.2*60},k={microsecond:.001,millisecond:1,second:1e3,minute:6e4,hour:36e5,day:864e5,month:2592e6,quarter:7776e6,year:525949.2*60*1e3},M={microsecond:1,millisecond:1e3,second:1e6,minute:6e7,hour:36e8,day:864e8,month:2592e9,quarter:7776e9,year:525949.2*60*1e6},t=[[1,"microsecond"],[2,"microsecond"],[5,"microsecond"],[10,"microsecond"],[25,"microsecond"],[50,"microsecond"],[100,"microsecond"],[250,"microsecond"],[500,"microsecond"],[1,"millisecond"],[2,"millisecond"],[5,"millisecond"],[10,"millisecond"],[25,"millisecond"],[50,"millisecond"],[100,"millisecond"],[250,"millisecond"],[500,"millisecond"],[1,"second"],[2,"second"],[5,"second"],[10,"second"],[30,"second"],[1,"minute"],[2,"minute"],[5,"minute"],[10,"minute"],[30,"minute"],[1,"hour"],[2,"hour"],[4,"hour"],[8,"hour"],[12,"hour"],[1,"day"],[2,"day"],[3,"day"],[.25,"month"],[.5,"month"],[1,"month"],[2,"month"]],S=t.concat([[3,"month"],[6,"month"],[1,"year"]]),P=t.concat([[1,"quarter"],[2,"quarter"],[1,"year"]]);function n(t){var e,n=t.options,i=[],o=w(t.min,n),a=0,r=n.tickSize&&"quarter"===n.tickSize[1]||n.minTickSize&&"quarter"===n.minTickSize[1]?P:S;e="seconds"===n.timeBase?T:"microseconds"===n.timeBase?M:k,null!==n.minTickSize&&void 0!==n.minTickSize&&(a="number"==typeof n.tickSize?n.tickSize:n.minTickSize[0]*e[n.minTickSize[1]]);for(var s=0;s<r.length-1&&!(t.delta<(r[s][0]*e[r[s][1]]+r[s+1][0]*e[r[s+1][1]])/2&&r[s][0]*e[r[s][1]]>=a);++s);var l=r[s][0],c=r[s][1];if("year"===c){if(null!==n.minTickSize&&void 0!==n.minTickSize&&"year"===n.minTickSize[1])l=Math.floor(n.minTickSize[0]);else{var u=parseFloat("1e"+Math.floor(Math.log(t.delta/e.year)/Math.LN10)),p=t.delta/e.year/u;l=p<1.5?1:p<3?2:p<7.5?5:10,l*=u}l<1&&(l=1)}t.tickSize=n.tickSize||[l,c];var h=t.tickSize[0],d=h*e[c=t.tickSize[1]];"microsecond"===c?o.setMicroseconds(y(o.getMicroseconds(),h)):"millisecond"===c?o.setMilliseconds(y(o.getMilliseconds(),h)):"second"===c?o.setSeconds(y(o.getSeconds(),h)):"minute"===c?o.setMinutes(y(o.getMinutes(),h)):"hour"===c?o.setHours(y(o.getHours(),h)):"month"===c?o.setMonth(y(o.getMonth(),h)):"quarter"===c?o.setMonth(3*y(o.getMonth()/3,h)):"year"===c&&o.setFullYear(y(o.getFullYear(),h)),d>=e.millisecond&&o.setMicroseconds(0),d>=e.second&&o.setMilliseconds(0),d>=e.minute&&o.setSeconds(0),d>=e.hour&&o.setMinutes(0),d>=e.day&&o.setHours(0),d>=4*e.day&&o.setDate(1),d>=2*e.month&&o.setMonth(y(o.getMonth(),3)),d>=2*e.quarter&&o.setMonth(y(o.getMonth(),6)),d>=e.year&&o.setMonth(0);var f,m,g=0,x=Number.NaN;do{if(m=x,f=o.getTime(),x=n&&"seconds"===n.timeBase?f/1e3:n&&"microseconds"===n.timeBase?1e3*f:f,i.push(x),"month"===c||"quarter"===c)if(h<1){o.setDate(1);var v=o.getTime();o.setMonth(o.getMonth()+("quarter"===c?3:1));var b=o.getTime();o.setTime(x+g*e.hour+(b-v)*h),g=o.getHours(),o.setHours(0)}else o.setMonth(o.getMonth()+h*("quarter"===c?3:1));else"year"===c?o.setFullYear(o.getFullYear()+h):"seconds"===n.timeBase?o.setTime(1e3*(x+d)):"microseconds"===n.timeBase?o.setTime((x+d)/1e3):o.setTime(x+d)}while(x<t.max&&x!==m);return i}e.plot.plugins.push({init:function(t){t.hooks.processOptions.push(function(t){e.each(t.getAxes(),function(t,e){var h=e.options;if("time"===h.mode){if(e.tickGenerator=n,"tickFormatter"in h&&"function"==typeof h.tickFormatter)return;e.tickFormatter=function(t,e){var n=w(t,e.options);if(null!=h.timeformat)return d(n,h.timeformat,h.monthNames,h.dayNames);var i,o=e.options.tickSize&&"quarter"===e.options.tickSize[1]||e.options.minTickSize&&"quarter"===e.options.minTickSize[1];i="seconds"===h.timeBase?T:"microseconds"===h.timeBase?M:k;var a,r,s=e.tickSize[0]*i[e.tickSize[1]],l=e.max-e.min,c=h.twelveHourClock?" %p":"",u=h.twelveHourClock?"%I":"%H";if(a="seconds"===h.timeBase?1:"microseconds"===h.timeBase?1e6:1e3,s<i.second){var p=-Math.floor(Math.log10(s/a));-1<String(s).indexOf("25")&&p++,r="%S.%"+p+"s"}else r=s<i.minute?u+":%M:%S"+c:s<i.day?l<2*i.day?u+":%M"+c:"%b %d "+u+":%M"+c:s<i.month?"%b %d":o&&s<i.quarter||!o&&s<i.year?l<i.year?"%b":"%b %Y":o&&s<i.year?l<i.year?"Q%q":"Q%q %Y":"%Y";return d(n,r,h.monthNames,h.dayNames)}}})})},options:{xaxis:{timezone:null,timeformat:null,twelveHourClock:!1,monthNames:null,timeBase:"seconds"},yaxis:{timeBase:"seconds"}},name:"time",version:"1.0"}),e.plot.formatDate=d,e.plot.dateGenerator=w,e.plot.dateTickGenerator=n,e.plot.makeUtcWrapper=a}(jQuery),function(n){function s(t,e,n,i,o,a){this.axisName=t,this.position=e,this.padding=n,this.placeholder=i,this.axisLabel=o,this.surface=a,this.width=0,this.height=0,this.elem=null}s.prototype.calculateSize=function(){var t=this.axisName+"Label",e=t+"Layer",n=t+" axisLabels",i=this.surface.getTextInfo(e,this.axisLabel,n);this.labelWidth=i.width,this.labelHeight=i.height,"left"===this.position||"right"===this.position?(this.width=this.labelHeight+this.padding,this.height=0):(this.width=0,this.height=this.labelHeight+this.padding)},s.prototype.transforms=function(t,e,n,i){var o,a,r=[];if(0===e&&0===n||((o=i.createSVGTransform()).setTranslate(e,n),r.push(o)),0!==t){a=i.createSVGTransform();var s=Math.round(this.labelWidth/2);a.setRotate(t,s,0),r.push(a)}return r},s.prototype.calculateOffsets=function(t){var e={x:0,y:0,degrees:0};return"bottom"===this.position?(e.x=t.left+t.width/2-this.labelWidth/2,e.y=t.top+t.height-this.labelHeight):"top"===this.position?(e.x=t.left+t.width/2-this.labelWidth/2,e.y=t.top):"left"===this.position?(e.degrees=-90,e.x=t.left-this.labelWidth/2,e.y=t.height/2+t.top):"right"===this.position&&(e.degrees=90,e.x=t.left+t.width-this.labelWidth/2,e.y=t.height/2+t.top),e.x=Math.round(e.x),e.y=Math.round(e.y),e},s.prototype.cleanup=function(){var t=this.axisName+"Label",e=t+"Layer",n=t+" axisLabels";this.surface.removeText(e,0,0,this.axisLabel,n)},s.prototype.draw=function(t){var e=this.axisName+"Label",n=e+"Layer",i=e+" axisLabels",o=this.calculateOffsets(t),a={position:"absolute",bottom:"",right:"",display:"inline-block","white-space":"nowrap"},r=this.surface.getSVGLayer(n),s=this.transforms(o.degrees,o.x,o.y,r.parentNode);this.surface.addText(n,0,0,this.axisLabel,i,void 0,void 0,void 0,void 0,s),this.surface.render(),Object.keys(a).forEach(function(t){r.style[t]=a[t]})},n.plot.plugins.push({init:function(t){t.hooks.processOptions.push(function(t,e){if(e.axisLabels.show){var r={};t.hooks.axisReserveSpace.push(function(t,e){var n=e.options,i=e.direction+e.n;if(e.labelHeight+=e.boxPosition.centerY,e.labelWidth+=e.boxPosition.centerX,n&&n.axisLabel&&e.show){var o=void 0===n.axisLabelPadding?2:n.axisLabelPadding,a=r[i];a||(a=new s(i,n.position,o,t.getPlaceholder()[0],n.axisLabel,t.getSurface()),r[i]=a),a.calculateSize(),e.labelHeight+=a.height,e.labelWidth+=a.width}}),t.hooks.draw.push(function(t,e){n.each(t.getAxes(),function(t,e){var n=e.options;if(n&&n.axisLabel&&e.show){var i=e.direction+e.n;r[i].draw(e.box)}})}),t.hooks.shutdown.push(function(t,e){for(var n in r)r[n].cleanup()})}})},options:{axisLabels:{show:!0}},name:"axisLabels",version:"3.0"})}(jQuery),function(P){P.plot.plugins.push({init:function(c){var k={first:{x:-1,y:-1},second:{x:-1,y:-1},show:!1,currentMode:"xy",active:!1},o=P.plot.uiConstants.SNAPPING_CONSTANT,n={};function i(t){k.active&&(p(t),c.getPlaceholder().trigger("plotselecting",[e()]))}function a(t){var e=c.getOptions();1===t.which&&null!==e.selection.mode&&(k.currentMode="xy",document.body.focus(),void 0!==document.onselectstart&&null==n.onselectstart&&(n.onselectstart=document.onselectstart,document.onselectstart=function(){return!1}),void 0!==document.ondrag&&null==n.ondrag&&(n.ondrag=document.ondrag,document.ondrag=function(){return!1}),u(k.first,t),k.active=!0)}function r(t){return void 0!==document.onselectstart&&(document.onselectstart=n.onselectstart),void 0!==document.ondrag&&(document.ondrag=n.ondrag),k.active=!1,p(t),S()?s():(c.getPlaceholder().trigger("plotunselected",[]),c.getPlaceholder().trigger("plotselecting",[null])),!1}function e(){if(!S())return null;if(!k.show)return null;var o={},a={x:k.first.x,y:k.first.y},r={x:k.second.x,y:k.second.y};return"x"===M(c)&&(a.y=0,r.y=c.height()),"y"===M(c)&&(a.x=0,r.x=c.width()),P.each(c.getAxes(),function(t,e){if(e.used){var n=e.c2p(a[e.direction]),i=e.c2p(r[e.direction]);o[t]={from:Math.min(n,i),to:Math.max(n,i)}}}),o}function s(){var t=e();c.getPlaceholder().trigger("plotselected",[t]),t.xaxis&&t.yaxis&&c.getPlaceholder().trigger("selected",[{x1:t.xaxis.from,y1:t.yaxis.from,x2:t.xaxis.to,y2:t.yaxis.to}])}function l(t,e,n){return e<t?t:n<e?n:e}function M(t){var e=t.getOptions();return"smart"===e.selection.mode?k.currentMode:e.selection.mode}function u(t,e){var n=c.getPlaceholder().offset(),i=c.getPlotOffset();t.x=l(0,e.pageX-n.left-i.left,c.width()),t.y=l(0,e.pageY-n.top-i.top,c.height()),t!==k.first&&function(t){if(k.first){var e={x:t.x-k.first.x,y:t.y-k.first.y};Math.abs(e.x)<o?k.currentMode="y":Math.abs(e.y)<o?k.currentMode="x":k.currentMode="xy"}}(t),"y"===M(c)&&(t.x=t===k.first?0:c.width()),"x"===M(c)&&(t.y=t===k.first?0:c.height())}function p(t){null!=t.pageX&&(u(k.second,t),S()?(k.show=!0,c.triggerRedrawOverlay()):h(!0))}function h(t){k.show&&(k.show=!1,k.currentMode="",c.triggerRedrawOverlay(),t||c.getPlaceholder().trigger("plotunselected",[]))}function d(t,e){var n,i,o,a,r=c.getAxes();for(var s in r)if((n=r[s]).direction===e&&(t[a=e+n.n+"axis"]||1!==n.n||(a=e+"axis"),t[a])){i=t[a].from,o=t[a].to;break}if(t[a]||(n="x"===e?c.getXAxes()[0]:c.getYAxes()[0],i=t[e+"1"],o=t[e+"2"]),null!=i&&null!=o&&o<i){var l=i;i=o,o=l}return{from:i,to:o,axis:n}}function S(){var t=c.getOptions().selection.minSize;return Math.abs(k.second.x-k.first.x)>=t&&Math.abs(k.second.y-k.first.y)>=t}c.clearSelection=h,c.setSelection=function(t,e){var n;"y"===M(c)?(k.first.x=0,k.second.x=c.width()):(n=d(t,"x"),k.first.x=n.axis.p2c(n.from),k.second.x=n.axis.p2c(n.to)),"x"===M(c)?(k.first.y=0,k.second.y=c.height()):(n=d(t,"y"),k.first.y=n.axis.p2c(n.from),k.second.y=n.axis.p2c(n.to)),k.show=!0,c.triggerRedrawOverlay(),!e&&S()&&s()},c.getSelection=e,c.hooks.bindEvents.push(function(t,e){null!=t.getOptions().selection.mode&&(t.addEventHandler("dragstart",a,e,0),t.addEventHandler("drag",i,e,0),t.addEventHandler("dragend",r,e,0))}),c.hooks.drawOverlay.push(function(t,e){if(k.show&&S()){var n=t.getPlotOffset(),i=t.getOptions();e.save(),e.translate(n.left,n.top);var o=P.color.parse(i.selection.color),a=i.selection.visualization,r=i.selection.displaySelectionDecorations,s=1;"fill"===a&&(s=.8),e.strokeStyle=o.scale("a",s).toString(),e.lineWidth=1,e.lineJoin=i.selection.shape,e.fillStyle=o.scale("a",.4).toString();var l=Math.min(k.first.x,k.second.x)+.5,c=l,u=Math.min(k.first.y,k.second.y)+.5,p=u,h=Math.abs(k.second.x-k.first.x)-1,d=Math.abs(k.second.y-k.first.y)-1;"x"===M(t)&&(d+=u,u=0),"y"===M(t)&&(h+=l,l=0),"fill"===a?(e.fillRect(l,u,h,d),e.strokeRect(l,u,h,d)):(e.fillRect(0,0,t.width(),t.height()),e.clearRect(l,u,h,d),r&&(f=e,m=l,g=u,x=h,v=d,b=c,y=p,w=M(t),T=Math.max(0,Math.min(15,x/2-2,v/2-2)),f.fillStyle="#ffffff","xy"===w&&(f.beginPath(),f.moveTo(m,g+T),f.lineTo(m-3,g+T),f.lineTo(m-3,g-3),f.lineTo(m+T,g-3),f.lineTo(m+T,g),f.lineTo(m,g),f.closePath(),f.moveTo(m,g+v-T),f.lineTo(m-3,g+v-T),f.lineTo(m-3,g+v+3),f.lineTo(m+T,g+v+3),f.lineTo(m+T,g+v),f.lineTo(m,g+v),f.closePath(),f.moveTo(m+x,g+T),f.lineTo(m+x+3,g+T),f.lineTo(m+x+3,g-3),f.lineTo(m+x-T,g-3),f.lineTo(m+x-T,g),f.lineTo(m+x,g),f.closePath(),f.moveTo(m+x,g+v-T),f.lineTo(m+x+3,g+v-T),f.lineTo(m+x+3,g+v+3),f.lineTo(m+x-T,g+v+3),f.lineTo(m+x-T,g+v),f.lineTo(m+x,g+v),f.closePath(),f.stroke(),f.fill()),m=b,g=y,"x"===w&&(f.beginPath(),f.moveTo(m,g+15),f.lineTo(m,g-15),f.lineTo(m-3,g-15),f.lineTo(m-3,g+15),f.closePath(),f.moveTo(m+x,g+15),f.lineTo(m+x,g-15),f.lineTo(m+x+3,g-15),f.lineTo(m+x+3,g+15),f.closePath(),f.stroke(),f.fill()),"y"===w&&(f.beginPath(),f.moveTo(m-15,g),f.lineTo(m+15,g),f.lineTo(m+15,g-3),f.lineTo(m-15,g-3),f.closePath(),f.moveTo(m-15,g+v),f.lineTo(m+15,g+v),f.lineTo(m+15,g+v+3),f.lineTo(m-15,g+v+3),f.closePath(),f.stroke(),f.fill()))),e.restore()}var f,m,g,x,v,b,y,w,T}),c.hooks.shutdown.push(function(t,e){e.unbind("dragstart",a),e.unbind("drag",i),e.unbind("dragend",r)})},options:{selection:{mode:null,visualization:"focus",displaySelectionDecorations:!0,color:"#888888",shape:"round",minSize:5}},name:"selection",version:"1.1"})}(jQuery),function(t){var e=-100,c=0,u=-1,p=-2,h=1,g=t.plot.browser,a=g.getPixelRatio;function n(t,e){var n=t.filter(r);h=a(e.getContext("2d"));var i,o=n.map(function(t){var f,m,e=new Image;return new Promise((m=t,(f=e).sourceDescription='<info className="'+m.className+'" tagName="'+m.tagName+'" id="'+m.id+'">',f.sourceComponent=m,function(e,t){var n,i,o,a,r,s,l,c,u,p,h,d;f.onload=function(t){f.successfullyLoaded=!0,e(f)},f.onabort=function(t){f.successfullyLoaded=!1,console.log("Can't generate temp image from "+f.sourceDescription+". It is possible that it is missing some properties or its content is not supported by this browser. Source component:",f.sourceComponent),e(f)},f.onerror=function(t){f.successfullyLoaded=!1,console.log("Can't generate temp image from "+f.sourceDescription+". It is possible that it is missing some properties or its content is not supported by this browser. Source component:",f.sourceComponent),e(f)},i=f,"CANVAS"===(n=m).tagName&&(o=n,i.src=o.toDataURL("image/png")),"svg"===n.tagName&&(a=n,r=i,g.isSafari()||g.isMobileSafari()?(s=a,l=r,p=b(p=v(x(document),s)),u=function(t){for(var e="",n=new Uint8Array(t),i=0;i<n.length;i+=16384){var o=String.fromCharCode.apply(null,n.subarray(i,i+16384));e+=o}return e}(new(TextEncoder||TextEncoderLite)("utf-8").encode(p)),c="data:image/svg+xml;base64,"+btoa(u),l.src=c):function(t,e){var n=v(x(document),t);n=b(n);var i=new Blob([n],{type:"image/svg+xml;charset=utf-8"}),o=(self.URL||self.webkitURL||self).createObjectURL(i);e.src=o}(a,r)),i.srcImgTagName=n.tagName,h=n,(d=i).genLeft=h.getBoundingClientRect().left,d.genTop=h.getBoundingClientRect().top,"CANVAS"===h.tagName&&(d.genRight=d.genLeft+h.width,d.genBottom=d.genTop+h.height),"svg"===h.tagName&&(d.genRight=h.getBoundingClientRect().right,d.genBottom=h.getBoundingClientRect().bottom)}))});return Promise.all(o).then((i=e,function(t){var e=function(t,e){var n=function(t,e){var n,i=c;if(0===t.length)i=u;else{var o=t[0].genLeft,a=t[0].genTop,r=t[0].genRight,s=t[0].genBottom,l=0;for(l=1;l<t.length;l++)o>t[l].genLeft&&(o=t[l].genLeft),a>t[l].genTop&&(a=t[l].genTop);for(l=1;l<t.length;l++)r<t[l].genRight&&(r=t[l].genRight),s<t[l].genBottom&&(s=t[l].genBottom);if(r-o<=0||s-a<=0)i=p;else{for(e.width=Math.round(r-o),e.height=Math.round(s-a),l=0;l<t.length;l++)t[l].xCompOffset=t[l].genLeft-o,t[l].yCompOffset=t[l].genTop-a;n=e,void 0!==t.find(function(t){return"svg"===t.srcImgTagName})&&h<1&&(n.width=n.width*h,n.height=n.height*h)}}return i}(t,e);if(n===c)for(var i=e.getContext("2d"),o=0;o<t.length;o++)!0===t[o].successfullyLoaded&&i.drawImage(t[o],t[o].xCompOffset*h,t[o].yCompOffset*h);return n}(t,i);return e}),s)}function r(t){var e=!0,n=!0;return null==t?n=!1:"CANVAS"===t.tagName&&(t.getBoundingClientRect().right!==t.getBoundingClientRect().left&&t.getBoundingClientRect().bottom!==t.getBoundingClientRect().top||(e=!1)),n&&e&&"visible"===window.getComputedStyle(t).visibility}function x(t){for(var e=t.styleSheets,n=[],i=0;i<e.length;i++)try{for(var o=e[i].cssRules||[],a=0;a<o.length;a++){var r=o[a];n.push(r.cssText)}}catch(t){console.log("Failed to get some css rules")}return n}function v(t,e){return['<svg class="snapshot '+e.classList+'" width="'+e.width.baseVal.value*h+'" height="'+e.height.baseVal.value*h+'" viewBox="0 0 '+e.width.baseVal.value+" "+e.height.baseVal.value+'" xmlns="http://www.w3.org/2000/svg">',"<style>","/* <![CDATA[ */",t.join("\n"),"/* ]]> */","</style>",e.innerHTML,"</svg>"].join("\n")}function b(t){var e="";return t.match(/^<svg[^>]+xmlns="http:\/\/www\.w3\.org\/2000\/svg"/)||(e=t.replace(/^<svg/,'<svg xmlns="http://www.w3.org/2000/svg"')),t.match(/^<svg[^>]+"http:\/\/www\.w3\.org\/1999\/xlink"/)||(e=t.replace(/^<svg/,'<svg xmlns:xlink="http://www.w3.org/1999/xlink"')),'<?xml version="1.0" standalone="no"?>\r\n'+e}function s(){return e}t.plot.composeImages=n,t.plot.plugins.push({init:function(t){t.composeImages=n},name:"composeImages",version:"1.0"})}(jQuery),function(S){function P(t){var e="",n=t.name,i=t.xPos,o=t.yPos,a=t.fillColor,r=t.strokeColor,s=t.strokeWidth;switch(n){case"circle":e='<use xlink:href="#circle" class="legendIcon" x="'+i+'" y="'+o+'" fill="'+a+'" stroke="'+r+'" stroke-width="'+s+'" width="1.5em" height="1.5em"/>';break;case"diamond":e='<use xlink:href="#diamond" class="legendIcon" x="'+i+'" y="'+o+'" fill="'+a+'" stroke="'+r+'" stroke-width="'+s+'" width="1.5em" height="1.5em"/>';break;case"cross":e='<use xlink:href="#cross" class="legendIcon" x="'+i+'" y="'+o+'" stroke="'+r+'" stroke-width="'+s+'" width="1.5em" height="1.5em"/>';break;case"rectangle":e='<use xlink:href="#rectangle" class="legendIcon" x="'+i+'" y="'+o+'" fill="'+a+'" stroke="'+r+'" stroke-width="'+s+'" width="1.5em" height="1.5em"/>';break;case"plus":e='<use xlink:href="#plus" class="legendIcon" x="'+i+'" y="'+o+'" stroke="'+r+'" stroke-width="'+s+'" width="1.5em" height="1.5em"/>';break;case"bar":e='<use xlink:href="#bars" class="legendIcon" x="'+i+'" y="'+o+'" fill="'+a+'" width="1.5em" height="1.5em"/>';break;case"area":e='<use xlink:href="#area" class="legendIcon" x="'+i+'" y="'+o+'" fill="'+a+'" width="1.5em" height="1.5em"/>';break;case"line":e='<use xlink:href="#line" class="legendIcon" x="'+i+'" y="'+o+'" stroke="'+r+'" stroke-width="'+s+'" width="1.5em" height="1.5em"/>';break;default:e='<use xlink:href="#circle" class="legendIcon" x="'+i+'" y="'+o+'" fill="'+a+'" stroke="'+r+'" stroke-width="'+s+'" width="1.5em" height="1.5em"/>'}return e}var C='<defs><symbol id="line" fill="none" viewBox="-5 -5 25 25"><polyline points="0,15 5,5 10,10 15,0"/></symbol><symbol id="area" stroke-width="1" viewBox="-5 -5 25 25"><polyline points="0,15 5,5 10,10 15,0, 15,15, 0,15"/></symbol><symbol id="bars" stroke-width="1" viewBox="-5 -5 25 25"><polyline points="1.5,15.5 1.5,12.5, 4.5,12.5 4.5,15.5 6.5,15.5 6.5,3.5, 9.5,3.5 9.5,15.5 11.5,15.5 11.5,7.5 14.5,7.5 14.5,15.5 1.5,15.5"/></symbol><symbol id="circle" viewBox="-5 -5 25 25"><circle cx="0" cy="15" r="2.5"/><circle cx="5" cy="5" r="2.5"/><circle cx="10" cy="10" r="2.5"/><circle cx="15" cy="0" r="2.5"/></symbol><symbol id="rectangle" viewBox="-5 -5 25 25"><rect x="-2.1" y="12.9" width="4.2" height="4.2"/><rect x="2.9" y="2.9" width="4.2" height="4.2"/><rect x="7.9" y="7.9" width="4.2" height="4.2"/><rect x="12.9" y="-2.1" width="4.2" height="4.2"/></symbol><symbol id="diamond" viewBox="-5 -5 25 25"><path d="M-3,15 L0,12 L3,15, L0,18 Z"/><path d="M2,5 L5,2 L8,5, L5,8 Z"/><path d="M7,10 L10,7 L13,10, L10,13 Z"/><path d="M12,0 L15,-3 L18,0, L15,3 Z"/></symbol><symbol id="cross" fill="none" viewBox="-5 -5 25 25"><path d="M-2.1,12.9 L2.1,17.1, M2.1,12.9 L-2.1,17.1 Z"/><path d="M2.9,2.9 L7.1,7.1 M7.1,2.9 L2.9,7.1 Z"/><path d="M7.9,7.9 L12.1,12.1 M12.1,7.9 L7.9,12.1 Z"/><path d="M12.9,-2.1 L17.1,2.1 M17.1,-2.1 L12.9,2.1 Z"/></symbol><symbol id="plus" fill="none" viewBox="-5 -5 25 25"><path d="M0,12 L0,18, M-3,15 L3,15 Z"/><path d="M5,2 L5,8 M2,5 L8,5 Z"/><path d="M10,7 L10,13 M7,10 L13,10 Z"/><path d="M15,-3 L15,3 M12,0 L18,0 Z"/></symbol></defs>';function l(t,e){for(var n in t)if(t.hasOwnProperty(n)&&t[n]!==e[n])return!0;return!1}S.plot.plugins.push({init:function(t){t.hooks.setupGrid.push(function(t){var e=t.getOptions(),n=t.getData(),i=e.legend.labelFormatter,o=e.legend.legendEntries,a=e.legend.plotOffset,r=function(t,e,n){var a=e,i=t.reduce(function(t,e,n){var i=a?a(e.label,e):e.label;if(!e.hasOwnProperty("label")||i){var o={label:i||"Plot "+(n+1),color:e.color,options:{lines:e.lines,points:e.points,bars:e.bars}};t.push(o)}return t},[]);if(n)if(S.isFunction(n))i.sort(n);else if("reverse"===n)i.reverse();else{var o="descending"!==n;i.sort(function(t,e){return t.label===e.label?0:t.label<e.label!==o?1:-1})}return i}(n,i,e.legend.sorted),s=t.getPlotOffset();(function(t,e){if(!t||!e)return!0;if(t.length!==e.length)return!0;var n,i,o;for(n=0;n<e.length;n++){if(i=e[n],o=t[n],i.label!==o.label)return!0;if(i.color!==o.color)return!0;if(l(i.options.lines,o.options.lines))return!0;if(l(i.options.points,o.options.points))return!0;if(l(i.options.bars,o.options.bars))return!0}return!1}(o,r)||l(a,s))&&function(t,e,n,i){if(null!=e.legend.container?S(e.legend.container).html(""):n.find(".legend").remove(),e.legend.show){var o,a,r,s,l=e.legend.legendEntries=i,c=e.legend.plotOffset=t.getPlotOffset(),u=[],p=0,h="",d=e.legend.position,f=e.legend.margin,m={name:"",label:"",xPos:"",yPos:""};u[p++]='<svg class="legendLayer" style="width:inherit;height:inherit;">',u[p++]='<rect class="background" width="100%" height="100%"/>',u[p++]=C;var g=0,x=[],v=window.getComputedStyle(document.querySelector("body"));for(s=0;s<l.length;++s){var b=s%e.legend.noColumns;o=l[s],m.label=o.label;var y=t.getSurface().getTextInfo("",m.label,{style:v.fontStyle,variant:v.fontVariant,weight:v.fontWeight,size:parseInt(v.fontSize),lineHeight:parseInt(v.lineHeight),family:v.fontFamily}).width;x[b]?y>x[b]&&(x[b]=y+48):x[b]=y+48}for(s=0;s<l.length;++s){var w=s%e.legend.noColumns;o=l[s],r="",m.label=o.label,m.xPos=g+3+"px",g+=x[w],(s+1)%e.legend.noColumns==0&&(g=0),m.yPos=1.5*Math.floor(s/e.legend.noColumns)+"em",o.options.lines.show&&o.options.lines.fill&&(m.name="area",m.fillColor=o.color,r+=P(m)),o.options.bars.show&&(m.name="bar",m.fillColor=o.color,r+=P(m)),o.options.lines.show&&!o.options.lines.fill&&(m.name="line",m.strokeColor=o.color,m.strokeWidth=o.options.lines.lineWidth,r+=P(m)),o.options.points.show&&(m.name=o.options.points.symbol,m.strokeColor=o.color,m.fillColor=o.options.points.fillColor,m.strokeWidth=o.options.points.lineWidth,r+=P(m)),a='<text x="'+m.xPos+'" y="'+m.yPos+'" text-anchor="start"><tspan dx="2em" dy="1.2em">'+m.label+"</tspan></text>",u[p++]="<g>"+r+a+"</g>"}u[p++]="</svg>",null==f[0]&&(f=[f,f]),"n"===d.charAt(0)?h+="top:"+(f[1]+c.top)+"px;":"s"===d.charAt(0)&&(h+="bottom:"+(f[1]+c.bottom)+"px;"),"e"===d.charAt(1)?h+="right:"+(f[0]+c.right)+"px;":"w"===d.charAt(1)&&(h+="left:"+(f[0]+c.left)+"px;");var T=6;for(s=0;s<x.length;++s)T+=x[s];var k,M=1.6*Math.ceil(l.length/e.legend.noColumns);e.legend.container?(k=S(u.join("")).appendTo(e.legend.container)[0],e.legend.container.style.width=T+"px",e.legend.container.style.height=M+"em"):((k=S('<div class="legend" style="position:absolute;'+h+'">'+u.join("")+"</div>").appendTo(n)).css("width",T+"px"),k.css("height",M+"em"),k.css("pointerEvents","none"))}}(t,e,t.getPlaceholder(),r)})},options:{legend:{show:!1,noColumns:1,labelFormatter:null,container:null,position:"ne",margin:5,sorted:null}},name:"legend",version:"1.0"})}(jQuery);
//# sourceMappingURL=jquery.flot.js.map

/* eslint-disable */
/* Flot plugin for automatically redrawing plots as the placeholder resizes.

Copyright (c) 2007-2014 IOLA and Ole Laursen.
Licensed under the MIT license.

It works by listening for changes on the placeholder div (through the jQuery
resize event plugin) - if the size changes, it will redraw the plot.

There are no options. If you need to disable the plugin for some plots, you
can just fix the size of their placeholders.

*/

/* Inline dependency:
 * jQuery resize event - v1.1 - 3/14/2010
 * http://benalman.com/projects/jquery-resize-plugin/
 *
 * Copyright (c) 2010 "Cowboy" Ben Alman
 * Dual licensed under the MIT and GPL licenses.
 * http://benalman.com/about/license/
 */
(function($,e,t){"$:nomunge";var i=[],n=$.resize=$.extend($.resize,{}),a,r=false,s="setTimeout",u="resize",m=u+"-special-event",o="pendingDelay",l="activeDelay",f="throttleWindow";n[o]=200;n[l]=20;n[f]=true;$.event.special[u]={setup:function(){if(!n[f]&&this[s]){return false}var e=$(this);i.push(this);e.data(m,{w:e.width(),h:e.height()});if(i.length===1){a=t;h()}},teardown:function(){if(!n[f]&&this[s]){return false}var e=$(this);for(var t=i.length-1;t>=0;t--){if(i[t]==this){i.splice(t,1);break}}e.removeData(m);if(!i.length){if(r){cancelAnimationFrame(a)}else{clearTimeout(a)}a=null}},add:function(e){if(!n[f]&&this[s]){return false}var i;function a(e,n,a){var r=$(this),s=r.data(m)||{};s.w=n!==t?n:r.width();s.h=a!==t?a:r.height();i.apply(this,arguments)}if($.isFunction(e)){i=e;return a}else{i=e.handler;e.handler=a}}};function h(t){if(r===true){r=t||1}for(var s=i.length-1;s>=0;s--){var l=$(i[s]);if(l[0]==e||l.is(":visible")){var f=l.width(),c=l.height(),d=l.data(m);if(d&&(f!==d.w||c!==d.h)){l.trigger(u,[d.w=f,d.h=c]);r=t||true}}else{d=l.data(m);d.w=0;d.h=0}}if(a!==null){if(r&&(t==null||t-r<1e3)){a=e.requestAnimationFrame(h)}else{a=setTimeout(h,n[o]);r=false}}}if(!e.requestAnimationFrame){e.requestAnimationFrame=function(){return e.webkitRequestAnimationFrame||e.mozRequestAnimationFrame||e.oRequestAnimationFrame||e.msRequestAnimationFrame||function(t,i){return e.setTimeout(function(){t((new Date).getTime())},n[l])}}()}if(!e.cancelAnimationFrame){e.cancelAnimationFrame=function(){return e.webkitCancelRequestAnimationFrame||e.mozCancelRequestAnimationFrame||e.oCancelRequestAnimationFrame||e.msCancelRequestAnimationFrame||clearTimeout}()}})(jQuery,window);

/* eslint-enable */
(function ($) {
    var options = { }; // no options

    function init(plot) {
        function onResize() {
            var placeholder = plot.getPlaceholder();

            // somebody might have hidden us and we can't plot
            // when we don't have the dimensions
            if (placeholder.width() === 0 || placeholder.height() === 0) return;

            plot.resize();
            plot.setupGrid();
            plot.draw();
        }

        function bindEvents(plot, eventHolder) {
            plot.getPlaceholder().resize(onResize);
        }

        function shutdown(plot, eventHolder) {
            plot.getPlaceholder().unbind("resize", onResize);
        }

        plot.hooks.bindEvents.push(bindEvents);
        plot.hooks.shutdown.push(shutdown);
    }

    $.plot.plugins.push({
        init: init,
        options: options,
        name: 'resize',
        version: '1.0'
    });
})(jQuery);

/* Flot plugin for plotting textual data or categories.

Copyright (c) 2007-2014 IOLA and Ole Laursen.
Licensed under the MIT license.

Consider a dataset like [["February", 34], ["March", 20], ...]. This plugin
allows you to plot such a dataset directly.

To enable it, you must specify mode: "categories" on the axis with the textual
labels, e.g.

    $.plot("#placeholder", data, { xaxis: { mode: "categories" } });

By default, the labels are ordered as they are met in the data series. If you
need a different ordering, you can specify "categories" on the axis options
and list the categories there:

    xaxis: {
        mode: "categories",
        categories: ["February", "March", "April"]
    }

If you need to customize the distances between the categories, you can specify
"categories" as an object mapping labels to values

    xaxis: {
        mode: "categories",
        categories: { "February": 1, "March": 3, "April": 4 }
    }

If you don't specify all categories, the remaining categories will be numbered
from the max value plus 1 (with a spacing of 1 between each).

Internally, the plugin works by transforming the input data through an auto-
generated mapping where the first category becomes 0, the second 1, etc.
Hence, a point like ["February", 34] becomes [0, 34] internally in Flot (this
is visible in hover and click events that return numbers rather than the
category labels). The plugin also overrides the tick generator to spit out the
categories as ticks instead of the values.

If you need to map a value back to its label, the mapping is always accessible
as "categories" on the axis object, e.g. plot.getAxes().xaxis.categories.

*/

(function ($) {
    var options = {
        xaxis: {
            categories: null
        },
        yaxis: {
            categories: null
        }
    };

    function processRawData(plot, series, data, datapoints) {
        // if categories are enabled, we need to disable
        // auto-transformation to numbers so the strings are intact
        // for later processing

        var xCategories = series.xaxis.options.mode === "categories",
            yCategories = series.yaxis.options.mode === "categories";

        if (!(xCategories || yCategories)) {
            return;
        }

        var format = datapoints.format;

        if (!format) {
            // FIXME: auto-detection should really not be defined here
            var s = series;
            format = [];
            format.push({ x: true, number: true, required: true, computeRange: true});
            format.push({ y: true, number: true, required: true, computeRange: true });

            if (s.bars.show || (s.lines.show && s.lines.fill)) {
                var autoScale = !!((s.bars.show && s.bars.zero) || (s.lines.show && s.lines.zero));
                format.push({ y: true, number: true, required: false, defaultValue: 0, computeRange: autoScale });
                if (s.bars.horizontal) {
                    delete format[format.length - 1].y;
                    format[format.length - 1].x = true;
                }
            }

            datapoints.format = format;
        }

        for (var m = 0; m < format.length; ++m) {
            if (format[m].x && xCategories) {
                format[m].number = false;
            }

            if (format[m].y && yCategories) {
                format[m].number = false;
                format[m].computeRange = false;
            }
        }
    }

    function getNextIndex(categories) {
        var index = -1;

        for (var v in categories) {
            if (categories[v] > index) {
                index = categories[v];
            }
        }

        return index + 1;
    }

    function categoriesTickGenerator(axis) {
        var res = [];
        for (var label in axis.categories) {
            var v = axis.categories[label];
            if (v >= axis.min && v <= axis.max) {
                res.push([v, label]);
            }
        }

        res.sort(function (a, b) { return a[0] - b[0]; });

        return res;
    }

    function setupCategoriesForAxis(series, axis, datapoints) {
        if (series[axis].options.mode !== "categories") {
            return;
        }

        if (!series[axis].categories) {
            // parse options
            var c = {}, o = series[axis].options.categories || {};
            if ($.isArray(o)) {
                for (var i = 0; i < o.length; ++i) {
                    c[o[i]] = i;
                }
            } else {
                for (var v in o) {
                    c[v] = o[v];
                }
            }

            series[axis].categories = c;
        }

        // fix ticks
        if (!series[axis].options.ticks) {
            series[axis].options.ticks = categoriesTickGenerator;
        }

        transformPointsOnAxis(datapoints, axis, series[axis].categories);
    }

    function transformPointsOnAxis(datapoints, axis, categories) {
        // go through the points, transforming them
        var points = datapoints.points,
            ps = datapoints.pointsize,
            format = datapoints.format,
            formatColumn = axis.charAt(0),
            index = getNextIndex(categories);

        for (var i = 0; i < points.length; i += ps) {
            if (points[i] == null) {
                continue;
            }

            for (var m = 0; m < ps; ++m) {
                var val = points[i + m];

                if (val == null || !format[m][formatColumn]) {
                    continue;
                }

                if (!(val in categories)) {
                    categories[val] = index;
                    ++index;
                }

                points[i + m] = categories[val];
            }
        }
    }

    function processDatapoints(plot, series, datapoints) {
        setupCategoriesForAxis(series, "xaxis", datapoints);
        setupCategoriesForAxis(series, "yaxis", datapoints);
    }

    function init(plot) {
        plot.hooks.processRawData.push(processRawData);
        plot.hooks.processDatapoints.push(processDatapoints);
    }

    $.plot.plugins.push({
        init: init,
        options: options,
        name: 'categories',
        version: '1.0'
    });
})(jQuery);

/* Flot plugin for rendering pie charts.

Copyright (c) 2007-2014 IOLA and Ole Laursen.
Licensed under the MIT license.

The plugin assumes that each series has a single data value, and that each
value is a positive integer or zero.  Negative numbers don't make sense for a
pie chart, and have unpredictable results.  The values do NOT need to be
passed in as percentages; the plugin will calculate the total and per-slice
percentages internally.

* Created by Brian Medendorp

* Updated with contributions from btburnett3, Anthony Aragues and Xavi Ivars

The plugin supports these options:

    series: {
        pie: {
            show: true/false
            radius: 0-1 for percentage of fullsize, or a specified pixel length, or 'auto'
            innerRadius: 0-1 for percentage of fullsize or a specified pixel length, for creating a donut effect
            startAngle: 0-2 factor of PI used for starting angle (in radians) i.e 3/2 starts at the top, 0 and 2 have the same result
            tilt: 0-1 for percentage to tilt the pie, where 1 is no tilt, and 0 is completely flat (nothing will show)
            offset: {
                top: integer value to move the pie up or down
                left: integer value to move the pie left or right, or 'auto'
            },
            stroke: {
                color: any hexidecimal color value (other formats may or may not work, so best to stick with something like '#FFF')
                width: integer pixel width of the stroke
            },
            label: {
                show: true/false, or 'auto'
                formatter:  a user-defined function that modifies the text/style of the label text
                radius: 0-1 for percentage of fullsize, or a specified pixel length
                background: {
                    color: any hexidecimal color value (other formats may or may not work, so best to stick with something like '#000')
                    opacity: 0-1
                },
                threshold: 0-1 for the percentage value at which to hide labels (if they're too small)
            },
            combine: {
                threshold: 0-1 for the percentage value at which to combine slices (if they're too small)
                color: any hexidecimal color value (other formats may or may not work, so best to stick with something like '#CCC'), if null, the plugin will automatically use the color of the first slice to be combined
                label: any text value of what the combined slice should be labeled
            }
            highlight: {
                opacity: 0-1
            }
        }
    }

More detail and specific examples can be found in the included HTML file.

*/

(function($) {
    // Maximum redraw attempts when fitting labels within the plot

    var REDRAW_ATTEMPTS = 10;

    // Factor by which to shrink the pie when fitting labels within the plot

    var REDRAW_SHRINK = 0.95;

    function init(plot) {
        var canvas = null,
            target = null,
            options = null,
            maxRadius = null,
            centerLeft = null,
            centerTop = null,
            processed = false,
            ctx = null;

        // interactive variables

        var highlights = [];

        // add hook to determine if pie plugin in enabled, and then perform necessary operations

        plot.hooks.processOptions.push(function(plot, options) {
            if (options.series.pie.show) {
                options.grid.show = false;

                // set labels.show

                if (options.series.pie.label.show === "auto") {
                    if (options.legend.show) {
                        options.series.pie.label.show = false;
                    } else {
                        options.series.pie.label.show = true;
                    }
                }

                // set radius

                if (options.series.pie.radius === "auto") {
                    if (options.series.pie.label.show) {
                        options.series.pie.radius = 3 / 4;
                    } else {
                        options.series.pie.radius = 1;
                    }
                }

                // ensure sane tilt

                if (options.series.pie.tilt > 1) {
                    options.series.pie.tilt = 1;
                } else if (options.series.pie.tilt < 0) {
                    options.series.pie.tilt = 0;
                }
            }
        });

        plot.hooks.bindEvents.push(function(plot, eventHolder) {
            var options = plot.getOptions();
            if (options.series.pie.show) {
                if (options.grid.hoverable) {
                    eventHolder.unbind("mousemove").mousemove(onMouseMove);
                    eventHolder.bind("mouseleave", onMouseMove);
                }
                if (options.grid.clickable) {
                    eventHolder.unbind("click").click(onClick);
                }
            }
        });

        plot.hooks.shutdown.push(function (plot, eventHolder) {
            eventHolder.unbind("mousemove", onMouseMove);
            eventHolder.unbind("mouseleave", onMouseMove);
            eventHolder.unbind("click", onClick);
            highlights = [];
        });

        plot.hooks.processDatapoints.push(function(plot, series, data, datapoints) {
            var options = plot.getOptions();
            if (options.series.pie.show) {
                processDatapoints(plot, series, data, datapoints);
            }
        });

        plot.hooks.drawOverlay.push(function(plot, octx) {
            var options = plot.getOptions();
            if (options.series.pie.show) {
                drawOverlay(plot, octx);
            }
        });

        plot.hooks.draw.push(function(plot, newCtx) {
            var options = plot.getOptions();
            if (options.series.pie.show) {
                draw(plot, newCtx);
            }
        });

        function processDatapoints(plot, series, datapoints) {
            if (!processed) {
                processed = true;
                canvas = plot.getCanvas();
                target = $(canvas).parent();
                options = plot.getOptions();
                plot.setData(combine(plot.getData()));
            }
        }

        function combine(data) {
            var total = 0,
                combined = 0,
                numCombined = 0,
                color = options.series.pie.combine.color,
                newdata = [],
                i,
                value;

            // Fix up the raw data from Flot, ensuring the data is numeric

            for (i = 0; i < data.length; ++i) {
                value = data[i].data;

                // If the data is an array, we'll assume that it's a standard
                // Flot x-y pair, and are concerned only with the second value.

                // Note how we use the original array, rather than creating a
                // new one; this is more efficient and preserves any extra data
                // that the user may have stored in higher indexes.

                if ($.isArray(value) && value.length === 1) {
                    value = value[0];
                }

                if ($.isArray(value)) {
                    // Equivalent to $.isNumeric() but compatible with jQuery < 1.7
                    if (!isNaN(parseFloat(value[1])) && isFinite(value[1])) {
                        value[1] = +value[1];
                    } else {
                        value[1] = 0;
                    }
                } else if (!isNaN(parseFloat(value)) && isFinite(value)) {
                    value = [1, +value];
                } else {
                    value = [1, 0];
                }

                data[i].data = [value];
            }

            // Sum up all the slices, so we can calculate percentages for each

            for (i = 0; i < data.length; ++i) {
                total += data[i].data[0][1];
            }

            // Count the number of slices with percentages below the combine
            // threshold; if it turns out to be just one, we won't combine.

            for (i = 0; i < data.length; ++i) {
                value = data[i].data[0][1];
                if (value / total <= options.series.pie.combine.threshold) {
                    combined += value;
                    numCombined++;
                    if (!color) {
                        color = data[i].color;
                    }
                }
            }

            for (i = 0; i < data.length; ++i) {
                value = data[i].data[0][1];
                if (numCombined < 2 || value / total > options.series.pie.combine.threshold) {
                    newdata.push(
                        $.extend(data[i], {     /* extend to allow keeping all other original data values
                                                   and using them e.g. in labelFormatter. */
                            data: [[1, value]],
                            color: data[i].color,
                            label: data[i].label,
                            angle: value * Math.PI * 2 / total,
                            percent: value / (total / 100)
                        })
                    );
                }
            }

            if (numCombined > 1) {
                newdata.push({
                    data: [[1, combined]],
                    color: color,
                    label: options.series.pie.combine.label,
                    angle: combined * Math.PI * 2 / total,
                    percent: combined / (total / 100)
                });
            }

            return newdata;
        }

        function draw(plot, newCtx) {
            if (!target) {
                return; // if no series were passed
            }

            var canvasWidth = plot.getPlaceholder().width(),
                canvasHeight = plot.getPlaceholder().height(),
                legendWidth = target.children().filter(".legend").children().width() || 0;

            ctx = newCtx;

            // WARNING: HACK! REWRITE THIS CODE AS SOON AS POSSIBLE!

            // When combining smaller slices into an 'other' slice, we need to
            // add a new series.  Since Flot gives plugins no way to modify the
            // list of series, the pie plugin uses a hack where the first call
            // to processDatapoints results in a call to setData with the new
            // list of series, then subsequent processDatapoints do nothing.

            // The plugin-global 'processed' flag is used to control this hack;
            // it starts out false, and is set to true after the first call to
            // processDatapoints.

            // Unfortunately this turns future setData calls into no-ops; they
            // call processDatapoints, the flag is true, and nothing happens.

            // To fix this we'll set the flag back to false here in draw, when
            // all series have been processed, so the next sequence of calls to
            // processDatapoints once again starts out with a slice-combine.
            // This is really a hack; in 0.9 we need to give plugins a proper
            // way to modify series before any processing begins.

            processed = false;

            // calculate maximum radius and center point
            maxRadius = Math.min(canvasWidth, canvasHeight / options.series.pie.tilt) / 2;
            centerTop = canvasHeight / 2 + options.series.pie.offset.top;
            centerLeft = canvasWidth / 2;

            if (options.series.pie.offset.left === "auto") {
                if (options.legend.position.match("w")) {
                    centerLeft += legendWidth / 2;
                } else {
                    centerLeft -= legendWidth / 2;
                }
                if (centerLeft < maxRadius) {
                    centerLeft = maxRadius;
                } else if (centerLeft > canvasWidth - maxRadius) {
                    centerLeft = canvasWidth - maxRadius;
                }
            } else {
                centerLeft += options.series.pie.offset.left;
            }

            var slices = plot.getData(),
                attempts = 0;

            // Keep shrinking the pie's radius until drawPie returns true,
            // indicating that all the labels fit, or we try too many times.
            do {
                if (attempts > 0) {
                    maxRadius *= REDRAW_SHRINK;
                }
                attempts += 1;
                clear();
                if (options.series.pie.tilt <= 0.8) {
                    drawShadow();
                }
            } while (!drawPie() && attempts < REDRAW_ATTEMPTS)

            if (attempts >= REDRAW_ATTEMPTS) {
                clear();
                target.prepend("<div class='errors'>Could not draw pie with labels contained inside canvas</div>");
            }

            if (plot.setSeries && plot.insertLegend) {
                plot.setSeries(slices);
                plot.insertLegend();
            }

            // we're actually done at this point, just defining internal functions at this point
            function clear() {
                ctx.clearRect(0, 0, canvasWidth, canvasHeight);
                target.children().filter(".pieLabel, .pieLabelBackground").remove();
            }

            function drawShadow() {
                var shadowLeft = options.series.pie.shadow.left;
                var shadowTop = options.series.pie.shadow.top;
                var edge = 10;
                var alpha = options.series.pie.shadow.alpha;
                var radius = options.series.pie.radius > 1 ? options.series.pie.radius : maxRadius * options.series.pie.radius;

                if (radius >= canvasWidth / 2 - shadowLeft || radius * options.series.pie.tilt >= canvasHeight / 2 - shadowTop || radius <= edge) {
                    return;    // shadow would be outside canvas, so don't draw it
                }

                ctx.save();
                ctx.translate(shadowLeft, shadowTop);
                ctx.globalAlpha = alpha;
                ctx.fillStyle = "#000";

                // center and rotate to starting position
                ctx.translate(centerLeft, centerTop);
                ctx.scale(1, options.series.pie.tilt);

                //radius -= edge;
                for (var i = 1; i <= edge; i++) {
                    ctx.beginPath();
                    ctx.arc(0, 0, radius, 0, Math.PI * 2, false);
                    ctx.fill();
                    radius -= i;
                }

                ctx.restore();
            }

            function drawPie() {
                var startAngle = Math.PI * options.series.pie.startAngle;
                var radius = options.series.pie.radius > 1 ? options.series.pie.radius : maxRadius * options.series.pie.radius;
                var i;
                // center and rotate to starting position

                ctx.save();
                ctx.translate(centerLeft, centerTop);
                ctx.scale(1, options.series.pie.tilt);
                //ctx.rotate(startAngle); // start at top; -- This doesn't work properly in Opera

                // draw slices
                ctx.save();

                var currentAngle = startAngle;
                for (i = 0; i < slices.length; ++i) {
                    slices[i].startAngle = currentAngle;
                    drawSlice(slices[i].angle, slices[i].color, true);
                }

                ctx.restore();

                // draw slice outlines
                if (options.series.pie.stroke.width > 0) {
                    ctx.save();
                    ctx.lineWidth = options.series.pie.stroke.width;
                    currentAngle = startAngle;
                    for (i = 0; i < slices.length; ++i) {
                        drawSlice(slices[i].angle, options.series.pie.stroke.color, false);
                    }

                    ctx.restore();
                }

                // draw donut hole
                drawDonutHole(ctx);

                ctx.restore();

                // Draw the labels, returning true if they fit within the plot
                if (options.series.pie.label.show) {
                    return drawLabels();
                } else return true;

                function drawSlice(angle, color, fill) {
                    if (angle <= 0 || isNaN(angle)) {
                        return;
                    }

                    if (fill) {
                        ctx.fillStyle = color;
                    } else {
                        ctx.strokeStyle = color;
                        ctx.lineJoin = "round";
                    }

                    ctx.beginPath();
                    if (Math.abs(angle - Math.PI * 2) > 0.000000001) {
                        ctx.moveTo(0, 0); // Center of the pie
                    }

                    //ctx.arc(0, 0, radius, 0, angle, false); // This doesn't work properly in Opera
                    ctx.arc(0, 0, radius, currentAngle, currentAngle + angle / 2, false);
                    ctx.arc(0, 0, radius, currentAngle + angle / 2, currentAngle + angle, false);
                    ctx.closePath();
                    //ctx.rotate(angle); // This doesn't work properly in Opera
                    currentAngle += angle;

                    if (fill) {
                        ctx.fill();
                    } else {
                        ctx.stroke();
                    }
                }

                function drawLabels() {
                    var currentAngle = startAngle;
                    var radius = options.series.pie.label.radius > 1 ? options.series.pie.label.radius : maxRadius * options.series.pie.label.radius;

                    for (var i = 0; i < slices.length; ++i) {
                        if (slices[i].percent >= options.series.pie.label.threshold * 100) {
                            if (!drawLabel(slices[i], currentAngle, i)) {
                                return false;
                            }
                        }
                        currentAngle += slices[i].angle;
                    }

                    return true;

                    function drawLabel(slice, startAngle, index) {
                        if (slice.data[0][1] === 0) {
                            return true;
                        }

                        // format label text
                        var lf = options.legend.labelFormatter, text, plf = options.series.pie.label.formatter;

                        if (lf) {
                            text = lf(slice.label, slice);
                        } else {
                            text = slice.label;
                        }

                        if (plf) {
                            text = plf(text, slice);
                        }

                        var halfAngle = ((startAngle + slice.angle) + startAngle) / 2;
                        var x = centerLeft + Math.round(Math.cos(halfAngle) * radius);
                        var y = centerTop + Math.round(Math.sin(halfAngle) * radius) * options.series.pie.tilt;

                        var html = "<span class='pieLabel' id='pieLabel" + index + "' style='position:absolute;top:" + y + "px;left:" + x + "px;'>" + text + "</span>";
                        target.append(html);

                        var label = target.children("#pieLabel" + index);
                        var labelTop = (y - label.height() / 2);
                        var labelLeft = (x - label.width() / 2);

                        label.css("top", labelTop);
                        label.css("left", labelLeft);

                        // check to make sure that the label is not outside the canvas
                        if (0 - labelTop > 0 || 0 - labelLeft > 0 || canvasHeight - (labelTop + label.height()) < 0 || canvasWidth - (labelLeft + label.width()) < 0) {
                            return false;
                        }

                        if (options.series.pie.label.background.opacity !== 0) {
                            // put in the transparent background separately to avoid blended labels and label boxes
                            var c = options.series.pie.label.background.color;
                            if (c == null) {
                                c = slice.color;
                            }

                            var pos = "top:" + labelTop + "px;left:" + labelLeft + "px;";
                            $("<div class='pieLabelBackground' style='position:absolute;width:" + label.width() + "px;height:" + label.height() + "px;" + pos + "background-color:" + c + ";'></div>")
                                .css("opacity", options.series.pie.label.background.opacity)
                                .insertBefore(label);
                        }

                        return true;
                    } // end individual label function
                } // end drawLabels function
            } // end drawPie function
        } // end draw function

        // Placed here because it needs to be accessed from multiple locations

        function drawDonutHole(layer) {
            if (options.series.pie.innerRadius > 0) {
                // subtract the center
                layer.save();
                var innerRadius = options.series.pie.innerRadius > 1 ? options.series.pie.innerRadius : maxRadius * options.series.pie.innerRadius;
                layer.globalCompositeOperation = "destination-out"; // this does not work with excanvas, but it will fall back to using the stroke color
                layer.beginPath();
                layer.fillStyle = options.series.pie.stroke.color;
                layer.arc(0, 0, innerRadius, 0, Math.PI * 2, false);
                layer.fill();
                layer.closePath();
                layer.restore();

                // add inner stroke
                layer.save();
                layer.beginPath();
                layer.strokeStyle = options.series.pie.stroke.color;
                layer.arc(0, 0, innerRadius, 0, Math.PI * 2, false);
                layer.stroke();
                layer.closePath();
                layer.restore();

                // TODO: add extra shadow inside hole (with a mask) if the pie is tilted.
            }
        }

        //-- Additional Interactive related functions --

        function isPointInPoly(poly, pt) {
            for (var c = false, i = -1, l = poly.length, j = l - 1; ++i < l; j = i) {
                ((poly[i][1] <= pt[1] && pt[1] < poly[j][1]) ||
                (poly[j][1] <= pt[1] && pt[1] < poly[i][1])) &&
                (pt[0] < (poly[j][0] - poly[i][0]) * (pt[1] - poly[i][1]) / (poly[j][1] - poly[i][1]) + poly[i][0]) &&
                (c = !c);
            }
            return c;
        }

        function findNearbySlice(mouseX, mouseY) {
            var slices = plot.getData(),
                options = plot.getOptions(),
                radius = options.series.pie.radius > 1 ? options.series.pie.radius : maxRadius * options.series.pie.radius,
                x, y;

            for (var i = 0; i < slices.length; ++i) {
                var s = slices[i];
                if (s.pie.show) {
                    ctx.save();
                    ctx.beginPath();
                    ctx.moveTo(0, 0); // Center of the pie
                    //ctx.scale(1, options.series.pie.tilt);    // this actually seems to break everything when here.
                    ctx.arc(0, 0, radius, s.startAngle, s.startAngle + s.angle / 2, false);
                    ctx.arc(0, 0, radius, s.startAngle + s.angle / 2, s.startAngle + s.angle, false);
                    ctx.closePath();
                    x = mouseX - centerLeft;
                    y = mouseY - centerTop;

                    if (ctx.isPointInPath) {
                        if (ctx.isPointInPath(mouseX - centerLeft, mouseY - centerTop)) {
                            ctx.restore();
                            return {
                                datapoint: [s.percent, s.data],
                                dataIndex: 0,
                                series: s,
                                seriesIndex: i
                            };
                        }
                    } else {
                        // excanvas for IE doesn;t support isPointInPath, this is a workaround.
                        var p1X = radius * Math.cos(s.startAngle),
                            p1Y = radius * Math.sin(s.startAngle),
                            p2X = radius * Math.cos(s.startAngle + s.angle / 4),
                            p2Y = radius * Math.sin(s.startAngle + s.angle / 4),
                            p3X = radius * Math.cos(s.startAngle + s.angle / 2),
                            p3Y = radius * Math.sin(s.startAngle + s.angle / 2),
                            p4X = radius * Math.cos(s.startAngle + s.angle / 1.5),
                            p4Y = radius * Math.sin(s.startAngle + s.angle / 1.5),
                            p5X = radius * Math.cos(s.startAngle + s.angle),
                            p5Y = radius * Math.sin(s.startAngle + s.angle),
                            arrPoly = [[0, 0], [p1X, p1Y], [p2X, p2Y], [p3X, p3Y], [p4X, p4Y], [p5X, p5Y]],
                            arrPoint = [x, y];

                        // TODO: perhaps do some mathmatical trickery here with the Y-coordinate to compensate for pie tilt?

                        if (isPointInPoly(arrPoly, arrPoint)) {
                            ctx.restore();
                            return {
                                datapoint: [s.percent, s.data],
                                dataIndex: 0,
                                series: s,
                                seriesIndex: i
                            };
                        }
                    }

                    ctx.restore();
                }
            }

            return null;
        }

        function onMouseMove(e) {
            triggerClickHoverEvent("plothover", e);
        }

        function onClick(e) {
            triggerClickHoverEvent("plotclick", e);
        }

        // trigger click or hover event (they send the same parameters so we share their code)

        function triggerClickHoverEvent(eventname, e) {
            var offset = plot.offset();
            var canvasX = parseInt(e.pageX - offset.left);
            var canvasY = parseInt(e.pageY - offset.top);
            var item = findNearbySlice(canvasX, canvasY);

            if (options.grid.autoHighlight) {
                // clear auto-highlights
                for (var i = 0; i < highlights.length; ++i) {
                    var h = highlights[i];
                    if (h.auto === eventname && !(item && h.series === item.series)) {
                        unhighlight(h.series);
                    }
                }
            }

            // highlight the slice

            if (item) {
                highlight(item.series, eventname);
            }

            // trigger any hover bind events

            var pos = { pageX: e.pageX, pageY: e.pageY };
            target.trigger(eventname, [pos, item]);
        }

        function highlight(s, auto) {
            //if (typeof s == "number") {
            //    s = series[s];
            //}

            var i = indexOfHighlight(s);

            if (i === -1) {
                highlights.push({ series: s, auto: auto });
                plot.triggerRedrawOverlay();
            } else if (!auto) {
                highlights[i].auto = false;
            }
        }

        function unhighlight(s) {
            if (s == null) {
                highlights = [];
                plot.triggerRedrawOverlay();
            }

            //if (typeof s == "number") {
            //    s = series[s];
            //}

            var i = indexOfHighlight(s);

            if (i !== -1) {
                highlights.splice(i, 1);
                plot.triggerRedrawOverlay();
            }
        }

        function indexOfHighlight(s) {
            for (var i = 0; i < highlights.length; ++i) {
                var h = highlights[i];
                if (h.series === s) {
                    return i;
                }
            }
            return -1;
        }

        function drawOverlay(plot, octx) {
            var options = plot.getOptions();
            var radius = options.series.pie.radius > 1 ? options.series.pie.radius : maxRadius * options.series.pie.radius;

            octx.save();
            octx.translate(centerLeft, centerTop);
            octx.scale(1, options.series.pie.tilt);

            for (var i = 0; i < highlights.length; ++i) {
                drawHighlight(highlights[i].series);
            }

            drawDonutHole(octx);

            octx.restore();

            function drawHighlight(series) {
                if (series.angle <= 0 || isNaN(series.angle)) {
                    return;
                }

                //octx.fillStyle = parseColor(options.series.pie.highlight.color).scale(null, null, null, options.series.pie.highlight.opacity).toString();
                octx.fillStyle = "rgba(255, 255, 255, " + options.series.pie.highlight.opacity + ")"; // this is temporary until we have access to parseColor
                octx.beginPath();
                if (Math.abs(series.angle - Math.PI * 2) > 0.000000001) {
                    octx.moveTo(0, 0); // Center of the pie
                }
                octx.arc(0, 0, radius, series.startAngle, series.startAngle + series.angle / 2, false);
                octx.arc(0, 0, radius, series.startAngle + series.angle / 2, series.startAngle + series.angle, false);
                octx.closePath();
                octx.fill();
            }
        }
    } // end init (plugin body)

    // define pie specific options and their default values
    var options = {
        series: {
            pie: {
                show: false,
                radius: "auto",    // actual radius of the visible pie (based on full calculated radius if <=1, or hard pixel value)
                innerRadius: 0, /* for donut */
                startAngle: 3 / 2,
                tilt: 1,
                shadow: {
                    left: 5,    // shadow left offset
                    top: 15,    // shadow top offset
                    alpha: 0.02    // shadow alpha
                },
                offset: {
                    top: 0,
                    left: "auto"
                },
                stroke: {
                    color: "#fff",
                    width: 1
                },
                label: {
                    show: "auto",
                    formatter: function(label, slice) {
                        return "<div style='font-size:x-small;text-align:center;padding:2px;color:" + slice.color + ";'>" + label + "<br/>" + Math.round(slice.percent) + "%</div>";
                    },    // formatter function
                    radius: 1,    // radius at which to place the labels (based on full calculated radius if <=1, or hard pixel value)
                    background: {
                        color: null,
                        opacity: 0
                    },
                    threshold: 0    // percentage at which to hide the label (i.e. the slice is too narrow)
                },
                combine: {
                    threshold: -1,    // percentage at which to combine little slices into one larger slice
                    color: null,    // color to give the new slice (auto-generated if null)
                    label: "Other"    // label to give the new slice
                },
                highlight: {
                    //color: "#fff",        // will add this functionality once parseColor is available
                    opacity: 0.5
                }
            }
        }
    };

    $.plot.plugins.push({
        init: init,
        options: options,
        name: "pie",
        version: "1.1"
    });
})(jQuery);

/* Flot plugin for stacking data sets rather than overlaying them.

Copyright (c) 2007-2014 IOLA and Ole Laursen.
Licensed under the MIT license.

The plugin assumes the data is sorted on x (or y if stacking horizontally).
For line charts, it is assumed that if a line has an undefined gap (from a
null point), then the line above it should have the same gap - insert zeros
instead of "null" if you want another behaviour. This also holds for the start
and end of the chart. Note that stacking a mix of positive and negative values
in most instances doesn't make sense (so it looks weird).

Two or more series are stacked when their "stack" attribute is set to the same
key (which can be any number or string or just "true"). To specify the default
stack, you can set the stack option like this:

    series: {
        stack: null/false, true, or a key (number/string)
    }

You can also specify it for a single series, like this:

    $.plot( $("#placeholder"), [{
        data: [ ... ],
        stack: true
    }])

The stacking order is determined by the order of the data series in the array
(later series end up on top of the previous).

Internally, the plugin modifies the datapoints in each series, adding an
offset to the y value. For line series, extra data points are inserted through
interpolation. If there's a second y value, it's also adjusted (e.g for bar
charts or filled areas).

*/

(function ($) {
    var options = {
        series: { stack: null } // or number/string
    };

    function init(plot) {
        function findMatchingSeries(s, allseries) {
            var res = null;
            for (var i = 0; i < allseries.length; ++i) {
                if (s === allseries[i]) break;

                if (allseries[i].stack === s.stack) {
                    res = allseries[i];
                }
            }

            return res;
        }

        function addBottomPoints (s, datapoints) {
            var formattedPoints = [];
            for (var i = 0; i < datapoints.points.length; i += 2) {
                formattedPoints.push(datapoints.points[i]);
                formattedPoints.push(datapoints.points[i + 1]);
                formattedPoints.push(0);
            }

            datapoints.format.push({
                x: s.bars.horizontal,
                y: !s.bars.horizontal,
                number: true,
                required: false,
                computeRange: s.yaxis.options.autoScale !== 'none',
                defaultValue: 0
            });
            datapoints.points = formattedPoints;
            datapoints.pointsize = 3;
        }

        function stackData(plot, s, datapoints) {
            if (s.stack == null || s.stack === false) return;

            var needsBottom = s.bars.show || (s.lines.show && s.lines.fill);
            var hasBottom = datapoints.pointsize > 2 && (s.bars.horizontal ? datapoints.format[2].x : datapoints.format[2].y);
            // Series data is missing bottom points - need to format
            if (needsBottom && !hasBottom) {
                addBottomPoints(s, datapoints);
            }

            var other = findMatchingSeries(s, plot.getData());
            if (!other) return;

            var ps = datapoints.pointsize,
                points = datapoints.points,
                otherps = other.datapoints.pointsize,
                otherpoints = other.datapoints.points,
                newpoints = [],
                px, py, intery, qx, qy, bottom,
                withlines = s.lines.show,
                horizontal = s.bars.horizontal,
                withsteps = withlines && s.lines.steps,
                fromgap = true,
                keyOffset = horizontal ? 1 : 0,
                accumulateOffset = horizontal ? 0 : 1,
                i = 0, j = 0, l, m;

            while (true) {
                if (i >= points.length) break;

                l = newpoints.length;

                if (points[i] == null) {
                    // copy gaps
                    for (m = 0; m < ps; ++m) {
                        newpoints.push(points[i + m]);
                    }

                    i += ps;
                } else if (j >= otherpoints.length) {
                    // for lines, we can't use the rest of the points
                    if (!withlines) {
                        for (m = 0; m < ps; ++m) {
                            newpoints.push(points[i + m]);
                        }
                    }

                    i += ps;
                } else if (otherpoints[j] == null) {
                    // oops, got a gap
                    for (m = 0; m < ps; ++m) {
                        newpoints.push(null);
                    }

                    fromgap = true;
                    j += otherps;
                } else {
                    // cases where we actually got two points
                    px = points[i + keyOffset];
                    py = points[i + accumulateOffset];
                    qx = otherpoints[j + keyOffset];
                    qy = otherpoints[j + accumulateOffset];
                    bottom = 0;

                    if (px === qx) {
                        for (m = 0; m < ps; ++m) {
                            newpoints.push(points[i + m]);
                        }

                        newpoints[l + accumulateOffset] += qy;
                        bottom = qy;

                        i += ps;
                        j += otherps;
                    } else if (px > qx) {
                        // we got past point below, might need to
                        // insert interpolated extra point
                        if (withlines && i > 0 && points[i - ps] != null) {
                            intery = py + (points[i - ps + accumulateOffset] - py) * (qx - px) / (points[i - ps + keyOffset] - px);
                            newpoints.push(qx);
                            newpoints.push(intery + qy);
                            for (m = 2; m < ps; ++m) {
                                newpoints.push(points[i + m]);
                            }

                            bottom = qy;
                        }

                        j += otherps;
                    } else { // px < qx
                        if (fromgap && withlines) {
                            // if we come from a gap, we just skip this point
                            i += ps;
                            continue;
                        }

                        for (m = 0; m < ps; ++m) {
                            newpoints.push(points[i + m]);
                        }

                        // we might be able to interpolate a point below,
                        // this can give us a better y
                        if (withlines && j > 0 && otherpoints[j - otherps] != null) {
                            bottom = qy + (otherpoints[j - otherps + accumulateOffset] - qy) * (px - qx) / (otherpoints[j - otherps + keyOffset] - qx);
                        }

                        newpoints[l + accumulateOffset] += bottom;

                        i += ps;
                    }

                    fromgap = false;

                    if (l !== newpoints.length && needsBottom) {
                        newpoints[l + 2] += bottom;
                    }
                }

                // maintain the line steps invariant
                if (withsteps && l !== newpoints.length && l > 0 &&
                    newpoints[l] !== null &&
                    newpoints[l] !== newpoints[l - ps] &&
                    newpoints[l + 1] !== newpoints[l - ps + 1]) {
                    for (m = 0; m < ps; ++m) {
                        newpoints[l + ps + m] = newpoints[l + m];
                    }

                    newpoints[l + 1] = newpoints[l - ps + 1];
                }
            }

            datapoints.points = newpoints;
        }

        plot.hooks.processDatapoints.push(stackData);
    }

    $.plot.plugins.push({
        init: init,
        options: options,
        name: 'stack',
        version: '1.2'
    });
})(jQuery);

/* Flot plugin for showing crosshairs when the mouse hovers over the plot.

Copyright (c) 2007-2014 IOLA and Ole Laursen.
Licensed under the MIT license.

The plugin supports these options:

    crosshair: {
        mode: null or "x" or "y" or "xy"
        color: color
        lineWidth: number
    }

Set the mode to one of "x", "y" or "xy". The "x" mode enables a vertical
crosshair that lets you trace the values on the x axis, "y" enables a
horizontal crosshair and "xy" enables them both. "color" is the color of the
crosshair (default is "rgba(170, 0, 0, 0.80)"), "lineWidth" is the width of
the drawn lines (default is 1).

The plugin also adds four public methods:

  - setCrosshair( pos )

    Set the position of the crosshair. Note that this is cleared if the user
    moves the mouse. "pos" is in coordinates of the plot and should be on the
    form { x: xpos, y: ypos } (you can use x2/x3/... if you're using multiple
    axes), which is coincidentally the same format as what you get from a
    "plothover" event. If "pos" is null, the crosshair is cleared.

  - clearCrosshair()

    Clear the crosshair.

  - lockCrosshair(pos)

    Cause the crosshair to lock to the current location, no longer updating if
    the user moves the mouse. Optionally supply a position (passed on to
    setCrosshair()) to move it to.

    Example usage:

    var myFlot = $.plot( $("#graph"), ..., { crosshair: { mode: "x" } } };
    $("#graph").bind( "plothover", function ( evt, position, item ) {
        if ( item ) {
            // Lock the crosshair to the data point being hovered
            myFlot.lockCrosshair({
                x: item.datapoint[ 0 ],
                y: item.datapoint[ 1 ]
            });
        } else {
            // Return normal crosshair operation
            myFlot.unlockCrosshair();
        }
    });

  - unlockCrosshair()

    Free the crosshair to move again after locking it.
*/

(function ($) {
    var options = {
        crosshair: {
            mode: null, // one of null, "x", "y" or "xy",
            color: "rgba(170, 0, 0, 0.80)",
            lineWidth: 1
        }
    };

    function init(plot) {
        // position of crosshair in pixels
        var crosshair = {x: -1, y: -1, locked: false, highlighted: false};

        plot.setCrosshair = function setCrosshair(pos) {
            if (!pos) {
                crosshair.x = -1;
            } else {
                var o = plot.p2c(pos);
                crosshair.x = Math.max(0, Math.min(o.left, plot.width()));
                crosshair.y = Math.max(0, Math.min(o.top, plot.height()));
            }

            plot.triggerRedrawOverlay();
        };

        plot.clearCrosshair = plot.setCrosshair; // passes null for pos

        plot.lockCrosshair = function lockCrosshair(pos) {
            if (pos) {
                plot.setCrosshair(pos);
            }

            crosshair.locked = true;
        };

        plot.unlockCrosshair = function unlockCrosshair() {
            crosshair.locked = false;
            crosshair.rect = null;
        };

        function onMouseOut(e) {
            if (crosshair.locked) {
                return;
            }

            if (crosshair.x !== -1) {
                crosshair.x = -1;
                plot.triggerRedrawOverlay();
            }
        }

        function onMouseMove(e) {
            var offset = plot.offset();
            if (crosshair.locked) {
                var mouseX = Math.max(0, Math.min(e.pageX - offset.left, plot.width()));
                var mouseY = Math.max(0, Math.min(e.pageY - offset.top, plot.height()));

                if ((mouseX > crosshair.x - 4) && (mouseX < crosshair.x + 4) && (mouseY > crosshair.y - 4) && (mouseY < crosshair.y + 4)) {
                    if (!crosshair.highlighted) {
                        crosshair.highlighted = true;
                        plot.triggerRedrawOverlay();
                    }
                } else {
                    if (crosshair.highlighted) {
                        crosshair.highlighted = false;
                        plot.triggerRedrawOverlay();
                    }
                }
                return;
            }

            if (plot.getSelection && plot.getSelection()) {
                crosshair.x = -1; // hide the crosshair while selecting
                return;
            }

            crosshair.x = Math.max(0, Math.min(e.pageX - offset.left, plot.width()));
            crosshair.y = Math.max(0, Math.min(e.pageY - offset.top, plot.height()));
            plot.triggerRedrawOverlay();
        }

        plot.hooks.bindEvents.push(function (plot, eventHolder) {
            if (!plot.getOptions().crosshair.mode) {
                return;
            }

            eventHolder.mouseout(onMouseOut);
            eventHolder.mousemove(onMouseMove);
        });

        plot.hooks.drawOverlay.push(function (plot, ctx) {
            var c = plot.getOptions().crosshair;
            if (!c.mode) {
                return;
            }

            var plotOffset = plot.getPlotOffset();

            ctx.save();
            ctx.translate(plotOffset.left, plotOffset.top);

            if (crosshair.x !== -1) {
                var adj = plot.getOptions().crosshair.lineWidth % 2 ? 0.5 : 0;

                ctx.strokeStyle = c.color;
                ctx.lineWidth = c.lineWidth;
                ctx.lineJoin = "round";

                ctx.beginPath();
                if (c.mode.indexOf("x") !== -1) {
                    var drawX = Math.floor(crosshair.x) + adj;
                    ctx.moveTo(drawX, 0);
                    ctx.lineTo(drawX, plot.height());
                }
                if (c.mode.indexOf("y") !== -1) {
                    var drawY = Math.floor(crosshair.y) + adj;
                    ctx.moveTo(0, drawY);
                    ctx.lineTo(plot.width(), drawY);
                }
                if (crosshair.locked) {
                    if (crosshair.highlighted) ctx.fillStyle = 'orange';
                    else ctx.fillStyle = c.color;
                    ctx.fillRect(Math.floor(crosshair.x) + adj - 4, Math.floor(crosshair.y) + adj - 4, 8, 8);
                }
                ctx.stroke();
            }
            ctx.restore();
        });

        plot.hooks.shutdown.push(function (plot, eventHolder) {
            eventHolder.unbind("mouseout", onMouseOut);
            eventHolder.unbind("mousemove", onMouseMove);
        });
    }

    $.plot.plugins.push({
        init: init,
        options: options,
        name: 'crosshair',
        version: '1.0'
    });
})(jQuery);

/*
Axis label plugin for flot

Derived from:
Axis Labels Plugin for flot.
http://github.com/markrcote/flot-axislabels

Original code is Copyright (c) 2010 Xuan Luo.
Original code was released under the GPLv3 license by Xuan Luo, September 2010.
Original code was rereleased under the MIT license by Xuan Luo, April 2012.

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
"Software"), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

(function($) {
    "use strict";

    var options = {
        axisLabels: {
            show: true
        }
    };

    function AxisLabel(axisName, position, padding, placeholder, axisLabel, surface) {
        this.axisName = axisName;
        this.position = position;
        this.padding = padding;
        this.placeholder = placeholder;
        this.axisLabel = axisLabel;
        this.surface = surface;
        this.width = 0;
        this.height = 0;
        this.elem = null;
    }

    AxisLabel.prototype.calculateSize = function() {
        var axisId = this.axisName + 'Label',
            layerId = axisId + 'Layer',
            className = axisId + ' axisLabels';

        var info = this.surface.getTextInfo(layerId, this.axisLabel, className);
        this.labelWidth = info.width;
        this.labelHeight = info.height;

        if (this.position === 'left' || this.position === 'right') {
            this.width = this.labelHeight + this.padding;
            this.height = 0;
        } else {
            this.width = 0;
            this.height = this.labelHeight + this.padding;
        }
    };

    AxisLabel.prototype.transforms = function(degrees, x, y, svgLayer) {
        var transforms = [], translate, rotate;
        if (x !== 0 || y !== 0) {
            translate = svgLayer.createSVGTransform();
            translate.setTranslate(x, y);
            transforms.push(translate);
        }
        if (degrees !== 0) {
            rotate = svgLayer.createSVGTransform();
            var centerX = Math.round(this.labelWidth / 2),
                centerY = 0;
            rotate.setRotate(degrees, centerX, centerY);
            transforms.push(rotate);
        }

        return transforms;
    };

    AxisLabel.prototype.calculateOffsets = function(box) {
        var offsets = {
            x: 0,
            y: 0,
            degrees: 0
        };
        if (this.position === 'bottom') {
            offsets.x = box.left + box.width / 2 - this.labelWidth / 2;
            offsets.y = box.top + box.height - this.labelHeight;
        } else if (this.position === 'top') {
            offsets.x = box.left + box.width / 2 - this.labelWidth / 2;
            offsets.y = box.top;
        } else if (this.position === 'left') {
            offsets.degrees = -90;
            offsets.x = box.left - this.labelWidth / 2;
            offsets.y = box.height / 2 + box.top;
        } else if (this.position === 'right') {
            offsets.degrees = 90;
            offsets.x = box.left + box.width - this.labelWidth / 2;
            offsets.y = box.height / 2 + box.top;
        }
        offsets.x = Math.round(offsets.x);
        offsets.y = Math.round(offsets.y);

        return offsets;
    };

    AxisLabel.prototype.cleanup = function() {
        var axisId = this.axisName + 'Label',
            layerId = axisId + 'Layer',
            className = axisId + ' axisLabels';
        this.surface.removeText(layerId, 0, 0, this.axisLabel, className);
    };

    AxisLabel.prototype.draw = function(box) {
        var axisId = this.axisName + 'Label',
            layerId = axisId + 'Layer',
            className = axisId + ' axisLabels',
            offsets = this.calculateOffsets(box),
            style = {
                position: 'absolute',
                bottom: '',
                right: '',
                display: 'inline-block',
                'white-space': 'nowrap'
            };

        var layer = this.surface.getSVGLayer(layerId);
        var transforms = this.transforms(offsets.degrees, offsets.x, offsets.y, layer.parentNode);

        this.surface.addText(layerId, 0, 0, this.axisLabel, className, undefined, undefined, undefined, undefined, transforms);
        this.surface.render();
        Object.keys(style).forEach(function(key) {
            layer.style[key] = style[key];
        });
    };

    function init(plot) {
        plot.hooks.processOptions.push(function(plot, options) {
            if (!options.axisLabels.show) {
                return;
            }

            var axisLabels = {};
            var defaultPadding = 2; // padding between axis and tick labels

            plot.hooks.axisReserveSpace.push(function(plot, axis) {
                var opts = axis.options;
                var axisName = axis.direction + axis.n;

                axis.labelHeight += axis.boxPosition.centerY;
                axis.labelWidth += axis.boxPosition.centerX;

                if (!opts || !opts.axisLabel || !axis.show) {
                    return;
                }

                var padding = opts.axisLabelPadding === undefined
                    ? defaultPadding
                    : opts.axisLabelPadding;

                var axisLabel = axisLabels[axisName];
                if (!axisLabel) {
                    axisLabel = new AxisLabel(axisName,
                        opts.position, padding,
                        plot.getPlaceholder()[0], opts.axisLabel, plot.getSurface());
                    axisLabels[axisName] = axisLabel;
                }

                axisLabel.calculateSize();

                // Incrementing the sizes of the tick labels.
                axis.labelHeight += axisLabel.height;
                axis.labelWidth += axisLabel.width;
            });

            // TODO - use the drawAxis hook
            plot.hooks.draw.push(function(plot, ctx) {
                $.each(plot.getAxes(), function(flotAxisName, axis) {
                    var opts = axis.options;
                    if (!opts || !opts.axisLabel || !axis.show) {
                        return;
                    }

                    var axisName = axis.direction + axis.n;
                    axisLabels[axisName].draw(axis.box);
                });
            });

            plot.hooks.shutdown.push(function(plot, eventHolder) {
                for (var axisName in axisLabels) {
                    axisLabels[axisName].cleanup();
                }
            });
        });
    };

    $.plot.plugins.push({
        init: init,
        options: options,
        name: 'axisLabels',
        version: '3.0'
    });
})(jQuery);
