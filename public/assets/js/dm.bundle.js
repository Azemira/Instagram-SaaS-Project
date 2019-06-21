/*! jQuery v3.2.1 | (c) JS Foundation and other contributors | jquery.org/license */
!function(a,b){"use strict";"object"==typeof module&&"object"==typeof module.exports?module.exports=a.document?b(a,!0):function(a){if(!a.document)throw new Error("jQuery requires a window with a document");return b(a)}:b(a)}("undefined"!=typeof window?window:this,function(a,b){"use strict";var c=[],d=a.document,e=Object.getPrototypeOf,f=c.slice,g=c.concat,h=c.push,i=c.indexOf,j={},k=j.toString,l=j.hasOwnProperty,m=l.toString,n=m.call(Object),o={};function p(a,b){b=b||d;var c=b.createElement("script");c.text=a,b.head.appendChild(c).parentNode.removeChild(c)}var q="3.2.1",r=function(a,b){return new r.fn.init(a,b)},s=/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,t=/^-ms-/,u=/-([a-z])/g,v=function(a,b){return b.toUpperCase()};r.fn=r.prototype={jquery:q,constructor:r,length:0,toArray:function(){return f.call(this)},get:function(a){return null==a?f.call(this):a<0?this[a+this.length]:this[a]},pushStack:function(a){var b=r.merge(this.constructor(),a);return b.prevObject=this,b},each:function(a){return r.each(this,a)},map:function(a){return this.pushStack(r.map(this,function(b,c){return a.call(b,c,b)}))},slice:function(){return this.pushStack(f.apply(this,arguments))},first:function(){return this.eq(0)},last:function(){return this.eq(-1)},eq:function(a){var b=this.length,c=+a+(a<0?b:0);return this.pushStack(c>=0&&c<b?[this[c]]:[])},end:function(){return this.prevObject||this.constructor()},push:h,sort:c.sort,splice:c.splice},r.extend=r.fn.extend=function(){var a,b,c,d,e,f,g=arguments[0]||{},h=1,i=arguments.length,j=!1;for("boolean"==typeof g&&(j=g,g=arguments[h]||{},h++),"object"==typeof g||r.isFunction(g)||(g={}),h===i&&(g=this,h--);h<i;h++)if(null!=(a=arguments[h]))for(b in a)c=g[b],d=a[b],g!==d&&(j&&d&&(r.isPlainObject(d)||(e=Array.isArray(d)))?(e?(e=!1,f=c&&Array.isArray(c)?c:[]):f=c&&r.isPlainObject(c)?c:{},g[b]=r.extend(j,f,d)):void 0!==d&&(g[b]=d));return g},r.extend({expando:"jQuery"+(q+Math.random()).replace(/\D/g,""),isReady:!0,error:function(a){throw new Error(a)},noop:function(){},isFunction:function(a){return"function"===r.type(a)},isWindow:function(a){return null!=a&&a===a.window},isNumeric:function(a){var b=r.type(a);return("number"===b||"string"===b)&&!isNaN(a-parseFloat(a))},isPlainObject:function(a){var b,c;return!(!a||"[object Object]"!==k.call(a))&&(!(b=e(a))||(c=l.call(b,"constructor")&&b.constructor,"function"==typeof c&&m.call(c)===n))},isEmptyObject:function(a){var b;for(b in a)return!1;return!0},type:function(a){return null==a?a+"":"object"==typeof a||"function"==typeof a?j[k.call(a)]||"object":typeof a},globalEval:function(a){p(a)},camelCase:function(a){return a.replace(t,"ms-").replace(u,v)},each:function(a,b){var c,d=0;if(w(a)){for(c=a.length;d<c;d++)if(b.call(a[d],d,a[d])===!1)break}else for(d in a)if(b.call(a[d],d,a[d])===!1)break;return a},trim:function(a){return null==a?"":(a+"").replace(s,"")},makeArray:function(a,b){var c=b||[];return null!=a&&(w(Object(a))?r.merge(c,"string"==typeof a?[a]:a):h.call(c,a)),c},inArray:function(a,b,c){return null==b?-1:i.call(b,a,c)},merge:function(a,b){for(var c=+b.length,d=0,e=a.length;d<c;d++)a[e++]=b[d];return a.length=e,a},grep:function(a,b,c){for(var d,e=[],f=0,g=a.length,h=!c;f<g;f++)d=!b(a[f],f),d!==h&&e.push(a[f]);return e},map:function(a,b,c){var d,e,f=0,h=[];if(w(a))for(d=a.length;f<d;f++)e=b(a[f],f,c),null!=e&&h.push(e);else for(f in a)e=b(a[f],f,c),null!=e&&h.push(e);return g.apply([],h)},guid:1,proxy:function(a,b){var c,d,e;if("string"==typeof b&&(c=a[b],b=a,a=c),r.isFunction(a))return d=f.call(arguments,2),e=function(){return a.apply(b||this,d.concat(f.call(arguments)))},e.guid=a.guid=a.guid||r.guid++,e},now:Date.now,support:o}),"function"==typeof Symbol&&(r.fn[Symbol.iterator]=c[Symbol.iterator]),r.each("Boolean Number String Function Array Date RegExp Object Error Symbol".split(" "),function(a,b){j["[object "+b+"]"]=b.toLowerCase()});function w(a){var b=!!a&&"length"in a&&a.length,c=r.type(a);return"function"!==c&&!r.isWindow(a)&&("array"===c||0===b||"number"==typeof b&&b>0&&b-1 in a)}var x=function(a){var b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u="sizzle"+1*new Date,v=a.document,w=0,x=0,y=ha(),z=ha(),A=ha(),B=function(a,b){return a===b&&(l=!0),0},C={}.hasOwnProperty,D=[],E=D.pop,F=D.push,G=D.push,H=D.slice,I=function(a,b){for(var c=0,d=a.length;c<d;c++)if(a[c]===b)return c;return-1},J="checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",K="[\\x20\\t\\r\\n\\f]",L="(?:\\\\.|[\\w-]|[^\0-\\xa0])+",M="\\["+K+"*("+L+")(?:"+K+"*([*^$|!~]?=)"+K+"*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|("+L+"))|)"+K+"*\\]",N=":("+L+")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|"+M+")*)|.*)\\)|)",O=new RegExp(K+"+","g"),P=new RegExp("^"+K+"+|((?:^|[^\\\\])(?:\\\\.)*)"+K+"+$","g"),Q=new RegExp("^"+K+"*,"+K+"*"),R=new RegExp("^"+K+"*([>+~]|"+K+")"+K+"*"),S=new RegExp("="+K+"*([^\\]'\"]*?)"+K+"*\\]","g"),T=new RegExp(N),U=new RegExp("^"+L+"$"),V={ID:new RegExp("^#("+L+")"),CLASS:new RegExp("^\\.("+L+")"),TAG:new RegExp("^("+L+"|[*])"),ATTR:new RegExp("^"+M),PSEUDO:new RegExp("^"+N),CHILD:new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\("+K+"*(even|odd|(([+-]|)(\\d*)n|)"+K+"*(?:([+-]|)"+K+"*(\\d+)|))"+K+"*\\)|)","i"),bool:new RegExp("^(?:"+J+")$","i"),needsContext:new RegExp("^"+K+"*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\("+K+"*((?:-\\d)?\\d*)"+K+"*\\)|)(?=[^-]|$)","i")},W=/^(?:input|select|textarea|button)$/i,X=/^h\d$/i,Y=/^[^{]+\{\s*\[native \w/,Z=/^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,$=/[+~]/,_=new RegExp("\\\\([\\da-f]{1,6}"+K+"?|("+K+")|.)","ig"),aa=function(a,b,c){var d="0x"+b-65536;return d!==d||c?b:d<0?String.fromCharCode(d+65536):String.fromCharCode(d>>10|55296,1023&d|56320)},ba=/([\0-\x1f\x7f]|^-?\d)|^-$|[^\0-\x1f\x7f-\uFFFF\w-]/g,ca=function(a,b){return b?"\0"===a?"\ufffd":a.slice(0,-1)+"\\"+a.charCodeAt(a.length-1).toString(16)+" ":"\\"+a},da=function(){m()},ea=ta(function(a){return a.disabled===!0&&("form"in a||"label"in a)},{dir:"parentNode",next:"legend"});try{G.apply(D=H.call(v.childNodes),v.childNodes),D[v.childNodes.length].nodeType}catch(fa){G={apply:D.length?function(a,b){F.apply(a,H.call(b))}:function(a,b){var c=a.length,d=0;while(a[c++]=b[d++]);a.length=c-1}}}function ga(a,b,d,e){var f,h,j,k,l,o,r,s=b&&b.ownerDocument,w=b?b.nodeType:9;if(d=d||[],"string"!=typeof a||!a||1!==w&&9!==w&&11!==w)return d;if(!e&&((b?b.ownerDocument||b:v)!==n&&m(b),b=b||n,p)){if(11!==w&&(l=Z.exec(a)))if(f=l[1]){if(9===w){if(!(j=b.getElementById(f)))return d;if(j.id===f)return d.push(j),d}else if(s&&(j=s.getElementById(f))&&t(b,j)&&j.id===f)return d.push(j),d}else{if(l[2])return G.apply(d,b.getElementsByTagName(a)),d;if((f=l[3])&&c.getElementsByClassName&&b.getElementsByClassName)return G.apply(d,b.getElementsByClassName(f)),d}if(c.qsa&&!A[a+" "]&&(!q||!q.test(a))){if(1!==w)s=b,r=a;else if("object"!==b.nodeName.toLowerCase()){(k=b.getAttribute("id"))?k=k.replace(ba,ca):b.setAttribute("id",k=u),o=g(a),h=o.length;while(h--)o[h]="#"+k+" "+sa(o[h]);r=o.join(","),s=$.test(a)&&qa(b.parentNode)||b}if(r)try{return G.apply(d,s.querySelectorAll(r)),d}catch(x){}finally{k===u&&b.removeAttribute("id")}}}return i(a.replace(P,"$1"),b,d,e)}function ha(){var a=[];function b(c,e){return a.push(c+" ")>d.cacheLength&&delete b[a.shift()],b[c+" "]=e}return b}function ia(a){return a[u]=!0,a}function ja(a){var b=n.createElement("fieldset");try{return!!a(b)}catch(c){return!1}finally{b.parentNode&&b.parentNode.removeChild(b),b=null}}function ka(a,b){var c=a.split("|"),e=c.length;while(e--)d.attrHandle[c[e]]=b}function la(a,b){var c=b&&a,d=c&&1===a.nodeType&&1===b.nodeType&&a.sourceIndex-b.sourceIndex;if(d)return d;if(c)while(c=c.nextSibling)if(c===b)return-1;return a?1:-1}function ma(a){return function(b){var c=b.nodeName.toLowerCase();return"input"===c&&b.type===a}}function na(a){return function(b){var c=b.nodeName.toLowerCase();return("input"===c||"button"===c)&&b.type===a}}function oa(a){return function(b){return"form"in b?b.parentNode&&b.disabled===!1?"label"in b?"label"in b.parentNode?b.parentNode.disabled===a:b.disabled===a:b.isDisabled===a||b.isDisabled!==!a&&ea(b)===a:b.disabled===a:"label"in b&&b.disabled===a}}function pa(a){return ia(function(b){return b=+b,ia(function(c,d){var e,f=a([],c.length,b),g=f.length;while(g--)c[e=f[g]]&&(c[e]=!(d[e]=c[e]))})})}function qa(a){return a&&"undefined"!=typeof a.getElementsByTagName&&a}c=ga.support={},f=ga.isXML=function(a){var b=a&&(a.ownerDocument||a).documentElement;return!!b&&"HTML"!==b.nodeName},m=ga.setDocument=function(a){var b,e,g=a?a.ownerDocument||a:v;return g!==n&&9===g.nodeType&&g.documentElement?(n=g,o=n.documentElement,p=!f(n),v!==n&&(e=n.defaultView)&&e.top!==e&&(e.addEventListener?e.addEventListener("unload",da,!1):e.attachEvent&&e.attachEvent("onunload",da)),c.attributes=ja(function(a){return a.className="i",!a.getAttribute("className")}),c.getElementsByTagName=ja(function(a){return a.appendChild(n.createComment("")),!a.getElementsByTagName("*").length}),c.getElementsByClassName=Y.test(n.getElementsByClassName),c.getById=ja(function(a){return o.appendChild(a).id=u,!n.getElementsByName||!n.getElementsByName(u).length}),c.getById?(d.filter.ID=function(a){var b=a.replace(_,aa);return function(a){return a.getAttribute("id")===b}},d.find.ID=function(a,b){if("undefined"!=typeof b.getElementById&&p){var c=b.getElementById(a);return c?[c]:[]}}):(d.filter.ID=function(a){var b=a.replace(_,aa);return function(a){var c="undefined"!=typeof a.getAttributeNode&&a.getAttributeNode("id");return c&&c.value===b}},d.find.ID=function(a,b){if("undefined"!=typeof b.getElementById&&p){var c,d,e,f=b.getElementById(a);if(f){if(c=f.getAttributeNode("id"),c&&c.value===a)return[f];e=b.getElementsByName(a),d=0;while(f=e[d++])if(c=f.getAttributeNode("id"),c&&c.value===a)return[f]}return[]}}),d.find.TAG=c.getElementsByTagName?function(a,b){return"undefined"!=typeof b.getElementsByTagName?b.getElementsByTagName(a):c.qsa?b.querySelectorAll(a):void 0}:function(a,b){var c,d=[],e=0,f=b.getElementsByTagName(a);if("*"===a){while(c=f[e++])1===c.nodeType&&d.push(c);return d}return f},d.find.CLASS=c.getElementsByClassName&&function(a,b){if("undefined"!=typeof b.getElementsByClassName&&p)return b.getElementsByClassName(a)},r=[],q=[],(c.qsa=Y.test(n.querySelectorAll))&&(ja(function(a){o.appendChild(a).innerHTML="<a id='"+u+"'></a><select id='"+u+"-\r\\' msallowcapture=''><option selected=''></option></select>",a.querySelectorAll("[msallowcapture^='']").length&&q.push("[*^$]="+K+"*(?:''|\"\")"),a.querySelectorAll("[selected]").length||q.push("\\["+K+"*(?:value|"+J+")"),a.querySelectorAll("[id~="+u+"-]").length||q.push("~="),a.querySelectorAll(":checked").length||q.push(":checked"),a.querySelectorAll("a#"+u+"+*").length||q.push(".#.+[+~]")}),ja(function(a){a.innerHTML="<a href='' disabled='disabled'></a><select disabled='disabled'><option/></select>";var b=n.createElement("input");b.setAttribute("type","hidden"),a.appendChild(b).setAttribute("name","D"),a.querySelectorAll("[name=d]").length&&q.push("name"+K+"*[*^$|!~]?="),2!==a.querySelectorAll(":enabled").length&&q.push(":enabled",":disabled"),o.appendChild(a).disabled=!0,2!==a.querySelectorAll(":disabled").length&&q.push(":enabled",":disabled"),a.querySelectorAll("*,:x"),q.push(",.*:")})),(c.matchesSelector=Y.test(s=o.matches||o.webkitMatchesSelector||o.mozMatchesSelector||o.oMatchesSelector||o.msMatchesSelector))&&ja(function(a){c.disconnectedMatch=s.call(a,"*"),s.call(a,"[s!='']:x"),r.push("!=",N)}),q=q.length&&new RegExp(q.join("|")),r=r.length&&new RegExp(r.join("|")),b=Y.test(o.compareDocumentPosition),t=b||Y.test(o.contains)?function(a,b){var c=9===a.nodeType?a.documentElement:a,d=b&&b.parentNode;return a===d||!(!d||1!==d.nodeType||!(c.contains?c.contains(d):a.compareDocumentPosition&&16&a.compareDocumentPosition(d)))}:function(a,b){if(b)while(b=b.parentNode)if(b===a)return!0;return!1},B=b?function(a,b){if(a===b)return l=!0,0;var d=!a.compareDocumentPosition-!b.compareDocumentPosition;return d?d:(d=(a.ownerDocument||a)===(b.ownerDocument||b)?a.compareDocumentPosition(b):1,1&d||!c.sortDetached&&b.compareDocumentPosition(a)===d?a===n||a.ownerDocument===v&&t(v,a)?-1:b===n||b.ownerDocument===v&&t(v,b)?1:k?I(k,a)-I(k,b):0:4&d?-1:1)}:function(a,b){if(a===b)return l=!0,0;var c,d=0,e=a.parentNode,f=b.parentNode,g=[a],h=[b];if(!e||!f)return a===n?-1:b===n?1:e?-1:f?1:k?I(k,a)-I(k,b):0;if(e===f)return la(a,b);c=a;while(c=c.parentNode)g.unshift(c);c=b;while(c=c.parentNode)h.unshift(c);while(g[d]===h[d])d++;return d?la(g[d],h[d]):g[d]===v?-1:h[d]===v?1:0},n):n},ga.matches=function(a,b){return ga(a,null,null,b)},ga.matchesSelector=function(a,b){if((a.ownerDocument||a)!==n&&m(a),b=b.replace(S,"='$1']"),c.matchesSelector&&p&&!A[b+" "]&&(!r||!r.test(b))&&(!q||!q.test(b)))try{var d=s.call(a,b);if(d||c.disconnectedMatch||a.document&&11!==a.document.nodeType)return d}catch(e){}return ga(b,n,null,[a]).length>0},ga.contains=function(a,b){return(a.ownerDocument||a)!==n&&m(a),t(a,b)},ga.attr=function(a,b){(a.ownerDocument||a)!==n&&m(a);var e=d.attrHandle[b.toLowerCase()],f=e&&C.call(d.attrHandle,b.toLowerCase())?e(a,b,!p):void 0;return void 0!==f?f:c.attributes||!p?a.getAttribute(b):(f=a.getAttributeNode(b))&&f.specified?f.value:null},ga.escape=function(a){return(a+"").replace(ba,ca)},ga.error=function(a){throw new Error("Syntax error, unrecognized expression: "+a)},ga.uniqueSort=function(a){var b,d=[],e=0,f=0;if(l=!c.detectDuplicates,k=!c.sortStable&&a.slice(0),a.sort(B),l){while(b=a[f++])b===a[f]&&(e=d.push(f));while(e--)a.splice(d[e],1)}return k=null,a},e=ga.getText=function(a){var b,c="",d=0,f=a.nodeType;if(f){if(1===f||9===f||11===f){if("string"==typeof a.textContent)return a.textContent;for(a=a.firstChild;a;a=a.nextSibling)c+=e(a)}else if(3===f||4===f)return a.nodeValue}else while(b=a[d++])c+=e(b);return c},d=ga.selectors={cacheLength:50,createPseudo:ia,match:V,attrHandle:{},find:{},relative:{">":{dir:"parentNode",first:!0}," ":{dir:"parentNode"},"+":{dir:"previousSibling",first:!0},"~":{dir:"previousSibling"}},preFilter:{ATTR:function(a){return a[1]=a[1].replace(_,aa),a[3]=(a[3]||a[4]||a[5]||"").replace(_,aa),"~="===a[2]&&(a[3]=" "+a[3]+" "),a.slice(0,4)},CHILD:function(a){return a[1]=a[1].toLowerCase(),"nth"===a[1].slice(0,3)?(a[3]||ga.error(a[0]),a[4]=+(a[4]?a[5]+(a[6]||1):2*("even"===a[3]||"odd"===a[3])),a[5]=+(a[7]+a[8]||"odd"===a[3])):a[3]&&ga.error(a[0]),a},PSEUDO:function(a){var b,c=!a[6]&&a[2];return V.CHILD.test(a[0])?null:(a[3]?a[2]=a[4]||a[5]||"":c&&T.test(c)&&(b=g(c,!0))&&(b=c.indexOf(")",c.length-b)-c.length)&&(a[0]=a[0].slice(0,b),a[2]=c.slice(0,b)),a.slice(0,3))}},filter:{TAG:function(a){var b=a.replace(_,aa).toLowerCase();return"*"===a?function(){return!0}:function(a){return a.nodeName&&a.nodeName.toLowerCase()===b}},CLASS:function(a){var b=y[a+" "];return b||(b=new RegExp("(^|"+K+")"+a+"("+K+"|$)"))&&y(a,function(a){return b.test("string"==typeof a.className&&a.className||"undefined"!=typeof a.getAttribute&&a.getAttribute("class")||"")})},ATTR:function(a,b,c){return function(d){var e=ga.attr(d,a);return null==e?"!="===b:!b||(e+="","="===b?e===c:"!="===b?e!==c:"^="===b?c&&0===e.indexOf(c):"*="===b?c&&e.indexOf(c)>-1:"$="===b?c&&e.slice(-c.length)===c:"~="===b?(" "+e.replace(O," ")+" ").indexOf(c)>-1:"|="===b&&(e===c||e.slice(0,c.length+1)===c+"-"))}},CHILD:function(a,b,c,d,e){var f="nth"!==a.slice(0,3),g="last"!==a.slice(-4),h="of-type"===b;return 1===d&&0===e?function(a){return!!a.parentNode}:function(b,c,i){var j,k,l,m,n,o,p=f!==g?"nextSibling":"previousSibling",q=b.parentNode,r=h&&b.nodeName.toLowerCase(),s=!i&&!h,t=!1;if(q){if(f){while(p){m=b;while(m=m[p])if(h?m.nodeName.toLowerCase()===r:1===m.nodeType)return!1;o=p="only"===a&&!o&&"nextSibling"}return!0}if(o=[g?q.firstChild:q.lastChild],g&&s){m=q,l=m[u]||(m[u]={}),k=l[m.uniqueID]||(l[m.uniqueID]={}),j=k[a]||[],n=j[0]===w&&j[1],t=n&&j[2],m=n&&q.childNodes[n];while(m=++n&&m&&m[p]||(t=n=0)||o.pop())if(1===m.nodeType&&++t&&m===b){k[a]=[w,n,t];break}}else if(s&&(m=b,l=m[u]||(m[u]={}),k=l[m.uniqueID]||(l[m.uniqueID]={}),j=k[a]||[],n=j[0]===w&&j[1],t=n),t===!1)while(m=++n&&m&&m[p]||(t=n=0)||o.pop())if((h?m.nodeName.toLowerCase()===r:1===m.nodeType)&&++t&&(s&&(l=m[u]||(m[u]={}),k=l[m.uniqueID]||(l[m.uniqueID]={}),k[a]=[w,t]),m===b))break;return t-=e,t===d||t%d===0&&t/d>=0}}},PSEUDO:function(a,b){var c,e=d.pseudos[a]||d.setFilters[a.toLowerCase()]||ga.error("unsupported pseudo: "+a);return e[u]?e(b):e.length>1?(c=[a,a,"",b],d.setFilters.hasOwnProperty(a.toLowerCase())?ia(function(a,c){var d,f=e(a,b),g=f.length;while(g--)d=I(a,f[g]),a[d]=!(c[d]=f[g])}):function(a){return e(a,0,c)}):e}},pseudos:{not:ia(function(a){var b=[],c=[],d=h(a.replace(P,"$1"));return d[u]?ia(function(a,b,c,e){var f,g=d(a,null,e,[]),h=a.length;while(h--)(f=g[h])&&(a[h]=!(b[h]=f))}):function(a,e,f){return b[0]=a,d(b,null,f,c),b[0]=null,!c.pop()}}),has:ia(function(a){return function(b){return ga(a,b).length>0}}),contains:ia(function(a){return a=a.replace(_,aa),function(b){return(b.textContent||b.innerText||e(b)).indexOf(a)>-1}}),lang:ia(function(a){return U.test(a||"")||ga.error("unsupported lang: "+a),a=a.replace(_,aa).toLowerCase(),function(b){var c;do if(c=p?b.lang:b.getAttribute("xml:lang")||b.getAttribute("lang"))return c=c.toLowerCase(),c===a||0===c.indexOf(a+"-");while((b=b.parentNode)&&1===b.nodeType);return!1}}),target:function(b){var c=a.location&&a.location.hash;return c&&c.slice(1)===b.id},root:function(a){return a===o},focus:function(a){return a===n.activeElement&&(!n.hasFocus||n.hasFocus())&&!!(a.type||a.href||~a.tabIndex)},enabled:oa(!1),disabled:oa(!0),checked:function(a){var b=a.nodeName.toLowerCase();return"input"===b&&!!a.checked||"option"===b&&!!a.selected},selected:function(a){return a.parentNode&&a.parentNode.selectedIndex,a.selected===!0},empty:function(a){for(a=a.firstChild;a;a=a.nextSibling)if(a.nodeType<6)return!1;return!0},parent:function(a){return!d.pseudos.empty(a)},header:function(a){return X.test(a.nodeName)},input:function(a){return W.test(a.nodeName)},button:function(a){var b=a.nodeName.toLowerCase();return"input"===b&&"button"===a.type||"button"===b},text:function(a){var b;return"input"===a.nodeName.toLowerCase()&&"text"===a.type&&(null==(b=a.getAttribute("type"))||"text"===b.toLowerCase())},first:pa(function(){return[0]}),last:pa(function(a,b){return[b-1]}),eq:pa(function(a,b,c){return[c<0?c+b:c]}),even:pa(function(a,b){for(var c=0;c<b;c+=2)a.push(c);return a}),odd:pa(function(a,b){for(var c=1;c<b;c+=2)a.push(c);return a}),lt:pa(function(a,b,c){for(var d=c<0?c+b:c;--d>=0;)a.push(d);return a}),gt:pa(function(a,b,c){for(var d=c<0?c+b:c;++d<b;)a.push(d);return a})}},d.pseudos.nth=d.pseudos.eq;for(b in{radio:!0,checkbox:!0,file:!0,password:!0,image:!0})d.pseudos[b]=ma(b);for(b in{submit:!0,reset:!0})d.pseudos[b]=na(b);function ra(){}ra.prototype=d.filters=d.pseudos,d.setFilters=new ra,g=ga.tokenize=function(a,b){var c,e,f,g,h,i,j,k=z[a+" "];if(k)return b?0:k.slice(0);h=a,i=[],j=d.preFilter;while(h){c&&!(e=Q.exec(h))||(e&&(h=h.slice(e[0].length)||h),i.push(f=[])),c=!1,(e=R.exec(h))&&(c=e.shift(),f.push({value:c,type:e[0].replace(P," ")}),h=h.slice(c.length));for(g in d.filter)!(e=V[g].exec(h))||j[g]&&!(e=j[g](e))||(c=e.shift(),f.push({value:c,type:g,matches:e}),h=h.slice(c.length));if(!c)break}return b?h.length:h?ga.error(a):z(a,i).slice(0)};function sa(a){for(var b=0,c=a.length,d="";b<c;b++)d+=a[b].value;return d}function ta(a,b,c){var d=b.dir,e=b.next,f=e||d,g=c&&"parentNode"===f,h=x++;return b.first?function(b,c,e){while(b=b[d])if(1===b.nodeType||g)return a(b,c,e);return!1}:function(b,c,i){var j,k,l,m=[w,h];if(i){while(b=b[d])if((1===b.nodeType||g)&&a(b,c,i))return!0}else while(b=b[d])if(1===b.nodeType||g)if(l=b[u]||(b[u]={}),k=l[b.uniqueID]||(l[b.uniqueID]={}),e&&e===b.nodeName.toLowerCase())b=b[d]||b;else{if((j=k[f])&&j[0]===w&&j[1]===h)return m[2]=j[2];if(k[f]=m,m[2]=a(b,c,i))return!0}return!1}}function ua(a){return a.length>1?function(b,c,d){var e=a.length;while(e--)if(!a[e](b,c,d))return!1;return!0}:a[0]}function va(a,b,c){for(var d=0,e=b.length;d<e;d++)ga(a,b[d],c);return c}function wa(a,b,c,d,e){for(var f,g=[],h=0,i=a.length,j=null!=b;h<i;h++)(f=a[h])&&(c&&!c(f,d,e)||(g.push(f),j&&b.push(h)));return g}function xa(a,b,c,d,e,f){return d&&!d[u]&&(d=xa(d)),e&&!e[u]&&(e=xa(e,f)),ia(function(f,g,h,i){var j,k,l,m=[],n=[],o=g.length,p=f||va(b||"*",h.nodeType?[h]:h,[]),q=!a||!f&&b?p:wa(p,m,a,h,i),r=c?e||(f?a:o||d)?[]:g:q;if(c&&c(q,r,h,i),d){j=wa(r,n),d(j,[],h,i),k=j.length;while(k--)(l=j[k])&&(r[n[k]]=!(q[n[k]]=l))}if(f){if(e||a){if(e){j=[],k=r.length;while(k--)(l=r[k])&&j.push(q[k]=l);e(null,r=[],j,i)}k=r.length;while(k--)(l=r[k])&&(j=e?I(f,l):m[k])>-1&&(f[j]=!(g[j]=l))}}else r=wa(r===g?r.splice(o,r.length):r),e?e(null,g,r,i):G.apply(g,r)})}function ya(a){for(var b,c,e,f=a.length,g=d.relative[a[0].type],h=g||d.relative[" "],i=g?1:0,k=ta(function(a){return a===b},h,!0),l=ta(function(a){return I(b,a)>-1},h,!0),m=[function(a,c,d){var e=!g&&(d||c!==j)||((b=c).nodeType?k(a,c,d):l(a,c,d));return b=null,e}];i<f;i++)if(c=d.relative[a[i].type])m=[ta(ua(m),c)];else{if(c=d.filter[a[i].type].apply(null,a[i].matches),c[u]){for(e=++i;e<f;e++)if(d.relative[a[e].type])break;return xa(i>1&&ua(m),i>1&&sa(a.slice(0,i-1).concat({value:" "===a[i-2].type?"*":""})).replace(P,"$1"),c,i<e&&ya(a.slice(i,e)),e<f&&ya(a=a.slice(e)),e<f&&sa(a))}m.push(c)}return ua(m)}function za(a,b){var c=b.length>0,e=a.length>0,f=function(f,g,h,i,k){var l,o,q,r=0,s="0",t=f&&[],u=[],v=j,x=f||e&&d.find.TAG("*",k),y=w+=null==v?1:Math.random()||.1,z=x.length;for(k&&(j=g===n||g||k);s!==z&&null!=(l=x[s]);s++){if(e&&l){o=0,g||l.ownerDocument===n||(m(l),h=!p);while(q=a[o++])if(q(l,g||n,h)){i.push(l);break}k&&(w=y)}c&&((l=!q&&l)&&r--,f&&t.push(l))}if(r+=s,c&&s!==r){o=0;while(q=b[o++])q(t,u,g,h);if(f){if(r>0)while(s--)t[s]||u[s]||(u[s]=E.call(i));u=wa(u)}G.apply(i,u),k&&!f&&u.length>0&&r+b.length>1&&ga.uniqueSort(i)}return k&&(w=y,j=v),t};return c?ia(f):f}return h=ga.compile=function(a,b){var c,d=[],e=[],f=A[a+" "];if(!f){b||(b=g(a)),c=b.length;while(c--)f=ya(b[c]),f[u]?d.push(f):e.push(f);f=A(a,za(e,d)),f.selector=a}return f},i=ga.select=function(a,b,c,e){var f,i,j,k,l,m="function"==typeof a&&a,n=!e&&g(a=m.selector||a);if(c=c||[],1===n.length){if(i=n[0]=n[0].slice(0),i.length>2&&"ID"===(j=i[0]).type&&9===b.nodeType&&p&&d.relative[i[1].type]){if(b=(d.find.ID(j.matches[0].replace(_,aa),b)||[])[0],!b)return c;m&&(b=b.parentNode),a=a.slice(i.shift().value.length)}f=V.needsContext.test(a)?0:i.length;while(f--){if(j=i[f],d.relative[k=j.type])break;if((l=d.find[k])&&(e=l(j.matches[0].replace(_,aa),$.test(i[0].type)&&qa(b.parentNode)||b))){if(i.splice(f,1),a=e.length&&sa(i),!a)return G.apply(c,e),c;break}}}return(m||h(a,n))(e,b,!p,c,!b||$.test(a)&&qa(b.parentNode)||b),c},c.sortStable=u.split("").sort(B).join("")===u,c.detectDuplicates=!!l,m(),c.sortDetached=ja(function(a){return 1&a.compareDocumentPosition(n.createElement("fieldset"))}),ja(function(a){return a.innerHTML="<a href='#'></a>","#"===a.firstChild.getAttribute("href")})||ka("type|href|height|width",function(a,b,c){if(!c)return a.getAttribute(b,"type"===b.toLowerCase()?1:2)}),c.attributes&&ja(function(a){return a.innerHTML="<input/>",a.firstChild.setAttribute("value",""),""===a.firstChild.getAttribute("value")})||ka("value",function(a,b,c){if(!c&&"input"===a.nodeName.toLowerCase())return a.defaultValue}),ja(function(a){return null==a.getAttribute("disabled")})||ka(J,function(a,b,c){var d;if(!c)return a[b]===!0?b.toLowerCase():(d=a.getAttributeNode(b))&&d.specified?d.value:null}),ga}(a);r.find=x,r.expr=x.selectors,r.expr[":"]=r.expr.pseudos,r.uniqueSort=r.unique=x.uniqueSort,r.text=x.getText,r.isXMLDoc=x.isXML,r.contains=x.contains,r.escapeSelector=x.escape;var y=function(a,b,c){var d=[],e=void 0!==c;while((a=a[b])&&9!==a.nodeType)if(1===a.nodeType){if(e&&r(a).is(c))break;d.push(a)}return d},z=function(a,b){for(var c=[];a;a=a.nextSibling)1===a.nodeType&&a!==b&&c.push(a);return c},A=r.expr.match.needsContext;function B(a,b){return a.nodeName&&a.nodeName.toLowerCase()===b.toLowerCase()}var C=/^<([a-z][^\/\0>:\x20\t\r\n\f]*)[\x20\t\r\n\f]*\/?>(?:<\/\1>|)$/i,D=/^.[^:#\[\.,]*$/;function E(a,b,c){return r.isFunction(b)?r.grep(a,function(a,d){return!!b.call(a,d,a)!==c}):b.nodeType?r.grep(a,function(a){return a===b!==c}):"string"!=typeof b?r.grep(a,function(a){return i.call(b,a)>-1!==c}):D.test(b)?r.filter(b,a,c):(b=r.filter(b,a),r.grep(a,function(a){return i.call(b,a)>-1!==c&&1===a.nodeType}))}r.filter=function(a,b,c){var d=b[0];return c&&(a=":not("+a+")"),1===b.length&&1===d.nodeType?r.find.matchesSelector(d,a)?[d]:[]:r.find.matches(a,r.grep(b,function(a){return 1===a.nodeType}))},r.fn.extend({find:function(a){var b,c,d=this.length,e=this;if("string"!=typeof a)return this.pushStack(r(a).filter(function(){for(b=0;b<d;b++)if(r.contains(e[b],this))return!0}));for(c=this.pushStack([]),b=0;b<d;b++)r.find(a,e[b],c);return d>1?r.uniqueSort(c):c},filter:function(a){return this.pushStack(E(this,a||[],!1))},not:function(a){return this.pushStack(E(this,a||[],!0))},is:function(a){return!!E(this,"string"==typeof a&&A.test(a)?r(a):a||[],!1).length}});var F,G=/^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]+))$/,H=r.fn.init=function(a,b,c){var e,f;if(!a)return this;if(c=c||F,"string"==typeof a){if(e="<"===a[0]&&">"===a[a.length-1]&&a.length>=3?[null,a,null]:G.exec(a),!e||!e[1]&&b)return!b||b.jquery?(b||c).find(a):this.constructor(b).find(a);if(e[1]){if(b=b instanceof r?b[0]:b,r.merge(this,r.parseHTML(e[1],b&&b.nodeType?b.ownerDocument||b:d,!0)),C.test(e[1])&&r.isPlainObject(b))for(e in b)r.isFunction(this[e])?this[e](b[e]):this.attr(e,b[e]);return this}return f=d.getElementById(e[2]),f&&(this[0]=f,this.length=1),this}return a.nodeType?(this[0]=a,this.length=1,this):r.isFunction(a)?void 0!==c.ready?c.ready(a):a(r):r.makeArray(a,this)};H.prototype=r.fn,F=r(d);var I=/^(?:parents|prev(?:Until|All))/,J={children:!0,contents:!0,next:!0,prev:!0};r.fn.extend({has:function(a){var b=r(a,this),c=b.length;return this.filter(function(){for(var a=0;a<c;a++)if(r.contains(this,b[a]))return!0})},closest:function(a,b){var c,d=0,e=this.length,f=[],g="string"!=typeof a&&r(a);if(!A.test(a))for(;d<e;d++)for(c=this[d];c&&c!==b;c=c.parentNode)if(c.nodeType<11&&(g?g.index(c)>-1:1===c.nodeType&&r.find.matchesSelector(c,a))){f.push(c);break}return this.pushStack(f.length>1?r.uniqueSort(f):f)},index:function(a){return a?"string"==typeof a?i.call(r(a),this[0]):i.call(this,a.jquery?a[0]:a):this[0]&&this[0].parentNode?this.first().prevAll().length:-1},add:function(a,b){return this.pushStack(r.uniqueSort(r.merge(this.get(),r(a,b))))},addBack:function(a){return this.add(null==a?this.prevObject:this.prevObject.filter(a))}});function K(a,b){while((a=a[b])&&1!==a.nodeType);return a}r.each({parent:function(a){var b=a.parentNode;return b&&11!==b.nodeType?b:null},parents:function(a){return y(a,"parentNode")},parentsUntil:function(a,b,c){return y(a,"parentNode",c)},next:function(a){return K(a,"nextSibling")},prev:function(a){return K(a,"previousSibling")},nextAll:function(a){return y(a,"nextSibling")},prevAll:function(a){return y(a,"previousSibling")},nextUntil:function(a,b,c){return y(a,"nextSibling",c)},prevUntil:function(a,b,c){return y(a,"previousSibling",c)},siblings:function(a){return z((a.parentNode||{}).firstChild,a)},children:function(a){return z(a.firstChild)},contents:function(a){return B(a,"iframe")?a.contentDocument:(B(a,"template")&&(a=a.content||a),r.merge([],a.childNodes))}},function(a,b){r.fn[a]=function(c,d){var e=r.map(this,b,c);return"Until"!==a.slice(-5)&&(d=c),d&&"string"==typeof d&&(e=r.filter(d,e)),this.length>1&&(J[a]||r.uniqueSort(e),I.test(a)&&e.reverse()),this.pushStack(e)}});var L=/[^\x20\t\r\n\f]+/g;function M(a){var b={};return r.each(a.match(L)||[],function(a,c){b[c]=!0}),b}r.Callbacks=function(a){a="string"==typeof a?M(a):r.extend({},a);var b,c,d,e,f=[],g=[],h=-1,i=function(){for(e=e||a.once,d=b=!0;g.length;h=-1){c=g.shift();while(++h<f.length)f[h].apply(c[0],c[1])===!1&&a.stopOnFalse&&(h=f.length,c=!1)}a.memory||(c=!1),b=!1,e&&(f=c?[]:"")},j={add:function(){return f&&(c&&!b&&(h=f.length-1,g.push(c)),function d(b){r.each(b,function(b,c){r.isFunction(c)?a.unique&&j.has(c)||f.push(c):c&&c.length&&"string"!==r.type(c)&&d(c)})}(arguments),c&&!b&&i()),this},remove:function(){return r.each(arguments,function(a,b){var c;while((c=r.inArray(b,f,c))>-1)f.splice(c,1),c<=h&&h--}),this},has:function(a){return a?r.inArray(a,f)>-1:f.length>0},empty:function(){return f&&(f=[]),this},disable:function(){return e=g=[],f=c="",this},disabled:function(){return!f},lock:function(){return e=g=[],c||b||(f=c=""),this},locked:function(){return!!e},fireWith:function(a,c){return e||(c=c||[],c=[a,c.slice?c.slice():c],g.push(c),b||i()),this},fire:function(){return j.fireWith(this,arguments),this},fired:function(){return!!d}};return j};function N(a){return a}function O(a){throw a}function P(a,b,c,d){var e;try{a&&r.isFunction(e=a.promise)?e.call(a).done(b).fail(c):a&&r.isFunction(e=a.then)?e.call(a,b,c):b.apply(void 0,[a].slice(d))}catch(a){c.apply(void 0,[a])}}r.extend({Deferred:function(b){var c=[["notify","progress",r.Callbacks("memory"),r.Callbacks("memory"),2],["resolve","done",r.Callbacks("once memory"),r.Callbacks("once memory"),0,"resolved"],["reject","fail",r.Callbacks("once memory"),r.Callbacks("once memory"),1,"rejected"]],d="pending",e={state:function(){return d},always:function(){return f.done(arguments).fail(arguments),this},"catch":function(a){return e.then(null,a)},pipe:function(){var a=arguments;return r.Deferred(function(b){r.each(c,function(c,d){var e=r.isFunction(a[d[4]])&&a[d[4]];f[d[1]](function(){var a=e&&e.apply(this,arguments);a&&r.isFunction(a.promise)?a.promise().progress(b.notify).done(b.resolve).fail(b.reject):b[d[0]+"With"](this,e?[a]:arguments)})}),a=null}).promise()},then:function(b,d,e){var f=0;function g(b,c,d,e){return function(){var h=this,i=arguments,j=function(){var a,j;if(!(b<f)){if(a=d.apply(h,i),a===c.promise())throw new TypeError("Thenable self-resolution");j=a&&("object"==typeof a||"function"==typeof a)&&a.then,r.isFunction(j)?e?j.call(a,g(f,c,N,e),g(f,c,O,e)):(f++,j.call(a,g(f,c,N,e),g(f,c,O,e),g(f,c,N,c.notifyWith))):(d!==N&&(h=void 0,i=[a]),(e||c.resolveWith)(h,i))}},k=e?j:function(){try{j()}catch(a){r.Deferred.exceptionHook&&r.Deferred.exceptionHook(a,k.stackTrace),b+1>=f&&(d!==O&&(h=void 0,i=[a]),c.rejectWith(h,i))}};b?k():(r.Deferred.getStackHook&&(k.stackTrace=r.Deferred.getStackHook()),a.setTimeout(k))}}return r.Deferred(function(a){c[0][3].add(g(0,a,r.isFunction(e)?e:N,a.notifyWith)),c[1][3].add(g(0,a,r.isFunction(b)?b:N)),c[2][3].add(g(0,a,r.isFunction(d)?d:O))}).promise()},promise:function(a){return null!=a?r.extend(a,e):e}},f={};return r.each(c,function(a,b){var g=b[2],h=b[5];e[b[1]]=g.add,h&&g.add(function(){d=h},c[3-a][2].disable,c[0][2].lock),g.add(b[3].fire),f[b[0]]=function(){return f[b[0]+"With"](this===f?void 0:this,arguments),this},f[b[0]+"With"]=g.fireWith}),e.promise(f),b&&b.call(f,f),f},when:function(a){var b=arguments.length,c=b,d=Array(c),e=f.call(arguments),g=r.Deferred(),h=function(a){return function(c){d[a]=this,e[a]=arguments.length>1?f.call(arguments):c,--b||g.resolveWith(d,e)}};if(b<=1&&(P(a,g.done(h(c)).resolve,g.reject,!b),"pending"===g.state()||r.isFunction(e[c]&&e[c].then)))return g.then();while(c--)P(e[c],h(c),g.reject);return g.promise()}});var Q=/^(Eval|Internal|Range|Reference|Syntax|Type|URI)Error$/;r.Deferred.exceptionHook=function(b,c){a.console&&a.console.warn&&b&&Q.test(b.name)&&a.console.warn("jQuery.Deferred exception: "+b.message,b.stack,c)},r.readyException=function(b){a.setTimeout(function(){throw b})};var R=r.Deferred();r.fn.ready=function(a){return R.then(a)["catch"](function(a){r.readyException(a)}),this},r.extend({isReady:!1,readyWait:1,ready:function(a){(a===!0?--r.readyWait:r.isReady)||(r.isReady=!0,a!==!0&&--r.readyWait>0||R.resolveWith(d,[r]))}}),r.ready.then=R.then;function S(){d.removeEventListener("DOMContentLoaded",S),
a.removeEventListener("load",S),r.ready()}"complete"===d.readyState||"loading"!==d.readyState&&!d.documentElement.doScroll?a.setTimeout(r.ready):(d.addEventListener("DOMContentLoaded",S),a.addEventListener("load",S));var T=function(a,b,c,d,e,f,g){var h=0,i=a.length,j=null==c;if("object"===r.type(c)){e=!0;for(h in c)T(a,b,h,c[h],!0,f,g)}else if(void 0!==d&&(e=!0,r.isFunction(d)||(g=!0),j&&(g?(b.call(a,d),b=null):(j=b,b=function(a,b,c){return j.call(r(a),c)})),b))for(;h<i;h++)b(a[h],c,g?d:d.call(a[h],h,b(a[h],c)));return e?a:j?b.call(a):i?b(a[0],c):f},U=function(a){return 1===a.nodeType||9===a.nodeType||!+a.nodeType};function V(){this.expando=r.expando+V.uid++}V.uid=1,V.prototype={cache:function(a){var b=a[this.expando];return b||(b={},U(a)&&(a.nodeType?a[this.expando]=b:Object.defineProperty(a,this.expando,{value:b,configurable:!0}))),b},set:function(a,b,c){var d,e=this.cache(a);if("string"==typeof b)e[r.camelCase(b)]=c;else for(d in b)e[r.camelCase(d)]=b[d];return e},get:function(a,b){return void 0===b?this.cache(a):a[this.expando]&&a[this.expando][r.camelCase(b)]},access:function(a,b,c){return void 0===b||b&&"string"==typeof b&&void 0===c?this.get(a,b):(this.set(a,b,c),void 0!==c?c:b)},remove:function(a,b){var c,d=a[this.expando];if(void 0!==d){if(void 0!==b){Array.isArray(b)?b=b.map(r.camelCase):(b=r.camelCase(b),b=b in d?[b]:b.match(L)||[]),c=b.length;while(c--)delete d[b[c]]}(void 0===b||r.isEmptyObject(d))&&(a.nodeType?a[this.expando]=void 0:delete a[this.expando])}},hasData:function(a){var b=a[this.expando];return void 0!==b&&!r.isEmptyObject(b)}};var W=new V,X=new V,Y=/^(?:\{[\w\W]*\}|\[[\w\W]*\])$/,Z=/[A-Z]/g;function $(a){return"true"===a||"false"!==a&&("null"===a?null:a===+a+""?+a:Y.test(a)?JSON.parse(a):a)}function _(a,b,c){var d;if(void 0===c&&1===a.nodeType)if(d="data-"+b.replace(Z,"-$&").toLowerCase(),c=a.getAttribute(d),"string"==typeof c){try{c=$(c)}catch(e){}X.set(a,b,c)}else c=void 0;return c}r.extend({hasData:function(a){return X.hasData(a)||W.hasData(a)},data:function(a,b,c){return X.access(a,b,c)},removeData:function(a,b){X.remove(a,b)},_data:function(a,b,c){return W.access(a,b,c)},_removeData:function(a,b){W.remove(a,b)}}),r.fn.extend({data:function(a,b){var c,d,e,f=this[0],g=f&&f.attributes;if(void 0===a){if(this.length&&(e=X.get(f),1===f.nodeType&&!W.get(f,"hasDataAttrs"))){c=g.length;while(c--)g[c]&&(d=g[c].name,0===d.indexOf("data-")&&(d=r.camelCase(d.slice(5)),_(f,d,e[d])));W.set(f,"hasDataAttrs",!0)}return e}return"object"==typeof a?this.each(function(){X.set(this,a)}):T(this,function(b){var c;if(f&&void 0===b){if(c=X.get(f,a),void 0!==c)return c;if(c=_(f,a),void 0!==c)return c}else this.each(function(){X.set(this,a,b)})},null,b,arguments.length>1,null,!0)},removeData:function(a){return this.each(function(){X.remove(this,a)})}}),r.extend({queue:function(a,b,c){var d;if(a)return b=(b||"fx")+"queue",d=W.get(a,b),c&&(!d||Array.isArray(c)?d=W.access(a,b,r.makeArray(c)):d.push(c)),d||[]},dequeue:function(a,b){b=b||"fx";var c=r.queue(a,b),d=c.length,e=c.shift(),f=r._queueHooks(a,b),g=function(){r.dequeue(a,b)};"inprogress"===e&&(e=c.shift(),d--),e&&("fx"===b&&c.unshift("inprogress"),delete f.stop,e.call(a,g,f)),!d&&f&&f.empty.fire()},_queueHooks:function(a,b){var c=b+"queueHooks";return W.get(a,c)||W.access(a,c,{empty:r.Callbacks("once memory").add(function(){W.remove(a,[b+"queue",c])})})}}),r.fn.extend({queue:function(a,b){var c=2;return"string"!=typeof a&&(b=a,a="fx",c--),arguments.length<c?r.queue(this[0],a):void 0===b?this:this.each(function(){var c=r.queue(this,a,b);r._queueHooks(this,a),"fx"===a&&"inprogress"!==c[0]&&r.dequeue(this,a)})},dequeue:function(a){return this.each(function(){r.dequeue(this,a)})},clearQueue:function(a){return this.queue(a||"fx",[])},promise:function(a,b){var c,d=1,e=r.Deferred(),f=this,g=this.length,h=function(){--d||e.resolveWith(f,[f])};"string"!=typeof a&&(b=a,a=void 0),a=a||"fx";while(g--)c=W.get(f[g],a+"queueHooks"),c&&c.empty&&(d++,c.empty.add(h));return h(),e.promise(b)}});var aa=/[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source,ba=new RegExp("^(?:([+-])=|)("+aa+")([a-z%]*)$","i"),ca=["Top","Right","Bottom","Left"],da=function(a,b){return a=b||a,"none"===a.style.display||""===a.style.display&&r.contains(a.ownerDocument,a)&&"none"===r.css(a,"display")},ea=function(a,b,c,d){var e,f,g={};for(f in b)g[f]=a.style[f],a.style[f]=b[f];e=c.apply(a,d||[]);for(f in b)a.style[f]=g[f];return e};function fa(a,b,c,d){var e,f=1,g=20,h=d?function(){return d.cur()}:function(){return r.css(a,b,"")},i=h(),j=c&&c[3]||(r.cssNumber[b]?"":"px"),k=(r.cssNumber[b]||"px"!==j&&+i)&&ba.exec(r.css(a,b));if(k&&k[3]!==j){j=j||k[3],c=c||[],k=+i||1;do f=f||".5",k/=f,r.style(a,b,k+j);while(f!==(f=h()/i)&&1!==f&&--g)}return c&&(k=+k||+i||0,e=c[1]?k+(c[1]+1)*c[2]:+c[2],d&&(d.unit=j,d.start=k,d.end=e)),e}var ga={};function ha(a){var b,c=a.ownerDocument,d=a.nodeName,e=ga[d];return e?e:(b=c.body.appendChild(c.createElement(d)),e=r.css(b,"display"),b.parentNode.removeChild(b),"none"===e&&(e="block"),ga[d]=e,e)}function ia(a,b){for(var c,d,e=[],f=0,g=a.length;f<g;f++)d=a[f],d.style&&(c=d.style.display,b?("none"===c&&(e[f]=W.get(d,"display")||null,e[f]||(d.style.display="")),""===d.style.display&&da(d)&&(e[f]=ha(d))):"none"!==c&&(e[f]="none",W.set(d,"display",c)));for(f=0;f<g;f++)null!=e[f]&&(a[f].style.display=e[f]);return a}r.fn.extend({show:function(){return ia(this,!0)},hide:function(){return ia(this)},toggle:function(a){return"boolean"==typeof a?a?this.show():this.hide():this.each(function(){da(this)?r(this).show():r(this).hide()})}});var ja=/^(?:checkbox|radio)$/i,ka=/<([a-z][^\/\0>\x20\t\r\n\f]+)/i,la=/^$|\/(?:java|ecma)script/i,ma={option:[1,"<select multiple='multiple'>","</select>"],thead:[1,"<table>","</table>"],col:[2,"<table><colgroup>","</colgroup></table>"],tr:[2,"<table><tbody>","</tbody></table>"],td:[3,"<table><tbody><tr>","</tr></tbody></table>"],_default:[0,"",""]};ma.optgroup=ma.option,ma.tbody=ma.tfoot=ma.colgroup=ma.caption=ma.thead,ma.th=ma.td;function na(a,b){var c;return c="undefined"!=typeof a.getElementsByTagName?a.getElementsByTagName(b||"*"):"undefined"!=typeof a.querySelectorAll?a.querySelectorAll(b||"*"):[],void 0===b||b&&B(a,b)?r.merge([a],c):c}function oa(a,b){for(var c=0,d=a.length;c<d;c++)W.set(a[c],"globalEval",!b||W.get(b[c],"globalEval"))}var pa=/<|&#?\w+;/;function qa(a,b,c,d,e){for(var f,g,h,i,j,k,l=b.createDocumentFragment(),m=[],n=0,o=a.length;n<o;n++)if(f=a[n],f||0===f)if("object"===r.type(f))r.merge(m,f.nodeType?[f]:f);else if(pa.test(f)){g=g||l.appendChild(b.createElement("div")),h=(ka.exec(f)||["",""])[1].toLowerCase(),i=ma[h]||ma._default,g.innerHTML=i[1]+r.htmlPrefilter(f)+i[2],k=i[0];while(k--)g=g.lastChild;r.merge(m,g.childNodes),g=l.firstChild,g.textContent=""}else m.push(b.createTextNode(f));l.textContent="",n=0;while(f=m[n++])if(d&&r.inArray(f,d)>-1)e&&e.push(f);else if(j=r.contains(f.ownerDocument,f),g=na(l.appendChild(f),"script"),j&&oa(g),c){k=0;while(f=g[k++])la.test(f.type||"")&&c.push(f)}return l}!function(){var a=d.createDocumentFragment(),b=a.appendChild(d.createElement("div")),c=d.createElement("input");c.setAttribute("type","radio"),c.setAttribute("checked","checked"),c.setAttribute("name","t"),b.appendChild(c),o.checkClone=b.cloneNode(!0).cloneNode(!0).lastChild.checked,b.innerHTML="<textarea>x</textarea>",o.noCloneChecked=!!b.cloneNode(!0).lastChild.defaultValue}();var ra=d.documentElement,sa=/^key/,ta=/^(?:mouse|pointer|contextmenu|drag|drop)|click/,ua=/^([^.]*)(?:\.(.+)|)/;function va(){return!0}function wa(){return!1}function xa(){try{return d.activeElement}catch(a){}}function ya(a,b,c,d,e,f){var g,h;if("object"==typeof b){"string"!=typeof c&&(d=d||c,c=void 0);for(h in b)ya(a,h,c,d,b[h],f);return a}if(null==d&&null==e?(e=c,d=c=void 0):null==e&&("string"==typeof c?(e=d,d=void 0):(e=d,d=c,c=void 0)),e===!1)e=wa;else if(!e)return a;return 1===f&&(g=e,e=function(a){return r().off(a),g.apply(this,arguments)},e.guid=g.guid||(g.guid=r.guid++)),a.each(function(){r.event.add(this,b,e,d,c)})}r.event={global:{},add:function(a,b,c,d,e){var f,g,h,i,j,k,l,m,n,o,p,q=W.get(a);if(q){c.handler&&(f=c,c=f.handler,e=f.selector),e&&r.find.matchesSelector(ra,e),c.guid||(c.guid=r.guid++),(i=q.events)||(i=q.events={}),(g=q.handle)||(g=q.handle=function(b){return"undefined"!=typeof r&&r.event.triggered!==b.type?r.event.dispatch.apply(a,arguments):void 0}),b=(b||"").match(L)||[""],j=b.length;while(j--)h=ua.exec(b[j])||[],n=p=h[1],o=(h[2]||"").split(".").sort(),n&&(l=r.event.special[n]||{},n=(e?l.delegateType:l.bindType)||n,l=r.event.special[n]||{},k=r.extend({type:n,origType:p,data:d,handler:c,guid:c.guid,selector:e,needsContext:e&&r.expr.match.needsContext.test(e),namespace:o.join(".")},f),(m=i[n])||(m=i[n]=[],m.delegateCount=0,l.setup&&l.setup.call(a,d,o,g)!==!1||a.addEventListener&&a.addEventListener(n,g)),l.add&&(l.add.call(a,k),k.handler.guid||(k.handler.guid=c.guid)),e?m.splice(m.delegateCount++,0,k):m.push(k),r.event.global[n]=!0)}},remove:function(a,b,c,d,e){var f,g,h,i,j,k,l,m,n,o,p,q=W.hasData(a)&&W.get(a);if(q&&(i=q.events)){b=(b||"").match(L)||[""],j=b.length;while(j--)if(h=ua.exec(b[j])||[],n=p=h[1],o=(h[2]||"").split(".").sort(),n){l=r.event.special[n]||{},n=(d?l.delegateType:l.bindType)||n,m=i[n]||[],h=h[2]&&new RegExp("(^|\\.)"+o.join("\\.(?:.*\\.|)")+"(\\.|$)"),g=f=m.length;while(f--)k=m[f],!e&&p!==k.origType||c&&c.guid!==k.guid||h&&!h.test(k.namespace)||d&&d!==k.selector&&("**"!==d||!k.selector)||(m.splice(f,1),k.selector&&m.delegateCount--,l.remove&&l.remove.call(a,k));g&&!m.length&&(l.teardown&&l.teardown.call(a,o,q.handle)!==!1||r.removeEvent(a,n,q.handle),delete i[n])}else for(n in i)r.event.remove(a,n+b[j],c,d,!0);r.isEmptyObject(i)&&W.remove(a,"handle events")}},dispatch:function(a){var b=r.event.fix(a),c,d,e,f,g,h,i=new Array(arguments.length),j=(W.get(this,"events")||{})[b.type]||[],k=r.event.special[b.type]||{};for(i[0]=b,c=1;c<arguments.length;c++)i[c]=arguments[c];if(b.delegateTarget=this,!k.preDispatch||k.preDispatch.call(this,b)!==!1){h=r.event.handlers.call(this,b,j),c=0;while((f=h[c++])&&!b.isPropagationStopped()){b.currentTarget=f.elem,d=0;while((g=f.handlers[d++])&&!b.isImmediatePropagationStopped())b.rnamespace&&!b.rnamespace.test(g.namespace)||(b.handleObj=g,b.data=g.data,e=((r.event.special[g.origType]||{}).handle||g.handler).apply(f.elem,i),void 0!==e&&(b.result=e)===!1&&(b.preventDefault(),b.stopPropagation()))}return k.postDispatch&&k.postDispatch.call(this,b),b.result}},handlers:function(a,b){var c,d,e,f,g,h=[],i=b.delegateCount,j=a.target;if(i&&j.nodeType&&!("click"===a.type&&a.button>=1))for(;j!==this;j=j.parentNode||this)if(1===j.nodeType&&("click"!==a.type||j.disabled!==!0)){for(f=[],g={},c=0;c<i;c++)d=b[c],e=d.selector+" ",void 0===g[e]&&(g[e]=d.needsContext?r(e,this).index(j)>-1:r.find(e,this,null,[j]).length),g[e]&&f.push(d);f.length&&h.push({elem:j,handlers:f})}return j=this,i<b.length&&h.push({elem:j,handlers:b.slice(i)}),h},addProp:function(a,b){Object.defineProperty(r.Event.prototype,a,{enumerable:!0,configurable:!0,get:r.isFunction(b)?function(){if(this.originalEvent)return b(this.originalEvent)}:function(){if(this.originalEvent)return this.originalEvent[a]},set:function(b){Object.defineProperty(this,a,{enumerable:!0,configurable:!0,writable:!0,value:b})}})},fix:function(a){return a[r.expando]?a:new r.Event(a)},special:{load:{noBubble:!0},focus:{trigger:function(){if(this!==xa()&&this.focus)return this.focus(),!1},delegateType:"focusin"},blur:{trigger:function(){if(this===xa()&&this.blur)return this.blur(),!1},delegateType:"focusout"},click:{trigger:function(){if("checkbox"===this.type&&this.click&&B(this,"input"))return this.click(),!1},_default:function(a){return B(a.target,"a")}},beforeunload:{postDispatch:function(a){void 0!==a.result&&a.originalEvent&&(a.originalEvent.returnValue=a.result)}}}},r.removeEvent=function(a,b,c){a.removeEventListener&&a.removeEventListener(b,c)},r.Event=function(a,b){return this instanceof r.Event?(a&&a.type?(this.originalEvent=a,this.type=a.type,this.isDefaultPrevented=a.defaultPrevented||void 0===a.defaultPrevented&&a.returnValue===!1?va:wa,this.target=a.target&&3===a.target.nodeType?a.target.parentNode:a.target,this.currentTarget=a.currentTarget,this.relatedTarget=a.relatedTarget):this.type=a,b&&r.extend(this,b),this.timeStamp=a&&a.timeStamp||r.now(),void(this[r.expando]=!0)):new r.Event(a,b)},r.Event.prototype={constructor:r.Event,isDefaultPrevented:wa,isPropagationStopped:wa,isImmediatePropagationStopped:wa,isSimulated:!1,preventDefault:function(){var a=this.originalEvent;this.isDefaultPrevented=va,a&&!this.isSimulated&&a.preventDefault()},stopPropagation:function(){var a=this.originalEvent;this.isPropagationStopped=va,a&&!this.isSimulated&&a.stopPropagation()},stopImmediatePropagation:function(){var a=this.originalEvent;this.isImmediatePropagationStopped=va,a&&!this.isSimulated&&a.stopImmediatePropagation(),this.stopPropagation()}},r.each({altKey:!0,bubbles:!0,cancelable:!0,changedTouches:!0,ctrlKey:!0,detail:!0,eventPhase:!0,metaKey:!0,pageX:!0,pageY:!0,shiftKey:!0,view:!0,"char":!0,charCode:!0,key:!0,keyCode:!0,button:!0,buttons:!0,clientX:!0,clientY:!0,offsetX:!0,offsetY:!0,pointerId:!0,pointerType:!0,screenX:!0,screenY:!0,targetTouches:!0,toElement:!0,touches:!0,which:function(a){var b=a.button;return null==a.which&&sa.test(a.type)?null!=a.charCode?a.charCode:a.keyCode:!a.which&&void 0!==b&&ta.test(a.type)?1&b?1:2&b?3:4&b?2:0:a.which}},r.event.addProp),r.each({mouseenter:"mouseover",mouseleave:"mouseout",pointerenter:"pointerover",pointerleave:"pointerout"},function(a,b){r.event.special[a]={delegateType:b,bindType:b,handle:function(a){var c,d=this,e=a.relatedTarget,f=a.handleObj;return e&&(e===d||r.contains(d,e))||(a.type=f.origType,c=f.handler.apply(this,arguments),a.type=b),c}}}),r.fn.extend({on:function(a,b,c,d){return ya(this,a,b,c,d)},one:function(a,b,c,d){return ya(this,a,b,c,d,1)},off:function(a,b,c){var d,e;if(a&&a.preventDefault&&a.handleObj)return d=a.handleObj,r(a.delegateTarget).off(d.namespace?d.origType+"."+d.namespace:d.origType,d.selector,d.handler),this;if("object"==typeof a){for(e in a)this.off(e,b,a[e]);return this}return b!==!1&&"function"!=typeof b||(c=b,b=void 0),c===!1&&(c=wa),this.each(function(){r.event.remove(this,a,c,b)})}});var za=/<(?!area|br|col|embed|hr|img|input|link|meta|param)(([a-z][^\/\0>\x20\t\r\n\f]*)[^>]*)\/>/gi,Aa=/<script|<style|<link/i,Ba=/checked\s*(?:[^=]|=\s*.checked.)/i,Ca=/^true\/(.*)/,Da=/^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g;function Ea(a,b){return B(a,"table")&&B(11!==b.nodeType?b:b.firstChild,"tr")?r(">tbody",a)[0]||a:a}function Fa(a){return a.type=(null!==a.getAttribute("type"))+"/"+a.type,a}function Ga(a){var b=Ca.exec(a.type);return b?a.type=b[1]:a.removeAttribute("type"),a}function Ha(a,b){var c,d,e,f,g,h,i,j;if(1===b.nodeType){if(W.hasData(a)&&(f=W.access(a),g=W.set(b,f),j=f.events)){delete g.handle,g.events={};for(e in j)for(c=0,d=j[e].length;c<d;c++)r.event.add(b,e,j[e][c])}X.hasData(a)&&(h=X.access(a),i=r.extend({},h),X.set(b,i))}}function Ia(a,b){var c=b.nodeName.toLowerCase();"input"===c&&ja.test(a.type)?b.checked=a.checked:"input"!==c&&"textarea"!==c||(b.defaultValue=a.defaultValue)}function Ja(a,b,c,d){b=g.apply([],b);var e,f,h,i,j,k,l=0,m=a.length,n=m-1,q=b[0],s=r.isFunction(q);if(s||m>1&&"string"==typeof q&&!o.checkClone&&Ba.test(q))return a.each(function(e){var f=a.eq(e);s&&(b[0]=q.call(this,e,f.html())),Ja(f,b,c,d)});if(m&&(e=qa(b,a[0].ownerDocument,!1,a,d),f=e.firstChild,1===e.childNodes.length&&(e=f),f||d)){for(h=r.map(na(e,"script"),Fa),i=h.length;l<m;l++)j=e,l!==n&&(j=r.clone(j,!0,!0),i&&r.merge(h,na(j,"script"))),c.call(a[l],j,l);if(i)for(k=h[h.length-1].ownerDocument,r.map(h,Ga),l=0;l<i;l++)j=h[l],la.test(j.type||"")&&!W.access(j,"globalEval")&&r.contains(k,j)&&(j.src?r._evalUrl&&r._evalUrl(j.src):p(j.textContent.replace(Da,""),k))}return a}function Ka(a,b,c){for(var d,e=b?r.filter(b,a):a,f=0;null!=(d=e[f]);f++)c||1!==d.nodeType||r.cleanData(na(d)),d.parentNode&&(c&&r.contains(d.ownerDocument,d)&&oa(na(d,"script")),d.parentNode.removeChild(d));return a}r.extend({htmlPrefilter:function(a){return a.replace(za,"<$1></$2>")},clone:function(a,b,c){var d,e,f,g,h=a.cloneNode(!0),i=r.contains(a.ownerDocument,a);if(!(o.noCloneChecked||1!==a.nodeType&&11!==a.nodeType||r.isXMLDoc(a)))for(g=na(h),f=na(a),d=0,e=f.length;d<e;d++)Ia(f[d],g[d]);if(b)if(c)for(f=f||na(a),g=g||na(h),d=0,e=f.length;d<e;d++)Ha(f[d],g[d]);else Ha(a,h);return g=na(h,"script"),g.length>0&&oa(g,!i&&na(a,"script")),h},cleanData:function(a){for(var b,c,d,e=r.event.special,f=0;void 0!==(c=a[f]);f++)if(U(c)){if(b=c[W.expando]){if(b.events)for(d in b.events)e[d]?r.event.remove(c,d):r.removeEvent(c,d,b.handle);c[W.expando]=void 0}c[X.expando]&&(c[X.expando]=void 0)}}}),r.fn.extend({detach:function(a){return Ka(this,a,!0)},remove:function(a){return Ka(this,a)},text:function(a){return T(this,function(a){return void 0===a?r.text(this):this.empty().each(function(){1!==this.nodeType&&11!==this.nodeType&&9!==this.nodeType||(this.textContent=a)})},null,a,arguments.length)},append:function(){return Ja(this,arguments,function(a){if(1===this.nodeType||11===this.nodeType||9===this.nodeType){var b=Ea(this,a);b.appendChild(a)}})},prepend:function(){return Ja(this,arguments,function(a){if(1===this.nodeType||11===this.nodeType||9===this.nodeType){var b=Ea(this,a);b.insertBefore(a,b.firstChild)}})},before:function(){return Ja(this,arguments,function(a){this.parentNode&&this.parentNode.insertBefore(a,this)})},after:function(){return Ja(this,arguments,function(a){this.parentNode&&this.parentNode.insertBefore(a,this.nextSibling)})},empty:function(){for(var a,b=0;null!=(a=this[b]);b++)1===a.nodeType&&(r.cleanData(na(a,!1)),a.textContent="");return this},clone:function(a,b){return a=null!=a&&a,b=null==b?a:b,this.map(function(){return r.clone(this,a,b)})},html:function(a){return T(this,function(a){var b=this[0]||{},c=0,d=this.length;if(void 0===a&&1===b.nodeType)return b.innerHTML;if("string"==typeof a&&!Aa.test(a)&&!ma[(ka.exec(a)||["",""])[1].toLowerCase()]){a=r.htmlPrefilter(a);try{for(;c<d;c++)b=this[c]||{},1===b.nodeType&&(r.cleanData(na(b,!1)),b.innerHTML=a);b=0}catch(e){}}b&&this.empty().append(a)},null,a,arguments.length)},replaceWith:function(){var a=[];return Ja(this,arguments,function(b){var c=this.parentNode;r.inArray(this,a)<0&&(r.cleanData(na(this)),c&&c.replaceChild(b,this))},a)}}),r.each({appendTo:"append",prependTo:"prepend",insertBefore:"before",insertAfter:"after",replaceAll:"replaceWith"},function(a,b){r.fn[a]=function(a){for(var c,d=[],e=r(a),f=e.length-1,g=0;g<=f;g++)c=g===f?this:this.clone(!0),r(e[g])[b](c),h.apply(d,c.get());return this.pushStack(d)}});var La=/^margin/,Ma=new RegExp("^("+aa+")(?!px)[a-z%]+$","i"),Na=function(b){var c=b.ownerDocument.defaultView;return c&&c.opener||(c=a),c.getComputedStyle(b)};!function(){function b(){if(i){i.style.cssText="box-sizing:border-box;position:relative;display:block;margin:auto;border:1px;padding:1px;top:1%;width:50%",i.innerHTML="",ra.appendChild(h);var b=a.getComputedStyle(i);c="1%"!==b.top,g="2px"===b.marginLeft,e="4px"===b.width,i.style.marginRight="50%",f="4px"===b.marginRight,ra.removeChild(h),i=null}}var c,e,f,g,h=d.createElement("div"),i=d.createElement("div");i.style&&(i.style.backgroundClip="content-box",i.cloneNode(!0).style.backgroundClip="",o.clearCloneStyle="content-box"===i.style.backgroundClip,h.style.cssText="border:0;width:8px;height:0;top:0;left:-9999px;padding:0;margin-top:1px;position:absolute",h.appendChild(i),r.extend(o,{pixelPosition:function(){return b(),c},boxSizingReliable:function(){return b(),e},pixelMarginRight:function(){return b(),f},reliableMarginLeft:function(){return b(),g}}))}();function Oa(a,b,c){var d,e,f,g,h=a.style;return c=c||Na(a),c&&(g=c.getPropertyValue(b)||c[b],""!==g||r.contains(a.ownerDocument,a)||(g=r.style(a,b)),!o.pixelMarginRight()&&Ma.test(g)&&La.test(b)&&(d=h.width,e=h.minWidth,f=h.maxWidth,h.minWidth=h.maxWidth=h.width=g,g=c.width,h.width=d,h.minWidth=e,h.maxWidth=f)),void 0!==g?g+"":g}function Pa(a,b){return{get:function(){return a()?void delete this.get:(this.get=b).apply(this,arguments)}}}var Qa=/^(none|table(?!-c[ea]).+)/,Ra=/^--/,Sa={position:"absolute",visibility:"hidden",display:"block"},Ta={letterSpacing:"0",fontWeight:"400"},Ua=["Webkit","Moz","ms"],Va=d.createElement("div").style;function Wa(a){if(a in Va)return a;var b=a[0].toUpperCase()+a.slice(1),c=Ua.length;while(c--)if(a=Ua[c]+b,a in Va)return a}function Xa(a){var b=r.cssProps[a];return b||(b=r.cssProps[a]=Wa(a)||a),b}function Ya(a,b,c){var d=ba.exec(b);return d?Math.max(0,d[2]-(c||0))+(d[3]||"px"):b}function Za(a,b,c,d,e){var f,g=0;for(f=c===(d?"border":"content")?4:"width"===b?1:0;f<4;f+=2)"margin"===c&&(g+=r.css(a,c+ca[f],!0,e)),d?("content"===c&&(g-=r.css(a,"padding"+ca[f],!0,e)),"margin"!==c&&(g-=r.css(a,"border"+ca[f]+"Width",!0,e))):(g+=r.css(a,"padding"+ca[f],!0,e),"padding"!==c&&(g+=r.css(a,"border"+ca[f]+"Width",!0,e)));return g}function $a(a,b,c){var d,e=Na(a),f=Oa(a,b,e),g="border-box"===r.css(a,"boxSizing",!1,e);return Ma.test(f)?f:(d=g&&(o.boxSizingReliable()||f===a.style[b]),"auto"===f&&(f=a["offset"+b[0].toUpperCase()+b.slice(1)]),f=parseFloat(f)||0,f+Za(a,b,c||(g?"border":"content"),d,e)+"px")}r.extend({cssHooks:{opacity:{get:function(a,b){if(b){var c=Oa(a,"opacity");return""===c?"1":c}}}},cssNumber:{animationIterationCount:!0,columnCount:!0,fillOpacity:!0,flexGrow:!0,flexShrink:!0,fontWeight:!0,lineHeight:!0,opacity:!0,order:!0,orphans:!0,widows:!0,zIndex:!0,zoom:!0},cssProps:{"float":"cssFloat"},style:function(a,b,c,d){if(a&&3!==a.nodeType&&8!==a.nodeType&&a.style){var e,f,g,h=r.camelCase(b),i=Ra.test(b),j=a.style;return i||(b=Xa(h)),g=r.cssHooks[b]||r.cssHooks[h],void 0===c?g&&"get"in g&&void 0!==(e=g.get(a,!1,d))?e:j[b]:(f=typeof c,"string"===f&&(e=ba.exec(c))&&e[1]&&(c=fa(a,b,e),f="number"),null!=c&&c===c&&("number"===f&&(c+=e&&e[3]||(r.cssNumber[h]?"":"px")),o.clearCloneStyle||""!==c||0!==b.indexOf("background")||(j[b]="inherit"),g&&"set"in g&&void 0===(c=g.set(a,c,d))||(i?j.setProperty(b,c):j[b]=c)),void 0)}},css:function(a,b,c,d){var e,f,g,h=r.camelCase(b),i=Ra.test(b);return i||(b=Xa(h)),g=r.cssHooks[b]||r.cssHooks[h],g&&"get"in g&&(e=g.get(a,!0,c)),void 0===e&&(e=Oa(a,b,d)),"normal"===e&&b in Ta&&(e=Ta[b]),""===c||c?(f=parseFloat(e),c===!0||isFinite(f)?f||0:e):e}}),r.each(["height","width"],function(a,b){r.cssHooks[b]={get:function(a,c,d){if(c)return!Qa.test(r.css(a,"display"))||a.getClientRects().length&&a.getBoundingClientRect().width?$a(a,b,d):ea(a,Sa,function(){return $a(a,b,d)})},set:function(a,c,d){var e,f=d&&Na(a),g=d&&Za(a,b,d,"border-box"===r.css(a,"boxSizing",!1,f),f);return g&&(e=ba.exec(c))&&"px"!==(e[3]||"px")&&(a.style[b]=c,c=r.css(a,b)),Ya(a,c,g)}}}),r.cssHooks.marginLeft=Pa(o.reliableMarginLeft,function(a,b){if(b)return(parseFloat(Oa(a,"marginLeft"))||a.getBoundingClientRect().left-ea(a,{marginLeft:0},function(){return a.getBoundingClientRect().left}))+"px"}),r.each({margin:"",padding:"",border:"Width"},function(a,b){r.cssHooks[a+b]={expand:function(c){for(var d=0,e={},f="string"==typeof c?c.split(" "):[c];d<4;d++)e[a+ca[d]+b]=f[d]||f[d-2]||f[0];return e}},La.test(a)||(r.cssHooks[a+b].set=Ya)}),r.fn.extend({css:function(a,b){return T(this,function(a,b,c){var d,e,f={},g=0;if(Array.isArray(b)){for(d=Na(a),e=b.length;g<e;g++)f[b[g]]=r.css(a,b[g],!1,d);return f}return void 0!==c?r.style(a,b,c):r.css(a,b)},a,b,arguments.length>1)}});function _a(a,b,c,d,e){return new _a.prototype.init(a,b,c,d,e)}r.Tween=_a,_a.prototype={constructor:_a,init:function(a,b,c,d,e,f){this.elem=a,this.prop=c,this.easing=e||r.easing._default,this.options=b,this.start=this.now=this.cur(),this.end=d,this.unit=f||(r.cssNumber[c]?"":"px")},cur:function(){var a=_a.propHooks[this.prop];return a&&a.get?a.get(this):_a.propHooks._default.get(this)},run:function(a){var b,c=_a.propHooks[this.prop];return this.options.duration?this.pos=b=r.easing[this.easing](a,this.options.duration*a,0,1,this.options.duration):this.pos=b=a,this.now=(this.end-this.start)*b+this.start,this.options.step&&this.options.step.call(this.elem,this.now,this),c&&c.set?c.set(this):_a.propHooks._default.set(this),this}},_a.prototype.init.prototype=_a.prototype,_a.propHooks={_default:{get:function(a){var b;return 1!==a.elem.nodeType||null!=a.elem[a.prop]&&null==a.elem.style[a.prop]?a.elem[a.prop]:(b=r.css(a.elem,a.prop,""),b&&"auto"!==b?b:0)},set:function(a){r.fx.step[a.prop]?r.fx.step[a.prop](a):1!==a.elem.nodeType||null==a.elem.style[r.cssProps[a.prop]]&&!r.cssHooks[a.prop]?a.elem[a.prop]=a.now:r.style(a.elem,a.prop,a.now+a.unit)}}},_a.propHooks.scrollTop=_a.propHooks.scrollLeft={set:function(a){a.elem.nodeType&&a.elem.parentNode&&(a.elem[a.prop]=a.now)}},r.easing={linear:function(a){return a},swing:function(a){return.5-Math.cos(a*Math.PI)/2},_default:"swing"},r.fx=_a.prototype.init,r.fx.step={};var ab,bb,cb=/^(?:toggle|show|hide)$/,db=/queueHooks$/;function eb(){bb&&(d.hidden===!1&&a.requestAnimationFrame?a.requestAnimationFrame(eb):a.setTimeout(eb,r.fx.interval),r.fx.tick())}function fb(){return a.setTimeout(function(){ab=void 0}),ab=r.now()}function gb(a,b){var c,d=0,e={height:a};for(b=b?1:0;d<4;d+=2-b)c=ca[d],e["margin"+c]=e["padding"+c]=a;return b&&(e.opacity=e.width=a),e}function hb(a,b,c){for(var d,e=(kb.tweeners[b]||[]).concat(kb.tweeners["*"]),f=0,g=e.length;f<g;f++)if(d=e[f].call(c,b,a))return d}function ib(a,b,c){var d,e,f,g,h,i,j,k,l="width"in b||"height"in b,m=this,n={},o=a.style,p=a.nodeType&&da(a),q=W.get(a,"fxshow");c.queue||(g=r._queueHooks(a,"fx"),null==g.unqueued&&(g.unqueued=0,h=g.empty.fire,g.empty.fire=function(){g.unqueued||h()}),g.unqueued++,m.always(function(){m.always(function(){g.unqueued--,r.queue(a,"fx").length||g.empty.fire()})}));for(d in b)if(e=b[d],cb.test(e)){if(delete b[d],f=f||"toggle"===e,e===(p?"hide":"show")){if("show"!==e||!q||void 0===q[d])continue;p=!0}n[d]=q&&q[d]||r.style(a,d)}if(i=!r.isEmptyObject(b),i||!r.isEmptyObject(n)){l&&1===a.nodeType&&(c.overflow=[o.overflow,o.overflowX,o.overflowY],j=q&&q.display,null==j&&(j=W.get(a,"display")),k=r.css(a,"display"),"none"===k&&(j?k=j:(ia([a],!0),j=a.style.display||j,k=r.css(a,"display"),ia([a]))),("inline"===k||"inline-block"===k&&null!=j)&&"none"===r.css(a,"float")&&(i||(m.done(function(){o.display=j}),null==j&&(k=o.display,j="none"===k?"":k)),o.display="inline-block")),c.overflow&&(o.overflow="hidden",m.always(function(){o.overflow=c.overflow[0],o.overflowX=c.overflow[1],o.overflowY=c.overflow[2]})),i=!1;for(d in n)i||(q?"hidden"in q&&(p=q.hidden):q=W.access(a,"fxshow",{display:j}),f&&(q.hidden=!p),p&&ia([a],!0),m.done(function(){p||ia([a]),W.remove(a,"fxshow");for(d in n)r.style(a,d,n[d])})),i=hb(p?q[d]:0,d,m),d in q||(q[d]=i.start,p&&(i.end=i.start,i.start=0))}}function jb(a,b){var c,d,e,f,g;for(c in a)if(d=r.camelCase(c),e=b[d],f=a[c],Array.isArray(f)&&(e=f[1],f=a[c]=f[0]),c!==d&&(a[d]=f,delete a[c]),g=r.cssHooks[d],g&&"expand"in g){f=g.expand(f),delete a[d];for(c in f)c in a||(a[c]=f[c],b[c]=e)}else b[d]=e}function kb(a,b,c){var d,e,f=0,g=kb.prefilters.length,h=r.Deferred().always(function(){delete i.elem}),i=function(){if(e)return!1;for(var b=ab||fb(),c=Math.max(0,j.startTime+j.duration-b),d=c/j.duration||0,f=1-d,g=0,i=j.tweens.length;g<i;g++)j.tweens[g].run(f);return h.notifyWith(a,[j,f,c]),f<1&&i?c:(i||h.notifyWith(a,[j,1,0]),h.resolveWith(a,[j]),!1)},j=h.promise({elem:a,props:r.extend({},b),opts:r.extend(!0,{specialEasing:{},easing:r.easing._default},c),originalProperties:b,originalOptions:c,startTime:ab||fb(),duration:c.duration,tweens:[],createTween:function(b,c){var d=r.Tween(a,j.opts,b,c,j.opts.specialEasing[b]||j.opts.easing);return j.tweens.push(d),d},stop:function(b){var c=0,d=b?j.tweens.length:0;if(e)return this;for(e=!0;c<d;c++)j.tweens[c].run(1);return b?(h.notifyWith(a,[j,1,0]),h.resolveWith(a,[j,b])):h.rejectWith(a,[j,b]),this}}),k=j.props;for(jb(k,j.opts.specialEasing);f<g;f++)if(d=kb.prefilters[f].call(j,a,k,j.opts))return r.isFunction(d.stop)&&(r._queueHooks(j.elem,j.opts.queue).stop=r.proxy(d.stop,d)),d;return r.map(k,hb,j),r.isFunction(j.opts.start)&&j.opts.start.call(a,j),j.progress(j.opts.progress).done(j.opts.done,j.opts.complete).fail(j.opts.fail).always(j.opts.always),r.fx.timer(r.extend(i,{elem:a,anim:j,queue:j.opts.queue})),j}r.Animation=r.extend(kb,{tweeners:{"*":[function(a,b){var c=this.createTween(a,b);return fa(c.elem,a,ba.exec(b),c),c}]},tweener:function(a,b){r.isFunction(a)?(b=a,a=["*"]):a=a.match(L);for(var c,d=0,e=a.length;d<e;d++)c=a[d],kb.tweeners[c]=kb.tweeners[c]||[],kb.tweeners[c].unshift(b)},prefilters:[ib],prefilter:function(a,b){b?kb.prefilters.unshift(a):kb.prefilters.push(a)}}),r.speed=function(a,b,c){var d=a&&"object"==typeof a?r.extend({},a):{complete:c||!c&&b||r.isFunction(a)&&a,duration:a,easing:c&&b||b&&!r.isFunction(b)&&b};return r.fx.off?d.duration=0:"number"!=typeof d.duration&&(d.duration in r.fx.speeds?d.duration=r.fx.speeds[d.duration]:d.duration=r.fx.speeds._default),null!=d.queue&&d.queue!==!0||(d.queue="fx"),d.old=d.complete,d.complete=function(){r.isFunction(d.old)&&d.old.call(this),d.queue&&r.dequeue(this,d.queue)},d},r.fn.extend({fadeTo:function(a,b,c,d){return this.filter(da).css("opacity",0).show().end().animate({opacity:b},a,c,d)},animate:function(a,b,c,d){var e=r.isEmptyObject(a),f=r.speed(b,c,d),g=function(){var b=kb(this,r.extend({},a),f);(e||W.get(this,"finish"))&&b.stop(!0)};return g.finish=g,e||f.queue===!1?this.each(g):this.queue(f.queue,g)},stop:function(a,b,c){var d=function(a){var b=a.stop;delete a.stop,b(c)};return"string"!=typeof a&&(c=b,b=a,a=void 0),b&&a!==!1&&this.queue(a||"fx",[]),this.each(function(){var b=!0,e=null!=a&&a+"queueHooks",f=r.timers,g=W.get(this);if(e)g[e]&&g[e].stop&&d(g[e]);else for(e in g)g[e]&&g[e].stop&&db.test(e)&&d(g[e]);for(e=f.length;e--;)f[e].elem!==this||null!=a&&f[e].queue!==a||(f[e].anim.stop(c),b=!1,f.splice(e,1));!b&&c||r.dequeue(this,a)})},finish:function(a){return a!==!1&&(a=a||"fx"),this.each(function(){var b,c=W.get(this),d=c[a+"queue"],e=c[a+"queueHooks"],f=r.timers,g=d?d.length:0;for(c.finish=!0,r.queue(this,a,[]),e&&e.stop&&e.stop.call(this,!0),b=f.length;b--;)f[b].elem===this&&f[b].queue===a&&(f[b].anim.stop(!0),f.splice(b,1));for(b=0;b<g;b++)d[b]&&d[b].finish&&d[b].finish.call(this);delete c.finish})}}),r.each(["toggle","show","hide"],function(a,b){var c=r.fn[b];r.fn[b]=function(a,d,e){return null==a||"boolean"==typeof a?c.apply(this,arguments):this.animate(gb(b,!0),a,d,e)}}),r.each({slideDown:gb("show"),slideUp:gb("hide"),slideToggle:gb("toggle"),fadeIn:{opacity:"show"},fadeOut:{opacity:"hide"},fadeToggle:{opacity:"toggle"}},function(a,b){r.fn[a]=function(a,c,d){return this.animate(b,a,c,d)}}),r.timers=[],r.fx.tick=function(){var a,b=0,c=r.timers;for(ab=r.now();b<c.length;b++)a=c[b],a()||c[b]!==a||c.splice(b--,1);c.length||r.fx.stop(),ab=void 0},r.fx.timer=function(a){r.timers.push(a),r.fx.start()},r.fx.interval=13,r.fx.start=function(){bb||(bb=!0,eb())},r.fx.stop=function(){bb=null},r.fx.speeds={slow:600,fast:200,_default:400},r.fn.delay=function(b,c){return b=r.fx?r.fx.speeds[b]||b:b,c=c||"fx",this.queue(c,function(c,d){var e=a.setTimeout(c,b);d.stop=function(){a.clearTimeout(e)}})},function(){var a=d.createElement("input"),b=d.createElement("select"),c=b.appendChild(d.createElement("option"));a.type="checkbox",o.checkOn=""!==a.value,o.optSelected=c.selected,a=d.createElement("input"),a.value="t",a.type="radio",o.radioValue="t"===a.value}();var lb,mb=r.expr.attrHandle;r.fn.extend({attr:function(a,b){return T(this,r.attr,a,b,arguments.length>1)},removeAttr:function(a){return this.each(function(){r.removeAttr(this,a)})}}),r.extend({attr:function(a,b,c){var d,e,f=a.nodeType;if(3!==f&&8!==f&&2!==f)return"undefined"==typeof a.getAttribute?r.prop(a,b,c):(1===f&&r.isXMLDoc(a)||(e=r.attrHooks[b.toLowerCase()]||(r.expr.match.bool.test(b)?lb:void 0)),void 0!==c?null===c?void r.removeAttr(a,b):e&&"set"in e&&void 0!==(d=e.set(a,c,b))?d:(a.setAttribute(b,c+""),c):e&&"get"in e&&null!==(d=e.get(a,b))?d:(d=r.find.attr(a,b),
null==d?void 0:d))},attrHooks:{type:{set:function(a,b){if(!o.radioValue&&"radio"===b&&B(a,"input")){var c=a.value;return a.setAttribute("type",b),c&&(a.value=c),b}}}},removeAttr:function(a,b){var c,d=0,e=b&&b.match(L);if(e&&1===a.nodeType)while(c=e[d++])a.removeAttribute(c)}}),lb={set:function(a,b,c){return b===!1?r.removeAttr(a,c):a.setAttribute(c,c),c}},r.each(r.expr.match.bool.source.match(/\w+/g),function(a,b){var c=mb[b]||r.find.attr;mb[b]=function(a,b,d){var e,f,g=b.toLowerCase();return d||(f=mb[g],mb[g]=e,e=null!=c(a,b,d)?g:null,mb[g]=f),e}});var nb=/^(?:input|select|textarea|button)$/i,ob=/^(?:a|area)$/i;r.fn.extend({prop:function(a,b){return T(this,r.prop,a,b,arguments.length>1)},removeProp:function(a){return this.each(function(){delete this[r.propFix[a]||a]})}}),r.extend({prop:function(a,b,c){var d,e,f=a.nodeType;if(3!==f&&8!==f&&2!==f)return 1===f&&r.isXMLDoc(a)||(b=r.propFix[b]||b,e=r.propHooks[b]),void 0!==c?e&&"set"in e&&void 0!==(d=e.set(a,c,b))?d:a[b]=c:e&&"get"in e&&null!==(d=e.get(a,b))?d:a[b]},propHooks:{tabIndex:{get:function(a){var b=r.find.attr(a,"tabindex");return b?parseInt(b,10):nb.test(a.nodeName)||ob.test(a.nodeName)&&a.href?0:-1}}},propFix:{"for":"htmlFor","class":"className"}}),o.optSelected||(r.propHooks.selected={get:function(a){var b=a.parentNode;return b&&b.parentNode&&b.parentNode.selectedIndex,null},set:function(a){var b=a.parentNode;b&&(b.selectedIndex,b.parentNode&&b.parentNode.selectedIndex)}}),r.each(["tabIndex","readOnly","maxLength","cellSpacing","cellPadding","rowSpan","colSpan","useMap","frameBorder","contentEditable"],function(){r.propFix[this.toLowerCase()]=this});function pb(a){var b=a.match(L)||[];return b.join(" ")}function qb(a){return a.getAttribute&&a.getAttribute("class")||""}r.fn.extend({addClass:function(a){var b,c,d,e,f,g,h,i=0;if(r.isFunction(a))return this.each(function(b){r(this).addClass(a.call(this,b,qb(this)))});if("string"==typeof a&&a){b=a.match(L)||[];while(c=this[i++])if(e=qb(c),d=1===c.nodeType&&" "+pb(e)+" "){g=0;while(f=b[g++])d.indexOf(" "+f+" ")<0&&(d+=f+" ");h=pb(d),e!==h&&c.setAttribute("class",h)}}return this},removeClass:function(a){var b,c,d,e,f,g,h,i=0;if(r.isFunction(a))return this.each(function(b){r(this).removeClass(a.call(this,b,qb(this)))});if(!arguments.length)return this.attr("class","");if("string"==typeof a&&a){b=a.match(L)||[];while(c=this[i++])if(e=qb(c),d=1===c.nodeType&&" "+pb(e)+" "){g=0;while(f=b[g++])while(d.indexOf(" "+f+" ")>-1)d=d.replace(" "+f+" "," ");h=pb(d),e!==h&&c.setAttribute("class",h)}}return this},toggleClass:function(a,b){var c=typeof a;return"boolean"==typeof b&&"string"===c?b?this.addClass(a):this.removeClass(a):r.isFunction(a)?this.each(function(c){r(this).toggleClass(a.call(this,c,qb(this),b),b)}):this.each(function(){var b,d,e,f;if("string"===c){d=0,e=r(this),f=a.match(L)||[];while(b=f[d++])e.hasClass(b)?e.removeClass(b):e.addClass(b)}else void 0!==a&&"boolean"!==c||(b=qb(this),b&&W.set(this,"__className__",b),this.setAttribute&&this.setAttribute("class",b||a===!1?"":W.get(this,"__className__")||""))})},hasClass:function(a){var b,c,d=0;b=" "+a+" ";while(c=this[d++])if(1===c.nodeType&&(" "+pb(qb(c))+" ").indexOf(b)>-1)return!0;return!1}});var rb=/\r/g;r.fn.extend({val:function(a){var b,c,d,e=this[0];{if(arguments.length)return d=r.isFunction(a),this.each(function(c){var e;1===this.nodeType&&(e=d?a.call(this,c,r(this).val()):a,null==e?e="":"number"==typeof e?e+="":Array.isArray(e)&&(e=r.map(e,function(a){return null==a?"":a+""})),b=r.valHooks[this.type]||r.valHooks[this.nodeName.toLowerCase()],b&&"set"in b&&void 0!==b.set(this,e,"value")||(this.value=e))});if(e)return b=r.valHooks[e.type]||r.valHooks[e.nodeName.toLowerCase()],b&&"get"in b&&void 0!==(c=b.get(e,"value"))?c:(c=e.value,"string"==typeof c?c.replace(rb,""):null==c?"":c)}}}),r.extend({valHooks:{option:{get:function(a){var b=r.find.attr(a,"value");return null!=b?b:pb(r.text(a))}},select:{get:function(a){var b,c,d,e=a.options,f=a.selectedIndex,g="select-one"===a.type,h=g?null:[],i=g?f+1:e.length;for(d=f<0?i:g?f:0;d<i;d++)if(c=e[d],(c.selected||d===f)&&!c.disabled&&(!c.parentNode.disabled||!B(c.parentNode,"optgroup"))){if(b=r(c).val(),g)return b;h.push(b)}return h},set:function(a,b){var c,d,e=a.options,f=r.makeArray(b),g=e.length;while(g--)d=e[g],(d.selected=r.inArray(r.valHooks.option.get(d),f)>-1)&&(c=!0);return c||(a.selectedIndex=-1),f}}}}),r.each(["radio","checkbox"],function(){r.valHooks[this]={set:function(a,b){if(Array.isArray(b))return a.checked=r.inArray(r(a).val(),b)>-1}},o.checkOn||(r.valHooks[this].get=function(a){return null===a.getAttribute("value")?"on":a.value})});var sb=/^(?:focusinfocus|focusoutblur)$/;r.extend(r.event,{trigger:function(b,c,e,f){var g,h,i,j,k,m,n,o=[e||d],p=l.call(b,"type")?b.type:b,q=l.call(b,"namespace")?b.namespace.split("."):[];if(h=i=e=e||d,3!==e.nodeType&&8!==e.nodeType&&!sb.test(p+r.event.triggered)&&(p.indexOf(".")>-1&&(q=p.split("."),p=q.shift(),q.sort()),k=p.indexOf(":")<0&&"on"+p,b=b[r.expando]?b:new r.Event(p,"object"==typeof b&&b),b.isTrigger=f?2:3,b.namespace=q.join("."),b.rnamespace=b.namespace?new RegExp("(^|\\.)"+q.join("\\.(?:.*\\.|)")+"(\\.|$)"):null,b.result=void 0,b.target||(b.target=e),c=null==c?[b]:r.makeArray(c,[b]),n=r.event.special[p]||{},f||!n.trigger||n.trigger.apply(e,c)!==!1)){if(!f&&!n.noBubble&&!r.isWindow(e)){for(j=n.delegateType||p,sb.test(j+p)||(h=h.parentNode);h;h=h.parentNode)o.push(h),i=h;i===(e.ownerDocument||d)&&o.push(i.defaultView||i.parentWindow||a)}g=0;while((h=o[g++])&&!b.isPropagationStopped())b.type=g>1?j:n.bindType||p,m=(W.get(h,"events")||{})[b.type]&&W.get(h,"handle"),m&&m.apply(h,c),m=k&&h[k],m&&m.apply&&U(h)&&(b.result=m.apply(h,c),b.result===!1&&b.preventDefault());return b.type=p,f||b.isDefaultPrevented()||n._default&&n._default.apply(o.pop(),c)!==!1||!U(e)||k&&r.isFunction(e[p])&&!r.isWindow(e)&&(i=e[k],i&&(e[k]=null),r.event.triggered=p,e[p](),r.event.triggered=void 0,i&&(e[k]=i)),b.result}},simulate:function(a,b,c){var d=r.extend(new r.Event,c,{type:a,isSimulated:!0});r.event.trigger(d,null,b)}}),r.fn.extend({trigger:function(a,b){return this.each(function(){r.event.trigger(a,b,this)})},triggerHandler:function(a,b){var c=this[0];if(c)return r.event.trigger(a,b,c,!0)}}),r.each("blur focus focusin focusout resize scroll click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup contextmenu".split(" "),function(a,b){r.fn[b]=function(a,c){return arguments.length>0?this.on(b,null,a,c):this.trigger(b)}}),r.fn.extend({hover:function(a,b){return this.mouseenter(a).mouseleave(b||a)}}),o.focusin="onfocusin"in a,o.focusin||r.each({focus:"focusin",blur:"focusout"},function(a,b){var c=function(a){r.event.simulate(b,a.target,r.event.fix(a))};r.event.special[b]={setup:function(){var d=this.ownerDocument||this,e=W.access(d,b);e||d.addEventListener(a,c,!0),W.access(d,b,(e||0)+1)},teardown:function(){var d=this.ownerDocument||this,e=W.access(d,b)-1;e?W.access(d,b,e):(d.removeEventListener(a,c,!0),W.remove(d,b))}}});var tb=a.location,ub=r.now(),vb=/\?/;r.parseXML=function(b){var c;if(!b||"string"!=typeof b)return null;try{c=(new a.DOMParser).parseFromString(b,"text/xml")}catch(d){c=void 0}return c&&!c.getElementsByTagName("parsererror").length||r.error("Invalid XML: "+b),c};var wb=/\[\]$/,xb=/\r?\n/g,yb=/^(?:submit|button|image|reset|file)$/i,zb=/^(?:input|select|textarea|keygen)/i;function Ab(a,b,c,d){var e;if(Array.isArray(b))r.each(b,function(b,e){c||wb.test(a)?d(a,e):Ab(a+"["+("object"==typeof e&&null!=e?b:"")+"]",e,c,d)});else if(c||"object"!==r.type(b))d(a,b);else for(e in b)Ab(a+"["+e+"]",b[e],c,d)}r.param=function(a,b){var c,d=[],e=function(a,b){var c=r.isFunction(b)?b():b;d[d.length]=encodeURIComponent(a)+"="+encodeURIComponent(null==c?"":c)};if(Array.isArray(a)||a.jquery&&!r.isPlainObject(a))r.each(a,function(){e(this.name,this.value)});else for(c in a)Ab(c,a[c],b,e);return d.join("&")},r.fn.extend({serialize:function(){return r.param(this.serializeArray())},serializeArray:function(){return this.map(function(){var a=r.prop(this,"elements");return a?r.makeArray(a):this}).filter(function(){var a=this.type;return this.name&&!r(this).is(":disabled")&&zb.test(this.nodeName)&&!yb.test(a)&&(this.checked||!ja.test(a))}).map(function(a,b){var c=r(this).val();return null==c?null:Array.isArray(c)?r.map(c,function(a){return{name:b.name,value:a.replace(xb,"\r\n")}}):{name:b.name,value:c.replace(xb,"\r\n")}}).get()}});var Bb=/%20/g,Cb=/#.*$/,Db=/([?&])_=[^&]*/,Eb=/^(.*?):[ \t]*([^\r\n]*)$/gm,Fb=/^(?:about|app|app-storage|.+-extension|file|res|widget):$/,Gb=/^(?:GET|HEAD)$/,Hb=/^\/\//,Ib={},Jb={},Kb="*/".concat("*"),Lb=d.createElement("a");Lb.href=tb.href;function Mb(a){return function(b,c){"string"!=typeof b&&(c=b,b="*");var d,e=0,f=b.toLowerCase().match(L)||[];if(r.isFunction(c))while(d=f[e++])"+"===d[0]?(d=d.slice(1)||"*",(a[d]=a[d]||[]).unshift(c)):(a[d]=a[d]||[]).push(c)}}function Nb(a,b,c,d){var e={},f=a===Jb;function g(h){var i;return e[h]=!0,r.each(a[h]||[],function(a,h){var j=h(b,c,d);return"string"!=typeof j||f||e[j]?f?!(i=j):void 0:(b.dataTypes.unshift(j),g(j),!1)}),i}return g(b.dataTypes[0])||!e["*"]&&g("*")}function Ob(a,b){var c,d,e=r.ajaxSettings.flatOptions||{};for(c in b)void 0!==b[c]&&((e[c]?a:d||(d={}))[c]=b[c]);return d&&r.extend(!0,a,d),a}function Pb(a,b,c){var d,e,f,g,h=a.contents,i=a.dataTypes;while("*"===i[0])i.shift(),void 0===d&&(d=a.mimeType||b.getResponseHeader("Content-Type"));if(d)for(e in h)if(h[e]&&h[e].test(d)){i.unshift(e);break}if(i[0]in c)f=i[0];else{for(e in c){if(!i[0]||a.converters[e+" "+i[0]]){f=e;break}g||(g=e)}f=f||g}if(f)return f!==i[0]&&i.unshift(f),c[f]}function Qb(a,b,c,d){var e,f,g,h,i,j={},k=a.dataTypes.slice();if(k[1])for(g in a.converters)j[g.toLowerCase()]=a.converters[g];f=k.shift();while(f)if(a.responseFields[f]&&(c[a.responseFields[f]]=b),!i&&d&&a.dataFilter&&(b=a.dataFilter(b,a.dataType)),i=f,f=k.shift())if("*"===f)f=i;else if("*"!==i&&i!==f){if(g=j[i+" "+f]||j["* "+f],!g)for(e in j)if(h=e.split(" "),h[1]===f&&(g=j[i+" "+h[0]]||j["* "+h[0]])){g===!0?g=j[e]:j[e]!==!0&&(f=h[0],k.unshift(h[1]));break}if(g!==!0)if(g&&a["throws"])b=g(b);else try{b=g(b)}catch(l){return{state:"parsererror",error:g?l:"No conversion from "+i+" to "+f}}}return{state:"success",data:b}}r.extend({active:0,lastModified:{},etag:{},ajaxSettings:{url:tb.href,type:"GET",isLocal:Fb.test(tb.protocol),global:!0,processData:!0,async:!0,contentType:"application/x-www-form-urlencoded; charset=UTF-8",accepts:{"*":Kb,text:"text/plain",html:"text/html",xml:"application/xml, text/xml",json:"application/json, text/javascript"},contents:{xml:/\bxml\b/,html:/\bhtml/,json:/\bjson\b/},responseFields:{xml:"responseXML",text:"responseText",json:"responseJSON"},converters:{"* text":String,"text html":!0,"text json":JSON.parse,"text xml":r.parseXML},flatOptions:{url:!0,context:!0}},ajaxSetup:function(a,b){return b?Ob(Ob(a,r.ajaxSettings),b):Ob(r.ajaxSettings,a)},ajaxPrefilter:Mb(Ib),ajaxTransport:Mb(Jb),ajax:function(b,c){"object"==typeof b&&(c=b,b=void 0),c=c||{};var e,f,g,h,i,j,k,l,m,n,o=r.ajaxSetup({},c),p=o.context||o,q=o.context&&(p.nodeType||p.jquery)?r(p):r.event,s=r.Deferred(),t=r.Callbacks("once memory"),u=o.statusCode||{},v={},w={},x="canceled",y={readyState:0,getResponseHeader:function(a){var b;if(k){if(!h){h={};while(b=Eb.exec(g))h[b[1].toLowerCase()]=b[2]}b=h[a.toLowerCase()]}return null==b?null:b},getAllResponseHeaders:function(){return k?g:null},setRequestHeader:function(a,b){return null==k&&(a=w[a.toLowerCase()]=w[a.toLowerCase()]||a,v[a]=b),this},overrideMimeType:function(a){return null==k&&(o.mimeType=a),this},statusCode:function(a){var b;if(a)if(k)y.always(a[y.status]);else for(b in a)u[b]=[u[b],a[b]];return this},abort:function(a){var b=a||x;return e&&e.abort(b),A(0,b),this}};if(s.promise(y),o.url=((b||o.url||tb.href)+"").replace(Hb,tb.protocol+"//"),o.type=c.method||c.type||o.method||o.type,o.dataTypes=(o.dataType||"*").toLowerCase().match(L)||[""],null==o.crossDomain){j=d.createElement("a");try{j.href=o.url,j.href=j.href,o.crossDomain=Lb.protocol+"//"+Lb.host!=j.protocol+"//"+j.host}catch(z){o.crossDomain=!0}}if(o.data&&o.processData&&"string"!=typeof o.data&&(o.data=r.param(o.data,o.traditional)),Nb(Ib,o,c,y),k)return y;l=r.event&&o.global,l&&0===r.active++&&r.event.trigger("ajaxStart"),o.type=o.type.toUpperCase(),o.hasContent=!Gb.test(o.type),f=o.url.replace(Cb,""),o.hasContent?o.data&&o.processData&&0===(o.contentType||"").indexOf("application/x-www-form-urlencoded")&&(o.data=o.data.replace(Bb,"+")):(n=o.url.slice(f.length),o.data&&(f+=(vb.test(f)?"&":"?")+o.data,delete o.data),o.cache===!1&&(f=f.replace(Db,"$1"),n=(vb.test(f)?"&":"?")+"_="+ub++ +n),o.url=f+n),o.ifModified&&(r.lastModified[f]&&y.setRequestHeader("If-Modified-Since",r.lastModified[f]),r.etag[f]&&y.setRequestHeader("If-None-Match",r.etag[f])),(o.data&&o.hasContent&&o.contentType!==!1||c.contentType)&&y.setRequestHeader("Content-Type",o.contentType),y.setRequestHeader("Accept",o.dataTypes[0]&&o.accepts[o.dataTypes[0]]?o.accepts[o.dataTypes[0]]+("*"!==o.dataTypes[0]?", "+Kb+"; q=0.01":""):o.accepts["*"]);for(m in o.headers)y.setRequestHeader(m,o.headers[m]);if(o.beforeSend&&(o.beforeSend.call(p,y,o)===!1||k))return y.abort();if(x="abort",t.add(o.complete),y.done(o.success),y.fail(o.error),e=Nb(Jb,o,c,y)){if(y.readyState=1,l&&q.trigger("ajaxSend",[y,o]),k)return y;o.async&&o.timeout>0&&(i=a.setTimeout(function(){y.abort("timeout")},o.timeout));try{k=!1,e.send(v,A)}catch(z){if(k)throw z;A(-1,z)}}else A(-1,"No Transport");function A(b,c,d,h){var j,m,n,v,w,x=c;k||(k=!0,i&&a.clearTimeout(i),e=void 0,g=h||"",y.readyState=b>0?4:0,j=b>=200&&b<300||304===b,d&&(v=Pb(o,y,d)),v=Qb(o,v,y,j),j?(o.ifModified&&(w=y.getResponseHeader("Last-Modified"),w&&(r.lastModified[f]=w),w=y.getResponseHeader("etag"),w&&(r.etag[f]=w)),204===b||"HEAD"===o.type?x="nocontent":304===b?x="notmodified":(x=v.state,m=v.data,n=v.error,j=!n)):(n=x,!b&&x||(x="error",b<0&&(b=0))),y.status=b,y.statusText=(c||x)+"",j?s.resolveWith(p,[m,x,y]):s.rejectWith(p,[y,x,n]),y.statusCode(u),u=void 0,l&&q.trigger(j?"ajaxSuccess":"ajaxError",[y,o,j?m:n]),t.fireWith(p,[y,x]),l&&(q.trigger("ajaxComplete",[y,o]),--r.active||r.event.trigger("ajaxStop")))}return y},getJSON:function(a,b,c){return r.get(a,b,c,"json")},getScript:function(a,b){return r.get(a,void 0,b,"script")}}),r.each(["get","post"],function(a,b){r[b]=function(a,c,d,e){return r.isFunction(c)&&(e=e||d,d=c,c=void 0),r.ajax(r.extend({url:a,type:b,dataType:e,data:c,success:d},r.isPlainObject(a)&&a))}}),r._evalUrl=function(a){return r.ajax({url:a,type:"GET",dataType:"script",cache:!0,async:!1,global:!1,"throws":!0})},r.fn.extend({wrapAll:function(a){var b;return this[0]&&(r.isFunction(a)&&(a=a.call(this[0])),b=r(a,this[0].ownerDocument).eq(0).clone(!0),this[0].parentNode&&b.insertBefore(this[0]),b.map(function(){var a=this;while(a.firstElementChild)a=a.firstElementChild;return a}).append(this)),this},wrapInner:function(a){return r.isFunction(a)?this.each(function(b){r(this).wrapInner(a.call(this,b))}):this.each(function(){var b=r(this),c=b.contents();c.length?c.wrapAll(a):b.append(a)})},wrap:function(a){var b=r.isFunction(a);return this.each(function(c){r(this).wrapAll(b?a.call(this,c):a)})},unwrap:function(a){return this.parent(a).not("body").each(function(){r(this).replaceWith(this.childNodes)}),this}}),r.expr.pseudos.hidden=function(a){return!r.expr.pseudos.visible(a)},r.expr.pseudos.visible=function(a){return!!(a.offsetWidth||a.offsetHeight||a.getClientRects().length)},r.ajaxSettings.xhr=function(){try{return new a.XMLHttpRequest}catch(b){}};var Rb={0:200,1223:204},Sb=r.ajaxSettings.xhr();o.cors=!!Sb&&"withCredentials"in Sb,o.ajax=Sb=!!Sb,r.ajaxTransport(function(b){var c,d;if(o.cors||Sb&&!b.crossDomain)return{send:function(e,f){var g,h=b.xhr();if(h.open(b.type,b.url,b.async,b.username,b.password),b.xhrFields)for(g in b.xhrFields)h[g]=b.xhrFields[g];b.mimeType&&h.overrideMimeType&&h.overrideMimeType(b.mimeType),b.crossDomain||e["X-Requested-With"]||(e["X-Requested-With"]="XMLHttpRequest");for(g in e)h.setRequestHeader(g,e[g]);c=function(a){return function(){c&&(c=d=h.onload=h.onerror=h.onabort=h.onreadystatechange=null,"abort"===a?h.abort():"error"===a?"number"!=typeof h.status?f(0,"error"):f(h.status,h.statusText):f(Rb[h.status]||h.status,h.statusText,"text"!==(h.responseType||"text")||"string"!=typeof h.responseText?{binary:h.response}:{text:h.responseText},h.getAllResponseHeaders()))}},h.onload=c(),d=h.onerror=c("error"),void 0!==h.onabort?h.onabort=d:h.onreadystatechange=function(){4===h.readyState&&a.setTimeout(function(){c&&d()})},c=c("abort");try{h.send(b.hasContent&&b.data||null)}catch(i){if(c)throw i}},abort:function(){c&&c()}}}),r.ajaxPrefilter(function(a){a.crossDomain&&(a.contents.script=!1)}),r.ajaxSetup({accepts:{script:"text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"},contents:{script:/\b(?:java|ecma)script\b/},converters:{"text script":function(a){return r.globalEval(a),a}}}),r.ajaxPrefilter("script",function(a){void 0===a.cache&&(a.cache=!1),a.crossDomain&&(a.type="GET")}),r.ajaxTransport("script",function(a){if(a.crossDomain){var b,c;return{send:function(e,f){b=r("<script>").prop({charset:a.scriptCharset,src:a.url}).on("load error",c=function(a){b.remove(),c=null,a&&f("error"===a.type?404:200,a.type)}),d.head.appendChild(b[0])},abort:function(){c&&c()}}}});var Tb=[],Ub=/(=)\?(?=&|$)|\?\?/;r.ajaxSetup({jsonp:"callback",jsonpCallback:function(){var a=Tb.pop()||r.expando+"_"+ub++;return this[a]=!0,a}}),r.ajaxPrefilter("json jsonp",function(b,c,d){var e,f,g,h=b.jsonp!==!1&&(Ub.test(b.url)?"url":"string"==typeof b.data&&0===(b.contentType||"").indexOf("application/x-www-form-urlencoded")&&Ub.test(b.data)&&"data");if(h||"jsonp"===b.dataTypes[0])return e=b.jsonpCallback=r.isFunction(b.jsonpCallback)?b.jsonpCallback():b.jsonpCallback,h?b[h]=b[h].replace(Ub,"$1"+e):b.jsonp!==!1&&(b.url+=(vb.test(b.url)?"&":"?")+b.jsonp+"="+e),b.converters["script json"]=function(){return g||r.error(e+" was not called"),g[0]},b.dataTypes[0]="json",f=a[e],a[e]=function(){g=arguments},d.always(function(){void 0===f?r(a).removeProp(e):a[e]=f,b[e]&&(b.jsonpCallback=c.jsonpCallback,Tb.push(e)),g&&r.isFunction(f)&&f(g[0]),g=f=void 0}),"script"}),o.createHTMLDocument=function(){var a=d.implementation.createHTMLDocument("").body;return a.innerHTML="<form></form><form></form>",2===a.childNodes.length}(),r.parseHTML=function(a,b,c){if("string"!=typeof a)return[];"boolean"==typeof b&&(c=b,b=!1);var e,f,g;return b||(o.createHTMLDocument?(b=d.implementation.createHTMLDocument(""),e=b.createElement("base"),e.href=d.location.href,b.head.appendChild(e)):b=d),f=C.exec(a),g=!c&&[],f?[b.createElement(f[1])]:(f=qa([a],b,g),g&&g.length&&r(g).remove(),r.merge([],f.childNodes))},r.fn.load=function(a,b,c){var d,e,f,g=this,h=a.indexOf(" ");return h>-1&&(d=pb(a.slice(h)),a=a.slice(0,h)),r.isFunction(b)?(c=b,b=void 0):b&&"object"==typeof b&&(e="POST"),g.length>0&&r.ajax({url:a,type:e||"GET",dataType:"html",data:b}).done(function(a){f=arguments,g.html(d?r("<div>").append(r.parseHTML(a)).find(d):a)}).always(c&&function(a,b){g.each(function(){c.apply(this,f||[a.responseText,b,a])})}),this},r.each(["ajaxStart","ajaxStop","ajaxComplete","ajaxError","ajaxSuccess","ajaxSend"],function(a,b){r.fn[b]=function(a){return this.on(b,a)}}),r.expr.pseudos.animated=function(a){return r.grep(r.timers,function(b){return a===b.elem}).length},r.offset={setOffset:function(a,b,c){var d,e,f,g,h,i,j,k=r.css(a,"position"),l=r(a),m={};"static"===k&&(a.style.position="relative"),h=l.offset(),f=r.css(a,"top"),i=r.css(a,"left"),j=("absolute"===k||"fixed"===k)&&(f+i).indexOf("auto")>-1,j?(d=l.position(),g=d.top,e=d.left):(g=parseFloat(f)||0,e=parseFloat(i)||0),r.isFunction(b)&&(b=b.call(a,c,r.extend({},h))),null!=b.top&&(m.top=b.top-h.top+g),null!=b.left&&(m.left=b.left-h.left+e),"using"in b?b.using.call(a,m):l.css(m)}},r.fn.extend({offset:function(a){if(arguments.length)return void 0===a?this:this.each(function(b){r.offset.setOffset(this,a,b)});var b,c,d,e,f=this[0];if(f)return f.getClientRects().length?(d=f.getBoundingClientRect(),b=f.ownerDocument,c=b.documentElement,e=b.defaultView,{top:d.top+e.pageYOffset-c.clientTop,left:d.left+e.pageXOffset-c.clientLeft}):{top:0,left:0}},position:function(){if(this[0]){var a,b,c=this[0],d={top:0,left:0};return"fixed"===r.css(c,"position")?b=c.getBoundingClientRect():(a=this.offsetParent(),b=this.offset(),B(a[0],"html")||(d=a.offset()),d={top:d.top+r.css(a[0],"borderTopWidth",!0),left:d.left+r.css(a[0],"borderLeftWidth",!0)}),{top:b.top-d.top-r.css(c,"marginTop",!0),left:b.left-d.left-r.css(c,"marginLeft",!0)}}},offsetParent:function(){return this.map(function(){var a=this.offsetParent;while(a&&"static"===r.css(a,"position"))a=a.offsetParent;return a||ra})}}),r.each({scrollLeft:"pageXOffset",scrollTop:"pageYOffset"},function(a,b){var c="pageYOffset"===b;r.fn[a]=function(d){return T(this,function(a,d,e){var f;return r.isWindow(a)?f=a:9===a.nodeType&&(f=a.defaultView),void 0===e?f?f[b]:a[d]:void(f?f.scrollTo(c?f.pageXOffset:e,c?e:f.pageYOffset):a[d]=e)},a,d,arguments.length)}}),r.each(["top","left"],function(a,b){r.cssHooks[b]=Pa(o.pixelPosition,function(a,c){if(c)return c=Oa(a,b),Ma.test(c)?r(a).position()[b]+"px":c})}),r.each({Height:"height",Width:"width"},function(a,b){r.each({padding:"inner"+a,content:b,"":"outer"+a},function(c,d){r.fn[d]=function(e,f){var g=arguments.length&&(c||"boolean"!=typeof e),h=c||(e===!0||f===!0?"margin":"border");return T(this,function(b,c,e){var f;return r.isWindow(b)?0===d.indexOf("outer")?b["inner"+a]:b.document.documentElement["client"+a]:9===b.nodeType?(f=b.documentElement,Math.max(b.body["scroll"+a],f["scroll"+a],b.body["offset"+a],f["offset"+a],f["client"+a])):void 0===e?r.css(b,c,h):r.style(b,c,e,h)},b,g?e:void 0,g)}})}),r.fn.extend({bind:function(a,b,c){return this.on(a,null,b,c)},unbind:function(a,b){return this.off(a,null,b)},delegate:function(a,b,c,d){return this.on(b,a,c,d)},undelegate:function(a,b,c){return 1===arguments.length?this.off(a,"**"):this.off(b,a||"**",c)}}),r.holdReady=function(a){a?r.readyWait++:r.ready(!0)},r.isArray=Array.isArray,r.parseJSON=JSON.parse,r.nodeName=B,"function"==typeof define&&define.amd&&define("jquery",[],function(){return r});var Vb=a.jQuery,Wb=a.$;return r.noConflict=function(b){return a.$===r&&(a.$=Wb),b&&a.jQuery===r&&(a.jQuery=Vb),r},b||(a.jQuery=a.$=r),r});

/*!
 * Bootstrap v4.0.0 (https://getbootstrap.com)
 * Copyright 2011-2018 The Bootstrap Authors (https://github.com/twbs/bootstrap/graphs/contributors)
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 */
!function(t,e){"object"==typeof exports&&"undefined"!=typeof module?e(exports,require("jquery")):"function"==typeof define&&define.amd?define(["exports","jquery"],e):e(t.bootstrap={},t.jQuery)}(this,function(t,e){"use strict";function n(t,e){for(var n=0;n<e.length;n++){var i=e[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(t,i.key,i)}}function i(t,e,i){return e&&n(t.prototype,e),i&&n(t,i),t}function r(){return(r=Object.assign||function(t){for(var e=1;e<arguments.length;e++){var n=arguments[e];for(var i in n)Object.prototype.hasOwnProperty.call(n,i)&&(t[i]=n[i])}return t}).apply(this,arguments)}for(var o,s,a,l,c,h,f,u,d,p,g,m,_,v,E,y,b,T,C,w,I,A,D,S,O,N,k,L,P,x,R,j,H,M,W,U,F,B,K,V,Q,Y,G,q,z,X,J,Z,$,tt,et,nt,it,rt,ot,st,at,lt,ct,ht,ft,ut,dt,pt,gt=function(t){var e=!1;function n(e){var n=this,r=!1;return t(this).one(i.TRANSITION_END,function(){r=!0}),setTimeout(function(){r||i.triggerTransitionEnd(n)},e),this}var i={TRANSITION_END:"bsTransitionEnd",getUID:function(t){do{t+=~~(1e6*Math.random())}while(document.getElementById(t));return t},getSelectorFromElement:function(e){var n=e.getAttribute("data-target");n&&"#"!==n||(n=e.getAttribute("href")||"");try{return t(document).find(n).length>0?n:null}catch(t){return null}},reflow:function(t){return t.offsetHeight},triggerTransitionEnd:function(n){t(n).trigger(e.end)},supportsTransitionEnd:function(){return Boolean(e)},isElement:function(t){return(t[0]||t).nodeType},typeCheckConfig:function(t,e,n){for(var r in n)if(Object.prototype.hasOwnProperty.call(n,r)){var o=n[r],s=e[r],a=s&&i.isElement(s)?"element":(l=s,{}.toString.call(l).match(/\s([a-z]+)/i)[1].toLowerCase());if(!new RegExp(o).test(a))throw new Error(t.toUpperCase()+': Option "'+r+'" provided type "'+a+'" but expected type "'+o+'".')}var l}};return e=("undefined"==typeof window||!window.QUnit)&&{end:"transitionend"},t.fn.emulateTransitionEnd=n,i.supportsTransitionEnd()&&(t.event.special[i.TRANSITION_END]={bindType:e.end,delegateType:e.end,handle:function(e){if(t(e.target).is(this))return e.handleObj.handler.apply(this,arguments)}}),i}(e=e&&e.hasOwnProperty("default")?e.default:e),mt=(s="alert",l="."+(a="bs.alert"),c=(o=e).fn[s],h={CLOSE:"close"+l,CLOSED:"closed"+l,CLICK_DATA_API:"click"+l+".data-api"},f="alert",u="fade",d="show",p=function(){function t(t){this._element=t}var e=t.prototype;return e.close=function(t){t=t||this._element;var e=this._getRootElement(t);this._triggerCloseEvent(e).isDefaultPrevented()||this._removeElement(e)},e.dispose=function(){o.removeData(this._element,a),this._element=null},e._getRootElement=function(t){var e=gt.getSelectorFromElement(t),n=!1;return e&&(n=o(e)[0]),n||(n=o(t).closest("."+f)[0]),n},e._triggerCloseEvent=function(t){var e=o.Event(h.CLOSE);return o(t).trigger(e),e},e._removeElement=function(t){var e=this;o(t).removeClass(d),gt.supportsTransitionEnd()&&o(t).hasClass(u)?o(t).one(gt.TRANSITION_END,function(n){return e._destroyElement(t,n)}).emulateTransitionEnd(150):this._destroyElement(t)},e._destroyElement=function(t){o(t).detach().trigger(h.CLOSED).remove()},t._jQueryInterface=function(e){return this.each(function(){var n=o(this),i=n.data(a);i||(i=new t(this),n.data(a,i)),"close"===e&&i[e](this)})},t._handleDismiss=function(t){return function(e){e&&e.preventDefault(),t.close(this)}},i(t,null,[{key:"VERSION",get:function(){return"4.0.0"}}]),t}(),o(document).on(h.CLICK_DATA_API,'[data-dismiss="alert"]',p._handleDismiss(new p)),o.fn[s]=p._jQueryInterface,o.fn[s].Constructor=p,o.fn[s].noConflict=function(){return o.fn[s]=c,p._jQueryInterface},p),_t=(m="button",v="."+(_="bs.button"),E=".data-api",y=(g=e).fn[m],b="active",T="btn",C="focus",w='[data-toggle^="button"]',I='[data-toggle="buttons"]',A="input",D=".active",S=".btn",O={CLICK_DATA_API:"click"+v+E,FOCUS_BLUR_DATA_API:"focus"+v+E+" blur"+v+E},N=function(){function t(t){this._element=t}var e=t.prototype;return e.toggle=function(){var t=!0,e=!0,n=g(this._element).closest(I)[0];if(n){var i=g(this._element).find(A)[0];if(i){if("radio"===i.type)if(i.checked&&g(this._element).hasClass(b))t=!1;else{var r=g(n).find(D)[0];r&&g(r).removeClass(b)}if(t){if(i.hasAttribute("disabled")||n.hasAttribute("disabled")||i.classList.contains("disabled")||n.classList.contains("disabled"))return;i.checked=!g(this._element).hasClass(b),g(i).trigger("change")}i.focus(),e=!1}}e&&this._element.setAttribute("aria-pressed",!g(this._element).hasClass(b)),t&&g(this._element).toggleClass(b)},e.dispose=function(){g.removeData(this._element,_),this._element=null},t._jQueryInterface=function(e){return this.each(function(){var n=g(this).data(_);n||(n=new t(this),g(this).data(_,n)),"toggle"===e&&n[e]()})},i(t,null,[{key:"VERSION",get:function(){return"4.0.0"}}]),t}(),g(document).on(O.CLICK_DATA_API,w,function(t){t.preventDefault();var e=t.target;g(e).hasClass(T)||(e=g(e).closest(S)),N._jQueryInterface.call(g(e),"toggle")}).on(O.FOCUS_BLUR_DATA_API,w,function(t){var e=g(t.target).closest(S)[0];g(e).toggleClass(C,/^focus(in)?$/.test(t.type))}),g.fn[m]=N._jQueryInterface,g.fn[m].Constructor=N,g.fn[m].noConflict=function(){return g.fn[m]=y,N._jQueryInterface},N),vt=(L="carousel",x="."+(P="bs.carousel"),R=".data-api",j=(k=e).fn[L],H={interval:5e3,keyboard:!0,slide:!1,pause:"hover",wrap:!0},M={interval:"(number|boolean)",keyboard:"boolean",slide:"(boolean|string)",pause:"(string|boolean)",wrap:"boolean"},W="next",U="prev",F="left",B="right",K={SLIDE:"slide"+x,SLID:"slid"+x,KEYDOWN:"keydown"+x,MOUSEENTER:"mouseenter"+x,MOUSELEAVE:"mouseleave"+x,TOUCHEND:"touchend"+x,LOAD_DATA_API:"load"+x+R,CLICK_DATA_API:"click"+x+R},V="carousel",Q="active",Y="slide",G="carousel-item-right",q="carousel-item-left",z="carousel-item-next",X="carousel-item-prev",J={ACTIVE:".active",ACTIVE_ITEM:".active.carousel-item",ITEM:".carousel-item",NEXT_PREV:".carousel-item-next, .carousel-item-prev",INDICATORS:".carousel-indicators",DATA_SLIDE:"[data-slide], [data-slide-to]",DATA_RIDE:'[data-ride="carousel"]'},Z=function(){function t(t,e){this._items=null,this._interval=null,this._activeElement=null,this._isPaused=!1,this._isSliding=!1,this.touchTimeout=null,this._config=this._getConfig(e),this._element=k(t)[0],this._indicatorsElement=k(this._element).find(J.INDICATORS)[0],this._transitionDuration=this._getTransitionDuration(),this._addEventListeners()}var e=t.prototype;return e.next=function(){this._isSliding||this._slide(W)},e.nextWhenVisible=function(){!document.hidden&&k(this._element).is(":visible")&&"hidden"!==k(this._element).css("visibility")&&this.next()},e.prev=function(){this._isSliding||this._slide(U)},e.pause=function(t){t||(this._isPaused=!0),k(this._element).find(J.NEXT_PREV)[0]&&gt.supportsTransitionEnd()&&(gt.triggerTransitionEnd(this._element),this.cycle(!0)),clearInterval(this._interval),this._interval=null},e.cycle=function(t){t||(this._isPaused=!1),this._interval&&(clearInterval(this._interval),this._interval=null),this._config.interval&&!this._isPaused&&(this._interval=setInterval((document.visibilityState?this.nextWhenVisible:this.next).bind(this),this._config.interval))},e.to=function(t){var e=this;this._activeElement=k(this._element).find(J.ACTIVE_ITEM)[0];var n=this._getItemIndex(this._activeElement);if(!(t>this._items.length-1||t<0))if(this._isSliding)k(this._element).one(K.SLID,function(){return e.to(t)});else{if(n===t)return this.pause(),void this.cycle();var i=t>n?W:U;this._slide(i,this._items[t])}},e.dispose=function(){k(this._element).off(x),k.removeData(this._element,P),this._items=null,this._config=null,this._element=null,this._interval=null,this._isPaused=null,this._isSliding=null,this._activeElement=null,this._indicatorsElement=null},e._getConfig=function(t){return t=r({},H,t),gt.typeCheckConfig(L,t,M),t},e._getTransitionDuration=function(){var t=k(this._element).find(J.ITEM).css("transition-duration");return t?(t=t.split(",")[0]).indexOf("ms")>-1?parseFloat(t):1e3*parseFloat(t):0},e._addEventListeners=function(){var t=this;this._config.keyboard&&k(this._element).on(K.KEYDOWN,function(e){return t._keydown(e)}),"hover"===this._config.pause&&(k(this._element).on(K.MOUSEENTER,function(e){return t.pause(e)}).on(K.MOUSELEAVE,function(e){return t.cycle(e)}),"ontouchstart"in document.documentElement&&k(this._element).on(K.TOUCHEND,function(){t.pause(),t.touchTimeout&&clearTimeout(t.touchTimeout),t.touchTimeout=setTimeout(function(e){return t.cycle(e)},500+t._config.interval)}))},e._keydown=function(t){if(!/input|textarea/i.test(t.target.tagName))switch(t.which){case 37:t.preventDefault(),this.prev();break;case 39:t.preventDefault(),this.next()}},e._getItemIndex=function(t){return this._items=k.makeArray(k(t).parent().find(J.ITEM)),this._items.indexOf(t)},e._getItemByDirection=function(t,e){var n=t===W,i=t===U,r=this._getItemIndex(e),o=this._items.length-1;if((i&&0===r||n&&r===o)&&!this._config.wrap)return e;var s=(r+(t===U?-1:1))%this._items.length;return-1===s?this._items[this._items.length-1]:this._items[s]},e._triggerSlideEvent=function(t,e){var n=this._getItemIndex(t),i=this._getItemIndex(k(this._element).find(J.ACTIVE_ITEM)[0]),r=k.Event(K.SLIDE,{relatedTarget:t,direction:e,from:i,to:n});return k(this._element).trigger(r),r},e._setActiveIndicatorElement=function(t){if(this._indicatorsElement){k(this._indicatorsElement).find(J.ACTIVE).removeClass(Q);var e=this._indicatorsElement.children[this._getItemIndex(t)];e&&k(e).addClass(Q)}},e._slide=function(t,e){var n,i,r,o=this,s=k(this._element).find(J.ACTIVE_ITEM)[0],a=this._getItemIndex(s),l=e||s&&this._getItemByDirection(t,s),c=this._getItemIndex(l),h=Boolean(this._interval);if(t===W?(n=q,i=z,r=F):(n=G,i=X,r=B),l&&k(l).hasClass(Q))this._isSliding=!1;else if(!this._triggerSlideEvent(l,r).isDefaultPrevented()&&s&&l){this._isSliding=!0,h&&this.pause(),this._setActiveIndicatorElement(l);var f=k.Event(K.SLID,{relatedTarget:l,direction:r,from:a,to:c});gt.supportsTransitionEnd()&&k(this._element).hasClass(Y)?(k(l).addClass(i),gt.reflow(l),k(s).addClass(n),k(l).addClass(n),k(s).one(gt.TRANSITION_END,function(){k(l).removeClass(n+" "+i).addClass(Q),k(s).removeClass(Q+" "+i+" "+n),o._isSliding=!1,setTimeout(function(){return k(o._element).trigger(f)},0)}).emulateTransitionEnd(this._transitionDuration)):(k(s).removeClass(Q),k(l).addClass(Q),this._isSliding=!1,k(this._element).trigger(f)),h&&this.cycle()}},t._jQueryInterface=function(e){return this.each(function(){var n=k(this).data(P),i=r({},H,k(this).data());"object"==typeof e&&(i=r({},i,e));var o="string"==typeof e?e:i.slide;if(n||(n=new t(this,i),k(this).data(P,n)),"number"==typeof e)n.to(e);else if("string"==typeof o){if("undefined"==typeof n[o])throw new TypeError('No method named "'+o+'"');n[o]()}else i.interval&&(n.pause(),n.cycle())})},t._dataApiClickHandler=function(e){var n=gt.getSelectorFromElement(this);if(n){var i=k(n)[0];if(i&&k(i).hasClass(V)){var o=r({},k(i).data(),k(this).data()),s=this.getAttribute("data-slide-to");s&&(o.interval=!1),t._jQueryInterface.call(k(i),o),s&&k(i).data(P).to(s),e.preventDefault()}}},i(t,null,[{key:"VERSION",get:function(){return"4.0.0"}},{key:"Default",get:function(){return H}}]),t}(),k(document).on(K.CLICK_DATA_API,J.DATA_SLIDE,Z._dataApiClickHandler),k(window).on(K.LOAD_DATA_API,function(){k(J.DATA_RIDE).each(function(){var t=k(this);Z._jQueryInterface.call(t,t.data())})}),k.fn[L]=Z._jQueryInterface,k.fn[L].Constructor=Z,k.fn[L].noConflict=function(){return k.fn[L]=j,Z._jQueryInterface},Z),Et=(tt="collapse",nt="."+(et="bs.collapse"),it=($=e).fn[tt],rt={toggle:!0,parent:""},ot={toggle:"boolean",parent:"(string|element)"},st={SHOW:"show"+nt,SHOWN:"shown"+nt,HIDE:"hide"+nt,HIDDEN:"hidden"+nt,CLICK_DATA_API:"click"+nt+".data-api"},at="show",lt="collapse",ct="collapsing",ht="collapsed",ft="width",ut="height",dt={ACTIVES:".show, .collapsing",DATA_TOGGLE:'[data-toggle="collapse"]'},pt=function(){function t(t,e){this._isTransitioning=!1,this._element=t,this._config=this._getConfig(e),this._triggerArray=$.makeArray($('[data-toggle="collapse"][href="#'+t.id+'"],[data-toggle="collapse"][data-target="#'+t.id+'"]'));for(var n=$(dt.DATA_TOGGLE),i=0;i<n.length;i++){var r=n[i],o=gt.getSelectorFromElement(r);null!==o&&$(o).filter(t).length>0&&(this._selector=o,this._triggerArray.push(r))}this._parent=this._config.parent?this._getParent():null,this._config.parent||this._addAriaAndCollapsedClass(this._element,this._triggerArray),this._config.toggle&&this.toggle()}var e=t.prototype;return e.toggle=function(){$(this._element).hasClass(at)?this.hide():this.show()},e.show=function(){var e,n,i=this;if(!this._isTransitioning&&!$(this._element).hasClass(at)&&(this._parent&&0===(e=$.makeArray($(this._parent).find(dt.ACTIVES).filter('[data-parent="'+this._config.parent+'"]'))).length&&(e=null),!(e&&(n=$(e).not(this._selector).data(et))&&n._isTransitioning))){var r=$.Event(st.SHOW);if($(this._element).trigger(r),!r.isDefaultPrevented()){e&&(t._jQueryInterface.call($(e).not(this._selector),"hide"),n||$(e).data(et,null));var o=this._getDimension();$(this._element).removeClass(lt).addClass(ct),this._element.style[o]=0,this._triggerArray.length>0&&$(this._triggerArray).removeClass(ht).attr("aria-expanded",!0),this.setTransitioning(!0);var s=function(){$(i._element).removeClass(ct).addClass(lt).addClass(at),i._element.style[o]="",i.setTransitioning(!1),$(i._element).trigger(st.SHOWN)};if(gt.supportsTransitionEnd()){var a="scroll"+(o[0].toUpperCase()+o.slice(1));$(this._element).one(gt.TRANSITION_END,s).emulateTransitionEnd(600),this._element.style[o]=this._element[a]+"px"}else s()}}},e.hide=function(){var t=this;if(!this._isTransitioning&&$(this._element).hasClass(at)){var e=$.Event(st.HIDE);if($(this._element).trigger(e),!e.isDefaultPrevented()){var n=this._getDimension();if(this._element.style[n]=this._element.getBoundingClientRect()[n]+"px",gt.reflow(this._element),$(this._element).addClass(ct).removeClass(lt).removeClass(at),this._triggerArray.length>0)for(var i=0;i<this._triggerArray.length;i++){var r=this._triggerArray[i],o=gt.getSelectorFromElement(r);if(null!==o)$(o).hasClass(at)||$(r).addClass(ht).attr("aria-expanded",!1)}this.setTransitioning(!0);var s=function(){t.setTransitioning(!1),$(t._element).removeClass(ct).addClass(lt).trigger(st.HIDDEN)};this._element.style[n]="",gt.supportsTransitionEnd()?$(this._element).one(gt.TRANSITION_END,s).emulateTransitionEnd(600):s()}}},e.setTransitioning=function(t){this._isTransitioning=t},e.dispose=function(){$.removeData(this._element,et),this._config=null,this._parent=null,this._element=null,this._triggerArray=null,this._isTransitioning=null},e._getConfig=function(t){return(t=r({},rt,t)).toggle=Boolean(t.toggle),gt.typeCheckConfig(tt,t,ot),t},e._getDimension=function(){return $(this._element).hasClass(ft)?ft:ut},e._getParent=function(){var e=this,n=null;gt.isElement(this._config.parent)?(n=this._config.parent,"undefined"!=typeof this._config.parent.jquery&&(n=this._config.parent[0])):n=$(this._config.parent)[0];var i='[data-toggle="collapse"][data-parent="'+this._config.parent+'"]';return $(n).find(i).each(function(n,i){e._addAriaAndCollapsedClass(t._getTargetFromElement(i),[i])}),n},e._addAriaAndCollapsedClass=function(t,e){if(t){var n=$(t).hasClass(at);e.length>0&&$(e).toggleClass(ht,!n).attr("aria-expanded",n)}},t._getTargetFromElement=function(t){var e=gt.getSelectorFromElement(t);return e?$(e)[0]:null},t._jQueryInterface=function(e){return this.each(function(){var n=$(this),i=n.data(et),o=r({},rt,n.data(),"object"==typeof e&&e);if(!i&&o.toggle&&/show|hide/.test(e)&&(o.toggle=!1),i||(i=new t(this,o),n.data(et,i)),"string"==typeof e){if("undefined"==typeof i[e])throw new TypeError('No method named "'+e+'"');i[e]()}})},i(t,null,[{key:"VERSION",get:function(){return"4.0.0"}},{key:"Default",get:function(){return rt}}]),t}(),$(document).on(st.CLICK_DATA_API,dt.DATA_TOGGLE,function(t){"A"===t.currentTarget.tagName&&t.preventDefault();var e=$(this),n=gt.getSelectorFromElement(this);$(n).each(function(){var t=$(this),n=t.data(et)?"toggle":e.data();pt._jQueryInterface.call(t,n)})}),$.fn[tt]=pt._jQueryInterface,$.fn[tt].Constructor=pt,$.fn[tt].noConflict=function(){return $.fn[tt]=it,pt._jQueryInterface},pt),yt="undefined"!=typeof window&&"undefined"!=typeof document,bt=["Edge","Trident","Firefox"],Tt=0,Ct=0;Ct<bt.length;Ct+=1)if(yt&&navigator.userAgent.indexOf(bt[Ct])>=0){Tt=1;break}var wt=yt&&window.Promise?function(t){var e=!1;return function(){e||(e=!0,window.Promise.resolve().then(function(){e=!1,t()}))}}:function(t){var e=!1;return function(){e||(e=!0,setTimeout(function(){e=!1,t()},Tt))}};function It(t){return t&&"[object Function]"==={}.toString.call(t)}function At(t,e){if(1!==t.nodeType)return[];var n=getComputedStyle(t,null);return e?n[e]:n}function Dt(t){return"HTML"===t.nodeName?t:t.parentNode||t.host}function St(t){if(!t)return document.body;switch(t.nodeName){case"HTML":case"BODY":return t.ownerDocument.body;case"#document":return t.body}var e=At(t),n=e.overflow,i=e.overflowX,r=e.overflowY;return/(auto|scroll)/.test(n+r+i)?t:St(Dt(t))}function Ot(t){var e=t&&t.offsetParent,n=e&&e.nodeName;return n&&"BODY"!==n&&"HTML"!==n?-1!==["TD","TABLE"].indexOf(e.nodeName)&&"static"===At(e,"position")?Ot(e):e:t?t.ownerDocument.documentElement:document.documentElement}function Nt(t){return null!==t.parentNode?Nt(t.parentNode):t}function kt(t,e){if(!(t&&t.nodeType&&e&&e.nodeType))return document.documentElement;var n=t.compareDocumentPosition(e)&Node.DOCUMENT_POSITION_FOLLOWING,i=n?t:e,r=n?e:t,o=document.createRange();o.setStart(i,0),o.setEnd(r,0);var s,a,l=o.commonAncestorContainer;if(t!==l&&e!==l||i.contains(r))return"BODY"===(a=(s=l).nodeName)||"HTML"!==a&&Ot(s.firstElementChild)!==s?Ot(l):l;var c=Nt(t);return c.host?kt(c.host,e):kt(t,Nt(e).host)}function Lt(t){var e="top"===(arguments.length>1&&void 0!==arguments[1]?arguments[1]:"top")?"scrollTop":"scrollLeft",n=t.nodeName;if("BODY"===n||"HTML"===n){var i=t.ownerDocument.documentElement;return(t.ownerDocument.scrollingElement||i)[e]}return t[e]}function Pt(t,e){var n="x"===e?"Left":"Top",i="Left"===n?"Right":"Bottom";return parseFloat(t["border"+n+"Width"],10)+parseFloat(t["border"+i+"Width"],10)}var xt=void 0,Rt=function(){return void 0===xt&&(xt=-1!==navigator.appVersion.indexOf("MSIE 10")),xt};function jt(t,e,n,i){return Math.max(e["offset"+t],e["scroll"+t],n["client"+t],n["offset"+t],n["scroll"+t],Rt()?n["offset"+t]+i["margin"+("Height"===t?"Top":"Left")]+i["margin"+("Height"===t?"Bottom":"Right")]:0)}function Ht(){var t=document.body,e=document.documentElement,n=Rt()&&getComputedStyle(e);return{height:jt("Height",t,e,n),width:jt("Width",t,e,n)}}var Mt=function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")},Wt=function(){function t(t,e){for(var n=0;n<e.length;n++){var i=e[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(t,i.key,i)}}return function(e,n,i){return n&&t(e.prototype,n),i&&t(e,i),e}}(),Ut=function(t,e,n){return e in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t},Ft=Object.assign||function(t){for(var e=1;e<arguments.length;e++){var n=arguments[e];for(var i in n)Object.prototype.hasOwnProperty.call(n,i)&&(t[i]=n[i])}return t};function Bt(t){return Ft({},t,{right:t.left+t.width,bottom:t.top+t.height})}function Kt(t){var e={};if(Rt())try{e=t.getBoundingClientRect();var n=Lt(t,"top"),i=Lt(t,"left");e.top+=n,e.left+=i,e.bottom+=n,e.right+=i}catch(t){}else e=t.getBoundingClientRect();var r={left:e.left,top:e.top,width:e.right-e.left,height:e.bottom-e.top},o="HTML"===t.nodeName?Ht():{},s=o.width||t.clientWidth||r.right-r.left,a=o.height||t.clientHeight||r.bottom-r.top,l=t.offsetWidth-s,c=t.offsetHeight-a;if(l||c){var h=At(t);l-=Pt(h,"x"),c-=Pt(h,"y"),r.width-=l,r.height-=c}return Bt(r)}function Vt(t,e){var n=Rt(),i="HTML"===e.nodeName,r=Kt(t),o=Kt(e),s=St(t),a=At(e),l=parseFloat(a.borderTopWidth,10),c=parseFloat(a.borderLeftWidth,10),h=Bt({top:r.top-o.top-l,left:r.left-o.left-c,width:r.width,height:r.height});if(h.marginTop=0,h.marginLeft=0,!n&&i){var f=parseFloat(a.marginTop,10),u=parseFloat(a.marginLeft,10);h.top-=l-f,h.bottom-=l-f,h.left-=c-u,h.right-=c-u,h.marginTop=f,h.marginLeft=u}return(n?e.contains(s):e===s&&"BODY"!==s.nodeName)&&(h=function(t,e){var n=arguments.length>2&&void 0!==arguments[2]&&arguments[2],i=Lt(e,"top"),r=Lt(e,"left"),o=n?-1:1;return t.top+=i*o,t.bottom+=i*o,t.left+=r*o,t.right+=r*o,t}(h,e)),h}function Qt(t,e,n,i){var r,o,s,a,l,c,h,f={top:0,left:0},u=kt(t,e);if("viewport"===i)o=(r=u).ownerDocument.documentElement,s=Vt(r,o),a=Math.max(o.clientWidth,window.innerWidth||0),l=Math.max(o.clientHeight,window.innerHeight||0),c=Lt(o),h=Lt(o,"left"),f=Bt({top:c-s.top+s.marginTop,left:h-s.left+s.marginLeft,width:a,height:l});else{var d=void 0;"scrollParent"===i?"BODY"===(d=St(Dt(e))).nodeName&&(d=t.ownerDocument.documentElement):d="window"===i?t.ownerDocument.documentElement:i;var p=Vt(d,u);if("HTML"!==d.nodeName||function t(e){var n=e.nodeName;return"BODY"!==n&&"HTML"!==n&&("fixed"===At(e,"position")||t(Dt(e)))}(u))f=p;else{var g=Ht(),m=g.height,_=g.width;f.top+=p.top-p.marginTop,f.bottom=m+p.top,f.left+=p.left-p.marginLeft,f.right=_+p.left}}return f.left+=n,f.top+=n,f.right-=n,f.bottom-=n,f}function Yt(t,e,n,i,r){var o=arguments.length>5&&void 0!==arguments[5]?arguments[5]:0;if(-1===t.indexOf("auto"))return t;var s=Qt(n,i,o,r),a={top:{width:s.width,height:e.top-s.top},right:{width:s.right-e.right,height:s.height},bottom:{width:s.width,height:s.bottom-e.bottom},left:{width:e.left-s.left,height:s.height}},l=Object.keys(a).map(function(t){return Ft({key:t},a[t],{area:(e=a[t],e.width*e.height)});var e}).sort(function(t,e){return e.area-t.area}),c=l.filter(function(t){var e=t.width,i=t.height;return e>=n.clientWidth&&i>=n.clientHeight}),h=c.length>0?c[0].key:l[0].key,f=t.split("-")[1];return h+(f?"-"+f:"")}function Gt(t,e,n){return Vt(n,kt(e,n))}function qt(t){var e=getComputedStyle(t),n=parseFloat(e.marginTop)+parseFloat(e.marginBottom),i=parseFloat(e.marginLeft)+parseFloat(e.marginRight);return{width:t.offsetWidth+i,height:t.offsetHeight+n}}function zt(t){var e={left:"right",right:"left",bottom:"top",top:"bottom"};return t.replace(/left|right|bottom|top/g,function(t){return e[t]})}function Xt(t,e,n){n=n.split("-")[0];var i=qt(t),r={width:i.width,height:i.height},o=-1!==["right","left"].indexOf(n),s=o?"top":"left",a=o?"left":"top",l=o?"height":"width",c=o?"width":"height";return r[s]=e[s]+e[l]/2-i[l]/2,r[a]=n===a?e[a]-i[c]:e[zt(a)],r}function Jt(t,e){return Array.prototype.find?t.find(e):t.filter(e)[0]}function Zt(t,e,n){return(void 0===n?t:t.slice(0,function(t,e,n){if(Array.prototype.findIndex)return t.findIndex(function(t){return t[e]===n});var i=Jt(t,function(t){return t[e]===n});return t.indexOf(i)}(t,"name",n))).forEach(function(t){t.function&&console.warn("`modifier.function` is deprecated, use `modifier.fn`!");var n=t.function||t.fn;t.enabled&&It(n)&&(e.offsets.popper=Bt(e.offsets.popper),e.offsets.reference=Bt(e.offsets.reference),e=n(e,t))}),e}function $t(t,e){return t.some(function(t){var n=t.name;return t.enabled&&n===e})}function te(t){for(var e=[!1,"ms","Webkit","Moz","O"],n=t.charAt(0).toUpperCase()+t.slice(1),i=0;i<e.length-1;i++){var r=e[i],o=r?""+r+n:t;if("undefined"!=typeof document.body.style[o])return o}return null}function ee(t){var e=t.ownerDocument;return e?e.defaultView:window}function ne(t,e,n,i){n.updateBound=i,ee(t).addEventListener("resize",n.updateBound,{passive:!0});var r=St(t);return function t(e,n,i,r){var o="BODY"===e.nodeName,s=o?e.ownerDocument.defaultView:e;s.addEventListener(n,i,{passive:!0}),o||t(St(s.parentNode),n,i,r),r.push(s)}(r,"scroll",n.updateBound,n.scrollParents),n.scrollElement=r,n.eventsEnabled=!0,n}function ie(){var t,e;this.state.eventsEnabled&&(cancelAnimationFrame(this.scheduleUpdate),this.state=(t=this.reference,e=this.state,ee(t).removeEventListener("resize",e.updateBound),e.scrollParents.forEach(function(t){t.removeEventListener("scroll",e.updateBound)}),e.updateBound=null,e.scrollParents=[],e.scrollElement=null,e.eventsEnabled=!1,e))}function re(t){return""!==t&&!isNaN(parseFloat(t))&&isFinite(t)}function oe(t,e){Object.keys(e).forEach(function(n){var i="";-1!==["width","height","top","right","bottom","left"].indexOf(n)&&re(e[n])&&(i="px"),t.style[n]=e[n]+i})}function se(t,e,n){var i=Jt(t,function(t){return t.name===e}),r=!!i&&t.some(function(t){return t.name===n&&t.enabled&&t.order<i.order});if(!r){var o="`"+e+"`",s="`"+n+"`";console.warn(s+" modifier is required by "+o+" modifier in order to work, be sure to include it before "+o+"!")}return r}var ae=["auto-start","auto","auto-end","top-start","top","top-end","right-start","right","right-end","bottom-end","bottom","bottom-start","left-end","left","left-start"],le=ae.slice(3);function ce(t){var e=arguments.length>1&&void 0!==arguments[1]&&arguments[1],n=le.indexOf(t),i=le.slice(n+1).concat(le.slice(0,n));return e?i.reverse():i}var he={FLIP:"flip",CLOCKWISE:"clockwise",COUNTERCLOCKWISE:"counterclockwise"};function fe(t,e,n,i){var r=[0,0],o=-1!==["right","left"].indexOf(i),s=t.split(/(\+|\-)/).map(function(t){return t.trim()}),a=s.indexOf(Jt(s,function(t){return-1!==t.search(/,|\s/)}));s[a]&&-1===s[a].indexOf(",")&&console.warn("Offsets separated by white space(s) are deprecated, use a comma (,) instead.");var l=/\s*,\s*|\s+/,c=-1!==a?[s.slice(0,a).concat([s[a].split(l)[0]]),[s[a].split(l)[1]].concat(s.slice(a+1))]:[s];return(c=c.map(function(t,i){var r=(1===i?!o:o)?"height":"width",s=!1;return t.reduce(function(t,e){return""===t[t.length-1]&&-1!==["+","-"].indexOf(e)?(t[t.length-1]=e,s=!0,t):s?(t[t.length-1]+=e,s=!1,t):t.concat(e)},[]).map(function(t){return function(t,e,n,i){var r=t.match(/((?:\-|\+)?\d*\.?\d*)(.*)/),o=+r[1],s=r[2];if(!o)return t;if(0===s.indexOf("%")){var a=void 0;switch(s){case"%p":a=n;break;case"%":case"%r":default:a=i}return Bt(a)[e]/100*o}if("vh"===s||"vw"===s)return("vh"===s?Math.max(document.documentElement.clientHeight,window.innerHeight||0):Math.max(document.documentElement.clientWidth,window.innerWidth||0))/100*o;return o}(t,r,e,n)})})).forEach(function(t,e){t.forEach(function(n,i){re(n)&&(r[e]+=n*("-"===t[i-1]?-1:1))})}),r}var ue={placement:"bottom",eventsEnabled:!0,removeOnDestroy:!1,onCreate:function(){},onUpdate:function(){},modifiers:{shift:{order:100,enabled:!0,fn:function(t){var e=t.placement,n=e.split("-")[0],i=e.split("-")[1];if(i){var r=t.offsets,o=r.reference,s=r.popper,a=-1!==["bottom","top"].indexOf(n),l=a?"left":"top",c=a?"width":"height",h={start:Ut({},l,o[l]),end:Ut({},l,o[l]+o[c]-s[c])};t.offsets.popper=Ft({},s,h[i])}return t}},offset:{order:200,enabled:!0,fn:function(t,e){var n=e.offset,i=t.placement,r=t.offsets,o=r.popper,s=r.reference,a=i.split("-")[0],l=void 0;return l=re(+n)?[+n,0]:fe(n,o,s,a),"left"===a?(o.top+=l[0],o.left-=l[1]):"right"===a?(o.top+=l[0],o.left+=l[1]):"top"===a?(o.left+=l[0],o.top-=l[1]):"bottom"===a&&(o.left+=l[0],o.top+=l[1]),t.popper=o,t},offset:0},preventOverflow:{order:300,enabled:!0,fn:function(t,e){var n=e.boundariesElement||Ot(t.instance.popper);t.instance.reference===n&&(n=Ot(n));var i=Qt(t.instance.popper,t.instance.reference,e.padding,n);e.boundaries=i;var r=e.priority,o=t.offsets.popper,s={primary:function(t){var n=o[t];return o[t]<i[t]&&!e.escapeWithReference&&(n=Math.max(o[t],i[t])),Ut({},t,n)},secondary:function(t){var n="right"===t?"left":"top",r=o[n];return o[t]>i[t]&&!e.escapeWithReference&&(r=Math.min(o[n],i[t]-("right"===t?o.width:o.height))),Ut({},n,r)}};return r.forEach(function(t){var e=-1!==["left","top"].indexOf(t)?"primary":"secondary";o=Ft({},o,s[e](t))}),t.offsets.popper=o,t},priority:["left","right","top","bottom"],padding:5,boundariesElement:"scrollParent"},keepTogether:{order:400,enabled:!0,fn:function(t){var e=t.offsets,n=e.popper,i=e.reference,r=t.placement.split("-")[0],o=Math.floor,s=-1!==["top","bottom"].indexOf(r),a=s?"right":"bottom",l=s?"left":"top",c=s?"width":"height";return n[a]<o(i[l])&&(t.offsets.popper[l]=o(i[l])-n[c]),n[l]>o(i[a])&&(t.offsets.popper[l]=o(i[a])),t}},arrow:{order:500,enabled:!0,fn:function(t,e){var n;if(!se(t.instance.modifiers,"arrow","keepTogether"))return t;var i=e.element;if("string"==typeof i){if(!(i=t.instance.popper.querySelector(i)))return t}else if(!t.instance.popper.contains(i))return console.warn("WARNING: `arrow.element` must be child of its popper element!"),t;var r=t.placement.split("-")[0],o=t.offsets,s=o.popper,a=o.reference,l=-1!==["left","right"].indexOf(r),c=l?"height":"width",h=l?"Top":"Left",f=h.toLowerCase(),u=l?"left":"top",d=l?"bottom":"right",p=qt(i)[c];a[d]-p<s[f]&&(t.offsets.popper[f]-=s[f]-(a[d]-p)),a[f]+p>s[d]&&(t.offsets.popper[f]+=a[f]+p-s[d]),t.offsets.popper=Bt(t.offsets.popper);var g=a[f]+a[c]/2-p/2,m=At(t.instance.popper),_=parseFloat(m["margin"+h],10),v=parseFloat(m["border"+h+"Width"],10),E=g-t.offsets.popper[f]-_-v;return E=Math.max(Math.min(s[c]-p,E),0),t.arrowElement=i,t.offsets.arrow=(Ut(n={},f,Math.round(E)),Ut(n,u,""),n),t},element:"[x-arrow]"},flip:{order:600,enabled:!0,fn:function(t,e){if($t(t.instance.modifiers,"inner"))return t;if(t.flipped&&t.placement===t.originalPlacement)return t;var n=Qt(t.instance.popper,t.instance.reference,e.padding,e.boundariesElement),i=t.placement.split("-")[0],r=zt(i),o=t.placement.split("-")[1]||"",s=[];switch(e.behavior){case he.FLIP:s=[i,r];break;case he.CLOCKWISE:s=ce(i);break;case he.COUNTERCLOCKWISE:s=ce(i,!0);break;default:s=e.behavior}return s.forEach(function(a,l){if(i!==a||s.length===l+1)return t;i=t.placement.split("-")[0],r=zt(i);var c,h=t.offsets.popper,f=t.offsets.reference,u=Math.floor,d="left"===i&&u(h.right)>u(f.left)||"right"===i&&u(h.left)<u(f.right)||"top"===i&&u(h.bottom)>u(f.top)||"bottom"===i&&u(h.top)<u(f.bottom),p=u(h.left)<u(n.left),g=u(h.right)>u(n.right),m=u(h.top)<u(n.top),_=u(h.bottom)>u(n.bottom),v="left"===i&&p||"right"===i&&g||"top"===i&&m||"bottom"===i&&_,E=-1!==["top","bottom"].indexOf(i),y=!!e.flipVariations&&(E&&"start"===o&&p||E&&"end"===o&&g||!E&&"start"===o&&m||!E&&"end"===o&&_);(d||v||y)&&(t.flipped=!0,(d||v)&&(i=s[l+1]),y&&(o="end"===(c=o)?"start":"start"===c?"end":c),t.placement=i+(o?"-"+o:""),t.offsets.popper=Ft({},t.offsets.popper,Xt(t.instance.popper,t.offsets.reference,t.placement)),t=Zt(t.instance.modifiers,t,"flip"))}),t},behavior:"flip",padding:5,boundariesElement:"viewport"},inner:{order:700,enabled:!1,fn:function(t){var e=t.placement,n=e.split("-")[0],i=t.offsets,r=i.popper,o=i.reference,s=-1!==["left","right"].indexOf(n),a=-1===["top","left"].indexOf(n);return r[s?"left":"top"]=o[n]-(a?r[s?"width":"height"]:0),t.placement=zt(e),t.offsets.popper=Bt(r),t}},hide:{order:800,enabled:!0,fn:function(t){if(!se(t.instance.modifiers,"hide","preventOverflow"))return t;var e=t.offsets.reference,n=Jt(t.instance.modifiers,function(t){return"preventOverflow"===t.name}).boundaries;if(e.bottom<n.top||e.left>n.right||e.top>n.bottom||e.right<n.left){if(!0===t.hide)return t;t.hide=!0,t.attributes["x-out-of-boundaries"]=""}else{if(!1===t.hide)return t;t.hide=!1,t.attributes["x-out-of-boundaries"]=!1}return t}},computeStyle:{order:850,enabled:!0,fn:function(t,e){var n=e.x,i=e.y,r=t.offsets.popper,o=Jt(t.instance.modifiers,function(t){return"applyStyle"===t.name}).gpuAcceleration;void 0!==o&&console.warn("WARNING: `gpuAcceleration` option moved to `computeStyle` modifier and will not be supported in future versions of Popper.js!");var s=void 0!==o?o:e.gpuAcceleration,a=Kt(Ot(t.instance.popper)),l={position:r.position},c={left:Math.floor(r.left),top:Math.floor(r.top),bottom:Math.floor(r.bottom),right:Math.floor(r.right)},h="bottom"===n?"top":"bottom",f="right"===i?"left":"right",u=te("transform"),d=void 0,p=void 0;if(p="bottom"===h?-a.height+c.bottom:c.top,d="right"===f?-a.width+c.right:c.left,s&&u)l[u]="translate3d("+d+"px, "+p+"px, 0)",l[h]=0,l[f]=0,l.willChange="transform";else{var g="bottom"===h?-1:1,m="right"===f?-1:1;l[h]=p*g,l[f]=d*m,l.willChange=h+", "+f}var _={"x-placement":t.placement};return t.attributes=Ft({},_,t.attributes),t.styles=Ft({},l,t.styles),t.arrowStyles=Ft({},t.offsets.arrow,t.arrowStyles),t},gpuAcceleration:!0,x:"bottom",y:"right"},applyStyle:{order:900,enabled:!0,fn:function(t){var e,n;return oe(t.instance.popper,t.styles),e=t.instance.popper,n=t.attributes,Object.keys(n).forEach(function(t){!1!==n[t]?e.setAttribute(t,n[t]):e.removeAttribute(t)}),t.arrowElement&&Object.keys(t.arrowStyles).length&&oe(t.arrowElement,t.arrowStyles),t},onLoad:function(t,e,n,i,r){var o=Gt(0,e,t),s=Yt(n.placement,o,e,t,n.modifiers.flip.boundariesElement,n.modifiers.flip.padding);return e.setAttribute("x-placement",s),oe(e,{position:"absolute"}),n},gpuAcceleration:void 0}}},de=function(){function t(e,n){var i=this,r=arguments.length>2&&void 0!==arguments[2]?arguments[2]:{};Mt(this,t),this.scheduleUpdate=function(){return requestAnimationFrame(i.update)},this.update=wt(this.update.bind(this)),this.options=Ft({},t.Defaults,r),this.state={isDestroyed:!1,isCreated:!1,scrollParents:[]},this.reference=e&&e.jquery?e[0]:e,this.popper=n&&n.jquery?n[0]:n,this.options.modifiers={},Object.keys(Ft({},t.Defaults.modifiers,r.modifiers)).forEach(function(e){i.options.modifiers[e]=Ft({},t.Defaults.modifiers[e]||{},r.modifiers?r.modifiers[e]:{})}),this.modifiers=Object.keys(this.options.modifiers).map(function(t){return Ft({name:t},i.options.modifiers[t])}).sort(function(t,e){return t.order-e.order}),this.modifiers.forEach(function(t){t.enabled&&It(t.onLoad)&&t.onLoad(i.reference,i.popper,i.options,t,i.state)}),this.update();var o=this.options.eventsEnabled;o&&this.enableEventListeners(),this.state.eventsEnabled=o}return Wt(t,[{key:"update",value:function(){return function(){if(!this.state.isDestroyed){var t={instance:this,styles:{},arrowStyles:{},attributes:{},flipped:!1,offsets:{}};t.offsets.reference=Gt(this.state,this.popper,this.reference),t.placement=Yt(this.options.placement,t.offsets.reference,this.popper,this.reference,this.options.modifiers.flip.boundariesElement,this.options.modifiers.flip.padding),t.originalPlacement=t.placement,t.offsets.popper=Xt(this.popper,t.offsets.reference,t.placement),t.offsets.popper.position="absolute",t=Zt(this.modifiers,t),this.state.isCreated?this.options.onUpdate(t):(this.state.isCreated=!0,this.options.onCreate(t))}}.call(this)}},{key:"destroy",value:function(){return function(){return this.state.isDestroyed=!0,$t(this.modifiers,"applyStyle")&&(this.popper.removeAttribute("x-placement"),this.popper.style.left="",this.popper.style.position="",this.popper.style.top="",this.popper.style[te("transform")]=""),this.disableEventListeners(),this.options.removeOnDestroy&&this.popper.parentNode.removeChild(this.popper),this}.call(this)}},{key:"enableEventListeners",value:function(){return function(){this.state.eventsEnabled||(this.state=ne(this.reference,this.options,this.state,this.scheduleUpdate))}.call(this)}},{key:"disableEventListeners",value:function(){return ie.call(this)}}]),t}();de.Utils=("undefined"!=typeof window?window:global).PopperUtils,de.placements=ae,de.Defaults=ue;var pe,ge,me,_e,ve,Ee,ye,be,Te,Ce,we,Ie,Ae,De,Se,Oe,Ne,ke,Le,Pe,xe,Re,je,He,Me,We,Ue,Fe,Be,Ke,Ve,Qe,Ye,Ge,qe,ze,Xe,Je,Ze,$e,tn,en,nn,rn,on,sn,an,ln,cn,hn,fn,un,dn,pn,gn,mn,_n,vn,En,yn,bn,Tn,Cn,wn,In,An,Dn,Sn,On,Nn,kn,Ln,Pn,xn,Rn,jn,Hn,Mn,Wn,Un,Fn,Bn,Kn,Vn,Qn,Yn,Gn,qn,zn,Xn,Jn,Zn,$n,ti,ei,ni,ii,ri,oi,si,ai,li,ci,hi,fi,ui,di,pi,gi,mi,_i,vi,Ei,yi=(ge="dropdown",_e="."+(me="bs.dropdown"),ve=".data-api",Ee=(pe=e).fn[ge],ye=new RegExp("38|40|27"),be={HIDE:"hide"+_e,HIDDEN:"hidden"+_e,SHOW:"show"+_e,SHOWN:"shown"+_e,CLICK:"click"+_e,CLICK_DATA_API:"click"+_e+ve,KEYDOWN_DATA_API:"keydown"+_e+ve,KEYUP_DATA_API:"keyup"+_e+ve},Te="disabled",Ce="show",we="dropup",Ie="dropright",Ae="dropleft",De="dropdown-menu-right",Se="position-static",Oe='[data-toggle="dropdown"]',Ne=".dropdown form",ke=".dropdown-menu",Le=".navbar-nav",Pe=".dropdown-menu .dropdown-item:not(.disabled)",xe="top-start",Re="top-end",je="bottom-start",He="bottom-end",Me="right-start",We="left-start",Ue={offset:0,flip:!0,boundary:"scrollParent",reference:"toggle",display:"dynamic"},Fe={offset:"(number|string|function)",flip:"boolean",boundary:"(string|element)",reference:"(string|element)",display:"string"},Be=function(){function t(t,e){this._element=t,this._popper=null,this._config=this._getConfig(e),this._menu=this._getMenuElement(),this._inNavbar=this._detectNavbar(),this._addEventListeners()}var e=t.prototype;return e.toggle=function(){if(!this._element.disabled&&!pe(this._element).hasClass(Te)){var e=t._getParentFromElement(this._element),n=pe(this._menu).hasClass(Ce);if(t._clearMenus(),!n){var i={relatedTarget:this._element},r=pe.Event(be.SHOW,i);if(pe(e).trigger(r),!r.isDefaultPrevented()){if(!this._inNavbar){if("undefined"==typeof de)throw new TypeError("Bootstrap dropdown require Popper.js (https://popper.js.org)");var o=this._element;"parent"===this._config.reference?o=e:gt.isElement(this._config.reference)&&(o=this._config.reference,"undefined"!=typeof this._config.reference.jquery&&(o=this._config.reference[0])),"scrollParent"!==this._config.boundary&&pe(e).addClass(Se),this._popper=new de(o,this._menu,this._getPopperConfig())}"ontouchstart"in document.documentElement&&0===pe(e).closest(Le).length&&pe(document.body).children().on("mouseover",null,pe.noop),this._element.focus(),this._element.setAttribute("aria-expanded",!0),pe(this._menu).toggleClass(Ce),pe(e).toggleClass(Ce).trigger(pe.Event(be.SHOWN,i))}}}},e.dispose=function(){pe.removeData(this._element,me),pe(this._element).off(_e),this._element=null,this._menu=null,null!==this._popper&&(this._popper.destroy(),this._popper=null)},e.update=function(){this._inNavbar=this._detectNavbar(),null!==this._popper&&this._popper.scheduleUpdate()},e._addEventListeners=function(){var t=this;pe(this._element).on(be.CLICK,function(e){e.preventDefault(),e.stopPropagation(),t.toggle()})},e._getConfig=function(t){return t=r({},this.constructor.Default,pe(this._element).data(),t),gt.typeCheckConfig(ge,t,this.constructor.DefaultType),t},e._getMenuElement=function(){if(!this._menu){var e=t._getParentFromElement(this._element);this._menu=pe(e).find(ke)[0]}return this._menu},e._getPlacement=function(){var t=pe(this._element).parent(),e=je;return t.hasClass(we)?(e=xe,pe(this._menu).hasClass(De)&&(e=Re)):t.hasClass(Ie)?e=Me:t.hasClass(Ae)?e=We:pe(this._menu).hasClass(De)&&(e=He),e},e._detectNavbar=function(){return pe(this._element).closest(".navbar").length>0},e._getPopperConfig=function(){var t=this,e={};"function"==typeof this._config.offset?e.fn=function(e){return e.offsets=r({},e.offsets,t._config.offset(e.offsets)||{}),e}:e.offset=this._config.offset;var n={placement:this._getPlacement(),modifiers:{offset:e,flip:{enabled:this._config.flip},preventOverflow:{boundariesElement:this._config.boundary}}};return"static"===this._config.display&&(n.modifiers.applyStyle={enabled:!1}),n},t._jQueryInterface=function(e){return this.each(function(){var n=pe(this).data(me);if(n||(n=new t(this,"object"==typeof e?e:null),pe(this).data(me,n)),"string"==typeof e){if("undefined"==typeof n[e])throw new TypeError('No method named "'+e+'"');n[e]()}})},t._clearMenus=function(e){if(!e||3!==e.which&&("keyup"!==e.type||9===e.which))for(var n=pe.makeArray(pe(Oe)),i=0;i<n.length;i++){var r=t._getParentFromElement(n[i]),o=pe(n[i]).data(me),s={relatedTarget:n[i]};if(o){var a=o._menu;if(pe(r).hasClass(Ce)&&!(e&&("click"===e.type&&/input|textarea/i.test(e.target.tagName)||"keyup"===e.type&&9===e.which)&&pe.contains(r,e.target))){var l=pe.Event(be.HIDE,s);pe(r).trigger(l),l.isDefaultPrevented()||("ontouchstart"in document.documentElement&&pe(document.body).children().off("mouseover",null,pe.noop),n[i].setAttribute("aria-expanded","false"),pe(a).removeClass(Ce),pe(r).removeClass(Ce).trigger(pe.Event(be.HIDDEN,s)))}}}},t._getParentFromElement=function(t){var e,n=gt.getSelectorFromElement(t);return n&&(e=pe(n)[0]),e||t.parentNode},t._dataApiKeydownHandler=function(e){if((/input|textarea/i.test(e.target.tagName)?!(32===e.which||27!==e.which&&(40!==e.which&&38!==e.which||pe(e.target).closest(ke).length)):ye.test(e.which))&&(e.preventDefault(),e.stopPropagation(),!this.disabled&&!pe(this).hasClass(Te))){var n=t._getParentFromElement(this),i=pe(n).hasClass(Ce);if((i||27===e.which&&32===e.which)&&(!i||27!==e.which&&32!==e.which)){var r=pe(n).find(Pe).get();if(0!==r.length){var o=r.indexOf(e.target);38===e.which&&o>0&&o--,40===e.which&&o<r.length-1&&o++,o<0&&(o=0),r[o].focus()}}else{if(27===e.which){var s=pe(n).find(Oe)[0];pe(s).trigger("focus")}pe(this).trigger("click")}}},i(t,null,[{key:"VERSION",get:function(){return"4.0.0"}},{key:"Default",get:function(){return Ue}},{key:"DefaultType",get:function(){return Fe}}]),t}(),pe(document).on(be.KEYDOWN_DATA_API,Oe,Be._dataApiKeydownHandler).on(be.KEYDOWN_DATA_API,ke,Be._dataApiKeydownHandler).on(be.CLICK_DATA_API+" "+be.KEYUP_DATA_API,Be._clearMenus).on(be.CLICK_DATA_API,Oe,function(t){t.preventDefault(),t.stopPropagation(),Be._jQueryInterface.call(pe(this),"toggle")}).on(be.CLICK_DATA_API,Ne,function(t){t.stopPropagation()}),pe.fn[ge]=Be._jQueryInterface,pe.fn[ge].Constructor=Be,pe.fn[ge].noConflict=function(){return pe.fn[ge]=Ee,Be._jQueryInterface},Be),bi=(Ve="modal",Ye="."+(Qe="bs.modal"),Ge=(Ke=e).fn[Ve],qe={backdrop:!0,keyboard:!0,focus:!0,show:!0},ze={backdrop:"(boolean|string)",keyboard:"boolean",focus:"boolean",show:"boolean"},Xe={HIDE:"hide"+Ye,HIDDEN:"hidden"+Ye,SHOW:"show"+Ye,SHOWN:"shown"+Ye,FOCUSIN:"focusin"+Ye,RESIZE:"resize"+Ye,CLICK_DISMISS:"click.dismiss"+Ye,KEYDOWN_DISMISS:"keydown.dismiss"+Ye,MOUSEUP_DISMISS:"mouseup.dismiss"+Ye,MOUSEDOWN_DISMISS:"mousedown.dismiss"+Ye,CLICK_DATA_API:"click"+Ye+".data-api"},Je="modal-scrollbar-measure",Ze="modal-backdrop",$e="modal-open",tn="fade",en="show",nn={DIALOG:".modal-dialog",DATA_TOGGLE:'[data-toggle="modal"]',DATA_DISMISS:'[data-dismiss="modal"]',FIXED_CONTENT:".fixed-top, .fixed-bottom, .is-fixed, .sticky-top",STICKY_CONTENT:".sticky-top",NAVBAR_TOGGLER:".navbar-toggler"},rn=function(){function t(t,e){this._config=this._getConfig(e),this._element=t,this._dialog=Ke(t).find(nn.DIALOG)[0],this._backdrop=null,this._isShown=!1,this._isBodyOverflowing=!1,this._ignoreBackdropClick=!1,this._originalBodyPadding=0,this._scrollbarWidth=0}var e=t.prototype;return e.toggle=function(t){return this._isShown?this.hide():this.show(t)},e.show=function(t){var e=this;if(!this._isTransitioning&&!this._isShown){gt.supportsTransitionEnd()&&Ke(this._element).hasClass(tn)&&(this._isTransitioning=!0);var n=Ke.Event(Xe.SHOW,{relatedTarget:t});Ke(this._element).trigger(n),this._isShown||n.isDefaultPrevented()||(this._isShown=!0,this._checkScrollbar(),this._setScrollbar(),this._adjustDialog(),Ke(document.body).addClass($e),this._setEscapeEvent(),this._setResizeEvent(),Ke(this._element).on(Xe.CLICK_DISMISS,nn.DATA_DISMISS,function(t){return e.hide(t)}),Ke(this._dialog).on(Xe.MOUSEDOWN_DISMISS,function(){Ke(e._element).one(Xe.MOUSEUP_DISMISS,function(t){Ke(t.target).is(e._element)&&(e._ignoreBackdropClick=!0)})}),this._showBackdrop(function(){return e._showElement(t)}))}},e.hide=function(t){var e=this;if(t&&t.preventDefault(),!this._isTransitioning&&this._isShown){var n=Ke.Event(Xe.HIDE);if(Ke(this._element).trigger(n),this._isShown&&!n.isDefaultPrevented()){this._isShown=!1;var i=gt.supportsTransitionEnd()&&Ke(this._element).hasClass(tn);i&&(this._isTransitioning=!0),this._setEscapeEvent(),this._setResizeEvent(),Ke(document).off(Xe.FOCUSIN),Ke(this._element).removeClass(en),Ke(this._element).off(Xe.CLICK_DISMISS),Ke(this._dialog).off(Xe.MOUSEDOWN_DISMISS),i?Ke(this._element).one(gt.TRANSITION_END,function(t){return e._hideModal(t)}).emulateTransitionEnd(300):this._hideModal()}}},e.dispose=function(){Ke.removeData(this._element,Qe),Ke(window,document,this._element,this._backdrop).off(Ye),this._config=null,this._element=null,this._dialog=null,this._backdrop=null,this._isShown=null,this._isBodyOverflowing=null,this._ignoreBackdropClick=null,this._scrollbarWidth=null},e.handleUpdate=function(){this._adjustDialog()},e._getConfig=function(t){return t=r({},qe,t),gt.typeCheckConfig(Ve,t,ze),t},e._showElement=function(t){var e=this,n=gt.supportsTransitionEnd()&&Ke(this._element).hasClass(tn);this._element.parentNode&&this._element.parentNode.nodeType===Node.ELEMENT_NODE||document.body.appendChild(this._element),this._element.style.display="block",this._element.removeAttribute("aria-hidden"),this._element.scrollTop=0,n&&gt.reflow(this._element),Ke(this._element).addClass(en),this._config.focus&&this._enforceFocus();var i=Ke.Event(Xe.SHOWN,{relatedTarget:t}),r=function(){e._config.focus&&e._element.focus(),e._isTransitioning=!1,Ke(e._element).trigger(i)};n?Ke(this._dialog).one(gt.TRANSITION_END,r).emulateTransitionEnd(300):r()},e._enforceFocus=function(){var t=this;Ke(document).off(Xe.FOCUSIN).on(Xe.FOCUSIN,function(e){document!==e.target&&t._element!==e.target&&0===Ke(t._element).has(e.target).length&&t._element.focus()})},e._setEscapeEvent=function(){var t=this;this._isShown&&this._config.keyboard?Ke(this._element).on(Xe.KEYDOWN_DISMISS,function(e){27===e.which&&(e.preventDefault(),t.hide())}):this._isShown||Ke(this._element).off(Xe.KEYDOWN_DISMISS)},e._setResizeEvent=function(){var t=this;this._isShown?Ke(window).on(Xe.RESIZE,function(e){return t.handleUpdate(e)}):Ke(window).off(Xe.RESIZE)},e._hideModal=function(){var t=this;this._element.style.display="none",this._element.setAttribute("aria-hidden",!0),this._isTransitioning=!1,this._showBackdrop(function(){Ke(document.body).removeClass($e),t._resetAdjustments(),t._resetScrollbar(),Ke(t._element).trigger(Xe.HIDDEN)})},e._removeBackdrop=function(){this._backdrop&&(Ke(this._backdrop).remove(),this._backdrop=null)},e._showBackdrop=function(t){var e=this,n=Ke(this._element).hasClass(tn)?tn:"";if(this._isShown&&this._config.backdrop){var i=gt.supportsTransitionEnd()&&n;if(this._backdrop=document.createElement("div"),this._backdrop.className=Ze,n&&Ke(this._backdrop).addClass(n),Ke(this._backdrop).appendTo(document.body),Ke(this._element).on(Xe.CLICK_DISMISS,function(t){e._ignoreBackdropClick?e._ignoreBackdropClick=!1:t.target===t.currentTarget&&("static"===e._config.backdrop?e._element.focus():e.hide())}),i&&gt.reflow(this._backdrop),Ke(this._backdrop).addClass(en),!t)return;if(!i)return void t();Ke(this._backdrop).one(gt.TRANSITION_END,t).emulateTransitionEnd(150)}else if(!this._isShown&&this._backdrop){Ke(this._backdrop).removeClass(en);var r=function(){e._removeBackdrop(),t&&t()};gt.supportsTransitionEnd()&&Ke(this._element).hasClass(tn)?Ke(this._backdrop).one(gt.TRANSITION_END,r).emulateTransitionEnd(150):r()}else t&&t()},e._adjustDialog=function(){var t=this._element.scrollHeight>document.documentElement.clientHeight;!this._isBodyOverflowing&&t&&(this._element.style.paddingLeft=this._scrollbarWidth+"px"),this._isBodyOverflowing&&!t&&(this._element.style.paddingRight=this._scrollbarWidth+"px")},e._resetAdjustments=function(){this._element.style.paddingLeft="",this._element.style.paddingRight=""},e._checkScrollbar=function(){var t=document.body.getBoundingClientRect();this._isBodyOverflowing=t.left+t.right<window.innerWidth,this._scrollbarWidth=this._getScrollbarWidth()},e._setScrollbar=function(){var t=this;if(this._isBodyOverflowing){Ke(nn.FIXED_CONTENT).each(function(e,n){var i=Ke(n)[0].style.paddingRight,r=Ke(n).css("padding-right");Ke(n).data("padding-right",i).css("padding-right",parseFloat(r)+t._scrollbarWidth+"px")}),Ke(nn.STICKY_CONTENT).each(function(e,n){var i=Ke(n)[0].style.marginRight,r=Ke(n).css("margin-right");Ke(n).data("margin-right",i).css("margin-right",parseFloat(r)-t._scrollbarWidth+"px")}),Ke(nn.NAVBAR_TOGGLER).each(function(e,n){var i=Ke(n)[0].style.marginRight,r=Ke(n).css("margin-right");Ke(n).data("margin-right",i).css("margin-right",parseFloat(r)+t._scrollbarWidth+"px")});var e=document.body.style.paddingRight,n=Ke(document.body).css("padding-right");Ke(document.body).data("padding-right",e).css("padding-right",parseFloat(n)+this._scrollbarWidth+"px")}},e._resetScrollbar=function(){Ke(nn.FIXED_CONTENT).each(function(t,e){var n=Ke(e).data("padding-right");"undefined"!=typeof n&&Ke(e).css("padding-right",n).removeData("padding-right")}),Ke(nn.STICKY_CONTENT+", "+nn.NAVBAR_TOGGLER).each(function(t,e){var n=Ke(e).data("margin-right");"undefined"!=typeof n&&Ke(e).css("margin-right",n).removeData("margin-right")});var t=Ke(document.body).data("padding-right");"undefined"!=typeof t&&Ke(document.body).css("padding-right",t).removeData("padding-right")},e._getScrollbarWidth=function(){var t=document.createElement("div");t.className=Je,document.body.appendChild(t);var e=t.getBoundingClientRect().width-t.clientWidth;return document.body.removeChild(t),e},t._jQueryInterface=function(e,n){return this.each(function(){var i=Ke(this).data(Qe),o=r({},t.Default,Ke(this).data(),"object"==typeof e&&e);if(i||(i=new t(this,o),Ke(this).data(Qe,i)),"string"==typeof e){if("undefined"==typeof i[e])throw new TypeError('No method named "'+e+'"');i[e](n)}else o.show&&i.show(n)})},i(t,null,[{key:"VERSION",get:function(){return"4.0.0"}},{key:"Default",get:function(){return qe}}]),t}(),Ke(document).on(Xe.CLICK_DATA_API,nn.DATA_TOGGLE,function(t){var e,n=this,i=gt.getSelectorFromElement(this);i&&(e=Ke(i)[0]);var o=Ke(e).data(Qe)?"toggle":r({},Ke(e).data(),Ke(this).data());"A"!==this.tagName&&"AREA"!==this.tagName||t.preventDefault();var s=Ke(e).one(Xe.SHOW,function(t){t.isDefaultPrevented()||s.one(Xe.HIDDEN,function(){Ke(n).is(":visible")&&n.focus()})});rn._jQueryInterface.call(Ke(e),o,this)}),Ke.fn[Ve]=rn._jQueryInterface,Ke.fn[Ve].Constructor=rn,Ke.fn[Ve].noConflict=function(){return Ke.fn[Ve]=Ge,rn._jQueryInterface},rn),Ti=(sn="tooltip",ln="."+(an="bs.tooltip"),cn=(on=e).fn[sn],hn="bs-tooltip",fn=new RegExp("(^|\\s)"+hn+"\\S+","g"),un={animation:"boolean",template:"string",title:"(string|element|function)",trigger:"string",delay:"(number|object)",html:"boolean",selector:"(string|boolean)",placement:"(string|function)",offset:"(number|string)",container:"(string|element|boolean)",fallbackPlacement:"(string|array)",boundary:"(string|element)"},dn={AUTO:"auto",TOP:"top",RIGHT:"right",BOTTOM:"bottom",LEFT:"left"},pn={animation:!0,template:'<div class="tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>',trigger:"hover focus",title:"",delay:0,html:!1,selector:!1,placement:"top",offset:0,container:!1,fallbackPlacement:"flip",boundary:"scrollParent"},gn="show",mn="out",_n={HIDE:"hide"+ln,HIDDEN:"hidden"+ln,SHOW:"show"+ln,SHOWN:"shown"+ln,INSERTED:"inserted"+ln,CLICK:"click"+ln,FOCUSIN:"focusin"+ln,FOCUSOUT:"focusout"+ln,MOUSEENTER:"mouseenter"+ln,MOUSELEAVE:"mouseleave"+ln},vn="fade",En="show",yn=".tooltip-inner",bn=".arrow",Tn="hover",Cn="focus",wn="click",In="manual",An=function(){function t(t,e){if("undefined"==typeof de)throw new TypeError("Bootstrap tooltips require Popper.js (https://popper.js.org)");this._isEnabled=!0,this._timeout=0,this._hoverState="",this._activeTrigger={},this._popper=null,this.element=t,this.config=this._getConfig(e),this.tip=null,this._setListeners()}var e=t.prototype;return e.enable=function(){this._isEnabled=!0},e.disable=function(){this._isEnabled=!1},e.toggleEnabled=function(){this._isEnabled=!this._isEnabled},e.toggle=function(t){if(this._isEnabled)if(t){var e=this.constructor.DATA_KEY,n=on(t.currentTarget).data(e);n||(n=new this.constructor(t.currentTarget,this._getDelegateConfig()),on(t.currentTarget).data(e,n)),n._activeTrigger.click=!n._activeTrigger.click,n._isWithActiveTrigger()?n._enter(null,n):n._leave(null,n)}else{if(on(this.getTipElement()).hasClass(En))return void this._leave(null,this);this._enter(null,this)}},e.dispose=function(){clearTimeout(this._timeout),on.removeData(this.element,this.constructor.DATA_KEY),on(this.element).off(this.constructor.EVENT_KEY),on(this.element).closest(".modal").off("hide.bs.modal"),this.tip&&on(this.tip).remove(),this._isEnabled=null,this._timeout=null,this._hoverState=null,this._activeTrigger=null,null!==this._popper&&this._popper.destroy(),this._popper=null,this.element=null,this.config=null,this.tip=null},e.show=function(){var e=this;if("none"===on(this.element).css("display"))throw new Error("Please use show on visible elements");var n=on.Event(this.constructor.Event.SHOW);if(this.isWithContent()&&this._isEnabled){on(this.element).trigger(n);var i=on.contains(this.element.ownerDocument.documentElement,this.element);if(n.isDefaultPrevented()||!i)return;var r=this.getTipElement(),o=gt.getUID(this.constructor.NAME);r.setAttribute("id",o),this.element.setAttribute("aria-describedby",o),this.setContent(),this.config.animation&&on(r).addClass(vn);var s="function"==typeof this.config.placement?this.config.placement.call(this,r,this.element):this.config.placement,a=this._getAttachment(s);this.addAttachmentClass(a);var l=!1===this.config.container?document.body:on(this.config.container);on(r).data(this.constructor.DATA_KEY,this),on.contains(this.element.ownerDocument.documentElement,this.tip)||on(r).appendTo(l),on(this.element).trigger(this.constructor.Event.INSERTED),this._popper=new de(this.element,r,{placement:a,modifiers:{offset:{offset:this.config.offset},flip:{behavior:this.config.fallbackPlacement},arrow:{element:bn},preventOverflow:{boundariesElement:this.config.boundary}},onCreate:function(t){t.originalPlacement!==t.placement&&e._handlePopperPlacementChange(t)},onUpdate:function(t){e._handlePopperPlacementChange(t)}}),on(r).addClass(En),"ontouchstart"in document.documentElement&&on(document.body).children().on("mouseover",null,on.noop);var c=function(){e.config.animation&&e._fixTransition();var t=e._hoverState;e._hoverState=null,on(e.element).trigger(e.constructor.Event.SHOWN),t===mn&&e._leave(null,e)};gt.supportsTransitionEnd()&&on(this.tip).hasClass(vn)?on(this.tip).one(gt.TRANSITION_END,c).emulateTransitionEnd(t._TRANSITION_DURATION):c()}},e.hide=function(t){var e=this,n=this.getTipElement(),i=on.Event(this.constructor.Event.HIDE),r=function(){e._hoverState!==gn&&n.parentNode&&n.parentNode.removeChild(n),e._cleanTipClass(),e.element.removeAttribute("aria-describedby"),on(e.element).trigger(e.constructor.Event.HIDDEN),null!==e._popper&&e._popper.destroy(),t&&t()};on(this.element).trigger(i),i.isDefaultPrevented()||(on(n).removeClass(En),"ontouchstart"in document.documentElement&&on(document.body).children().off("mouseover",null,on.noop),this._activeTrigger[wn]=!1,this._activeTrigger[Cn]=!1,this._activeTrigger[Tn]=!1,gt.supportsTransitionEnd()&&on(this.tip).hasClass(vn)?on(n).one(gt.TRANSITION_END,r).emulateTransitionEnd(150):r(),this._hoverState="")},e.update=function(){null!==this._popper&&this._popper.scheduleUpdate()},e.isWithContent=function(){return Boolean(this.getTitle())},e.addAttachmentClass=function(t){on(this.getTipElement()).addClass(hn+"-"+t)},e.getTipElement=function(){return this.tip=this.tip||on(this.config.template)[0],this.tip},e.setContent=function(){var t=on(this.getTipElement());this.setElementContent(t.find(yn),this.getTitle()),t.removeClass(vn+" "+En)},e.setElementContent=function(t,e){var n=this.config.html;"object"==typeof e&&(e.nodeType||e.jquery)?n?on(e).parent().is(t)||t.empty().append(e):t.text(on(e).text()):t[n?"html":"text"](e)},e.getTitle=function(){var t=this.element.getAttribute("data-original-title");return t||(t="function"==typeof this.config.title?this.config.title.call(this.element):this.config.title),t},e._getAttachment=function(t){return dn[t.toUpperCase()]},e._setListeners=function(){var t=this;this.config.trigger.split(" ").forEach(function(e){if("click"===e)on(t.element).on(t.constructor.Event.CLICK,t.config.selector,function(e){return t.toggle(e)});else if(e!==In){var n=e===Tn?t.constructor.Event.MOUSEENTER:t.constructor.Event.FOCUSIN,i=e===Tn?t.constructor.Event.MOUSELEAVE:t.constructor.Event.FOCUSOUT;on(t.element).on(n,t.config.selector,function(e){return t._enter(e)}).on(i,t.config.selector,function(e){return t._leave(e)})}on(t.element).closest(".modal").on("hide.bs.modal",function(){return t.hide()})}),this.config.selector?this.config=r({},this.config,{trigger:"manual",selector:""}):this._fixTitle()},e._fixTitle=function(){var t=typeof this.element.getAttribute("data-original-title");(this.element.getAttribute("title")||"string"!==t)&&(this.element.setAttribute("data-original-title",this.element.getAttribute("title")||""),this.element.setAttribute("title",""))},e._enter=function(t,e){var n=this.constructor.DATA_KEY;(e=e||on(t.currentTarget).data(n))||(e=new this.constructor(t.currentTarget,this._getDelegateConfig()),on(t.currentTarget).data(n,e)),t&&(e._activeTrigger["focusin"===t.type?Cn:Tn]=!0),on(e.getTipElement()).hasClass(En)||e._hoverState===gn?e._hoverState=gn:(clearTimeout(e._timeout),e._hoverState=gn,e.config.delay&&e.config.delay.show?e._timeout=setTimeout(function(){e._hoverState===gn&&e.show()},e.config.delay.show):e.show())},e._leave=function(t,e){var n=this.constructor.DATA_KEY;(e=e||on(t.currentTarget).data(n))||(e=new this.constructor(t.currentTarget,this._getDelegateConfig()),on(t.currentTarget).data(n,e)),t&&(e._activeTrigger["focusout"===t.type?Cn:Tn]=!1),e._isWithActiveTrigger()||(clearTimeout(e._timeout),e._hoverState=mn,e.config.delay&&e.config.delay.hide?e._timeout=setTimeout(function(){e._hoverState===mn&&e.hide()},e.config.delay.hide):e.hide())},e._isWithActiveTrigger=function(){for(var t in this._activeTrigger)if(this._activeTrigger[t])return!0;return!1},e._getConfig=function(t){return"number"==typeof(t=r({},this.constructor.Default,on(this.element).data(),t)).delay&&(t.delay={show:t.delay,hide:t.delay}),"number"==typeof t.title&&(t.title=t.title.toString()),"number"==typeof t.content&&(t.content=t.content.toString()),gt.typeCheckConfig(sn,t,this.constructor.DefaultType),t},e._getDelegateConfig=function(){var t={};if(this.config)for(var e in this.config)this.constructor.Default[e]!==this.config[e]&&(t[e]=this.config[e]);return t},e._cleanTipClass=function(){var t=on(this.getTipElement()),e=t.attr("class").match(fn);null!==e&&e.length>0&&t.removeClass(e.join(""))},e._handlePopperPlacementChange=function(t){this._cleanTipClass(),this.addAttachmentClass(this._getAttachment(t.placement))},e._fixTransition=function(){var t=this.getTipElement(),e=this.config.animation;null===t.getAttribute("x-placement")&&(on(t).removeClass(vn),this.config.animation=!1,this.hide(),this.show(),this.config.animation=e)},t._jQueryInterface=function(e){return this.each(function(){var n=on(this).data(an),i="object"==typeof e&&e;if((n||!/dispose|hide/.test(e))&&(n||(n=new t(this,i),on(this).data(an,n)),"string"==typeof e)){if("undefined"==typeof n[e])throw new TypeError('No method named "'+e+'"');n[e]()}})},i(t,null,[{key:"VERSION",get:function(){return"4.0.0"}},{key:"Default",get:function(){return pn}},{key:"NAME",get:function(){return sn}},{key:"DATA_KEY",get:function(){return an}},{key:"Event",get:function(){return _n}},{key:"EVENT_KEY",get:function(){return ln}},{key:"DefaultType",get:function(){return un}}]),t}(),on.fn[sn]=An._jQueryInterface,on.fn[sn].Constructor=An,on.fn[sn].noConflict=function(){return on.fn[sn]=cn,An._jQueryInterface},An),Ci=(Sn="popover",Nn="."+(On="bs.popover"),kn=(Dn=e).fn[Sn],Ln="bs-popover",Pn=new RegExp("(^|\\s)"+Ln+"\\S+","g"),xn=r({},Ti.Default,{placement:"right",trigger:"click",content:"",template:'<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>'}),Rn=r({},Ti.DefaultType,{content:"(string|element|function)"}),jn="fade",Hn="show",Mn=".popover-header",Wn=".popover-body",Un={HIDE:"hide"+Nn,HIDDEN:"hidden"+Nn,SHOW:"show"+Nn,SHOWN:"shown"+Nn,INSERTED:"inserted"+Nn,CLICK:"click"+Nn,FOCUSIN:"focusin"+Nn,FOCUSOUT:"focusout"+Nn,MOUSEENTER:"mouseenter"+Nn,MOUSELEAVE:"mouseleave"+Nn},Fn=function(t){var e,n;function r(){return t.apply(this,arguments)||this}n=t,(e=r).prototype=Object.create(n.prototype),e.prototype.constructor=e,e.__proto__=n;var o=r.prototype;return o.isWithContent=function(){return this.getTitle()||this._getContent()},o.addAttachmentClass=function(t){Dn(this.getTipElement()).addClass(Ln+"-"+t)},o.getTipElement=function(){return this.tip=this.tip||Dn(this.config.template)[0],this.tip},o.setContent=function(){var t=Dn(this.getTipElement());this.setElementContent(t.find(Mn),this.getTitle());var e=this._getContent();"function"==typeof e&&(e=e.call(this.element)),this.setElementContent(t.find(Wn),e),t.removeClass(jn+" "+Hn)},o._getContent=function(){return this.element.getAttribute("data-content")||this.config.content},o._cleanTipClass=function(){var t=Dn(this.getTipElement()),e=t.attr("class").match(Pn);null!==e&&e.length>0&&t.removeClass(e.join(""))},r._jQueryInterface=function(t){return this.each(function(){var e=Dn(this).data(On),n="object"==typeof t?t:null;if((e||!/destroy|hide/.test(t))&&(e||(e=new r(this,n),Dn(this).data(On,e)),"string"==typeof t)){if("undefined"==typeof e[t])throw new TypeError('No method named "'+t+'"');e[t]()}})},i(r,null,[{key:"VERSION",get:function(){return"4.0.0"}},{key:"Default",get:function(){return xn}},{key:"NAME",get:function(){return Sn}},{key:"DATA_KEY",get:function(){return On}},{key:"Event",get:function(){return Un}},{key:"EVENT_KEY",get:function(){return Nn}},{key:"DefaultType",get:function(){return Rn}}]),r}(Ti),Dn.fn[Sn]=Fn._jQueryInterface,Dn.fn[Sn].Constructor=Fn,Dn.fn[Sn].noConflict=function(){return Dn.fn[Sn]=kn,Fn._jQueryInterface},Fn),wi=(Kn="scrollspy",Qn="."+(Vn="bs.scrollspy"),Yn=(Bn=e).fn[Kn],Gn={offset:10,method:"auto",target:""},qn={offset:"number",method:"string",target:"(string|element)"},zn={ACTIVATE:"activate"+Qn,SCROLL:"scroll"+Qn,LOAD_DATA_API:"load"+Qn+".data-api"},Xn="dropdown-item",Jn="active",Zn={DATA_SPY:'[data-spy="scroll"]',ACTIVE:".active",NAV_LIST_GROUP:".nav, .list-group",NAV_LINKS:".nav-link",NAV_ITEMS:".nav-item",LIST_ITEMS:".list-group-item",DROPDOWN:".dropdown",DROPDOWN_ITEMS:".dropdown-item",DROPDOWN_TOGGLE:".dropdown-toggle"},$n="offset",ti="position",ei=function(){function t(t,e){var n=this;this._element=t,this._scrollElement="BODY"===t.tagName?window:t,this._config=this._getConfig(e),this._selector=this._config.target+" "+Zn.NAV_LINKS+","+this._config.target+" "+Zn.LIST_ITEMS+","+this._config.target+" "+Zn.DROPDOWN_ITEMS,this._offsets=[],this._targets=[],this._activeTarget=null,this._scrollHeight=0,Bn(this._scrollElement).on(zn.SCROLL,function(t){return n._process(t)}),this.refresh(),this._process()}var e=t.prototype;return e.refresh=function(){var t=this,e=this._scrollElement===this._scrollElement.window?$n:ti,n="auto"===this._config.method?e:this._config.method,i=n===ti?this._getScrollTop():0;this._offsets=[],this._targets=[],this._scrollHeight=this._getScrollHeight(),Bn.makeArray(Bn(this._selector)).map(function(t){var e,r=gt.getSelectorFromElement(t);if(r&&(e=Bn(r)[0]),e){var o=e.getBoundingClientRect();if(o.width||o.height)return[Bn(e)[n]().top+i,r]}return null}).filter(function(t){return t}).sort(function(t,e){return t[0]-e[0]}).forEach(function(e){t._offsets.push(e[0]),t._targets.push(e[1])})},e.dispose=function(){Bn.removeData(this._element,Vn),Bn(this._scrollElement).off(Qn),this._element=null,this._scrollElement=null,this._config=null,this._selector=null,this._offsets=null,this._targets=null,this._activeTarget=null,this._scrollHeight=null},e._getConfig=function(t){if("string"!=typeof(t=r({},Gn,t)).target){var e=Bn(t.target).attr("id");e||(e=gt.getUID(Kn),Bn(t.target).attr("id",e)),t.target="#"+e}return gt.typeCheckConfig(Kn,t,qn),t},e._getScrollTop=function(){return this._scrollElement===window?this._scrollElement.pageYOffset:this._scrollElement.scrollTop},e._getScrollHeight=function(){return this._scrollElement.scrollHeight||Math.max(document.body.scrollHeight,document.documentElement.scrollHeight)},e._getOffsetHeight=function(){return this._scrollElement===window?window.innerHeight:this._scrollElement.getBoundingClientRect().height},e._process=function(){var t=this._getScrollTop()+this._config.offset,e=this._getScrollHeight(),n=this._config.offset+e-this._getOffsetHeight();if(this._scrollHeight!==e&&this.refresh(),t>=n){var i=this._targets[this._targets.length-1];this._activeTarget!==i&&this._activate(i)}else{if(this._activeTarget&&t<this._offsets[0]&&this._offsets[0]>0)return this._activeTarget=null,void this._clear();for(var r=this._offsets.length;r--;){this._activeTarget!==this._targets[r]&&t>=this._offsets[r]&&("undefined"==typeof this._offsets[r+1]||t<this._offsets[r+1])&&this._activate(this._targets[r])}}},e._activate=function(t){this._activeTarget=t,this._clear();var e=this._selector.split(",");e=e.map(function(e){return e+'[data-target="'+t+'"],'+e+'[href="'+t+'"]'});var n=Bn(e.join(","));n.hasClass(Xn)?(n.closest(Zn.DROPDOWN).find(Zn.DROPDOWN_TOGGLE).addClass(Jn),n.addClass(Jn)):(n.addClass(Jn),n.parents(Zn.NAV_LIST_GROUP).prev(Zn.NAV_LINKS+", "+Zn.LIST_ITEMS).addClass(Jn),n.parents(Zn.NAV_LIST_GROUP).prev(Zn.NAV_ITEMS).children(Zn.NAV_LINKS).addClass(Jn)),Bn(this._scrollElement).trigger(zn.ACTIVATE,{relatedTarget:t})},e._clear=function(){Bn(this._selector).filter(Zn.ACTIVE).removeClass(Jn)},t._jQueryInterface=function(e){return this.each(function(){var n=Bn(this).data(Vn);if(n||(n=new t(this,"object"==typeof e&&e),Bn(this).data(Vn,n)),"string"==typeof e){if("undefined"==typeof n[e])throw new TypeError('No method named "'+e+'"');n[e]()}})},i(t,null,[{key:"VERSION",get:function(){return"4.0.0"}},{key:"Default",get:function(){return Gn}}]),t}(),Bn(window).on(zn.LOAD_DATA_API,function(){for(var t=Bn.makeArray(Bn(Zn.DATA_SPY)),e=t.length;e--;){var n=Bn(t[e]);ei._jQueryInterface.call(n,n.data())}}),Bn.fn[Kn]=ei._jQueryInterface,Bn.fn[Kn].Constructor=ei,Bn.fn[Kn].noConflict=function(){return Bn.fn[Kn]=Yn,ei._jQueryInterface},ei),Ii=(ri="."+(ii="bs.tab"),oi=(ni=e).fn.tab,si={HIDE:"hide"+ri,HIDDEN:"hidden"+ri,SHOW:"show"+ri,SHOWN:"shown"+ri,CLICK_DATA_API:"click"+ri+".data-api"},ai="dropdown-menu",li="active",ci="disabled",hi="fade",fi="show",ui=".dropdown",di=".nav, .list-group",pi=".active",gi="> li > .active",mi='[data-toggle="tab"], [data-toggle="pill"], [data-toggle="list"]',_i=".dropdown-toggle",vi="> .dropdown-menu .active",Ei=function(){function t(t){this._element=t}var e=t.prototype;return e.show=function(){var t=this;if(!(this._element.parentNode&&this._element.parentNode.nodeType===Node.ELEMENT_NODE&&ni(this._element).hasClass(li)||ni(this._element).hasClass(ci))){var e,n,i=ni(this._element).closest(di)[0],r=gt.getSelectorFromElement(this._element);if(i){var o="UL"===i.nodeName?gi:pi;n=(n=ni.makeArray(ni(i).find(o)))[n.length-1]}var s=ni.Event(si.HIDE,{relatedTarget:this._element}),a=ni.Event(si.SHOW,{relatedTarget:n});if(n&&ni(n).trigger(s),ni(this._element).trigger(a),!a.isDefaultPrevented()&&!s.isDefaultPrevented()){r&&(e=ni(r)[0]),this._activate(this._element,i);var l=function(){var e=ni.Event(si.HIDDEN,{relatedTarget:t._element}),i=ni.Event(si.SHOWN,{relatedTarget:n});ni(n).trigger(e),ni(t._element).trigger(i)};e?this._activate(e,e.parentNode,l):l()}}},e.dispose=function(){ni.removeData(this._element,ii),this._element=null},e._activate=function(t,e,n){var i=this,r=("UL"===e.nodeName?ni(e).find(gi):ni(e).children(pi))[0],o=n&&gt.supportsTransitionEnd()&&r&&ni(r).hasClass(hi),s=function(){return i._transitionComplete(t,r,n)};r&&o?ni(r).one(gt.TRANSITION_END,s).emulateTransitionEnd(150):s()},e._transitionComplete=function(t,e,n){if(e){ni(e).removeClass(fi+" "+li);var i=ni(e.parentNode).find(vi)[0];i&&ni(i).removeClass(li),"tab"===e.getAttribute("role")&&e.setAttribute("aria-selected",!1)}if(ni(t).addClass(li),"tab"===t.getAttribute("role")&&t.setAttribute("aria-selected",!0),gt.reflow(t),ni(t).addClass(fi),t.parentNode&&ni(t.parentNode).hasClass(ai)){var r=ni(t).closest(ui)[0];r&&ni(r).find(_i).addClass(li),t.setAttribute("aria-expanded",!0)}n&&n()},t._jQueryInterface=function(e){return this.each(function(){var n=ni(this),i=n.data(ii);if(i||(i=new t(this),n.data(ii,i)),"string"==typeof e){if("undefined"==typeof i[e])throw new TypeError('No method named "'+e+'"');i[e]()}})},i(t,null,[{key:"VERSION",get:function(){return"4.0.0"}}]),t}(),ni(document).on(si.CLICK_DATA_API,mi,function(t){t.preventDefault(),Ei._jQueryInterface.call(ni(this),"show")}),ni.fn.tab=Ei._jQueryInterface,ni.fn.tab.Constructor=Ei,ni.fn.tab.noConflict=function(){return ni.fn.tab=oi,Ei._jQueryInterface},Ei);!function(t){if("undefined"==typeof t)throw new TypeError("Bootstrap's JavaScript requires jQuery. jQuery must be included before Bootstrap's JavaScript.");var e=t.fn.jquery.split(" ")[0].split(".");if(e[0]<2&&e[1]<9||1===e[0]&&9===e[1]&&e[2]<1||e[0]>=4)throw new Error("Bootstrap's JavaScript requires at least jQuery v1.9.1 but less than v4.0.0")}(e),t.Util=gt,t.Alert=mt,t.Button=_t,t.Carousel=vt,t.Collapse=Et,t.Dropdown=yi,t.Modal=bi,t.Popover=Ci,t.Scrollspy=wi,t.Tab=Ii,t.Tooltip=Ti,Object.defineProperty(t,"__esModule",{value:!0})});
//# sourceMappingURL=bootstrap.bundle.min.js.map
// jquery.repeater version 1.2.1
// https://github.com/DubFriend/jquery.repeater
// (MIT) 09-10-2016
// Brian Detering <BDeterin@gmail.com> (http://www.briandetering.net/)
!function(a){"use strict";var b=function(a){return a},c=function(b){return a.isArray(b)},d=function(a){return!c(a)&&a instanceof Object},e=function(b,c){return a.inArray(c,b)},f=function(a,b){return e(a,b)!==-1},g=function(a,b){for(var c in a)a.hasOwnProperty(c)&&b(a[c],c,a)},h=function(a){return a[a.length-1]},i=function(a){return Array.prototype.slice.call(a)},j=function(){var a={};return g(i(arguments),function(b){g(b,function(b,c){a[c]=b})}),a},k=function(a,b){var c=[];return g(a,function(a,d,e){c.push(b(a,d,e))}),c},l=function(a,b,c){var d={};return g(a,function(a,e,f){e=c?c(e,a):e,d[e]=b(a,e,f)}),d},m=function(a,b,d){return c(a)?k(a,b):l(a,b,d)},n=function(a,b){return m(a,function(a){return a[b]})},o=function(a,b){var d;return c(a)?(d=[],g(a,function(a,c,e){b(a,c,e)&&d.push(a)})):(d={},g(a,function(a,c,e){b(a,c,e)&&(d[c]=a)})),d},p=function(a,b,c){return m(a,function(a,d){return a[b].apply(a,c||[])})},q=function(a){a=a||{};var b={};return a.publish=function(a,c){g(b[a],function(a){a(c)})},a.subscribe=function(a,c){b[a]=b[a]||[],b[a].push(c)},a.unsubscribe=function(a){g(b,function(b){var c=e(b,a);c!==-1&&b.splice(c,1)})},a};!function(a){var b=function(a,b){var c=q(),d=a.$;return c.getType=function(){throw'implement me (return type. "text", "radio", etc.)'},c.$=function(a){return a?d.find(a):d},c.disable=function(){c.$().prop("disabled",!0),c.publish("isEnabled",!1)},c.enable=function(){c.$().prop("disabled",!1),c.publish("isEnabled",!0)},b.equalTo=function(a,b){return a===b},b.publishChange=function(){var a;return function(d,e){var f=c.get();b.equalTo(f,a)||c.publish("change",{e:d,domElement:e}),a=f}}(),c},i=function(a,c){var d=b(a,c);return d.get=function(){return d.$().val()},d.set=function(a){d.$().val(a)},d.clear=function(){d.set("")},c.buildSetter=function(a){return function(b){a.call(d,b)}},d},j=function(a,b){a=c(a)?a:[a],b=c(b)?b:[b];var d=!0;return a.length!==b.length?d=!1:g(a,function(a){f(b,a)||(d=!1)}),d},k=function(a){var b={},c=i(a,b);return c.getType=function(){return"button"},c.$().on("change",function(a){b.publishChange(a,this)}),c},l=function(b){var d={},e=i(b,d);return e.getType=function(){return"checkbox"},e.get=function(){var b=[];return e.$().filter(":checked").each(function(){b.push(a(this).val())}),b},e.set=function(b){b=c(b)?b:[b],e.$().each(function(){a(this).prop("checked",!1)}),g(b,function(a){e.$().filter('[value="'+a+'"]').prop("checked",!0)})},d.equalTo=j,e.$().change(function(a){d.publishChange(a,this)}),e},m=function(a){var b={},c=x(a,b);return c.getType=function(){return"email"},c},n=function(c){var d={},e=b(c,d);return e.getType=function(){return"file"},e.get=function(){return h(e.$().val().split("\\"))},e.clear=function(){this.$().each(function(){a(this).wrap("<form>").closest("form").get(0).reset(),a(this).unwrap()})},e.$().change(function(a){d.publishChange(a,this)}),e},o=function(a){var b={},c=i(a,b);return c.getType=function(){return"hidden"},c.$().change(function(a){b.publishChange(a,this)}),c},r=function(c){var d={},e=b(c,d);return e.getType=function(){return"file[multiple]"},e.get=function(){var a,b=e.$().get(0).files||[],c=[];for(a=0;a<(b.length||0);a+=1)c.push(b[a].name);return c},e.clear=function(){this.$().each(function(){a(this).wrap("<form>").closest("form").get(0).reset(),a(this).unwrap()})},e.$().change(function(a){d.publishChange(a,this)}),e},s=function(a){var b={},d=i(a,b);return d.getType=function(){return"select[multiple]"},d.get=function(){return d.$().val()||[]},d.set=function(a){d.$().val(""===a?[]:c(a)?a:[a])},b.equalTo=j,d.$().change(function(a){b.publishChange(a,this)}),d},t=function(a){var b={},c=x(a,b);return c.getType=function(){return"password"},c},u=function(b){var c={},d=i(b,c);return d.getType=function(){return"radio"},d.get=function(){return d.$().filter(":checked").val()||null},d.set=function(b){b?d.$().filter('[value="'+b+'"]').prop("checked",!0):d.$().each(function(){a(this).prop("checked",!1)})},d.$().change(function(a){c.publishChange(a,this)}),d},v=function(a){var b={},c=i(a,b);return c.getType=function(){return"range"},c.$().change(function(a){b.publishChange(a,this)}),c},w=function(a){var b={},c=i(a,b);return c.getType=function(){return"select"},c.$().change(function(a){b.publishChange(a,this)}),c},x=function(a){var b={},c=i(a,b);return c.getType=function(){return"text"},c.$().on("change keyup keydown",function(a){b.publishChange(a,this)}),c},y=function(a){var b={},c=i(a,b);return c.getType=function(){return"textarea"},c.$().on("change keyup keydown",function(a){b.publishChange(a,this)}),c},z=function(a){var b={},c=x(a,b);return c.getType=function(){return"url"},c},A=function(b){var c={},f=b.$,h=b.constructorOverride||{button:k,text:x,url:z,email:m,password:t,range:v,textarea:y,select:w,"select[multiple]":s,radio:u,checkbox:l,file:n,"file[multiple]":r,hidden:o},i=function(b,e){var g=d(e)?e:f.find(e);g.each(function(){var d=a(this).attr("name");c[d]=h[b]({$:a(this)})})},j=function(b,i){var j=[],k=d(i)?i:f.find(i);d(i)?c[k.attr("name")]=h[b]({$:k}):(k.each(function(){e(j,a(this).attr("name"))===-1&&j.push(a(this).attr("name"))}),g(j,function(a){c[a]=h[b]({$:f.find('input[name="'+a+'"]')})}))};return f.is("input, select, textarea")?f.is('input[type="button"], button, input[type="submit"]')?i("button",f):f.is("textarea")?i("textarea",f):f.is('input[type="text"]')||f.is("input")&&!f.attr("type")?i("text",f):f.is('input[type="password"]')?i("password",f):f.is('input[type="email"]')?i("email",f):f.is('input[type="url"]')?i("url",f):f.is('input[type="range"]')?i("range",f):f.is("select")?f.is("[multiple]")?i("select[multiple]",f):i("select",f):f.is('input[type="file"]')?f.is("[multiple]")?i("file[multiple]",f):i("file",f):f.is('input[type="hidden"]')?i("hidden",f):f.is('input[type="radio"]')?j("radio",f):f.is('input[type="checkbox"]')?j("checkbox",f):i("text",f):(i("button",'input[type="button"], button, input[type="submit"]'),i("text",'input[type="text"]'),i("password",'input[type="password"]'),i("email",'input[type="email"]'),i("url",'input[type="url"]'),i("range",'input[type="range"]'),i("textarea","textarea"),i("select","select:not([multiple])"),i("select[multiple]","select[multiple]"),i("file",'input[type="file"]:not([multiple])'),i("file[multiple]",'input[type="file"][multiple]'),i("hidden",'input[type="hidden"]'),j("radio",'input[type="radio"]'),j("checkbox",'input[type="checkbox"]')),c};a.fn.inputVal=function(b){var c=a(this),d=A({$:c});return c.is("input, textarea, select")?"undefined"==typeof b?d[c.attr("name")].get():(d[c.attr("name")].set(b),c):"undefined"==typeof b?p(d,"get"):(g(b,function(a,b){d[b].set(a)}),c)},a.fn.inputOnChange=function(b){var c=a(this),d=A({$:c});return g(d,function(a){a.subscribe("change",function(a){b.call(a.domElement,a.e)})}),c},a.fn.inputDisable=function(){var b=a(this);return p(A({$:b}),"disable"),b},a.fn.inputEnable=function(){var b=a(this);return p(A({$:b}),"enable"),b},a.fn.inputClear=function(){var b=a(this);return p(A({$:b}),"clear"),b}}(jQuery),a.fn.repeaterVal=function(){var b=function(a){var b=[];return g(a,function(a,c){var d=[];"undefined"!==c&&(d.push(c.match(/^[^\[]*/)[0]),d=d.concat(m(c.match(/\[[^\]]*\]/g),function(a){return a.replace(/[\[\]]/g,"")})),b.push({val:a,key:d}))}),b},c=function(a){if(1===a.length&&(0===a[0].key.length||1===a[0].key.length&&!a[0].key[0]))return a[0].val;g(a,function(a){a.head=a.key.shift()});var b,d=function(){var b={};return g(a,function(a){b[a.head]||(b[a.head]=[]),b[a.head].push(a)}),b}();return/^[0-9]+$/.test(a[0].head)?(b=[],g(d,function(a){b.push(c(a))})):(b={},g(d,function(a,d){b[d]=c(a)})),b};return c(b(a(this).inputVal()))},a.fn.repeater=function(c){c=c||{};var d;return a(this).each(function(){var e=a(this),f=c.show||function(){a(this).show()},i=c.hide||function(a){a()},k=e.find("[data-repeater-list]").first(),l=function(b,c){return b.filter(function(){return!c||0===a(this).closest(n(c,"selector").join(",")).length})},p=function(){return l(k.find("[data-repeater-item]"),c.repeaters)},q=k.find("[data-repeater-item]").first().clone().hide(),r=l(l(a(this).find("[data-repeater-item]"),c.repeaters).first().find("[data-repeater-delete]"),c.repeaters);c.isFirstItemUndeletable&&r&&r.remove();var s=function(){var a=k.data("repeater-list");return c.$parent?c.$parent.data("item-name")+"["+a+"]":a},t=function(b){c.repeaters&&b.each(function(){var b=a(this);g(c.repeaters,function(a){b.find(a.selector).repeater(j(a,{$parent:b}))})})},u=function(a,b,c){a&&g(a,function(a){c.call(b.find(a.selector)[0],a)})},v=function(b,c,d){b.each(function(b){var e=a(this);e.data("item-name",c+"["+b+"]"),l(e.find("[name]"),d).each(function(){var f=a(this),g=f.attr("name").match(/\[[^\]]+\]/g),i=g?h(g).replace(/\[|\]/g,""):f.attr("name"),j=c+"["+b+"]["+i+"]"+(f.is(":checkbox")||f.attr("multiple")?"[]":"");f.attr("name",j),u(d,e,function(d){var e=a(this);v(l(e.find("[data-repeater-item]"),d.repeaters||[]),c+"["+b+"]["+e.find("[data-repeater-list]").first().data("repeater-list")+"]",d.repeaters)})})}),k.find("input[name][checked]").removeAttr("checked").prop("checked",!0)};v(p(),s(),c.repeaters),t(p()),c.initEmpty&&p().remove(),c.ready&&c.ready(function(){v(p(),s(),c.repeaters)});var w=function(){var d=function(e,f,h){if(f||c.defaultValues){var i={};l(e.find("[name]"),h).each(function(){var b=a(this).attr("name").match(/\[([^\]]*)(\]|\]\[\])$/)[1];i[b]=a(this).attr("name")}),e.inputVal(m(o(f||c.defaultValues,function(a,b){return i[b]}),b,function(a){return i[a]}))}u(h,e,function(b){var c=a(this);l(c.find("[data-repeater-item]"),b.repeaters).each(function(){var e=c.find("[data-repeater-list]").data("repeater-list");if(f&&f[e]){var h=a(this).clone();c.find("[data-repeater-item]").remove(),g(f[e],function(a){var e=h.clone();d(e,a,b.repeaters||[]),c.find("[data-repeater-list]").append(e)})}else d(a(this),b.defaultValues,b.repeaters||[])})})};return function(b,e){k.append(b),v(p(),s(),c.repeaters),b.find("[name]").each(function(){a(this).inputClear()}),d(b,e||c.defaultValues,c.repeaters)}}(),x=function(a){var b=q.clone();w(b,a),c.repeaters&&t(b),f.call(b.get(0))};d=function(a){p().remove(),g(a,x)},l(e.find("[data-repeater-create]"),c.repeaters).click(function(){x()}),k.on("click","[data-repeater-delete]",function(){var b=a(this).closest("[data-repeater-item]").get(0);i.call(b,function(){a(b).remove(),v(p(),s(),c.repeaters)})})}),this.setList=d,this}}(jQuery);
/* flatpickr v4.6.1, @license MIT */
(function (global, factory) {
    typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() :
    typeof define === 'function' && define.amd ? define(factory) :
    (global = global || self, global.flatpickr = factory());
}(this, function () { 'use strict';

    /*! *****************************************************************************
    Copyright (c) Microsoft Corporation. All rights reserved.
    Licensed under the Apache License, Version 2.0 (the "License"); you may not use
    this file except in compliance with the License. You may obtain a copy of the
    License at http://www.apache.org/licenses/LICENSE-2.0

    THIS CODE IS PROVIDED ON AN *AS IS* BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
    KIND, EITHER EXPRESS OR IMPLIED, INCLUDING WITHOUT LIMITATION ANY IMPLIED
    WARRANTIES OR CONDITIONS OF TITLE, FITNESS FOR A PARTICULAR PURPOSE,
    MERCHANTABLITY OR NON-INFRINGEMENT.

    See the Apache Version 2.0 License for specific language governing permissions
    and limitations under the License.
    ***************************************************************************** */

    var __assign = function() {
        __assign = Object.assign || function __assign(t) {
            for (var s, i = 1, n = arguments.length; i < n; i++) {
                s = arguments[i];
                for (var p in s) if (Object.prototype.hasOwnProperty.call(s, p)) t[p] = s[p];
            }
            return t;
        };
        return __assign.apply(this, arguments);
    };

    var HOOKS = [
        "onChange",
        "onClose",
        "onDayCreate",
        "onDestroy",
        "onKeyDown",
        "onMonthChange",
        "onOpen",
        "onParseConfig",
        "onReady",
        "onValueUpdate",
        "onYearChange",
        "onPreCalendarPosition",
    ];
    var defaults = {
        _disable: [],
        _enable: [],
        allowInput: false,
        altFormat: "F j, Y",
        altInput: false,
        altInputClass: "form-control input",
        animate: typeof window === "object" &&
            window.navigator.userAgent.indexOf("MSIE") === -1,
        ariaDateFormat: "F j, Y",
        clickOpens: true,
        closeOnSelect: true,
        conjunction: ", ",
        dateFormat: "Y-m-d",
        defaultHour: 12,
        defaultMinute: 0,
        defaultSeconds: 0,
        disable: [],
        disableMobile: false,
        enable: [],
        enableSeconds: false,
        enableTime: false,
        errorHandler: function (err) {
            return typeof console !== "undefined" && console.warn(err);
        },
        getWeek: function (givenDate) {
            var date = new Date(givenDate.getTime());
            date.setHours(0, 0, 0, 0);
            // Thursday in current week decides the year.
            date.setDate(date.getDate() + 3 - ((date.getDay() + 6) % 7));
            // January 4 is always in week 1.
            var week1 = new Date(date.getFullYear(), 0, 4);
            // Adjust to Thursday in week 1 and count number of weeks from date to week1.
            return (1 +
                Math.round(((date.getTime() - week1.getTime()) / 86400000 -
                    3 +
                    ((week1.getDay() + 6) % 7)) /
                    7));
        },
        hourIncrement: 1,
        ignoredFocusElements: [],
        inline: false,
        locale: "default",
        minuteIncrement: 5,
        mode: "single",
        nextArrow: "<svg version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' viewBox='0 0 17 17'><g></g><path d='M13.207 8.472l-7.854 7.854-0.707-0.707 7.146-7.146-7.146-7.148 0.707-0.707 7.854 7.854z' /></svg>",
        noCalendar: false,
        now: new Date(),
        onChange: [],
        onClose: [],
        onDayCreate: [],
        onDestroy: [],
        onKeyDown: [],
        onMonthChange: [],
        onOpen: [],
        onParseConfig: [],
        onReady: [],
        onValueUpdate: [],
        onYearChange: [],
        onPreCalendarPosition: [],
        plugins: [],
        position: "auto",
        positionElement: undefined,
        prevArrow: "<svg version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' viewBox='0 0 17 17'><g></g><path d='M5.207 8.471l7.146 7.147-0.707 0.707-7.853-7.854 7.854-7.853 0.707 0.707-7.147 7.146z' /></svg>",
        shorthandCurrentMonth: false,
        showMonths: 1,
        static: false,
        time_24hr: false,
        weekNumbers: false,
        wrap: false
    };

    var english = {
        weekdays: {
            shorthand: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
            longhand: [
                "Sunday",
                "Monday",
                "Tuesday",
                "Wednesday",
                "Thursday",
                "Friday",
                "Saturday",
            ]
        },
        months: {
            shorthand: [
                "Jan",
                "Feb",
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep",
                "Oct",
                "Nov",
                "Dec",
            ],
            longhand: [
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December",
            ]
        },
        daysInMonth: [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31],
        firstDayOfWeek: 0,
        ordinal: function (nth) {
            var s = nth % 100;
            if (s > 3 && s < 21)
                return "th";
            switch (s % 10) {
                case 1:
                    return "st";
                case 2:
                    return "nd";
                case 3:
                    return "rd";
                default:
                    return "th";
            }
        },
        rangeSeparator: " to ",
        weekAbbreviation: "Wk",
        scrollTitle: "Scroll to increment",
        toggleTitle: "Click to toggle",
        amPM: ["AM", "PM"],
        yearAriaLabel: "Year",
        time_24hr: false
    };

    var pad = function (number) { return ("0" + number).slice(-2); };
    var int = function (bool) { return (bool === true ? 1 : 0); };
    /* istanbul ignore next */
    function debounce(func, wait, immediate) {
        if (immediate === void 0) { immediate = false; }
        var timeout;
        return function () {
            var context = this, args = arguments;
            timeout !== null && clearTimeout(timeout);
            timeout = window.setTimeout(function () {
                timeout = null;
                if (!immediate)
                    func.apply(context, args);
            }, wait);
            if (immediate && !timeout)
                func.apply(context, args);
        };
    }
    var arrayify = function (obj) {
        return obj instanceof Array ? obj : [obj];
    };

    function toggleClass(elem, className, bool) {
        if (bool === true)
            return elem.classList.add(className);
        elem.classList.remove(className);
    }
    function createElement(tag, className, content) {
        var e = window.document.createElement(tag);
        className = className || "";
        content = content || "";
        e.className = className;
        if (content !== undefined)
            e.textContent = content;
        return e;
    }
    function clearNode(node) {
        while (node.firstChild)
            node.removeChild(node.firstChild);
    }
    function findParent(node, condition) {
        if (condition(node))
            return node;
        else if (node.parentNode)
            return findParent(node.parentNode, condition);
        return undefined; // nothing found
    }
    function createNumberInput(inputClassName, opts) {
        var wrapper = createElement("div", "numInputWrapper"), numInput = createElement("input", "numInput " + inputClassName), arrowUp = createElement("span", "arrowUp"), arrowDown = createElement("span", "arrowDown");
        if (navigator.userAgent.indexOf("MSIE 9.0") === -1) {
            numInput.type = "number";
        }
        else {
            numInput.type = "text";
            numInput.pattern = "\\d*";
        }
        if (opts !== undefined)
            for (var key in opts)
                numInput.setAttribute(key, opts[key]);
        wrapper.appendChild(numInput);
        wrapper.appendChild(arrowUp);
        wrapper.appendChild(arrowDown);
        return wrapper;
    }
    function getEventTarget(event) {
        if (typeof event.composedPath === "function") {
            var path = event.composedPath();
            return path[0];
        }
        return event.target;
    }

    var doNothing = function () { return undefined; };
    var monthToStr = function (monthNumber, shorthand, locale) { return locale.months[shorthand ? "shorthand" : "longhand"][monthNumber]; };
    var revFormat = {
        D: doNothing,
        F: function (dateObj, monthName, locale) {
            dateObj.setMonth(locale.months.longhand.indexOf(monthName));
        },
        G: function (dateObj, hour) {
            dateObj.setHours(parseFloat(hour));
        },
        H: function (dateObj, hour) {
            dateObj.setHours(parseFloat(hour));
        },
        J: function (dateObj, day) {
            dateObj.setDate(parseFloat(day));
        },
        K: function (dateObj, amPM, locale) {
            dateObj.setHours((dateObj.getHours() % 12) +
                12 * int(new RegExp(locale.amPM[1], "i").test(amPM)));
        },
        M: function (dateObj, shortMonth, locale) {
            dateObj.setMonth(locale.months.shorthand.indexOf(shortMonth));
        },
        S: function (dateObj, seconds) {
            dateObj.setSeconds(parseFloat(seconds));
        },
        U: function (_, unixSeconds) { return new Date(parseFloat(unixSeconds) * 1000); },
        W: function (dateObj, weekNum, locale) {
            var weekNumber = parseInt(weekNum);
            var date = new Date(dateObj.getFullYear(), 0, 2 + (weekNumber - 1) * 7, 0, 0, 0, 0);
            date.setDate(date.getDate() - date.getDay() + locale.firstDayOfWeek);
            return date;
        },
        Y: function (dateObj, year) {
            dateObj.setFullYear(parseFloat(year));
        },
        Z: function (_, ISODate) { return new Date(ISODate); },
        d: function (dateObj, day) {
            dateObj.setDate(parseFloat(day));
        },
        h: function (dateObj, hour) {
            dateObj.setHours(parseFloat(hour));
        },
        i: function (dateObj, minutes) {
            dateObj.setMinutes(parseFloat(minutes));
        },
        j: function (dateObj, day) {
            dateObj.setDate(parseFloat(day));
        },
        l: doNothing,
        m: function (dateObj, month) {
            dateObj.setMonth(parseFloat(month) - 1);
        },
        n: function (dateObj, month) {
            dateObj.setMonth(parseFloat(month) - 1);
        },
        s: function (dateObj, seconds) {
            dateObj.setSeconds(parseFloat(seconds));
        },
        u: function (_, unixMillSeconds) {
            return new Date(parseFloat(unixMillSeconds));
        },
        w: doNothing,
        y: function (dateObj, year) {
            dateObj.setFullYear(2000 + parseFloat(year));
        }
    };
    var tokenRegex = {
        D: "(\\w+)",
        F: "(\\w+)",
        G: "(\\d\\d|\\d)",
        H: "(\\d\\d|\\d)",
        J: "(\\d\\d|\\d)\\w+",
        K: "",
        M: "(\\w+)",
        S: "(\\d\\d|\\d)",
        U: "(.+)",
        W: "(\\d\\d|\\d)",
        Y: "(\\d{4})",
        Z: "(.+)",
        d: "(\\d\\d|\\d)",
        h: "(\\d\\d|\\d)",
        i: "(\\d\\d|\\d)",
        j: "(\\d\\d|\\d)",
        l: "(\\w+)",
        m: "(\\d\\d|\\d)",
        n: "(\\d\\d|\\d)",
        s: "(\\d\\d|\\d)",
        u: "(.+)",
        w: "(\\d\\d|\\d)",
        y: "(\\d{2})"
    };
    var formats = {
        // get the date in UTC
        Z: function (date) { return date.toISOString(); },
        // weekday name, short, e.g. Thu
        D: function (date, locale, options) {
            return locale.weekdays.shorthand[formats.w(date, locale, options)];
        },
        // full month name e.g. January
        F: function (date, locale, options) {
            return monthToStr(formats.n(date, locale, options) - 1, false, locale);
        },
        // padded hour 1-12
        G: function (date, locale, options) {
            return pad(formats.h(date, locale, options));
        },
        // hours with leading zero e.g. 03
        H: function (date) { return pad(date.getHours()); },
        // day (1-30) with ordinal suffix e.g. 1st, 2nd
        J: function (date, locale) {
            return locale.ordinal !== undefined
                ? date.getDate() + locale.ordinal(date.getDate())
                : date.getDate();
        },
        // AM/PM
        K: function (date, locale) { return locale.amPM[int(date.getHours() > 11)]; },
        // shorthand month e.g. Jan, Sep, Oct, etc
        M: function (date, locale) {
            return monthToStr(date.getMonth(), true, locale);
        },
        // seconds 00-59
        S: function (date) { return pad(date.getSeconds()); },
        // unix timestamp
        U: function (date) { return date.getTime() / 1000; },
        W: function (date, _, options) {
            return options.getWeek(date);
        },
        // full year e.g. 2016
        Y: function (date) { return date.getFullYear(); },
        // day in month, padded (01-30)
        d: function (date) { return pad(date.getDate()); },
        // hour from 1-12 (am/pm)
        h: function (date) { return (date.getHours() % 12 ? date.getHours() % 12 : 12); },
        // minutes, padded with leading zero e.g. 09
        i: function (date) { return pad(date.getMinutes()); },
        // day in month (1-30)
        j: function (date) { return date.getDate(); },
        // weekday name, full, e.g. Thursday
        l: function (date, locale) {
            return locale.weekdays.longhand[date.getDay()];
        },
        // padded month number (01-12)
        m: function (date) { return pad(date.getMonth() + 1); },
        // the month number (1-12)
        n: function (date) { return date.getMonth() + 1; },
        // seconds 0-59
        s: function (date) { return date.getSeconds(); },
        // Unix Milliseconds
        u: function (date) { return date.getTime(); },
        // number of the day of the week
        w: function (date) { return date.getDay(); },
        // last two digits of year e.g. 16 for 2016
        y: function (date) { return String(date.getFullYear()).substring(2); }
    };

    var createDateFormatter = function (_a) {
        var _b = _a.config, config = _b === void 0 ? defaults : _b, _c = _a.l10n, l10n = _c === void 0 ? english : _c;
        return function (dateObj, frmt, overrideLocale) {
            var locale = overrideLocale || l10n;
            if (config.formatDate !== undefined) {
                return config.formatDate(dateObj, frmt, locale);
            }
            return frmt
                .split("")
                .map(function (c, i, arr) {
                return formats[c] && arr[i - 1] !== "\\"
                    ? formats[c](dateObj, locale, config)
                    : c !== "\\"
                        ? c
                        : "";
            })
                .join("");
        };
    };
    var createDateParser = function (_a) {
        var _b = _a.config, config = _b === void 0 ? defaults : _b, _c = _a.l10n, l10n = _c === void 0 ? english : _c;
        return function (date, givenFormat, timeless, customLocale) {
            if (date !== 0 && !date)
                return undefined;
            var locale = customLocale || l10n;
            var parsedDate;
            var dateOrig = date;
            if (date instanceof Date)
                parsedDate = new Date(date.getTime());
            else if (typeof date !== "string" &&
                date.toFixed !== undefined // timestamp
            )
                // create a copy
                parsedDate = new Date(date);
            else if (typeof date === "string") {
                // date string
                var format = givenFormat || (config || defaults).dateFormat;
                var datestr = String(date).trim();
                if (datestr === "today") {
                    parsedDate = new Date();
                    timeless = true;
                }
                else if (/Z$/.test(datestr) ||
                    /GMT$/.test(datestr) // datestrings w/ timezone
                )
                    parsedDate = new Date(date);
                else if (config && config.parseDate)
                    parsedDate = config.parseDate(date, format);
                else {
                    parsedDate =
                        !config || !config.noCalendar
                            ? new Date(new Date().getFullYear(), 0, 1, 0, 0, 0, 0)
                            : new Date(new Date().setHours(0, 0, 0, 0));
                    var matched = void 0, ops = [];
                    for (var i = 0, matchIndex = 0, regexStr = ""; i < format.length; i++) {
                        var token_1 = format[i];
                        var isBackSlash = token_1 === "\\";
                        var escaped = format[i - 1] === "\\" || isBackSlash;
                        if (tokenRegex[token_1] && !escaped) {
                            regexStr += tokenRegex[token_1];
                            var match = new RegExp(regexStr).exec(date);
                            if (match && (matched = true)) {
                                ops[token_1 !== "Y" ? "push" : "unshift"]({
                                    fn: revFormat[token_1],
                                    val: match[++matchIndex]
                                });
                            }
                        }
                        else if (!isBackSlash)
                            regexStr += "."; // don't really care
                        ops.forEach(function (_a) {
                            var fn = _a.fn, val = _a.val;
                            return (parsedDate = fn(parsedDate, val, locale) || parsedDate);
                        });
                    }
                    parsedDate = matched ? parsedDate : undefined;
                }
            }
            /* istanbul ignore next */
            if (!(parsedDate instanceof Date && !isNaN(parsedDate.getTime()))) {
                config.errorHandler(new Error("Invalid date provided: " + dateOrig));
                return undefined;
            }
            if (timeless === true)
                parsedDate.setHours(0, 0, 0, 0);
            return parsedDate;
        };
    };
    /**
     * Compute the difference in dates, measured in ms
     */
    function compareDates(date1, date2, timeless) {
        if (timeless === void 0) { timeless = true; }
        if (timeless !== false) {
            return (new Date(date1.getTime()).setHours(0, 0, 0, 0) -
                new Date(date2.getTime()).setHours(0, 0, 0, 0));
        }
        return date1.getTime() - date2.getTime();
    }
    var isBetween = function (ts, ts1, ts2) {
        return ts > Math.min(ts1, ts2) && ts < Math.max(ts1, ts2);
    };
    var duration = {
        DAY: 86400000
    };

    if (typeof Object.assign !== "function") {
        Object.assign = function (target) {
            var args = [];
            for (var _i = 1; _i < arguments.length; _i++) {
                args[_i - 1] = arguments[_i];
            }
            if (!target) {
                throw TypeError("Cannot convert undefined or null to object");
            }
            var _loop_1 = function (source) {
                if (source) {
                    Object.keys(source).forEach(function (key) { return (target[key] = source[key]); });
                }
            };
            for (var _a = 0, args_1 = args; _a < args_1.length; _a++) {
                var source = args_1[_a];
                _loop_1(source);
            }
            return target;
        };
    }

    var DEBOUNCED_CHANGE_MS = 300;
    function FlatpickrInstance(element, instanceConfig) {
        var self = {
            config: __assign({}, defaults, flatpickr.defaultConfig),
            l10n: english
        };
        self.parseDate = createDateParser({ config: self.config, l10n: self.l10n });
        self._handlers = [];
        self.pluginElements = [];
        self.loadedPlugins = [];
        self._bind = bind;
        self._setHoursFromDate = setHoursFromDate;
        self._positionCalendar = positionCalendar;
        self.changeMonth = changeMonth;
        self.changeYear = changeYear;
        self.clear = clear;
        self.close = close;
        self._createElement = createElement;
        self.destroy = destroy;
        self.isEnabled = isEnabled;
        self.jumpToDate = jumpToDate;
        self.open = open;
        self.redraw = redraw;
        self.set = set;
        self.setDate = setDate;
        self.toggle = toggle;
        function setupHelperFunctions() {
            self.utils = {
                getDaysInMonth: function (month, yr) {
                    if (month === void 0) { month = self.currentMonth; }
                    if (yr === void 0) { yr = self.currentYear; }
                    if (month === 1 && ((yr % 4 === 0 && yr % 100 !== 0) || yr % 400 === 0))
                        return 29;
                    return self.l10n.daysInMonth[month];
                }
            };
        }
        function init() {
            self.element = self.input = element;
            self.isOpen = false;
            parseConfig();
            setupLocale();
            setupInputs();
            setupDates();
            setupHelperFunctions();
            if (!self.isMobile)
                build();
            bindEvents();
            if (self.selectedDates.length || self.config.noCalendar) {
                if (self.config.enableTime) {
                    setHoursFromDate(self.config.noCalendar
                        ? self.latestSelectedDateObj || self.config.minDate
                        : undefined);
                }
                updateValue(false);
            }
            setCalendarWidth();
            self.showTimeInput =
                self.selectedDates.length > 0 || self.config.noCalendar;
            var isSafari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);
            /* TODO: investigate this further
        
              Currently, there is weird positioning behavior in safari causing pages
              to scroll up. https://github.com/chmln/flatpickr/issues/563
        
              However, most browsers are not Safari and positioning is expensive when used
              in scale. https://github.com/chmln/flatpickr/issues/1096
            */
            if (!self.isMobile && isSafari) {
                positionCalendar();
            }
            triggerEvent("onReady");
        }
        function bindToInstance(fn) {
            return fn.bind(self);
        }
        function setCalendarWidth() {
            var config = self.config;
            if (config.weekNumbers === false && config.showMonths === 1)
                return;
            else if (config.noCalendar !== true) {
                window.requestAnimationFrame(function () {
                    if (self.calendarContainer !== undefined) {
                        self.calendarContainer.style.visibility = "hidden";
                        self.calendarContainer.style.display = "block";
                    }
                    if (self.daysContainer !== undefined) {
                        var daysWidth = (self.days.offsetWidth + 1) * config.showMonths;
                        self.daysContainer.style.width = daysWidth + "px";
                        self.calendarContainer.style.width =
                            daysWidth +
                                (self.weekWrapper !== undefined
                                    ? self.weekWrapper.offsetWidth
                                    : 0) +
                                "px";
                        self.calendarContainer.style.removeProperty("visibility");
                        self.calendarContainer.style.removeProperty("display");
                    }
                });
            }
        }
        /**
         * The handler for all events targeting the time inputs
         */
        function updateTime(e) {
            if (self.selectedDates.length === 0) {
                setDefaultTime();
            }
            if (e !== undefined && e.type !== "blur") {
                timeWrapper(e);
            }
            var prevValue = self._input.value;
            setHoursFromInputs();
            updateValue();
            if (self._input.value !== prevValue) {
                self._debouncedChange();
            }
        }
        function ampm2military(hour, amPM) {
            return (hour % 12) + 12 * int(amPM === self.l10n.amPM[1]);
        }
        function military2ampm(hour) {
            switch (hour % 24) {
                case 0:
                case 12:
                    return 12;
                default:
                    return hour % 12;
            }
        }
        /**
         * Syncs the selected date object time with user's time input
         */
        function setHoursFromInputs() {
            if (self.hourElement === undefined || self.minuteElement === undefined)
                return;
            var hours = (parseInt(self.hourElement.value.slice(-2), 10) || 0) % 24, minutes = (parseInt(self.minuteElement.value, 10) || 0) % 60, seconds = self.secondElement !== undefined
                ? (parseInt(self.secondElement.value, 10) || 0) % 60
                : 0;
            if (self.amPM !== undefined) {
                hours = ampm2military(hours, self.amPM.textContent);
            }
            var limitMinHours = self.config.minTime !== undefined ||
                (self.config.minDate &&
                    self.minDateHasTime &&
                    self.latestSelectedDateObj &&
                    compareDates(self.latestSelectedDateObj, self.config.minDate, true) ===
                        0);
            var limitMaxHours = self.config.maxTime !== undefined ||
                (self.config.maxDate &&
                    self.maxDateHasTime &&
                    self.latestSelectedDateObj &&
                    compareDates(self.latestSelectedDateObj, self.config.maxDate, true) ===
                        0);
            if (limitMaxHours) {
                var maxTime = self.config.maxTime !== undefined
                    ? self.config.maxTime
                    : self.config.maxDate;
                hours = Math.min(hours, maxTime.getHours());
                if (hours === maxTime.getHours())
                    minutes = Math.min(minutes, maxTime.getMinutes());
                if (minutes === maxTime.getMinutes())
                    seconds = Math.min(seconds, maxTime.getSeconds());
            }
            if (limitMinHours) {
                var minTime = self.config.minTime !== undefined
                    ? self.config.minTime
                    : self.config.minDate;
                hours = Math.max(hours, minTime.getHours());
                if (hours === minTime.getHours())
                    minutes = Math.max(minutes, minTime.getMinutes());
                if (minutes === minTime.getMinutes())
                    seconds = Math.max(seconds, minTime.getSeconds());
            }
            setHours(hours, minutes, seconds);
        }
        /**
         * Syncs time input values with a date
         */
        function setHoursFromDate(dateObj) {
            var date = dateObj || self.latestSelectedDateObj;
            if (date)
                setHours(date.getHours(), date.getMinutes(), date.getSeconds());
        }
        function setDefaultHours() {
            var hours = self.config.defaultHour;
            var minutes = self.config.defaultMinute;
            var seconds = self.config.defaultSeconds;
            if (self.config.minDate !== undefined) {
                var minHr = self.config.minDate.getHours();
                var minMinutes = self.config.minDate.getMinutes();
                hours = Math.max(hours, minHr);
                if (hours === minHr)
                    minutes = Math.max(minMinutes, minutes);
                if (hours === minHr && minutes === minMinutes)
                    seconds = self.config.minDate.getSeconds();
            }
            if (self.config.maxDate !== undefined) {
                var maxHr = self.config.maxDate.getHours();
                var maxMinutes = self.config.maxDate.getMinutes();
                hours = Math.min(hours, maxHr);
                if (hours === maxHr)
                    minutes = Math.min(maxMinutes, minutes);
                if (hours === maxHr && minutes === maxMinutes)
                    seconds = self.config.maxDate.getSeconds();
            }
            setHours(hours, minutes, seconds);
        }
        /**
         * Sets the hours, minutes, and optionally seconds
         * of the latest selected date object and the
         * corresponding time inputs
         * @param {Number} hours the hour. whether its military
         *                 or am-pm gets inferred from config
         * @param {Number} minutes the minutes
         * @param {Number} seconds the seconds (optional)
         */
        function setHours(hours, minutes, seconds) {
            if (self.latestSelectedDateObj !== undefined) {
                self.latestSelectedDateObj.setHours(hours % 24, minutes, seconds || 0, 0);
            }
            if (!self.hourElement || !self.minuteElement || self.isMobile)
                return;
            self.hourElement.value = pad(!self.config.time_24hr
                ? ((12 + hours) % 12) + 12 * int(hours % 12 === 0)
                : hours);
            self.minuteElement.value = pad(minutes);
            if (self.amPM !== undefined)
                self.amPM.textContent = self.l10n.amPM[int(hours >= 12)];
            if (self.secondElement !== undefined)
                self.secondElement.value = pad(seconds);
        }
        /**
         * Handles the year input and incrementing events
         * @param {Event} event the keyup or increment event
         */
        function onYearInput(event) {
            var year = parseInt(event.target.value) + (event.delta || 0);
            if (year / 1000 > 1 ||
                (event.key === "Enter" && !/[^\d]/.test(year.toString()))) {
                changeYear(year);
            }
        }
        /**
         * Essentially addEventListener + tracking
         * @param {Element} element the element to addEventListener to
         * @param {String} event the event name
         * @param {Function} handler the event handler
         */
        function bind(element, event, handler, options) {
            if (event instanceof Array)
                return event.forEach(function (ev) { return bind(element, ev, handler, options); });
            if (element instanceof Array)
                return element.forEach(function (el) { return bind(el, event, handler, options); });
            element.addEventListener(event, handler, options);
            self._handlers.push({
                element: element,
                event: event,
                handler: handler,
                options: options
            });
        }
        /**
         * A mousedown handler which mimics click.
         * Minimizes latency, since we don't need to wait for mouseup in most cases.
         * Also, avoids handling right clicks.
         *
         * @param {Function} handler the event handler
         */
        function onClick(handler) {
            return function (evt) {
                evt.which === 1 && handler(evt);
            };
        }
        function triggerChange() {
            triggerEvent("onChange");
        }
        /**
         * Adds all the necessary event listeners
         */
        function bindEvents() {
            if (self.config.wrap) {
                ["open", "close", "toggle", "clear"].forEach(function (evt) {
                    Array.prototype.forEach.call(self.element.querySelectorAll("[data-" + evt + "]"), function (el) {
                        return bind(el, "click", self[evt]);
                    });
                });
            }
            if (self.isMobile) {
                setupMobile();
                return;
            }
            var debouncedResize = debounce(onResize, 50);
            self._debouncedChange = debounce(triggerChange, DEBOUNCED_CHANGE_MS);
            if (self.daysContainer && !/iPhone|iPad|iPod/i.test(navigator.userAgent))
                bind(self.daysContainer, "mouseover", function (e) {
                    if (self.config.mode === "range")
                        onMouseOver(e.target);
                });
            bind(window.document.body, "keydown", onKeyDown);
            if (!self.config.inline && !self.config.static)
                bind(window, "resize", debouncedResize);
            if (window.ontouchstart !== undefined)
                bind(window.document, "touchstart", documentClick);
            else
                bind(window.document, "mousedown", onClick(documentClick));
            bind(window.document, "focus", documentClick, { capture: true });
            if (self.config.clickOpens === true) {
                bind(self._input, "focus", self.open);
                bind(self._input, "mousedown", onClick(self.open));
            }
            if (self.daysContainer !== undefined) {
                bind(self.monthNav, "mousedown", onClick(onMonthNavClick));
                bind(self.monthNav, ["keyup", "increment"], onYearInput);
                bind(self.daysContainer, "mousedown", onClick(selectDate));
            }
            if (self.timeContainer !== undefined &&
                self.minuteElement !== undefined &&
                self.hourElement !== undefined) {
                var selText = function (e) {
                    return e.target.select();
                };
                bind(self.timeContainer, ["increment"], updateTime);
                bind(self.timeContainer, "blur", updateTime, { capture: true });
                bind(self.timeContainer, "mousedown", onClick(timeIncrement));
                bind([self.hourElement, self.minuteElement], ["focus", "click"], selText);
                if (self.secondElement !== undefined)
                    bind(self.secondElement, "focus", function () { return self.secondElement && self.secondElement.select(); });
                if (self.amPM !== undefined) {
                    bind(self.amPM, "mousedown", onClick(function (e) {
                        updateTime(e);
                        triggerChange();
                    }));
                }
            }
        }
        /**
         * Set the calendar view to a particular date.
         * @param {Date} jumpDate the date to set the view to
         * @param {boolean} triggerChange if change events should be triggered
         */
        function jumpToDate(jumpDate, triggerChange) {
            var jumpTo = jumpDate !== undefined
                ? self.parseDate(jumpDate)
                : self.latestSelectedDateObj ||
                    (self.config.minDate && self.config.minDate > self.now
                        ? self.config.minDate
                        : self.config.maxDate && self.config.maxDate < self.now
                            ? self.config.maxDate
                            : self.now);
            var oldYear = self.currentYear;
            var oldMonth = self.currentMonth;
            try {
                if (jumpTo !== undefined) {
                    self.currentYear = jumpTo.getFullYear();
                    self.currentMonth = jumpTo.getMonth();
                }
            }
            catch (e) {
                /* istanbul ignore next */
                e.message = "Invalid date supplied: " + jumpTo;
                self.config.errorHandler(e);
            }
            if (triggerChange && self.currentYear !== oldYear) {
                triggerEvent("onYearChange");
                buildMonthSwitch();
            }
            if (triggerChange &&
                (self.currentYear !== oldYear || self.currentMonth !== oldMonth)) {
                triggerEvent("onMonthChange");
            }
            self.redraw();
        }
        /**
         * The up/down arrow handler for time inputs
         * @param {Event} e the click event
         */
        function timeIncrement(e) {
            if (~e.target.className.indexOf("arrow"))
                incrementNumInput(e, e.target.classList.contains("arrowUp") ? 1 : -1);
        }
        /**
         * Increments/decrements the value of input associ-
         * ated with the up/down arrow by dispatching an
         * "increment" event on the input.
         *
         * @param {Event} e the click event
         * @param {Number} delta the diff (usually 1 or -1)
         * @param {Element} inputElem the input element
         */
        function incrementNumInput(e, delta, inputElem) {
            var target = e && e.target;
            var input = inputElem ||
                (target && target.parentNode && target.parentNode.firstChild);
            var event = createEvent("increment");
            event.delta = delta;
            input && input.dispatchEvent(event);
        }
        function build() {
            var fragment = window.document.createDocumentFragment();
            self.calendarContainer = createElement("div", "flatpickr-calendar");
            self.calendarContainer.tabIndex = -1;
            if (!self.config.noCalendar) {
                fragment.appendChild(buildMonthNav());
                self.innerContainer = createElement("div", "flatpickr-innerContainer");
                if (self.config.weekNumbers) {
                    var _a = buildWeeks(), weekWrapper = _a.weekWrapper, weekNumbers = _a.weekNumbers;
                    self.innerContainer.appendChild(weekWrapper);
                    self.weekNumbers = weekNumbers;
                    self.weekWrapper = weekWrapper;
                }
                self.rContainer = createElement("div", "flatpickr-rContainer");
                self.rContainer.appendChild(buildWeekdays());
                if (!self.daysContainer) {
                    self.daysContainer = createElement("div", "flatpickr-days");
                    self.daysContainer.tabIndex = -1;
                }
                buildDays();
                self.rContainer.appendChild(self.daysContainer);
                self.innerContainer.appendChild(self.rContainer);
                fragment.appendChild(self.innerContainer);
            }
            if (self.config.enableTime) {
                fragment.appendChild(buildTime());
            }
            toggleClass(self.calendarContainer, "rangeMode", self.config.mode === "range");
            toggleClass(self.calendarContainer, "animate", self.config.animate === true);
            toggleClass(self.calendarContainer, "multiMonth", self.config.showMonths > 1);
            self.calendarContainer.appendChild(fragment);
            var customAppend = self.config.appendTo !== undefined &&
                self.config.appendTo.nodeType !== undefined;
            if (self.config.inline || self.config.static) {
                self.calendarContainer.classList.add(self.config.inline ? "inline" : "static");
                if (self.config.inline) {
                    if (!customAppend && self.element.parentNode)
                        self.element.parentNode.insertBefore(self.calendarContainer, self._input.nextSibling);
                    else if (self.config.appendTo !== undefined)
                        self.config.appendTo.appendChild(self.calendarContainer);
                }
                if (self.config.static) {
                    var wrapper = createElement("div", "flatpickr-wrapper");
                    if (self.element.parentNode)
                        self.element.parentNode.insertBefore(wrapper, self.element);
                    wrapper.appendChild(self.element);
                    if (self.altInput)
                        wrapper.appendChild(self.altInput);
                    wrapper.appendChild(self.calendarContainer);
                }
            }
            if (!self.config.static && !self.config.inline)
                (self.config.appendTo !== undefined
                    ? self.config.appendTo
                    : window.document.body).appendChild(self.calendarContainer);
        }
        function createDay(className, date, dayNumber, i) {
            var dateIsEnabled = isEnabled(date, true), dayElement = createElement("span", "flatpickr-day " + className, date.getDate().toString());
            dayElement.dateObj = date;
            dayElement.$i = i;
            dayElement.setAttribute("aria-label", self.formatDate(date, self.config.ariaDateFormat));
            if (className.indexOf("hidden") === -1 &&
                compareDates(date, self.now) === 0) {
                self.todayDateElem = dayElement;
                dayElement.classList.add("today");
                dayElement.setAttribute("aria-current", "date");
            }
            if (dateIsEnabled) {
                dayElement.tabIndex = -1;
                if (isDateSelected(date)) {
                    dayElement.classList.add("selected");
                    self.selectedDateElem = dayElement;
                    if (self.config.mode === "range") {
                        toggleClass(dayElement, "startRange", self.selectedDates[0] &&
                            compareDates(date, self.selectedDates[0], true) === 0);
                        toggleClass(dayElement, "endRange", self.selectedDates[1] &&
                            compareDates(date, self.selectedDates[1], true) === 0);
                        if (className === "nextMonthDay")
                            dayElement.classList.add("inRange");
                    }
                }
            }
            else {
                dayElement.classList.add("flatpickr-disabled");
            }
            if (self.config.mode === "range") {
                if (isDateInRange(date) && !isDateSelected(date))
                    dayElement.classList.add("inRange");
            }
            if (self.weekNumbers &&
                self.config.showMonths === 1 &&
                className !== "prevMonthDay" &&
                dayNumber % 7 === 1) {
                self.weekNumbers.insertAdjacentHTML("beforeend", "<span class='flatpickr-day'>" + self.config.getWeek(date) + "</span>");
            }
            triggerEvent("onDayCreate", dayElement);
            return dayElement;
        }
        function focusOnDayElem(targetNode) {
            targetNode.focus();
            if (self.config.mode === "range")
                onMouseOver(targetNode);
        }
        function getFirstAvailableDay(delta) {
            var startMonth = delta > 0 ? 0 : self.config.showMonths - 1;
            var endMonth = delta > 0 ? self.config.showMonths : -1;
            for (var m = startMonth; m != endMonth; m += delta) {
                var month = self.daysContainer.children[m];
                var startIndex = delta > 0 ? 0 : month.children.length - 1;
                var endIndex = delta > 0 ? month.children.length : -1;
                for (var i = startIndex; i != endIndex; i += delta) {
                    var c = month.children[i];
                    if (c.className.indexOf("hidden") === -1 && isEnabled(c.dateObj))
                        return c;
                }
            }
            return undefined;
        }
        function getNextAvailableDay(current, delta) {
            var givenMonth = current.className.indexOf("Month") === -1
                ? current.dateObj.getMonth()
                : self.currentMonth;
            var endMonth = delta > 0 ? self.config.showMonths : -1;
            var loopDelta = delta > 0 ? 1 : -1;
            for (var m = givenMonth - self.currentMonth; m != endMonth; m += loopDelta) {
                var month = self.daysContainer.children[m];
                var startIndex = givenMonth - self.currentMonth === m
                    ? current.$i + delta
                    : delta < 0
                        ? month.children.length - 1
                        : 0;
                var numMonthDays = month.children.length;
                for (var i = startIndex; i >= 0 && i < numMonthDays && i != (delta > 0 ? numMonthDays : -1); i += loopDelta) {
                    var c = month.children[i];
                    if (c.className.indexOf("hidden") === -1 &&
                        isEnabled(c.dateObj) &&
                        Math.abs(current.$i - i) >= Math.abs(delta))
                        return focusOnDayElem(c);
                }
            }
            self.changeMonth(loopDelta);
            focusOnDay(getFirstAvailableDay(loopDelta), 0);
            return undefined;
        }
        function focusOnDay(current, offset) {
            var dayFocused = isInView(document.activeElement || document.body);
            var startElem = current !== undefined
                ? current
                : dayFocused
                    ? document.activeElement
                    : self.selectedDateElem !== undefined && isInView(self.selectedDateElem)
                        ? self.selectedDateElem
                        : self.todayDateElem !== undefined && isInView(self.todayDateElem)
                            ? self.todayDateElem
                            : getFirstAvailableDay(offset > 0 ? 1 : -1);
            if (startElem === undefined)
                return self._input.focus();
            if (!dayFocused)
                return focusOnDayElem(startElem);
            getNextAvailableDay(startElem, offset);
        }
        function buildMonthDays(year, month) {
            var firstOfMonth = (new Date(year, month, 1).getDay() - self.l10n.firstDayOfWeek + 7) % 7;
            var prevMonthDays = self.utils.getDaysInMonth((month - 1 + 12) % 12);
            var daysInMonth = self.utils.getDaysInMonth(month), days = window.document.createDocumentFragment(), isMultiMonth = self.config.showMonths > 1, prevMonthDayClass = isMultiMonth ? "prevMonthDay hidden" : "prevMonthDay", nextMonthDayClass = isMultiMonth ? "nextMonthDay hidden" : "nextMonthDay";
            var dayNumber = prevMonthDays + 1 - firstOfMonth, dayIndex = 0;
            // prepend days from the ending of previous month
            for (; dayNumber <= prevMonthDays; dayNumber++, dayIndex++) {
                days.appendChild(createDay(prevMonthDayClass, new Date(year, month - 1, dayNumber), dayNumber, dayIndex));
            }
            // Start at 1 since there is no 0th day
            for (dayNumber = 1; dayNumber <= daysInMonth; dayNumber++, dayIndex++) {
                days.appendChild(createDay("", new Date(year, month, dayNumber), dayNumber, dayIndex));
            }
            // append days from the next month
            for (var dayNum = daysInMonth + 1; dayNum <= 42 - firstOfMonth &&
                (self.config.showMonths === 1 || dayIndex % 7 !== 0); dayNum++, dayIndex++) {
                days.appendChild(createDay(nextMonthDayClass, new Date(year, month + 1, dayNum % daysInMonth), dayNum, dayIndex));
            }
            //updateNavigationCurrentMonth();
            var dayContainer = createElement("div", "dayContainer");
            dayContainer.appendChild(days);
            return dayContainer;
        }
        function buildDays() {
            if (self.daysContainer === undefined) {
                return;
            }
            clearNode(self.daysContainer);
            // TODO: week numbers for each month
            if (self.weekNumbers)
                clearNode(self.weekNumbers);
            var frag = document.createDocumentFragment();
            for (var i = 0; i < self.config.showMonths; i++) {
                var d = new Date(self.currentYear, self.currentMonth, 1);
                d.setMonth(self.currentMonth + i);
                frag.appendChild(buildMonthDays(d.getFullYear(), d.getMonth()));
            }
            self.daysContainer.appendChild(frag);
            self.days = self.daysContainer.firstChild;
            if (self.config.mode === "range" && self.selectedDates.length === 1) {
                onMouseOver();
            }
        }
        function buildMonthSwitch() {
            if (self.config.showMonths > 1)
                return;
            var shouldBuildMonth = function (month) {
                if (self.config.minDate !== undefined &&
                    self.currentYear === self.config.minDate.getFullYear() &&
                    month < self.config.minDate.getMonth()) {
                    return false;
                }
                return !(self.config.maxDate !== undefined &&
                    self.currentYear === self.config.maxDate.getFullYear() &&
                    month > self.config.maxDate.getMonth());
            };
            self.monthsDropdownContainer.tabIndex = -1;
            self.monthsDropdownContainer.innerHTML = "";
            for (var i = 0; i < 12; i++) {
                if (!shouldBuildMonth(i))
                    continue;
                var month = createElement("option", "flatpickr-monthDropdown-month");
                month.value = new Date(self.currentYear, i).getMonth().toString();
                month.textContent = monthToStr(i, false, self.l10n);
                month.tabIndex = -1;
                if (self.currentMonth === i) {
                    month.selected = true;
                }
                self.monthsDropdownContainer.appendChild(month);
            }
        }
        function buildMonth() {
            var container = createElement("div", "flatpickr-month");
            var monthNavFragment = window.document.createDocumentFragment();
            var monthElement;
            if (self.config.showMonths > 1) {
                monthElement = createElement("span", "cur-month");
            }
            else {
                self.monthsDropdownContainer = createElement("select", "flatpickr-monthDropdown-months");
                bind(self.monthsDropdownContainer, "change", function (e) {
                    var target = e.target;
                    var selectedMonth = parseInt(target.value, 10);
                    self.changeMonth(selectedMonth - self.currentMonth);
                    triggerEvent("onMonthChange");
                });
                buildMonthSwitch();
                monthElement = self.monthsDropdownContainer;
            }
            var yearInput = createNumberInput("cur-year", { tabindex: "-1" });
            var yearElement = yearInput.getElementsByTagName("input")[0];
            yearElement.setAttribute("aria-label", self.l10n.yearAriaLabel);
            if (self.config.minDate) {
                yearElement.setAttribute("min", self.config.minDate.getFullYear().toString());
            }
            if (self.config.maxDate) {
                yearElement.setAttribute("max", self.config.maxDate.getFullYear().toString());
                yearElement.disabled =
                    !!self.config.minDate &&
                        self.config.minDate.getFullYear() === self.config.maxDate.getFullYear();
            }
            var currentMonth = createElement("div", "flatpickr-current-month");
            currentMonth.appendChild(monthElement);
            currentMonth.appendChild(yearInput);
            monthNavFragment.appendChild(currentMonth);
            container.appendChild(monthNavFragment);
            return {
                container: container,
                yearElement: yearElement,
                monthElement: monthElement
            };
        }
        function buildMonths() {
            clearNode(self.monthNav);
            self.monthNav.appendChild(self.prevMonthNav);
            if (self.config.showMonths) {
                self.yearElements = [];
                self.monthElements = [];
            }
            for (var m = self.config.showMonths; m--;) {
                var month = buildMonth();
                self.yearElements.push(month.yearElement);
                self.monthElements.push(month.monthElement);
                self.monthNav.appendChild(month.container);
            }
            self.monthNav.appendChild(self.nextMonthNav);
        }
        function buildMonthNav() {
            self.monthNav = createElement("div", "flatpickr-months");
            self.yearElements = [];
            self.monthElements = [];
            self.prevMonthNav = createElement("span", "flatpickr-prev-month");
            self.prevMonthNav.innerHTML = self.config.prevArrow;
            self.nextMonthNav = createElement("span", "flatpickr-next-month");
            self.nextMonthNav.innerHTML = self.config.nextArrow;
            buildMonths();
            Object.defineProperty(self, "_hidePrevMonthArrow", {
                get: function () { return self.__hidePrevMonthArrow; },
                set: function (bool) {
                    if (self.__hidePrevMonthArrow !== bool) {
                        toggleClass(self.prevMonthNav, "flatpickr-disabled", bool);
                        self.__hidePrevMonthArrow = bool;
                    }
                }
            });
            Object.defineProperty(self, "_hideNextMonthArrow", {
                get: function () { return self.__hideNextMonthArrow; },
                set: function (bool) {
                    if (self.__hideNextMonthArrow !== bool) {
                        toggleClass(self.nextMonthNav, "flatpickr-disabled", bool);
                        self.__hideNextMonthArrow = bool;
                    }
                }
            });
            self.currentYearElement = self.yearElements[0];
            updateNavigationCurrentMonth();
            return self.monthNav;
        }
        function buildTime() {
            self.calendarContainer.classList.add("hasTime");
            if (self.config.noCalendar)
                self.calendarContainer.classList.add("noCalendar");
            self.timeContainer = createElement("div", "flatpickr-time");
            self.timeContainer.tabIndex = -1;
            var separator = createElement("span", "flatpickr-time-separator", ":");
            var hourInput = createNumberInput("flatpickr-hour");
            self.hourElement = hourInput.getElementsByTagName("input")[0];
            var minuteInput = createNumberInput("flatpickr-minute");
            self.minuteElement = minuteInput.getElementsByTagName("input")[0];
            self.hourElement.tabIndex = self.minuteElement.tabIndex = -1;
            self.hourElement.value = pad(self.latestSelectedDateObj
                ? self.latestSelectedDateObj.getHours()
                : self.config.time_24hr
                    ? self.config.defaultHour
                    : military2ampm(self.config.defaultHour));
            self.minuteElement.value = pad(self.latestSelectedDateObj
                ? self.latestSelectedDateObj.getMinutes()
                : self.config.defaultMinute);
            self.hourElement.setAttribute("step", self.config.hourIncrement.toString());
            self.minuteElement.setAttribute("step", self.config.minuteIncrement.toString());
            self.hourElement.setAttribute("min", self.config.time_24hr ? "0" : "1");
            self.hourElement.setAttribute("max", self.config.time_24hr ? "23" : "12");
            self.minuteElement.setAttribute("min", "0");
            self.minuteElement.setAttribute("max", "59");
            self.timeContainer.appendChild(hourInput);
            self.timeContainer.appendChild(separator);
            self.timeContainer.appendChild(minuteInput);
            if (self.config.time_24hr)
                self.timeContainer.classList.add("time24hr");
            if (self.config.enableSeconds) {
                self.timeContainer.classList.add("hasSeconds");
                var secondInput = createNumberInput("flatpickr-second");
                self.secondElement = secondInput.getElementsByTagName("input")[0];
                self.secondElement.value = pad(self.latestSelectedDateObj
                    ? self.latestSelectedDateObj.getSeconds()
                    : self.config.defaultSeconds);
                self.secondElement.setAttribute("step", self.minuteElement.getAttribute("step"));
                self.secondElement.setAttribute("min", "0");
                self.secondElement.setAttribute("max", "59");
                self.timeContainer.appendChild(createElement("span", "flatpickr-time-separator", ":"));
                self.timeContainer.appendChild(secondInput);
            }
            if (!self.config.time_24hr) {
                // add self.amPM if appropriate
                self.amPM = createElement("span", "flatpickr-am-pm", self.l10n.amPM[int((self.latestSelectedDateObj
                    ? self.hourElement.value
                    : self.config.defaultHour) > 11)]);
                self.amPM.title = self.l10n.toggleTitle;
                self.amPM.tabIndex = -1;
                self.timeContainer.appendChild(self.amPM);
            }
            return self.timeContainer;
        }
        function buildWeekdays() {
            if (!self.weekdayContainer)
                self.weekdayContainer = createElement("div", "flatpickr-weekdays");
            else
                clearNode(self.weekdayContainer);
            for (var i = self.config.showMonths; i--;) {
                var container = createElement("div", "flatpickr-weekdaycontainer");
                self.weekdayContainer.appendChild(container);
            }
            updateWeekdays();
            return self.weekdayContainer;
        }
        function updateWeekdays() {
            var firstDayOfWeek = self.l10n.firstDayOfWeek;
            var weekdays = self.l10n.weekdays.shorthand.slice();
            if (firstDayOfWeek > 0 && firstDayOfWeek < weekdays.length) {
                weekdays = weekdays.splice(firstDayOfWeek, weekdays.length).concat(weekdays.splice(0, firstDayOfWeek));
            }
            for (var i = self.config.showMonths; i--;) {
                self.weekdayContainer.children[i].innerHTML = "\n      <span class='flatpickr-weekday'>\n        " + weekdays.join("</span><span class='flatpickr-weekday'>") + "\n      </span>\n      ";
            }
        }
        /* istanbul ignore next */
        function buildWeeks() {
            self.calendarContainer.classList.add("hasWeeks");
            var weekWrapper = createElement("div", "flatpickr-weekwrapper");
            weekWrapper.appendChild(createElement("span", "flatpickr-weekday", self.l10n.weekAbbreviation));
            var weekNumbers = createElement("div", "flatpickr-weeks");
            weekWrapper.appendChild(weekNumbers);
            return {
                weekWrapper: weekWrapper,
                weekNumbers: weekNumbers
            };
        }
        function changeMonth(value, isOffset) {
            if (isOffset === void 0) { isOffset = true; }
            var delta = isOffset ? value : value - self.currentMonth;
            if ((delta < 0 && self._hidePrevMonthArrow === true) ||
                (delta > 0 && self._hideNextMonthArrow === true))
                return;
            self.currentMonth += delta;
            if (self.currentMonth < 0 || self.currentMonth > 11) {
                self.currentYear += self.currentMonth > 11 ? 1 : -1;
                self.currentMonth = (self.currentMonth + 12) % 12;
                triggerEvent("onYearChange");
                buildMonthSwitch();
            }
            buildDays();
            triggerEvent("onMonthChange");
            updateNavigationCurrentMonth();
        }
        function clear(triggerChangeEvent, toInitial) {
            if (triggerChangeEvent === void 0) { triggerChangeEvent = true; }
            if (toInitial === void 0) { toInitial = true; }
            self.input.value = "";
            if (self.altInput !== undefined)
                self.altInput.value = "";
            if (self.mobileInput !== undefined)
                self.mobileInput.value = "";
            self.selectedDates = [];
            self.latestSelectedDateObj = undefined;
            if (toInitial === true) {
                self.currentYear = self._initialDate.getFullYear();
                self.currentMonth = self._initialDate.getMonth();
            }
            self.showTimeInput = false;
            if (self.config.enableTime === true) {
                setDefaultHours();
            }
            self.redraw();
            if (triggerChangeEvent)
                // triggerChangeEvent is true (default) or an Event
                triggerEvent("onChange");
        }
        function close() {
            self.isOpen = false;
            if (!self.isMobile) {
                if (self.calendarContainer !== undefined) {
                    self.calendarContainer.classList.remove("open");
                }
                if (self._input !== undefined) {
                    self._input.classList.remove("active");
                }
            }
            triggerEvent("onClose");
        }
        function destroy() {
            if (self.config !== undefined)
                triggerEvent("onDestroy");
            for (var i = self._handlers.length; i--;) {
                var h = self._handlers[i];
                h.element.removeEventListener(h.event, h.handler, h.options);
            }
            self._handlers = [];
            if (self.mobileInput) {
                if (self.mobileInput.parentNode)
                    self.mobileInput.parentNode.removeChild(self.mobileInput);
                self.mobileInput = undefined;
            }
            else if (self.calendarContainer && self.calendarContainer.parentNode) {
                if (self.config.static && self.calendarContainer.parentNode) {
                    var wrapper = self.calendarContainer.parentNode;
                    wrapper.lastChild && wrapper.removeChild(wrapper.lastChild);
                    if (wrapper.parentNode) {
                        while (wrapper.firstChild)
                            wrapper.parentNode.insertBefore(wrapper.firstChild, wrapper);
                        wrapper.parentNode.removeChild(wrapper);
                    }
                }
                else
                    self.calendarContainer.parentNode.removeChild(self.calendarContainer);
            }
            if (self.altInput) {
                self.input.type = "text";
                if (self.altInput.parentNode)
                    self.altInput.parentNode.removeChild(self.altInput);
                delete self.altInput;
            }
            if (self.input) {
                self.input.type = self.input._type;
                self.input.classList.remove("flatpickr-input");
                self.input.removeAttribute("readonly");
                self.input.value = "";
            }
            [
                "_showTimeInput",
                "latestSelectedDateObj",
                "_hideNextMonthArrow",
                "_hidePrevMonthArrow",
                "__hideNextMonthArrow",
                "__hidePrevMonthArrow",
                "isMobile",
                "isOpen",
                "selectedDateElem",
                "minDateHasTime",
                "maxDateHasTime",
                "days",
                "daysContainer",
                "_input",
                "_positionElement",
                "innerContainer",
                "rContainer",
                "monthNav",
                "todayDateElem",
                "calendarContainer",
                "weekdayContainer",
                "prevMonthNav",
                "nextMonthNav",
                "monthsDropdownContainer",
                "currentMonthElement",
                "currentYearElement",
                "navigationCurrentMonth",
                "selectedDateElem",
                "config",
            ].forEach(function (k) {
                try {
                    delete self[k];
                }
                catch (_) { }
            });
        }
        function isCalendarElem(elem) {
            if (self.config.appendTo && self.config.appendTo.contains(elem))
                return true;
            return self.calendarContainer.contains(elem);
        }
        function documentClick(e) {
            if (self.isOpen && !self.config.inline) {
                var eventTarget_1 = getEventTarget(e);
                var isCalendarElement = isCalendarElem(eventTarget_1);
                var isInput = eventTarget_1 === self.input ||
                    eventTarget_1 === self.altInput ||
                    self.element.contains(eventTarget_1) ||
                    // web components
                    // e.path is not present in all browsers. circumventing typechecks
                    (e.path &&
                        e.path.indexOf &&
                        (~e.path.indexOf(self.input) ||
                            ~e.path.indexOf(self.altInput)));
                var lostFocus = e.type === "blur"
                    ? isInput &&
                        e.relatedTarget &&
                        !isCalendarElem(e.relatedTarget)
                    : !isInput &&
                        !isCalendarElement &&
                        !isCalendarElem(e.relatedTarget);
                var isIgnored = !self.config.ignoredFocusElements.some(function (elem) {
                    return elem.contains(eventTarget_1);
                });
                if (lostFocus && isIgnored) {
                    self.close();
                    if (self.config.mode === "range" && self.selectedDates.length === 1) {
                        self.clear(false);
                        self.redraw();
                    }
                }
            }
        }
        function changeYear(newYear) {
            if (!newYear ||
                (self.config.minDate && newYear < self.config.minDate.getFullYear()) ||
                (self.config.maxDate && newYear > self.config.maxDate.getFullYear()))
                return;
            var newYearNum = newYear, isNewYear = self.currentYear !== newYearNum;
            self.currentYear = newYearNum || self.currentYear;
            if (self.config.maxDate &&
                self.currentYear === self.config.maxDate.getFullYear()) {
                self.currentMonth = Math.min(self.config.maxDate.getMonth(), self.currentMonth);
            }
            else if (self.config.minDate &&
                self.currentYear === self.config.minDate.getFullYear()) {
                self.currentMonth = Math.max(self.config.minDate.getMonth(), self.currentMonth);
            }
            if (isNewYear) {
                self.redraw();
                triggerEvent("onYearChange");
                buildMonthSwitch();
            }
        }
        function isEnabled(date, timeless) {
            if (timeless === void 0) { timeless = true; }
            var dateToCheck = self.parseDate(date, undefined, timeless); // timeless
            if ((self.config.minDate &&
                dateToCheck &&
                compareDates(dateToCheck, self.config.minDate, timeless !== undefined ? timeless : !self.minDateHasTime) < 0) ||
                (self.config.maxDate &&
                    dateToCheck &&
                    compareDates(dateToCheck, self.config.maxDate, timeless !== undefined ? timeless : !self.maxDateHasTime) > 0))
                return false;
            if (self.config.enable.length === 0 && self.config.disable.length === 0)
                return true;
            if (dateToCheck === undefined)
                return false;
            var bool = self.config.enable.length > 0, array = bool ? self.config.enable : self.config.disable;
            for (var i = 0, d = void 0; i < array.length; i++) {
                d = array[i];
                if (typeof d === "function" &&
                    d(dateToCheck) // disabled by function
                )
                    return bool;
                else if (d instanceof Date &&
                    dateToCheck !== undefined &&
                    d.getTime() === dateToCheck.getTime())
                    // disabled by date
                    return bool;
                else if (typeof d === "string" && dateToCheck !== undefined) {
                    // disabled by date string
                    var parsed = self.parseDate(d, undefined, true);
                    return parsed && parsed.getTime() === dateToCheck.getTime()
                        ? bool
                        : !bool;
                }
                else if (
                // disabled by range
                typeof d === "object" &&
                    dateToCheck !== undefined &&
                    d.from &&
                    d.to &&
                    dateToCheck.getTime() >= d.from.getTime() &&
                    dateToCheck.getTime() <= d.to.getTime())
                    return bool;
            }
            return !bool;
        }
        function isInView(elem) {
            if (self.daysContainer !== undefined)
                return (elem.className.indexOf("hidden") === -1 &&
                    self.daysContainer.contains(elem));
            return false;
        }
        function onKeyDown(e) {
            // e.key                      e.keyCode
            // "Backspace"                        8
            // "Tab"                              9
            // "Enter"                           13
            // "Escape"     (IE "Esc")           27
            // "ArrowLeft"  (IE "Left")          37
            // "ArrowUp"    (IE "Up")            38
            // "ArrowRight" (IE "Right")         39
            // "ArrowDown"  (IE "Down")          40
            // "Delete"     (IE "Del")           46
            var isInput = e.target === self._input;
            var allowInput = self.config.allowInput;
            var allowKeydown = self.isOpen && (!allowInput || !isInput);
            var allowInlineKeydown = self.config.inline && isInput && !allowInput;
            if (e.keyCode === 13 && isInput) {
                if (allowInput) {
                    self.setDate(self._input.value, true, e.target === self.altInput
                        ? self.config.altFormat
                        : self.config.dateFormat);
                    return e.target.blur();
                }
                else {
                    self.open();
                }
            }
            else if (isCalendarElem(e.target) ||
                allowKeydown ||
                allowInlineKeydown) {
                var isTimeObj = !!self.timeContainer &&
                    self.timeContainer.contains(e.target);
                switch (e.keyCode) {
                    case 13:
                        if (isTimeObj) {
                            e.preventDefault();
                            updateTime();
                            focusAndClose();
                        }
                        else
                            selectDate(e);
                        break;
                    case 27: // escape
                        e.preventDefault();
                        focusAndClose();
                        break;
                    case 8:
                    case 46:
                        if (isInput && !self.config.allowInput) {
                            e.preventDefault();
                            self.clear();
                        }
                        break;
                    case 37:
                    case 39:
                        if (!isTimeObj && !isInput) {
                            e.preventDefault();
                            if (self.daysContainer !== undefined &&
                                (allowInput === false ||
                                    (document.activeElement && isInView(document.activeElement)))) {
                                var delta_1 = e.keyCode === 39 ? 1 : -1;
                                if (!e.ctrlKey)
                                    focusOnDay(undefined, delta_1);
                                else {
                                    e.stopPropagation();
                                    changeMonth(delta_1);
                                    focusOnDay(getFirstAvailableDay(1), 0);
                                }
                            }
                        }
                        else if (self.hourElement)
                            self.hourElement.focus();
                        break;
                    case 38:
                    case 40:
                        e.preventDefault();
                        var delta = e.keyCode === 40 ? 1 : -1;
                        if ((self.daysContainer && e.target.$i !== undefined) ||
                            e.target === self.input) {
                            if (e.ctrlKey) {
                                e.stopPropagation();
                                changeYear(self.currentYear - delta);
                                focusOnDay(getFirstAvailableDay(1), 0);
                            }
                            else if (!isTimeObj)
                                focusOnDay(undefined, delta * 7);
                        }
                        else if (e.target === self.currentYearElement) {
                            changeYear(self.currentYear - delta);
                        }
                        else if (self.config.enableTime) {
                            if (!isTimeObj && self.hourElement)
                                self.hourElement.focus();
                            updateTime(e);
                            self._debouncedChange();
                        }
                        break;
                    case 9:
                        if (isTimeObj) {
                            var elems = [
                                self.hourElement,
                                self.minuteElement,
                                self.secondElement,
                                self.amPM,
                            ]
                                .concat(self.pluginElements)
                                .filter(function (x) { return x; });
                            var i = elems.indexOf(e.target);
                            if (i !== -1) {
                                var target = elems[i + (e.shiftKey ? -1 : 1)];
                                e.preventDefault();
                                (target || self._input).focus();
                            }
                        }
                        else if (!self.config.noCalendar &&
                            self.daysContainer &&
                            self.daysContainer.contains(e.target) &&
                            e.shiftKey) {
                            e.preventDefault();
                            self._input.focus();
                        }
                        break;
                    default:
                        break;
                }
            }
            if (self.amPM !== undefined && e.target === self.amPM) {
                switch (e.key) {
                    case self.l10n.amPM[0].charAt(0):
                    case self.l10n.amPM[0].charAt(0).toLowerCase():
                        self.amPM.textContent = self.l10n.amPM[0];
                        setHoursFromInputs();
                        updateValue();
                        break;
                    case self.l10n.amPM[1].charAt(0):
                    case self.l10n.amPM[1].charAt(0).toLowerCase():
                        self.amPM.textContent = self.l10n.amPM[1];
                        setHoursFromInputs();
                        updateValue();
                        break;
                }
            }
            if (isInput || isCalendarElem(e.target)) {
                triggerEvent("onKeyDown", e);
            }
        }
        function onMouseOver(elem) {
            if (self.selectedDates.length !== 1 ||
                (elem &&
                    (!elem.classList.contains("flatpickr-day") ||
                        elem.classList.contains("flatpickr-disabled"))))
                return;
            var hoverDate = elem
                ? elem.dateObj.getTime()
                : self.days.firstElementChild.dateObj.getTime(), initialDate = self.parseDate(self.selectedDates[0], undefined, true).getTime(), rangeStartDate = Math.min(hoverDate, self.selectedDates[0].getTime()), rangeEndDate = Math.max(hoverDate, self.selectedDates[0].getTime());
            var containsDisabled = false;
            var minRange = 0, maxRange = 0;
            for (var t = rangeStartDate; t < rangeEndDate; t += duration.DAY) {
                if (!isEnabled(new Date(t), true)) {
                    containsDisabled =
                        containsDisabled || (t > rangeStartDate && t < rangeEndDate);
                    if (t < initialDate && (!minRange || t > minRange))
                        minRange = t;
                    else if (t > initialDate && (!maxRange || t < maxRange))
                        maxRange = t;
                }
            }
            for (var m = 0; m < self.config.showMonths; m++) {
                var month = self.daysContainer.children[m];
                var _loop_1 = function (i, l) {
                    var dayElem = month.children[i], date = dayElem.dateObj;
                    var timestamp = date.getTime();
                    var outOfRange = (minRange > 0 && timestamp < minRange) ||
                        (maxRange > 0 && timestamp > maxRange);
                    if (outOfRange) {
                        dayElem.classList.add("notAllowed");
                        ["inRange", "startRange", "endRange"].forEach(function (c) {
                            dayElem.classList.remove(c);
                        });
                        return "continue";
                    }
                    else if (containsDisabled && !outOfRange)
                        return "continue";
                    ["startRange", "inRange", "endRange", "notAllowed"].forEach(function (c) {
                        dayElem.classList.remove(c);
                    });
                    if (elem !== undefined) {
                        elem.classList.add(hoverDate <= self.selectedDates[0].getTime()
                            ? "startRange"
                            : "endRange");
                        if (initialDate < hoverDate && timestamp === initialDate)
                            dayElem.classList.add("startRange");
                        else if (initialDate > hoverDate && timestamp === initialDate)
                            dayElem.classList.add("endRange");
                        if (timestamp >= minRange &&
                            (maxRange === 0 || timestamp <= maxRange) &&
                            isBetween(timestamp, initialDate, hoverDate))
                            dayElem.classList.add("inRange");
                    }
                };
                for (var i = 0, l = month.children.length; i < l; i++) {
                    _loop_1(i, l);
                }
            }
        }
        function onResize() {
            if (self.isOpen && !self.config.static && !self.config.inline)
                positionCalendar();
        }
        function setDefaultTime() {
            self.setDate(self.config.minDate !== undefined
                ? new Date(self.config.minDate.getTime())
                : new Date(), true);
            setDefaultHours();
            updateValue();
        }
        function open(e, positionElement) {
            if (positionElement === void 0) { positionElement = self._positionElement; }
            if (self.isMobile === true) {
                if (e) {
                    e.preventDefault();
                    e.target && e.target.blur();
                }
                if (self.mobileInput !== undefined) {
                    self.mobileInput.focus();
                    self.mobileInput.click();
                }
                triggerEvent("onOpen");
                return;
            }
            if (self._input.disabled || self.config.inline)
                return;
            var wasOpen = self.isOpen;
            self.isOpen = true;
            if (!wasOpen) {
                self.calendarContainer.classList.add("open");
                self._input.classList.add("active");
                triggerEvent("onOpen");
                positionCalendar(positionElement);
            }
            if (self.config.enableTime === true && self.config.noCalendar === true) {
                if (self.selectedDates.length === 0) {
                    setDefaultTime();
                }
                if (self.config.allowInput === false &&
                    (e === undefined ||
                        !self.timeContainer.contains(e.relatedTarget))) {
                    setTimeout(function () { return self.hourElement.select(); }, 50);
                }
            }
        }
        function minMaxDateSetter(type) {
            return function (date) {
                var dateObj = (self.config["_" + type + "Date"] = self.parseDate(date, self.config.dateFormat));
                var inverseDateObj = self.config["_" + (type === "min" ? "max" : "min") + "Date"];
                if (dateObj !== undefined) {
                    self[type === "min" ? "minDateHasTime" : "maxDateHasTime"] =
                        dateObj.getHours() > 0 ||
                            dateObj.getMinutes() > 0 ||
                            dateObj.getSeconds() > 0;
                }
                if (self.selectedDates) {
                    self.selectedDates = self.selectedDates.filter(function (d) { return isEnabled(d); });
                    if (!self.selectedDates.length && type === "min")
                        setHoursFromDate(dateObj);
                    updateValue();
                }
                if (self.daysContainer) {
                    redraw();
                    if (dateObj !== undefined)
                        self.currentYearElement[type] = dateObj.getFullYear().toString();
                    else
                        self.currentYearElement.removeAttribute(type);
                    self.currentYearElement.disabled =
                        !!inverseDateObj &&
                            dateObj !== undefined &&
                            inverseDateObj.getFullYear() === dateObj.getFullYear();
                }
            };
        }
        function parseConfig() {
            var boolOpts = [
                "wrap",
                "weekNumbers",
                "allowInput",
                "clickOpens",
                "time_24hr",
                "enableTime",
                "noCalendar",
                "altInput",
                "shorthandCurrentMonth",
                "inline",
                "static",
                "enableSeconds",
                "disableMobile",
            ];
            var userConfig = __assign({}, instanceConfig, JSON.parse(JSON.stringify(element.dataset || {})));
            var formats = {};
            self.config.parseDate = userConfig.parseDate;
            self.config.formatDate = userConfig.formatDate;
            Object.defineProperty(self.config, "enable", {
                get: function () { return self.config._enable; },
                set: function (dates) {
                    self.config._enable = parseDateRules(dates);
                }
            });
            Object.defineProperty(self.config, "disable", {
                get: function () { return self.config._disable; },
                set: function (dates) {
                    self.config._disable = parseDateRules(dates);
                }
            });
            var timeMode = userConfig.mode === "time";
            if (!userConfig.dateFormat && (userConfig.enableTime || timeMode)) {
                var defaultDateFormat = flatpickr.defaultConfig.dateFormat || defaults.dateFormat;
                formats.dateFormat =
                    userConfig.noCalendar || timeMode
                        ? "H:i" + (userConfig.enableSeconds ? ":S" : "")
                        : defaultDateFormat + " H:i" + (userConfig.enableSeconds ? ":S" : "");
            }
            if (userConfig.altInput &&
                (userConfig.enableTime || timeMode) &&
                !userConfig.altFormat) {
                var defaultAltFormat = flatpickr.defaultConfig.altFormat || defaults.altFormat;
                formats.altFormat =
                    userConfig.noCalendar || timeMode
                        ? "h:i" + (userConfig.enableSeconds ? ":S K" : " K")
                        : defaultAltFormat + (" h:i" + (userConfig.enableSeconds ? ":S" : "") + " K");
            }
            if (!userConfig.altInputClass) {
                self.config.altInputClass =
                    self.input.className + " " + self.config.altInputClass;
            }
            Object.defineProperty(self.config, "minDate", {
                get: function () { return self.config._minDate; },
                set: minMaxDateSetter("min")
            });
            Object.defineProperty(self.config, "maxDate", {
                get: function () { return self.config._maxDate; },
                set: minMaxDateSetter("max")
            });
            var minMaxTimeSetter = function (type) { return function (val) {
                self.config[type === "min" ? "_minTime" : "_maxTime"] = self.parseDate(val, "H:i");
            }; };
            Object.defineProperty(self.config, "minTime", {
                get: function () { return self.config._minTime; },
                set: minMaxTimeSetter("min")
            });
            Object.defineProperty(self.config, "maxTime", {
                get: function () { return self.config._maxTime; },
                set: minMaxTimeSetter("max")
            });
            if (userConfig.mode === "time") {
                self.config.noCalendar = true;
                self.config.enableTime = true;
            }
            Object.assign(self.config, formats, userConfig);
            for (var i = 0; i < boolOpts.length; i++)
                self.config[boolOpts[i]] =
                    self.config[boolOpts[i]] === true ||
                        self.config[boolOpts[i]] === "true";
            HOOKS.filter(function (hook) { return self.config[hook] !== undefined; }).forEach(function (hook) {
                self.config[hook] = arrayify(self.config[hook] || []).map(bindToInstance);
            });
            self.isMobile =
                !self.config.disableMobile &&
                    !self.config.inline &&
                    self.config.mode === "single" &&
                    !self.config.disable.length &&
                    !self.config.enable.length &&
                    !self.config.weekNumbers &&
                    /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
            for (var i = 0; i < self.config.plugins.length; i++) {
                var pluginConf = self.config.plugins[i](self) || {};
                for (var key in pluginConf) {
                    if (HOOKS.indexOf(key) > -1) {
                        self.config[key] = arrayify(pluginConf[key])
                            .map(bindToInstance)
                            .concat(self.config[key]);
                    }
                    else if (typeof userConfig[key] === "undefined")
                        self.config[key] = pluginConf[key];
                }
            }
            triggerEvent("onParseConfig");
        }
        function setupLocale() {
            if (typeof self.config.locale !== "object" &&
                typeof flatpickr.l10ns[self.config.locale] === "undefined")
                self.config.errorHandler(new Error("flatpickr: invalid locale " + self.config.locale));
            self.l10n = __assign({}, flatpickr.l10ns["default"], (typeof self.config.locale === "object"
                ? self.config.locale
                : self.config.locale !== "default"
                    ? flatpickr.l10ns[self.config.locale]
                    : undefined));
            tokenRegex.K = "(" + self.l10n.amPM[0] + "|" + self.l10n.amPM[1] + "|" + self.l10n.amPM[0].toLowerCase() + "|" + self.l10n.amPM[1].toLowerCase() + ")";
            var userConfig = __assign({}, instanceConfig, JSON.parse(JSON.stringify(element.dataset || {})));
            if (userConfig.time_24hr === undefined &&
                flatpickr.defaultConfig.time_24hr === undefined) {
                self.config.time_24hr = self.l10n.time_24hr;
            }
            self.formatDate = createDateFormatter(self);
            self.parseDate = createDateParser({ config: self.config, l10n: self.l10n });
        }
        function positionCalendar(customPositionElement) {
            if (self.calendarContainer === undefined)
                return;
            triggerEvent("onPreCalendarPosition");
            var positionElement = customPositionElement || self._positionElement;
            var calendarHeight = Array.prototype.reduce.call(self.calendarContainer.children, (function (acc, child) { return acc + child.offsetHeight; }), 0), calendarWidth = self.calendarContainer.offsetWidth, configPos = self.config.position.split(" "), configPosVertical = configPos[0], configPosHorizontal = configPos.length > 1 ? configPos[1] : null, inputBounds = positionElement.getBoundingClientRect(), distanceFromBottom = window.innerHeight - inputBounds.bottom, showOnTop = configPosVertical === "above" ||
                (configPosVertical !== "below" &&
                    distanceFromBottom < calendarHeight &&
                    inputBounds.top > calendarHeight);
            var top = window.pageYOffset +
                inputBounds.top +
                (!showOnTop ? positionElement.offsetHeight + 2 : -calendarHeight - 2);
            toggleClass(self.calendarContainer, "arrowTop", !showOnTop);
            toggleClass(self.calendarContainer, "arrowBottom", showOnTop);
            if (self.config.inline)
                return;
            var left = window.pageXOffset +
                inputBounds.left -
                (configPosHorizontal != null && configPosHorizontal === "center"
                    ? (calendarWidth - inputBounds.width) / 2
                    : 0);
            var right = window.document.body.offsetWidth - inputBounds.right;
            var rightMost = left + calendarWidth > window.document.body.offsetWidth;
            var centerMost = right + calendarWidth > window.document.body.offsetWidth;
            toggleClass(self.calendarContainer, "rightMost", rightMost);
            if (self.config.static)
                return;
            self.calendarContainer.style.top = top + "px";
            if (!rightMost) {
                self.calendarContainer.style.left = left + "px";
                self.calendarContainer.style.right = "auto";
            }
            else if (!centerMost) {
                self.calendarContainer.style.left = "auto";
                self.calendarContainer.style.right = right + "px";
            }
            else {
                var doc = document.styleSheets[0];
                // some testing environments don't have css support
                if (doc === undefined)
                    return;
                var bodyWidth = window.document.body.offsetWidth;
                var centerLeft = Math.max(0, bodyWidth / 2 - calendarWidth / 2);
                var centerBefore = ".flatpickr-calendar.centerMost:before";
                var centerAfter = ".flatpickr-calendar.centerMost:after";
                var centerIndex = doc.cssRules.length;
                var centerStyle = "{left:" + inputBounds.left + "px;right:auto;}";
                toggleClass(self.calendarContainer, "rightMost", false);
                toggleClass(self.calendarContainer, "centerMost", true);
                doc.insertRule(centerBefore + "," + centerAfter + centerStyle, centerIndex);
                self.calendarContainer.style.left = centerLeft + "px";
                self.calendarContainer.style.right = "auto";
            }
        }
        function redraw() {
            if (self.config.noCalendar || self.isMobile)
                return;
            updateNavigationCurrentMonth();
            buildDays();
        }
        function focusAndClose() {
            self._input.focus();
            if (window.navigator.userAgent.indexOf("MSIE") !== -1 ||
                navigator.msMaxTouchPoints !== undefined) {
                // hack - bugs in the way IE handles focus keeps the calendar open
                setTimeout(self.close, 0);
            }
            else {
                self.close();
            }
        }
        function selectDate(e) {
            e.preventDefault();
            e.stopPropagation();
            var isSelectable = function (day) {
                return day.classList &&
                    day.classList.contains("flatpickr-day") &&
                    !day.classList.contains("flatpickr-disabled") &&
                    !day.classList.contains("notAllowed");
            };
            var t = findParent(e.target, isSelectable);
            if (t === undefined)
                return;
            var target = t;
            var selectedDate = (self.latestSelectedDateObj = new Date(target.dateObj.getTime()));
            var shouldChangeMonth = (selectedDate.getMonth() < self.currentMonth ||
                selectedDate.getMonth() >
                    self.currentMonth + self.config.showMonths - 1) &&
                self.config.mode !== "range";
            self.selectedDateElem = target;
            if (self.config.mode === "single")
                self.selectedDates = [selectedDate];
            else if (self.config.mode === "multiple") {
                var selectedIndex = isDateSelected(selectedDate);
                if (selectedIndex)
                    self.selectedDates.splice(parseInt(selectedIndex), 1);
                else
                    self.selectedDates.push(selectedDate);
            }
            else if (self.config.mode === "range") {
                if (self.selectedDates.length === 2) {
                    self.clear(false, false);
                }
                self.latestSelectedDateObj = selectedDate;
                self.selectedDates.push(selectedDate);
                // unless selecting same date twice, sort ascendingly
                if (compareDates(selectedDate, self.selectedDates[0], true) !== 0)
                    self.selectedDates.sort(function (a, b) { return a.getTime() - b.getTime(); });
            }
            setHoursFromInputs();
            if (shouldChangeMonth) {
                var isNewYear = self.currentYear !== selectedDate.getFullYear();
                self.currentYear = selectedDate.getFullYear();
                self.currentMonth = selectedDate.getMonth();
                if (isNewYear) {
                    triggerEvent("onYearChange");
                    buildMonthSwitch();
                }
                triggerEvent("onMonthChange");
            }
            updateNavigationCurrentMonth();
            buildDays();
            updateValue();
            if (self.config.enableTime)
                setTimeout(function () { return (self.showTimeInput = true); }, 50);
            // maintain focus
            if (!shouldChangeMonth &&
                self.config.mode !== "range" &&
                self.config.showMonths === 1)
                focusOnDayElem(target);
            else if (self.selectedDateElem !== undefined &&
                self.hourElement === undefined) {
                self.selectedDateElem && self.selectedDateElem.focus();
            }
            if (self.hourElement !== undefined)
                self.hourElement !== undefined && self.hourElement.focus();
            if (self.config.closeOnSelect) {
                var single = self.config.mode === "single" && !self.config.enableTime;
                var range = self.config.mode === "range" &&
                    self.selectedDates.length === 2 &&
                    !self.config.enableTime;
                if (single || range) {
                    focusAndClose();
                }
            }
            triggerChange();
        }
        var CALLBACKS = {
            locale: [setupLocale, updateWeekdays],
            showMonths: [buildMonths, setCalendarWidth, buildWeekdays],
            minDate: [jumpToDate],
            maxDate: [jumpToDate]
        };
        function set(option, value) {
            if (option !== null && typeof option === "object") {
                Object.assign(self.config, option);
                for (var key in option) {
                    if (CALLBACKS[key] !== undefined)
                        CALLBACKS[key].forEach(function (x) { return x(); });
                }
            }
            else {
                self.config[option] = value;
                if (CALLBACKS[option] !== undefined)
                    CALLBACKS[option].forEach(function (x) { return x(); });
                else if (HOOKS.indexOf(option) > -1)
                    self.config[option] = arrayify(value);
            }
            self.redraw();
            updateValue(false);
        }
        function setSelectedDate(inputDate, format) {
            var dates = [];
            if (inputDate instanceof Array)
                dates = inputDate.map(function (d) { return self.parseDate(d, format); });
            else if (inputDate instanceof Date || typeof inputDate === "number")
                dates = [self.parseDate(inputDate, format)];
            else if (typeof inputDate === "string") {
                switch (self.config.mode) {
                    case "single":
                    case "time":
                        dates = [self.parseDate(inputDate, format)];
                        break;
                    case "multiple":
                        dates = inputDate
                            .split(self.config.conjunction)
                            .map(function (date) { return self.parseDate(date, format); });
                        break;
                    case "range":
                        dates = inputDate
                            .split(self.l10n.rangeSeparator)
                            .map(function (date) { return self.parseDate(date, format); });
                        break;
                    default:
                        break;
                }
            }
            else
                self.config.errorHandler(new Error("Invalid date supplied: " + JSON.stringify(inputDate)));
            self.selectedDates = dates.filter(function (d) { return d instanceof Date && isEnabled(d, false); });
            if (self.config.mode === "range")
                self.selectedDates.sort(function (a, b) { return a.getTime() - b.getTime(); });
        }
        function setDate(date, triggerChange, format) {
            if (triggerChange === void 0) { triggerChange = false; }
            if (format === void 0) { format = self.config.dateFormat; }
            if ((date !== 0 && !date) || (date instanceof Array && date.length === 0))
                return self.clear(triggerChange);
            setSelectedDate(date, format);
            self.showTimeInput = self.selectedDates.length > 0;
            self.latestSelectedDateObj = self.selectedDates[self.selectedDates.length - 1];
            self.redraw();
            jumpToDate();
            setHoursFromDate();
            if (self.selectedDates.length === 0) {
                self.clear(false);
            }
            updateValue(triggerChange);
            if (triggerChange)
                triggerEvent("onChange");
        }
        function parseDateRules(arr) {
            return arr
                .slice()
                .map(function (rule) {
                if (typeof rule === "string" ||
                    typeof rule === "number" ||
                    rule instanceof Date) {
                    return self.parseDate(rule, undefined, true);
                }
                else if (rule &&
                    typeof rule === "object" &&
                    rule.from &&
                    rule.to)
                    return {
                        from: self.parseDate(rule.from, undefined),
                        to: self.parseDate(rule.to, undefined)
                    };
                return rule;
            })
                .filter(function (x) { return x; }); // remove falsy values
        }
        function setupDates() {
            self.selectedDates = [];
            self.now = self.parseDate(self.config.now) || new Date();
            // Workaround IE11 setting placeholder as the input's value
            var preloadedDate = self.config.defaultDate ||
                ((self.input.nodeName === "INPUT" ||
                    self.input.nodeName === "TEXTAREA") &&
                    self.input.placeholder &&
                    self.input.value === self.input.placeholder
                    ? null
                    : self.input.value);
            if (preloadedDate)
                setSelectedDate(preloadedDate, self.config.dateFormat);
            self._initialDate =
                self.selectedDates.length > 0
                    ? self.selectedDates[0]
                    : self.config.minDate &&
                        self.config.minDate.getTime() > self.now.getTime()
                        ? self.config.minDate
                        : self.config.maxDate &&
                            self.config.maxDate.getTime() < self.now.getTime()
                            ? self.config.maxDate
                            : self.now;
            self.currentYear = self._initialDate.getFullYear();
            self.currentMonth = self._initialDate.getMonth();
            if (self.selectedDates.length > 0)
                self.latestSelectedDateObj = self.selectedDates[0];
            if (self.config.minTime !== undefined)
                self.config.minTime = self.parseDate(self.config.minTime, "H:i");
            if (self.config.maxTime !== undefined)
                self.config.maxTime = self.parseDate(self.config.maxTime, "H:i");
            self.minDateHasTime =
                !!self.config.minDate &&
                    (self.config.minDate.getHours() > 0 ||
                        self.config.minDate.getMinutes() > 0 ||
                        self.config.minDate.getSeconds() > 0);
            self.maxDateHasTime =
                !!self.config.maxDate &&
                    (self.config.maxDate.getHours() > 0 ||
                        self.config.maxDate.getMinutes() > 0 ||
                        self.config.maxDate.getSeconds() > 0);
            Object.defineProperty(self, "showTimeInput", {
                get: function () { return self._showTimeInput; },
                set: function (bool) {
                    self._showTimeInput = bool;
                    if (self.calendarContainer)
                        toggleClass(self.calendarContainer, "showTimeInput", bool);
                    self.isOpen && positionCalendar();
                }
            });
        }
        function setupInputs() {
            self.input = self.config.wrap
                ? element.querySelector("[data-input]")
                : element;
            /* istanbul ignore next */
            if (!self.input) {
                self.config.errorHandler(new Error("Invalid input element specified"));
                return;
            }
            // hack: store previous type to restore it after destroy()
            self.input._type = self.input.type;
            self.input.type = "text";
            self.input.classList.add("flatpickr-input");
            self._input = self.input;
            if (self.config.altInput) {
                // replicate self.element
                self.altInput = createElement(self.input.nodeName, self.config.altInputClass);
                self._input = self.altInput;
                self.altInput.placeholder = self.input.placeholder;
                self.altInput.disabled = self.input.disabled;
                self.altInput.required = self.input.required;
                self.altInput.tabIndex = self.input.tabIndex;
                self.altInput.type = "text";
                self.input.setAttribute("type", "hidden");
                if (!self.config.static && self.input.parentNode)
                    self.input.parentNode.insertBefore(self.altInput, self.input.nextSibling);
            }
            if (!self.config.allowInput)
                self._input.setAttribute("readonly", "readonly");
            self._positionElement = self.config.positionElement || self._input;
        }
        function setupMobile() {
            var inputType = self.config.enableTime
                ? self.config.noCalendar
                    ? "time"
                    : "datetime-local"
                : "date";
            self.mobileInput = createElement("input", self.input.className + " flatpickr-mobile");
            self.mobileInput.step = self.input.getAttribute("step") || "any";
            self.mobileInput.tabIndex = 1;
            self.mobileInput.type = inputType;
            self.mobileInput.disabled = self.input.disabled;
            self.mobileInput.required = self.input.required;
            self.mobileInput.placeholder = self.input.placeholder;
            self.mobileFormatStr =
                inputType === "datetime-local"
                    ? "Y-m-d\\TH:i:S"
                    : inputType === "date"
                        ? "Y-m-d"
                        : "H:i:S";
            if (self.selectedDates.length > 0) {
                self.mobileInput.defaultValue = self.mobileInput.value = self.formatDate(self.selectedDates[0], self.mobileFormatStr);
            }
            if (self.config.minDate)
                self.mobileInput.min = self.formatDate(self.config.minDate, "Y-m-d");
            if (self.config.maxDate)
                self.mobileInput.max = self.formatDate(self.config.maxDate, "Y-m-d");
            self.input.type = "hidden";
            if (self.altInput !== undefined)
                self.altInput.type = "hidden";
            try {
                if (self.input.parentNode)
                    self.input.parentNode.insertBefore(self.mobileInput, self.input.nextSibling);
            }
            catch (_a) { }
            bind(self.mobileInput, "change", function (e) {
                self.setDate(e.target.value, false, self.mobileFormatStr);
                triggerEvent("onChange");
                triggerEvent("onClose");
            });
        }
        function toggle(e) {
            if (self.isOpen === true)
                return self.close();
            self.open(e);
        }
        function triggerEvent(event, data) {
            // If the instance has been destroyed already, all hooks have been removed
            if (self.config === undefined)
                return;
            var hooks = self.config[event];
            if (hooks !== undefined && hooks.length > 0) {
                for (var i = 0; hooks[i] && i < hooks.length; i++)
                    hooks[i](self.selectedDates, self.input.value, self, data);
            }
            if (event === "onChange") {
                self.input.dispatchEvent(createEvent("change"));
                // many front-end frameworks bind to the input event
                self.input.dispatchEvent(createEvent("input"));
            }
        }
        function createEvent(name) {
            var e = document.createEvent("Event");
            e.initEvent(name, true, true);
            return e;
        }
        function isDateSelected(date) {
            for (var i = 0; i < self.selectedDates.length; i++) {
                if (compareDates(self.selectedDates[i], date) === 0)
                    return "" + i;
            }
            return false;
        }
        function isDateInRange(date) {
            if (self.config.mode !== "range" || self.selectedDates.length < 2)
                return false;
            return (compareDates(date, self.selectedDates[0]) >= 0 &&
                compareDates(date, self.selectedDates[1]) <= 0);
        }
        function updateNavigationCurrentMonth() {
            if (self.config.noCalendar || self.isMobile || !self.monthNav)
                return;
            self.yearElements.forEach(function (yearElement, i) {
                var d = new Date(self.currentYear, self.currentMonth, 1);
                d.setMonth(self.currentMonth + i);
                if (self.config.showMonths > 1) {
                    self.monthElements[i].textContent =
                        monthToStr(d.getMonth(), self.config.shorthandCurrentMonth, self.l10n) + " ";
                }
                else {
                    self.monthsDropdownContainer.value = d.getMonth().toString();
                }
                yearElement.value = d.getFullYear().toString();
            });
            self._hidePrevMonthArrow =
                self.config.minDate !== undefined &&
                    (self.currentYear === self.config.minDate.getFullYear()
                        ? self.currentMonth <= self.config.minDate.getMonth()
                        : self.currentYear < self.config.minDate.getFullYear());
            self._hideNextMonthArrow =
                self.config.maxDate !== undefined &&
                    (self.currentYear === self.config.maxDate.getFullYear()
                        ? self.currentMonth + 1 > self.config.maxDate.getMonth()
                        : self.currentYear > self.config.maxDate.getFullYear());
        }
        function getDateStr(format) {
            return self.selectedDates
                .map(function (dObj) { return self.formatDate(dObj, format); })
                .filter(function (d, i, arr) {
                return self.config.mode !== "range" ||
                    self.config.enableTime ||
                    arr.indexOf(d) === i;
            })
                .join(self.config.mode !== "range"
                ? self.config.conjunction
                : self.l10n.rangeSeparator);
        }
        /**
         * Updates the values of inputs associated with the calendar
         */
        function updateValue(triggerChange) {
            if (triggerChange === void 0) { triggerChange = true; }
            if (self.mobileInput !== undefined && self.mobileFormatStr) {
                self.mobileInput.value =
                    self.latestSelectedDateObj !== undefined
                        ? self.formatDate(self.latestSelectedDateObj, self.mobileFormatStr)
                        : "";
            }
            self.input.value = getDateStr(self.config.dateFormat);
            if (self.altInput !== undefined) {
                self.altInput.value = getDateStr(self.config.altFormat);
            }
            if (triggerChange !== false)
                triggerEvent("onValueUpdate");
        }
        function onMonthNavClick(e) {
            var isPrevMonth = self.prevMonthNav.contains(e.target);
            var isNextMonth = self.nextMonthNav.contains(e.target);
            if (isPrevMonth || isNextMonth) {
                changeMonth(isPrevMonth ? -1 : 1);
            }
            else if (self.yearElements.indexOf(e.target) >= 0) {
                e.target.select();
            }
            else if (e.target.classList.contains("arrowUp")) {
                self.changeYear(self.currentYear + 1);
            }
            else if (e.target.classList.contains("arrowDown")) {
                self.changeYear(self.currentYear - 1);
            }
        }
        function timeWrapper(e) {
            e.preventDefault();
            var isKeyDown = e.type === "keydown", input = e.target;
            if (self.amPM !== undefined && e.target === self.amPM) {
                self.amPM.textContent =
                    self.l10n.amPM[int(self.amPM.textContent === self.l10n.amPM[0])];
            }
            var min = parseFloat(input.getAttribute("min")), max = parseFloat(input.getAttribute("max")), step = parseFloat(input.getAttribute("step")), curValue = parseInt(input.value, 10), delta = e.delta ||
                (isKeyDown ? (e.which === 38 ? 1 : -1) : 0);
            var newValue = curValue + step * delta;
            if (typeof input.value !== "undefined" && input.value.length === 2) {
                var isHourElem = input === self.hourElement, isMinuteElem = input === self.minuteElement;
                if (newValue < min) {
                    newValue =
                        max +
                            newValue +
                            int(!isHourElem) +
                            (int(isHourElem) && int(!self.amPM));
                    if (isMinuteElem)
                        incrementNumInput(undefined, -1, self.hourElement);
                }
                else if (newValue > max) {
                    newValue =
                        input === self.hourElement ? newValue - max - int(!self.amPM) : min;
                    if (isMinuteElem)
                        incrementNumInput(undefined, 1, self.hourElement);
                }
                if (self.amPM &&
                    isHourElem &&
                    (step === 1
                        ? newValue + curValue === 23
                        : Math.abs(newValue - curValue) > step)) {
                    self.amPM.textContent =
                        self.l10n.amPM[int(self.amPM.textContent === self.l10n.amPM[0])];
                }
                input.value = pad(newValue);
            }
        }
        init();
        return self;
    }
    /* istanbul ignore next */
    function _flatpickr(nodeList, config) {
        // static list
        var nodes = Array.prototype.slice
            .call(nodeList)
            .filter(function (x) { return x instanceof HTMLElement; });
        var instances = [];
        for (var i = 0; i < nodes.length; i++) {
            var node = nodes[i];
            try {
                if (node.getAttribute("data-fp-omit") !== null)
                    continue;
                if (node._flatpickr !== undefined) {
                    node._flatpickr.destroy();
                    node._flatpickr = undefined;
                }
                node._flatpickr = FlatpickrInstance(node, config || {});
                instances.push(node._flatpickr);
            }
            catch (e) {
                console.error(e);
            }
        }
        return instances.length === 1 ? instances[0] : instances;
    }
    /* istanbul ignore next */
    if (typeof HTMLElement !== "undefined" &&
        typeof HTMLCollection !== "undefined" &&
        typeof NodeList !== "undefined") {
        // browser env
        HTMLCollection.prototype.flatpickr = NodeList.prototype.flatpickr = function (config) {
            return _flatpickr(this, config);
        };
        HTMLElement.prototype.flatpickr = function (config) {
            return _flatpickr([this], config);
        };
    }
    /* istanbul ignore next */
    var flatpickr = function (selector, config) {
        if (typeof selector === "string") {
            return _flatpickr(window.document.querySelectorAll(selector), config);
        }
        else if (selector instanceof Node) {
            return _flatpickr([selector], config);
        }
        else {
            return _flatpickr(selector, config);
        }
    };
    /* istanbul ignore next */
    flatpickr.defaultConfig = {};
    flatpickr.l10ns = {
        en: __assign({}, english),
        "default": __assign({}, english)
    };
    flatpickr.localize = function (l10n) {
        flatpickr.l10ns["default"] = __assign({}, flatpickr.l10ns["default"], l10n);
    };
    flatpickr.setDefaults = function (config) {
        flatpickr.defaultConfig = __assign({}, flatpickr.defaultConfig, config);
    };
    flatpickr.parseDate = createDateParser({});
    flatpickr.formatDate = createDateFormatter({});
    flatpickr.compareDates = compareDates;
    /* istanbul ignore next */
    if (typeof jQuery !== "undefined" && typeof jQuery.fn !== "undefined") {
        jQuery.fn.flatpickr = function (config) {
            return _flatpickr(this, config);
        };
    }
    // eslint-disable-next-line @typescript-eslint/camelcase
    Date.prototype.fp_incr = function (days) {
        return new Date(this.getFullYear(), this.getMonth(), this.getDate() + (typeof days === "string" ? parseInt(days, 10) : days));
    };
    if (typeof window !== "undefined") {
        window.flatpickr = flatpickr;
    }

    return flatpickr;

}));

(function (global, factory) {
  typeof exports === 'object' && typeof module !== 'undefined' ? factory(exports) :
  typeof define === 'function' && define.amd ? define(['exports'], factory) :
  (global = global || self, factory(global.ru = {}));
}(this, function (exports) { 'use strict';

  var fp = typeof window !== "undefined" && window.flatpickr !== undefined
      ? window.flatpickr
      : {
          l10ns: {}
      };
  var Russian = {
      weekdays: {
          shorthand: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
          longhand: [
              "Воскресенье",
              "Понедельник",
              "Вторник",
              "Среда",
              "Четверг",
              "Пятница",
              "Суббота",
          ]
      },
      months: {
          shorthand: [
              "Янв",
              "Фев",
              "Март",
              "Апр",
              "Май",
              "Июнь",
              "Июль",
              "Авг",
              "Сен",
              "Окт",
              "Ноя",
              "Дек",
          ],
          longhand: [
              "Январь",
              "Февраль",
              "Март",
              "Апрель",
              "Май",
              "Июнь",
              "Июль",
              "Август",
              "Сентябрь",
              "Октябрь",
              "Ноябрь",
              "Декабрь",
          ]
      },
      firstDayOfWeek: 1,
      ordinal: function () {
          return "";
      },
      rangeSeparator: " — ",
      weekAbbreviation: "Нед.",
      scrollTitle: "Прокрутите для увеличения",
      toggleTitle: "Нажмите для переключения",
      amPM: ["ДП", "ПП"],
      yearAriaLabel: "Год",
      time_24hr: true
  };
  fp.l10ns.ru = Russian;
  var ru = fp.l10ns;

  exports.Russian = Russian;
  exports.default = ru;

  Object.defineProperty(exports, '__esModule', { value: true });

}));

/*! nanoScrollerJS - v0.8.7 - (c) 2015 James Florentino; Licensed MIT */

!function(a){return"function"==typeof define&&define.amd?define(["jquery"],function(b){return a(b,window,document)}):"object"==typeof exports?module.exports=a(require("jquery"),window,document):a(jQuery,window,document)}(function(a,b,c){"use strict";var d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z,A,B,C,D,E,F,G,H;z={paneClass:"nano-pane",sliderClass:"nano-slider",contentClass:"nano-content",enabledClass:"has-scrollbar",flashedClass:"flashed",activeClass:"active",iOSNativeScrolling:!1,preventPageScrolling:!1,disableResize:!1,alwaysVisible:!1,flashDelay:1500,sliderMinHeight:20,sliderMaxHeight:null,documentContext:null,windowContext:null},u="scrollbar",t="scroll",l="mousedown",m="mouseenter",n="mousemove",p="mousewheel",o="mouseup",s="resize",h="drag",i="enter",w="up",r="panedown",f="DOMMouseScroll",g="down",x="wheel",j="keydown",k="keyup",v="touchmove",d="Microsoft Internet Explorer"===b.navigator.appName&&/msie 7./i.test(b.navigator.appVersion)&&b.ActiveXObject,e=null,D=b.requestAnimationFrame,y=b.cancelAnimationFrame,F=c.createElement("div").style,H=function(){var a,b,c,d,e,f;for(d=["t","webkitT","MozT","msT","OT"],a=e=0,f=d.length;f>e;a=++e)if(c=d[a],b=d[a]+"ransform",b in F)return d[a].substr(0,d[a].length-1);return!1}(),G=function(a){return H===!1?!1:""===H?a:H+a.charAt(0).toUpperCase()+a.substr(1)},E=G("transform"),B=E!==!1,A=function(){var a,b,d;return a=c.createElement("div"),b=a.style,b.position="absolute",b.width="100px",b.height="100px",b.overflow=t,b.top="-9999px",c.body.appendChild(a),d=a.offsetWidth-a.clientWidth,c.body.removeChild(a),d},C=function(){var a,c,d;return c=b.navigator.userAgent,(a=/(?=.+Mac OS X)(?=.+Firefox)/.test(c))?(d=/Firefox\/\d{2}\./.exec(c),d&&(d=d[0].replace(/\D+/g,"")),a&&+d>23):!1},q=function(){function j(d,f){this.el=d,this.options=f,e||(e=A()),this.$el=a(this.el),this.doc=a(this.options.documentContext||c),this.win=a(this.options.windowContext||b),this.body=this.doc.find("body"),this.$content=this.$el.children("."+this.options.contentClass),this.$content.attr("tabindex",this.options.tabIndex||0),this.content=this.$content[0],this.previousPosition=0,this.options.iOSNativeScrolling&&null!=this.el.style.WebkitOverflowScrolling?this.nativeScrolling():this.generate(),this.createEvents(),this.addEvents(),this.reset()}return j.prototype.preventScrolling=function(a,b){if(this.isActive)if(a.type===f)(b===g&&a.originalEvent.detail>0||b===w&&a.originalEvent.detail<0)&&a.preventDefault();else if(a.type===p){if(!a.originalEvent||!a.originalEvent.wheelDelta)return;(b===g&&a.originalEvent.wheelDelta<0||b===w&&a.originalEvent.wheelDelta>0)&&a.preventDefault()}},j.prototype.nativeScrolling=function(){this.$content.css({WebkitOverflowScrolling:"touch"}),this.iOSNativeScrolling=!0,this.isActive=!0},j.prototype.updateScrollValues=function(){var a,b;a=this.content,this.maxScrollTop=a.scrollHeight-a.clientHeight,this.prevScrollTop=this.contentScrollTop||0,this.contentScrollTop=a.scrollTop,b=this.contentScrollTop>this.previousPosition?"down":this.contentScrollTop<this.previousPosition?"up":"same",this.previousPosition=this.contentScrollTop,"same"!==b&&this.$el.trigger("update",{position:this.contentScrollTop,maximum:this.maxScrollTop,direction:b}),this.iOSNativeScrolling||(this.maxSliderTop=this.paneHeight-this.sliderHeight,this.sliderTop=0===this.maxScrollTop?0:this.contentScrollTop*this.maxSliderTop/this.maxScrollTop)},j.prototype.setOnScrollStyles=function(){var a;B?(a={},a[E]="translate(0, "+this.sliderTop+"px)"):a={top:this.sliderTop},D?(y&&this.scrollRAF&&y(this.scrollRAF),this.scrollRAF=D(function(b){return function(){return b.scrollRAF=null,b.slider.css(a)}}(this))):this.slider.css(a)},j.prototype.createEvents=function(){this.events={down:function(a){return function(b){return a.isBeingDragged=!0,a.offsetY=b.pageY-a.slider.offset().top,a.slider.is(b.target)||(a.offsetY=0),a.pane.addClass(a.options.activeClass),a.doc.bind(n,a.events[h]).bind(o,a.events[w]),a.body.bind(m,a.events[i]),!1}}(this),drag:function(a){return function(b){return a.sliderY=b.pageY-a.$el.offset().top-a.paneTop-(a.offsetY||.5*a.sliderHeight),a.scroll(),a.contentScrollTop>=a.maxScrollTop&&a.prevScrollTop!==a.maxScrollTop?a.$el.trigger("scrollend"):0===a.contentScrollTop&&0!==a.prevScrollTop&&a.$el.trigger("scrolltop"),!1}}(this),up:function(a){return function(b){return a.isBeingDragged=!1,a.pane.removeClass(a.options.activeClass),a.doc.unbind(n,a.events[h]).unbind(o,a.events[w]),a.body.unbind(m,a.events[i]),!1}}(this),resize:function(a){return function(b){a.reset()}}(this),panedown:function(a){return function(b){return a.sliderY=(b.offsetY||b.originalEvent.layerY)-.5*a.sliderHeight,a.scroll(),a.events.down(b),!1}}(this),scroll:function(a){return function(b){a.updateScrollValues(),a.isBeingDragged||(a.iOSNativeScrolling||(a.sliderY=a.sliderTop,a.setOnScrollStyles()),null!=b&&(a.contentScrollTop>=a.maxScrollTop?(a.options.preventPageScrolling&&a.preventScrolling(b,g),a.prevScrollTop!==a.maxScrollTop&&a.$el.trigger("scrollend")):0===a.contentScrollTop&&(a.options.preventPageScrolling&&a.preventScrolling(b,w),0!==a.prevScrollTop&&a.$el.trigger("scrolltop"))))}}(this),wheel:function(a){return function(b){var c;if(null!=b)return c=b.delta||b.wheelDelta||b.originalEvent&&b.originalEvent.wheelDelta||-b.detail||b.originalEvent&&-b.originalEvent.detail,c&&(a.sliderY+=-c/3),a.scroll(),!1}}(this),enter:function(a){return function(b){var c;if(a.isBeingDragged)return 1!==(b.buttons||b.which)?(c=a.events)[w].apply(c,arguments):void 0}}(this)}},j.prototype.addEvents=function(){var a;this.removeEvents(),a=this.events,this.options.disableResize||this.win.bind(s,a[s]),this.iOSNativeScrolling||(this.slider.bind(l,a[g]),this.pane.bind(l,a[r]).bind(""+p+" "+f,a[x])),this.$content.bind(""+t+" "+p+" "+f+" "+v,a[t])},j.prototype.removeEvents=function(){var a;a=this.events,this.win.unbind(s,a[s]),this.iOSNativeScrolling||(this.slider.unbind(),this.pane.unbind()),this.$content.unbind(""+t+" "+p+" "+f+" "+v,a[t])},j.prototype.generate=function(){var a,c,d,f,g,h,i;return f=this.options,h=f.paneClass,i=f.sliderClass,a=f.contentClass,(g=this.$el.children("."+h)).length||g.children("."+i).length||this.$el.append('<div class="'+h+'"><div class="'+i+'" /></div>'),this.pane=this.$el.children("."+h),this.slider=this.pane.find("."+i),0===e&&C()?(d=b.getComputedStyle(this.content,null).getPropertyValue("padding-right").replace(/[^0-9.]+/g,""),c={right:-14,paddingRight:+d+14}):e&&(c={right:-e},this.$el.addClass(f.enabledClass)),null!=c&&this.$content.css(c),this},j.prototype.restore=function(){this.stopped=!1,this.iOSNativeScrolling||this.pane.show(),this.addEvents()},j.prototype.reset=function(){var a,b,c,f,g,h,i,j,k,l,m,n;return this.iOSNativeScrolling?void(this.contentHeight=this.content.scrollHeight):(this.$el.find("."+this.options.paneClass).length||this.generate().stop(),this.stopped&&this.restore(),a=this.content,f=a.style,g=f.overflowY,d&&this.$content.css({height:this.$content.height()}),b=a.scrollHeight+e,l=parseInt(this.$el.css("max-height"),10),l>0&&(this.$el.height(""),this.$el.height(a.scrollHeight>l?l:a.scrollHeight)),i=this.pane.outerHeight(!1),k=parseInt(this.pane.css("top"),10),h=parseInt(this.pane.css("bottom"),10),j=i+k+h,n=Math.round(j/b*i),n<this.options.sliderMinHeight?n=this.options.sliderMinHeight:null!=this.options.sliderMaxHeight&&n>this.options.sliderMaxHeight&&(n=this.options.sliderMaxHeight),g===t&&f.overflowX!==t&&(n+=e),this.maxSliderTop=j-n,this.contentHeight=b,this.paneHeight=i,this.paneOuterHeight=j,this.sliderHeight=n,this.paneTop=k,this.slider.height(n),this.events.scroll(),this.pane.show(),this.isActive=!0,a.scrollHeight===a.clientHeight||this.pane.outerHeight(!0)>=a.scrollHeight&&g!==t?(this.pane.hide(),this.isActive=!1):this.el.clientHeight===a.scrollHeight&&g===t?this.slider.hide():this.slider.show(),this.pane.css({opacity:this.options.alwaysVisible?1:"",visibility:this.options.alwaysVisible?"visible":""}),c=this.$content.css("position"),("static"===c||"relative"===c)&&(m=parseInt(this.$content.css("right"),10),m&&this.$content.css({right:"",marginRight:m})),this)},j.prototype.scroll=function(){return this.isActive?(this.sliderY=Math.max(0,this.sliderY),this.sliderY=Math.min(this.maxSliderTop,this.sliderY),this.$content.scrollTop(this.maxScrollTop*this.sliderY/this.maxSliderTop),this.iOSNativeScrolling||(this.updateScrollValues(),this.setOnScrollStyles()),this):void 0},j.prototype.scrollBottom=function(a){return this.isActive?(this.$content.scrollTop(this.contentHeight-this.$content.height()-a).trigger(p),this.stop().restore(),this):void 0},j.prototype.scrollTop=function(a){return this.isActive?(this.$content.scrollTop(+a).trigger(p),this.stop().restore(),this):void 0},j.prototype.scrollTo=function(a){return this.isActive?(this.scrollTop(this.$el.find(a).get(0).offsetTop),this):void 0},j.prototype.stop=function(){return y&&this.scrollRAF&&(y(this.scrollRAF),this.scrollRAF=null),this.stopped=!0,this.removeEvents(),this.iOSNativeScrolling||this.pane.hide(),this},j.prototype.destroy=function(){return this.stopped||this.stop(),!this.iOSNativeScrolling&&this.pane.length&&this.pane.remove(),d&&this.$content.height(""),this.$content.removeAttr("tabindex"),this.$el.hasClass(this.options.enabledClass)&&(this.$el.removeClass(this.options.enabledClass),this.$content.css({right:""})),this},j.prototype.flash=function(){return!this.iOSNativeScrolling&&this.isActive?(this.reset(),this.pane.addClass(this.options.flashedClass),setTimeout(function(a){return function(){a.pane.removeClass(a.options.flashedClass)}}(this),this.options.flashDelay),this):void 0},j}(),a.fn.nanoScroller=function(b){return this.each(function(){var c,d;if((d=this.nanoscroller)||(c=a.extend({},z,b),this.nanoscroller=d=new q(this,c)),b&&"object"==typeof b){if(a.extend(d.options,b),null!=b.scrollBottom)return d.scrollBottom(b.scrollBottom);if(null!=b.scrollTop)return d.scrollTop(b.scrollTop);if(b.scrollTo)return d.scrollTo(b.scrollTo);if("bottom"===b.scroll)return d.scrollBottom(0);if("top"===b.scroll)return d.scrollTop(0);if(b.scroll&&b.scroll instanceof a)return d.scrollTo(b.scroll);if(b.stop)return d.stop();if(b.destroy)return d.destroy();if(b.flash)return d.flash()}return d.reset()})},a.fn.nanoScroller.Constructor=q});
//# sourceMappingURL=jquery.nanoscroller.min.js.map
!function(t,e){"function"==typeof define&&define.amd?define(e):"object"==typeof exports?module.exports=e(require,exports,module):t.Tether=e()}(this,function(t,e,o){"use strict";function i(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function n(t){var e=getComputedStyle(t),o=e.position;if("fixed"===o)return t;for(var i=t;i=i.parentNode;){var n=void 0;try{n=getComputedStyle(i)}catch(r){}if("undefined"==typeof n||null===n)return i;var s=n.overflow,a=n.overflowX,f=n.overflowY;if(/(auto|scroll)/.test(s+f+a)&&("absolute"!==o||["relative","absolute","fixed"].indexOf(n.position)>=0))return i}return document.body}function r(t){var e=void 0;t===document?(e=document,t=document.documentElement):e=t.ownerDocument;var o=e.documentElement,i={},n=t.getBoundingClientRect();for(var r in n)i[r]=n[r];var s=x(e);return i.top-=s.top,i.left-=s.left,"undefined"==typeof i.width&&(i.width=document.body.scrollWidth-i.left-i.right),"undefined"==typeof i.height&&(i.height=document.body.scrollHeight-i.top-i.bottom),i.top=i.top-o.clientTop,i.left=i.left-o.clientLeft,i.right=e.body.clientWidth-i.width-i.left,i.bottom=e.body.clientHeight-i.height-i.top,i}function s(t){return t.offsetParent||document.documentElement}function a(){var t=document.createElement("div");t.style.width="100%",t.style.height="200px";var e=document.createElement("div");f(e.style,{position:"absolute",top:0,left:0,pointerEvents:"none",visibility:"hidden",width:"200px",height:"150px",overflow:"hidden"}),e.appendChild(t),document.body.appendChild(e);var o=t.offsetWidth;e.style.overflow="scroll";var i=t.offsetWidth;o===i&&(i=e.clientWidth),document.body.removeChild(e);var n=o-i;return{width:n,height:n}}function f(){var t=arguments.length<=0||void 0===arguments[0]?{}:arguments[0],e=[];return Array.prototype.push.apply(e,arguments),e.slice(1).forEach(function(e){if(e)for(var o in e)({}).hasOwnProperty.call(e,o)&&(t[o]=e[o])}),t}function h(t,e){if("undefined"!=typeof t.classList)e.split(" ").forEach(function(e){e.trim()&&t.classList.remove(e)});else{var o=new RegExp("(^| )"+e.split(" ").join("|")+"( |$)","gi"),i=u(t).replace(o," ");p(t,i)}}function l(t,e){if("undefined"!=typeof t.classList)e.split(" ").forEach(function(e){e.trim()&&t.classList.add(e)});else{h(t,e);var o=u(t)+(" "+e);p(t,o)}}function d(t,e){if("undefined"!=typeof t.classList)return t.classList.contains(e);var o=u(t);return new RegExp("(^| )"+e+"( |$)","gi").test(o)}function u(t){return t.className instanceof SVGAnimatedString?t.className.baseVal:t.className}function p(t,e){t.setAttribute("class",e)}function c(t,e,o){o.forEach(function(o){-1===e.indexOf(o)&&d(t,o)&&h(t,o)}),e.forEach(function(e){d(t,e)||l(t,e)})}function i(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function g(t,e){var o=arguments.length<=2||void 0===arguments[2]?1:arguments[2];return t+o>=e&&e>=t-o}function m(){return"undefined"!=typeof performance&&"undefined"!=typeof performance.now?performance.now():+new Date}function v(){for(var t={top:0,left:0},e=arguments.length,o=Array(e),i=0;e>i;i++)o[i]=arguments[i];return o.forEach(function(e){var o=e.top,i=e.left;"string"==typeof o&&(o=parseFloat(o,10)),"string"==typeof i&&(i=parseFloat(i,10)),t.top+=o,t.left+=i}),t}function y(t,e){return"string"==typeof t.left&&-1!==t.left.indexOf("%")&&(t.left=parseFloat(t.left,10)/100*e.width),"string"==typeof t.top&&-1!==t.top.indexOf("%")&&(t.top=parseFloat(t.top,10)/100*e.height),t}function b(t,e){return"scrollParent"===e?e=t.scrollParent:"window"===e&&(e=[pageXOffset,pageYOffset,innerWidth+pageXOffset,innerHeight+pageYOffset]),e===document&&(e=e.documentElement),"undefined"!=typeof e.nodeType&&!function(){var t=r(e),o=t,i=getComputedStyle(e);e=[o.left,o.top,t.width+o.left,t.height+o.top],U.forEach(function(t,o){t=t[0].toUpperCase()+t.substr(1),"Top"===t||"Left"===t?e[o]+=parseFloat(i["border"+t+"Width"]):e[o]-=parseFloat(i["border"+t+"Width"])})}(),e}var w=function(){function t(t,e){for(var o=0;o<e.length;o++){var i=e[o];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(t,i.key,i)}}return function(e,o,i){return o&&t(e.prototype,o),i&&t(e,i),e}}(),C=void 0;"undefined"==typeof C&&(C={modules:[]});var O=function(){var t=0;return function(){return++t}}(),E={},x=function(t){var e=t._tetherZeroElement;"undefined"==typeof e&&(e=t.createElement("div"),e.setAttribute("data-tether-id",O()),f(e.style,{top:0,left:0,position:"absolute"}),t.body.appendChild(e),t._tetherZeroElement=e);var o=e.getAttribute("data-tether-id");if("undefined"==typeof E[o]){E[o]={};var i=e.getBoundingClientRect();for(var n in i)E[o][n]=i[n];T(function(){delete E[o]})}return E[o]},A=[],T=function(t){A.push(t)},S=function(){for(var t=void 0;t=A.pop();)t()},W=function(){function t(){i(this,t)}return w(t,[{key:"on",value:function(t,e,o){var i=arguments.length<=3||void 0===arguments[3]?!1:arguments[3];"undefined"==typeof this.bindings&&(this.bindings={}),"undefined"==typeof this.bindings[t]&&(this.bindings[t]=[]),this.bindings[t].push({handler:e,ctx:o,once:i})}},{key:"once",value:function(t,e,o){this.on(t,e,o,!0)}},{key:"off",value:function(t,e){if("undefined"==typeof this.bindings||"undefined"==typeof this.bindings[t])if("undefined"==typeof e)delete this.bindings[t];else for(var o=0;o<this.bindings[t].length;)this.bindings[t][o].handler===e?this.bindings[t].splice(o,1):++o}},{key:"trigger",value:function(t){if("undefined"!=typeof this.bindings&&this.bindings[t])for(var e=0;e<this.bindings[t].length;){var o=this.bindings[t][e],i=o.handler,n=o.ctx,r=o.once,s=n;"undefined"==typeof s&&(s=this);for(var a=arguments.length,f=Array(a>1?a-1:0),h=1;a>h;h++)f[h-1]=arguments[h];i.apply(s,f),r?this.bindings[t].splice(e,1):++e}}}]),t}();C.Utils={getScrollParent:n,getBounds:r,getOffsetParent:s,extend:f,addClass:l,removeClass:h,hasClass:d,updateClasses:c,defer:T,flush:S,uniqueId:O,Evented:W,getScrollBarSize:a};var M=function(){function t(t,e){var o=[],i=!0,n=!1,r=void 0;try{for(var s,a=t[Symbol.iterator]();!(i=(s=a.next()).done)&&(o.push(s.value),!e||o.length!==e);i=!0);}catch(f){n=!0,r=f}finally{try{!i&&a["return"]&&a["return"]()}finally{if(n)throw r}}return o}return function(e,o){if(Array.isArray(e))return e;if(Symbol.iterator in Object(e))return t(e,o);throw new TypeError("Invalid attempt to destructure non-iterable instance")}}(),w=function(){function t(t,e){for(var o=0;o<e.length;o++){var i=e[o];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(t,i.key,i)}}return function(e,o,i){return o&&t(e.prototype,o),i&&t(e,i),e}}();if("undefined"==typeof C)throw new Error("You must include the utils.js file before tether.js");var P=C.Utils,n=P.getScrollParent,r=P.getBounds,s=P.getOffsetParent,f=P.extend,l=P.addClass,h=P.removeClass,c=P.updateClasses,T=P.defer,S=P.flush,a=P.getScrollBarSize,k=function(){for(var t=document.createElement("div"),e=["transform","webkitTransform","OTransform","MozTransform","msTransform"],o=0;o<e.length;++o){var i=e[o];if(void 0!==t.style[i])return i}}(),B=[],_=function(){B.forEach(function(t){t.position(!1)}),S()};!function(){var t=null,e=null,o=null,i=function n(){return"undefined"!=typeof e&&e>16?(e=Math.min(e-16,250),void(o=setTimeout(n,250))):void("undefined"!=typeof t&&m()-t<10||("undefined"!=typeof o&&(clearTimeout(o),o=null),t=m(),_(),e=m()-t))};["resize","scroll","touchmove"].forEach(function(t){window.addEventListener(t,i)})}();var z={center:"center",left:"right",right:"left"},F={middle:"middle",top:"bottom",bottom:"top"},L={top:0,left:0,middle:"50%",center:"50%",bottom:"100%",right:"100%"},Y=function(t,e){var o=t.left,i=t.top;return"auto"===o&&(o=z[e.left]),"auto"===i&&(i=F[e.top]),{left:o,top:i}},H=function(t){var e=t.left,o=t.top;return"undefined"!=typeof L[t.left]&&(e=L[t.left]),"undefined"!=typeof L[t.top]&&(o=L[t.top]),{left:e,top:o}},X=function(t){var e=t.split(" "),o=M(e,2),i=o[0],n=o[1];return{top:i,left:n}},j=X,N=function(){function t(e){var o=this;i(this,t),this.position=this.position.bind(this),B.push(this),this.history=[],this.setOptions(e,!1),C.modules.forEach(function(t){"undefined"!=typeof t.initialize&&t.initialize.call(o)}),this.position()}return w(t,[{key:"getClass",value:function(){var t=arguments.length<=0||void 0===arguments[0]?"":arguments[0],e=this.options.classes;return"undefined"!=typeof e&&e[t]?this.options.classes[t]:this.options.classPrefix?this.options.classPrefix+"-"+t:t}},{key:"setOptions",value:function(t){var e=this,o=arguments.length<=1||void 0===arguments[1]?!0:arguments[1],i={offset:"0 0",targetOffset:"0 0",targetAttachment:"auto auto",classPrefix:"tether"};this.options=f(i,t);var r=this.options,s=r.element,a=r.target,h=r.targetModifier;if(this.element=s,this.target=a,this.targetModifier=h,"viewport"===this.target?(this.target=document.body,this.targetModifier="visible"):"scroll-handle"===this.target&&(this.target=document.body,this.targetModifier="scroll-handle"),["element","target"].forEach(function(t){if("undefined"==typeof e[t])throw new Error("Tether Error: Both element and target must be defined");"undefined"!=typeof e[t].jquery?e[t]=e[t][0]:"string"==typeof e[t]&&(e[t]=document.querySelector(e[t]))}),l(this.element,this.getClass("element")),this.options.addTargetClasses!==!1&&l(this.target,this.getClass("target")),!this.options.attachment)throw new Error("Tether Error: You must provide an attachment");this.targetAttachment=j(this.options.targetAttachment),this.attachment=j(this.options.attachment),this.offset=X(this.options.offset),this.targetOffset=X(this.options.targetOffset),"undefined"!=typeof this.scrollParent&&this.disable(),this.scrollParent="scroll-handle"===this.targetModifier?this.target:n(this.target),this.options.enabled!==!1&&this.enable(o)}},{key:"getTargetBounds",value:function(){if("undefined"==typeof this.targetModifier)return r(this.target);if("visible"===this.targetModifier){if(this.target===document.body)return{top:pageYOffset,left:pageXOffset,height:innerHeight,width:innerWidth};var t=r(this.target),e={height:t.height,width:t.width,top:t.top,left:t.left};return e.height=Math.min(e.height,t.height-(pageYOffset-t.top)),e.height=Math.min(e.height,t.height-(t.top+t.height-(pageYOffset+innerHeight))),e.height=Math.min(innerHeight,e.height),e.height-=2,e.width=Math.min(e.width,t.width-(pageXOffset-t.left)),e.width=Math.min(e.width,t.width-(t.left+t.width-(pageXOffset+innerWidth))),e.width=Math.min(innerWidth,e.width),e.width-=2,e.top<pageYOffset&&(e.top=pageYOffset),e.left<pageXOffset&&(e.left=pageXOffset),e}if("scroll-handle"===this.targetModifier){var t=void 0,o=this.target;o===document.body?(o=document.documentElement,t={left:pageXOffset,top:pageYOffset,height:innerHeight,width:innerWidth}):t=r(o);var i=getComputedStyle(o),n=o.scrollWidth>o.clientWidth||[i.overflow,i.overflowX].indexOf("scroll")>=0||this.target!==document.body,s=0;n&&(s=15);var a=t.height-parseFloat(i.borderTopWidth)-parseFloat(i.borderBottomWidth)-s,e={width:15,height:.975*a*(a/o.scrollHeight),left:t.left+t.width-parseFloat(i.borderLeftWidth)-15},f=0;408>a&&this.target===document.body&&(f=-11e-5*Math.pow(a,2)-.00727*a+22.58),this.target!==document.body&&(e.height=Math.max(e.height,24));var h=this.target.scrollTop/(o.scrollHeight-a);return e.top=h*(a-e.height-f)+t.top+parseFloat(i.borderTopWidth),this.target===document.body&&(e.height=Math.max(e.height,24)),e}}},{key:"clearCache",value:function(){this._cache={}}},{key:"cache",value:function(t,e){return"undefined"==typeof this._cache&&(this._cache={}),"undefined"==typeof this._cache[t]&&(this._cache[t]=e.call(this)),this._cache[t]}},{key:"enable",value:function(){var t=arguments.length<=0||void 0===arguments[0]?!0:arguments[0];this.options.addTargetClasses!==!1&&l(this.target,this.getClass("enabled")),l(this.element,this.getClass("enabled")),this.enabled=!0,this.scrollParent!==document&&this.scrollParent.addEventListener("scroll",this.position),t&&this.position()}},{key:"disable",value:function(){h(this.target,this.getClass("enabled")),h(this.element,this.getClass("enabled")),this.enabled=!1,"undefined"!=typeof this.scrollParent&&this.scrollParent.removeEventListener("scroll",this.position)}},{key:"destroy",value:function(){var t=this;this.disable(),B.forEach(function(e,o){return e===t?void B.splice(o,1):void 0})}},{key:"updateAttachClasses",value:function(t,e){var o=this;t=t||this.attachment,e=e||this.targetAttachment;var i=["left","top","bottom","right","middle","center"];"undefined"!=typeof this._addAttachClasses&&this._addAttachClasses.length&&this._addAttachClasses.splice(0,this._addAttachClasses.length),"undefined"==typeof this._addAttachClasses&&(this._addAttachClasses=[]);var n=this._addAttachClasses;t.top&&n.push(this.getClass("element-attached")+"-"+t.top),t.left&&n.push(this.getClass("element-attached")+"-"+t.left),e.top&&n.push(this.getClass("target-attached")+"-"+e.top),e.left&&n.push(this.getClass("target-attached")+"-"+e.left);var r=[];i.forEach(function(t){r.push(o.getClass("element-attached")+"-"+t),r.push(o.getClass("target-attached")+"-"+t)}),T(function(){"undefined"!=typeof o._addAttachClasses&&(c(o.element,o._addAttachClasses,r),o.options.addTargetClasses!==!1&&c(o.target,o._addAttachClasses,r),delete o._addAttachClasses)})}},{key:"position",value:function(){var t=this,e=arguments.length<=0||void 0===arguments[0]?!0:arguments[0];if(this.enabled){this.clearCache();var o=Y(this.targetAttachment,this.attachment);this.updateAttachClasses(this.attachment,o);var i=this.cache("element-bounds",function(){return r(t.element)}),n=i.width,f=i.height;if(0===n&&0===f&&"undefined"!=typeof this.lastSize){var h=this.lastSize;n=h.width,f=h.height}else this.lastSize={width:n,height:f};var l=this.cache("target-bounds",function(){return t.getTargetBounds()}),d=l,u=y(H(this.attachment),{width:n,height:f}),p=y(H(o),d),c=y(this.offset,{width:n,height:f}),g=y(this.targetOffset,d);u=v(u,c),p=v(p,g);for(var m=l.left+p.left-u.left,b=l.top+p.top-u.top,w=0;w<C.modules.length;++w){var O=C.modules[w],E=O.position.call(this,{left:m,top:b,targetAttachment:o,targetPos:l,elementPos:i,offset:u,targetOffset:p,manualOffset:c,manualTargetOffset:g,scrollbarSize:A,attachment:this.attachment});if(E===!1)return!1;"undefined"!=typeof E&&"object"==typeof E&&(b=E.top,m=E.left)}var x={page:{top:b,left:m},viewport:{top:b-pageYOffset,bottom:pageYOffset-b-f+innerHeight,left:m-pageXOffset,right:pageXOffset-m-n+innerWidth}},A=void 0;return document.body.scrollWidth>window.innerWidth&&(A=this.cache("scrollbar-size",a),x.viewport.bottom-=A.height),document.body.scrollHeight>window.innerHeight&&(A=this.cache("scrollbar-size",a),x.viewport.right-=A.width),(-1===["","static"].indexOf(document.body.style.position)||-1===["","static"].indexOf(document.body.parentElement.style.position))&&(x.page.bottom=document.body.scrollHeight-b-f,x.page.right=document.body.scrollWidth-m-n),"undefined"!=typeof this.options.optimizations&&this.options.optimizations.moveElement!==!1&&"undefined"==typeof this.targetModifier&&!function(){var e=t.cache("target-offsetparent",function(){return s(t.target)}),o=t.cache("target-offsetparent-bounds",function(){return r(e)}),i=getComputedStyle(e),n=o,a={};if(["Top","Left","Bottom","Right"].forEach(function(t){a[t.toLowerCase()]=parseFloat(i["border"+t+"Width"])}),o.right=document.body.scrollWidth-o.left-n.width+a.right,o.bottom=document.body.scrollHeight-o.top-n.height+a.bottom,x.page.top>=o.top+a.top&&x.page.bottom>=o.bottom&&x.page.left>=o.left+a.left&&x.page.right>=o.right){var f=e.scrollTop,h=e.scrollLeft;x.offset={top:x.page.top-o.top+f-a.top,left:x.page.left-o.left+h-a.left}}}(),this.move(x),this.history.unshift(x),this.history.length>3&&this.history.pop(),e&&S(),!0}}},{key:"move",value:function(t){var e=this;if("undefined"!=typeof this.element.parentNode){var o={};for(var i in t){o[i]={};for(var n in t[i]){for(var r=!1,a=0;a<this.history.length;++a){var h=this.history[a];if("undefined"!=typeof h[i]&&!g(h[i][n],t[i][n])){r=!0;break}}r||(o[i][n]=!0)}}var l={top:"",left:"",right:"",bottom:""},d=function(t,o){var i="undefined"!=typeof e.options.optimizations,n=i?e.options.optimizations.gpu:null;if(n!==!1){var r=void 0,s=void 0;t.top?(l.top=0,r=o.top):(l.bottom=0,r=-o.bottom),t.left?(l.left=0,s=o.left):(l.right=0,s=-o.right),l[k]="translateX("+Math.round(s)+"px) translateY("+Math.round(r)+"px)","msTransform"!==k&&(l[k]+=" translateZ(0)")}else t.top?l.top=o.top+"px":l.bottom=o.bottom+"px",t.left?l.left=o.left+"px":l.right=o.right+"px"},u=!1;if((o.page.top||o.page.bottom)&&(o.page.left||o.page.right)?(l.position="absolute",d(o.page,t.page)):(o.viewport.top||o.viewport.bottom)&&(o.viewport.left||o.viewport.right)?(l.position="fixed",d(o.viewport,t.viewport)):"undefined"!=typeof o.offset&&o.offset.top&&o.offset.left?!function(){l.position="absolute";var i=e.cache("target-offsetparent",function(){return s(e.target)});s(e.element)!==i&&T(function(){e.element.parentNode.removeChild(e.element),i.appendChild(e.element)}),d(o.offset,t.offset),u=!0}():(l.position="absolute",d({top:!0,left:!0},t.page)),!u){for(var p=!0,c=this.element.parentNode;c&&"BODY"!==c.tagName;){if("static"!==getComputedStyle(c).position){p=!1;break}c=c.parentNode}p||(this.element.parentNode.removeChild(this.element),document.body.appendChild(this.element))}var m={},v=!1;for(var n in l){var y=l[n],b=this.element.style[n];""!==b&&""!==y&&["top","left","bottom","right"].indexOf(n)>=0&&(b=parseFloat(b),y=parseFloat(y)),b!==y&&(v=!0,m[n]=y)}v&&T(function(){f(e.element.style,m)})}}}]),t}();N.modules=[],C.position=_;var R=f(N,C),M=function(){function t(t,e){var o=[],i=!0,n=!1,r=void 0;try{for(var s,a=t[Symbol.iterator]();!(i=(s=a.next()).done)&&(o.push(s.value),!e||o.length!==e);i=!0);}catch(f){n=!0,r=f}finally{try{!i&&a["return"]&&a["return"]()}finally{if(n)throw r}}return o}return function(e,o){if(Array.isArray(e))return e;if(Symbol.iterator in Object(e))return t(e,o);throw new TypeError("Invalid attempt to destructure non-iterable instance")}}(),P=C.Utils,r=P.getBounds,f=P.extend,c=P.updateClasses,T=P.defer,U=["left","top","right","bottom"];C.modules.push({position:function(t){var e=this,o=t.top,i=t.left,n=t.targetAttachment;if(!this.options.constraints)return!0;var s=this.cache("element-bounds",function(){return r(e.element)}),a=s.height,h=s.width;if(0===h&&0===a&&"undefined"!=typeof this.lastSize){var l=this.lastSize;h=l.width,a=l.height}var d=this.cache("target-bounds",function(){return e.getTargetBounds()}),u=d.height,p=d.width,g=[this.getClass("pinned"),this.getClass("out-of-bounds")];this.options.constraints.forEach(function(t){var e=t.outOfBoundsClass,o=t.pinnedClass;e&&g.push(e),o&&g.push(o)}),g.forEach(function(t){["left","top","right","bottom"].forEach(function(e){g.push(t+"-"+e)})});var m=[],v=f({},n),y=f({},this.attachment);return this.options.constraints.forEach(function(t){var r=t.to,s=t.attachment,f=t.pin;"undefined"==typeof s&&(s="");var l=void 0,d=void 0;if(s.indexOf(" ")>=0){var c=s.split(" "),g=M(c,2);d=g[0],l=g[1]}else l=d=s;var w=b(e,r);("target"===d||"both"===d)&&(o<w[1]&&"top"===v.top&&(o+=u,v.top="bottom"),o+a>w[3]&&"bottom"===v.top&&(o-=u,v.top="top")),"together"===d&&(o<w[1]&&"top"===v.top&&("bottom"===y.top?(o+=u,v.top="bottom",o+=a,y.top="top"):"top"===y.top&&(o+=u,v.top="bottom",o-=a,y.top="bottom")),o+a>w[3]&&"bottom"===v.top&&("top"===y.top?(o-=u,v.top="top",o-=a,y.top="bottom"):"bottom"===y.top&&(o-=u,v.top="top",o+=a,y.top="top")),"middle"===v.top&&(o+a>w[3]&&"top"===y.top?(o-=a,y.top="bottom"):o<w[1]&&"bottom"===y.top&&(o+=a,y.top="top"))),("target"===l||"both"===l)&&(i<w[0]&&"left"===v.left&&(i+=p,v.left="right"),i+h>w[2]&&"right"===v.left&&(i-=p,v.left="left")),"together"===l&&(i<w[0]&&"left"===v.left?"right"===y.left?(i+=p,v.left="right",i+=h,y.left="left"):"left"===y.left&&(i+=p,v.left="right",i-=h,y.left="right"):i+h>w[2]&&"right"===v.left?"left"===y.left?(i-=p,v.left="left",i-=h,y.left="right"):"right"===y.left&&(i-=p,v.left="left",i+=h,y.left="left"):"center"===v.left&&(i+h>w[2]&&"left"===y.left?(i-=h,y.left="right"):i<w[0]&&"right"===y.left&&(i+=h,y.left="left"))),("element"===d||"both"===d)&&(o<w[1]&&"bottom"===y.top&&(o+=a,y.top="top"),o+a>w[3]&&"top"===y.top&&(o-=a,y.top="bottom")),("element"===l||"both"===l)&&(i<w[0]&&"right"===y.left&&(i+=h,y.left="left"),i+h>w[2]&&"left"===y.left&&(i-=h,y.left="right")),"string"==typeof f?f=f.split(",").map(function(t){return t.trim()}):f===!0&&(f=["top","left","right","bottom"]),f=f||[];var C=[],O=[];o<w[1]&&(f.indexOf("top")>=0?(o=w[1],C.push("top")):O.push("top")),o+a>w[3]&&(f.indexOf("bottom")>=0?(o=w[3]-a,C.push("bottom")):O.push("bottom")),i<w[0]&&(f.indexOf("left")>=0?(i=w[0],C.push("left")):O.push("left")),i+h>w[2]&&(f.indexOf("right")>=0?(i=w[2]-h,C.push("right")):O.push("right")),C.length&&!function(){var t=void 0;t="undefined"!=typeof e.options.pinnedClass?e.options.pinnedClass:e.getClass("pinned"),m.push(t),C.forEach(function(e){m.push(t+"-"+e)})}(),O.length&&!function(){var t=void 0;t="undefined"!=typeof e.options.outOfBoundsClass?e.options.outOfBoundsClass:e.getClass("out-of-bounds"),m.push(t),O.forEach(function(e){m.push(t+"-"+e)})}(),(C.indexOf("left")>=0||C.indexOf("right")>=0)&&(y.left=v.left=!1),(C.indexOf("top")>=0||C.indexOf("bottom")>=0)&&(y.top=v.top=!1),(v.top!==n.top||v.left!==n.left||y.top!==e.attachment.top||y.left!==e.attachment.left)&&e.updateAttachClasses(y,v)}),T(function(){e.options.addTargetClasses!==!1&&c(e.target,m,g),c(e.element,m,g)}),{top:o,left:i}}});var P=C.Utils,r=P.getBounds,c=P.updateClasses,T=P.defer;C.modules.push({position:function(t){var e=this,o=t.top,i=t.left,n=this.cache("element-bounds",function(){return r(e.element)}),s=n.height,a=n.width,f=this.getTargetBounds(),h=o+s,l=i+a,d=[];o<=f.bottom&&h>=f.top&&["left","right"].forEach(function(t){var e=f[t];(e===i||e===l)&&d.push(t)}),i<=f.right&&l>=f.left&&["top","bottom"].forEach(function(t){var e=f[t];(e===o||e===h)&&d.push(t)});var u=[],p=[],g=["left","top","right","bottom"];return u.push(this.getClass("abutted")),g.forEach(function(t){u.push(e.getClass("abutted")+"-"+t)}),d.length&&p.push(this.getClass("abutted")),d.forEach(function(t){p.push(e.getClass("abutted")+"-"+t)}),T(function(){e.options.addTargetClasses!==!1&&c(e.target,p,u),c(e.element,p,u)}),!0}});var M=function(){function t(t,e){var o=[],i=!0,n=!1,r=void 0;try{for(var s,a=t[Symbol.iterator]();!(i=(s=a.next()).done)&&(o.push(s.value),!e||o.length!==e);i=!0);}catch(f){n=!0,r=f}finally{try{!i&&a["return"]&&a["return"]()}finally{if(n)throw r}}return o}return function(e,o){if(Array.isArray(e))return e;if(Symbol.iterator in Object(e))return t(e,o);throw new TypeError("Invalid attempt to destructure non-iterable instance")}}();return C.modules.push({position:function(t){var e=t.top,o=t.left;if(this.options.shift){var i=this.options.shift;"function"==typeof this.options.shift&&(i=this.options.shift.call(this,{top:e,left:o}));var n=void 0,r=void 0;if("string"==typeof i){i=i.split(" "),i[1]=i[1]||i[0];var s=M(i,2);n=s[0],r=s[1],n=parseFloat(n,10),r=parseFloat(r,10)}else n=i.top,r=i.left;return e+=n,o+=r,{top:e,left:o}}}}),R});
'use strict';
var Config = {};
Config.Emoji = {
    "00a9": ["\u00A9", ["copyright"]],
    "00ae": ["\u00AE", ["registered"]],
    "203c": ["\u203C", ["bangbang"]],
    "2049": ["\u2049", ["interrobang"]],
    "2122": ["\u2122", ["tm"]],
    "2139": ["\u2139", ["information_source"]],
    "2194": ["\u2194", ["left_right_arrow"]],
    "2195": ["\u2195", ["arrow_up_down"]],
    "2196": ["\u2196", ["arrow_upper_left"]],
    "2197": ["\u2197", ["arrow_upper_right"]],
    "2198": ["\u2198", ["arrow_lower_right"]],
    "2199": ["\u2199", ["arrow_lower_left"]],
    "21a9": ["\u21A9", ["leftwards_arrow_with_hook"]],
    "21aa": ["\u21AA", ["arrow_right_hook"]],
    "231a": ["\u231A", ["watch"]],
    "231b": ["\u231B", ["hourglass"]],
    "23e9": ["\u23E9", ["fast_forward"]],
    "23ea": ["\u23EA", ["rewind"]],
    "23eb": ["\u23EB", ["arrow_double_up"]],
    "23ec": ["\u23EC", ["arrow_double_down"]],
    "23f0": ["\u23F0", ["alarm_clock"]],
    "23f3": ["\u23F3", ["hourglass_flowing_sand"]],
    "24c2": ["\u24C2", ["m"]],
    "25aa": ["\u25AA", ["black_small_square"]],
    "25ab": ["\u25AB", ["white_small_square"]],
    "25b6": ["\u25B6", ["arrow_forward"]],
    "25c0": ["\u25C0", ["arrow_backward"]],
    "25fb": ["\u25FB", ["white_medium_square"]],
    "25fc": ["\u25FC", ["black_medium_square"]],
    "25fd": ["\u25FD", ["white_medium_small_square"]],
    "25fe": ["\u25FE", ["black_medium_small_square"]],
    "2600": ["\u2600", ["sunny"]],
    "2601": ["\u2601", ["cloud"]],
    "260e": ["\u260E", ["phone", "telephone"]],
    "2611": ["\u2611", ["ballot_box_with_check"]],
    "2614": ["\u2614", ["umbrella"]],
    "2615": ["\u2615", ["coffee"]],
    "261d": ["\u261D", ["point_up"]],
    "263a": ["\u263A", ["relaxed"]],
    "2648": ["\u2648", ["aries"]],
    "2649": ["\u2649", ["taurus"]],
    "264a": ["\u264A", ["gemini"]],
    "264b": ["\u264B", ["cancer"]],
    "264c": ["\u264C", ["leo"]],
    "264d": ["\u264D", ["virgo"]],
    "264e": ["\u264E", ["libra"]],
    "264f": ["\u264F", ["scorpius"]],
    "2650": ["\u2650", ["sagittarius"]],
    "2651": ["\u2651", ["capricorn"]],
    "2652": ["\u2652", ["aquarius"]],
    "2653": ["\u2653", ["pisces"]],
    "2660": ["\u2660", ["spades"]],
    "2663": ["\u2663", ["clubs"]],
    "2665": ["\u2665", ["hearts"]],
    "2666": ["\u2666", ["diamonds"]],
    "2668": ["\u2668", ["hotsprings"]],
    "267b": ["\u267B", ["recycle"]],
    "267f": ["\u267F", ["wheelchair"]],
    "2693": ["\u2693", ["anchor"]],
    "26a0": ["\u26A0", ["warning"]],
    "26a1": ["\u26A1", ["zap"]],
    "26aa": ["\u26AA", ["white_circle"]],
    "26ab": ["\u26AB", ["black_circle"]],
    "26bd": ["\u26BD", ["soccer"]],
    "26be": ["\u26BE", ["baseball"]],
    "26c4": ["\u26C4", ["snowman"]],
    "26c5": ["\u26C5", ["partly_sunny"]],
    "26ce": ["\u26CE", ["ophiuchus"]],
    "26d4": ["\u26D4", ["no_entry"]],
    "26ea": ["\u26EA", ["church"]],
    "26f2": ["\u26F2", ["fountain"]],
    "26f3": ["\u26F3", ["golf"]],
    "26f5": ["\u26F5", ["boat", "sailboat"]],
    "26fa": ["\u26FA", ["tent"]],
    "26fd": ["\u26FD", ["fuelpump"]],
    "2702": ["\u2702", ["scissors"]],
    "2705": ["\u2705", ["white_check_mark"]],
    "2708": ["\u2708", ["airplane"]],
    "2709": ["\u2709", ["email", "envelope"]],
    "270a": ["\u270A", ["fist"]],
    "270b": ["\u270B", ["hand", "raised_hand"]],
    "270c": ["\u270C", ["v"]],
    "270f": ["\u270F", ["pencil2"]],
    "2712": ["\u2712", ["black_nib"]],
    "2714": ["\u2714", ["heavy_check_mark"]],
    "2716": ["\u2716", ["heavy_multiplication_x"]],
    "2728": ["\u2728", ["sparkles"]],
    "2733": ["\u2733", ["eight_spoked_asterisk"]],
    "2734": ["\u2734", ["eight_pointed_black_star"]],
    "2744": ["\u2744", ["snowflake"]],
    "2747": ["\u2747", ["sparkle"]],
    "274c": ["\u274C", ["x"]],
    "274e": ["\u274E", ["negative_squared_cross_mark"]],
    "2753": ["\u2753", ["question"]],
    "2754": ["\u2754", ["grey_question"]],
    "2755": ["\u2755", ["grey_exclamation"]],
    "2757": ["\u2757", ["exclamation", "heavy_exclamation_mark"]],
    "2764": ["\u2764", ["heart"], "<3"],
    "2795": ["\u2795", ["heavy_plus_sign"]],
    "2796": ["\u2796", ["heavy_minus_sign"]],
    "2797": ["\u2797", ["heavy_division_sign"]],
    "27a1": ["\u27A1", ["arrow_right"]],
    "27b0": ["\u27B0", ["curly_loop"]],
    "27bf": ["\u27BF", ["loop"]],
    "2934": ["\u2934", ["arrow_heading_up"]],
    "2935": ["\u2935", ["arrow_heading_down"]],
    "2b05": ["\u2B05", ["arrow_left"]],
    "2b06": ["\u2B06", ["arrow_up"]],
    "2b07": ["\u2B07", ["arrow_down"]],
    "2b1b": ["\u2B1B", ["black_large_square"]],
    "2b1c": ["\u2B1C", ["white_large_square"]],
    "2b50": ["\u2B50", ["star"]],
    "2b55": ["\u2B55", ["o"]],
    "3030": ["\u3030", ["wavy_dash"]],
    "303d": ["\u303D", ["part_alternation_mark"]],
    "3297": ["\u3297", ["congratulations"]],
    "3299": ["\u3299", ["secret"]],
    "1f004": ["\uD83C\uDC04", ["mahjong"]],
    "1f0cf": ["\uD83C\uDCCF", ["black_joker"]],
    "1f170": ["\uD83C\uDD70", ["a"]],
    "1f171": ["\uD83C\uDD71", ["b"]],
    "1f17e": ["\uD83C\uDD7E", ["o2"]],
    "1f17f": ["\uD83C\uDD7F", ["parking"]],
    "1f18e": ["\uD83C\uDD8E", ["ab"]],
    "1f191": ["\uD83C\uDD91", ["cl"]],
    "1f192": ["\uD83C\uDD92", ["cool"]],
    "1f193": ["\uD83C\uDD93", ["free"]],
    "1f194": ["\uD83C\uDD94", ["id"]],
    "1f195": ["\uD83C\uDD95", ["new"]],
    "1f196": ["\uD83C\uDD96", ["ng"]],
    "1f197": ["\uD83C\uDD97", ["ok"]],
    "1f198": ["\uD83C\uDD98", ["sos"]],
    "1f199": ["\uD83C\uDD99", ["up"]],
    "1f19a": ["\uD83C\uDD9A", ["vs"]],
    "1f201": ["\uD83C\uDE01", ["koko"]],
    "1f202": ["\uD83C\uDE02", ["sa"]],
    "1f21a": ["\uD83C\uDE1A", ["u7121"]],
    "1f22f": ["\uD83C\uDE2F", ["u6307"]],
    "1f232": ["\uD83C\uDE32", ["u7981"]],
    "1f233": ["\uD83C\uDE33", ["u7a7a"]],
    "1f234": ["\uD83C\uDE34", ["u5408"]],
    "1f235": ["\uD83C\uDE35", ["u6e80"]],
    "1f236": ["\uD83C\uDE36", ["u6709"]],
    "1f237": ["\uD83C\uDE37", ["u6708"]],
    "1f238": ["\uD83C\uDE38", ["u7533"]],
    "1f239": ["\uD83C\uDE39", ["u5272"]],
    "1f23a": ["\uD83C\uDE3A", ["u55b6"]],
    "1f250": ["\uD83C\uDE50", ["ideograph_advantage"]],
    "1f251": ["\uD83C\uDE51", ["accept"]],
    "1f300": ["\uD83C\uDF00", ["cyclone"]],
    "1f301": ["\uD83C\uDF01", ["foggy"]],
    "1f302": ["\uD83C\uDF02", ["closed_umbrella"]],
    "1f303": ["\uD83C\uDF03", ["night_with_stars"]],
    "1f304": ["\uD83C\uDF04", ["sunrise_over_mountains"]],
    "1f305": ["\uD83C\uDF05", ["sunrise"]],
    "1f306": ["\uD83C\uDF06", ["city_sunset"]],
    "1f307": ["\uD83C\uDF07", ["city_sunrise"]],
    "1f308": ["\uD83C\uDF08", ["rainbow"]],
    "1f309": ["\uD83C\uDF09", ["bridge_at_night"]],
    "1f30a": ["\uD83C\uDF0A", ["ocean"]],
    "1f30b": ["\uD83C\uDF0B", ["volcano"]],
    "1f30c": ["\uD83C\uDF0C", ["milky_way"]],
    "1f30d": ["\uD83C\uDF0D", ["earth_africa"]],
    "1f30e": ["\uD83C\uDF0E", ["earth_americas"]],
    "1f30f": ["\uD83C\uDF0F", ["earth_asia"]],
    "1f310": ["\uD83C\uDF10", ["globe_with_meridians"]],
    "1f311": ["\uD83C\uDF11", ["new_moon"]],
    "1f312": ["\uD83C\uDF12", ["waxing_crescent_moon"]],
    "1f313": ["\uD83C\uDF13", ["first_quarter_moon"]],
    "1f314": ["\uD83C\uDF14", ["moon", "waxing_gibbous_moon"]],
    "1f315": ["\uD83C\uDF15", ["full_moon"]],
    "1f316": ["\uD83C\uDF16", ["waning_gibbous_moon"]],
    "1f317": ["\uD83C\uDF17", ["last_quarter_moon"]],
    "1f318": ["\uD83C\uDF18", ["waning_crescent_moon"]],
    "1f319": ["\uD83C\uDF19", ["crescent_moon"]],
    "1f320": ["\uD83C\uDF20", ["stars"]],
    "1f31a": ["\uD83C\uDF1A", ["new_moon_with_face"]],
    "1f31b": ["\uD83C\uDF1B", ["first_quarter_moon_with_face"]],
    "1f31c": ["\uD83C\uDF1C", ["last_quarter_moon_with_face"]],
    "1f31d": ["\uD83C\uDF1D", ["full_moon_with_face"]],
    "1f31e": ["\uD83C\uDF1E", ["sun_with_face"]],
    "1f31f": ["\uD83C\uDF1F", ["star2"]],
    "1f330": ["\uD83C\uDF30", ["chestnut"]],
    "1f331": ["\uD83C\uDF31", ["seedling"]],
    "1f332": ["\uD83C\uDF32", ["evergreen_tree"]],
    "1f333": ["\uD83C\uDF33", ["deciduous_tree"]],
    "1f334": ["\uD83C\uDF34", ["palm_tree"]],
    "1f335": ["\uD83C\uDF35", ["cactus"]],
    "1f337": ["\uD83C\uDF37", ["tulip"]],
    "1f338": ["\uD83C\uDF38", ["cherry_blossom"]],
    "1f339": ["\uD83C\uDF39", ["rose"]],
    "1f33a": ["\uD83C\uDF3A", ["hibiscus"]],
    "1f33b": ["\uD83C\uDF3B", ["sunflower"]],
    "1f33c": ["\uD83C\uDF3C", ["blossom"]],
    "1f33d": ["\uD83C\uDF3D", ["corn"]],
    "1f33e": ["\uD83C\uDF3E", ["ear_of_rice"]],
    "1f33f": ["\uD83C\uDF3F", ["herb"]],
    "1f340": ["\uD83C\uDF40", ["four_leaf_clover"]],
    "1f341": ["\uD83C\uDF41", ["maple_leaf"]],
    "1f342": ["\uD83C\uDF42", ["fallen_leaf"]],
    "1f343": ["\uD83C\uDF43", ["leaves"]],
    "1f344": ["\uD83C\uDF44", ["mushroom"]],
    "1f345": ["\uD83C\uDF45", ["tomato"]],
    "1f346": ["\uD83C\uDF46", ["eggplant"]],
    "1f347": ["\uD83C\uDF47", ["grapes"]],
    "1f348": ["\uD83C\uDF48", ["melon"]],
    "1f349": ["\uD83C\uDF49", ["watermelon"]],
    "1f34a": ["\uD83C\uDF4A", ["tangerine"]],
    "1f34b": ["\uD83C\uDF4B", ["lemon"]],
    "1f34c": ["\uD83C\uDF4C", ["banana"]],
    "1f34d": ["\uD83C\uDF4D", ["pineapple"]],
    "1f34e": ["\uD83C\uDF4E", ["apple"]],
    "1f34f": ["\uD83C\uDF4F", ["green_apple"]],
    "1f350": ["\uD83C\uDF50", ["pear"]],
    "1f351": ["\uD83C\uDF51", ["peach"]],
    "1f352": ["\uD83C\uDF52", ["cherries"]],
    "1f353": ["\uD83C\uDF53", ["strawberry"]],
    "1f354": ["\uD83C\uDF54", ["hamburger"]],
    "1f355": ["\uD83C\uDF55", ["pizza"]],
    "1f356": ["\uD83C\uDF56", ["meat_on_bone"]],
    "1f357": ["\uD83C\uDF57", ["poultry_leg"]],
    "1f358": ["\uD83C\uDF58", ["rice_cracker"]],
    "1f359": ["\uD83C\uDF59", ["rice_ball"]],
    "1f35a": ["\uD83C\uDF5A", ["rice"]],
    "1f35b": ["\uD83C\uDF5B", ["curry"]],
    "1f35c": ["\uD83C\uDF5C", ["ramen"]],
    "1f35d": ["\uD83C\uDF5D", ["spaghetti"]],
    "1f35e": ["\uD83C\uDF5E", ["bread"]],
    "1f35f": ["\uD83C\uDF5F", ["fries"]],
    "1f360": ["\uD83C\uDF60", ["sweet_potato"]],
    "1f361": ["\uD83C\uDF61", ["dango"]],
    "1f362": ["\uD83C\uDF62", ["oden"]],
    "1f363": ["\uD83C\uDF63", ["sushi"]],
    "1f364": ["\uD83C\uDF64", ["fried_shrimp"]],
    "1f365": ["\uD83C\uDF65", ["fish_cake"]],
    "1f366": ["\uD83C\uDF66", ["icecream"]],
    "1f367": ["\uD83C\uDF67", ["shaved_ice"]],
    "1f368": ["\uD83C\uDF68", ["ice_cream"]],
    "1f369": ["\uD83C\uDF69", ["doughnut"]],
    "1f36a": ["\uD83C\uDF6A", ["cookie"]],
    "1f36b": ["\uD83C\uDF6B", ["chocolate_bar"]],
    "1f36c": ["\uD83C\uDF6C", ["candy"]],
    "1f36d": ["\uD83C\uDF6D", ["lollipop"]],
    "1f36e": ["\uD83C\uDF6E", ["custard"]],
    "1f36f": ["\uD83C\uDF6F", ["honey_pot"]],
    "1f370": ["\uD83C\uDF70", ["cake"]],
    "1f371": ["\uD83C\uDF71", ["bento"]],
    "1f372": ["\uD83C\uDF72", ["stew"]],
    "1f373": ["\uD83C\uDF73", ["egg"]],
    "1f374": ["\uD83C\uDF74", ["fork_and_knife"]],
    "1f375": ["\uD83C\uDF75", ["tea"]],
    "1f376": ["\uD83C\uDF76", ["sake"]],
    "1f377": ["\uD83C\uDF77", ["wine_glass"]],
    "1f378": ["\uD83C\uDF78", ["cocktail"]],
    "1f379": ["\uD83C\uDF79", ["tropical_drink"]],
    "1f37a": ["\uD83C\uDF7A", ["beer"]],
    "1f37b": ["\uD83C\uDF7B", ["beers"]],
    "1f37c": ["\uD83C\uDF7C", ["baby_bottle"]],
    "1f380": ["\uD83C\uDF80", ["ribbon"]],
    "1f381": ["\uD83C\uDF81", ["gift"]],
    "1f382": ["\uD83C\uDF82", ["birthday"]],
    "1f383": ["\uD83C\uDF83", ["jack_o_lantern"]],
    "1f384": ["\uD83C\uDF84", ["christmas_tree"]],
    "1f385": ["\uD83C\uDF85", ["santa"]],
    "1f386": ["\uD83C\uDF86", ["fireworks"]],
    "1f387": ["\uD83C\uDF87", ["sparkler"]],
    "1f388": ["\uD83C\uDF88", ["balloon"]],
    "1f389": ["\uD83C\uDF89", ["tada"]],
    "1f38a": ["\uD83C\uDF8A", ["confetti_ball"]],
    "1f38b": ["\uD83C\uDF8B", ["tanabata_tree"]],
    "1f38c": ["\uD83C\uDF8C", ["crossed_flags"]],
    "1f38d": ["\uD83C\uDF8D", ["bamboo"]],
    "1f38e": ["\uD83C\uDF8E", ["dolls"]],
    "1f38f": ["\uD83C\uDF8F", ["flags"]],
    "1f390": ["\uD83C\uDF90", ["wind_chime"]],
    "1f391": ["\uD83C\uDF91", ["rice_scene"]],
    "1f392": ["\uD83C\uDF92", ["school_satchel"]],
    "1f393": ["\uD83C\uDF93", ["mortar_board"]],
    "1f3a0": ["\uD83C\uDFA0", ["carousel_horse"]],
    "1f3a1": ["\uD83C\uDFA1", ["ferris_wheel"]],
    "1f3a2": ["\uD83C\uDFA2", ["roller_coaster"]],
    "1f3a3": ["\uD83C\uDFA3", ["fishing_pole_and_fish"]],
    "1f3a4": ["\uD83C\uDFA4", ["microphone"]],
    "1f3a5": ["\uD83C\uDFA5", ["movie_camera"]],
    "1f3a6": ["\uD83C\uDFA6", ["cinema"]],
    "1f3a7": ["\uD83C\uDFA7", ["headphones"]],
    "1f3a8": ["\uD83C\uDFA8", ["art"]],
    "1f3a9": ["\uD83C\uDFA9", ["tophat"]],
    "1f3aa": ["\uD83C\uDFAA", ["circus_tent"]],
    "1f3ab": ["\uD83C\uDFAB", ["ticket"]],
    "1f3ac": ["\uD83C\uDFAC", ["clapper"]],
    "1f3ad": ["\uD83C\uDFAD", ["performing_arts"]],
    "1f3ae": ["\uD83C\uDFAE", ["video_game"]],
    "1f3af": ["\uD83C\uDFAF", ["dart"]],
    "1f3b0": ["\uD83C\uDFB0", ["slot_machine"]],
    "1f3b1": ["\uD83C\uDFB1", ["8ball"]],
    "1f3b2": ["\uD83C\uDFB2", ["game_die"]],
    "1f3b3": ["\uD83C\uDFB3", ["bowling"]],
    "1f3b4": ["\uD83C\uDFB4", ["flower_playing_cards"]],
    "1f3b5": ["\uD83C\uDFB5", ["musical_note"]],
    "1f3b6": ["\uD83C\uDFB6", ["notes"]],
    "1f3b7": ["\uD83C\uDFB7", ["saxophone"]],
    "1f3b8": ["\uD83C\uDFB8", ["guitar"]],
    "1f3b9": ["\uD83C\uDFB9", ["musical_keyboard"]],
    "1f3ba": ["\uD83C\uDFBA", ["trumpet"]],
    "1f3bb": ["\uD83C\uDFBB", ["violin"]],
    "1f3bc": ["\uD83C\uDFBC", ["musical_score"]],
    "1f3bd": ["\uD83C\uDFBD", ["running_shirt_with_sash"]],
    "1f3be": ["\uD83C\uDFBE", ["tennis"]],
    "1f3bf": ["\uD83C\uDFBF", ["ski"]],
    "1f3c0": ["\uD83C\uDFC0", ["basketball"]],
    "1f3c1": ["\uD83C\uDFC1", ["checkered_flag"]],
    "1f3c2": ["\uD83C\uDFC2", ["snowboarder"]],
    "1f3c3": ["\uD83C\uDFC3", ["runner", "running"]],
    "1f3c4": ["\uD83C\uDFC4", ["surfer"]],
    "1f3c6": ["\uD83C\uDFC6", ["trophy"]],
    "1f3c7": ["\uD83C\uDFC7", ["horse_racing"]],
    "1f3c8": ["\uD83C\uDFC8", ["football"]],
    "1f3c9": ["\uD83C\uDFC9", ["rugby_football"]],
    "1f3ca": ["\uD83C\uDFCA", ["swimmer"]],
    "1f3e0": ["\uD83C\uDFE0", ["house"]],
    "1f3e1": ["\uD83C\uDFE1", ["house_with_garden"]],
    "1f3e2": ["\uD83C\uDFE2", ["office"]],
    "1f3e3": ["\uD83C\uDFE3", ["post_office"]],
    "1f3e4": ["\uD83C\uDFE4", ["european_post_office"]],
    "1f3e5": ["\uD83C\uDFE5", ["hospital"]],
    "1f3e6": ["\uD83C\uDFE6", ["bank"]],
    "1f3e7": ["\uD83C\uDFE7", ["atm"]],
    "1f3e8": ["\uD83C\uDFE8", ["hotel"]],
    "1f3e9": ["\uD83C\uDFE9", ["love_hotel"]],
    "1f3ea": ["\uD83C\uDFEA", ["convenience_store"]],
    "1f3eb": ["\uD83C\uDFEB", ["school"]],
    "1f3ec": ["\uD83C\uDFEC", ["department_store"]],
    "1f3ed": ["\uD83C\uDFED", ["factory"]],
    "1f3ee": ["\uD83C\uDFEE", ["izakaya_lantern", "lantern"]],
    "1f3ef": ["\uD83C\uDFEF", ["japanese_castle"]],
    "1f3f0": ["\uD83C\uDFF0", ["european_castle"]],
    "1f400": ["\uD83D\uDC00", ["rat"]],
    "1f401": ["\uD83D\uDC01", ["mouse2"]],
    "1f402": ["\uD83D\uDC02", ["ox"]],
    "1f403": ["\uD83D\uDC03", ["water_buffalo"]],
    "1f404": ["\uD83D\uDC04", ["cow2"]],
    "1f405": ["\uD83D\uDC05", ["tiger2"]],
    "1f406": ["\uD83D\uDC06", ["leopard"]],
    "1f407": ["\uD83D\uDC07", ["rabbit2"]],
    "1f408": ["\uD83D\uDC08", ["cat2"]],
    "1f409": ["\uD83D\uDC09", ["dragon"]],
    "1f40a": ["\uD83D\uDC0A", ["crocodile"]],
    "1f40b": ["\uD83D\uDC0B", ["whale2"]],
    "1f40c": ["\uD83D\uDC0C", ["snail"]],
    "1f40d": ["\uD83D\uDC0D", ["snake"]],
    "1f40e": ["\uD83D\uDC0E", ["racehorse"]],
    "1f40f": ["\uD83D\uDC0F", ["ram"]],
    "1f410": ["\uD83D\uDC10", ["goat"]],
    "1f411": ["\uD83D\uDC11", ["sheep"]],
    "1f412": ["\uD83D\uDC12", ["monkey"]],
    "1f413": ["\uD83D\uDC13", ["rooster"]],
    "1f414": ["\uD83D\uDC14", ["chicken"]],
    "1f415": ["\uD83D\uDC15", ["dog2"]],
    "1f416": ["\uD83D\uDC16", ["pig2"]],
    "1f417": ["\uD83D\uDC17", ["boar"]],
    "1f418": ["\uD83D\uDC18", ["elephant"]],
    "1f419": ["\uD83D\uDC19", ["octopus"]],
    "1f41a": ["\uD83D\uDC1A", ["shell"]],
    "1f41b": ["\uD83D\uDC1B", ["bug"]],
    "1f41c": ["\uD83D\uDC1C", ["ant"]],
    "1f41d": ["\uD83D\uDC1D", ["bee", "honeybee"]],
    "1f41e": ["\uD83D\uDC1E", ["beetle"]],
    "1f41f": ["\uD83D\uDC1F", ["fish"]],
    "1f420": ["\uD83D\uDC20", ["tropical_fish"]],
    "1f421": ["\uD83D\uDC21", ["blowfish"]],
    "1f422": ["\uD83D\uDC22", ["turtle"]],
    "1f423": ["\uD83D\uDC23", ["hatching_chick"]],
    "1f424": ["\uD83D\uDC24", ["baby_chick"]],
    "1f425": ["\uD83D\uDC25", ["hatched_chick"]],
    "1f426": ["\uD83D\uDC26", ["bird"]],
    "1f427": ["\uD83D\uDC27", ["penguin"]],
    "1f428": ["\uD83D\uDC28", ["koala"]],
    "1f429": ["\uD83D\uDC29", ["poodle"]],
    "1f42a": ["\uD83D\uDC2A", ["dromedary_camel"]],
    "1f42b": ["\uD83D\uDC2B", ["camel"]],
    "1f42c": ["\uD83D\uDC2C", ["dolphin", "flipper"]],
    "1f42d": ["\uD83D\uDC2D", ["mouse"]],
    "1f42e": ["\uD83D\uDC2E", ["cow"]],
    "1f42f": ["\uD83D\uDC2F", ["tiger"]],
    "1f430": ["\uD83D\uDC30", ["rabbit"]],
    "1f431": ["\uD83D\uDC31", ["cat"]],
    "1f432": ["\uD83D\uDC32", ["dragon_face"]],
    "1f433": ["\uD83D\uDC33", ["whale"]],
    "1f434": ["\uD83D\uDC34", ["horse"]],
    "1f435": ["\uD83D\uDC35", ["monkey_face"]],
    "1f436": ["\uD83D\uDC36", ["dog"]],
    "1f437": ["\uD83D\uDC37", ["pig"]],
    "1f438": ["\uD83D\uDC38", ["frog"]],
    "1f439": ["\uD83D\uDC39", ["hamster"]],
    "1f43a": ["\uD83D\uDC3A", ["wolf"]],
    "1f43b": ["\uD83D\uDC3B", ["bear"]],
    "1f43c": ["\uD83D\uDC3C", ["panda_face"]],
    "1f43d": ["\uD83D\uDC3D", ["pig_nose"]],
    "1f43e": ["\uD83D\uDC3E", ["feet", "paw_prints"]],
    "1f440": ["\uD83D\uDC40", ["eyes"]],
    "1f442": ["\uD83D\uDC42", ["ear"]],
    "1f443": ["\uD83D\uDC43", ["nose"]],
    "1f444": ["\uD83D\uDC44", ["lips"]],
    "1f445": ["\uD83D\uDC45", ["tongue"]],
    "1f446": ["\uD83D\uDC46", ["point_up_2"]],
    "1f447": ["\uD83D\uDC47", ["point_down"]],
    "1f448": ["\uD83D\uDC48", ["point_left"]],
    "1f449": ["\uD83D\uDC49", ["point_right"]],
    "1f44a": ["\uD83D\uDC4A", ["facepunch", "punch"]],
    "1f44b": ["\uD83D\uDC4B", ["wave"]],
    "1f44c": ["\uD83D\uDC4C", ["ok_hand"]],
    "1f44d": ["\uD83D\uDC4D", ["+1", "thumbsup"]],
    "1f44e": ["\uD83D\uDC4E", ["-1", "thumbsdown"]],
    "1f44f": ["\uD83D\uDC4F", ["clap"]],
    "1f450": ["\uD83D\uDC50", ["open_hands"]],
    "1f451": ["\uD83D\uDC51", ["crown"]],
    "1f452": ["\uD83D\uDC52", ["womans_hat"]],
    "1f453": ["\uD83D\uDC53", ["eyeglasses"]],
    "1f454": ["\uD83D\uDC54", ["necktie"]],
    "1f455": ["\uD83D\uDC55", ["shirt", "tshirt"]],
    "1f456": ["\uD83D\uDC56", ["jeans"]],
    "1f457": ["\uD83D\uDC57", ["dress"]],
    "1f458": ["\uD83D\uDC58", ["kimono"]],
    "1f459": ["\uD83D\uDC59", ["bikini"]],
    "1f45a": ["\uD83D\uDC5A", ["womans_clothes"]],
    "1f45b": ["\uD83D\uDC5B", ["purse"]],
    "1f45c": ["\uD83D\uDC5C", ["handbag"]],
    "1f45d": ["\uD83D\uDC5D", ["pouch"]],
    "1f45e": ["\uD83D\uDC5E", ["mans_shoe", "shoe"]],
    "1f45f": ["\uD83D\uDC5F", ["athletic_shoe"]],
    "1f460": ["\uD83D\uDC60", ["high_heel"]],
    "1f461": ["\uD83D\uDC61", ["sandal"]],
    "1f462": ["\uD83D\uDC62", ["boot"]],
    "1f463": ["\uD83D\uDC63", ["footprints"]],
    "1f464": ["\uD83D\uDC64", ["bust_in_silhouette"]],
    "1f465": ["\uD83D\uDC65", ["busts_in_silhouette"]],
    "1f466": ["\uD83D\uDC66", ["boy"]],
    "1f467": ["\uD83D\uDC67", ["girl"]],
    "1f468": ["\uD83D\uDC68", ["man"]],
    "1f469": ["\uD83D\uDC69", ["woman"]],
    "1f46a": ["\uD83D\uDC6A", ["family"]],
    "1f46b": ["\uD83D\uDC6B", ["couple"]],
    "1f46c": ["\uD83D\uDC6C", ["two_men_holding_hands"]],
    "1f46d": ["\uD83D\uDC6D", ["two_women_holding_hands"]],
    "1f46e": ["\uD83D\uDC6E", ["cop"]],
    "1f46f": ["\uD83D\uDC6F", ["dancers"]],
    "1f470": ["\uD83D\uDC70", ["bride_with_veil"]],
    "1f471": ["\uD83D\uDC71", ["person_with_blond_hair"]],
    "1f472": ["\uD83D\uDC72", ["man_with_gua_pi_mao"]],
    "1f473": ["\uD83D\uDC73", ["man_with_turban"]],
    "1f474": ["\uD83D\uDC74", ["older_man"]],
    "1f475": ["\uD83D\uDC75", ["older_woman"]],
    "1f476": ["\uD83D\uDC76", ["baby"]],
    "1f477": ["\uD83D\uDC77", ["construction_worker"]],
    "1f478": ["\uD83D\uDC78", ["princess"]],
    "1f479": ["\uD83D\uDC79", ["japanese_ogre"]],
    "1f47a": ["\uD83D\uDC7A", ["japanese_goblin"]],
    "1f47b": ["\uD83D\uDC7B", ["ghost"]],
    "1f47c": ["\uD83D\uDC7C", ["angel"]],
    "1f47d": ["\uD83D\uDC7D", ["alien"]],
    "1f47e": ["\uD83D\uDC7E", ["space_invader"]],
    "1f47f": ["\uD83D\uDC7F", ["imp"]],
    "1f480": ["\uD83D\uDC80", ["skull"]],
    "1f481": ["\uD83D\uDC81", ["information_desk_person"]],
    "1f482": ["\uD83D\uDC82", ["guardsman"]],
    "1f483": ["\uD83D\uDC83", ["dancer"]],
    "1f484": ["\uD83D\uDC84", ["lipstick"]],
    "1f485": ["\uD83D\uDC85", ["nail_care"]],
    "1f486": ["\uD83D\uDC86", ["massage"]],
    "1f487": ["\uD83D\uDC87", ["haircut"]],
    "1f488": ["\uD83D\uDC88", ["barber"]],
    "1f489": ["\uD83D\uDC89", ["syringe"]],
    "1f48a": ["\uD83D\uDC8A", ["pill"]],
    "1f48b": ["\uD83D\uDC8B", ["kiss"]],
    "1f48c": ["\uD83D\uDC8C", ["love_letter"]],
    "1f48d": ["\uD83D\uDC8D", ["ring"]],
    "1f48e": ["\uD83D\uDC8E", ["gem"]],
    "1f48f": ["\uD83D\uDC8F", ["couplekiss"]],
    "1f490": ["\uD83D\uDC90", ["bouquet"]],
    "1f491": ["\uD83D\uDC91", ["couple_with_heart"]],
    "1f492": ["\uD83D\uDC92", ["wedding"]],
    "1f493": ["\uD83D\uDC93", ["heartbeat"]],
    "1f494": ["\uD83D\uDC94", ["broken_heart"], "<\/3"],
    "1f495": ["\uD83D\uDC95", ["two_hearts"]],
    "1f496": ["\uD83D\uDC96", ["sparkling_heart"]],
    "1f497": ["\uD83D\uDC97", ["heartpulse"]],
    "1f498": ["\uD83D\uDC98", ["cupid"]],
    "1f499": ["\uD83D\uDC99", ["blue_heart"], "<3"],
    "1f49a": ["\uD83D\uDC9A", ["green_heart"], "<3"],
    "1f49b": ["\uD83D\uDC9B", ["yellow_heart"], "<3"],
    "1f49c": ["\uD83D\uDC9C", ["purple_heart"], "<3"],
    "1f49d": ["\uD83D\uDC9D", ["gift_heart"]],
    "1f49e": ["\uD83D\uDC9E", ["revolving_hearts"]],
    "1f49f": ["\uD83D\uDC9F", ["heart_decoration"]],
    "1f4a0": ["\uD83D\uDCA0", ["diamond_shape_with_a_dot_inside"]],
    "1f4a1": ["\uD83D\uDCA1", ["bulb"]],
    "1f4a2": ["\uD83D\uDCA2", ["anger"]],
    "1f4a3": ["\uD83D\uDCA3", ["bomb"]],
    "1f4a4": ["\uD83D\uDCA4", ["zzz"]],
    "1f4a5": ["\uD83D\uDCA5", ["boom", "collision"]],
    "1f4a6": ["\uD83D\uDCA6", ["sweat_drops"]],
    "1f4a7": ["\uD83D\uDCA7", ["droplet"]],
    "1f4a8": ["\uD83D\uDCA8", ["dash"]],
    "1f4a9": ["\uD83D\uDCA9", ["hankey", "poop", "shit"]],
    "1f4aa": ["\uD83D\uDCAA", ["muscle"]],
    "1f4ab": ["\uD83D\uDCAB", ["dizzy"]],
    "1f4ac": ["\uD83D\uDCAC", ["speech_balloon"]],
    "1f4ad": ["\uD83D\uDCAD", ["thought_balloon"]],
    "1f4ae": ["\uD83D\uDCAE", ["white_flower"]],
    "1f4af": ["\uD83D\uDCAF", ["100"]],
    "1f4b0": ["\uD83D\uDCB0", ["moneybag"]],
    "1f4b1": ["\uD83D\uDCB1", ["currency_exchange"]],
    "1f4b2": ["\uD83D\uDCB2", ["heavy_dollar_sign"]],
    "1f4b3": ["\uD83D\uDCB3", ["credit_card"]],
    "1f4b4": ["\uD83D\uDCB4", ["yen"]],
    "1f4b5": ["\uD83D\uDCB5", ["dollar"]],
    "1f4b6": ["\uD83D\uDCB6", ["euro"]],
    "1f4b7": ["\uD83D\uDCB7", ["pound"]],
    "1f4b8": ["\uD83D\uDCB8", ["money_with_wings"]],
    "1f4b9": ["\uD83D\uDCB9", ["chart"]],
    "1f4ba": ["\uD83D\uDCBA", ["seat"]],
    "1f4bb": ["\uD83D\uDCBB", ["computer"]],
    "1f4bc": ["\uD83D\uDCBC", ["briefcase"]],
    "1f4bd": ["\uD83D\uDCBD", ["minidisc"]],
    "1f4be": ["\uD83D\uDCBE", ["floppy_disk"]],
    "1f4bf": ["\uD83D\uDCBF", ["cd"]],
    "1f4c0": ["\uD83D\uDCC0", ["dvd"]],
    "1f4c1": ["\uD83D\uDCC1", ["file_folder"]],
    "1f4c2": ["\uD83D\uDCC2", ["open_file_folder"]],
    "1f4c3": ["\uD83D\uDCC3", ["page_with_curl"]],
    "1f4c4": ["\uD83D\uDCC4", ["page_facing_up"]],
    "1f4c5": ["\uD83D\uDCC5", ["date"]],
    "1f4c6": ["\uD83D\uDCC6", ["calendar"]],
    "1f4c7": ["\uD83D\uDCC7", ["card_index"]],
    "1f4c8": ["\uD83D\uDCC8", ["chart_with_upwards_trend"]],
    "1f4c9": ["\uD83D\uDCC9", ["chart_with_downwards_trend"]],
    "1f4ca": ["\uD83D\uDCCA", ["bar_chart"]],
    "1f4cb": ["\uD83D\uDCCB", ["clipboard"]],
    "1f4cc": ["\uD83D\uDCCC", ["pushpin"]],
    "1f4cd": ["\uD83D\uDCCD", ["round_pushpin"]],
    "1f4ce": ["\uD83D\uDCCE", ["paperclip"]],
    "1f4cf": ["\uD83D\uDCCF", ["straight_ruler"]],
    "1f4d0": ["\uD83D\uDCD0", ["triangular_ruler"]],
    "1f4d1": ["\uD83D\uDCD1", ["bookmark_tabs"]],
    "1f4d2": ["\uD83D\uDCD2", ["ledger"]],
    "1f4d3": ["\uD83D\uDCD3", ["notebook"]],
    "1f4d4": ["\uD83D\uDCD4", ["notebook_with_decorative_cover"]],
    "1f4d5": ["\uD83D\uDCD5", ["closed_book"]],
    "1f4d6": ["\uD83D\uDCD6", ["book", "open_book"]],
    "1f4d7": ["\uD83D\uDCD7", ["green_book"]],
    "1f4d8": ["\uD83D\uDCD8", ["blue_book"]],
    "1f4d9": ["\uD83D\uDCD9", ["orange_book"]],
    "1f4da": ["\uD83D\uDCDA", ["books"]],
    "1f4db": ["\uD83D\uDCDB", ["name_badge"]],
    "1f4dc": ["\uD83D\uDCDC", ["scroll"]],
    "1f4dd": ["\uD83D\uDCDD", ["memo", "pencil"]],
    "1f4de": ["\uD83D\uDCDE", ["telephone_receiver"]],
    "1f4df": ["\uD83D\uDCDF", ["pager"]],
    "1f4e0": ["\uD83D\uDCE0", ["fax"]],
    "1f4e1": ["\uD83D\uDCE1", ["satellite"]],
    "1f4e2": ["\uD83D\uDCE2", ["loudspeaker"]],
    "1f4e3": ["\uD83D\uDCE3", ["mega"]],
    "1f4e4": ["\uD83D\uDCE4", ["outbox_tray"]],
    "1f4e5": ["\uD83D\uDCE5", ["inbox_tray"]],
    "1f4e6": ["\uD83D\uDCE6", ["package"]],
    "1f4e7": ["\uD83D\uDCE7", ["e-mail"]],
    "1f4e8": ["\uD83D\uDCE8", ["incoming_envelope"]],
    "1f4e9": ["\uD83D\uDCE9", ["envelope_with_arrow"]],
    "1f4ea": ["\uD83D\uDCEA", ["mailbox_closed"]],
    "1f4eb": ["\uD83D\uDCEB", ["mailbox"]],
    "1f4ec": ["\uD83D\uDCEC", ["mailbox_with_mail"]],
    "1f4ed": ["\uD83D\uDCED", ["mailbox_with_no_mail"]],
    "1f4ee": ["\uD83D\uDCEE", ["postbox"]],
    "1f4ef": ["\uD83D\uDCEF", ["postal_horn"]],
    "1f4f0": ["\uD83D\uDCF0", ["newspaper"]],
    "1f4f1": ["\uD83D\uDCF1", ["iphone"]],
    "1f4f2": ["\uD83D\uDCF2", ["calling"]],
    "1f4f3": ["\uD83D\uDCF3", ["vibration_mode"]],
    "1f4f4": ["\uD83D\uDCF4", ["mobile_phone_off"]],
    "1f4f5": ["\uD83D\uDCF5", ["no_mobile_phones"]],
    "1f4f6": ["\uD83D\uDCF6", ["signal_strength"]],
    "1f4f7": ["\uD83D\uDCF7", ["camera"]],
    "1f4f9": ["\uD83D\uDCF9", ["video_camera"]],
    "1f4fa": ["\uD83D\uDCFA", ["tv"]],
    "1f4fb": ["\uD83D\uDCFB", ["radio"]],
    "1f4fc": ["\uD83D\uDCFC", ["vhs"]],
    "1f500": ["\uD83D\uDD00", ["twisted_rightwards_arrows"]],
    "1f501": ["\uD83D\uDD01", ["repeat"]],
    "1f502": ["\uD83D\uDD02", ["repeat_one"]],
    "1f503": ["\uD83D\uDD03", ["arrows_clockwise"]],
    "1f504": ["\uD83D\uDD04", ["arrows_counterclockwise"]],
    "1f505": ["\uD83D\uDD05", ["low_brightness"]],
    "1f506": ["\uD83D\uDD06", ["high_brightness"]],
    "1f507": ["\uD83D\uDD07", ["mute"]],
    "1f508": ["\uD83D\uDD09", ["speaker"]],
    "1f509": ["\uD83D\uDD09", ["sound"]],
    "1f50a": ["\uD83D\uDD0A", ["loud_sound"]],
    "1f50b": ["\uD83D\uDD0B", ["battery"]],
    "1f50c": ["\uD83D\uDD0C", ["electric_plug"]],
    "1f50d": ["\uD83D\uDD0D", ["mag"]],
    "1f50e": ["\uD83D\uDD0E", ["mag_right"]],
    "1f50f": ["\uD83D\uDD0F", ["lock_with_ink_pen"]],
    "1f510": ["\uD83D\uDD10", ["closed_lock_with_key"]],
    "1f511": ["\uD83D\uDD11", ["key"]],
    "1f512": ["\uD83D\uDD12", ["lock"]],
    "1f513": ["\uD83D\uDD13", ["unlock"]],
    "1f514": ["\uD83D\uDD14", ["bell"]],
    "1f515": ["\uD83D\uDD15", ["no_bell"]],
    "1f516": ["\uD83D\uDD16", ["bookmark"]],
    "1f517": ["\uD83D\uDD17", ["link"]],
    "1f518": ["\uD83D\uDD18", ["radio_button"]],
    "1f519": ["\uD83D\uDD19", ["back"]],
    "1f51a": ["\uD83D\uDD1A", ["end"]],
    "1f51b": ["\uD83D\uDD1B", ["on"]],
    "1f51c": ["\uD83D\uDD1C", ["soon"]],
    "1f51d": ["\uD83D\uDD1D", ["top"]],
    "1f51e": ["\uD83D\uDD1E", ["underage"]],
    "1f51f": ["\uD83D\uDD1F", ["keycap_ten"]],
    "1f520": ["\uD83D\uDD20", ["capital_abcd"]],
    "1f521": ["\uD83D\uDD21", ["abcd"]],
    "1f522": ["\uD83D\uDD22", ["1234"]],
    "1f523": ["\uD83D\uDD23", ["symbols"]],
    "1f524": ["\uD83D\uDD24", ["abc"]],
    "1f525": ["\uD83D\uDD25", ["fire"]],
    "1f526": ["\uD83D\uDD26", ["flashlight"]],
    "1f527": ["\uD83D\uDD27", ["wrench"]],
    "1f528": ["\uD83D\uDD28", ["hammer"]],
    "1f529": ["\uD83D\uDD29", ["nut_and_bolt"]],
    "1f52a": ["\uD83D\uDD2A", ["hocho"]],
    "1f52b": ["\uD83D\uDD2B", ["gun"]],
    "1f52c": ["\uD83D\uDD2C", ["microscope"]],
    "1f52d": ["\uD83D\uDD2D", ["telescope"]],
    "1f52e": ["\uD83D\uDD2E", ["crystal_ball"]],
    "1f52f": ["\uD83D\uDD2F", ["six_pointed_star"]],
    "1f530": ["\uD83D\uDD30", ["beginner"]],
    "1f531": ["\uD83D\uDD31", ["trident"]],
    "1f532": ["\uD83D\uDD32", ["black_square_button"]],
    "1f533": ["\uD83D\uDD33", ["white_square_button"]],
    "1f534": ["\uD83D\uDD34", ["red_circle"]],
    "1f535": ["\uD83D\uDD35", ["large_blue_circle"]],
    "1f536": ["\uD83D\uDD36", ["large_orange_diamond"]],
    "1f537": ["\uD83D\uDD37", ["large_blue_diamond"]],
    "1f538": ["\uD83D\uDD38", ["small_orange_diamond"]],
    "1f539": ["\uD83D\uDD39", ["small_blue_diamond"]],
    "1f53a": ["\uD83D\uDD3A", ["small_red_triangle"]],
    "1f53b": ["\uD83D\uDD3B", ["small_red_triangle_down"]],
    "1f53c": ["\uD83D\uDD3C", ["arrow_up_small"]],
    "1f53d": ["\uD83D\uDD3D", ["arrow_down_small"]],
    "1f550": ["\uD83D\uDD50", ["clock1"]],
    "1f551": ["\uD83D\uDD51", ["clock2"]],
    "1f552": ["\uD83D\uDD52", ["clock3"]],
    "1f553": ["\uD83D\uDD53", ["clock4"]],
    "1f554": ["\uD83D\uDD54", ["clock5"]],
    "1f555": ["\uD83D\uDD55", ["clock6"]],
    "1f556": ["\uD83D\uDD56", ["clock7"]],
    "1f557": ["\uD83D\uDD57", ["clock8"]],
    "1f558": ["\uD83D\uDD58", ["clock9"]],
    "1f559": ["\uD83D\uDD59", ["clock10"]],
    "1f55a": ["\uD83D\uDD5A", ["clock11"]],
    "1f55b": ["\uD83D\uDD5B", ["clock12"]],
    "1f55c": ["\uD83D\uDD5C", ["clock130"]],
    "1f55d": ["\uD83D\uDD5D", ["clock230"]],
    "1f55e": ["\uD83D\uDD5E", ["clock330"]],
    "1f55f": ["\uD83D\uDD5F", ["clock430"]],
    "1f560": ["\uD83D\uDD60", ["clock530"]],
    "1f561": ["\uD83D\uDD61", ["clock630"]],
    "1f562": ["\uD83D\uDD62", ["clock730"]],
    "1f563": ["\uD83D\uDD63", ["clock830"]],
    "1f564": ["\uD83D\uDD64", ["clock930"]],
    "1f565": ["\uD83D\uDD65", ["clock1030"]],
    "1f566": ["\uD83D\uDD66", ["clock1130"]],
    "1f567": ["\uD83D\uDD67", ["clock1230"]],
    "1f5fb": ["\uD83D\uDDFB", ["mount_fuji"]],
    "1f5fc": ["\uD83D\uDDFC", ["tokyo_tower"]],
    "1f5fd": ["\uD83D\uDDFD", ["statue_of_liberty"]],
    "1f5fe": ["\uD83D\uDDFE", ["japan"]],
    "1f5ff": ["\uD83D\uDDFF", ["moyai"]],
    "1f600": ["\uD83D\uDE00", ["grinning"]],
    "1f601": ["\uD83D\uDE01", ["grin"]],
    "1f602": ["\uD83D\uDE02", ["joy"]],
    "1f603": ["\uD83D\uDE03", ["smiley"], ":)"],
    "1f604": ["\uD83D\uDE04", ["smile"], ":)"],
    "1f605": ["\uD83D\uDE05", ["sweat_smile"]],
    "1f606": ["\uD83D\uDE06", ["satisfied"]],
    "1f607": ["\uD83D\uDE07", ["innocent"]],
    "1f608": ["\uD83D\uDE08", ["smiling_imp"]],
    "1f609": ["\uD83D\uDE09", ["wink"], ";)"],
    "1f60a": ["\uD83D\uDE0A", ["blush"]],
    "1f60b": ["\uD83D\uDE0B", ["yum"]],
    "1f60c": ["\uD83D\uDE0C", ["relieved"]],
    "1f60d": ["\uD83D\uDE0D", ["heart_eyes"]],
    "1f60e": ["\uD83D\uDE0E", ["sunglasses"]],
    "1f60f": ["\uD83D\uDE0F", ["smirk"]],
    "1f610": ["\uD83D\uDE10", ["neutral_face"]],
    "1f611": ["\uD83D\uDE11", ["expressionless"]],
    "1f612": ["\uD83D\uDE12", ["unamused"]],
    "1f613": ["\uD83D\uDE13", ["sweat"]],
    "1f614": ["\uD83D\uDE14", ["pensive"]],
    "1f615": ["\uD83D\uDE15", ["confused"]],
    "1f616": ["\uD83D\uDE16", ["confounded"]],
    "1f617": ["\uD83D\uDE17", ["kissing"]],
    "1f618": ["\uD83D\uDE18", ["kissing_heart"]],
    "1f619": ["\uD83D\uDE19", ["kissing_smiling_eyes"]],
    "1f61a": ["\uD83D\uDE1A", ["kissing_closed_eyes"]],
    "1f61b": ["\uD83D\uDE1B", ["stuck_out_tongue"]],
    "1f61c": ["\uD83D\uDE1C", ["stuck_out_tongue_winking_eye"], ";p"],
    "1f61d": ["\uD83D\uDE1D", ["stuck_out_tongue_closed_eyes"]],
    "1f61e": ["\uD83D\uDE1E", ["disappointed"], ":("],
    "1f61f": ["\uD83D\uDE1F", ["worried"]],
    "1f620": ["\uD83D\uDE20", ["angry"]],
    "1f621": ["\uD83D\uDE21", ["rage"]],
    "1f622": ["\uD83D\uDE22", ["cry"], ":'("],
    "1f623": ["\uD83D\uDE23", ["persevere"]],
    "1f624": ["\uD83D\uDE24", ["triumph"]],
    "1f625": ["\uD83D\uDE25", ["disappointed_relieved"]],
    "1f626": ["\uD83D\uDE26", ["frowning"]],
    "1f627": ["\uD83D\uDE27", ["anguished"]],
    "1f628": ["\uD83D\uDE28", ["fearful"]],
    "1f629": ["\uD83D\uDE29", ["weary"]],
    "1f62a": ["\uD83D\uDE2A", ["sleepy"]],
    "1f62b": ["\uD83D\uDE2B", ["tired_face"]],
    "1f62c": ["\uD83D\uDE2C", ["grimacing"]],
    "1f62d": ["\uD83D\uDE2D", ["sob"], ":'("],
    "1f62e": ["\uD83D\uDE2E", ["open_mouth"]],
    "1f62f": ["\uD83D\uDE2F", ["hushed"]],
    "1f630": ["\uD83D\uDE30", ["cold_sweat"]],
    "1f631": ["\uD83D\uDE31", ["scream"]],
    "1f632": ["\uD83D\uDE32", ["astonished"]],
    "1f633": ["\uD83D\uDE33", ["flushed"]],
    "1f634": ["\uD83D\uDE34", ["sleeping"]],
    "1f635": ["\uD83D\uDE35", ["dizzy_face"]],
    "1f636": ["\uD83D\uDE36", ["no_mouth"]],
    "1f637": ["\uD83D\uDE37", ["mask"]],
    "1f638": ["\uD83D\uDE38", ["smile_cat"]],
    "1f639": ["\uD83D\uDE39", ["joy_cat"]],
    "1f63a": ["\uD83D\uDE3A", ["smiley_cat"]],
    "1f63b": ["\uD83D\uDE3B", ["heart_eyes_cat"]],
    "1f63c": ["\uD83D\uDE3C", ["smirk_cat"]],
    "1f63d": ["\uD83D\uDE3D", ["kissing_cat"]],
    "1f63e": ["\uD83D\uDE3E", ["pouting_cat"]],
    "1f63f": ["\uD83D\uDE3F", ["crying_cat_face"]],
    "1f640": ["\uD83D\uDE40", ["scream_cat"]],
    "1f645": ["\uD83D\uDE45", ["no_good"]],
    "1f646": ["\uD83D\uDE46", ["ok_woman"]],
    "1f647": ["\uD83D\uDE47", ["bow"]],
    "1f648": ["\uD83D\uDE48", ["see_no_evil"]],
    "1f649": ["\uD83D\uDE49", ["hear_no_evil"]],
    "1f64a": ["\uD83D\uDE4A", ["speak_no_evil"]],
    "1f64b": ["\uD83D\uDE4B", ["raising_hand"]],
    "1f64c": ["\uD83D\uDE4C", ["raised_hands"]],
    "1f64d": ["\uD83D\uDE4D", ["person_frowning"]],
    "1f64e": ["\uD83D\uDE4E", ["person_with_pouting_face"]],
    "1f64f": ["\uD83D\uDE4F", ["pray"]],
    "1f680": ["\uD83D\uDE80", ["rocket"]],
    "1f681": ["\uD83D\uDE81", ["helicopter"]],
    "1f682": ["\uD83D\uDE82", ["steam_locomotive"]],
    "1f683": ["\uD83D\uDE83", ["railway_car"]],
    "1f68b": ["\uD83D\uDE8B", ["train"]],
    "1f684": ["\uD83D\uDE84", ["bullettrain_side"]],
    "1f685": ["\uD83D\uDE85", ["bullettrain_front"]],
    "1f686": ["\uD83D\uDE86", ["train2"]],
    "1f687": ["\uD83D\uDE87", ["metro"]],
    "1f688": ["\uD83D\uDE88", ["light_rail"]],
    "1f689": ["\uD83D\uDE89", ["station"]],
    "1f68a": ["\uD83D\uDE8A", ["tram"]],
    "1f68c": ["\uD83D\uDE8C", ["bus"]],
    "1f68d": ["\uD83D\uDE8D", ["oncoming_bus"]],
    "1f68e": ["\uD83D\uDE8E", ["trolleybus"]],
    "1f68f": ["\uD83D\uDE8F", ["busstop"]],
    "1f690": ["\uD83D\uDE90", ["minibus"]],
    "1f691": ["\uD83D\uDE91", ["ambulance"]],
    "1f692": ["\uD83D\uDE92", ["fire_engine"]],
    "1f693": ["\uD83D\uDE93", ["police_car"]],
    "1f694": ["\uD83D\uDE94", ["oncoming_police_car"]],
    "1f695": ["\uD83D\uDE95", ["taxi"]],
    "1f696": ["\uD83D\uDE96", ["oncoming_taxi"]],
    "1f697": ["\uD83D\uDE97", ["car", "red_car"]],
    "1f698": ["\uD83D\uDE98", ["oncoming_automobile"]],
    "1f699": ["\uD83D\uDE99", ["blue_car"]],
    "1f69a": ["\uD83D\uDE9A", ["truck"]],
    "1f69b": ["\uD83D\uDE9B", ["articulated_lorry"]],
    "1f69c": ["\uD83D\uDE9C", ["tractor"]],
    "1f69d": ["\uD83D\uDE9D", ["monorail"]],
    "1f69e": ["\uD83D\uDE9E", ["mountain_railway"]],
    "1f69f": ["\uD83D\uDE9F", ["suspension_railway"]],
    "1f6a0": ["\uD83D\uDEA0", ["mountain_cableway"]],
    "1f6a1": ["\uD83D\uDEA1", ["aerial_tramway"]],
    "1f6a2": ["\uD83D\uDEA2", ["ship"]],
    "1f6a3": ["\uD83D\uDEA3", ["rowboat"]],
    "1f6a4": ["\uD83D\uDEA4", ["speedboat"]],
    "1f6a5": ["\uD83D\uDEA5", ["traffic_light"]],
    "1f6a6": ["\uD83D\uDEA6", ["vertical_traffic_light"]],
    "1f6a7": ["\uD83D\uDEA7", ["construction"]],
    "1f6a8": ["\uD83D\uDEA8", ["rotating_light"]],
    "1f6a9": ["\uD83D\uDEA9", ["triangular_flag_on_post"]],
    "1f6aa": ["\uD83D\uDEAA", ["door"]],
    "1f6ab": ["\uD83D\uDEAB", ["no_entry_sign"]],
    "1f6ac": ["\uD83D\uDEAC", ["smoking"]],
    "1f6ad": ["\uD83D\uDEAD", ["no_smoking"]],
    "1f6ae": ["\uD83D\uDEAE", ["put_litter_in_its_place"]],
    "1f6af": ["\uD83D\uDEAF", ["do_not_litter"]],
    "1f6b0": ["\uD83D\uDEB0", ["potable_water"]],
    "1f6b1": ["\uD83D\uDEB1", ["non-potable_water"]],
    "1f6b2": ["\uD83D\uDEB2", ["bike"]],
    "1f6b3": ["\uD83D\uDEB3", ["no_bicycles"]],
    "1f6b4": ["\uD83D\uDEB4", ["bicyclist"]],
    "1f6b5": ["\uD83D\uDEB5", ["mountain_bicyclist"]],
    "1f6b6": ["\uD83D\uDEB6", ["walking"]],
    "1f6b7": ["\uD83D\uDEB7", ["no_pedestrians"]],
    "1f6b8": ["\uD83D\uDEB8", ["children_crossing"]],
    "1f6b9": ["\uD83D\uDEB9", ["mens"]],
    "1f6ba": ["\uD83D\uDEBA", ["womens"]],
    "1f6bb": ["\uD83D\uDEBB", ["restroom"]],
    "1f6bc": ["\uD83D\uDEBC", ["baby_symbol"]],
    "1f6bd": ["\uD83D\uDEBD", ["toilet"]],
    "1f6be": ["\uD83D\uDEBE", ["wc"]],
    "1f6bf": ["\uD83D\uDEBF", ["shower"]],
    "1f6c0": ["\uD83D\uDEC0", ["bath"]],
    "1f6c1": ["\uD83D\uDEC1", ["bathtub"]],
    "1f6c2": ["\uD83D\uDEC2", ["passport_control"]],
    "1f6c3": ["\uD83D\uDEC3", ["customs"]],
    "1f6c4": ["\uD83D\uDEC4", ["baggage_claim"]],
    "1f6c5": ["\uD83D\uDEC5", ["left_luggage"]],
    "0023": ["\u0023\u20E3", ["hash"]],
    "0030": ["\u0030\u20E3", ["zero"]],
    "0031": ["\u0031\u20E3", ["one"]],
    "0032": ["\u0032\u20E3", ["two"]],
    "0033": ["\u0033\u20E3", ["three"]],
    "0034": ["\u0034\u20E3", ["four"]],
    "0035": ["\u0035\u20E3", ["five"]],
    "0036": ["\u0036\u20E3", ["six"]],
    "0037": ["\u0037\u20E3", ["seven"]],
    "0038": ["\u0038\u20E3", ["eight"]],
    "0039": ["\u0039\u20E3", ["nine"]],
    "1f1e8-1f1f3": ["\uD83C\uDDE8\uD83C\uDDF3", ["cn"]],
    "1f1e9-1f1ea": ["\uD83C\uDDE9\uD83C\uDDEA", ["de"]],
    "1f1ea-1f1f8": ["\uD83C\uDDEA\uD83C\uDDF8", ["es"]],
    "1f1eb-1f1f7": ["\uD83C\uDDEB\uD83C\uDDF7", ["fr"]],
    "1f1ec-1f1e7": ["\uD83C\uDDEC\uD83C\uDDE7", ["gb", "uk"]],
    "1f1ee-1f1f9": ["\uD83C\uDDEE\uD83C\uDDF9", ["it"]],
    "1f1ef-1f1f5": ["\uD83C\uDDEF\uD83C\uDDF5", ["jp"]],
    "1f1f0-1f1f7": ["\uD83C\uDDF0\uD83C\uDDF7", ["kr"]],
    "1f1f7-1f1fa": ["\uD83C\uDDF7\uD83C\uDDFA", ["ru"]],
    "1f1fa-1f1f8": ["\uD83C\uDDFA\uD83C\uDDF8", ["us"]]
}

Config.EmojiCategories = [
    ["1f604", "1f603", "1f600", "1f60a", "263a", "1f609", "1f60d", "1f618", "1f61a", "1f617", "1f619", "1f61c", "1f61d", "1f61b", "1f633", "1f601", "1f614", "1f60c", "1f612", "1f61e", "1f623", "1f622", "1f602", "1f62d", "1f62a", "1f625", "1f630", "1f605", "1f613", "1f629", "1f62b", "1f628", "1f631", "1f620", "1f621", "1f624", "1f616", "1f606", "1f60b", "1f637", "1f60e", "1f634", "1f635", "1f632", "1f61f", "1f626", "1f627", "1f608", "1f47f", "1f62e", "1f62c", "1f610", "1f615", "1f62f", "1f636", "1f607", "1f60f", "1f611", "1f472", "1f473", "1f46e", "1f477", "1f482", "1f476", "1f466", "1f467", "1f468", "1f469", "1f474", "1f475", "1f471", "1f47c", "1f478", "1f63a", "1f638", "1f63b", "1f63d", "1f63c", "1f640", "1f63f", "1f639", "1f63e", "1f479", "1f47a", "1f648", "1f649", "1f64a", "1f480", "1f47d", "1f4a9", "1f525", "2728", "1f31f", "1f4ab", "1f4a5", "1f4a2", "1f4a6", "1f4a7", "1f4a4", "1f4a8", "1f442", "1f440", "1f443", "1f445", "1f444", "1f44d", "1f44e", "1f44c", "1f44a", "270a", "270c", "1f44b", "270b", "1f450", "1f446", "1f447", "1f449", "1f448", "1f64c", "1f64f", "261d", "1f44f", "1f4aa", "1f6b6", "1f3c3", "1f483", "1f46b", "1f46a", "1f46c", "1f46d", "1f48f", "1f491", "1f46f", "1f646", "1f645", "1f481", "1f64b", "1f486", "1f487", "1f485", "1f470", "1f64e", "1f64d", "1f647", "1f3a9", "1f451", "1f452", "1f45f", "1f45e", "1f461", "1f460", "1f462", "1f455", "1f454", "1f45a", "1f457", "1f3bd", "1f456", "1f458", "1f459", "1f4bc", "1f45c", "1f45d", "1f45b", "1f453", "1f380", "1f302", "1f484", "1f49b", "1f499", "1f49c", "1f49a", "2764", "1f494", "1f497", "1f493", "1f495", "1f496", "1f49e", "1f498", "1f48c", "1f48b", "1f48d", "1f48e", "1f464", "1f465", "1f4ac", "1f463", "1f4ad"],
    ["1f436", "1f43a", "1f431", "1f42d", "1f439", "1f430", "1f438", "1f42f", "1f428", "1f43b", "1f437", "1f43d", "1f42e", "1f417", "1f435", "1f412", "1f434", "1f411", "1f418", "1f43c", "1f427", "1f426", "1f424", "1f425", "1f423", "1f414", "1f40d", "1f422", "1f41b", "1f41d", "1f41c", "1f41e", "1f40c", "1f419", "1f41a", "1f420", "1f41f", "1f42c", "1f433", "1f40b", "1f404", "1f40f", "1f400", "1f403", "1f405", "1f407", "1f409", "1f40e", "1f410", "1f413", "1f415", "1f416", "1f401", "1f402", "1f432", "1f421", "1f40a", "1f42b", "1f42a", "1f406", "1f408", "1f429", "1f43e", "1f490", "1f338", "1f337", "1f340", "1f339", "1f33b", "1f33a", "1f341", "1f343", "1f342", "1f33f", "1f33e", "1f344", "1f335", "1f334", "1f332", "1f333", "1f330", "1f331", "1f33c", "1f310", "1f31e", "1f31d", "1f31a", "1f311", "1f312", "1f313", "1f314", "1f315", "1f316", "1f317", "1f318", "1f31c", "1f31b", "1f319", "1f30d", "1f30e", "1f30f", "1f30b", "1f30c", "1f320", "2b50", "2600", "26c5", "2601", "26a1", "2614", "2744", "26c4", "1f300", "1f301", "1f308", "1f30a"],
    ["1f38d", "1f49d", "1f38e", "1f392", "1f393", "1f38f", "1f386", "1f387", "1f390", "1f391", "1f383", "1f47b", "1f385", "1f384", "1f381", "1f38b", "1f389", "1f38a", "1f388", "1f38c", "1f52e", "1f3a5", "1f4f7", "1f4f9", "1f4fc", "1f4bf", "1f4c0", "1f4bd", "1f4be", "1f4bb", "1f4f1", "260e", "1f4de", "1f4df", "1f4e0", "1f4e1", "1f4fa", "1f4fb", "1f50a", "1f509", "1f508", "1f507", "1f514", "1f515", "1f4e3", "1f4e2", "23f3", "231b", "23f0", "231a", "1f513", "1f512", "1f50f", "1f510", "1f511", "1f50e", "1f4a1", "1f526", "1f506", "1f505", "1f50c", "1f50b", "1f50d", "1f6c0", "1f6c1", "1f6bf", "1f6bd", "1f527", "1f529", "1f528", "1f6aa", "1f6ac", "1f4a3", "1f52b", "1f52a", "1f48a", "1f489", "1f4b0", "1f4b4", "1f4b5", "1f4b7", "1f4b6", "1f4b3", "1f4b8", "1f4f2", "1f4e7", "1f4e5", "1f4e4", "2709", "1f4e9", "1f4e8", "1f4ef", "1f4eb", "1f4ea", "1f4ec", "1f4ed", "1f4ee", "1f4e6", "1f4dd", "1f4c4", "1f4c3", "1f4d1", "1f4ca", "1f4c8", "1f4c9", "1f4dc", "1f4cb", "1f4c5", "1f4c6", "1f4c7", "1f4c1", "1f4c2", "2702", "1f4cc", "1f4ce", "2712", "270f", "1f4cf", "1f4d0", "1f4d5", "1f4d7", "1f4d8", "1f4d9", "1f4d3", "1f4d4", "1f4d2", "1f4da", "1f4d6", "1f516", "1f4db", "1f52c", "1f52d", "1f4f0", "1f3a8", "1f3ac", "1f3a4", "1f3a7", "1f3bc", "1f3b5", "1f3b6", "1f3b9", "1f3bb", "1f3ba", "1f3b7", "1f3b8", "1f47e", "1f3ae", "1f0cf", "1f3b4", "1f004", "1f3b2", "1f3af", "1f3c8", "1f3c0", "26bd", "26be", "1f3be", "1f3b1", "1f3c9", "1f3b3", "26f3", "1f6b5", "1f6b4", "1f3c1", "1f3c7", "1f3c6", "1f3bf", "1f3c2", "1f3ca", "1f3c4", "1f3a3", "2615", "1f375", "1f376", "1f37c", "1f37a", "1f37b", "1f378", "1f379", "1f377", "1f374", "1f355", "1f354", "1f35f", "1f357", "1f356", "1f35d", "1f35b", "1f364", "1f371", "1f363", "1f365", "1f359", "1f358", "1f35a", "1f35c", "1f372", "1f362", "1f361", "1f373", "1f35e", "1f369", "1f36e", "1f366", "1f368", "1f367", "1f382", "1f370", "1f36a", "1f36b", "1f36c", "1f36d", "1f36f", "1f34e", "1f34f", "1f34a", "1f34b", "1f352", "1f347", "1f349", "1f353", "1f351", "1f348", "1f34c", "1f350", "1f34d", "1f360", "1f346", "1f345", "1f33d"],
    ["1f3e0", "1f3e1", "1f3eb", "1f3e2", "1f3e3", "1f3e5", "1f3e6", "1f3ea", "1f3e9", "1f3e8", "1f492", "26ea", "1f3ec", "1f3e4", "1f307", "1f306", "1f3ef", "1f3f0", "26fa", "1f3ed", "1f5fc", "1f5fe", "1f5fb", "1f304", "1f305", "1f303", "1f5fd", "1f309", "1f3a0", "1f3a1", "26f2", "1f3a2", "1f6a2", "26f5", "1f6a4", "1f6a3", "2693", "1f680", "2708", "1f4ba", "1f681", "1f682", "1f68a", "1f689", "1f69e", "1f686", "1f684", "1f685", "1f688", "1f687", "1f69d", "1f683", "1f68b", "1f68e", "1f68c", "1f68d", "1f699", "1f698", "1f697", "1f695", "1f696", "1f69b", "1f69a", "1f6a8", "1f693", "1f694", "1f692", "1f691", "1f690", "1f6b2", "1f6a1", "1f69f", "1f6a0", "1f69c", "1f488", "1f68f", "1f3ab", "1f6a6", "1f6a5", "26a0", "1f6a7", "1f530", "26fd", "1f3ee", "1f3b0", "2668", "1f5ff", "1f3aa", "1f3ad", "1f4cd", "1f6a9", "1f1ef-1f1f5", "1f1f0-1f1f7", "1f1e9-1f1ea", "1f1e8-1f1f3", "1f1fa-1f1f8", "1f1eb-1f1f7", "1f1ea-1f1f8", "1f1ee-1f1f9", "1f1f7-1f1fa", "1f1ec-1f1e7"],
    ["0031", "0032", "0033", "0034", "0035", "0036", "0037", "0038", "0039", "0030", "1f51f", "1f522", "0023", "1f523", "2b06", "2b07", "2b05", "27a1", "1f520", "1f521", "1f524", "2197", "2196", "2198", "2199", "2194", "2195", "1f504", "25c0", "25b6", "1f53c", "1f53d", "21a9", "21aa", "2139", "23ea", "23e9", "23eb", "23ec", "2935", "2934", "1f197", "1f500", "1f501", "1f502", "1f195", "1f199", "1f192", "1f193", "1f196", "1f4f6", "1f3a6", "1f201", "1f22f", "1f233", "1f235", "1f234", "1f232", "1f250", "1f239", "1f23a", "1f236", "1f21a", "1f6bb", "1f6b9", "1f6ba", "1f6bc", "1f6be", "1f6b0", "1f6ae", "1f17f", "267f", "1f6ad", "1f237", "1f238", "1f202", "24c2", "1f6c2", "1f6c4", "1f6c5", "1f6c3", "1f251", "3299", "3297", "1f191", "1f198", "1f194", "1f6ab", "1f51e", "1f4f5", "1f6af", "1f6b1", "1f6b3", "1f6b7", "1f6b8", "26d4", "2733", "2747", "274e", "2705", "2734", "1f49f", "1f19a", "1f4f3", "1f4f4", "1f170", "1f171", "1f18e", "1f17e", "1f4a0", "27bf", "267b", "2648", "2649", "264a", "264b", "264c", "264d", "264e", "264f", "2650", "2651", "2652", "2653", "26ce", "1f52f", "1f3e7", "1f4b9", "1f4b2", "1f4b1", "00a9", "00ae", "2122", "274c", "203c", "2049", "2757", "2753", "2755", "2754", "2b55", "1f51d", "1f51a", "1f519", "1f51b", "1f51c", "1f503", "1f55b", "1f567", "1f550", "1f55c", "1f551", "1f55d", "1f552", "1f55e", "1f553", "1f55f", "1f554", "1f560", "1f555", "1f556", "1f557", "1f558", "1f559", "1f55a", "1f561", "1f562", "1f563", "1f564", "1f565", "1f566", "2716", "2795", "2796", "2797", "2660", "2665", "2663", "2666", "1f4ae", "1f4af", "2714", "2611", "1f518", "1f517", "27b0", "3030", "303d", "1f531", "25fc", "25fb", "25fe", "25fd", "25aa", "25ab", "1f53a", "1f532", "1f533", "26ab", "26aa", "1f534", "1f535", "1f53b", "2b1c", "2b1b", "1f536", "1f537", "1f538", "1f539"]
];



Config.EmojiCategorySpritesheetDimens = [
    [7, 27],
    [4, 29],
    [7, 33],
    [3, 34],
    [7, 34]
];


Config.emoji_data = {
    "00a9": [
        ["\u00A9"], "\uE24E", "\uDBBA\uDF29", ["copyright"], 0, 0
    ],
    "00ae": [
        ["\u00AE"], "\uE24F", "\uDBBA\uDF2D", ["registered"], 0, 1
    ],
    "203c": [
        ["\u203C\uFE0F", "\u203C"], "", "\uDBBA\uDF06", ["bangbang"], 0, 2
    ],
    "2049": [
        ["\u2049\uFE0F", "\u2049"], "", "\uDBBA\uDF05", ["interrobang"], 0, 3
    ],
    "2122": [
        ["\u2122"], "\uE537", "\uDBBA\uDF2A", ["tm"], 0, 4
    ],
    "2139": [
        ["\u2139\uFE0F", "\u2139"], "", "\uDBBA\uDF47", ["information_source"], 0, 5
    ],
    "2194": [
        ["\u2194\uFE0F", "\u2194"], "", "\uDBBA\uDEF6", ["left_right_arrow"], 0, 6
    ],
    "2195": [
        ["\u2195\uFE0F", "\u2195"], "", "\uDBBA\uDEF7", ["arrow_up_down"], 0, 7
    ],
    "2196": [
        ["\u2196\uFE0F", "\u2196"], "\uE237", "\uDBBA\uDEF2", ["arrow_upper_left"], 0, 8
    ],
    "2197": [
        ["\u2197\uFE0F", "\u2197"], "\uE236", "\uDBBA\uDEF0", ["arrow_upper_right"], 0, 9
    ],
    "2198": [
        ["\u2198\uFE0F", "\u2198"], "\uE238", "\uDBBA\uDEF1", ["arrow_lower_right"], 0, 10
    ],
    "2199": [
        ["\u2199\uFE0F", "\u2199"], "\uE239", "\uDBBA\uDEF3", ["arrow_lower_left"], 0, 11
    ],
    "21a9": [
        ["\u21A9\uFE0F", "\u21A9"], "", "\uDBBA\uDF83", ["leftwards_arrow_with_hook"], 0, 12
    ],
    "21aa": [
        ["\u21AA\uFE0F", "\u21AA"], "", "\uDBBA\uDF88", ["arrow_right_hook"], 0, 13
    ],
    "231a": [
        ["\u231A\uFE0F", "\u231A"], "", "\uDBB8\uDC1D", ["watch"], 0, 14
    ],
    "231b": [
        ["\u231B\uFE0F", "\u231B"], "", "\uDBB8\uDC1C", ["hourglass"], 0, 15
    ],
    "23e9": [
        ["\u23E9"], "\uE23C", "\uDBBA\uDEFE", ["fast_forward"], 0, 16
    ],
    "23ea": [
        ["\u23EA"], "\uE23D", "\uDBBA\uDEFF", ["rewind"], 0, 17
    ],
    "23eb": [
        ["\u23EB"], "", "\uDBBA\uDF03", ["arrow_double_up"], 0, 18
    ],
    "23ec": [
        ["\u23EC"], "", "\uDBBA\uDF02", ["arrow_double_down"], 0, 19
    ],
    "23f0": [
        ["\u23F0"], "\uE02D", "\uDBB8\uDC2A", ["alarm_clock"], 0, 20
    ],
    "23f3": [
        ["\u23F3"], "", "\uDBB8\uDC1B", ["hourglass_flowing_sand"], 0, 21
    ],
    "24c2": [
        ["\u24C2\uFE0F", "\u24C2"], "\uE434", "\uDBB9\uDFE1", ["m"], 0, 22
    ],
    "25aa": [
        ["\u25AA\uFE0F", "\u25AA"], "\uE21A", "\uDBBA\uDF6E", ["black_small_square"], 0, 23
    ],
    "25ab": [
        ["\u25AB\uFE0F", "\u25AB"], "\uE21B", "\uDBBA\uDF6D", ["white_small_square"], 0, 24
    ],
    "25b6": [
        ["\u25B6\uFE0F", "\u25B6"], "\uE23A", "\uDBBA\uDEFC", ["arrow_forward"], 0, 25
    ],
    "25c0": [
        ["\u25C0\uFE0F", "\u25C0"], "\uE23B", "\uDBBA\uDEFD", ["arrow_backward"], 0, 26
    ],
    "25fb": [
        ["\u25FB\uFE0F", "\u25FB"], "\uE21B", "\uDBBA\uDF71", ["white_medium_square"], 0, 27
    ],
    "25fc": [
        ["\u25FC\uFE0F", "\u25FC"], "\uE21A", "\uDBBA\uDF72", ["black_medium_square"], 0, 28
    ],
    "25fd": [
        ["\u25FD\uFE0F", "\u25FD"], "\uE21B", "\uDBBA\uDF6F", ["white_medium_small_square"], 0, 29
    ],
    "25fe": [
        ["\u25FE\uFE0F", "\u25FE"], "\uE21A", "\uDBBA\uDF70", ["black_medium_small_square"], 1, 0
    ],
    "2600": [
        ["\u2600\uFE0F", "\u2600"], "\uE04A", "\uDBB8\uDC00", ["sunny"], 1, 1
    ],
    "2601": [
        ["\u2601\uFE0F", "\u2601"], "\uE049", "\uDBB8\uDC01", ["cloud"], 1, 2
    ],
    "260e": [
        ["\u260E\uFE0F", "\u260E"], "\uE009", "\uDBB9\uDD23", ["phone", "telephone"], 1, 3
    ],
    "2611": [
        ["\u2611\uFE0F", "\u2611"], "", "\uDBBA\uDF8B", ["ballot_box_with_check"], 1, 4
    ],
    "2614": [
        ["\u2614\uFE0F", "\u2614"], "\uE04B", "\uDBB8\uDC02", ["umbrella"], 1, 5
    ],
    "2615": [
        ["\u2615\uFE0F", "\u2615"], "\uE045", "\uDBBA\uDD81", ["coffee"], 1, 6
    ],
    "261d": [
        ["\u261D\uFE0F", "\u261D"], "\uE00F", "\uDBBA\uDF98", ["point_up"], 1, 7
    ],
    "263a": [
        ["\u263A\uFE0F", "\u263A"], "\uE414", "\uDBB8\uDF36", ["relaxed"], 1, 8
    ],
    "2648": [
        ["\u2648\uFE0F", "\u2648"], "\uE23F", "\uDBB8\uDC2B", ["aries"], 1, 9
    ],
    "2649": [
        ["\u2649\uFE0F", "\u2649"], "\uE240", "\uDBB8\uDC2C", ["taurus"], 1, 10
    ],
    "264a": [
        ["\u264A\uFE0F", "\u264A"], "\uE241", "\uDBB8\uDC2D", ["gemini"], 1, 11
    ],
    "264b": [
        ["\u264B\uFE0F", "\u264B"], "\uE242", "\uDBB8\uDC2E", ["cancer"], 1, 12
    ],
    "264c": [
        ["\u264C\uFE0F", "\u264C"], "\uE243", "\uDBB8\uDC2F", ["leo"], 1, 13
    ],
    "264d": [
        ["\u264D\uFE0F", "\u264D"], "\uE244", "\uDBB8\uDC30", ["virgo"], 1, 14
    ],
    "264e": [
        ["\u264E\uFE0F", "\u264E"], "\uE245", "\uDBB8\uDC31", ["libra"], 1, 15
    ],
    "264f": [
        ["\u264F\uFE0F", "\u264F"], "\uE246", "\uDBB8\uDC32", ["scorpius"], 1, 16
    ],
    "2650": [
        ["\u2650\uFE0F", "\u2650"], "\uE247", "\uDBB8\uDC33", ["sagittarius"], 1, 17
    ],
    "2651": [
        ["\u2651\uFE0F", "\u2651"], "\uE248", "\uDBB8\uDC34", ["capricorn"], 1, 18
    ],
    "2652": [
        ["\u2652\uFE0F", "\u2652"], "\uE249", "\uDBB8\uDC35", ["aquarius"], 1, 19
    ],
    "2653": [
        ["\u2653\uFE0F", "\u2653"], "\uE24A", "\uDBB8\uDC36", ["pisces"], 1, 20
    ],
    "2660": [
        ["\u2660\uFE0F", "\u2660"], "\uE20E", "\uDBBA\uDF1B", ["spades"], 1, 21
    ],
    "2663": [
        ["\u2663\uFE0F", "\u2663"], "\uE20F", "\uDBBA\uDF1D", ["clubs"], 1, 22
    ],
    "2665": [
        ["\u2665\uFE0F", "\u2665"], "\uE20C", "\uDBBA\uDF1A", ["hearts"], 1, 23
    ],
    "2666": [
        ["\u2666\uFE0F", "\u2666"], "\uE20D", "\uDBBA\uDF1C", ["diamonds"], 1, 24
    ],
    "2668": [
        ["\u2668\uFE0F", "\u2668"], "\uE123", "\uDBB9\uDFFA", ["hotsprings"], 1, 25
    ],
    "267b": [
        ["\u267B\uFE0F", "\u267B"], "", "\uDBBA\uDF2C", ["recycle"], 1, 26
    ],
    "267f": [
        ["\u267F\uFE0F", "\u267F"], "\uE20A", "\uDBBA\uDF20", ["wheelchair"], 1, 27
    ],
    "2693": [
        ["\u2693\uFE0F", "\u2693"], "\uE202", "\uDBB9\uDCC1", ["anchor"], 1, 28
    ],
    "26a0": [
        ["\u26A0\uFE0F", "\u26A0"], "\uE252", "\uDBBA\uDF23", ["warning"], 1, 29
    ],
    "26a1": [
        ["\u26A1\uFE0F", "\u26A1"], "\uE13D", "\uDBB8\uDC04", ["zap"], 2, 0
    ],
    "26aa": [
        ["\u26AA\uFE0F", "\u26AA"], "\uE219", "\uDBBA\uDF65", ["white_circle"], 2, 1
    ],
    "26ab": [
        ["\u26AB\uFE0F", "\u26AB"], "\uE219", "\uDBBA\uDF66", ["black_circle"], 2, 2
    ],
    "26bd": [
        ["\u26BD\uFE0F", "\u26BD"], "\uE018", "\uDBB9\uDFD4", ["soccer"], 2, 3
    ],
    "26be": [
        ["\u26BE\uFE0F", "\u26BE"], "\uE016", "\uDBB9\uDFD1", ["baseball"], 2, 4
    ],
    "26c4": [
        ["\u26C4\uFE0F", "\u26C4"], "\uE048", "\uDBB8\uDC03", ["snowman"], 2, 5
    ],
    "26c5": [
        ["\u26C5\uFE0F", "\u26C5"], "\uE04A\uE049", "\uDBB8\uDC0F", ["partly_sunny"], 2, 6
    ],
    "26ce": [
        ["\u26CE"], "\uE24B", "\uDBB8\uDC37", ["ophiuchus"], 2, 7
    ],
    "26d4": [
        ["\u26D4\uFE0F", "\u26D4"], "\uE137", "\uDBBA\uDF26", ["no_entry"], 2, 8
    ],
    "26ea": [
        ["\u26EA\uFE0F", "\u26EA"], "\uE037", "\uDBB9\uDCBB", ["church"], 2, 9
    ],
    "26f2": [
        ["\u26F2\uFE0F", "\u26F2"], "\uE121", "\uDBB9\uDCBC", ["fountain"], 2, 10
    ],
    "26f3": [
        ["\u26F3\uFE0F", "\u26F3"], "\uE014", "\uDBB9\uDFD2", ["golf"], 2, 11
    ],
    "26f5": [
        ["\u26F5\uFE0F", "\u26F5"], "\uE01C", "\uDBB9\uDFEA", ["boat", "sailboat"], 2, 12
    ],
    "26fa": [
        ["\u26FA\uFE0F", "\u26FA"], "\uE122", "\uDBB9\uDFFB", ["tent"], 2, 13
    ],
    "26fd": [
        ["\u26FD\uFE0F", "\u26FD"], "\uE03A", "\uDBB9\uDFF5", ["fuelpump"], 2, 14
    ],
    "2702": [
        ["\u2702\uFE0F", "\u2702"], "\uE313", "\uDBB9\uDD3E", ["scissors"], 2, 15
    ],
    "2705": [
        ["\u2705"], "", "\uDBBA\uDF4A", ["white_check_mark"], 2, 16
    ],
    "2708": [
        ["\u2708\uFE0F", "\u2708"], "\uE01D", "\uDBB9\uDFE9", ["airplane"], 2, 17
    ],
    "2709": [
        ["\u2709\uFE0F", "\u2709"], "\uE103", "\uDBB9\uDD29", ["email", "envelope"], 2, 18
    ],
    "270a": [
        ["\u270A"], "\uE010", "\uDBBA\uDF93", ["fist"], 2, 19
    ],
    "270b": [
        ["\u270B"], "\uE012", "\uDBBA\uDF95", ["hand", "raised_hand"], 2, 20
    ],
    "270c": [
        ["\u270C\uFE0F", "\u270C"], "\uE011", "\uDBBA\uDF94", ["v"], 2, 21
    ],
    "270f": [
        ["\u270F\uFE0F", "\u270F"], "\uE301", "\uDBB9\uDD39", ["pencil2"], 2, 22
    ],
    "2712": [
        ["\u2712\uFE0F", "\u2712"], "", "\uDBB9\uDD36", ["black_nib"], 2, 23
    ],
    "2714": [
        ["\u2714\uFE0F", "\u2714"], "", "\uDBBA\uDF49", ["heavy_check_mark"], 2, 24
    ],
    "2716": [
        ["\u2716\uFE0F", "\u2716"], "\uE333", "\uDBBA\uDF53", ["heavy_multiplication_x"], 2, 25
    ],
    "2728": [
        ["\u2728"], "\uE32E", "\uDBBA\uDF60", ["sparkles"], 2, 26
    ],
    "2733": [
        ["\u2733\uFE0F", "\u2733"], "\uE206", "\uDBBA\uDF62", ["eight_spoked_asterisk"], 2, 27
    ],
    "2734": [
        ["\u2734\uFE0F", "\u2734"], "\uE205", "\uDBBA\uDF61", ["eight_pointed_black_star"], 2, 28
    ],
    "2744": [
        ["\u2744\uFE0F", "\u2744"], "", "\uDBB8\uDC0E", ["snowflake"], 2, 29
    ],
    "2747": [
        ["\u2747\uFE0F", "\u2747"], "\uE32E", "\uDBBA\uDF77", ["sparkle"], 3, 0
    ],
    "274c": [
        ["\u274C"], "\uE333", "\uDBBA\uDF45", ["x"], 3, 1
    ],
    "274e": [
        ["\u274E"], "\uE333", "\uDBBA\uDF46", ["negative_squared_cross_mark"], 3, 2
    ],
    "2753": [
        ["\u2753"], "\uE020", "\uDBBA\uDF09", ["question"], 3, 3
    ],
    "2754": [
        ["\u2754"], "\uE336", "\uDBBA\uDF0A", ["grey_question"], 3, 4
    ],
    "2755": [
        ["\u2755"], "\uE337", "\uDBBA\uDF0B", ["grey_exclamation"], 3, 5
    ],
    "2757": [
        ["\u2757\uFE0F", "\u2757"], "\uE021", "\uDBBA\uDF04", ["exclamation", "heavy_exclamation_mark"], 3, 6
    ],
    "2764": [
        ["\u2764\uFE0F", "\u2764"], "\uE022", "\uDBBA\uDF0C", ["heart"], 3, 7, "<3"
    ],
    "2795": [
        ["\u2795"], "", "\uDBBA\uDF51", ["heavy_plus_sign"], 3, 8
    ],
    "2796": [
        ["\u2796"], "", "\uDBBA\uDF52", ["heavy_minus_sign"], 3, 9
    ],
    "2797": [
        ["\u2797"], "", "\uDBBA\uDF54", ["heavy_division_sign"], 3, 10
    ],
    "27a1": [
        ["\u27A1\uFE0F", "\u27A1"], "\uE234", "\uDBBA\uDEFA", ["arrow_right"], 3, 11
    ],
    "27b0": [
        ["\u27B0"], "", "\uDBBA\uDF08", ["curly_loop"], 3, 12
    ],
    "27bf": [
        ["\u27BF"], "\uE211", "\uDBBA\uDC2B", ["loop"], 3, 13
    ],
    "2934": [
        ["\u2934\uFE0F", "\u2934"], "\uE236", "\uDBBA\uDEF4", ["arrow_heading_up"], 3, 14
    ],
    "2935": [
        ["\u2935\uFE0F", "\u2935"], "\uE238", "\uDBBA\uDEF5", ["arrow_heading_down"], 3, 15
    ],
    "2b05": [
        ["\u2B05\uFE0F", "\u2B05"], "\uE235", "\uDBBA\uDEFB", ["arrow_left"], 3, 16
    ],
    "2b06": [
        ["\u2B06\uFE0F", "\u2B06"], "\uE232", "\uDBBA\uDEF8", ["arrow_up"], 3, 17
    ],
    "2b07": [
        ["\u2B07\uFE0F", "\u2B07"], "\uE233", "\uDBBA\uDEF9", ["arrow_down"], 3, 18
    ],
    "2b1b": [
        ["\u2B1B\uFE0F", "\u2B1B"], "\uE21A", "\uDBBA\uDF6C", ["black_large_square"], 3, 19
    ],
    "2b1c": [
        ["\u2B1C\uFE0F", "\u2B1C"], "\uE21B", "\uDBBA\uDF6B", ["white_large_square"], 3, 20
    ],
    "2b50": [
        ["\u2B50\uFE0F", "\u2B50"], "\uE32F", "\uDBBA\uDF68", ["star"], 3, 21
    ],
    "2b55": [
        ["\u2B55\uFE0F", "\u2B55"], "\uE332", "\uDBBA\uDF44", ["o"], 3, 22
    ],
    "3030": [
        ["\u3030"], "", "\uDBBA\uDF07", ["wavy_dash"], 3, 23
    ],
    "303d": [
        ["\u303D\uFE0F", "\u303D"], "\uE12C", "\uDBBA\uDC1B", ["part_alternation_mark"], 3, 24
    ],
    "3297": [
        ["\u3297\uFE0F", "\u3297"], "\uE30D", "\uDBBA\uDF43", ["congratulations"], 3, 25
    ],
    "3299": [
        ["\u3299\uFE0F", "\u3299"], "\uE315", "\uDBBA\uDF2B", ["secret"], 3, 26
    ],
    "1f004": [
        ["\uD83C\uDC04\uFE0F", "\uD83C\uDC04"], "\uE12D", "\uDBBA\uDC0B", ["mahjong"], 3, 27
    ],
    "1f0cf": [
        ["\uD83C\uDCCF"], "", "\uDBBA\uDC12", ["black_joker"], 3, 28
    ],
    "1f170": [
        ["\uD83C\uDD70"], "\uE532", "\uDBB9\uDD0B", ["a"], 3, 29
    ],
    "1f171": [
        ["\uD83C\uDD71"], "\uE533", "\uDBB9\uDD0C", ["b"], 4, 0
    ],
    "1f17e": [
        ["\uD83C\uDD7E"], "\uE535", "\uDBB9\uDD0E", ["o2"], 4, 1
    ],
    "1f17f": [
        ["\uD83C\uDD7F\uFE0F", "\uD83C\uDD7F"], "\uE14F", "\uDBB9\uDFF6", ["parking"], 4, 2
    ],
    "1f18e": [
        ["\uD83C\uDD8E"], "\uE534", "\uDBB9\uDD0D", ["ab"], 4, 3
    ],
    "1f191": [
        ["\uD83C\uDD91"], "", "\uDBBA\uDF84", ["cl"], 4, 4
    ],
    "1f192": [
        ["\uD83C\uDD92"], "\uE214", "\uDBBA\uDF38", ["cool"], 4, 5
    ],
    "1f193": [
        ["\uD83C\uDD93"], "", "\uDBBA\uDF21", ["free"], 4, 6
    ],
    "1f194": [
        ["\uD83C\uDD94"], "\uE229", "\uDBBA\uDF81", ["id"], 4, 7
    ],
    "1f195": [
        ["\uD83C\uDD95"], "\uE212", "\uDBBA\uDF36", ["new"], 4, 8
    ],
    "1f196": [
        ["\uD83C\uDD96"], "", "\uDBBA\uDF28", ["ng"], 4, 9
    ],
    "1f197": [
        ["\uD83C\uDD97"], "\uE24D", "\uDBBA\uDF27", ["ok"], 4, 10
    ],
    "1f198": [
        ["\uD83C\uDD98"], "", "\uDBBA\uDF4F", ["sos"], 4, 11
    ],
    "1f199": [
        ["\uD83C\uDD99"], "\uE213", "\uDBBA\uDF37", ["up"], 4, 12
    ],
    "1f19a": [
        ["\uD83C\uDD9A"], "\uE12E", "\uDBBA\uDF32", ["vs"], 4, 13
    ],
    "1f201": [
        ["\uD83C\uDE01"], "\uE203", "\uDBBA\uDF24", ["koko"], 4, 14
    ],
    "1f202": [
        ["\uD83C\uDE02"], "\uE228", "\uDBBA\uDF3F", ["sa"], 4, 15
    ],
    "1f21a": [
        ["\uD83C\uDE1A\uFE0F", "\uD83C\uDE1A"], "\uE216", "\uDBBA\uDF3A", ["u7121"], 4, 16
    ],
    "1f22f": [
        ["\uD83C\uDE2F\uFE0F", "\uD83C\uDE2F"], "\uE22C", "\uDBBA\uDF40", ["u6307"], 4, 17
    ],
    "1f232": [
        ["\uD83C\uDE32"], "", "\uDBBA\uDF2E", ["u7981"], 4, 18
    ],
    "1f233": [
        ["\uD83C\uDE33"], "\uE22B", "\uDBBA\uDF2F", ["u7a7a"], 4, 19
    ],
    "1f234": [
        ["\uD83C\uDE34"], "", "\uDBBA\uDF30", ["u5408"], 4, 20
    ],
    "1f235": [
        ["\uD83C\uDE35"], "\uE22A", "\uDBBA\uDF31", ["u6e80"], 4, 21
    ],
    "1f236": [
        ["\uD83C\uDE36"], "\uE215", "\uDBBA\uDF39", ["u6709"], 4, 22
    ],
    "1f237": [
        ["\uD83C\uDE37"], "\uE217", "\uDBBA\uDF3B", ["u6708"], 4, 23
    ],
    "1f238": [
        ["\uD83C\uDE38"], "\uE218", "\uDBBA\uDF3C", ["u7533"], 4, 24
    ],
    "1f239": [
        ["\uD83C\uDE39"], "\uE227", "\uDBBA\uDF3E", ["u5272"], 4, 25
    ],
    "1f23a": [
        ["\uD83C\uDE3A"], "\uE22D", "\uDBBA\uDF41", ["u55b6"], 4, 26
    ],
    "1f250": [
        ["\uD83C\uDE50"], "\uE226", "\uDBBA\uDF3D", ["ideograph_advantage"], 4, 27
    ],
    "1f251": [
        ["\uD83C\uDE51"], "", "\uDBBA\uDF50", ["accept"], 4, 28
    ],
    "1f300": [
        ["\uD83C\uDF00"], "\uE443", "\uDBB8\uDC05", ["cyclone"], 4, 29
    ],
    "1f301": [
        ["\uD83C\uDF01"], "", "\uDBB8\uDC06", ["foggy"], 5, 0
    ],
    "1f302": [
        ["\uD83C\uDF02"], "\uE43C", "\uDBB8\uDC07", ["closed_umbrella"], 5, 1
    ],
    "1f303": [
        ["\uD83C\uDF03"], "\uE44B", "\uDBB8\uDC08", ["night_with_stars"], 5, 2
    ],
    "1f304": [
        ["\uD83C\uDF04"], "\uE04D", "\uDBB8\uDC09", ["sunrise_over_mountains"], 5, 3
    ],
    "1f305": [
        ["\uD83C\uDF05"], "\uE449", "\uDBB8\uDC0A", ["sunrise"], 5, 4
    ],
    "1f306": [
        ["\uD83C\uDF06"], "\uE146", "\uDBB8\uDC0B", ["city_sunset"], 5, 5
    ],
    "1f307": [
        ["\uD83C\uDF07"], "\uE44A", "\uDBB8\uDC0C", ["city_sunrise"], 5, 6
    ],
    "1f308": [
        ["\uD83C\uDF08"], "\uE44C", "\uDBB8\uDC0D", ["rainbow"], 5, 7
    ],
    "1f309": [
        ["\uD83C\uDF09"], "\uE44B", "\uDBB8\uDC10", ["bridge_at_night"], 5, 8
    ],
    "1f30a": [
        ["\uD83C\uDF0A"], "\uE43E", "\uDBB8\uDC38", ["ocean"], 5, 9
    ],
    "1f30b": [
        ["\uD83C\uDF0B"], "", "\uDBB8\uDC3A", ["volcano"], 5, 10
    ],
    "1f30c": [
        ["\uD83C\uDF0C"], "\uE44B", "\uDBB8\uDC3B", ["milky_way"], 5, 11
    ],
    "1f30d": [
        ["\uD83C\uDF0D"], "", "", ["earth_africa"], 5, 12
    ],
    "1f30e": [
        ["\uD83C\uDF0E"], "", "", ["earth_americas"], 5, 13
    ],
    "1f30f": [
        ["\uD83C\uDF0F"], "", "\uDBB8\uDC39", ["earth_asia"], 5, 14
    ],
    "1f310": [
        ["\uD83C\uDF10"], "", "", ["globe_with_meridians"], 5, 15
    ],
    "1f311": [
        ["\uD83C\uDF11"], "", "\uDBB8\uDC11", ["new_moon"], 5, 16
    ],
    "1f312": [
        ["\uD83C\uDF12"], "", "", ["waxing_crescent_moon"], 5, 17
    ],
    "1f313": [
        ["\uD83C\uDF13"], "\uE04C", "\uDBB8\uDC13", ["first_quarter_moon"], 5, 18
    ],
    "1f314": [
        ["\uD83C\uDF14"], "\uE04C", "\uDBB8\uDC12", ["moon", "waxing_gibbous_moon"], 5, 19
    ],
    "1f315": [
        ["\uD83C\uDF15"], "", "\uDBB8\uDC15", ["full_moon"], 5, 20
    ],
    "1f316": [
        ["\uD83C\uDF16"], "", "", ["waning_gibbous_moon"], 5, 21
    ],
    "1f317": [
        ["\uD83C\uDF17"], "", "", ["last_quarter_moon"], 5, 22
    ],
    "1f318": [
        ["\uD83C\uDF18"], "", "", ["waning_crescent_moon"], 5, 23
    ],
    "1f319": [
        ["\uD83C\uDF19"], "\uE04C", "\uDBB8\uDC14", ["crescent_moon"], 5, 24
    ],
    "1f31a": [
        ["\uD83C\uDF1A"], "", "", ["new_moon_with_face"], 5, 25
    ],
    "1f31b": [
        ["\uD83C\uDF1B"], "\uE04C", "\uDBB8\uDC16", ["first_quarter_moon_with_face"], 5, 26
    ],
    "1f31c": [
        ["\uD83C\uDF1C"], "", "", ["last_quarter_moon_with_face"], 5, 27
    ],
    "1f31d": [
        ["\uD83C\uDF1D"], "", "", ["full_moon_with_face"], 5, 28
    ],
    "1f31e": [
        ["\uD83C\uDF1E"], "", "", ["sun_with_face"], 5, 29
    ],
    "1f31f": [
        ["\uD83C\uDF1F"], "\uE335", "\uDBBA\uDF69", ["star2"], 6, 0
    ],
    "1f320": [
        ["\uD83C\uDF20"], "", "\uDBBA\uDF6A", ["stars"], 6, 1
    ],
    "1f330": [
        ["\uD83C\uDF30"], "", "\uDBB8\uDC4C", ["chestnut"], 6, 2
    ],
    "1f331": [
        ["\uD83C\uDF31"], "\uE110", "\uDBB8\uDC3E", ["seedling"], 6, 3
    ],
    "1f332": [
        ["\uD83C\uDF32"], "", "", ["evergreen_tree"], 6, 4
    ],
    "1f333": [
        ["\uD83C\uDF33"], "", "", ["deciduous_tree"], 6, 5
    ],
    "1f334": [
        ["\uD83C\uDF34"], "\uE307", "\uDBB8\uDC47", ["palm_tree"], 6, 6
    ],
    "1f335": [
        ["\uD83C\uDF35"], "\uE308", "\uDBB8\uDC48", ["cactus"], 6, 7
    ],
    "1f337": [
        ["\uD83C\uDF37"], "\uE304", "\uDBB8\uDC3D", ["tulip"], 6, 8
    ],
    "1f338": [
        ["\uD83C\uDF38"], "\uE030", "\uDBB8\uDC40", ["cherry_blossom"], 6, 9
    ],
    "1f339": [
        ["\uD83C\uDF39"], "\uE032", "\uDBB8\uDC41", ["rose"], 6, 10
    ],
    "1f33a": [
        ["\uD83C\uDF3A"], "\uE303", "\uDBB8\uDC45", ["hibiscus"], 6, 11
    ],
    "1f33b": [
        ["\uD83C\uDF3B"], "\uE305", "\uDBB8\uDC46", ["sunflower"], 6, 12
    ],
    "1f33c": [
        ["\uD83C\uDF3C"], "\uE305", "\uDBB8\uDC4D", ["blossom"], 6, 13
    ],
    "1f33d": [
        ["\uD83C\uDF3D"], "", "\uDBB8\uDC4A", ["corn"], 6, 14
    ],
    "1f33e": [
        ["\uD83C\uDF3E"], "\uE444", "\uDBB8\uDC49", ["ear_of_rice"], 6, 15
    ],
    "1f33f": [
        ["\uD83C\uDF3F"], "\uE110", "\uDBB8\uDC4E", ["herb"], 6, 16
    ],
    "1f340": [
        ["\uD83C\uDF40"], "\uE110", "\uDBB8\uDC3C", ["four_leaf_clover"], 6, 17
    ],
    "1f341": [
        ["\uD83C\uDF41"], "\uE118", "\uDBB8\uDC3F", ["maple_leaf"], 6, 18
    ],
    "1f342": [
        ["\uD83C\uDF42"], "\uE119", "\uDBB8\uDC42", ["fallen_leaf"], 6, 19
    ],
    "1f343": [
        ["\uD83C\uDF43"], "\uE447", "\uDBB8\uDC43", ["leaves"], 6, 20
    ],
    "1f344": [
        ["\uD83C\uDF44"], "", "\uDBB8\uDC4B", ["mushroom"], 6, 21
    ],
    "1f345": [
        ["\uD83C\uDF45"], "\uE349", "\uDBB8\uDC55", ["tomato"], 6, 22
    ],
    "1f346": [
        ["\uD83C\uDF46"], "\uE34A", "\uDBB8\uDC56", ["eggplant"], 6, 23
    ],
    "1f347": [
        ["\uD83C\uDF47"], "", "\uDBB8\uDC59", ["grapes"], 6, 24
    ],
    "1f348": [
        ["\uD83C\uDF48"], "", "\uDBB8\uDC57", ["melon"], 6, 25
    ],
    "1f349": [
        ["\uD83C\uDF49"], "\uE348", "\uDBB8\uDC54", ["watermelon"], 6, 26
    ],
    "1f34a": [
        ["\uD83C\uDF4A"], "\uE346", "\uDBB8\uDC52", ["tangerine"], 6, 27
    ],
    "1f34b": [
        ["\uD83C\uDF4B"], "", "", ["lemon"], 6, 28
    ],
    "1f34c": [
        ["\uD83C\uDF4C"], "", "\uDBB8\uDC50", ["banana"], 6, 29
    ],
    "1f34d": [
        ["\uD83C\uDF4D"], "", "\uDBB8\uDC58", ["pineapple"], 7, 0
    ],
    "1f34e": [
        ["\uD83C\uDF4E"], "\uE345", "\uDBB8\uDC51", ["apple"], 7, 1
    ],
    "1f34f": [
        ["\uD83C\uDF4F"], "\uE345", "\uDBB8\uDC5B", ["green_apple"], 7, 2
    ],
    "1f350": [
        ["\uD83C\uDF50"], "", "", ["pear"], 7, 3
    ],
    "1f351": [
        ["\uD83C\uDF51"], "", "\uDBB8\uDC5A", ["peach"], 7, 4
    ],
    "1f352": [
        ["\uD83C\uDF52"], "", "\uDBB8\uDC4F", ["cherries"], 7, 5
    ],
    "1f353": [
        ["\uD83C\uDF53"], "\uE347", "\uDBB8\uDC53", ["strawberry"], 7, 6
    ],
    "1f354": [
        ["\uD83C\uDF54"], "\uE120", "\uDBBA\uDD60", ["hamburger"], 7, 7
    ],
    "1f355": [
        ["\uD83C\uDF55"], "", "\uDBBA\uDD75", ["pizza"], 7, 8
    ],
    "1f356": [
        ["\uD83C\uDF56"], "", "\uDBBA\uDD72", ["meat_on_bone"], 7, 9
    ],
    "1f357": [
        ["\uD83C\uDF57"], "", "\uDBBA\uDD76", ["poultry_leg"], 7, 10
    ],
    "1f358": [
        ["\uD83C\uDF58"], "\uE33D", "\uDBBA\uDD69", ["rice_cracker"], 7, 11
    ],
    "1f359": [
        ["\uD83C\uDF59"], "\uE342", "\uDBBA\uDD61", ["rice_ball"], 7, 12
    ],
    "1f35a": [
        ["\uD83C\uDF5A"], "\uE33E", "\uDBBA\uDD6A", ["rice"], 7, 13
    ],
    "1f35b": [
        ["\uD83C\uDF5B"], "\uE341", "\uDBBA\uDD6C", ["curry"], 7, 14
    ],
    "1f35c": [
        ["\uD83C\uDF5C"], "\uE340", "\uDBBA\uDD63", ["ramen"], 7, 15
    ],
    "1f35d": [
        ["\uD83C\uDF5D"], "\uE33F", "\uDBBA\uDD6B", ["spaghetti"], 7, 16
    ],
    "1f35e": [
        ["\uD83C\uDF5E"], "\uE339", "\uDBBA\uDD64", ["bread"], 7, 17
    ],
    "1f35f": [
        ["\uD83C\uDF5F"], "\uE33B", "\uDBBA\uDD67", ["fries"], 7, 18
    ],
    "1f360": [
        ["\uD83C\uDF60"], "", "\uDBBA\uDD74", ["sweet_potato"], 7, 19
    ],
    "1f361": [
        ["\uD83C\uDF61"], "\uE33C", "\uDBBA\uDD68", ["dango"], 7, 20
    ],
    "1f362": [
        ["\uD83C\uDF62"], "\uE343", "\uDBBA\uDD6D", ["oden"], 7, 21
    ],
    "1f363": [
        ["\uD83C\uDF63"], "\uE344", "\uDBBA\uDD6E", ["sushi"], 7, 22
    ],
    "1f364": [
        ["\uD83C\uDF64"], "", "\uDBBA\uDD7F", ["fried_shrimp"], 7, 23
    ],
    "1f365": [
        ["\uD83C\uDF65"], "", "\uDBBA\uDD73", ["fish_cake"], 7, 24
    ],
    "1f366": [
        ["\uD83C\uDF66"], "\uE33A", "\uDBBA\uDD66", ["icecream"], 7, 25
    ],
    "1f367": [
        ["\uD83C\uDF67"], "\uE43F", "\uDBBA\uDD71", ["shaved_ice"], 7, 26
    ],
    "1f368": [
        ["\uD83C\uDF68"], "", "\uDBBA\uDD77", ["ice_cream"], 7, 27
    ],
    "1f369": [
        ["\uD83C\uDF69"], "", "\uDBBA\uDD78", ["doughnut"], 7, 28
    ],
    "1f36a": [
        ["\uD83C\uDF6A"], "", "\uDBBA\uDD79", ["cookie"], 7, 29
    ],
    "1f36b": [
        ["\uD83C\uDF6B"], "", "\uDBBA\uDD7A", ["chocolate_bar"], 8, 0
    ],
    "1f36c": [
        ["\uD83C\uDF6C"], "", "\uDBBA\uDD7B", ["candy"], 8, 1
    ],
    "1f36d": [
        ["\uD83C\uDF6D"], "", "\uDBBA\uDD7C", ["lollipop"], 8, 2
    ],
    "1f36e": [
        ["\uD83C\uDF6E"], "", "\uDBBA\uDD7D", ["custard"], 8, 3
    ],
    "1f36f": [
        ["\uD83C\uDF6F"], "", "\uDBBA\uDD7E", ["honey_pot"], 8, 4
    ],
    "1f370": [
        ["\uD83C\uDF70"], "\uE046", "\uDBBA\uDD62", ["cake"], 8, 5
    ],
    "1f371": [
        ["\uD83C\uDF71"], "\uE34C", "\uDBBA\uDD6F", ["bento"], 8, 6
    ],
    "1f372": [
        ["\uD83C\uDF72"], "\uE34D", "\uDBBA\uDD70", ["stew"], 8, 7
    ],
    "1f373": [
        ["\uD83C\uDF73"], "\uE147", "\uDBBA\uDD65", ["egg"], 8, 8
    ],
    "1f374": [
        ["\uD83C\uDF74"], "\uE043", "\uDBBA\uDD80", ["fork_and_knife"], 8, 9
    ],
    "1f375": [
        ["\uD83C\uDF75"], "\uE338", "\uDBBA\uDD84", ["tea"], 8, 10
    ],
    "1f376": [
        ["\uD83C\uDF76"], "\uE30B", "\uDBBA\uDD85", ["sake"], 8, 11
    ],
    "1f377": [
        ["\uD83C\uDF77"], "\uE044", "\uDBBA\uDD86", ["wine_glass"], 8, 12
    ],
    "1f378": [
        ["\uD83C\uDF78"], "\uE044", "\uDBBA\uDD82", ["cocktail"], 8, 13
    ],
    "1f379": [
        ["\uD83C\uDF79"], "\uE044", "\uDBBA\uDD88", ["tropical_drink"], 8, 14
    ],
    "1f37a": [
        ["\uD83C\uDF7A"], "\uE047", "\uDBBA\uDD83", ["beer"], 8, 15
    ],
    "1f37b": [
        ["\uD83C\uDF7B"], "\uE30C", "\uDBBA\uDD87", ["beers"], 8, 16
    ],
    "1f37c": [
        ["\uD83C\uDF7C"], "", "", ["baby_bottle"], 8, 17
    ],
    "1f380": [
        ["\uD83C\uDF80"], "\uE314", "\uDBB9\uDD0F", ["ribbon"], 8, 18
    ],
    "1f381": [
        ["\uD83C\uDF81"], "\uE112", "\uDBB9\uDD10", ["gift"], 8, 19
    ],
    "1f382": [
        ["\uD83C\uDF82"], "\uE34B", "\uDBB9\uDD11", ["birthday"], 8, 20
    ],
    "1f383": [
        ["\uD83C\uDF83"], "\uE445", "\uDBB9\uDD1F", ["jack_o_lantern"], 8, 21
    ],
    "1f384": [
        ["\uD83C\uDF84"], "\uE033", "\uDBB9\uDD12", ["christmas_tree"], 8, 22
    ],
    "1f385": [
        ["\uD83C\uDF85"], "\uE448", "\uDBB9\uDD13", ["santa"], 8, 23
    ],
    "1f386": [
        ["\uD83C\uDF86"], "\uE117", "\uDBB9\uDD15", ["fireworks"], 8, 24
    ],
    "1f387": [
        ["\uD83C\uDF87"], "\uE440", "\uDBB9\uDD1D", ["sparkler"], 8, 25
    ],
    "1f388": [
        ["\uD83C\uDF88"], "\uE310", "\uDBB9\uDD16", ["balloon"], 8, 26
    ],
    "1f389": [
        ["\uD83C\uDF89"], "\uE312", "\uDBB9\uDD17", ["tada"], 8, 27
    ],
    "1f38a": [
        ["\uD83C\uDF8A"], "", "\uDBB9\uDD20", ["confetti_ball"], 8, 28
    ],
    "1f38b": [
        ["\uD83C\uDF8B"], "", "\uDBB9\uDD21", ["tanabata_tree"], 8, 29
    ],
    "1f38c": [
        ["\uD83C\uDF8C"], "\uE143", "\uDBB9\uDD14", ["crossed_flags"], 9, 0
    ],
    "1f38d": [
        ["\uD83C\uDF8D"], "\uE436", "\uDBB9\uDD18", ["bamboo"], 9, 1
    ],
    "1f38e": [
        ["\uD83C\uDF8E"], "\uE438", "\uDBB9\uDD19", ["dolls"], 9, 2
    ],
    "1f38f": [
        ["\uD83C\uDF8F"], "\uE43B", "\uDBB9\uDD1C", ["flags"], 9, 3
    ],
    "1f390": [
        ["\uD83C\uDF90"], "\uE442", "\uDBB9\uDD1E", ["wind_chime"], 9, 4
    ],
    "1f391": [
        ["\uD83C\uDF91"], "\uE446", "\uDBB8\uDC17", ["rice_scene"], 9, 5
    ],
    "1f392": [
        ["\uD83C\uDF92"], "\uE43A", "\uDBB9\uDD1B", ["school_satchel"], 9, 6
    ],
    "1f393": [
        ["\uD83C\uDF93"], "\uE439", "\uDBB9\uDD1A", ["mortar_board"], 9, 7
    ],
    "1f3a0": [
        ["\uD83C\uDFA0"], "", "\uDBB9\uDFFC", ["carousel_horse"], 9, 8
    ],
    "1f3a1": [
        ["\uD83C\uDFA1"], "\uE124", "\uDBB9\uDFFD", ["ferris_wheel"], 9, 9
    ],
    "1f3a2": [
        ["\uD83C\uDFA2"], "\uE433", "\uDBB9\uDFFE", ["roller_coaster"], 9, 10
    ],
    "1f3a3": [
        ["\uD83C\uDFA3"], "\uE019", "\uDBB9\uDFFF", ["fishing_pole_and_fish"], 9, 11
    ],
    "1f3a4": [
        ["\uD83C\uDFA4"], "\uE03C", "\uDBBA\uDC00", ["microphone"], 9, 12
    ],
    "1f3a5": [
        ["\uD83C\uDFA5"], "\uE03D", "\uDBBA\uDC01", ["movie_camera"], 9, 13
    ],
    "1f3a6": [
        ["\uD83C\uDFA6"], "\uE507", "\uDBBA\uDC02", ["cinema"], 9, 14
    ],
    "1f3a7": [
        ["\uD83C\uDFA7"], "\uE30A", "\uDBBA\uDC03", ["headphones"], 9, 15
    ],
    "1f3a8": [
        ["\uD83C\uDFA8"], "\uE502", "\uDBBA\uDC04", ["art"], 9, 16
    ],
    "1f3a9": [
        ["\uD83C\uDFA9"], "\uE503", "\uDBBA\uDC05", ["tophat"], 9, 17
    ],
    "1f3aa": [
        ["\uD83C\uDFAA"], "", "\uDBBA\uDC06", ["circus_tent"], 9, 18
    ],
    "1f3ab": [
        ["\uD83C\uDFAB"], "\uE125", "\uDBBA\uDC07", ["ticket"], 9, 19
    ],
    "1f3ac": [
        ["\uD83C\uDFAC"], "\uE324", "\uDBBA\uDC08", ["clapper"], 9, 20
    ],
    "1f3ad": [
        ["\uD83C\uDFAD"], "\uE503", "\uDBBA\uDC09", ["performing_arts"], 9, 21
    ],
    "1f3ae": [
        ["\uD83C\uDFAE"], "", "\uDBBA\uDC0A", ["video_game"], 9, 22
    ],
    "1f3af": [
        ["\uD83C\uDFAF"], "\uE130", "\uDBBA\uDC0C", ["dart"], 9, 23
    ],
    "1f3b0": [
        ["\uD83C\uDFB0"], "\uE133", "\uDBBA\uDC0D", ["slot_machine"], 9, 24
    ],
    "1f3b1": [
        ["\uD83C\uDFB1"], "\uE42C", "\uDBBA\uDC0E", ["8ball"], 9, 25
    ],
    "1f3b2": [
        ["\uD83C\uDFB2"], "", "\uDBBA\uDC0F", ["game_die"], 9, 26
    ],
    "1f3b3": [
        ["\uD83C\uDFB3"], "", "\uDBBA\uDC10", ["bowling"], 9, 27
    ],
    "1f3b4": [
        ["\uD83C\uDFB4"], "", "\uDBBA\uDC11", ["flower_playing_cards"], 9, 28
    ],
    "1f3b5": [
        ["\uD83C\uDFB5"], "\uE03E", "\uDBBA\uDC13", ["musical_note"], 9, 29
    ],
    "1f3b6": [
        ["\uD83C\uDFB6"], "\uE326", "\uDBBA\uDC14", ["notes"], 10, 0
    ],
    "1f3b7": [
        ["\uD83C\uDFB7"], "\uE040", "\uDBBA\uDC15", ["saxophone"], 10, 1
    ],
    "1f3b8": [
        ["\uD83C\uDFB8"], "\uE041", "\uDBBA\uDC16", ["guitar"], 10, 2
    ],
    "1f3b9": [
        ["\uD83C\uDFB9"], "", "\uDBBA\uDC17", ["musical_keyboard"], 10, 3
    ],
    "1f3ba": [
        ["\uD83C\uDFBA"], "\uE042", "\uDBBA\uDC18", ["trumpet"], 10, 4
    ],
    "1f3bb": [
        ["\uD83C\uDFBB"], "", "\uDBBA\uDC19", ["violin"], 10, 5
    ],
    "1f3bc": [
        ["\uD83C\uDFBC"], "\uE326", "\uDBBA\uDC1A", ["musical_score"], 10, 6
    ],
    "1f3bd": [
        ["\uD83C\uDFBD"], "", "\uDBB9\uDFD0", ["running_shirt_with_sash"], 10, 7
    ],
    "1f3be": [
        ["\uD83C\uDFBE"], "\uE015", "\uDBB9\uDFD3", ["tennis"], 10, 8
    ],
    "1f3bf": [
        ["\uD83C\uDFBF"], "\uE013", "\uDBB9\uDFD5", ["ski"], 10, 9
    ],
    "1f3c0": [
        ["\uD83C\uDFC0"], "\uE42A", "\uDBB9\uDFD6", ["basketball"], 10, 10
    ],
    "1f3c1": [
        ["\uD83C\uDFC1"], "\uE132", "\uDBB9\uDFD7", ["checkered_flag"], 10, 11
    ],
    "1f3c2": [
        ["\uD83C\uDFC2"], "", "\uDBB9\uDFD8", ["snowboarder"], 10, 12
    ],
    "1f3c3": [
        ["\uD83C\uDFC3"], "\uE115", "\uDBB9\uDFD9", ["runner", "running"], 10, 13
    ],
    "1f3c4": [
        ["\uD83C\uDFC4"], "\uE017", "\uDBB9\uDFDA", ["surfer"], 10, 14
    ],
    "1f3c6": [
        ["\uD83C\uDFC6"], "\uE131", "\uDBB9\uDFDB", ["trophy"], 10, 15
    ],
    "1f3c7": [
        ["\uD83C\uDFC7"], "", "", ["horse_racing"], 10, 16
    ],
    "1f3c8": [
        ["\uD83C\uDFC8"], "\uE42B", "\uDBB9\uDFDD", ["football"], 10, 17
    ],
    "1f3c9": [
        ["\uD83C\uDFC9"], "", "", ["rugby_football"], 10, 18
    ],
    "1f3ca": [
        ["\uD83C\uDFCA"], "\uE42D", "\uDBB9\uDFDE", ["swimmer"], 10, 19
    ],
    "1f3e0": [
        ["\uD83C\uDFE0"], "\uE036", "\uDBB9\uDCB0", ["house"], 10, 20
    ],
    "1f3e1": [
        ["\uD83C\uDFE1"], "\uE036", "\uDBB9\uDCB1", ["house_with_garden"], 10, 21
    ],
    "1f3e2": [
        ["\uD83C\uDFE2"], "\uE038", "\uDBB9\uDCB2", ["office"], 10, 22
    ],
    "1f3e3": [
        ["\uD83C\uDFE3"], "\uE153", "\uDBB9\uDCB3", ["post_office"], 10, 23
    ],
    "1f3e4": [
        ["\uD83C\uDFE4"], "", "", ["european_post_office"], 10, 24
    ],
    "1f3e5": [
        ["\uD83C\uDFE5"], "\uE155", "\uDBB9\uDCB4", ["hospital"], 10, 25
    ],
    "1f3e6": [
        ["\uD83C\uDFE6"], "\uE14D", "\uDBB9\uDCB5", ["bank"], 10, 26
    ],
    "1f3e7": [
        ["\uD83C\uDFE7"], "\uE154", "\uDBB9\uDCB6", ["atm"], 10, 27
    ],
    "1f3e8": [
        ["\uD83C\uDFE8"], "\uE158", "\uDBB9\uDCB7", ["hotel"], 10, 28
    ],
    "1f3e9": [
        ["\uD83C\uDFE9"], "\uE501", "\uDBB9\uDCB8", ["love_hotel"], 10, 29
    ],
    "1f3ea": [
        ["\uD83C\uDFEA"], "\uE156", "\uDBB9\uDCB9", ["convenience_store"], 11, 0
    ],
    "1f3eb": [
        ["\uD83C\uDFEB"], "\uE157", "\uDBB9\uDCBA", ["school"], 11, 1
    ],
    "1f3ec": [
        ["\uD83C\uDFEC"], "\uE504", "\uDBB9\uDCBD", ["department_store"], 11, 2
    ],
    "1f3ed": [
        ["\uD83C\uDFED"], "\uE508", "\uDBB9\uDCC0", ["factory"], 11, 3
    ],
    "1f3ee": [
        ["\uD83C\uDFEE"], "\uE30B", "\uDBB9\uDCC2", ["izakaya_lantern", "lantern"], 11, 4
    ],
    "1f3ef": [
        ["\uD83C\uDFEF"], "\uE505", "\uDBB9\uDCBE", ["japanese_castle"], 11, 5
    ],
    "1f3f0": [
        ["\uD83C\uDFF0"], "\uE506", "\uDBB9\uDCBF", ["european_castle"], 11, 6
    ],
    "1f400": [
        ["\uD83D\uDC00"], "", "", ["rat"], 11, 7
    ],
    "1f401": [
        ["\uD83D\uDC01"], "", "", ["mouse2"], 11, 8
    ],
    "1f402": [
        ["\uD83D\uDC02"], "", "", ["ox"], 11, 9
    ],
    "1f403": [
        ["\uD83D\uDC03"], "", "", ["water_buffalo"], 11, 10
    ],
    "1f404": [
        ["\uD83D\uDC04"], "", "", ["cow2"], 11, 11
    ],
    "1f405": [
        ["\uD83D\uDC05"], "", "", ["tiger2"], 11, 12
    ],
    "1f406": [
        ["\uD83D\uDC06"], "", "", ["leopard"], 11, 13
    ],
    "1f407": [
        ["\uD83D\uDC07"], "", "", ["rabbit2"], 11, 14
    ],
    "1f408": [
        ["\uD83D\uDC08"], "", "", ["cat2"], 11, 15
    ],
    "1f409": [
        ["\uD83D\uDC09"], "", "", ["dragon"], 11, 16
    ],
    "1f40a": [
        ["\uD83D\uDC0A"], "", "", ["crocodile"], 11, 17
    ],
    "1f40b": [
        ["\uD83D\uDC0B"], "", "", ["whale2"], 11, 18
    ],
    "1f40c": [
        ["\uD83D\uDC0C"], "", "\uDBB8\uDDB9", ["snail"], 11, 19
    ],
    "1f40d": [
        ["\uD83D\uDC0D"], "\uE52D", "\uDBB8\uDDD3", ["snake"], 11, 20
    ],
    "1f40e": [
        ["\uD83D\uDC0E"], "\uE134", "\uDBB9\uDFDC", ["racehorse"], 11, 21
    ],
    "1f40f": [
        ["\uD83D\uDC0F"], "", "", ["ram"], 11, 22
    ],
    "1f410": [
        ["\uD83D\uDC10"], "", "", ["goat"], 11, 23
    ],
    "1f411": [
        ["\uD83D\uDC11"], "\uE529", "\uDBB8\uDDCF", ["sheep"], 11, 24
    ],
    "1f412": [
        ["\uD83D\uDC12"], "\uE528", "\uDBB8\uDDCE", ["monkey"], 11, 25
    ],
    "1f413": [
        ["\uD83D\uDC13"], "", "", ["rooster"], 11, 26
    ],
    "1f414": [
        ["\uD83D\uDC14"], "\uE52E", "\uDBB8\uDDD4", ["chicken"], 11, 27
    ],
    "1f415": [
        ["\uD83D\uDC15"], "", "", ["dog2"], 11, 28
    ],
    "1f416": [
        ["\uD83D\uDC16"], "", "", ["pig2"], 11, 29
    ],
    "1f417": [
        ["\uD83D\uDC17"], "\uE52F", "\uDBB8\uDDD5", ["boar"], 12, 0
    ],
    "1f418": [
        ["\uD83D\uDC18"], "\uE526", "\uDBB8\uDDCC", ["elephant"], 12, 1
    ],
    "1f419": [
        ["\uD83D\uDC19"], "\uE10A", "\uDBB8\uDDC5", ["octopus"], 12, 2
    ],
    "1f41a": [
        ["\uD83D\uDC1A"], "\uE441", "\uDBB8\uDDC6", ["shell"], 12, 3
    ],
    "1f41b": [
        ["\uD83D\uDC1B"], "\uE525", "\uDBB8\uDDCB", ["bug"], 12, 4
    ],
    "1f41c": [
        ["\uD83D\uDC1C"], "", "\uDBB8\uDDDA", ["ant"], 12, 5
    ],
    "1f41d": [
        ["\uD83D\uDC1D"], "", "\uDBB8\uDDE1", ["bee", "honeybee"], 12, 6
    ],
    "1f41e": [
        ["\uD83D\uDC1E"], "", "\uDBB8\uDDE2", ["beetle"], 12, 7
    ],
    "1f41f": [
        ["\uD83D\uDC1F"], "\uE019", "\uDBB8\uDDBD", ["fish"], 12, 8
    ],
    "1f420": [
        ["\uD83D\uDC20"], "\uE522", "\uDBB8\uDDC9", ["tropical_fish"], 12, 9
    ],
    "1f421": [
        ["\uD83D\uDC21"], "\uE019", "\uDBB8\uDDD9", ["blowfish"], 12, 10
    ],
    "1f422": [
        ["\uD83D\uDC22"], "", "\uDBB8\uDDDC", ["turtle"], 12, 11
    ],
    "1f423": [
        ["\uD83D\uDC23"], "\uE523", "\uDBB8\uDDDD", ["hatching_chick"], 12, 12
    ],
    "1f424": [
        ["\uD83D\uDC24"], "\uE523", "\uDBB8\uDDBA", ["baby_chick"], 12, 13
    ],
    "1f425": [
        ["\uD83D\uDC25"], "\uE523", "\uDBB8\uDDBB", ["hatched_chick"], 12, 14
    ],
    "1f426": [
        ["\uD83D\uDC26"], "\uE521", "\uDBB8\uDDC8", ["bird"], 12, 15
    ],
    "1f427": [
        ["\uD83D\uDC27"], "\uE055", "\uDBB8\uDDBC", ["penguin"], 12, 16
    ],
    "1f428": [
        ["\uD83D\uDC28"], "\uE527", "\uDBB8\uDDCD", ["koala"], 12, 17
    ],
    "1f429": [
        ["\uD83D\uDC29"], "\uE052", "\uDBB8\uDDD8", ["poodle"], 12, 18
    ],
    "1f42a": [
        ["\uD83D\uDC2A"], "", "", ["dromedary_camel"], 12, 19
    ],
    "1f42b": [
        ["\uD83D\uDC2B"], "\uE530", "\uDBB8\uDDD6", ["camel"], 12, 20
    ],
    "1f42c": [
        ["\uD83D\uDC2C"], "\uE520", "\uDBB8\uDDC7", ["dolphin", "flipper"], 12, 21
    ],
    "1f42d": [
        ["\uD83D\uDC2D"], "\uE053", "\uDBB8\uDDC2", ["mouse"], 12, 22
    ],
    "1f42e": [
        ["\uD83D\uDC2E"], "\uE52B", "\uDBB8\uDDD1", ["cow"], 12, 23
    ],
    "1f42f": [
        ["\uD83D\uDC2F"], "\uE050", "\uDBB8\uDDC0", ["tiger"], 12, 24
    ],
    "1f430": [
        ["\uD83D\uDC30"], "\uE52C", "\uDBB8\uDDD2", ["rabbit"], 12, 25
    ],
    "1f431": [
        ["\uD83D\uDC31"], "\uE04F", "\uDBB8\uDDB8", ["cat"], 12, 26
    ],
    "1f432": [
        ["\uD83D\uDC32"], "", "\uDBB8\uDDDE", ["dragon_face"], 12, 27
    ],
    "1f433": [
        ["\uD83D\uDC33"], "\uE054", "\uDBB8\uDDC3", ["whale"], 12, 28
    ],
    "1f434": [
        ["\uD83D\uDC34"], "\uE01A", "\uDBB8\uDDBE", ["horse"], 12, 29
    ],
    "1f435": [
        ["\uD83D\uDC35"], "\uE109", "\uDBB8\uDDC4", ["monkey_face"], 13, 0
    ],
    "1f436": [
        ["\uD83D\uDC36"], "\uE052", "\uDBB8\uDDB7", ["dog"], 13, 1
    ],
    "1f437": [
        ["\uD83D\uDC37"], "\uE10B", "\uDBB8\uDDBF", ["pig"], 13, 2
    ],
    "1f438": [
        ["\uD83D\uDC38"], "\uE531", "\uDBB8\uDDD7", ["frog"], 13, 3
    ],
    "1f439": [
        ["\uD83D\uDC39"], "\uE524", "\uDBB8\uDDCA", ["hamster"], 13, 4
    ],
    "1f43a": [
        ["\uD83D\uDC3A"], "\uE52A", "\uDBB8\uDDD0", ["wolf"], 13, 5
    ],
    "1f43b": [
        ["\uD83D\uDC3B"], "\uE051", "\uDBB8\uDDC1", ["bear"], 13, 6
    ],
    "1f43c": [
        ["\uD83D\uDC3C"], "", "\uDBB8\uDDDF", ["panda_face"], 13, 7
    ],
    "1f43d": [
        ["\uD83D\uDC3D"], "\uE10B", "\uDBB8\uDDE0", ["pig_nose"], 13, 8
    ],
    "1f43e": [
        ["\uD83D\uDC3E"], "\uE536", "\uDBB8\uDDDB", ["feet", "paw_prints"], 13, 9
    ],
    "1f440": [
        ["\uD83D\uDC40"], "\uE419", "\uDBB8\uDD90", ["eyes"], 13, 10
    ],
    "1f442": [
        ["\uD83D\uDC42"], "\uE41B", "\uDBB8\uDD91", ["ear"], 13, 11
    ],
    "1f443": [
        ["\uD83D\uDC43"], "\uE41A", "\uDBB8\uDD92", ["nose"], 13, 12
    ],
    "1f444": [
        ["\uD83D\uDC44"], "\uE41C", "\uDBB8\uDD93", ["lips"], 13, 13
    ],
    "1f445": [
        ["\uD83D\uDC45"], "\uE409", "\uDBB8\uDD94", ["tongue"], 13, 14
    ],
    "1f446": [
        ["\uD83D\uDC46"], "\uE22E", "\uDBBA\uDF99", ["point_up_2"], 13, 15
    ],
    "1f447": [
        ["\uD83D\uDC47"], "\uE22F", "\uDBBA\uDF9A", ["point_down"], 13, 16
    ],
    "1f448": [
        ["\uD83D\uDC48"], "\uE230", "\uDBBA\uDF9B", ["point_left"], 13, 17
    ],
    "1f449": [
        ["\uD83D\uDC49"], "\uE231", "\uDBBA\uDF9C", ["point_right"], 13, 18
    ],
    "1f44a": [
        ["\uD83D\uDC4A"], "\uE00D", "\uDBBA\uDF96", ["facepunch", "punch"], 13, 19
    ],
    "1f44b": [
        ["\uD83D\uDC4B"], "\uE41E", "\uDBBA\uDF9D", ["wave"], 13, 20
    ],
    "1f44c": [
        ["\uD83D\uDC4C"], "\uE420", "\uDBBA\uDF9F", ["ok_hand"], 13, 21
    ],
    "1f44d": [
        ["\uD83D\uDC4D"], "\uE00E", "\uDBBA\uDF97", ["+1", "thumbsup"], 13, 22
    ],
    "1f44e": [
        ["\uD83D\uDC4E"], "\uE421", "\uDBBA\uDFA0", ["-1", "thumbsdown"], 13, 23
    ],
    "1f44f": [
        ["\uD83D\uDC4F"], "\uE41F", "\uDBBA\uDF9E", ["clap"], 13, 24
    ],
    "1f450": [
        ["\uD83D\uDC50"], "\uE422", "\uDBBA\uDFA1", ["open_hands"], 13, 25
    ],
    "1f451": [
        ["\uD83D\uDC51"], "\uE10E", "\uDBB9\uDCD1", ["crown"], 13, 26
    ],
    "1f452": [
        ["\uD83D\uDC52"], "\uE318", "\uDBB9\uDCD4", ["womans_hat"], 13, 27
    ],
    "1f453": [
        ["\uD83D\uDC53"], "", "\uDBB9\uDCCE", ["eyeglasses"], 13, 28
    ],
    "1f454": [
        ["\uD83D\uDC54"], "\uE302", "\uDBB9\uDCD3", ["necktie"], 13, 29
    ],
    "1f455": [
        ["\uD83D\uDC55"], "\uE006", "\uDBB9\uDCCF", ["shirt", "tshirt"], 14, 0
    ],
    "1f456": [
        ["\uD83D\uDC56"], "", "\uDBB9\uDCD0", ["jeans"], 14, 1
    ],
    "1f457": [
        ["\uD83D\uDC57"], "\uE319", "\uDBB9\uDCD5", ["dress"], 14, 2
    ],
    "1f458": [
        ["\uD83D\uDC58"], "\uE321", "\uDBB9\uDCD9", ["kimono"], 14, 3
    ],
    "1f459": [
        ["\uD83D\uDC59"], "\uE322", "\uDBB9\uDCDA", ["bikini"], 14, 4
    ],
    "1f45a": [
        ["\uD83D\uDC5A"], "\uE006", "\uDBB9\uDCDB", ["womans_clothes"], 14, 5
    ],
    "1f45b": [
        ["\uD83D\uDC5B"], "", "\uDBB9\uDCDC", ["purse"], 14, 6
    ],
    "1f45c": [
        ["\uD83D\uDC5C"], "\uE323", "\uDBB9\uDCF0", ["handbag"], 14, 7
    ],
    "1f45d": [
        ["\uD83D\uDC5D"], "", "\uDBB9\uDCF1", ["pouch"], 14, 8
    ],
    "1f45e": [
        ["\uD83D\uDC5E"], "\uE007", "\uDBB9\uDCCC", ["mans_shoe", "shoe"], 14, 9
    ],
    "1f45f": [
        ["\uD83D\uDC5F"], "\uE007", "\uDBB9\uDCCD", ["athletic_shoe"], 14, 10
    ],
    "1f460": [
        ["\uD83D\uDC60"], "\uE13E", "\uDBB9\uDCD6", ["high_heel"], 14, 11
    ],
    "1f461": [
        ["\uD83D\uDC61"], "\uE31A", "\uDBB9\uDCD7", ["sandal"], 14, 12
    ],
    "1f462": [
        ["\uD83D\uDC62"], "\uE31B", "\uDBB9\uDCD8", ["boot"], 14, 13
    ],
    "1f463": [
        ["\uD83D\uDC63"], "\uE536", "\uDBB9\uDD53", ["footprints"], 14, 14
    ],
    "1f464": [
        ["\uD83D\uDC64"], "", "\uDBB8\uDD9A", ["bust_in_silhouette"], 14, 15
    ],
    "1f465": [
        ["\uD83D\uDC65"], "", "", ["busts_in_silhouette"], 14, 16
    ],
    "1f466": [
        ["\uD83D\uDC66"], "\uE001", "\uDBB8\uDD9B", ["boy"], 14, 17
    ],
    "1f467": [
        ["\uD83D\uDC67"], "\uE002", "\uDBB8\uDD9C", ["girl"], 14, 18
    ],
    "1f468": [
        ["\uD83D\uDC68"], "\uE004", "\uDBB8\uDD9D", ["man"], 14, 19
    ],
    "1f469": [
        ["\uD83D\uDC69"], "\uE005", "\uDBB8\uDD9E", ["woman"], 14, 20
    ],
    "1f46a": [
        ["\uD83D\uDC6A"], "", "\uDBB8\uDD9F", ["family"], 14, 21
    ],
    "1f46b": [
        ["\uD83D\uDC6B"], "\uE428", "\uDBB8\uDDA0", ["couple"], 14, 22
    ],
    "1f46c": [
        ["\uD83D\uDC6C"], "", "", ["two_men_holding_hands"], 14, 23
    ],
    "1f46d": [
        ["\uD83D\uDC6D"], "", "", ["two_women_holding_hands"], 14, 24
    ],
    "1f46e": [
        ["\uD83D\uDC6E"], "\uE152", "\uDBB8\uDDA1", ["cop"], 14, 25
    ],
    "1f46f": [
        ["\uD83D\uDC6F"], "\uE429", "\uDBB8\uDDA2", ["dancers"], 14, 26
    ],
    "1f470": [
        ["\uD83D\uDC70"], "", "\uDBB8\uDDA3", ["bride_with_veil"], 14, 27
    ],
    "1f471": [
        ["\uD83D\uDC71"], "\uE515", "\uDBB8\uDDA4", ["person_with_blond_hair"], 14, 28
    ],
    "1f472": [
        ["\uD83D\uDC72"], "\uE516", "\uDBB8\uDDA5", ["man_with_gua_pi_mao"], 14, 29
    ],
    "1f473": [
        ["\uD83D\uDC73"], "\uE517", "\uDBB8\uDDA6", ["man_with_turban"], 15, 0
    ],
    "1f474": [
        ["\uD83D\uDC74"], "\uE518", "\uDBB8\uDDA7", ["older_man"], 15, 1
    ],
    "1f475": [
        ["\uD83D\uDC75"], "\uE519", "\uDBB8\uDDA8", ["older_woman"], 15, 2
    ],
    "1f476": [
        ["\uD83D\uDC76"], "\uE51A", "\uDBB8\uDDA9", ["baby"], 15, 3
    ],
    "1f477": [
        ["\uD83D\uDC77"], "\uE51B", "\uDBB8\uDDAA", ["construction_worker"], 15, 4
    ],
    "1f478": [
        ["\uD83D\uDC78"], "\uE51C", "\uDBB8\uDDAB", ["princess"], 15, 5
    ],
    "1f479": [
        ["\uD83D\uDC79"], "", "\uDBB8\uDDAC", ["japanese_ogre"], 15, 6
    ],
    "1f47a": [
        ["\uD83D\uDC7A"], "", "\uDBB8\uDDAD", ["japanese_goblin"], 15, 7
    ],
    "1f47b": [
        ["\uD83D\uDC7B"], "\uE11B", "\uDBB8\uDDAE", ["ghost"], 15, 8
    ],
    "1f47c": [
        ["\uD83D\uDC7C"], "\uE04E", "\uDBB8\uDDAF", ["angel"], 15, 9
    ],
    "1f47d": [
        ["\uD83D\uDC7D"], "\uE10C", "\uDBB8\uDDB0", ["alien"], 15, 10
    ],
    "1f47e": [
        ["\uD83D\uDC7E"], "\uE12B", "\uDBB8\uDDB1", ["space_invader"], 15, 11
    ],
    "1f47f": [
        ["\uD83D\uDC7F"], "\uE11A", "\uDBB8\uDDB2", ["imp"], 15, 12
    ],
    "1f480": [
        ["\uD83D\uDC80"], "\uE11C", "\uDBB8\uDDB3", ["skull"], 15, 13
    ],
    "1f481": [
        ["\uD83D\uDC81"], "\uE253", "\uDBB8\uDDB4", ["information_desk_person"], 15, 14
    ],
    "1f482": [
        ["\uD83D\uDC82"], "\uE51E", "\uDBB8\uDDB5", ["guardsman"], 15, 15
    ],
    "1f483": [
        ["\uD83D\uDC83"], "\uE51F", "\uDBB8\uDDB6", ["dancer"], 15, 16
    ],
    "1f484": [
        ["\uD83D\uDC84"], "\uE31C", "\uDBB8\uDD95", ["lipstick"], 15, 17
    ],
    "1f485": [
        ["\uD83D\uDC85"], "\uE31D", "\uDBB8\uDD96", ["nail_care"], 15, 18
    ],
    "1f486": [
        ["\uD83D\uDC86"], "\uE31E", "\uDBB8\uDD97", ["massage"], 15, 19
    ],
    "1f487": [
        ["\uD83D\uDC87"], "\uE31F", "\uDBB8\uDD98", ["haircut"], 15, 20
    ],
    "1f488": [
        ["\uD83D\uDC88"], "\uE320", "\uDBB8\uDD99", ["barber"], 15, 21
    ],
    "1f489": [
        ["\uD83D\uDC89"], "\uE13B", "\uDBB9\uDD09", ["syringe"], 15, 22
    ],
    "1f48a": [
        ["\uD83D\uDC8A"], "\uE30F", "\uDBB9\uDD0A", ["pill"], 15, 23
    ],
    "1f48b": [
        ["\uD83D\uDC8B"], "\uE003", "\uDBBA\uDC23", ["kiss"], 15, 24
    ],
    "1f48c": [
        ["\uD83D\uDC8C"], "\uE103\uE328", "\uDBBA\uDC24", ["love_letter"], 15, 25
    ],
    "1f48d": [
        ["\uD83D\uDC8D"], "\uE034", "\uDBBA\uDC25", ["ring"], 15, 26
    ],
    "1f48e": [
        ["\uD83D\uDC8E"], "\uE035", "\uDBBA\uDC26", ["gem"], 15, 27
    ],
    "1f48f": [
        ["\uD83D\uDC8F"], "\uE111", "\uDBBA\uDC27", ["couplekiss"], 15, 28
    ],
    "1f490": [
        ["\uD83D\uDC90"], "\uE306", "\uDBBA\uDC28", ["bouquet"], 15, 29
    ],
    "1f491": [
        ["\uD83D\uDC91"], "\uE425", "\uDBBA\uDC29", ["couple_with_heart"], 16, 0
    ],
    "1f492": [
        ["\uD83D\uDC92"], "\uE43D", "\uDBBA\uDC2A", ["wedding"], 16, 1
    ],
    "1f493": [
        ["\uD83D\uDC93"], "\uE327", "\uDBBA\uDF0D", ["heartbeat"], 16, 2
    ],
    "1f494": [
        ["\uD83D\uDC94"], "\uE023", "\uDBBA\uDF0E", ["broken_heart"], 16, 3, "<\/3"
    ],
    "1f495": [
        ["\uD83D\uDC95"], "\uE327", "\uDBBA\uDF0F", ["two_hearts"], 16, 4
    ],
    "1f496": [
        ["\uD83D\uDC96"], "\uE327", "\uDBBA\uDF10", ["sparkling_heart"], 16, 5
    ],
    "1f497": [
        ["\uD83D\uDC97"], "\uE328", "\uDBBA\uDF11", ["heartpulse"], 16, 6
    ],
    "1f498": [
        ["\uD83D\uDC98"], "\uE329", "\uDBBA\uDF12", ["cupid"], 16, 7
    ],
    "1f499": [
        ["\uD83D\uDC99"], "\uE32A", "\uDBBA\uDF13", ["blue_heart"], 16, 8, "<3"
    ],
    "1f49a": [
        ["\uD83D\uDC9A"], "\uE32B", "\uDBBA\uDF14", ["green_heart"], 16, 9, "<3"
    ],
    "1f49b": [
        ["\uD83D\uDC9B"], "\uE32C", "\uDBBA\uDF15", ["yellow_heart"], 16, 10, "<3"
    ],
    "1f49c": [
        ["\uD83D\uDC9C"], "\uE32D", "\uDBBA\uDF16", ["purple_heart"], 16, 11, "<3"
    ],
    "1f49d": [
        ["\uD83D\uDC9D"], "\uE437", "\uDBBA\uDF17", ["gift_heart"], 16, 12
    ],
    "1f49e": [
        ["\uD83D\uDC9E"], "\uE327", "\uDBBA\uDF18", ["revolving_hearts"], 16, 13
    ],
    "1f49f": [
        ["\uD83D\uDC9F"], "\uE204", "\uDBBA\uDF19", ["heart_decoration"], 16, 14
    ],
    "1f4a0": [
        ["\uD83D\uDCA0"], "", "\uDBBA\uDF55", ["diamond_shape_with_a_dot_inside"], 16, 15
    ],
    "1f4a1": [
        ["\uD83D\uDCA1"], "\uE10F", "\uDBBA\uDF56", ["bulb"], 16, 16
    ],
    "1f4a2": [
        ["\uD83D\uDCA2"], "\uE334", "\uDBBA\uDF57", ["anger"], 16, 17
    ],
    "1f4a3": [
        ["\uD83D\uDCA3"], "\uE311", "\uDBBA\uDF58", ["bomb"], 16, 18
    ],
    "1f4a4": [
        ["\uD83D\uDCA4"], "\uE13C", "\uDBBA\uDF59", ["zzz"], 16, 19
    ],
    "1f4a5": [
        ["\uD83D\uDCA5"], "", "\uDBBA\uDF5A", ["boom", "collision"], 16, 20
    ],
    "1f4a6": [
        ["\uD83D\uDCA6"], "\uE331", "\uDBBA\uDF5B", ["sweat_drops"], 16, 21
    ],
    "1f4a7": [
        ["\uD83D\uDCA7"], "\uE331", "\uDBBA\uDF5C", ["droplet"], 16, 22
    ],
    "1f4a8": [
        ["\uD83D\uDCA8"], "\uE330", "\uDBBA\uDF5D", ["dash"], 16, 23
    ],
    "1f4a9": [
        ["\uD83D\uDCA9"], "\uE05A", "\uDBB9\uDCF4", ["hankey", "poop", "shit"], 16, 24
    ],
    "1f4aa": [
        ["\uD83D\uDCAA"], "\uE14C", "\uDBBA\uDF5E", ["muscle"], 16, 25
    ],
    "1f4ab": [
        ["\uD83D\uDCAB"], "\uE407", "\uDBBA\uDF5F", ["dizzy"], 16, 26
    ],
    "1f4ac": [
        ["\uD83D\uDCAC"], "", "\uDBB9\uDD32", ["speech_balloon"], 16, 27
    ],
    "1f4ad": [
        ["\uD83D\uDCAD"], "", "", ["thought_balloon"], 16, 28
    ],
    "1f4ae": [
        ["\uD83D\uDCAE"], "", "\uDBBA\uDF7A", ["white_flower"], 16, 29
    ],
    "1f4af": [
        ["\uD83D\uDCAF"], "", "\uDBBA\uDF7B", ["100"], 17, 0
    ],
    "1f4b0": [
        ["\uD83D\uDCB0"], "\uE12F", "\uDBB9\uDCDD", ["moneybag"], 17, 1
    ],
    "1f4b1": [
        ["\uD83D\uDCB1"], "\uE149", "\uDBB9\uDCDE", ["currency_exchange"], 17, 2
    ],
    "1f4b2": [
        ["\uD83D\uDCB2"], "\uE12F", "\uDBB9\uDCE0", ["heavy_dollar_sign"], 17, 3
    ],
    "1f4b3": [
        ["\uD83D\uDCB3"], "", "\uDBB9\uDCE1", ["credit_card"], 17, 4
    ],
    "1f4b4": [
        ["\uD83D\uDCB4"], "", "\uDBB9\uDCE2", ["yen"], 17, 5
    ],
    "1f4b5": [
        ["\uD83D\uDCB5"], "\uE12F", "\uDBB9\uDCE3", ["dollar"], 17, 6
    ],
    "1f4b6": [
        ["\uD83D\uDCB6"], "", "", ["euro"], 17, 7
    ],
    "1f4b7": [
        ["\uD83D\uDCB7"], "", "", ["pound"], 17, 8
    ],
    "1f4b8": [
        ["\uD83D\uDCB8"], "", "\uDBB9\uDCE4", ["money_with_wings"], 17, 9
    ],
    "1f4b9": [
        ["\uD83D\uDCB9"], "\uE14A", "\uDBB9\uDCDF", ["chart"], 17, 10
    ],
    "1f4ba": [
        ["\uD83D\uDCBA"], "\uE11F", "\uDBB9\uDD37", ["seat"], 17, 11
    ],
    "1f4bb": [
        ["\uD83D\uDCBB"], "\uE00C", "\uDBB9\uDD38", ["computer"], 17, 12
    ],
    "1f4bc": [
        ["\uD83D\uDCBC"], "\uE11E", "\uDBB9\uDD3B", ["briefcase"], 17, 13
    ],
    "1f4bd": [
        ["\uD83D\uDCBD"], "\uE316", "\uDBB9\uDD3C", ["minidisc"], 17, 14
    ],
    "1f4be": [
        ["\uD83D\uDCBE"], "\uE316", "\uDBB9\uDD3D", ["floppy_disk"], 17, 15
    ],
    "1f4bf": [
        ["\uD83D\uDCBF"], "\uE126", "\uDBBA\uDC1D", ["cd"], 17, 16
    ],
    "1f4c0": [
        ["\uD83D\uDCC0"], "\uE127", "\uDBBA\uDC1E", ["dvd"], 17, 17
    ],
    "1f4c1": [
        ["\uD83D\uDCC1"], "", "\uDBB9\uDD43", ["file_folder"], 17, 18
    ],
    "1f4c2": [
        ["\uD83D\uDCC2"], "", "\uDBB9\uDD44", ["open_file_folder"], 17, 19
    ],
    "1f4c3": [
        ["\uD83D\uDCC3"], "\uE301", "\uDBB9\uDD40", ["page_with_curl"], 17, 20
    ],
    "1f4c4": [
        ["\uD83D\uDCC4"], "\uE301", "\uDBB9\uDD41", ["page_facing_up"], 17, 21
    ],
    "1f4c5": [
        ["\uD83D\uDCC5"], "", "\uDBB9\uDD42", ["date"], 17, 22
    ],
    "1f4c6": [
        ["\uD83D\uDCC6"], "", "\uDBB9\uDD49", ["calendar"], 17, 23
    ],
    "1f4c7": [
        ["\uD83D\uDCC7"], "\uE148", "\uDBB9\uDD4D", ["card_index"], 17, 24
    ],
    "1f4c8": [
        ["\uD83D\uDCC8"], "\uE14A", "\uDBB9\uDD4B", ["chart_with_upwards_trend"], 17, 25
    ],
    "1f4c9": [
        ["\uD83D\uDCC9"], "", "\uDBB9\uDD4C", ["chart_with_downwards_trend"], 17, 26
    ],
    "1f4ca": [
        ["\uD83D\uDCCA"], "\uE14A", "\uDBB9\uDD4A", ["bar_chart"], 17, 27
    ],
    "1f4cb": [
        ["\uD83D\uDCCB"], "\uE301", "\uDBB9\uDD48", ["clipboard"], 17, 28
    ],
    "1f4cc": [
        ["\uD83D\uDCCC"], "", "\uDBB9\uDD4E", ["pushpin"], 17, 29
    ],
    "1f4cd": [
        ["\uD83D\uDCCD"], "", "\uDBB9\uDD3F", ["round_pushpin"], 18, 0
    ],
    "1f4ce": [
        ["\uD83D\uDCCE"], "", "\uDBB9\uDD3A", ["paperclip"], 18, 1
    ],
    "1f4cf": [
        ["\uD83D\uDCCF"], "", "\uDBB9\uDD50", ["straight_ruler"], 18, 2
    ],
    "1f4d0": [
        ["\uD83D\uDCD0"], "", "\uDBB9\uDD51", ["triangular_ruler"], 18, 3
    ],
    "1f4d1": [
        ["\uD83D\uDCD1"], "\uE301", "\uDBB9\uDD52", ["bookmark_tabs"], 18, 4
    ],
    "1f4d2": [
        ["\uD83D\uDCD2"], "\uE148", "\uDBB9\uDD4F", ["ledger"], 18, 5
    ],
    "1f4d3": [
        ["\uD83D\uDCD3"], "\uE148", "\uDBB9\uDD45", ["notebook"], 18, 6
    ],
    "1f4d4": [
        ["\uD83D\uDCD4"], "\uE148", "\uDBB9\uDD47", ["notebook_with_decorative_cover"], 18, 7
    ],
    "1f4d5": [
        ["\uD83D\uDCD5"], "\uE148", "\uDBB9\uDD02", ["closed_book"], 18, 8
    ],
    "1f4d6": [
        ["\uD83D\uDCD6"], "\uE148", "\uDBB9\uDD46", ["book", "open_book"], 18, 9
    ],
    "1f4d7": [
        ["\uD83D\uDCD7"], "\uE148", "\uDBB9\uDCFF", ["green_book"], 18, 10
    ],
    "1f4d8": [
        ["\uD83D\uDCD8"], "\uE148", "\uDBB9\uDD00", ["blue_book"], 18, 11
    ],
    "1f4d9": [
        ["\uD83D\uDCD9"], "\uE148", "\uDBB9\uDD01", ["orange_book"], 18, 12
    ],
    "1f4da": [
        ["\uD83D\uDCDA"], "\uE148", "\uDBB9\uDD03", ["books"], 18, 13
    ],
    "1f4db": [
        ["\uD83D\uDCDB"], "", "\uDBB9\uDD04", ["name_badge"], 18, 14
    ],
    "1f4dc": [
        ["\uD83D\uDCDC"], "", "\uDBB9\uDCFD", ["scroll"], 18, 15
    ],
    "1f4dd": [
        ["\uD83D\uDCDD"], "\uE301", "\uDBB9\uDD27", ["memo", "pencil"], 18, 16
    ],
    "1f4de": [
        ["\uD83D\uDCDE"], "\uE009", "\uDBB9\uDD24", ["telephone_receiver"], 18, 17
    ],
    "1f4df": [
        ["\uD83D\uDCDF"], "", "\uDBB9\uDD22", ["pager"], 18, 18
    ],
    "1f4e0": [
        ["\uD83D\uDCE0"], "\uE00B", "\uDBB9\uDD28", ["fax"], 18, 19
    ],
    "1f4e1": [
        ["\uD83D\uDCE1"], "\uE14B", "\uDBB9\uDD31", ["satellite"], 18, 20
    ],
    "1f4e2": [
        ["\uD83D\uDCE2"], "\uE142", "\uDBB9\uDD2F", ["loudspeaker"], 18, 21
    ],
    "1f4e3": [
        ["\uD83D\uDCE3"], "\uE317", "\uDBB9\uDD30", ["mega"], 18, 22
    ],
    "1f4e4": [
        ["\uD83D\uDCE4"], "", "\uDBB9\uDD33", ["outbox_tray"], 18, 23
    ],
    "1f4e5": [
        ["\uD83D\uDCE5"], "", "\uDBB9\uDD34", ["inbox_tray"], 18, 24
    ],
    "1f4e6": [
        ["\uD83D\uDCE6"], "\uE112", "\uDBB9\uDD35", ["package"], 18, 25
    ],
    "1f4e7": [
        ["\uD83D\uDCE7"], "\uE103", "\uDBBA\uDF92", ["e-mail"], 18, 26
    ],
    "1f4e8": [
        ["\uD83D\uDCE8"], "\uE103", "\uDBB9\uDD2A", ["incoming_envelope"], 18, 27
    ],
    "1f4e9": [
        ["\uD83D\uDCE9"], "\uE103", "\uDBB9\uDD2B", ["envelope_with_arrow"], 18, 28
    ],
    "1f4ea": [
        ["\uD83D\uDCEA"], "\uE101", "\uDBB9\uDD2C", ["mailbox_closed"], 18, 29
    ],
    "1f4eb": [
        ["\uD83D\uDCEB"], "\uE101", "\uDBB9\uDD2D", ["mailbox"], 19, 0
    ],
    "1f4ec": [
        ["\uD83D\uDCEC"], "", "", ["mailbox_with_mail"], 19, 1
    ],
    "1f4ed": [
        ["\uD83D\uDCED"], "", "", ["mailbox_with_no_mail"], 19, 2
    ],
    "1f4ee": [
        ["\uD83D\uDCEE"], "\uE102", "\uDBB9\uDD2E", ["postbox"], 19, 3
    ],
    "1f4ef": [
        ["\uD83D\uDCEF"], "", "", ["postal_horn"], 19, 4
    ],
    "1f4f0": [
        ["\uD83D\uDCF0"], "", "\uDBBA\uDC22", ["newspaper"], 19, 5
    ],
    "1f4f1": [
        ["\uD83D\uDCF1"], "\uE00A", "\uDBB9\uDD25", ["iphone"], 19, 6
    ],
    "1f4f2": [
        ["\uD83D\uDCF2"], "\uE104", "\uDBB9\uDD26", ["calling"], 19, 7
    ],
    "1f4f3": [
        ["\uD83D\uDCF3"], "\uE250", "\uDBBA\uDC39", ["vibration_mode"], 19, 8
    ],
    "1f4f4": [
        ["\uD83D\uDCF4"], "\uE251", "\uDBBA\uDC3A", ["mobile_phone_off"], 19, 9
    ],
    "1f4f5": [
        ["\uD83D\uDCF5"], "", "", ["no_mobile_phones"], 19, 10
    ],
    "1f4f6": [
        ["\uD83D\uDCF6"], "\uE20B", "\uDBBA\uDC38", ["signal_strength"], 19, 11
    ],
    "1f4f7": [
        ["\uD83D\uDCF7"], "\uE008", "\uDBB9\uDCEF", ["camera"], 19, 12
    ],
    "1f4f9": [
        ["\uD83D\uDCF9"], "\uE03D", "\uDBB9\uDCF9", ["video_camera"], 19, 13
    ],
    "1f4fa": [
        ["\uD83D\uDCFA"], "\uE12A", "\uDBBA\uDC1C", ["tv"], 19, 14
    ],
    "1f4fb": [
        ["\uD83D\uDCFB"], "\uE128", "\uDBBA\uDC1F", ["radio"], 19, 15
    ],
    "1f4fc": [
        ["\uD83D\uDCFC"], "\uE129", "\uDBBA\uDC20", ["vhs"], 19, 16
    ],
    "1f500": [
        ["\uD83D\uDD00"], "", "", ["twisted_rightwards_arrows"], 19, 17
    ],
    "1f501": [
        ["\uD83D\uDD01"], "", "", ["repeat"], 19, 18
    ],
    "1f502": [
        ["\uD83D\uDD02"], "", "", ["repeat_one"], 19, 19
    ],
    "1f503": [
        ["\uD83D\uDD03"], "", "\uDBBA\uDF91", ["arrows_clockwise"], 19, 20
    ],
    "1f504": [
        ["\uD83D\uDD04"], "", "", ["arrows_counterclockwise"], 19, 21
    ],
    "1f505": [
        ["\uD83D\uDD05"], "", "", ["low_brightness"], 19, 22
    ],
    "1f506": [
        ["\uD83D\uDD06"], "", "", ["high_brightness"], 19, 23
    ],
    "1f507": [
        ["\uD83D\uDD07"], "", "", ["mute"], 19, 24
    ],
    "1f508": [
        ["\uD83D\uDD08"], "", "", ["speaker"], 19, 25
    ],
    "1f509": [
        ["\uD83D\uDD09"], "", "", ["sound"], 19, 26
    ],
    "1f50a": [
        ["\uD83D\uDD0A"], "\uE141", "\uDBBA\uDC21", ["loud_sound"], 19, 27
    ],
    "1f50b": [
        ["\uD83D\uDD0B"], "", "\uDBB9\uDCFC", ["battery"], 19, 28
    ],
    "1f50c": [
        ["\uD83D\uDD0C"], "", "\uDBB9\uDCFE", ["electric_plug"], 19, 29
    ],
    "1f50d": [
        ["\uD83D\uDD0D"], "\uE114", "\uDBBA\uDF85", ["mag"], 20, 0
    ],
    "1f50e": [
        ["\uD83D\uDD0E"], "\uE114", "\uDBBA\uDF8D", ["mag_right"], 20, 1
    ],
    "1f50f": [
        ["\uD83D\uDD0F"], "\uE144", "\uDBBA\uDF90", ["lock_with_ink_pen"], 20, 2
    ],
    "1f510": [
        ["\uD83D\uDD10"], "\uE144", "\uDBBA\uDF8A", ["closed_lock_with_key"], 20, 3
    ],
    "1f511": [
        ["\uD83D\uDD11"], "\uE03F", "\uDBBA\uDF82", ["key"], 20, 4
    ],
    "1f512": [
        ["\uD83D\uDD12"], "\uE144", "\uDBBA\uDF86", ["lock"], 20, 5
    ],
    "1f513": [
        ["\uD83D\uDD13"], "\uE145", "\uDBBA\uDF87", ["unlock"], 20, 6
    ],
    "1f514": [
        ["\uD83D\uDD14"], "\uE325", "\uDBB9\uDCF2", ["bell"], 20, 7
    ],
    "1f515": [
        ["\uD83D\uDD15"], "", "", ["no_bell"], 20, 8
    ],
    "1f516": [
        ["\uD83D\uDD16"], "", "\uDBBA\uDF8F", ["bookmark"], 20, 9
    ],
    "1f517": [
        ["\uD83D\uDD17"], "", "\uDBBA\uDF4B", ["link"], 20, 10
    ],
    "1f518": [
        ["\uD83D\uDD18"], "", "\uDBBA\uDF8C", ["radio_button"], 20, 11
    ],
    "1f519": [
        ["\uD83D\uDD19"], "\uE235", "\uDBBA\uDF8E", ["back"], 20, 12
    ],
    "1f51a": [
        ["\uD83D\uDD1A"], "", "\uDBB8\uDC1A", ["end"], 20, 13
    ],
    "1f51b": [
        ["\uD83D\uDD1B"], "", "\uDBB8\uDC19", ["on"], 20, 14
    ],
    "1f51c": [
        ["\uD83D\uDD1C"], "", "\uDBB8\uDC18", ["soon"], 20, 15
    ],
    "1f51d": [
        ["\uD83D\uDD1D"], "\uE24C", "\uDBBA\uDF42", ["top"], 20, 16
    ],
    "1f51e": [
        ["\uD83D\uDD1E"], "\uE207", "\uDBBA\uDF25", ["underage"], 20, 17
    ],
    "1f51f": [
        ["\uD83D\uDD1F"], "", "\uDBBA\uDC3B", ["keycap_ten"], 20, 18
    ],
    "1f520": [
        ["\uD83D\uDD20"], "", "\uDBBA\uDF7C", ["capital_abcd"], 20, 19
    ],
    "1f521": [
        ["\uD83D\uDD21"], "", "\uDBBA\uDF7D", ["abcd"], 20, 20
    ],
    "1f522": [
        ["\uD83D\uDD22"], "", "\uDBBA\uDF7E", ["1234"], 20, 21
    ],
    "1f523": [
        ["\uD83D\uDD23"], "", "\uDBBA\uDF7F", ["symbols"], 20, 22
    ],
    "1f524": [
        ["\uD83D\uDD24"], "", "\uDBBA\uDF80", ["abc"], 20, 23
    ],
    "1f525": [
        ["\uD83D\uDD25"], "\uE11D", "\uDBB9\uDCF6", ["fire"], 20, 24
    ],
    "1f526": [
        ["\uD83D\uDD26"], "", "\uDBB9\uDCFB", ["flashlight"], 20, 25
    ],
    "1f527": [
        ["\uD83D\uDD27"], "", "\uDBB9\uDCC9", ["wrench"], 20, 26
    ],
    "1f528": [
        ["\uD83D\uDD28"], "\uE116", "\uDBB9\uDCCA", ["hammer"], 20, 27
    ],
    "1f529": [
        ["\uD83D\uDD29"], "", "\uDBB9\uDCCB", ["nut_and_bolt"], 20, 28
    ],
    "1f52a": [
        ["\uD83D\uDD2A"], "", "\uDBB9\uDCFA", ["hocho", "knife"], 20, 29
    ],
    "1f52b": [
        ["\uD83D\uDD2B"], "\uE113", "\uDBB9\uDCF5", ["gun"], 21, 0
    ],
    "1f52c": [
        ["\uD83D\uDD2C"], "", "", ["microscope"], 21, 1
    ],
    "1f52d": [
        ["\uD83D\uDD2D"], "", "", ["telescope"], 21, 2
    ],
    "1f52e": [
        ["\uD83D\uDD2E"], "\uE23E", "\uDBB9\uDCF7", ["crystal_ball"], 21, 3
    ],
    "1f52f": [
        ["\uD83D\uDD2F"], "\uE23E", "\uDBB9\uDCF8", ["six_pointed_star"], 21, 4
    ],
    "1f530": [
        ["\uD83D\uDD30"], "\uE209", "\uDBB8\uDC44", ["beginner"], 21, 5
    ],
    "1f531": [
        ["\uD83D\uDD31"], "\uE031", "\uDBB9\uDCD2", ["trident"], 21, 6
    ],
    "1f532": [
        ["\uD83D\uDD32"], "\uE21A", "\uDBBA\uDF64", ["black_square_button"], 21, 7
    ],
    "1f533": [
        ["\uD83D\uDD33"], "\uE21B", "\uDBBA\uDF67", ["white_square_button"], 21, 8
    ],
    "1f534": [
        ["\uD83D\uDD34"], "\uE219", "\uDBBA\uDF63", ["red_circle"], 21, 9
    ],
    "1f535": [
        ["\uD83D\uDD35"], "\uE21A", "\uDBBA\uDF64", ["large_blue_circle"], 21, 10
    ],
    "1f536": [
        ["\uD83D\uDD36"], "\uE21B", "\uDBBA\uDF73", ["large_orange_diamond"], 21, 11
    ],
    "1f537": [
        ["\uD83D\uDD37"], "\uE21B", "\uDBBA\uDF74", ["large_blue_diamond"], 21, 12
    ],
    "1f538": [
        ["\uD83D\uDD38"], "\uE21B", "\uDBBA\uDF75", ["small_orange_diamond"], 21, 13
    ],
    "1f539": [
        ["\uD83D\uDD39"], "\uE21B", "\uDBBA\uDF76", ["small_blue_diamond"], 21, 14
    ],
    "1f53a": [
        ["\uD83D\uDD3A"], "", "\uDBBA\uDF78", ["small_red_triangle"], 21, 15
    ],
    "1f53b": [
        ["\uD83D\uDD3B"], "", "\uDBBA\uDF79", ["small_red_triangle_down"], 21, 16
    ],
    "1f53c": [
        ["\uD83D\uDD3C"], "", "\uDBBA\uDF01", ["arrow_up_small"], 21, 17
    ],
    "1f53d": [
        ["\uD83D\uDD3D"], "", "\uDBBA\uDF00", ["arrow_down_small"], 21, 18
    ],
    "1f550": [
        ["\uD83D\uDD50"], "\uE024", "\uDBB8\uDC1E", ["clock1"], 21, 19
    ],
    "1f551": [
        ["\uD83D\uDD51"], "\uE025", "\uDBB8\uDC1F", ["clock2"], 21, 20
    ],
    "1f552": [
        ["\uD83D\uDD52"], "\uE026", "\uDBB8\uDC20", ["clock3"], 21, 21
    ],
    "1f553": [
        ["\uD83D\uDD53"], "\uE027", "\uDBB8\uDC21", ["clock4"], 21, 22
    ],
    "1f554": [
        ["\uD83D\uDD54"], "\uE028", "\uDBB8\uDC22", ["clock5"], 21, 23
    ],
    "1f555": [
        ["\uD83D\uDD55"], "\uE029", "\uDBB8\uDC23", ["clock6"], 21, 24
    ],
    "1f556": [
        ["\uD83D\uDD56"], "\uE02A", "\uDBB8\uDC24", ["clock7"], 21, 25
    ],
    "1f557": [
        ["\uD83D\uDD57"], "\uE02B", "\uDBB8\uDC25", ["clock8"], 21, 26
    ],
    "1f558": [
        ["\uD83D\uDD58"], "\uE02C", "\uDBB8\uDC26", ["clock9"], 21, 27
    ],
    "1f559": [
        ["\uD83D\uDD59"], "\uE02D", "\uDBB8\uDC27", ["clock10"], 21, 28
    ],
    "1f55a": [
        ["\uD83D\uDD5A"], "\uE02E", "\uDBB8\uDC28", ["clock11"], 21, 29
    ],
    "1f55b": [
        ["\uD83D\uDD5B"], "\uE02F", "\uDBB8\uDC29", ["clock12"], 22, 0
    ],
    "1f55c": [
        ["\uD83D\uDD5C"], "", "", ["clock130"], 22, 1
    ],
    "1f55d": [
        ["\uD83D\uDD5D"], "", "", ["clock230"], 22, 2
    ],
    "1f55e": [
        ["\uD83D\uDD5E"], "", "", ["clock330"], 22, 3
    ],
    "1f55f": [
        ["\uD83D\uDD5F"], "", "", ["clock430"], 22, 4
    ],
    "1f560": [
        ["\uD83D\uDD60"], "", "", ["clock530"], 22, 5
    ],
    "1f561": [
        ["\uD83D\uDD61"], "", "", ["clock630"], 22, 6
    ],
    "1f562": [
        ["\uD83D\uDD62"], "", "", ["clock730"], 22, 7
    ],
    "1f563": [
        ["\uD83D\uDD63"], "", "", ["clock830"], 22, 8
    ],
    "1f564": [
        ["\uD83D\uDD64"], "", "", ["clock930"], 22, 9
    ],
    "1f565": [
        ["\uD83D\uDD65"], "", "", ["clock1030"], 22, 10
    ],
    "1f566": [
        ["\uD83D\uDD66"], "", "", ["clock1130"], 22, 11
    ],
    "1f567": [
        ["\uD83D\uDD67"], "", "", ["clock1230"], 22, 12
    ],
    "1f5fb": [
        ["\uD83D\uDDFB"], "\uE03B", "\uDBB9\uDCC3", ["mount_fuji"], 22, 13
    ],
    "1f5fc": [
        ["\uD83D\uDDFC"], "\uE509", "\uDBB9\uDCC4", ["tokyo_tower"], 22, 14
    ],
    "1f5fd": [
        ["\uD83D\uDDFD"], "\uE51D", "\uDBB9\uDCC6", ["statue_of_liberty"], 22, 15
    ],
    "1f5fe": [
        ["\uD83D\uDDFE"], "", "\uDBB9\uDCC7", ["japan"], 22, 16
    ],
    "1f5ff": [
        ["\uD83D\uDDFF"], "", "\uDBB9\uDCC8", ["moyai"], 22, 17
    ],
    "1f600": [
        ["\uD83D\uDE00"], "", "", ["grinning"], 22, 18, ":D"
    ],
    "1f601": [
        ["\uD83D\uDE01"], "\uE404", "\uDBB8\uDF33", ["grin"], 22, 19
    ],
    "1f602": [
        ["\uD83D\uDE02"], "\uE412", "\uDBB8\uDF34", ["joy"], 22, 20
    ],
    "1f603": [
        ["\uD83D\uDE03"], "\uE057", "\uDBB8\uDF30", ["smiley"], 22, 21, ":)"
    ],
    "1f604": [
        ["\uD83D\uDE04"], "\uE415", "\uDBB8\uDF38", ["smile"], 22, 22, ":)"
    ],
    "1f605": [
        ["\uD83D\uDE05"], "\uE415\uE331", "\uDBB8\uDF31", ["sweat_smile"], 22, 23
    ],
    "1f606": [
        ["\uD83D\uDE06"], "\uE40A", "\uDBB8\uDF32", ["satisfied"], 22, 24
    ],
    "1f607": [
        ["\uD83D\uDE07"], "", "", ["innocent"], 22, 25
    ],
    "1f608": [
        ["\uD83D\uDE08"], "", "", ["smiling_imp"], 22, 26
    ],
    "1f609": [
        ["\uD83D\uDE09"], "\uE405", "\uDBB8\uDF47", ["wink"], 22, 27, ";)"
    ],
    "1f60a": [
        ["\uD83D\uDE0A"], "\uE056", "\uDBB8\uDF35", ["blush"], 22, 28
    ],
    "1f60b": [
        ["\uD83D\uDE0B"], "\uE056", "\uDBB8\uDF2B", ["yum"], 22, 29
    ],
    "1f60c": [
        ["\uD83D\uDE0C"], "\uE40A", "\uDBB8\uDF3E", ["relieved"], 23, 0
    ],
    "1f60d": [
        ["\uD83D\uDE0D"], "\uE106", "\uDBB8\uDF27", ["heart_eyes"], 23, 1
    ],
    "1f60e": [
        ["\uD83D\uDE0E"], "", "", ["sunglasses"], 23, 2
    ],
    "1f60f": [
        ["\uD83D\uDE0F"], "\uE402", "\uDBB8\uDF43", ["smirk"], 23, 3
    ],
    "1f610": [
        ["\uD83D\uDE10"], "", "", ["neutral_face"], 23, 4
    ],
    "1f611": [
        ["\uD83D\uDE11"], "", "", ["expressionless"], 23, 5
    ],
    "1f612": [
        ["\uD83D\uDE12"], "\uE40E", "\uDBB8\uDF26", ["unamused"], 23, 6
    ],
    "1f613": [
        ["\uD83D\uDE13"], "\uE108", "\uDBB8\uDF44", ["sweat"], 23, 7
    ],
    "1f614": [
        ["\uD83D\uDE14"], "\uE403", "\uDBB8\uDF40", ["pensive"], 23, 8
    ],
    "1f615": [
        ["\uD83D\uDE15"], "", "", ["confused"], 23, 9
    ],
    "1f616": [
        ["\uD83D\uDE16"], "\uE407", "\uDBB8\uDF3F", ["confounded"], 23, 10
    ],
    "1f617": [
        ["\uD83D\uDE17"], "", "", ["kissing"], 23, 11
    ],
    "1f618": [
        ["\uD83D\uDE18"], "\uE418", "\uDBB8\uDF2C", ["kissing_heart"], 23, 12
    ],
    "1f619": [
        ["\uD83D\uDE19"], "", "", ["kissing_smiling_eyes"], 23, 13
    ],
    "1f61a": [
        ["\uD83D\uDE1A"], "\uE417", "\uDBB8\uDF2D", ["kissing_closed_eyes"], 23, 14
    ],
    "1f61b": [
        ["\uD83D\uDE1B"], "", "", ["stuck_out_tongue"], 23, 15, ":p"
    ],
    "1f61c": [
        ["\uD83D\uDE1C"], "\uE105", "\uDBB8\uDF29", ["stuck_out_tongue_winking_eye"], 23, 16, ";p"
    ],
    "1f61d": [
        ["\uD83D\uDE1D"], "\uE409", "\uDBB8\uDF2A", ["stuck_out_tongue_closed_eyes"], 23, 17
    ],
    "1f61e": [
        ["\uD83D\uDE1E"], "\uE058", "\uDBB8\uDF23", ["disappointed"], 23, 18, ":("
    ],
    "1f61f": [
        ["\uD83D\uDE1F"], "", "", ["worried"], 23, 19
    ],
    "1f620": [
        ["\uD83D\uDE20"], "\uE059", "\uDBB8\uDF20", ["angry"], 23, 20
    ],
    "1f621": [
        ["\uD83D\uDE21"], "\uE416", "\uDBB8\uDF3D", ["rage"], 23, 21
    ],
    "1f622": [
        ["\uD83D\uDE22"], "\uE413", "\uDBB8\uDF39", ["cry"], 23, 22, ":'("
    ],
    "1f623": [
        ["\uD83D\uDE23"], "\uE406", "\uDBB8\uDF3C", ["persevere"], 23, 23
    ],
    "1f624": [
        ["\uD83D\uDE24"], "\uE404", "\uDBB8\uDF28", ["triumph"], 23, 24
    ],
    "1f625": [
        ["\uD83D\uDE25"], "\uE401", "\uDBB8\uDF45", ["disappointed_relieved"], 23, 25
    ],
    "1f626": [
        ["\uD83D\uDE26"], "", "", ["frowning"], 23, 26
    ],
    "1f627": [
        ["\uD83D\uDE27"], "", "", ["anguished"], 23, 27
    ],
    "1f628": [
        ["\uD83D\uDE28"], "\uE40B", "\uDBB8\uDF3B", ["fearful"], 23, 28
    ],
    "1f629": [
        ["\uD83D\uDE29"], "\uE403", "\uDBB8\uDF21", ["weary"], 23, 29
    ],
    "1f62a": [
        ["\uD83D\uDE2A"], "\uE408", "\uDBB8\uDF42", ["sleepy"], 24, 0
    ],
    "1f62b": [
        ["\uD83D\uDE2B"], "\uE406", "\uDBB8\uDF46", ["tired_face"], 24, 1
    ],
    "1f62c": [
        ["\uD83D\uDE2C"], "", "", ["grimacing"], 24, 2
    ],
    "1f62d": [
        ["\uD83D\uDE2D"], "\uE411", "\uDBB8\uDF3A", ["sob"], 24, 3, ":'("
    ],
    "1f62e": [
        ["\uD83D\uDE2E"], "", "", ["open_mouth"], 24, 4
    ],
    "1f62f": [
        ["\uD83D\uDE2F"], "", "", ["hushed"], 24, 5
    ],
    "1f630": [
        ["\uD83D\uDE30"], "\uE40F", "\uDBB8\uDF25", ["cold_sweat"], 24, 6
    ],
    "1f631": [
        ["\uD83D\uDE31"], "\uE107", "\uDBB8\uDF41", ["scream"], 24, 7
    ],
    "1f632": [
        ["\uD83D\uDE32"], "\uE410", "\uDBB8\uDF22", ["astonished"], 24, 8
    ],
    "1f633": [
        ["\uD83D\uDE33"], "\uE40D", "\uDBB8\uDF2F", ["flushed"], 24, 9
    ],
    "1f634": [
        ["\uD83D\uDE34"], "", "", ["sleeping"], 24, 10
    ],
    "1f635": [
        ["\uD83D\uDE35"], "\uE406", "\uDBB8\uDF24", ["dizzy_face"], 24, 11
    ],
    "1f636": [
        ["\uD83D\uDE36"], "", "", ["no_mouth"], 24, 12
    ],
    "1f637": [
        ["\uD83D\uDE37"], "\uE40C", "\uDBB8\uDF2E", ["mask"], 24, 13
    ],
    "1f638": [
        ["\uD83D\uDE38"], "\uE404", "\uDBB8\uDF49", ["smile_cat"], 24, 14
    ],
    "1f639": [
        ["\uD83D\uDE39"], "\uE412", "\uDBB8\uDF4A", ["joy_cat"], 24, 15
    ],
    "1f63a": [
        ["\uD83D\uDE3A"], "\uE057", "\uDBB8\uDF48", ["smiley_cat"], 24, 16
    ],
    "1f63b": [
        ["\uD83D\uDE3B"], "\uE106", "\uDBB8\uDF4C", ["heart_eyes_cat"], 24, 17
    ],
    "1f63c": [
        ["\uD83D\uDE3C"], "\uE404", "\uDBB8\uDF4F", ["smirk_cat"], 24, 18
    ],
    "1f63d": [
        ["\uD83D\uDE3D"], "\uE418", "\uDBB8\uDF4B", ["kissing_cat"], 24, 19
    ],
    "1f63e": [
        ["\uD83D\uDE3E"], "\uE416", "\uDBB8\uDF4E", ["pouting_cat"], 24, 20
    ],
    "1f63f": [
        ["\uD83D\uDE3F"], "\uE413", "\uDBB8\uDF4D", ["crying_cat_face"], 24, 21
    ],
    "1f640": [
        ["\uD83D\uDE40"], "\uE403", "\uDBB8\uDF50", ["scream_cat"], 24, 22
    ],
    "1f645": [
        ["\uD83D\uDE45"], "\uE423", "\uDBB8\uDF51", ["no_good"], 24, 23
    ],
    "1f646": [
        ["\uD83D\uDE46"], "\uE424", "\uDBB8\uDF52", ["ok_woman"], 24, 24
    ],
    "1f647": [
        ["\uD83D\uDE47"], "\uE426", "\uDBB8\uDF53", ["bow"], 24, 25
    ],
    "1f648": [
        ["\uD83D\uDE48"], "", "\uDBB8\uDF54", ["see_no_evil"], 24, 26
    ],
    "1f649": [
        ["\uD83D\uDE49"], "", "\uDBB8\uDF56", ["hear_no_evil"], 24, 27
    ],
    "1f64a": [
        ["\uD83D\uDE4A"], "", "\uDBB8\uDF55", ["speak_no_evil"], 24, 28
    ],
    "1f64b": [
        ["\uD83D\uDE4B"], "\uE012", "\uDBB8\uDF57", ["raising_hand"], 24, 29
    ],
    "1f64c": [
        ["\uD83D\uDE4C"], "\uE427", "\uDBB8\uDF58", ["raised_hands"], 25, 0
    ],
    "1f64d": [
        ["\uD83D\uDE4D"], "\uE403", "\uDBB8\uDF59", ["person_frowning"], 25, 1
    ],
    "1f64e": [
        ["\uD83D\uDE4E"], "\uE416", "\uDBB8\uDF5A", ["person_with_pouting_face"], 25, 2
    ],
    "1f64f": [
        ["\uD83D\uDE4F"], "\uE41D", "\uDBB8\uDF5B", ["pray"], 25, 3
    ],
    "1f680": [
        ["\uD83D\uDE80"], "\uE10D", "\uDBB9\uDFED", ["rocket"], 25, 4
    ],
    "1f681": [
        ["\uD83D\uDE81"], "", "", ["helicopter"], 25, 5
    ],
    "1f682": [
        ["\uD83D\uDE82"], "", "", ["steam_locomotive"], 25, 6
    ],
    "1f683": [
        ["\uD83D\uDE83"], "\uE01E", "\uDBB9\uDFDF", ["railway_car"], 25, 7
    ],
    "1f684": [
        ["\uD83D\uDE84"], "\uE435", "\uDBB9\uDFE2", ["bullettrain_side"], 25, 8
    ],
    "1f685": [
        ["\uD83D\uDE85"], "\uE01F", "\uDBB9\uDFE3", ["bullettrain_front"], 25, 9
    ],
    "1f686": [
        ["\uD83D\uDE86"], "", "", ["train2"], 25, 10
    ],
    "1f687": [
        ["\uD83D\uDE87"], "\uE434", "\uDBB9\uDFE0", ["metro"], 25, 11
    ],
    "1f688": [
        ["\uD83D\uDE88"], "", "", ["light_rail"], 25, 12
    ],
    "1f689": [
        ["\uD83D\uDE89"], "\uE039", "\uDBB9\uDFEC", ["station"], 25, 13
    ],
    "1f68a": [
        ["\uD83D\uDE8A"], "", "", ["tram"], 25, 14
    ],
    "1f68b": [
        ["\uD83D\uDE8B"], "", "", ["train"], 25, 15
    ],
    "1f68c": [
        ["\uD83D\uDE8C"], "\uE159", "\uDBB9\uDFE6", ["bus"], 25, 16
    ],
    "1f68d": [
        ["\uD83D\uDE8D"], "", "", ["oncoming_bus"], 25, 17
    ],
    "1f68e": [
        ["\uD83D\uDE8E"], "", "", ["trolleybus"], 25, 18
    ],
    "1f68f": [
        ["\uD83D\uDE8F"], "\uE150", "\uDBB9\uDFE7", ["busstop"], 25, 19
    ],
    "1f690": [
        ["\uD83D\uDE90"], "", "", ["minibus"], 25, 20
    ],
    "1f691": [
        ["\uD83D\uDE91"], "\uE431", "\uDBB9\uDFF3", ["ambulance"], 25, 21
    ],
    "1f692": [
        ["\uD83D\uDE92"], "\uE430", "\uDBB9\uDFF2", ["fire_engine"], 25, 22
    ],
    "1f693": [
        ["\uD83D\uDE93"], "\uE432", "\uDBB9\uDFF4", ["police_car"], 25, 23
    ],
    "1f694": [
        ["\uD83D\uDE94"], "", "", ["oncoming_police_car"], 25, 24
    ],
    "1f695": [
        ["\uD83D\uDE95"], "\uE15A", "\uDBB9\uDFEF", ["taxi"], 25, 25
    ],
    "1f696": [
        ["\uD83D\uDE96"], "", "", ["oncoming_taxi"], 25, 26
    ],
    "1f697": [
        ["\uD83D\uDE97"], "\uE01B", "\uDBB9\uDFE4", ["car", "red_car"], 25, 27
    ],
    "1f698": [
        ["\uD83D\uDE98"], "", "", ["oncoming_automobile"], 25, 28
    ],
    "1f699": [
        ["\uD83D\uDE99"], "\uE42E", "\uDBB9\uDFE5", ["blue_car"], 25, 29
    ],
    "1f69a": [
        ["\uD83D\uDE9A"], "\uE42F", "\uDBB9\uDFF1", ["truck"], 26, 0
    ],
    "1f69b": [
        ["\uD83D\uDE9B"], "", "", ["articulated_lorry"], 26, 1
    ],
    "1f69c": [
        ["\uD83D\uDE9C"], "", "", ["tractor"], 26, 2
    ],
    "1f69d": [
        ["\uD83D\uDE9D"], "", "", ["monorail"], 26, 3
    ],
    "1f69e": [
        ["\uD83D\uDE9E"], "", "", ["mountain_railway"], 26, 4
    ],
    "1f69f": [
        ["\uD83D\uDE9F"], "", "", ["suspension_railway"], 26, 5
    ],
    "1f6a0": [
        ["\uD83D\uDEA0"], "", "", ["mountain_cableway"], 26, 6
    ],
    "1f6a1": [
        ["\uD83D\uDEA1"], "", "", ["aerial_tramway"], 26, 7
    ],
    "1f6a2": [
        ["\uD83D\uDEA2"], "\uE202", "\uDBB9\uDFE8", ["ship"], 26, 8
    ],
    "1f6a3": [
        ["\uD83D\uDEA3"], "", "", ["rowboat"], 26, 9
    ],
    "1f6a4": [
        ["\uD83D\uDEA4"], "\uE135", "\uDBB9\uDFEE", ["speedboat"], 26, 10
    ],
    "1f6a5": [
        ["\uD83D\uDEA5"], "\uE14E", "\uDBB9\uDFF7", ["traffic_light"], 26, 11
    ],
    "1f6a6": [
        ["\uD83D\uDEA6"], "", "", ["vertical_traffic_light"], 26, 12
    ],
    "1f6a7": [
        ["\uD83D\uDEA7"], "\uE137", "\uDBB9\uDFF8", ["construction"], 26, 13
    ],
    "1f6a8": [
        ["\uD83D\uDEA8"], "\uE432", "\uDBB9\uDFF9", ["rotating_light"], 26, 14
    ],
    "1f6a9": [
        ["\uD83D\uDEA9"], "", "\uDBBA\uDF22", ["triangular_flag_on_post"], 26, 15
    ],
    "1f6aa": [
        ["\uD83D\uDEAA"], "", "\uDBB9\uDCF3", ["door"], 26, 16
    ],
    "1f6ab": [
        ["\uD83D\uDEAB"], "", "\uDBBA\uDF48", ["no_entry_sign"], 26, 17
    ],
    "1f6ac": [
        ["\uD83D\uDEAC"], "\uE30E", "\uDBBA\uDF1E", ["smoking"], 26, 18
    ],
    "1f6ad": [
        ["\uD83D\uDEAD"], "\uE208", "\uDBBA\uDF1F", ["no_smoking"], 26, 19
    ],
    "1f6ae": [
        ["\uD83D\uDEAE"], "", "", ["put_litter_in_its_place"], 26, 20
    ],
    "1f6af": [
        ["\uD83D\uDEAF"], "", "", ["do_not_litter"], 26, 21
    ],
    "1f6b0": [
        ["\uD83D\uDEB0"], "", "", ["potable_water"], 26, 22
    ],
    "1f6b1": [
        ["\uD83D\uDEB1"], "", "", ["non-potable_water"], 26, 23
    ],
    "1f6b2": [
        ["\uD83D\uDEB2"], "\uE136", "\uDBB9\uDFEB", ["bike"], 26, 24
    ],
    "1f6b3": [
        ["\uD83D\uDEB3"], "", "", ["no_bicycles"], 26, 25
    ],
    "1f6b4": [
        ["\uD83D\uDEB4"], "", "", ["bicyclist"], 26, 26
    ],
    "1f6b5": [
        ["\uD83D\uDEB5"], "", "", ["mountain_bicyclist"], 26, 27
    ],
    "1f6b6": [
        ["\uD83D\uDEB6"], "\uE201", "\uDBB9\uDFF0", ["walking"], 26, 28
    ],
    "1f6b7": [
        ["\uD83D\uDEB7"], "", "", ["no_pedestrians"], 26, 29
    ],
    "1f6b8": [
        ["\uD83D\uDEB8"], "", "", ["children_crossing"], 27, 0
    ],
    "1f6b9": [
        ["\uD83D\uDEB9"], "\uE138", "\uDBBA\uDF33", ["mens"], 27, 1
    ],
    "1f6ba": [
        ["\uD83D\uDEBA"], "\uE139", "\uDBBA\uDF34", ["womens"], 27, 2
    ],
    "1f6bb": [
        ["\uD83D\uDEBB"], "\uE151", "\uDBB9\uDD06", ["restroom"], 27, 3
    ],
    "1f6bc": [
        ["\uD83D\uDEBC"], "\uE13A", "\uDBBA\uDF35", ["baby_symbol"], 27, 4
    ],
    "1f6bd": [
        ["\uD83D\uDEBD"], "\uE140", "\uDBB9\uDD07", ["toilet"], 27, 5
    ],
    "1f6be": [
        ["\uD83D\uDEBE"], "\uE309", "\uDBB9\uDD08", ["wc"], 27, 6
    ],
    "1f6bf": [
        ["\uD83D\uDEBF"], "", "", ["shower"], 27, 7
    ],
    "1f6c0": [
        ["\uD83D\uDEC0"], "\uE13F", "\uDBB9\uDD05", ["bath"], 27, 8
    ],
    "1f6c1": [
        ["\uD83D\uDEC1"], "", "", ["bathtub"], 27, 9
    ],
    "1f6c2": [
        ["\uD83D\uDEC2"], "", "", ["passport_control"], 27, 10
    ],
    "1f6c3": [
        ["\uD83D\uDEC3"], "", "", ["customs"], 27, 11
    ],
    "1f6c4": [
        ["\uD83D\uDEC4"], "", "", ["baggage_claim"], 27, 12
    ],
    "1f6c5": [
        ["\uD83D\uDEC5"], "", "", ["left_luggage"], 27, 13
    ],
    "0023-20e3": [
        ["\u0023\uFE0F\u20E3", "\u0023\u20E3"], "\uE210", "\uDBBA\uDC2C", ["hash"], 27, 14
    ],
    "0030-20e3": [
        ["\u0030\uFE0F\u20E3", "\u0030\u20E3"], "\uE225", "\uDBBA\uDC37", ["zero"], 27, 15
    ],
    "0031-20e3": [
        ["\u0031\uFE0F\u20E3", "\u0031\u20E3"], "\uE21C", "\uDBBA\uDC2E", ["one"], 27, 16
    ],
    "0032-20e3": [
        ["\u0032\uFE0F\u20E3", "\u0032\u20E3"], "\uE21D", "\uDBBA\uDC2F", ["two"], 27, 17
    ],
    "0033-20e3": [
        ["\u0033\uFE0F\u20E3", "\u0033\u20E3"], "\uE21E", "\uDBBA\uDC30", ["three"], 27, 18
    ],
    "0034-20e3": [
        ["\u0034\uFE0F\u20E3", "\u0034\u20E3"], "\uE21F", "\uDBBA\uDC31", ["four"], 27, 19
    ],
    "0035-20e3": [
        ["\u0035\uFE0F\u20E3", "\u0035\u20E3"], "\uE220", "\uDBBA\uDC32", ["five"], 27, 20
    ],
    "0036-20e3": [
        ["\u0036\uFE0F\u20E3", "\u0036\u20E3"], "\uE221", "\uDBBA\uDC33", ["six"], 27, 21
    ],
    "0037-20e3": [
        ["\u0037\uFE0F\u20E3", "\u0037\u20E3"], "\uE222", "\uDBBA\uDC34", ["seven"], 27, 22
    ],
    "0038-20e3": [
        ["\u0038\uFE0F\u20E3", "\u0038\u20E3"], "\uE223", "\uDBBA\uDC35", ["eight"], 27, 23
    ],
    "0039-20e3": [
        ["\u0039\uFE0F\u20E3", "\u0039\u20E3"], "\uE224", "\uDBBA\uDC36", ["nine"], 27, 24
    ],
    "1f1e8-1f1f3": [
        ["\uD83C\uDDE8\uD83C\uDDF3"], "\uE513", "\uDBB9\uDCED", ["cn"], 27, 25
    ],
    "1f1e9-1f1ea": [
        ["\uD83C\uDDE9\uD83C\uDDEA"], "\uE50E", "\uDBB9\uDCE8", ["de"], 27, 26
    ],
    "1f1ea-1f1f8": [
        ["\uD83C\uDDEA\uD83C\uDDF8"], "\uE511", "\uDBB9\uDCEB", ["es"], 27, 27
    ],
    "1f1eb-1f1f7": [
        ["\uD83C\uDDEB\uD83C\uDDF7"], "\uE50D", "\uDBB9\uDCE7", ["fr"], 27, 28
    ],
    "1f1ec-1f1e7": [
        ["\uD83C\uDDEC\uD83C\uDDE7"], "\uE510", "\uDBB9\uDCEA", ["gb", "uk"], 27, 29
    ],
    "1f1ee-1f1f9": [
        ["\uD83C\uDDEE\uD83C\uDDF9"], "\uE50F", "\uDBB9\uDCE9", ["it"], 28, 0
    ],
    "1f1ef-1f1f5": [
        ["\uD83C\uDDEF\uD83C\uDDF5"], "\uE50B", "\uDBB9\uDCE5", ["jp"], 28, 1
    ],
    "1f1f0-1f1f7": [
        ["\uD83C\uDDF0\uD83C\uDDF7"], "\uE514", "\uDBB9\uDCEE", ["kr"], 28, 2
    ],
    "1f1f7-1f1fa": [
        ["\uD83C\uDDF7\uD83C\uDDFA"], "\uE512", "\uDBB9\uDCEC", ["ru"], 28, 3
    ],
    "1f1fa-1f1f8": [
        ["\uD83C\uDDFA\uD83C\uDDF8"], "\uE50C", "\uDBB9\uDCE6", ["us"], 28, 4
    ]
};

Config.smileys = {
    "<3": "heart",
    "<\/3": "broken_heart",
    ":)": "blush",
    "(:": "blush",
    ":-)": "blush",
    "C:": "smile",
    "c:": "smile",
    ":D": "smile",
    ":-D": "smile",
    ";)": "wink",
    ";-)": "wink",
    "):": "disappointed",
    ":(": "disappointed",
    ":-(": "disappointed",
    ":'(": "cry",
    "=)": "smiley",
    "=-)": "smiley",
    ":*": "kiss",
    ":-*": "kiss",
    ":>": "laughing",
    ":->": "laughing",
    "8)": "sunglasses",
    ":\\\\": "confused",
    ":-\\\\": "confused",
    ":\/": "confused",
    ":-\/": "confused",
    ":|": "neutral_face",
    ":-|": "neutral_face",
    ":o": "open_mouth",
    ":-o": "open_mouth",
    ">:(": "angry",
    ">:-(": "angry",
    ":p": "stuck_out_tongue",
    ":-p": "stuck_out_tongue",
    ":P": "stuck_out_tongue",
    ":-P": "stuck_out_tongue",
    ":b": "stuck_out_tongue",
    ":-b": "stuck_out_tongue",
    ";p": "stuck_out_tongue_winking_eye",
    ";-p": "stuck_out_tongue_winking_eye",
    ";b": "stuck_out_tongue_winking_eye",
    ";-b": "stuck_out_tongue_winking_eye",
    ";P": "stuck_out_tongue_winking_eye",
    ";-P": "stuck_out_tongue_winking_eye",
    ":o)": "monkey_face",
    "D:": "anguished"
};

Config.inits = {};
Config.map = {};

Config.mapcolon = {};
var a = [];
Config.reversemap = {};

Config.init_emoticons = function()
{
    if (Config.inits.emoticons)
        return;
    Config.init_colons(); // we require this for the emoticons map
    Config.inits.emoticons = 1;

    var a = [];
    Config.map.emoticons = {};
    for (var i in Config.emoticons_data)
    {
        // because we never see some characters in our text except as
        // entities, we must do some replacing
        var emoticon = i.replace(/\&/g, '&amp;').replace(/\</g, '&lt;')
            .replace(/\>/g, '&gt;');

        if (!Config.map.colons[emoji.emoticons_data[i]])
            continue;

        Config.map.emoticons[emoticon] = Config.map.colons[Config.emoticons_data[i]];
        a.push(Config.escape_rx(emoticon));
    }
    Config.rx_emoticons = new RegExp(
        ('(^|\\s)(' + a.join('|') + ')(?=$|[\\s|\\?\\.,!])'), 'g');
};
Config.init_colons = function()
{
    if (Config.inits.colons)
        return;
    Config.inits.colons = 1;
    Config.rx_colons = new RegExp('\:[^\\s:]+\:', 'g');
    Config.map.colons = {};
    for (var i in Config.data)
    {
        for (var j = 0; j < Config.data[i][3].length; j++)
        {
            Config.map.colons[emoji.data[i][3][j]] = i;
        }
    }
};
Config.init_unified = function()
{
    if (Config.inits.unified)
        return;
    Config.inits.unified = 1;

    buildMap();

};


Config.escape_rx = function(text)
{
    return text.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, "\\$&");
};

function buildMap()
{

    var colons = [],codes=[];
    for (var i in Config.emoji_data)
    {
        for (var j = 0; j < Config.emoji_data[i][0].length; j++)
        {
            colons.push(Config.escape_rx (":"+Config.emoji_data[i][3][0])+":");
            codes.push(Config.emoji_data[i][0][0]);

            // it is a map of {"colon smiley":"unicode char"}
            Config.map[Config.emoji_data[i][3][0]] = Config.emoji_data[i][0][0];
            Config.mapcolon[":"+Config.emoji_data[i][3][0]+":"] = Config.emoji_data[i][0][0];
            // it is a map of {"unicode char": "colon smiley"}
            Config.reversemap[Config.emoji_data[i][0][0]] = Config.emoji_data[i][3][0];
        }

        Config.rx_colons = new RegExp('(' + colons.join('|') + ')', "g");
        Config.rx_codes = new RegExp('(' + codes.join('|') + ')', "g");
    }
}


'use strict';
    
function cancelEvent (event) {
  event = event || window.event;
  if (event) {
    event = event.originalEvent || event;

    if (event.stopPropagation) event.stopPropagation();
    if (event.preventDefault) event.preventDefault();
  }

  return false;
}

function getGuid() {
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
        var r = Math.random()*16|0, v = c == 'x' ? r : (r&0x3|0x8);
        return v.toString(16);
    });
}

//ConfigStorage
(function(window)
{
    var keyPrefix = '';
    var noPrefix = false;
    var cache = {};
    var useCs = !!(window.chrome && chrome.storage && chrome.storage.local);
    var useLs = !useCs && !!window.localStorage;

    function storageSetPrefix(newPrefix)
    {
        keyPrefix = newPrefix;
    }

    function storageSetNoPrefix()
    {
        noPrefix = true;
    }

    function storageGetPrefix()
    {
        if (noPrefix)
        {
            noPrefix = false;
            return '';
        }
        return keyPrefix;
    }

    function storageGetValue()
    {
        var keys = Array.prototype.slice.call(arguments),
            callback = keys.pop(),
            result = [],
            single = keys.length == 1,
            value,
            allFound = true,
            prefix = storageGetPrefix(),
            i, key;

        for (i = 0; i < keys.length; i++)
        {
            key = keys[i] = prefix + keys[i];
            if (key.substr(0, 3) != 'xt_' && cache[key] !== undefined)
            {
                result.push(cache[key]);
            }
            else if (useLs)
            {
                try
                {
                    value = localStorage.getItem(key);
                }
                catch (e)
                {
                    useLs = false;
                }
                try
                {
                    value = (value === undefined || value === null) ? false : JSON.parse(value);
                }
                catch (e)
                {
                    value = false;
                }
                result.push(cache[key] = value);
            }
            else if (!useCs)
            {
                result.push(cache[key] = false);
            }
            else
            {
                allFound = false;
            }
        }

        if (allFound)
        {
            return callback(single ? result[0] : result);
        }

        chrome.storage.local.get(keys, function(resultObj)
        {
            var value;
            result = [];
            for (i = 0; i < keys.length; i++)
            {
                key = keys[i];
                value = resultObj[key];
                value = value === undefined || value === null ? false : JSON.parse(value);
                result.push(cache[key] = value);
            }

            callback(single ? result[0] : result);
        });
    };

    function storageSetValue(obj, callback)
    {
        var keyValues = {},
            prefix = storageGetPrefix(),
            key, value;

        for (key in obj)
        {
            if (obj.hasOwnProperty(key))
            {
                value = obj[key];
                key = prefix + key;
                cache[key] = value;
                value = JSON.stringify(value);
                if (useLs)
                {
                    try
                    {
                        localStorage.setItem(key, value);
                    }
                    catch (e)
                    {
                        useLs = false;
                    }
                }
                else
                {
                    keyValues[key] = value;
                }
            }
        }

        if (useLs || !useCs)
        {
            if (callback)
            {
                callback();
            }
            return;
        }

        chrome.storage.local.set(keyValues, callback);
    };

    function storageRemoveValue()
    {
        var keys = Array.prototype.slice.call(arguments),
            prefix = storageGetPrefix(),
            i, key, callback;

        if (typeof keys[keys.length - 1] === 'function')
        {
            callback = keys.pop();
        }

        for (i = 0; i < keys.length; i++)
        {
            key = keys[i] = prefix + keys[i];
            delete cache[key];
            if (useLs)
            {
                try
                {
                    localStorage.removeItem(key);
                }
                catch (e)
                {
                    useLs = false;
                }
            }
        }
        if (useCs)
        {
            chrome.storage.local.remove(keys, callback);
        }
        else if (callback)
        {
            callback();
        }
    };

    window.ConfigStorage = {
        prefix: storageSetPrefix,
        noPrefix: storageSetNoPrefix,
        get: storageGetValue,
        set: storageSetValue,
        remove: storageRemoveValue
    };


})(this);



/**
 * emojiarea - A rich textarea control that supports emojis, WYSIWYG-style.
 * Copyright (c) 2012 DIY Co
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not use this
 * file except in compliance with the License. You may obtain a copy of the License at:
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software distributed under
 * the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF
 * ANY KIND, either express or implied. See the License for the specific language
 * governing permissions and limitations under the License.
 *
 * @author Brian Reavis <brian@diy.org>
 */

/**
 * This file also contains some modifications by Igor Zhukov in order to add
 * custom scrollbars to EmojiMenu See keyword `MODIFICATION` in source code.
 */
(function($, window, document) {

	var ELEMENT_NODE = 1;
	var TEXT_NODE = 3;
	var TAGS_BLOCK = [ 'p', 'div', 'pre', 'form' ];
	var KEY_ESC = 27;
	var KEY_TAB = 9;
	/* Keys that are not intercepted and canceled when the textbox has reached its max length:
	 	   Backspace, Tab, Ctrl, Alt, Left Arrow, Up Arrow, Right Arrow, Down Arrow, Cmd Key, Delete
	*/
	var MAX_LENGTH_ALLOWED_KEYS = [8, 9, 17, 18, 37, 38, 39, 40, 91, 46];
	
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

	/*
	 * ! MODIFICATION START Options 'spritesheetPath', 'spritesheetDimens',
	 * 'iconSize' added by Andre Staltz.
	 */
	$.emojiarea = {
		assetsPath : '',
		iconSize : 25,
		icons : {},
	};
	var defaultRecentEmojis = ':joy:,:kissing_heart:,:heart:,:heart_eyes:,:blush:,:grin:,:+1:,:relaxed:,:pensive:,:smile:,:sob:,:kiss:,:unamused:,:flushed:,:stuck_out_tongue_winking_eye:,:see_no_evil:,:wink:,:smiley:,:cry:,:stuck_out_tongue_closed_eyes:,:scream:,:rage:,:smirk:,:disappointed:,:sweat_smile:,:kissing_closed_eyes:,:speak_no_evil:,:relieved:,:grinning:,:yum:,:laughing:,:ok_hand:,:neutral_face:,:confused:'
			.split(',');
	/* ! MODIFICATION END */

	$.fn.emojiarea = function(options) {
		options = $.extend({}, options);
		return this
			.each(function () {
				var originalInput = $(this);
				if ('contentEditable' in document.body
					&& options.wysiwyg !== false) {
					var id = getGuid();
					new EmojiArea_WYSIWYG(originalInput, id, $.extend({}, options));
				} else {
					var id = getGuid();
					new EmojiArea_Plain(originalInput, id, options);
				}
				originalInput.attr(
					{
						'data-emojiable': 'converted',
						'data-id': id,
						'data-type': 'original-input'
					});
			});
	};

	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

	var util = {};

	util.restoreSelection = (function() {
		if (window.getSelection) {
			return function(savedSelection) {
				var sel = window.getSelection();
				sel.removeAllRanges();
				for (var i = 0, len = savedSelection.length; i < len; ++i) {
					sel.addRange(savedSelection[i]);
				}
			};
		} else if (document.selection && document.selection.createRange) {
			return function(savedSelection) {
				if (savedSelection) {
					savedSelection.select();
				}
			};
		}
	})();

	util.saveSelection = (function() {
		if (window.getSelection) {
			return function() {
				var sel = window.getSelection(), ranges = [];
				if (sel.rangeCount) {
					for (var i = 0, len = sel.rangeCount; i < len; ++i) {
						ranges.push(sel.getRangeAt(i));
					}
				}
				return ranges;
			};
		} else if (document.selection && document.selection.createRange) {
			return function() {
				var sel = document.selection;
				return (sel.type.toLowerCase() !== 'none') ? sel.createRange()
						: null;
			};
		}
	})();

	util.replaceSelection = (function() {
		if (window.getSelection) {
			return function(content) {
				var range, sel = window.getSelection();
				var node = typeof content === 'string' ? document
						.createTextNode(content) : content;
				if (sel.getRangeAt && sel.rangeCount) {
					range = sel.getRangeAt(0);
					range.deleteContents();
					//range.insertNode(document.createTextNode(''));
					range.insertNode(node);
					range.setStart(node, 0);

					window.setTimeout(function() {
						range = document.createRange();
						range.setStartAfter(node);
						range.collapse(true);
						sel.removeAllRanges();
						sel.addRange(range);
					}, 0);
				}
			}
		} else if (document.selection && document.selection.createRange) {
			return function(content) {
				var range = document.selection.createRange();
				if (typeof content === 'string') {
					range.text = content;
				} else {
					range.pasteHTML(content.outerHTML);
				}
			}
		}
	})();

	util.insertAtCursor = function(text, el) {
		text = ' ' + text;
		var val = el.value, endIndex, startIndex, range;
		if (typeof el.selectionStart != 'undefined'
				&& typeof el.selectionEnd != 'undefined') {
			startIndex = el.selectionStart;
			endIndex = el.selectionEnd;
			el.value = val.substring(0, startIndex) + text
					+ val.substring(el.selectionEnd);
			el.selectionStart = el.selectionEnd = startIndex + text.length;
		} else if (typeof document.selection != 'undefined'
				&& typeof document.selection.createRange != 'undefined') {
			el.focus();
			range = document.selection.createRange();
			range.text = text;
			range.select();
		}
	};

	util.extend = function(a, b) {
		if (typeof a === 'undefined' || !a) {
			a = {};
		}
		if (typeof b === 'object') {
			for ( var key in b) {
				if (b.hasOwnProperty(key)) {
					a[key] = b[key];
				}
			}
		}
		return a;
	};

	util.escapeRegex = function(str) {
		return (str + '').replace(/([.?*+^$[\]\\(){}|-])/g, '\\$1');
	};

	util.htmlEntities = function(str) {
		return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;')
				.replace(/>/g, '&gt;').replace(/"/g, '&quot;');
	};

	/*
	 * ! MODIFICATION START This function was added by Igor Zhukov to save
	 * recent used emojis.
	 */
	util.emojiInserted = function(emojiKey, menu) {
		ConfigStorage.get('emojis_recent', function(curEmojis) {
			curEmojis = curEmojis || defaultRecentEmojis || [];

			var pos = curEmojis.indexOf(emojiKey);
			if (!pos) {
				return false;
			}
			if (pos != -1) {
				curEmojis.splice(pos, 1);
			}
			curEmojis.unshift(emojiKey);
			if (curEmojis.length > 42) {
				curEmojis = curEmojis.slice(42);
			}

			ConfigStorage.set({
				emojis_recent : curEmojis
			});
		})
	};
	/* ! MODIFICATION END */

	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	var EmojiArea = function() {
	};

	EmojiArea.prototype.setup = function() {
		var self = this;

		this.$editor.on('focus', function() {
			self.hasFocus = true;
		});
		this.$editor.on('blur', function() {
			self.hasFocus = false;
		});

    // Assign a unique instance of an emojiMenu to
    self.emojiMenu = new EmojiMenu(self);

		this.setupButton();
	};

	EmojiArea.prototype.setupButton = function() {
		var self = this;
		var $button = $('[data-id=' + this.id + '][data-type=picker]');

    $button.on('click', function(e) {
      self.emojiMenu.show(self);
		});

		this.$button = $button;
    this.$dontHideOnClick = 'emoji-picker';
	};

	/*
	 * ! MODIFICATION START This function was modified by Andre Staltz so that
	 * the icon is created from a spritesheet.
	 */
	EmojiArea.createIcon = function(emoji, menu) {
		var category = emoji[0];
		var row = emoji[1];
		var column = emoji[2];
		var name = emoji[3];
		var filename = $.emojiarea.assetsPath + '/emoji_spritesheet_!.png';
    var blankGifPath = $.emojiarea.assetsPath + '/blank.gif';
		var iconSize = menu && Config.Mobile ? 26 : $.emojiarea.iconSize
		var xoffset = -(iconSize * column);
		var yoffset = -(iconSize * row);
		var scaledWidth = (Config.EmojiCategorySpritesheetDimens[category][1] * iconSize);
		var scaledHeight = (Config.EmojiCategorySpritesheetDimens[category][0] * iconSize);

		var style = 'display:inline-block;';
		style += 'width:' + iconSize + 'px;';
		style += 'height:' + iconSize + 'px;';
		style += 'background:url(\'' + filename.replace('!', category) + '\') '
				+ xoffset + 'px ' + yoffset + 'px no-repeat;';
		style += 'background-size:' + scaledWidth + 'px ' + scaledHeight
				+ 'px;';
		return '<img src="' + blankGifPath + '" class="img" style="'
				+ style + '" alt="' + util.htmlEntities(name) + '">';
	};
	
	$.emojiarea.createIcon = EmojiArea.createIcon;
	/* ! MODIFICATION END */

	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	/**
	 * Editor (plain-text)
	 * 
	 * @constructor
	 * @param {object}
	 *            $textarea
	 * @param {object}
	 *            options
	 */

	var EmojiArea_Plain = function($textarea, id, options) {
		this.options = options;
		this.$textarea = $textarea;
		this.$editor = $textarea;
    this.id = id;
		this.setup();
	};

	EmojiArea_Plain.prototype.insert = function(emoji) {
		if (!$.emojiarea.icons.hasOwnProperty(emoji))
			return;
		util.insertAtCursor(emoji, this.$textarea[0]);
		/*
		 * MODIFICATION: Following line was added by Igor Zhukov, in order to
		 * save recent emojis
		 */
		util.emojiInserted(emoji, this.menu);
		this.$textarea.trigger('change');
	};

	EmojiArea_Plain.prototype.val = function() {
		if (this.$textarea == '\n')
			return '';
		return this.$textarea.val();
	};

	util.extend(EmojiArea_Plain.prototype, EmojiArea.prototype);

	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

	/**
	 * Editor (rich)
	 * 
	 * @constructor
	 * @param {object}
	 *            $textarea
	 * @param {object}
	 *            options
	 */

	var EmojiArea_WYSIWYG = function($textarea, id, options) {
		var self = this;

		this.options = options || {};
		if ($($textarea).attr('data-emoji-input') === 'unicode')
			this.options.inputMethod = 'unicode';
		else
			this.options.inputMethod = 'image';
    this.id = id;
		this.$textarea = $textarea;
    this.emojiPopup = options.emojiPopup;
		this.$editor = $('<div>').addClass('emoji-wysiwyg-editor').addClass($($textarea)[0].className);
    this.$editor.data('self', this);

    if ($textarea.attr('maxlength')) {
      this.$editor.attr('maxlength', $textarea.attr('maxlength'));
    }
    var unicodeToImageText = this.emojiPopup.unicodeToImage($textarea.val());
		this.$editor.html(unicodeToImageText);
		this.$editor.attr({
			'data-id': id,
			'data-type': 'input',
			'placeholder': $textarea.attr('placeholder'),
			'contenteditable': 'true',
		});

		/*
		 * ! MODIFICATION START Following code was modified by Igor Zhukov, in
		 * order to improve rich text paste
		 */
		var changeEvents = 'blur change';
		if (!this.options.norealTime) {
			changeEvents += ' keyup';
		}
		this.$editor.on(changeEvents, function(e) {
			return self.onChange.apply(self, [ e ]);
		});
		/* ! MODIFICATION END */

		this.$editor.on('mousedown focus', function() {
			document.execCommand('enableObjectResizing', false, false);
		});
		this.$editor.on('blur', function() {
			document.execCommand('enableObjectResizing', true, true);
		});

    var editorDiv = this.$editor;
		this.$editor.on("change keydown keyup resize scroll", function(e) {
      if(MAX_LENGTH_ALLOWED_KEYS.indexOf(e.which) == -1 &&
				!((e.ctrlKey || e.metaKey) && e.which == 65) && // Ctrl + A
				!((e.ctrlKey || e.metaKey) && e.which == 67) && // Ctrl + C
				editorDiv.text().length + editorDiv.find('img').length >= editorDiv.attr('maxlength'))
      {
        e.preventDefault();
      }
      self.updateBodyPadding(editorDiv);
    });

		if (this.options.onPaste) {
			var self = this;
			this.$editor.on("paste", function (e) {
				e.preventDefault();

				if ((e.originalEvent || e).clipboardData) {
					var content = (e.originalEvent || e).clipboardData.getData('text/plain');
					var finalText = self.options.onPaste(content);
					document.execCommand('insertText', false, finalText);
				}
				else if (window.clipboardData) {
					var content = window.clipboardData.getData('Text');
					var finalText = self.options.onPaste(content);
					document.selection.createRange().pasteHTML(finalText);
				}
				editorDiv.scrollTop(editorDiv[0].scrollHeight);
			});
		}

    $textarea.after("<i class='emoji-picker-icon emoji-picker " + this.options.popupButtonClasses + "' data-id='" + id + "' data-type='picker'></i>");

		$textarea.hide().after(this.$editor);
		this.setup();

		/*
		 * MODIFICATION: Following line was modified by Igor Zhukov, in order to
		 * improve emoji insert behaviour
		 */
		$(document.body).on('mousedown', function() {
			if (self.hasFocus) {
				self.selection = util.saveSelection();
			}
		});
	};

  EmojiArea_WYSIWYG.prototype.updateBodyPadding = function(target) {
    var emojiPicker = $('[data-id=' + this.id + '][data-type=picker]');
    if ($(target).hasScrollbar()) {
      if (!(emojiPicker.hasClass('parent-has-scroll')))
        emojiPicker.addClass('parent-has-scroll');
      if (!($(target).hasClass('parent-has-scroll')))
        $(target).addClass('parent-has-scroll');
    } else {
      if ((emojiPicker.hasClass('parent-has-scroll')))
        emojiPicker.removeClass('parent-has-scroll');
      if (($(target).hasClass('parent-has-scroll')))
        $(target).removeClass('parent-has-scroll');
    }
  };

	EmojiArea_WYSIWYG.prototype.onChange = function(e) {
		this.$textarea.val(this.val()).trigger('change');
	};

	EmojiArea_WYSIWYG.prototype.insert = function(emoji) {
		var content;
		/*
		 * MODIFICATION: Following line was modified by Andre Staltz, to use new
		 * implementation of createIcon function.
		 */
		var insertionContent = '';
		if (this.options.inputMethod == 'unicode') {
			insertionContent = this.emojiPopup.colonToUnicode(emoji);
		} else {
			var $img = $(EmojiArea.createIcon($.emojiarea.icons[emoji]));
			if ($img[0].attachEvent) {
				$img[0].attachEvent('onresizestart', function(e) {
					e.returnValue = false;
				}, false);
			}
			insertionContent = $img[0];
		}

		this.$editor.trigger('focus');
		if (this.selection) {
			util.restoreSelection(this.selection);
		}
		try {
			util.replaceSelection(insertionContent);
		} catch (e) {
		}

		/*
		 * MODIFICATION: Following line was added by Igor Zhukov, in order to
		 * save recent emojis
		 */
		util.emojiInserted(emoji, this.menu);

		this.onChange();
	};

	EmojiArea_WYSIWYG.prototype.val = function() {
		var lines = [];
		var line = [];
    var emojiPopup = this.emojiPopup;

		var flush = function() {
			lines.push(line.join(''));
			line = [];
		};

		var sanitizeNode = function(node) {
			if (node.nodeType === TEXT_NODE) {
				line.push(node.nodeValue);
			} else if (node.nodeType === ELEMENT_NODE) {
				var tagName = node.tagName.toLowerCase();
				var isBlock = TAGS_BLOCK.indexOf(tagName) !== -1;

				if (isBlock && line.length)
					flush();

				if (tagName === 'img') {
					var alt = node.getAttribute('alt') || '';
					if (alt) {
							line.push(alt);
					}
					return;
				} else if (tagName === 'br') {
					flush();
				}

				var children = node.childNodes;
				for (var i = 0; i < children.length; i++) {
					 sanitizeNode(children[i]);
				}

				if (isBlock && line.length)
					flush();
			}
		};

		var children = this.$editor[0].childNodes;
		for (var i = 0; i < children.length; i++) {
			sanitizeNode(children[i]);
		}

		if (line.length)
			flush();

		var returnValue = lines.join('\n');
    return emojiPopup.colonToUnicode(returnValue);
	};

	util.extend(EmojiArea_WYSIWYG.prototype, EmojiArea.prototype);

	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

  jQuery.fn.hasScrollbar = function() {
    var scrollHeight = this.get(0).scrollHeight;

    //safari's scrollHeight includes padding
    //if ($.browser.safari)
//      scrollHeight -= parseInt(this.css('padding-top')) + parseInt(this.css('padding-bottom'));
    if (this.outerHeight() < scrollHeight)
      return true;
    else
      return false;
  }

	/**
	 * Emoji Dropdown Menu
	 * 
	 * @constructor
	 * @param {object}
	 *            emojiarea
	 */
	var EmojiMenu = function(emojiarea) {
		var self = this;
    self.id = emojiarea.id;
		var $body = $(document.body);
		var $window = $(window);

		this.visible = false;
		this.emojiarea = emojiarea;
		EmojiMenu.menuZIndex = 5000;
		this.$menu = $('<div>');
		this.$menu.addClass('emoji-menu');
    this.$menu.attr('data-id', self.id);
    this.$menu.attr('data-type', 'menu');
		this.$menu.hide();

		/*
		 * ! MODIFICATION START Following code was modified by Igor Zhukov, in
		 * order to add scrollbars and tail to EmojiMenu Also modified by Andre
		 * Staltz, to include tabs for categories, on the menu header.
		 */
		this.$itemsTailWrap = $('<div class="emoji-items-wrap1"></div>')
				.appendTo(this.$menu);
		this.$categoryTabs = $(
				'<table class="emoji-menu-tabs"><tr>'
						+ '<td><a class="emoji-menu-tab icon-recent" ></a></td>'
						+ '<td><a class="emoji-menu-tab icon-smile" ></a></td>'
						+ '<td><a class="emoji-menu-tab icon-flower"></a></td>'
						+ '<td><a class="emoji-menu-tab icon-bell"></a></td>'
						+ '<td><a class="emoji-menu-tab icon-car"></a></td>'
						+ '<td><a class="emoji-menu-tab icon-grid"></a></td>'
						+ '</tr></table>').appendTo(this.$itemsTailWrap);
		this.$itemsWrap = $(
				'<div class="emoji-items-wrap nano mobile_scrollable_wrap"></div>')
				.appendTo(this.$itemsTailWrap);
		this.$items = $('<div class="emoji-items nano-content">').appendTo(
				this.$itemsWrap);
		/* ! MODIFICATION END */

		$body.append(this.$menu);

		/*
		 * ! MODIFICATION: Following 3 lines were added by Igor Zhukov, in order
		 * to add scrollbars to EmojiMenu
		 */
		
		  if (!Config.Mobile) {
		  this.$itemsWrap.nanoScroller({preventPageScrolling: true, tabIndex:
		  -1}); }
		 
		
		//this.$itemsWrap.nanoScroller({preventPageScrolling: true, tabIndex:* -1});

		$body.on('keydown', function(e) {
			if (e.keyCode === KEY_ESC || e.keyCode === KEY_TAB) {
				self.hide();
			}
		});

		/*
		 * ! MODIFICATION: Following 3 lines were added by Igor Zhukov, in order
		 * to hide menu on message submit with keyboard
		 */
		$body.on('message_send', function(e) {
			self.hide();
		});

		$body.on('mouseup', function(e) {
			/*
			 * ! MODIFICATION START Following code was added by Igor Zhukov, in
			 * order to prevent close on click on EmojiMenu scrollbar
			 */
			e = e.originalEvent || e;
			var target = e.originalTarget || e.target || window;

      if ($(target).hasClass(self.emojiarea.$dontHideOnClick)) {
        return;
      }

			while (target && target != window) {
				target = target.parentNode;
				if (target == self.$menu[0] || self.emojiarea
						&& target == self.emojiarea.$button[0]) {
					return;
				}
			}
			/* ! MODIFICATION END */
			self.hide();
		});

		$window.on('resize', function() {
			if (self.visible)
				self.reposition();
		});

		this.$menu.on('mouseup', 'a', function(e) {
			e.stopPropagation();
			return false;
		});

		this.$menu.on('click', 'a', function(e) {
      self.emojiarea.updateBodyPadding(self.emojiarea.$editor);
			/*
			 * ! MODIFICATION START Following code was modified by Andre Staltz,
			 * to capture clicks on category tabs and change the category
			 * selection.
			 */
			if ($(this).hasClass('emoji-menu-tab')) {
				if (self.getTabIndex(this) !== self.currentCategory) {
					self.selectCategory(self.getTabIndex(this));
				}
				return false;
			}
			/* ! MODIFICATION END */
			var emoji = $('.label', $(this)).text();
			window.setTimeout(function() {
				self.onItemSelected(emoji);
				/*
				 * ! MODIFICATION START Following code was modified by Igor
				 * Zhukov, in order to close only on ctrl-, alt- emoji select
				 */
				if (e.ctrlKey || e.metaKey) {
					self.hide();
				}
				/* ! MODIFICATION END */
			}, 0);
			e.stopPropagation();
			return false;
		});

		/*
		 * MODIFICATION: Following line was modified by Andre Staltz, in order
		 * to select a default category.
		 */
		this.selectCategory(0);
	};

	/*
	 * ! MODIFICATION START Following code was added by Andre Staltz, to
	 * implement category selection.
	 */
	EmojiMenu.prototype.getTabIndex = function(tab) {
		return this.$categoryTabs.find('.emoji-menu-tab').index(tab);
	};

	EmojiMenu.prototype.selectCategory = function(category) {
		var self = this;
		this.$categoryTabs.find('.emoji-menu-tab').each(function(index) {
			if (index === category) {
				this.className += '-selected';
			} else {
				this.className = this.className.replace('-selected', '');
			}
		});
		this.currentCategory = category;
		this.load(category);

		
		 if (!Config.Mobile) { this.$itemsWrap.nanoScroller({ scroll: 'top'
		 }); }
		 
		 
		 
	};
	/* ! MODIFICATION END */

	EmojiMenu.prototype.onItemSelected = function(emoji) {
    if(this.emojiarea.$editor.text().length + this.emojiarea.$editor.find('img').length >= this.emojiarea.$editor.attr('maxlength'))
    {
      return;
    }
		this.emojiarea.insert(emoji);
	};

	/*
	 * MODIFICATION: The following function argument was modified by Andre
	 * Staltz, in order to load only icons from a category. Also function was
	 * modified by Igor Zhukov in order to display recent emojis from
	 * localStorage
	 */
	EmojiMenu.prototype.load = function(category) {
		var html = [];
		var options = $.emojiarea.icons;
		var path = $.emojiarea.assetsPath;
		var self = this;
		if (path.length && path.charAt(path.length - 1) !== '/') {
			path += '/';
		}

		/*
		 * ! MODIFICATION: Following function was added by Igor Zhukov, in order
		 * to add scrollbars to EmojiMenu
		 */
		var updateItems = function() {
			self.$items.html(html.join(''));

			
			  if (!Config.Mobile) { setTimeout(function () {
			  self.$itemsWrap.nanoScroller(); }, 100); }
			 
		}

		if (category > 0) {
			for ( var key in options) {
				/*
				 * MODIFICATION: The following 2 lines were modified by Andre
				 * Staltz, in order to load only icons from the specified
				 * category.
				 */
				if (options.hasOwnProperty(key)
						&& options[key][0] === (category - 1)) {
					html.push('<a href="javascript:void(0)" title="'
							+ util.htmlEntities(key) + '">'
							+ EmojiArea.createIcon(options[key], true)
							+ '<span class="label">' + util.htmlEntities(key)
							+ '</span></a>');
				}
			}
			updateItems();
		} else {
			ConfigStorage.get('emojis_recent', function(curEmojis) {
				curEmojis = curEmojis || defaultRecentEmojis || [];
				var key, i;
				for (i = 0; i < curEmojis.length; i++) {
					key = curEmojis[i]
					if (options[key]) {
						html.push('<a href="javascript:void(0)" title="'
								+ util.htmlEntities(key) + '">'
								+ EmojiArea.createIcon(options[key], true)
								+ '<span class="label">'
								+ util.htmlEntities(key) + '</span></a>');
					}
				}
				updateItems();
			});
		}0
	};

	EmojiMenu.prototype.reposition = function() {
    if (!this.tether) {

      this.tether = new Tether({
        element: '[data-id="' + this.id + '"][data-type="menu"]',
        target: '[data-id="' + this.id + '"][data-type="picker"]',
        attachment: 'left center',
        targetAttachment: 'bottom left',
        offset: '0 12px',
        constraints: [
          {
            to: 'html',
            pin: true
          }
        ]
      });
    }
	};

  EmojiMenu.prototype.hide = function(callback) {
    this.visible = false;
    this.$menu.hide("fast");
  };

  EmojiMenu.prototype.show = function(emojiarea) {
    /*
     * MODIFICATION: Following line was modified by Igor Zhukov, in order to
     * improve EmojiMenu behaviour
     */
    if (this.visible)
      return this.hide();
    this.reposition();
		$(this.$menu).css('z-index', ++EmojiMenu.menuZIndex);
    this.$menu.show("fast");
    /*
     * MODIFICATION: Following 3 lines were added by Igor Zhukov, in order
     * to update EmojiMenu contents
     */
    if (!this.currentCategory) {
      this.load(0);
    }
    this.visible = true;
  };

})(jQuery, window, document);
// Generated by CoffeeScript 1.9.3
(function() {
  this.EmojiPicker = (function() {
    function EmojiPicker(options) {
      var ref, ref1;
      if (options == null) {
        options = {};
      }
      $.emojiarea.iconSize = (ref = options.iconSize) != null ? ref : 25;
      $.emojiarea.assetsPath = (ref1 = options.assetsPath) != null ? ref1 : '';
      this.generateEmojiIconSets(options);
      if (!options.emojiable_selector) {
        options.emojiable_selector = '[data-emojiable=true]';
      }
      this.options = options;
    }

    EmojiPicker.prototype.discover = function() {
      var isiOS;
      isiOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
      if (isiOS) {
        return;
      }
      return $(this.options.emojiable_selector).emojiarea($.extend({
        emojiPopup: this,
        norealTime: true
      }, this.options));
    };

    EmojiPicker.prototype.generateEmojiIconSets = function(options) {
      var column, dataItem, hex, i, icons, j, name, reverseIcons, row, totalColumns;
      icons = {};
      reverseIcons = {};
      i = void 0;
      j = void 0;
      hex = void 0;
      name = void 0;
      dataItem = void 0;
      row = void 0;
      column = void 0;
      totalColumns = void 0;
      j = 0;
      while (j < Config.EmojiCategories.length) {
        totalColumns = Config.EmojiCategorySpritesheetDimens[j][1];
        i = 0;
        while (i < Config.EmojiCategories[j].length) {
          dataItem = Config.Emoji[Config.EmojiCategories[j][i]];
          name = dataItem[1][0];
          row = Math.floor(i / totalColumns);
          column = i % totalColumns;
          icons[':' + name + ':'] = [j, row, column, ':' + name + ':'];
          reverseIcons[name] = dataItem[0];
          i++;
        }
        j++;
      }
      $.emojiarea.icons = icons;
      return $.emojiarea.reverseIcons = reverseIcons;
    };

    EmojiPicker.prototype.colonToUnicode = function(input) {
      if (!input) {
        return '';
      }
      if (!Config.rx_colons) {
        Config.init_unified();
      }
      return input.replace(Config.rx_colons, function(m) {
        var val;
        val = Config.mapcolon[m];
        if (val) {
          return val;
        } else {
          return '';
        }
      });
    };

    EmojiPicker.prototype.unicodeToImage = function(input) {
      if (!input) {
        return '';
      }
      if (!Config.rx_codes) {
        Config.init_unified();
      }
      return input.replace(Config.rx_codes, function(m) {
        var $img, val;
        val = Config.reversemap[m];
        if (val) {
          val = ':' + val + ':';
          $img = $.emojiarea.createIcon($.emojiarea.icons[val]);
          return $img;
        } else {
          return '';
        }
      });
    };

    EmojiPicker.prototype.colonToImage = function(input) {
      if (!input) {
        return '';
      }
      if (!Config.rx_colons) {
        Config.init_unified();
      }
      return input.replace(Config.rx_colons, function(m) {
        var $img;
        if (m) {
          $img = $.emojiarea.createIcon($.emojiarea.icons[m]);
          return $img;
        } else {
          return '';
        }
      });
    };

    return EmojiPicker;

  })();

}).call(this);

//# sourceMappingURL=emoji-picker.js.map

/**
 * bootbox.js 5.1.3
 *
 * http://bootboxjs.com/license.txt
 */
!function(t,e){'use strict';'function'==typeof define&&define.amd?define(['jquery'],e):'object'==typeof exports?module.exports=e(require('jquery')):t.bootbox=e(t.jQuery)}(this,function e(p,u){'use strict';var r,n,i,l;Object.keys||(Object.keys=(r=Object.prototype.hasOwnProperty,n=!{toString:null}.propertyIsEnumerable('toString'),l=(i=['toString','toLocaleString','valueOf','hasOwnProperty','isPrototypeOf','propertyIsEnumerable','constructor']).length,function(t){if('function'!=typeof t&&('object'!=typeof t||null===t))throw new TypeError('Object.keys called on non-object');var e,o,a=[];for(e in t)r.call(t,e)&&a.push(e);if(n)for(o=0;o<l;o++)r.call(t,i[o])&&a.push(i[o]);return a}));var d={};d.VERSION='5.0.0';var b={ar:{OK:"موافق",CANCEL:"الغاء",CONFIRM:"تأكيد"},bg_BG:{OK:"Ок",CANCEL:"Отказ",CONFIRM:"Потвърждавам"},br:{OK:"OK",CANCEL:"Cancelar",CONFIRM:"Sim"},cs:{OK:"OK",CANCEL:"Zrušit",CONFIRM:"Potvrdit"},da:{OK:"OK",CANCEL:"Annuller",CONFIRM:"Accepter"},de:{OK:"OK",CANCEL:"Abbrechen",CONFIRM:"Akzeptieren"},el:{OK:"Εντάξει",CANCEL:"Ακύρωση",CONFIRM:"Επιβεβαίωση"},en:{OK:"OK",CANCEL:"Cancel",CONFIRM:"OK"},es:{OK:"OK",CANCEL:"Cancelar",CONFIRM:"Aceptar"},eu:{OK:"OK",CANCEL:"Ezeztatu",CONFIRM:"Onartu"},et:{OK:"OK",CANCEL:"Katkesta",CONFIRM:"OK"},fa:{OK:"قبول",CANCEL:"لغو",CONFIRM:"تایید"},fi:{OK:"OK",CANCEL:"Peruuta",CONFIRM:"OK"},fr:{OK:"OK",CANCEL:"Annuler",CONFIRM:"Confirmer"},he:{OK:"אישור",CANCEL:"ביטול",CONFIRM:"אישור"},hu:{OK:"OK",CANCEL:"Mégsem",CONFIRM:"Megerősít"},hr:{OK:"OK",CANCEL:"Odustani",CONFIRM:"Potvrdi"},id:{OK:"OK",CANCEL:"Batal",CONFIRM:"OK"},it:{OK:"OK",CANCEL:"Annulla",CONFIRM:"Conferma"},ja:{OK:"OK",CANCEL:"キャンセル",CONFIRM:"確認"},lt:{OK:"Gerai",CANCEL:"Atšaukti",CONFIRM:"Patvirtinti"},lv:{OK:"Labi",CANCEL:"Atcelt",CONFIRM:"Apstiprināt"},nl:{OK:"OK",CANCEL:"Annuleren",CONFIRM:"Accepteren"},no:{OK:"OK",CANCEL:"Avbryt",CONFIRM:"OK"},pl:{OK:"OK",CANCEL:"Anuluj",CONFIRM:"Potwierdź"},pt:{OK:"OK",CANCEL:"Cancelar",CONFIRM:"Confirmar"},ru:{OK:"OK",CANCEL:"Отмена",CONFIRM:"Применить"},sk:{OK:"OK",CANCEL:"Zrušiť",CONFIRM:"Potvrdiť"},sl:{OK:"OK",CANCEL:"Prekliči",CONFIRM:"Potrdi"},sq:{OK:"OK",CANCEL:"Anulo",CONFIRM:"Prano"},sv:{OK:"OK",CANCEL:"Avbryt",CONFIRM:"OK"},sw:{OK:'Sawa',CANCEL:'Ghairi',CONFIRM:'Thibitisha'},ta:{OK:'சரி',CANCEL:'ரத்து செய்',CONFIRM:'உறுதி செய்'},th:{OK:"ตกลง",CANCEL:"ยกเลิก",CONFIRM:"ยืนยัน"},tr:{OK:"Tamam",CANCEL:"İptal",CONFIRM:"Onayla"},uk:{OK:"OK",CANCEL:"Відміна",CONFIRM:"Прийняти"},zh_CN:{OK:"OK",CANCEL:"取消",CONFIRM:"确认"},zh_TW:{OK:"OK",CANCEL:"取消",CONFIRM:"確認"}},f={dialog:"<div class=\"bootbox modal\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\"><div class=\"modal-dialog\"><div class=\"modal-content\"><div class=\"modal-body\"><div class=\"bootbox-body\"></div></div></div></div></div>",header:"<div class=\"modal-header\"><h5 class=\"modal-title\"></h5></div>",footer:'<div class="modal-footer"></div>',closeButton:'<button type="button" class="bootbox-close-button close" aria-hidden="true">&times;</button>',form:'<form class="bootbox-form"></form>',button:'<button type="button" class="btn"></button>',option:'<option></option>',promptMessage:'<div class="bootbox-prompt-message"></div>',inputs:{text:'<input class="bootbox-input bootbox-input-text form-control" autocomplete="off" type="text" />',textarea:'<textarea class="bootbox-input bootbox-input-textarea form-control"></textarea>',email:'<input class="bootbox-input bootbox-input-email form-control" autocomplete="off" type="email" />',select:'<select class="bootbox-input bootbox-input-select form-control"></select>',checkbox:'<div class="form-check checkbox"><label class="form-check-label"><input class="form-check-input bootbox-input bootbox-input-checkbox" type="checkbox" /></label></div>',radio:'<div class="form-check radio"><label class="form-check-label"><input class="form-check-input bootbox-input bootbox-input-radio" type="radio" name="bootbox-radio" /></label></div>',date:'<input class="bootbox-input bootbox-input-date form-control" autocomplete="off" type="date" />',time:'<input class="bootbox-input bootbox-input-time form-control" autocomplete="off" type="time" />',number:'<input class="bootbox-input bootbox-input-number form-control" autocomplete="off" type="number" />',password:'<input class="bootbox-input bootbox-input-password form-control" autocomplete="off" type="password" />',range:'<input class="bootbox-input bootbox-input-range form-control-range" autocomplete="off" type="range" />'}},m={locale:'en',backdrop:'static',animate:!0,className:null,closeButton:!0,show:!0,container:'body',value:'',inputType:'text',swapButtonOrder:!1,centerVertical:!1,multiple:!1,scrollable:!1};function c(t,e,o){return p.extend(!0,{},t,function(t,e){var o=t.length,a={};if(o<1||2<o)throw new Error('Invalid argument length');return 2===o||'string'==typeof t[0]?(a[e[0]]=t[0],a[e[1]]=t[1]):a=t[0],a}(e,o))}function h(t,e,o,a){var r;a&&a[0]&&(r=a[0].locale||m.locale,(a[0].swapButtonOrder||m.swapButtonOrder)&&(e=e.reverse()));var n,i,l,s={className:'bootbox-'+t,buttons:function(t,e){for(var o={},a=0,r=t.length;a<r;a++){var n=t[a],i=n.toLowerCase(),l=n.toUpperCase();o[i]={label:(s=l,c=e,void 0,p=b[c],p?p[s]:b.en[s])}}var s,c,p;return o}(e,r)};return n=c(s,a,o),l={},O(i=e,function(t,e){l[e]=!0}),O(n.buttons,function(t){if(l[t]===u)throw new Error('button key "'+t+'" is not allowed (options are '+i.join(' ')+')')}),n}function C(t){return Object.keys(t).length}function O(t,o){var a=0;p.each(t,function(t,e){o(t,e,a++)})}function v(t,e,o){t.stopPropagation(),t.preventDefault(),p.isFunction(o)&&!1===o.call(e,t)||e.modal('hide')}function w(t){return/([01][0-9]|2[0-3]):[0-5][0-9]?:[0-5][0-9]/.test(t)}function g(t){return/(\d{4})-(\d{2})-(\d{2})/.test(t)}return d.locales=function(t){return t?b[t]:b},d.addLocale=function(t,o){return p.each(['OK','CANCEL','CONFIRM'],function(t,e){if(!o[e])throw new Error('Please supply a translation for "'+e+'"')}),b[t]={OK:o.OK,CANCEL:o.CANCEL,CONFIRM:o.CONFIRM},d},d.removeLocale=function(t){if('en'===t)throw new Error('"en" is used as the default and fallback locale and cannot be removed.');return delete b[t],d},d.setLocale=function(t){return d.setDefaults('locale',t)},d.setDefaults=function(){var t={};return 2===arguments.length?t[arguments[0]]=arguments[1]:t=arguments[0],p.extend(m,t),d},d.hideAll=function(){return p('.bootbox').modal('hide'),d},d.init=function(t){return e(t||p)},d.dialog=function(t){if(p.fn.modal===u)throw new Error("\"$.fn.modal\" is not defined; please double check you have included the Bootstrap JavaScript library. See http://getbootstrap.com/javascript/ for more details.");if(t=function(r){var n,i;if('object'!=typeof r)throw new Error('Please supply an object of options');if(!r.message)throw new Error('"message" option must not be null or an empty string.');(r=p.extend({},m,r)).buttons||(r.buttons={});return n=r.buttons,i=C(n),O(n,function(t,e,o){if(p.isFunction(e)&&(e=n[t]={callback:e}),'object'!==p.type(e))throw new Error('button with key "'+t+'" must be an object');if(e.label||(e.label=t),!e.className){var a=!1;a=r.swapButtonOrder?0===o:o===i-1,e.className=i<=2&&a?'btn-primary':'btn-secondary btn-default'}}),r}(t),p.fn.modal.Constructor.VERSION){t.fullBootstrapVersion=p.fn.modal.Constructor.VERSION;var e=t.fullBootstrapVersion.indexOf('.');t.bootstrap=t.fullBootstrapVersion.substring(0,e)}else t.bootstrap='2',t.fullBootstrapVersion='2.3.2',console.warn('Bootbox will *mostly* work with Bootstrap 2, but we do not officially support it. Please upgrade, if possible.');var o=p(f.dialog),a=o.find('.modal-dialog'),r=o.find('.modal-body'),n=p(f.header),i=p(f.footer),l=t.buttons,s={onEscape:t.onEscape};if(r.find('.bootbox-body').html(t.message),0<C(t.buttons)&&(O(l,function(t,e){var o=p(f.button);switch(o.data('bb-handler',t),o.addClass(e.className),t){case'ok':case'confirm':o.addClass('bootbox-accept');break;case'cancel':o.addClass('bootbox-cancel')}o.html(e.label),i.append(o),s[t]=e.callback}),r.after(i)),!0===t.animate&&o.addClass('fade'),t.className&&o.addClass(t.className),t.size)switch(t.fullBootstrapVersion.substring(0,3)<'3.1'&&console.warn('"size" requires Bootstrap 3.1.0 or higher. You appear to be using '+t.fullBootstrapVersion+'. Please upgrade to use this option.'),t.size){case'small':case'sm':a.addClass('modal-sm');break;case'large':case'lg':a.addClass('modal-lg');break;case'xl':case'extra-large':t.fullBootstrapVersion.substring(0,3)<'4.2'&&console.warn('Using size "xl"/"extra-large" requires Bootstrap 4.2.0 or higher. You appear to be using '+t.fullBootstrapVersion+'. Please upgrade to use this option.'),a.addClass('modal-xl')}if(t.scrollable&&(t.fullBootstrapVersion.substring(0,3)<'4.3'&&console.warn('Using "scrollable" requires Bootstrap 4.3.0 or higher. You appear to be using '+t.fullBootstrapVersion+'. Please upgrade to use this option.'),a.addClass('modal-dialog-scrollable')),t.title&&(r.before(n),o.find('.modal-title').html(t.title)),t.closeButton){var c=p(f.closeButton);t.title?3<t.bootstrap?o.find('.modal-header').append(c):o.find('.modal-header').prepend(c):c.prependTo(r)}return t.centerVertical&&(t.fullBootstrapVersion<'4.0.0'&&console.warn('"centerVertical" requires Bootstrap 4.0.0-beta.3 or higher. You appear to be using '+t.fullBootstrapVersion+'. Please upgrade to use this option.'),a.addClass('modal-dialog-centered')),o.one('hide.bs.modal',function(t){t.target===this&&(o.off('escape.close.bb'),o.off('click'))}),o.one('hidden.bs.modal',function(t){t.target===this&&o.remove()}),o.one('shown.bs.modal',function(){o.find('.bootbox-accept:first').trigger('focus')}),'static'!==t.backdrop&&o.on('click.dismiss.bs.modal',function(t){o.children('.modal-backdrop').length&&(t.currentTarget=o.children('.modal-backdrop').get(0)),t.target===t.currentTarget&&o.trigger('escape.close.bb')}),o.on('escape.close.bb',function(t){s.onEscape&&v(t,o,s.onEscape)}),o.on('click','.modal-footer button:not(.disabled)',function(t){var e=p(this).data('bb-handler');v(t,o,s[e])}),o.on('click','.bootbox-close-button',function(t){v(t,o,s.onEscape)}),o.on('keyup',function(t){27===t.which&&o.trigger('escape.close.bb')}),p(t.container).append(o),o.modal({backdrop:!!t.backdrop&&'static',keyboard:!1,show:!1}),t.show&&o.modal('show'),o},d.alert=function(){var t;if((t=h('alert',['ok'],['message','callback'],arguments)).callback&&!p.isFunction(t.callback))throw new Error('alert requires the "callback" property to be a function when provided');return t.buttons.ok.callback=t.onEscape=function(){return!p.isFunction(t.callback)||t.callback.call(this)},d.dialog(t)},d.confirm=function(){var t;if(t=h('confirm',['cancel','confirm'],['message','callback'],arguments),!p.isFunction(t.callback))throw new Error('confirm requires a callback');return t.buttons.cancel.callback=t.onEscape=function(){return t.callback.call(this,!1)},t.buttons.confirm.callback=function(){return t.callback.call(this,!0)},d.dialog(t)},d.prompt=function(){var r,e,t,n,o,a;if(t=p(f.form),(r=h('prompt',['cancel','confirm'],['title','callback'],arguments)).value||(r.value=m.value),r.inputType||(r.inputType=m.inputType),o=r.show===u?m.show:r.show,r.show=!1,r.buttons.cancel.callback=r.onEscape=function(){return r.callback.call(this,null)},r.buttons.confirm.callback=function(){var t;if('checkbox'===r.inputType)t=n.find('input:checked').map(function(){return p(this).val()}).get();else if('radio'===r.inputType)t=n.find('input:checked').val();else{if(n[0].checkValidity&&!n[0].checkValidity())return!1;t='select'===r.inputType&&!0===r.multiple?n.find('option:selected').map(function(){return p(this).val()}).get():n.val()}return r.callback.call(this,t)},!r.title)throw new Error('prompt requires a title');if(!p.isFunction(r.callback))throw new Error('prompt requires a callback');if(!f.inputs[r.inputType])throw new Error('Invalid prompt type');switch(n=p(f.inputs[r.inputType]),r.inputType){case'text':case'textarea':case'email':case'password':n.val(r.value),r.placeholder&&n.attr('placeholder',r.placeholder),r.pattern&&n.attr('pattern',r.pattern),r.maxlength&&n.attr('maxlength',r.maxlength),r.required&&n.prop({required:!0}),r.rows&&!isNaN(parseInt(r.rows))&&'textarea'===r.inputType&&n.attr({rows:r.rows});break;case'date':case'time':case'number':case'range':if(n.val(r.value),r.placeholder&&n.attr('placeholder',r.placeholder),r.pattern&&n.attr('pattern',r.pattern),r.required&&n.prop({required:!0}),'date'!==r.inputType&&r.step){if(!('any'===r.step||!isNaN(r.step)&&0<parseInt(r.step)))throw new Error('"step" must be a valid positive number or the value "any". See https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input#attr-step for more information.');n.attr('step',r.step)}(function(t,e,o){var a=!1,r=!0,n=!0;if('date'===t)e===u||(r=g(e))?o===u||(n=g(o))||console.warn('Browsers which natively support the "date" input type expect date values to be of the form "YYYY-MM-DD" (see ISO-8601 https://www.iso.org/iso-8601-date-and-time-format.html). Bootbox does not enforce this rule, but your max value may not be enforced by this browser.'):console.warn('Browsers which natively support the "date" input type expect date values to be of the form "YYYY-MM-DD" (see ISO-8601 https://www.iso.org/iso-8601-date-and-time-format.html). Bootbox does not enforce this rule, but your min value may not be enforced by this browser.');else if('time'===t){if(e!==u&&!(r=w(e)))throw new Error('"min" is not a valid time. See https://www.w3.org/TR/2012/WD-html-markup-20120315/datatypes.html#form.data.time for more information.');if(o!==u&&!(n=w(o)))throw new Error('"max" is not a valid time. See https://www.w3.org/TR/2012/WD-html-markup-20120315/datatypes.html#form.data.time for more information.')}else{if(e!==u&&isNaN(e))throw new Error('"min" must be a valid number. See https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input#attr-min for more information.');if(o!==u&&isNaN(o))throw new Error('"max" must be a valid number. See https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input#attr-max for more information.')}if(r&&n){if(o<=e)throw new Error('"max" must be greater than "min". See https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input#attr-max for more information.');a=!0}return a})(r.inputType,r.min,r.max)&&(r.min!==u&&n.attr('min',r.min),r.max!==u&&n.attr('max',r.max));break;case'select':var i={};if(a=r.inputOptions||[],!p.isArray(a))throw new Error('Please pass an array of input options');if(!a.length)throw new Error('prompt with "inputType" set to "select" requires at least one option');r.placeholder&&n.attr('placeholder',r.placeholder),r.required&&n.prop({required:!0}),r.multiple&&n.prop({multiple:!0}),O(a,function(t,e){var o=n;if(e.value===u||e.text===u)throw new Error('each option needs a "value" property and a "text" property');e.group&&(i[e.group]||(i[e.group]=p('<optgroup />').attr('label',e.group)),o=i[e.group]);var a=p(f.option);a.attr('value',e.value).text(e.text),o.append(a)}),O(i,function(t,e){n.append(e)}),n.val(r.value);break;case'checkbox':var l=p.isArray(r.value)?r.value:[r.value];if(!(a=r.inputOptions||[]).length)throw new Error('prompt with "inputType" set to "checkbox" requires at least one option');n=p('<div class="bootbox-checkbox-list"></div>'),O(a,function(t,o){if(o.value===u||o.text===u)throw new Error('each option needs a "value" property and a "text" property');var a=p(f.inputs[r.inputType]);a.find('input').attr('value',o.value),a.find('label').append('\n'+o.text),O(l,function(t,e){e===o.value&&a.find('input').prop('checked',!0)}),n.append(a)});break;case'radio':if(r.value!==u&&p.isArray(r.value))throw new Error('prompt with "inputType" set to "radio" requires a single, non-array value for "value"');if(!(a=r.inputOptions||[]).length)throw new Error('prompt with "inputType" set to "radio" requires at least one option');n=p('<div class="bootbox-radiobutton-list"></div>');var s=!0;O(a,function(t,e){if(e.value===u||e.text===u)throw new Error('each option needs a "value" property and a "text" property');var o=p(f.inputs[r.inputType]);o.find('input').attr('value',e.value),o.find('label').append('\n'+e.text),r.value!==u&&e.value===r.value&&(o.find('input').prop('checked',!0),s=!1),n.append(o)}),s&&n.find('input[type="radio"]').first().prop('checked',!0)}if(t.append(n),t.on('submit',function(t){t.preventDefault(),t.stopPropagation(),e.find('.bootbox-accept').trigger('click')}),''!==p.trim(r.message)){var c=p(f.promptMessage).html(r.message);t.prepend(c),r.message=t}else r.message=t;return(e=d.dialog(r)).off('shown.bs.modal'),e.on('shown.bs.modal',function(){n.focus()}),!0===o&&e.modal('show'),e},d.addLocale('en',{OK:'OK',CANCEL:'Cancel',CONFIRM:'OK'}),d});
!function(t,e){"object"==typeof exports&&"undefined"!=typeof module?e(exports):"function"==typeof define&&define.amd?define(["exports"],e):e(t.timeago={})}(this,function(t){"use strict";var f=[60,60,24,7,365/7/12,12],o=function(t){return parseInt(t)},n=function(t){return t instanceof Date?t:!isNaN(t)||/^\d+$/.test(t)?new Date(o(t)):(t=(t||"").trim().replace(/\.\d+/,"").replace(/-/,"/").replace(/-/,"/").replace(/(\d)T(\d)/,"$1 $2").replace(/Z/," UTC").replace(/([\+\-]\d\d)\:?(\d\d)/," $1$2"),new Date(t))},s=function(t,e){for(var n=0,r=t<0?1:0,a=t=Math.abs(t);f[n]<=t&&n<f.length;n++)t/=f[n];return(0===(n*=2)?9:1)<(t=o(t))&&(n+=1),e(t,n,a)[r].replace("%s",t)},d=function(t,e){return((e=e?n(e):new Date)-n(t))/1e3},r="second_minute_hour_day_week_month_year".split("_"),a="秒_分钟_小时_天_周_个月_年".split("_"),e=function(t,e){if(0===e)return["just now","right now"];var n=r[parseInt(e/2)];return 1<t&&(n+="s"),["".concat(t," ").concat(n," ago"),"in ".concat(t," ").concat(n)]},i={en_US:e,zh_CN:function(t,e){if(0===e)return["刚刚","片刻后"];var n=a[parseInt(e/2)];return["".concat(t," ").concat(n,"前"),"".concat(t," ").concat(n,"后")]}},c=function(t){return i[t]||e},l="timeago-tid",u=function(t,e){return t.getAttribute?t.getAttribute(e):t.attr?t.attr(e):void 0},p=function(t){return u(t,l)},_={},v=function(t){clearTimeout(t),delete _[t]},h=function t(e,n,r,a){v(p(e));var o=d(n,a);e.innerHTML=s(o,r);var i,c,u=setTimeout(function(){t(e,n,r,a)},1e3*function(t){for(var e=1,n=0,r=Math.abs(t);f[n]<=t&&n<f.length;n++)t/=f[n],e*=f[n];return r=(r%=e)?e-r:e,Math.ceil(r)}(o),2147483647);_[u]=0,c=u,(i=e).setAttribute?i.setAttribute(l,c):i.attr&&i.attr(l,c)};t.version="4.0.0-beta.2",t.format=function(t,e,n){var r=d(t,n);return s(r,c(e))},t.render=function(t,e,n){var r;void 0===t.length&&(t=[t]);for(var a=0;a<t.length;a++){r=t[a];var o=u(r,"datetime"),i=c(e);h(r,o,i,n)}return t},t.cancel=function(t){if(t)v(p(t));else for(var e in _)v(e)},t.register=function(t,e){i[t]=e},Object.defineProperty(t,"__esModule",{value:!0})});

!function(){"use strict";var t=[["ثانية","ثانيتين","%s ثوان","%s ثانية"],["دقيقة","دقيقتين","%s دقائق","%s دقيقة"],["ساعة","ساعتين","%s ساعات","%s ساعة"],["يوم","يومين","%s أيام","%s يوماً"],["أسبوع","أسبوعين","%s أسابيع","%s أسبوعاً"],["شهر","شهرين","%s أشهر","%s شهراً"],["عام","عامين","%s أعوام","%s عاماً"]];var e=s.bind(null,"секунду","%s секунду","%s секунды","%s секунд"),a=s.bind(null,"хвіліну","%s хвіліну","%s хвіліны","%s хвілін"),u=s.bind(null,"гадзіну","%s гадзіну","%s гадзіны","%s гадзін"),i=s.bind(null,"дзень","%s дзень","%s дні","%s дзён"),r=s.bind(null,"тыдзень","%s тыдзень","%s тыдні","%s тыдняў"),o=s.bind(null,"месяц","%s месяц","%s месяцы","%s месяцаў"),m=s.bind(null,"год","%s год","%s гады","%s гадоў");function s(s,n,e,a,u){var t=u%10,i=a;return 1===u?i=s:1===t&&20<u?i=n:1<t&&t<5&&(20<u||u<10)&&(i=e),i}var d=[["w tej chwili","za chwilę"],["%s sekund temu","za %s sekund"],["1 minutę temu","za 1 minutę"],["%s minut temu","za %s minut"],["1 godzinę temu","za 1 godzinę"],["%s godzin temu","za %s godzin"],["1 dzień temu","za 1 dzień"],["%s dni temu","za %s dni"],["1 tydzień temu","za 1 tydzień"],["%s tygodni temu","za %s tygodni"],["1 miesiąc temu","za 1 miesiąc"],["%s miesięcy temu","za %s miesięcy"],["1 rok temu","za 1 rok"],["%s lat temu","za %s lat"],["%s sekundy temu","za %s sekundy"],["%s minuty temu","za %s minuty"],["%s godziny temu","za %s godziny"],["%s dni temu","za %s dni"],["%s tygodnie temu","za %s tygodnie"],["%s miesiące temu","za %s miesiące"],["%s lata temu","za %s lata"]];var l=n.bind(null,"секунду","%s секунду","%s секунды","%s секунд"),c=n.bind(null,"минуту","%s минуту","%s минуты","%s минут"),h=n.bind(null,"час","%s час","%s часа","%s часов"),g=n.bind(null,"день","%s день","%s дня","%s дней"),p=n.bind(null,"неделю","%s неделю","%s недели","%s недель"),f=n.bind(null,"месяц","%s месяц","%s месяца","%s месяцев"),b=n.bind(null,"год","%s год","%s года","%s лет");function n(s,n,e,a,u){var t=u%10,i=a;return 1===u?i=s:1===t&&20<u?i=n:1<t&&t<5&&(20<u||u<10)&&(i=e),i}var k=M.bind(null,"1 секунд","%s секунд","%s секунде","%s секунди"),y=M.bind(null,"1 минут","%s минут","%s минуте","%s минута"),v=M.bind(null,"сат времена","%s сат","%s сата","%s сати"),j=M.bind(null,"1 дан","%s дан","%s дана","%s дана"),z=M.bind(null,"недељу дана","%s недељу","%s недеље","%s недеља"),q=M.bind(null,"месец дана","%s месец","%s месеца","%s месеци"),w=M.bind(null,"годину дана","%s годину","%s године","%s година");function M(s,n,e,a,u){var t=u%10,i=u%100;return 1==u?s:1==t&&11!=i?n:2<=t&&t<=4&&!(12<=i&&i<=14)?e:a}var _=O.bind(null,"секунду","%s секунду","%s секунди","%s секунд"),S=O.bind(null,"хвилину","%s хвилину","%s хвилини","%s хвилин"),W=O.bind(null,"годину","%s годину","%s години","%s годин"),N=O.bind(null,"день","%s день","%s дні","%s днів"),T=O.bind(null,"тиждень","%s тиждень","%s тиждні","%s тижднів"),J=O.bind(null,"місяць","%s місяць","%s місяці","%s місяців"),I=O.bind(null,"рік","%s рік","%s роки","%s років");function O(s,n,e,a,u){var t=u%10,i=a;return 1===u?i=s:1===t&&20<u?i=n:1<t&&t<5&&(20<u||u<10)&&(i=e),i}var x=Object.freeze({ar:function(s,n){if(0===n)return["منذ لحظات","بعد لحظات"];var e,a,u=(e=Math.floor(n/2),(a=s)<3?t[e][a-1]:3<=a&&a<=10?t[e][2]:t[e][3]);return["منذ "+u,"بعد "+u]},be:function(s,n){switch(n){case 0:return["толькі што","праз некалькі секунд"];case 1:return[e(s)+" таму","праз "+e(s)];case 2:case 3:return[a(s)+" таму","праз "+a(s)];case 4:case 5:return[u(s)+" таму","праз "+u(s)];case 6:case 7:return[i(s)+" таму","праз "+i(s)];case 8:case 9:return[r(s)+" таму","праз "+r(s)];case 10:case 11:return[o(s)+" таму","праз "+o(s)];case 12:case 13:return[m(s)+" таму","праз "+m(s)];default:return["",""]}},bg:function(s,n){return[["току що","съвсем скоро"],["преди %s секунди","след %s секунди"],["преди 1 минута","след 1 минута"],["преди %s минути","след %s минути"],["преди 1 час","след 1 час"],["преди %s часа","след %s часа"],["преди 1 ден","след 1 ден"],["преди %s дни","след %s дни"],["преди 1 седмица","след 1 седмица"],["преди %s седмици","след %s седмици"],["преди 1 месец","след 1 месец"],["преди %s месеца","след %s месеца"],["преди 1 година","след 1 година"],["преди %s години","след %s години"]][n]},bn_IN:function(s,n){return[["এইমাত্র","একটা সময়"],["%s সেকেন্ড আগে","%s এর সেকেন্ডের মধ্যে"],["1 মিনিট আগে","1 মিনিটে"],["%s এর মিনিট আগে","%s এর মিনিটের মধ্যে"],["1 ঘন্টা আগে","1 ঘন্টা"],["%s ঘণ্টা আগে","%s এর ঘন্টার মধ্যে"],["1 দিন আগে","1 দিনের মধ্যে"],["%s এর দিন আগে","%s এর দিন"],["1 সপ্তাহ আগে","1 সপ্তাহের মধ্যে"],["%s এর সপ্তাহ আগে","%s সপ্তাহের মধ্যে"],["1 মাস আগে","1 মাসে"],["%s মাস আগে","%s মাসে"],["1 বছর আগে","1 বছরের মধ্যে"],["%s বছর আগে","%s বছরে"]][n]},ca:function(s,n){return[["fa un moment","d'aquí un moment"],["fa %s segons","d'aquí %s segons"],["fa 1 minut","d'aquí 1 minut"],["fa %s minuts","d'aquí %s minuts"],["fa 1 hora","d'aquí 1 hora"],["fa %s hores","d'aquí %s hores"],["fa 1 dia","d'aquí 1 dia"],["fa %s dies","d'aquí %s dies"],["fa 1 setmana","d'aquí 1 setmana"],["fa %s setmanes","d'aquí %s setmanes"],["fa 1 mes","d'aquí 1 mes"],["fa %s mesos","d'aquí %s mesos"],["fa 1 any","d'aquí 1 any"],["fa %s anys","d'aquí %s anys"]][n]},de:function(s,n){return[["gerade eben","vor einer Weile"],["vor %s Sekunden","in %s Sekunden"],["vor 1 Minute","in 1 Minute"],["vor %s Minuten","in %s Minuten"],["vor 1 Stunde","in 1 Stunde"],["vor %s Stunden","in %s Stunden"],["vor 1 Tag","in 1 Tag"],["vor %s Tagen","in %s Tagen"],["vor 1 Woche","in 1 Woche"],["vor %s Wochen","in %s Wochen"],["vor 1 Monat","in 1 Monat"],["vor %s Monaten","in %s Monaten"],["vor 1 Jahr","in 1 Jahr"],["vor %s Jahren","in %s Jahren"]][n]},el:function(s,n){return[["μόλις τώρα","σε λίγο"],["%s δευτερόλεπτα πριν","σε %s δευτερόλεπτα"],["1 λεπτό πριν","σε 1 λεπτό"],["%s λεπτά πριν","σε %s λεπτά"],["1 ώρα πριν","σε 1 ώρα"],["%s ώρες πριν","σε %s ώρες"],["1 μέρα πριν","σε 1 μέρα"],["%s μέρες πριν","σε %s μέρες"],["1 εβδομάδα πριν","σε 1 εβδομάδα"],["%s εβδομάδες πριν","σε %s εβδομάδες"],["1 μήνα πριν","σε 1 μήνα"],["%s μήνες πριν","σε %s μήνες"],["1 χρόνο πριν","σε 1 χρόνο"],["%s χρόνια πριν","σε %s χρόνια"]][n]},en_short:function(s,n){return[["just now","right now"],["%ss ago","in %ss"],["1m ago","in 1m"],["%sm ago","in %sm"],["1h ago","in 1h"],["%sh ago","in %sh"],["1d ago","in 1d"],["%sd ago","in %sd"],["1w ago","in 1w"],["%sw ago","in %sw"],["1mo ago","in 1mo"],["%smo ago","in %smo"],["1yr ago","in 1yr"],["%syr ago","in %syr"]][n]},es:function(s,n){return[["justo ahora","en un rato"],["hace %s segundos","en %s segundos"],["hace 1 minuto","en 1 minuto"],["hace %s minutos","en %s minutos"],["hace 1 hora","en 1 hora"],["hace %s horas","en %s horas"],["hace 1 día","en 1 día"],["hace %s días","en %s días"],["hace 1 semana","en 1 semana"],["hace %s semanas","en %s semanas"],["hace 1 mes","en 1 mes"],["hace %s meses","en %s meses"],["hace 1 año","en 1 año"],["hace %s años","en %s años"]][n]},eu:function(s,n){return[["orain","denbora bat barru"],["duela %s segundu","%s segundu barru"],["duela minutu 1","minutu 1 barru"],["duela %s minutu","%s minutu barru"],["duela ordu 1","ordu 1 barru"],["duela %s ordu","%s ordu barru"],["duela egun 1","egun 1 barru"],["duela %s egun","%s egun barru"],["duela aste 1","aste 1 barru"],["duela %s aste","%s aste barru"],["duela hillabete 1","hillabete 1 barru"],["duela %s hillabete","%s hillabete barru"],["duela urte 1","urte 1 barru"],["duela %s urte","%s urte barru"]][n]},fa:function(s,n){return[["همین الآن","لحظاتی پیش"],["%s ثانیه پیش","حدود %s ثانیه پیش"],["1 دقیقه پیش","حدود 1 دقیقه پیش"],["%s دقیقه پیش","حدود %s دقیقه پیش"],["1 ساعت پیش","حدود 1 ساعت پیش"],["%s ساعت پیش","حدود %s ساعت پیش"],["1 روز پیش","حدود 1 روز پیش"],["%s روز پیش","حدود %s روز پیش"],["1 هفته پیش","حدود 1 هفته پیش"],["%s هفته پیش","حدود %s هفته پیش"],["1 ماه پیش","حدود 1 ماه پیش"],["%s ماه پیش","حدود %s ماه پیش"],["1 سال پیش","حدود 1 سال پیش"],["%s سال پیش","حدود %s سال پیش"]][n]},fi:function(s,n){return[["juuri äsken","juuri nyt"],["%s sekuntia sitten","%s sekunnin päästä"],["minuutti sitten","minuutin päästä"],["%s minuuttia sitten","%s minuutin päästä"],["tunti sitten","tunnin päästä"],["%s tuntia sitten","%s tunnin päästä"],["päivä sitten","päivän päästä"],["%s päivää sitten","%s päivän päästä"],["viikko sitten","viikon päästä"],["%s viikkoa sitten","%s viikon päästä"],["kuukausi sitten","kuukauden päästä"],["%s kuukautta sitten","%s kuukauden päästä"],["vuosi sitten","vuoden päästä"],["%s vuotta sitten","%s vuoden päästä"]][n]},fr:function(s,n){return[["à l'instant","dans un instant"],["il y a %s secondes","dans %s secondes"],["il y a 1 minute","dans 1 minute"],["il y a %s minutes","dans %s minutes"],["il y a 1 heure","dans 1 heure"],["il y a %s heures","dans %s heures"],["il y a 1 jour","dans 1 jour"],["il y a %s jours","dans %s jours"],["il y a 1 semaine","dans 1 semaine"],["il y a %s semaines","dans %s semaines"],["il y a 1 mois","dans 1 mois"],["il y a %s mois","dans %s mois"],["il y a 1 an","dans 1 an"],["il y a %s ans","dans %s ans"]][n]},gl:function(s,n){return[["xusto agora","daquí a un pouco"],["hai %s segundos","en %s segundos"],["hai 1 minuto","nun minuto"],["hai %s minutos","en %s minutos"],["hai 1 hora","nunha hora"],["hai %s horas","en %s horas"],["hai 1 día","nun día"],["hai %s días","en %s días"],["hai 1 semana","nunha semana"],["hai %s semanas","en %s semanas"],["hai 1 mes","nun mes"],["hai %s meses","en %s meses"],["hai 1 ano","nun ano"],["hai %s anos","en %s anos"]][n]},he:function(s,n){return[["זה עתה","עכשיו"],["לפני %s שניות","בעוד %s שניות"],["לפני דקה","בעוד דקה"],["לפני %s דקות","בעוד %s דקות"],["לפני שעה","בעוד שעה"],["לפני %s שעות","בעוד %s שעות"],["אתמול","מחר"],["לפני %s ימים","בעוד %s ימים"],["לפני שבוע","בעוד שבוע"],["לפני %s שבועות","בעוד %s שבועות"],["לפני חודש","בעוד חודש"],["לפני %s חודשים","בעוד %s חודשים"],["לפני שנה","בעוד שנה"],["לפני %s שנים","בעוד %s שנים"]][n]},hi_IN:function(s,n){return[["अभी","कुछ समय"],["%s सेकंड पहले","%s सेकंड में"],["1 मिनट पहले","1 मिनट में"],["%s मिनट पहले","%s मिनट में"],["1 घंटे पहले","1 घंटे में"],["%s घंटे पहले","%s घंटे में"],["1 दिन पहले","1 दिन में"],["%s दिन पहले","%s दिनों में"],["1 सप्ताह पहले","1 सप्ताह में"],["%s हफ्ते पहले","%s हफ्तों में"],["1 महीने पहले","1 महीने में"],["%s महीने पहले","%s महीनों में"],["1 साल पहले","1 साल में"],["%s साल पहले","%s साल में"]][n]},hu:function(s,n){return[["éppen most","éppen most"],["%s másodperce","%s másodpercen belül"],["1 perce","1 percen belül"],["%s perce","%s percen belül"],["1 órája","1 órán belül"],["%s órája","%s órán belül"],["1 napja","1 napon belül"],["%s napja","%s napon belül"],["1 hete","1 héten belül"],["%s hete","%s héten belül"],["1 hónapja","1 hónapon belül"],["%s hónapja","%s hónapon belül"],["1 éve","1 éven belül"],["%s éve","%s éven belül"]][n]},id_ID:function(s,n){return[["baru saja","sebentar"],["%s detik yang lalu","dalam %s detik"],["1 menit yang lalu","dalam 1 menit"],["%s menit yang lalu","dalam %s menit"],["1 jam yang lalu","dalam 1 jam"],["%s jam yang lalu","dalam %s jam"],["1 hari yang lalu","dalam 1 hari"],["%s hari yang lalu","dalam %s hari"],["1 minggu yang lalu","dalam 1 minggu"],["%s minggu yang lalu","dalam %s minggu"],["1 bulan yang lalu","dalam 1 bulan"],["%s bulan yang lalu","dalam %s bulan"],["1 tahun yang lalu","dalam 1 tahun"],["%s tahun yang lalu","dalam %s tahun"]][n]},it:function(s,n){return[["poco fa","tra poco"],["%s secondi fa","%s secondi da ora"],["un minuto fa","un minuto da ora"],["%s minuti fa","%s minuti da ora"],["un'ora fa","un'ora da ora"],["%s ore fa","%s ore da ora"],["un giorno fa","un giorno da ora"],["%s giorni fa","%s giorni da ora"],["una settimana fa","una settimana da ora"],["%s settimane fa","%s settimane da ora"],["un mese fa","un mese da ora"],["%s mesi fa","%s mesi da ora"],["un anno fa","un anno da ora"],["%s anni fa","%s anni da ora"]][n]},ja:function(s,n){return[["すこし前","すぐに"],["%s秒前","%s秒以内"],["1分前","1分以内"],["%s分前","%s分以内"],["1時間前","1時間以内"],["%s時間前","%s時間以内"],["1日前","1日以内"],["%s日前","%s日以内"],["1週間前","1週間以内"],["%s週間前","%s週間以内"],["1ヶ月前","1ヶ月以内"],["%sヶ月前","%sヶ月以内"],["1年前","1年以内"],["%s年前","%s年以内"]][n]},ko:function(s,n){return[["방금","곧"],["%s초 전","%s초 후"],["1분 전","1분 후"],["%s분 전","%s분 후"],["1시간 전","1시간 후"],["%s시간 전","%s시간 후"],["1일 전","1일 후"],["%s일 전","%s일 후"],["1주일 전","1주일 후"],["%s주일 전","%s주일 후"],["1개월 전","1개월 후"],["%s개월 전","%s개월 후"],["1년 전","1년 후"],["%s년 전","%s년 후"]][n]},ml:function(s,n){return[["ഇപ്പോള്‍","കുറച്ചു മുന്‍പ്"],["%s സെക്കന്റ്‌കള്‍ക്ക് മുന്‍പ്","%s സെക്കന്റില്‍"],["1 മിനിറ്റിനു മുന്‍പ്","1 മിനിറ്റില്‍"],["%s മിനിറ്റുകള്‍ക്ക് മുന്‍പ","%s മിനിറ്റില്‍"],["1 മണിക്കൂറിനു മുന്‍പ്","1 മണിക്കൂറില്‍"],["%s മണിക്കൂറുകള്‍ക്കു മുന്‍പ്","%s മണിക്കൂറില്‍"],["1 ഒരു ദിവസം മുന്‍പ്","1 ദിവസത്തില്‍"],["%s ദിവസങ്ങള്‍ക് മുന്‍പ്","%s ദിവസങ്ങള്‍ക്കുള്ളില്‍"],["1 ആഴ്ച മുന്‍പ്","1 ആഴ്ചയില്‍"],["%s ആഴ്ചകള്‍ക്ക് മുന്‍പ്","%s ആഴ്ചകള്‍ക്കുള്ളില്‍"],["1 മാസത്തിനു മുന്‍പ്","1 മാസത്തിനുള്ളില്‍"],["%s മാസങ്ങള്‍ക്ക് മുന്‍പ്","%s മാസങ്ങള്‍ക്കുള്ളില്‍"],["1 വര്‍ഷത്തിനു  മുന്‍പ്","1 വര്‍ഷത്തിനുള്ളില്‍"],["%s വര്‍ഷങ്ങള്‍ക്കു മുന്‍പ്","%s വര്‍ഷങ്ങള്‍ക്കുല്ല്ളില്‍"]][n]},my:function(s,n){return[["ယခုအတွင်း","ယခု"],["%s စက္ကန့် အကြာက","%s စက္ကန့်အတွင်း"],["1 မိနစ် အကြာက","1 မိနစ်အတွင်း"],["%s မိနစ် အကြာက","%s မိနစ်အတွင်း"],["1 နာရီ အကြာက","1 နာရီအတွင်း"],["%s နာရီ အကြာက","%s နာရီအတွင်း"],["1 ရက် အကြာက","1 ရက်အတွင်း"],["%s ရက် အကြာက","%s ရက်အတွင်း"],["1 ပတ် အကြာက","1 ပတ်အတွင်း"],["%s ပတ် အကြာက","%s ပတ်အတွင်း"],["1 လ အကြာက","1 လအတွင်း"],["%s လ အကြာက","%s လအတွင်း"],["1 နှစ် အကြာက","1 နှစ်အတွင်း"],["%s နှစ် အကြာက","%s နှစ်အတွင်း"]][n]},nb_NO:function(s,n){return[["akkurat nå","om litt"],["%s sekunder siden","om %s sekunder"],["1 minutt siden","om 1 minutt"],["%s minutter siden","om %s minutter"],["1 time siden","om 1 time"],["%s timer siden","om %s timer"],["1 dag siden","om 1 dag"],["%s dager siden","om %s dager"],["1 uke siden","om 1 uke"],["%s uker siden","om %s uker"],["1 måned siden","om 1 måned"],["%s måneder siden","om %s måneder"],["1 år siden","om 1 år"],["%s år siden","om %s år"]][n]},nl:function(s,n){return[["recent","binnenkort"],["%s seconden geleden","binnen %s seconden"],["1 minuut geleden","binnen 1 minuut"],["%s minuten geleden","binnen %s minuten"],["1 uur geleden","binnen 1 uur"],["%s uur geleden","binnen %s uur"],["1 dag geleden","binnen 1 dag"],["%s dagen geleden","binnen %s dagen"],["1 week geleden","binnen 1 week"],["%s weken geleden","binnen %s weken"],["1 maand geleden","binnen 1 maand"],["%s maanden geleden","binnen %s maanden"],["1 jaar geleden","binnen 1 jaar"],["%s jaar geleden","binnen %s jaar"]][n]},nn_NO:function(s,n){return[["nett no","om litt"],["%s sekund sidan","om %s sekund"],["1 minutt sidan","om 1 minutt"],["%s minutt sidan","om %s minutt"],["1 time sidan","om 1 time"],["%s timar sidan","om %s timar"],["1 dag sidan","om 1 dag"],["%s dagar sidan","om %s dagar"],["1 veke sidan","om 1 veke"],["%s veker sidan","om %s veker"],["1 månad sidan","om 1 månad"],["%s månadar sidan","om %s månadar"],["1 år sidan","om 1 år"],["%s år sidan","om %s år"]][n]},pl:function(s,n){return d[1&n?4<s%10||s%10<2||1==~~(s/10)%10?n:++n/2+13:n]},pt_BR:function(s,n){return[["agora mesmo","daqui um pouco"],["há %s segundos","em %s segundos"],["há um minuto","em um minuto"],["há %s minutos","em %s minutos"],["há uma hora","em uma hora"],["há %s horas","em %s horas"],["há um dia","em um dia"],["há %s dias","em %s dias"],["há uma semana","em uma semana"],["há %s semanas","em %s semanas"],["há um mês","em um mês"],["há %s meses","em %s meses"],["há um ano","em um ano"],["há %s anos","em %s anos"]][n]},ro:function(s,n){var e=[["chiar acum","chiar acum"],["acum %s secunde","peste %s secunde"],["acum un minut","peste un minut"],["acum %s minute","peste %s minute"],["acum o oră","peste o oră"],["acum %s ore","peste %s ore"],["acum o zi","peste o zi"],["acum %s zile","peste %s zile"],["acum o săptămână","peste o săptămână"],["acum %s săptămâni","peste %s săptămâni"],["acum o lună","peste o lună"],["acum %s luni","peste %s luni"],["acum un an","peste un an"],["acum %s ani","peste %s ani"]];return s<20?e[n]:[e[n][0].replace("%s","%s de"),e[n][1].replace("%s","%s de")]},ru:function(s,n){switch(n){case 0:return["только что","через несколько секунд"];case 1:return[l(s)+" назад","через "+l(s)];case 2:case 3:return[c(s)+" назад","через "+c(s)];case 4:case 5:return[h(s)+" назад","через "+h(s)];case 6:return["вчера","завтра"];case 7:return[g(s)+" назад","через "+g(s)];case 8:case 9:return[p(s)+" назад","через "+p(s)];case 10:case 11:return[f(s)+" назад","через "+f(s)];case 12:case 13:return[b(s)+" назад","через "+b(s)];default:return["",""]}},sq:function(s,n){return[["pak më parë","pas pak"],["para %s sekondash","pas %s sekondash"],["para një minute","pas një minute"],["para %s minutash","pas %s minutash"],["para një ore","pas një ore"],["para %s orësh","pas %s orësh"],["dje","nesër"],["para %s ditësh","pas %s ditësh"],["para një jave","pas një jave"],["para %s javësh","pas %s javësh"],["para një muaji","pas një muaji"],["para %s muajsh","pas %s muajsh"],["para një viti","pas një viti"],["para %s vjetësh","pas %s vjetësh"]][n]},sr:function(s,n){switch(n){case 0:return["малопре","управо сад"];case 1:return["пре "+k(s),"за "+k(s)];case 2:case 3:return["пре "+y(s),"за "+y(s)];case 4:case 5:return["пре "+v(s),"за "+v(s)];case 6:case 7:return["пре "+j(s),"за "+j(s)];case 8:case 9:return["пре "+z(s),"за "+z(s)];case 10:case 11:return["пре "+q(s),"за "+q(s)];case 12:case 13:return["пре "+w(s),"за "+w(s)];default:return["",""]}},sv:function(s,n){return[["just nu","om en stund"],["%s sekunder sedan","om %s sekunder"],["1 minut sedan","om 1 minut"],["%s minuter sedan","om %s minuter"],["1 timme sedan","om 1 timme"],["%s timmar sedan","om %s timmar"],["1 dag sedan","om 1 dag"],["%s dagar sedan","om %s dagar"],["1 vecka sedan","om 1 vecka"],["%s veckor sedan","om %s veckor"],["1 månad sedan","om 1 månad"],["%s månader sedan","om %s månader"],["1 år sedan","om 1 år"],["%s år sedan","om %s år"]][n]},ta:function(s,n){return[["இப்போது","சற்று நேரம் முன்பு"],["%s நொடிக்கு முன்","%s நொடிகளில்"],["1 நிமிடத்திற்க்கு முன்","1 நிமிடத்தில்"],["%s நிமிடத்திற்க்கு முன்","%s நிமிடங்களில்"],["1 மணி நேரத்திற்கு முன்","1 மணி நேரத்திற்குள்"],["%s மணி நேரத்திற்கு முன்","%s மணி நேரத்திற்குள்"],["1 நாளுக்கு முன்","1 நாளில்"],["%s நாட்களுக்கு முன்","%s நாட்களில்"],["1 வாரத்திற்கு முன்","1 வாரத்தில்"],["%s வாரங்களுக்கு முன்","%s வாரங்களில்"],["1 மாதத்திற்கு முன்","1 மாதத்தில்"],["%s மாதங்களுக்கு முன்","%s மாதங்களில்"],["1 வருடத்திற்கு முன்","1 வருடத்தில்"],["%s வருடங்களுக்கு முன்","%s வருடங்களில்"]][n]},th:function(s,n){return[["เมื่อสักครู่นี้","อีกสักครู่"],["%s วินาทีที่แล้ว","ใน %s วินาที"],["1 นาทีที่แล้ว","ใน 1 นาที"],["%s นาทีที่แล้ว","ใน %s นาที"],["1 ชั่วโมงที่แล้ว","ใน 1 ชั่วโมง"],["%s ชั่วโมงที่แล้ว","ใน %s ชั่วโมง"],["1 วันที่แล้ว","ใน 1 วัน"],["%s วันที่แล้ว","ใน %s วัน"],["1 อาทิตย์ที่แล้ว","ใน 1 อาทิตย์"],["%s อาทิตย์ที่แล้ว","ใน %s อาทิตย์"],["1 เดือนที่แล้ว","ใน 1 เดือน"],["%s เดือนที่แล้ว","ใน %s เดือน"],["1 ปีที่แล้ว","ใน 1 ปี"],["%s ปีที่แล้ว","ใน %s ปี"]][n]},tr:function(s,n){return[["az önce","şimdi"],["%s saniye önce","%s saniye içinde"],["1 dakika önce","1 dakika içinde"],["%s dakika önce","%s dakika içinde"],["1 saat önce","1 saat içinde"],["%s saat önce","%s saat içinde"],["1 gün önce","1 gün içinde"],["%s gün önce","%s gün içinde"],["1 hafta önce","1 hafta içinde"],["%s hafta önce","%s hafta içinde"],["1 ay önce","1 ay içinde"],["%s ay önce","%s ay içinde"],["1 yıl önce","1 yıl içinde"],["%s yıl önce","%s yıl içinde"]][n]},uk:function(s,n){switch(n){case 0:return["щойно","через декілька секунд"];case 1:return[_(s)+" тому","через "+_(s)];case 2:case 3:return[S(s)+" тому","через "+S(s)];case 4:case 5:return[W(s)+" тому","через "+W(s)];case 6:case 7:return[N(s)+" тому","через "+N(s)];case 8:case 9:return[T(s)+" тому","через "+T(s)];case 10:case 11:return[J(s)+" тому","через "+J(s)];case 12:case 13:return[I(s)+" тому","через "+I(s)];default:return["",""]}},vi:function(s,n){return[["vừa xong","một lúc"],["%s giây trước","trong %s giây"],["1 phút trước","trong 1 phút"],["%s phút trước","trong %s phút"],["1 giờ trước","trong 1 giờ"],["%s giờ trước","trong %s giờ"],["1 ngày trước","trong 1 ngày"],["%s ngày trước","trong %s ngày"],["1 tuần trước","trong 1 tuần"],["%s tuần trước","trong %s tuần"],["1 tháng trước","trong 1 tháng"],["%s tháng trước","trong %s tháng"],["1 năm trước","trong 1 năm"],["%s năm trước","trong %s năm"]][n]},zh_CN:function(s,n){return[["刚刚","片刻后"],["%s 秒前","%s 秒后"],["1 分钟前","1 分钟后"],["%s 分钟前","%s 分钟后"],["1 小时前","1小 时后"],["%s 小时前","%s 小时后"],["1 天前","1 天后"],["%s 天前","%s 天后"],["1 周前","1 周后"],["%s 周前","%s 周后"],["1 月前","1 月后"],["%s 月前","%s 月后"],["1 年前","1 年后"],["%s 年前","%s 年后"]][n]},zh_TW:function(s,n){return[["剛剛","片刻後"],["%s 秒前","%s 秒後"],["1 分鐘前","1 分鐘後"],["%s 分鐘前","%s 分鐘後"],["1 小時前","1 小時後"],["%s 小時前","%s 小時後"],["1 天前","1 天後"],["%s 天前","%s 天後"],["1 週前","1 週後"],["%s 週前","%s 週後"],["1 月前","1 月後"],["%s 月前","%s 月後"],["1 年前","1 年後"],["%s 年前","%s 年後"]][n]}});for(var B in x)timeago.register(B,x[B])}();

window.Pilot = {
    username: null,
    password: null,
    proxy: null
}

$(function() {

    $('#accounts > tbody > tr').each(function() {
        var $row = $(this);
        var username = $row.data('username');
        var request = $.get('https://www.instagram.com/' + username + '/', function(response) {

            $json = JSON.parse(response.split("window._sharedData = ")[1].split(";<\/script>")[0]);

            var $user = $json.entry_data.ProfilePage[0].graphql.user;
            var followed_by_count = $user.edge_followed_by.count
            var following_count = $user.edge_follow.count
            var posts_count = $user.edge_owner_to_timeline_media.count
            var avatar = response.match(/<meta property="og:image" content="(.*?)" \/>/)[1];

            $row.find('td:first > div.avatar').css('background-image', 'url(' + avatar + ')');
            $row.find('span.followers').text(followed_by_count);
            $row.find('span.following').text(following_count);
            $row.find('span.posts').text(posts_count);
        });
    });


    $('.btn-account-submit').on('click', function() {

        window.Pilot.username = $('input[name="username"]').val();
        window.Pilot.password = $('input[name="password"]').val();
        window.Pilot.proxy = $('input[name="proxy"]').val();

        $.ajax({
            type: 'POST',
            url: BASE_URL + '/account',
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'username' : window.Pilot.username,
                'password' : window.Pilot.password,
                'proxy' : window.Pilot.proxy
            },
            beforeSend: function(){
                $('.dimmer').addClass('active');
            },
            success: function( response ) {

                if (response['result'] == 'success') {

                    bootbox.alert({
                        locale: document.documentElement.lang,
                        centerVertical: true,
                        title: response['title'],
                        message: response['message'],
                        closeButton: false,
                        callback: function() {

                            $('.dimmer').removeClass('active');

                            window.location.replace(BASE_URL + '/account');
                        }
                    })

                } else if(response['result'] == 'two_factor') {

                    bootbox.prompt({
                        locale: document.documentElement.lang,
                        centerVertical: true,
                        title: response['title'],
                        message: response['message'],
                        closeButton: false,
                        inputType: 'number',
                        required: true,
                        callback: function(code) {

                            if (code == null) {
                                $('.dimmer').removeClass('active');
                            } else {
                                if (code.length != 6) {
                                    return false;
                                }

                                confirmTwoFactor(code);
                            }
                        }
                    });

                } else if(response['result'] == 'challenge_required') {

                    bootbox.prompt({
                        locale: document.documentElement.lang,
                        centerVertical: true,
                        title: response['title'],
                        message: response['message'],
                        closeButton: false,
                        inputType: 'radio',
                        inputOptions: [
                            {
                                text: 'SMS',
                                value: '0',
                            },
                            {
                                text: 'E-mail',
                                value: '1',
                            }
                        ],
                        callback: function (method) {

                            if (method == '0' || method == '1') {
                                challengeMethodRequest(response['api_path'], method);
                            } else {
                                $('.dimmer').removeClass('active');
                            }

                        }
                    });

                } else if (response['result'] == 'error') {

                    var bootboxBody = '<ul class="mb-0">';

                    $.each(response['errors'], function(k, v) {
                        bootboxBody += '<li>' + v + '</li>';
                    });

                    bootboxBody += '</ul>';

                    bootbox.alert({
                        locale: document.documentElement.lang,
                        centerVertical: true,
                        title: response['title'],
                        message: bootboxBody,
                        closeButton: false,
                        callback: function () {
                            $('.dimmer').removeClass('active');
                        }
                    });

                }

            },
            error: function( error ) {
                bootbox.alert({
                    closeButton: false,
                    message: 'Something went wrong. Please try again.'
                });
            }
        });

    });


    challengeMethodRequest = function(api_path, choice) {

        $.ajax({
            type: 'POST',
            url: BASE_URL + '/account/confirm',
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'action': 'request_challenge',
                'api_path': api_path,
                'choice': choice,
                'username' : window.Pilot.username,
                'password' : window.Pilot.password,
                'proxy' : window.Pilot.proxy
            },
            success: function( response ) {

                if (response['result'] == 'confirm_challenge') {

                    bootbox.prompt({
                        locale: document.documentElement.lang,
                        centerVertical: true,
                        title: response['title'],
                        message: response['message'],
                        closeButton: false,
                        inputType: 'number',
                        required: true,
                        callback: function(code) {

                            if (code == null) {
                                $('.dimmer').removeClass('active');
                            } else {
                                if (code.length != 6) {
                                    return false;
                                }

                                confirmChallenge(code, api_path);
                            }
                        }
                    });

                } else if (response['result'] == 'challenge_request_failed') {

                    bootbox.alert({
                        locale: document.documentElement.lang,
                        centerVertical: true,
                        title: response['title'],
                        message: response['message'],
                        closeButton: false,
                        callback: function () {
                            $('.dimmer').removeClass('active');
                        }
                    });

                } else if (response['result'] == 'error') {

                    var bootboxBody = '<ul class="mb-0">';

                    $.each(response['errors'], function(k, v) {
                        bootboxBody += '<li>' + v + '</li>';
                    });

                    bootboxBody += '</ul>';

                    bootbox.alert({
                        locale: document.documentElement.lang,
                        centerVertical: true,
                        title: response['title'],
                        message: bootboxBody,
                        closeButton: false,
                        callback: function () {
                            $('.dimmer').removeClass('active');
                        }
                    });

                }

            },
            error: function( error ) {
                bootbox.alert({
                    closeButton: false,
                    message: 'Something went wrong. Please try again.'
                });
            }
        });
    }

    confirmTwoFactor = function(code) {

        $.ajax({
            type: 'POST',
            url: BASE_URL + '/account/confirm',
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'action': 'confirm_twofactor_login',
                'code': code,
                'username' : window.Pilot.username,
                'password' : window.Pilot.password,
                'proxy' : window.Pilot.proxy
            },
            success: function( response ) {

                if (response['result'] == 'twofactor_success') {

                    bootbox.alert({
                        locale: document.documentElement.lang,
                        centerVertical: true,
                        title: response['title'],
                        message: response['message'],
                        closeButton: false,
                        callback: function() {

                            $('.dimmer').removeClass('active');

                            $('.btn-account-submit').trigger("click");
                        }
                    })

                } else if (response['result'] == 'invalid_sms_code') {

                    bootbox.prompt({
                        locale: document.documentElement.lang,
                        centerVertical: true,
                        title: response['title'],
                        message: response['message'],
                        closeButton: false,
                        inputType: 'number',
                        required: true,
                        callback: function(code) {

                            if (code == null) {
                                $('.dimmer').removeClass('active');
                            } else {
                                if (code.length != 6) {
                                    return false;
                                }

                                confirmTwoFactor(code);
                            }
                        }
                    });

                } else if (response['result'] == 'error') {

                    var bootboxBody = '<ul class="mb-0">';

                    $.each(response['errors'], function(k, v) {
                        bootboxBody += '<li>' + v + '</li>';
                    });

                    bootboxBody += '</ul>';

                    bootbox.alert({
                        locale: document.documentElement.lang,
                        centerVertical: true,
                        title: response['title'],
                        message: bootboxBody,
                        closeButton: false,
                        callback: function () {
                            $('.dimmer').removeClass('active');
                        }
                    });

                }

            },
            error: function( error ) {
                bootbox.alert({
                    closeButton: false,
                    message: 'Something went wrong. Please try again.'
                });
            }
        });
    }

    confirmChallenge = function(code, api_path) {

        $.ajax({
            type: 'POST',
            url: BASE_URL + '/account/confirm',
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'action': 'confirm_challenge',
                'code': code,
                'api_path': api_path,
                'username' : window.Pilot.username,
                'password' : window.Pilot.password,
                'proxy' : window.Pilot.proxy
            },
            success: function( response ) {

                if (response['result'] == 'challenge_success') {

                    bootbox.alert({
                        locale: document.documentElement.lang,
                        centerVertical: true,
                        title: response['title'],
                        message: response['message'],
                        closeButton: false,
                        callback: function() {

                            $('.dimmer').removeClass('active');

                            $('.btn-account-submit').trigger("click");

                        }
                    })

                } else if (response['result'] == 'error') {

                    var bootboxBody = '<ul class="mb-0">';

                    $.each(response['errors'], function(k, v) {
                        bootboxBody += '<li>' + v + '</li>';
                    });

                    bootboxBody += '</ul>';

                    bootbox.alert({
                        locale: document.documentElement.lang,
                        centerVertical: true,
                        title: response['title'],
                        message: bootboxBody,
                        closeButton: false,
                        callback: function () {
                            $('.dimmer').removeClass('active');
                        }
                    });

                }

            },
            error: function( error ) {
                bootbox.alert({
                    closeButton: false,
                    message: 'Something went wrong. Please try again.'
                });
            }
        });
    }

});
$(function() {

    $('input[name="audience"]').on('change', function() {
        var selected = $(this).val();

        switch(selected) {
            case '1':
                $('select[name="speed"]').val('25');
                $('select[name="speed"] option[value="86400"]').hide();
            case '2':
                $('select[name="speed"]').val('25');
                $('select[name="speed"] option[value="86400"]').hide();
            case '3':
                $('select[name="speed"]').val('25');
                $('select[name="speed"] option[value="86400"]').hide();
                $('.users_list').show('fast');
            break;
            case '4':
                $('select[name="speed"] option[value="86400"]').show();
                $('select[name="speed"]').val('86400');
                $('.users_list').hide('fast');
            break;
        }

    });

    $('.check_post').on('click', function() {
        var $input = $('input[name="post_url"]');
        var url = $input.val();

        if (url != '') {
            $.ajax({
                url: "https://api.instagram.com/oembed/",
                dataType: "json",
                data: {
                    url: url
                },
                beforeSend: function(){
                    $input.attr('disabled', true);
                },
                success: function( response ) {
                    $input
                        .removeClass('is-invalid')
                        .removeClass('state-invalid')
                        .addClass('is-valid')
                        .addClass('state-valid');

                    $('input[name="media_id"]').val(response.media_id);

                    $('#post_preview .post_thumbnail').attr('src', response.thumbnail_url);
                    $('#post_preview .post_author_name').html('<a href="' + response.author_url + '" target="_blank">' + response.author_name + '</a>');
                    $('#post_preview .post_title').html(response.title);
                    $('#post_preview').show();

                },
                complete: function() {
                    $input.attr('disabled', false);
                },
                error: function() {
                    $('#post_preview').hide();
                    $('input[name="media_id"]').val('');
                    $input
                        .addClass('is-invalid')
                        .addClass('state-invalid')
                        .removeClass('is-valid')
                        .removeClass('state-valid');
                }
            });
        }

    });


    $('input[name="message_type"]').on('change', function() {
        var selected = $(this).val();

        switch(selected) {
            case 'list':
                $('.options:not(.option_list)').hide('fast', function(){
                    $('.option_list').show('fast');
                    $('input[name="disappearing"]').attr('checked', false);
                    $('textarea[name="text"]').val('');
                    $('input[name="photo"]').val('');
                    $('input[name="video"]').val('');
                    $('input[name="hashtag"]').val('');
                    $('textarea[name="hashtag_text"]').val('');
                });
            break;
            case 'text':
                $('.options:not(.option_text)').hide('fast', function(){
                    $('.option_text').show('fast');
                    $('input[name="disappearing"]').attr('checked', false);
                    $('select[name="lists_id"]').val('');
                    $('input[name="photo"]').val('');
                    $('input[name="video"]').val('');
                    $('input[name="hashtag"]').val('');
                    $('textarea[name="hashtag_text"]').val('');
                });
            break;
            case 'like':
                $('.options:not(.option_like)').hide('fast', function(){
                    $('.option_like').show('fast');
                    $('input[name="disappearing"]').attr('checked', false);
                    $('textarea[name="text"]').val('');
                    $('select[name="lists_id"]').val('');
                    $('input[name="photo"]').val('');
                    $('input[name="video"]').val('');
                    $('input[name="hashtag"]').val('');
                    $('textarea[name="hashtag_text"]').val('');
                });
            break;
            case 'hashtag':
                $('.options:not(.option_hashtag)').hide('fast', function(){
                    $('.option_hashtag').show('fast');
                    $('input[name="disappearing"]').attr('checked', false);
                    $('select[name="lists_id"]').val('');
                    $('input[name="photo"]').val('');
                    $('input[name="video"]').val('');
                });
            break;
            case 'photo':
                $('.options:not(.option_photo)').hide('fast', function(){
                    $('input[name="disappearing"]').attr('checked', false);
                    $('textarea[name="text"]').val('');
                    $('select[name="lists_id"]').val('');
                    $('input[name="video"]').val('');
                    $('input[name="hashtag"]').val('');
                    $('textarea[name="hashtag_text"]').val('');

                    $('.option_photo').show('fast', function(){
                        $('.option_disappearing').show('fast');
                    });
                });
            break;
            case 'video':
                $('.options:not(.option_video)').hide('fast', function(){
                    $('input[name="disappearing"]').attr('checked', false);
                    $('textarea[name="text"]').val('');
                    $('select[name="lists_id"]').val('');
                    $('input[name="photo"]').val('');
                    $('input[name="hashtag"]').val('');
                    $('textarea[name="hashtag_text"]').val('');

                    $('.option_video').show('fast', function(){
                        $('.option_disappearing').show('fast');
                    });
                });
            break;
            case 'post':
                $('.options:not(.option_post)').hide('fast', function(){
                    $('.option_post').show('fast');
                    $('input[name="disappearing"]').attr('checked', false);
                    $('select[name="lists_id"]').val('');
                    $('input[name="photo"]').val('');
                    $('input[name="video"]').val('');
                });
            break;
        }

    });
});
$(function() {

    $('input[name="message_type"]').on('change', function() {
        var selected = $(this).val();

        if (selected == 'list') {
            $('#option_message').hide('fast', function(){
                $('#option_list').show('fast');
                $('textarea[name="text"]').val('');
            });
        } else {
            $('#option_list').hide('fast', function(){
                $('#option_message').show('fast');
                $('select[name="lists_id"]').val('');
            });
        }
    });

    $('input[name="activity_period"]').on('change', function() {
        var checked = $(this).is(":checked");

        if(checked){
            $('#date_and_time').slideDown();
        } else {
            $('#date_and_time').slideUp(500, function(){
                $('input[name="starts_at"]').val('');
                $('input[name="ends_at"]').val('');
            });
        }

    });

    $('input.dm-date-time-picker[type=text]').flatpickr({
        locale: document.documentElement.lang,
        enableTime: true,
        allowInput: true,
        time_24hr: true,
        enableSeconds: true,
        altInput: true,
        dateFormat: "Y-m-d H:i:S",
        altFormat: "H:i - F j, Y"
    });

});
$(function() {

    var $repeaterList = $('.repeater').repeater({
    	show: function () {
    		$(this).show();
            window.emojiPicker.discover();
        }
    });

	$('#addMultiple').on('shown.bs.modal', function (e) {
		$('#addMultiple textarea').focus();
	}).on('hidden.bs.modal', function (e) {
		$('#addMultiple textarea').val('');
		$('.searchByHashtagForm input[name="q"]').val('');
	});

    $('#addMultiple button.btn-parse').on('click', function(e) {

    	var clearUsernames = [];
    	var usernamesText = $('#addMultiple textarea').val().trim();

    	if (usernamesText != '') {

    		var usernames = usernamesText.split(/\r|\n/);

	    	if (usernames.length > 0) {

	    		$.each(usernames, function(i, username) {

	    			username = username.trim();

	    			if (username != '') {
	    				clearUsernames.push({
	    					'text' : username
	    				});
	    			}
	    		});

				if (clearUsernames.length > 0) {
					$repeaterList.setList(clearUsernames);
					$('#addMultiple').modal('hide');
				}
	    	}
    	}

    });


    $('.searchByHashtagForm button.btn').on('click', function(e) {

    	var $button = $(this);
    	var q = $('.searchByHashtagForm input[name="q"]').val().trim();
    	var account_id = $('.searchByHashtagForm select[name="account_id"]').val();

    	if (q != '' && account_id != '') {

    		$.ajax({
	            type: 'POST',
	            url: BASE_URL + '/users/list/search/hashtag',
	            data: {
	                '_token': $('meta[name="csrf-token"]').attr('content'),
	                'account_id' : account_id,
	                'q' : q,
	            },
	            beforeSend: function(){
	                $button.addClass('btn-loading');
	            },
	            success: function( response ) {
	                $button.removeClass('btn-loading');
	            	$.each(response, function(pk, username) {
	            		$('#addMultiple textarea').append(username + "\r\n");
	            	});
	            },
	            error: function( error ) {
	            	$button.removeClass('btn-loading');
	                bootbox.alert({
	                    closeButton: false,
	                    message: 'Something went wrong. Please try again.'
	                });
	            }
	        });


    	}
    });
});
$(function() {

  window.emojiPicker = new EmojiPicker({
    emojiable_selector: '[data-emojiable=true]',
    assetsPath: '/assets/img/',
    popupButtonClasses: 'fe fe-heart'
  });

  window.emojiPicker.discover();
});
window.Pilot = {
    account_id: null,
    inbox_cursor_id: null,
    thread_id: null,
    thread_cursor_id: null,
    inbox_timeout: 180,
    thread_timeout: 120
}

$(function() {

    setInterval(function(){
        if (window.Pilot.account_id != null) {
            window.Pilot.inbox_cursor_id = null;
            $('.unseen_count span').empty();
            getInbox();
        }
    }, window.Pilot.inbox_timeout * 1000);

    setInterval(function(){
        if (window.Pilot.account_id != null && window.Pilot.thread_id != null) {
            window.Pilot.thread_cursor_id = null;
            $('.unseen_count span').empty();
            getThread();
        }
    }, window.Pilot.thread_timeout * 1000);


    $('#account_id').on('change', function() {

        var account_id = $(this).val();

        if (account_id == '') {
            $('.alert-no-account').show();
            $('.dm-container').hide();
        } else {
            $('.alert-no-account').hide();
            $('.dm-container').show();
            $('.load-more-container .btn-load-more').hide();
            $('.unseen_count span').empty();

            window.Pilot.inbox_cursor_id = null;
            window.Pilot.thread_cursor_id = null;
            window.Pilot.account_id = account_id;

            getInbox();
        }
    });


    $('.btn-reload').on('click', function() {

        window.Pilot.inbox_cursor_id = null;
        window.Pilot.thread_cursor_id = null;
        $('.unseen_count span').empty();
        $('.load-more-container .btn-load-more').hide();

        getInbox();
    });


    $(document).on('click', '#threads_list table > tbody > tr', function(){

        var thread_id = $(this).data('id');

        if (typeof thread_id !== "undefined") {

            window.Pilot.thread_id = thread_id;

            $('#threads_list table > tbody > tr').removeClass('table-active');
            $(this).addClass('table-active');

            getThread();
        }

    });

    $(document).on('click', '.btn-load-more', function(){

        $btn = $('.btn-load-more');

        if ($btn.hasClass('btn-loading') == false) {
            $btn.addClass('btn-loading');
            getInbox();
        }

    });


    $('.btn-send-message').on('click', function() {

        $text = $('.message-text').val().trim();
        if ($text.length > 0) {
            sendMessage($text);
            $('input.message-text').val('');
            $('div.message-text').empty();

        }
    });


    scrollSmoothToBottom = function() {

        $div = $('#messages_list div.o-auto');
        $div.scrollTop($div[0].scrollHeight);
    }


    truncateText = function(text, length) {
        return text.length > length ? `${text.substr(0, length)}...` : text;
    }


    getInbox = function() {

        $threads_container = $('#threads_list table > tbody');

        if (window.Pilot.inbox_cursor_id == null) {
            $threads_container.empty();
            $('#messages_list ul').empty();
        }

        $.ajax({
            type: 'POST',
            url: BASE_URL + '/direct/' + window.Pilot.account_id,
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'cursor_id' : window.Pilot.inbox_cursor_id
            },
            beforeSend: function(){
                if (window.Pilot.inbox_cursor_id == null) {
                    $('#threads_list').addClass('active');
                }
            },
            success: function( response ) {

                if (response['result'] == 'success') {

                    if (response['threads'].length > 0) {

                        $('.unseen_count span').html(response['unseen_count']);

                        var html = '';

                        $.each(response['threads'], function(i, thread) {

                            var users_count = thread.users.length;

                            html += '<tr data-id="' + thread.thread_id + '">';
                            html += '    <td width="1" class="text-center text-nowrap">';

                            if (users_count == 1) {

                                html += '<div class="avatar d-block" style="background-image: url(\'' + thread.users[0].profile_pic_url + '\')"></div>';

                            } else {

                                html += '<div class="avatar-list avatar-list-stacked">';

                                $.each(thread.users, function(c, user) {

                                    if (c > 1) {
                                        return false;
                                    }

                                    html += '<span class="avatar" style="background-image: url(\'' + user.profile_pic_url + '\')"></span>';

                                });

                                html += '<span class="avatar">+' + (users_count - 2) + '</span>';

                                html += '</div>';
                            }

                            html += '    </td>';
                            html += '    <td>';
                            html += '        <div>' + thread.users[0].username + '</div>';
                            html += '        <div class="small text-muted">';
                            html += '            ' + truncateText(thread.last_item_text, 25) + '';
                            html += '        </div>';
                            html += '    </td>';
                            html += '</tr>';

                        });

                        if(response['has_older'] == true) {

                            window.Pilot.inbox_cursor_id = response['next_cursor_id'];

                            $('.load-more-container .btn-load-more').show();

                        } else {
                            $('.load-more-container .btn-load-more').hide();
                        }

                        $threads_container.append(html);
                    }

                } else {

                    bootbox.alert({
                        locale: document.documentElement.lang,
                        centerVertical: true,
                        title: response['title'],
                        message: response['message'],
                        closeButton: false
                    });

                }
            },
            complete: function() {
                $('#threads_list').removeClass('active');
                $('.btn-load-more').removeClass('btn-loading');
            },
            error: function( error ) {
                bootbox.alert({
                    closeButton: false,
                    message: 'Something went wrong. Please try again.'
                });
            }
        });
    }


    getThread = function() {

        $('#messages_list ul').empty();

        $.ajax({
            type: 'POST',
            url: BASE_URL + '/direct/' + window.Pilot.account_id + '/' + window.Pilot.thread_id,
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'cursor_id' : window.Pilot.thread_cursor_id
            },
            beforeSend: function(){
                $('#messages_list').addClass('active');
            },
            success: function( response ) {

                if (response['result'] == 'success') {

                    if (response.items.length > 0) {

                        $.each(response['items'], function(i, item) {

                            var html = '';

                            if (item.user.self == true) {

                                html += '<li class="list-group-item py-4">';
                                html += '   <div class="text-right">';
                                html += '       <small class="text-muted">' + timeago.format(item.item.timestamp / 1000, document.documentElement.lang) + '</small>';
                                html += '   </div>';
                                html += '   <div class="text-right">';
                                html +=        item.item.message;
                                html += '   </div>';
                                html += '</li>';

                            } else {

                                html += '<li class="list-group-item py-4">';
                                html += '    <div class="media">';
                                html += '        <div class="media-object avatar avatar-md mr-4" style="background-image: url(\'' + item.user.profile_pic_url + '\')"></div>';
                                html += '        <div class="media-body">';
                                html += '            <div class="media-heading">';
                                html += '                <small class="text-muted">' + timeago.format(item.item.timestamp / 1000, document.documentElement.lang) + '</small>';
                                html += '            </div>';
                                html += '            <div>';
                                html += '                <strong>' + item.user.username + '</strong>';
                                html +=                  item.item.message;
                                html += '            </div>';
                                html += '        </div>';
                                html += '    </div>';
                                html += '</li>';

                            }

                            $('#messages_list ul').append(html);

                            scrollSmoothToBottom();
                        });
                    }

                } else {

                    bootbox.alert({
                        locale: document.documentElement.lang,
                        centerVertical: true,
                        title: response['title'],
                        message: response['message'],
                        closeButton: false
                    });

                }
            },
            complete: function() {
                $('#messages_list').removeClass('active');
            },
            error: function( error ) {
                bootbox.alert({
                    closeButton: false,
                    message: 'Something went wrong. Please try again.'
                });
            }
        });

    }


    sendMessage = function(text) {

        $.ajax({
            type: 'POST',
            url: BASE_URL + '/direct/' + window.Pilot.account_id + '/' + window.Pilot.thread_id + '/send',
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'cursor_id' : window.Pilot.thread_cursor_id,
                'message': text
            },
            beforeSend: function(){

                var html = '';

                // ToDo: Highlight sending

                html += '<li class="list-group-item py-4">';
                html += '   <div class="text-right">';
                html += '       <small class="text-muted">' + timeago.format(new Date(), document.documentElement.lang) + '</small>';
                html += '   </div>';
                html += '   <div class="text-right">';
                html +=        text;
                html += '   </div>';
                html += '</li>';

                $('#messages_list ul').append(html);

                scrollSmoothToBottom();

            },
            success: function( response ) {

                if (response['result'] == 'success') {

                    // ToDo: Remove highlight

                } else {

                    bootbox.alert({
                        locale: document.documentElement.lang,
                        centerVertical: true,
                        title: response['title'],
                        message: response['message'],
                        closeButton: false
                    });

                }
            },
            complete: function() {
                $('#messages_list').removeClass('active');
            },
            error: function( error ) {
                bootbox.alert({
                    closeButton: false,
                    message: 'Something went wrong. Please try again.'
                });
            }
        });
    }


});