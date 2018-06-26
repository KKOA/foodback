!function(t){var e={};function a(s){if(e[s])return e[s].exports;var i=e[s]={i:s,l:!1,exports:{}};return t[s].call(i.exports,i,i.exports,a),i.l=!0,i.exports}a.m=t,a.c=e,a.d=function(t,e,s){a.o(t,e)||Object.defineProperty(t,e,{configurable:!1,enumerable:!0,get:s})},a.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return a.d(e,"a",e),e},a.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},a.p="/",a(a.s=0)}([function(t,e,a){a(1),a(2),t.exports=a(3)},function(t,e){var a="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t};!function(t){"use strict";var e={init:function(a){return this.each(function(){this.self=t(this),e.destroy.call(this.self),this.opt=t.extend(!0,{},t.fn.raty.defaults,a,this.self.data()),e._adjustCallback.call(this),e._adjustNumber.call(this),e._adjustHints.call(this),this.opt.score=e._adjustedScore.call(this,this.opt.score),"img"!==this.opt.starType&&e._adjustStarType.call(this),e._adjustPath.call(this),e._createStars.call(this),this.opt.cancel&&e._createCancel.call(this),this.opt.precision&&e._adjustPrecision.call(this),e._createScore.call(this),e._apply.call(this,this.opt.score),e._setTitle.call(this,this.opt.score),e._target.call(this,this.opt.score),this.opt.readOnly?e._lock.call(this):(this.style.cursor="pointer",e._binds.call(this))})},_adjustCallback:function(){for(var t=["number","readOnly","score","scoreName","target","path"],e=0;e<t.length;e++)"function"==typeof this.opt[t[e]]&&(this.opt[t[e]]=this.opt[t[e]].call(this))},_adjustedScore:function(t){return t?e._between(t,0,this.opt.number):t},_adjustHints:function(){if(this.opt.hints||(this.opt.hints=[]),this.opt.halfShow||this.opt.half)for(var t=this.opt.precision?10:2,e=0;e<this.opt.number;e++){var a=this.opt.hints[e];"[object Array]"!==Object.prototype.toString.call(a)&&(a=[a]),this.opt.hints[e]=[];for(var s=0;s<t;s++){var i=a[s],o=a[a.length-1];void 0===o&&(o=null),this.opt.hints[e][s]=void 0===i?o:i}}},_adjustNumber:function(){this.opt.number=e._between(this.opt.number,1,this.opt.numberMax)},_adjustPath:function(){this.opt.path=this.opt.path||"",this.opt.path&&"/"!==this.opt.path.charAt(this.opt.path.length-1)&&(this.opt.path+="/")},_adjustPrecision:function(){this.opt.half=!0},_adjustStarType:function(){var t=["cancelOff","cancelOn","starHalf","starOff","starOn"];this.opt.path="";for(var e=0;e<t.length;e++)this.opt[t[e]]=this.opt[t[e]].replace(".","-")},_apply:function(t){e._fill.call(this,t),t&&(t>0&&this.score.val(t),e._roundStars.call(this,t))},_between:function(t,e,a){return Math.min(Math.max(parseFloat(t),e),a)},_binds:function(){this.cancel&&(e._bindOverCancel.call(this),e._bindClickCancel.call(this),e._bindOutCancel.call(this)),e._bindOver.call(this),e._bindClick.call(this),e._bindOut.call(this)},_bindClick:function(){var a=this;a.stars.on("click.raty",function(s){var i=!0,o=a.opt.half||a.opt.precision?a.self.data("score"):this.alt||t(this).data("alt");a.opt.click&&(i=a.opt.click.call(a,+o,s)),(i||void 0===i)&&(a.opt.half&&!a.opt.precision&&(o=e._roundHalfScore.call(a,o)),e._apply.call(a,o))})},_bindClickCancel:function(){var t=this;t.cancel.on("click.raty",function(e){t.score.removeAttr("value"),t.opt.click&&t.opt.click.call(t,null,e)})},_bindOut:function(){var t=this;t.self.on("mouseleave.raty",function(a){var s=+t.score.val()||void 0;e._apply.call(t,s),e._target.call(t,s,a),e._resetTitle.call(t),t.opt.mouseout&&t.opt.mouseout.call(t,s,a)})},_bindOutCancel:function(){var t=this;t.cancel.on("mouseleave.raty",function(a){var s=t.opt.cancelOff;if("img"!==t.opt.starType&&(s=t.opt.cancelClass+" "+s),e._setIcon.call(t,this,s),t.opt.mouseout){var i=+t.score.val()||void 0;t.opt.mouseout.call(t,i,a)}})},_bindOver:function(){var t=this,a=t.opt.half?"mousemove.raty":"mouseover.raty";t.stars.on(a,function(a){var s=e._getScoreByPosition.call(t,a,this);e._fill.call(t,s),t.opt.half&&(e._roundStars.call(t,s,a),e._setTitle.call(t,s,a),t.self.data("score",s)),e._target.call(t,s,a),t.opt.mouseover&&t.opt.mouseover.call(t,s,a)})},_bindOverCancel:function(){var t=this;t.cancel.on("mouseover.raty",function(a){var s=t.opt.path+t.opt.starOff,i=t.opt.cancelOn;"img"===t.opt.starType?t.stars.attr("src",s):(i=t.opt.cancelClass+" "+i,t.stars.attr("class",s)),e._setIcon.call(t,this,i),e._target.call(t,null,a),t.opt.mouseover&&t.opt.mouseover.call(t,null)})},_buildScoreField:function(){return t("<input />",{name:this.opt.scoreName,type:"hidden"}).appendTo(this)},_createCancel:function(){var e=this.opt.path+this.opt.cancelOff,a=t("<"+this.opt.starType+" />",{title:this.opt.cancelHint,class:this.opt.cancelClass});"img"===this.opt.starType?a.attr({src:e,alt:"x"}):a.attr("data-alt","x").addClass(e),"left"===this.opt.cancelPlace?this.self.prepend("&#160;").prepend(a):this.self.append("&#160;").append(a),this.cancel=a},_createScore:function(){var a=t(this.opt.targetScore);this.score=a.length?a:e._buildScoreField.call(this)},_createStars:function(){for(var a=1;a<=this.opt.number;a++){var s=e._nameForIndex.call(this,a),i={alt:a,src:this.opt.path+this.opt[s]};"img"!==this.opt.starType&&(i={"data-alt":a,class:i.src}),i.title=e._getHint.call(this,a),t("<"+this.opt.starType+" />",i).appendTo(this),this.opt.space&&this.self.append(a<this.opt.number?"&#160;":"")}this.stars=this.self.children(this.opt.starType)},_error:function(e){t(this).text(e),t.error(e)},_fill:function(t){for(var a=0,s=1;s<=this.stars.length;s++){var i,o=this.stars[s-1],r=e._turnOn.call(this,s,t);if(this.opt.iconRange&&this.opt.iconRange.length>a){var n=this.opt.iconRange[a];i=e._getRangeIcon.call(this,n,r),s<=n.range&&e._setIcon.call(this,o,i),s===n.range&&a++}else i=this.opt[r?"starOn":"starOff"],e._setIcon.call(this,o,i)}},_getFirstDecimal:function(t){var e=t.toString().split(".")[1],a=0;return e&&(a=parseInt(e.charAt(0),10),"9999"===e.slice(1,5)&&a++),a},_getRangeIcon:function(t,e){return e?t.on||this.opt.starOn:t.off||this.opt.starOff},_getScoreByPosition:function(a,s){var i=parseInt(s.alt||s.getAttribute("data-alt"),10);if(this.opt.half){var o=e._getWidth.call(this);i=i-1+parseFloat((a.pageX-t(s).offset().left)/o)}return i},_getHint:function(t,a){if(0!==t&&!t)return this.opt.noRatedMsg;var s=e._getFirstDecimal.call(this,t),i=Math.ceil(t),o=this.opt.hints[(i||1)-1],r=o,n=!a||this.move;return this.opt.precision?(n&&(s=0===s?9:s-1),r=o[s]):(this.opt.halfShow||this.opt.half)&&(r=o[s=n&&0===s?1:s>5?1:0]),""===r?"":r||t},_getWidth:function(){var t=this.stars[0].width||parseFloat(this.stars.eq(0).css("font-size"));return t||e._error.call(this,"Could not get the icon width!"),t},_lock:function(){var t=e._getHint.call(this,this.score.val());this.style.cursor="",this.title=t,this.score.prop("readonly",!0),this.stars.prop("title",t),this.cancel&&this.cancel.hide(),this.self.data("readonly",!0)},_nameForIndex:function(t){return this.opt.score&&this.opt.score>=t?"starOn":"starOff"},_resetTitle:function(){for(var t=0;t<this.opt.number;t++)this.stars[t].title=e._getHint.call(this,t+1)},_roundHalfScore:function(t){var a=parseInt(t,10),s=e._getFirstDecimal.call(this,t);return 0!==s&&(s=s>5?1:.5),a+s},_roundStars:function(t,a){var s,i=(t%1).toFixed(2);if(a||this.move?s=i>.5?"starOn":"starHalf":i>this.opt.round.down&&(s="starOn",this.opt.halfShow&&i<this.opt.round.up?s="starHalf":i<this.opt.round.full&&(s="starOff")),s){var o=this.opt[s],r=this.stars[Math.ceil(t)-1];e._setIcon.call(this,r,o)}},_setIcon:function(t,e){t["img"===this.opt.starType?"src":"className"]=this.opt.path+e},_setTarget:function(t,e){e&&(e=this.opt.targetFormat.toString().replace("{score}",e)),t.is(":input")?t.val(e):t.html(e)},_setTitle:function(t,a){if(t){var s=parseInt(Math.ceil(t),10);this.stars[s-1].title=e._getHint.call(this,t,a)}},_target:function(a,s){if(this.opt.target){var i=t(this.opt.target);i.length||e._error.call(this,"Target selector invalid or missing!");var o=s&&"mouseover"===s.type;if(void 0===a)a=this.opt.targetText;else if(null===a)a=o?this.opt.cancelHint:this.opt.targetText;else{"hint"===this.opt.targetType?a=e._getHint.call(this,a,s):this.opt.precision&&(a=parseFloat(a).toFixed(1));var r=s&&"mousemove"===s.type;o||r||this.opt.targetKeep||(a=this.opt.targetText)}e._setTarget.call(this,i,a)}},_turnOn:function(t,e){return this.opt.single?t===e:t<=e},_unlock:function(){this.style.cursor="pointer",this.removeAttribute("title"),this.score.removeAttr("readonly"),this.self.data("readonly",!1);for(var t=0;t<this.opt.number;t++)this.stars[t].title=e._getHint.call(this,t+1);this.cancel&&this.cancel.css("display","")},cancel:function(a){return this.each(function(){var s=t(this);!0!==s.data("readonly")&&(e[a?"click":"score"].call(s,null),this.score.removeAttr("value"))})},click:function(a){return this.each(function(){!0!==t(this).data("readonly")&&(a=e._adjustedScore.call(this,a),e._apply.call(this,a),this.opt.click&&this.opt.click.call(this,a,t.Event("click")),e._target.call(this,a))})},destroy:function(){return this.each(function(){var e=t(this),a=e.data("raw");a?e.off(".raty").empty().css({cursor:a.style.cursor}).removeData("readonly"):e.data("raw",e.clone()[0])})},getScore:function(){var t,e=[];return this.each(function(){t=this.score.val(),e.push(t?+t:void 0)}),e.length>1?e:e[0]},move:function(a){return this.each(function(){var s=parseInt(a,10),i=e._getFirstDecimal.call(this,a);s>=this.opt.number&&(s=this.opt.number-1,i=10);var o=e._getWidth.call(this)/10,r=t(this.stars[s]),n=r.offset().left+o*i,l=t.Event("mousemove",{pageX:n});this.move=!0,r.trigger(l),this.move=!1})},readOnly:function(a){return this.each(function(){var s=t(this);s.data("readonly")!==a&&(a?(s.off(".raty").children(this.opt.starType).off(".raty"),e._lock.call(this)):(e._binds.call(this),e._unlock.call(this)),s.data("readonly",a))})},reload:function(){return e.set.call(this,{})},score:function(){var a=t(this);return arguments.length?e.setScore.apply(a,arguments):e.getScore.call(a)},set:function(e){return this.each(function(){t(this).raty(t.extend({},this.opt,e))})},setScore:function(a){return this.each(function(){!0!==t(this).data("readonly")&&(a=e._adjustedScore.call(this,a),e._apply.call(this,a),e._target.call(this,a))})}};t.fn.raty=function(s){return e[s]?e[s].apply(this,Array.prototype.slice.call(arguments,1)):"object"!==(void 0===s?"undefined":a(s))&&s?void t.error("Method "+s+" does not exist!"):e.init.apply(this,arguments)},t.fn.raty.defaults={cancel:!1,cancelClass:"raty-cancel",cancelHint:"Cancel this rating!",cancelOff:"cancel-off.png",cancelOn:"cancel-on.png",cancelPlace:"left",click:void 0,half:!1,halfShow:!0,hints:["bad","poor","regular","good","gorgeous"],iconRange:void 0,mouseout:void 0,mouseover:void 0,noRatedMsg:"Not rated yet!",number:5,numberMax:20,path:void 0,precision:!1,readOnly:!1,round:{down:.25,full:.6,up:.76},score:void 0,scoreName:"score",single:!1,space:!0,starHalf:"star-half.png",starOff:"star-off.png",starOn:"star-on.png",starType:"img",target:void 0,targetFormat:"{score}",targetKeep:!1,targetScore:void 0,targetText:"",targetType:"hint"}}(jQuery)},function(t,e){},function(t,e){}]);