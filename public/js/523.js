/*! For license information please see 523.js.LICENSE.txt */
"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[523],{246:(t,e,r)=>{r.d(e,{Z:()=>a});var n=r(1519),o=r.n(n)()((function(t){return t[1]}));o.push([t.id,"span[data-v-ee93eb1c]{cursor:auto!important}",""]);const a=o},523:(t,e,r)=>{r.r(e),r.d(e,{default:()=>m});var n=r(9669),o=r.n(n),a=r(6455),i=r.n(a);function c(t){return c="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},c(t)}function s(){s=function(){return t};var t={},e=Object.prototype,r=e.hasOwnProperty,n=Object.defineProperty||function(t,e,r){t[e]=r.value},o="function"==typeof Symbol?Symbol:{},a=o.iterator||"@@iterator",i=o.asyncIterator||"@@asyncIterator",u=o.toStringTag||"@@toStringTag";function l(t,e,r){return Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}),t[e]}try{l({},"")}catch(t){l=function(t,e,r){return t[e]=r}}function h(t,e,r,o){var a=e&&e.prototype instanceof p?e:p,i=Object.create(a.prototype),c=new S(o||[]);return n(i,"_invoke",{value:L(t,r,c)}),i}function f(t,e,r){try{return{type:"normal",arg:t.call(e,r)}}catch(t){return{type:"throw",arg:t}}}t.wrap=h;var v={};function p(){}function d(){}function m(){}var y={};l(y,a,(function(){return this}));var g=Object.getPrototypeOf,w=g&&g(g(O([])));w&&w!==e&&r.call(w,a)&&(y=w);var b=m.prototype=p.prototype=Object.create(y);function _(t){["next","throw","return"].forEach((function(e){l(t,e,(function(t){return this._invoke(e,t)}))}))}function x(t,e){function o(n,a,i,s){var u=f(t[n],t,a);if("throw"!==u.type){var l=u.arg,h=l.value;return h&&"object"==c(h)&&r.call(h,"__await")?e.resolve(h.__await).then((function(t){o("next",t,i,s)}),(function(t){o("throw",t,i,s)})):e.resolve(h).then((function(t){l.value=t,i(l)}),(function(t){return o("throw",t,i,s)}))}s(u.arg)}var a;n(this,"_invoke",{value:function(t,r){function n(){return new e((function(e,n){o(t,r,e,n)}))}return a=a?a.then(n,n):n()}})}function L(t,e,r){var n="suspendedStart";return function(o,a){if("executing"===n)throw new Error("Generator is already running");if("completed"===n){if("throw"===o)throw a;return j()}for(r.method=o,r.arg=a;;){var i=r.delegate;if(i){var c=k(i,r);if(c){if(c===v)continue;return c}}if("next"===r.method)r.sent=r._sent=r.arg;else if("throw"===r.method){if("suspendedStart"===n)throw n="completed",r.arg;r.dispatchException(r.arg)}else"return"===r.method&&r.abrupt("return",r.arg);n="executing";var s=f(t,e,r);if("normal"===s.type){if(n=r.done?"completed":"suspendedYield",s.arg===v)continue;return{value:s.arg,done:r.done}}"throw"===s.type&&(n="completed",r.method="throw",r.arg=s.arg)}}}function k(t,e){var r=e.method,n=t.iterator[r];if(void 0===n)return e.delegate=null,"throw"===r&&t.iterator.return&&(e.method="return",e.arg=void 0,k(t,e),"throw"===e.method)||"return"!==r&&(e.method="throw",e.arg=new TypeError("The iterator does not provide a '"+r+"' method")),v;var o=f(n,t.iterator,e.arg);if("throw"===o.type)return e.method="throw",e.arg=o.arg,e.delegate=null,v;var a=o.arg;return a?a.done?(e[t.resultName]=a.value,e.next=t.nextLoc,"return"!==e.method&&(e.method="next",e.arg=void 0),e.delegate=null,v):a:(e.method="throw",e.arg=new TypeError("iterator result is not an object"),e.delegate=null,v)}function C(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function E(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function S(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(C,this),this.reset(!0)}function O(t){if(t){var e=t[a];if(e)return e.call(t);if("function"==typeof t.next)return t;if(!isNaN(t.length)){var n=-1,o=function e(){for(;++n<t.length;)if(r.call(t,n))return e.value=t[n],e.done=!1,e;return e.value=void 0,e.done=!0,e};return o.next=o}}return{next:j}}function j(){return{value:void 0,done:!0}}return d.prototype=m,n(b,"constructor",{value:m,configurable:!0}),n(m,"constructor",{value:d,configurable:!0}),d.displayName=l(m,u,"GeneratorFunction"),t.isGeneratorFunction=function(t){var e="function"==typeof t&&t.constructor;return!!e&&(e===d||"GeneratorFunction"===(e.displayName||e.name))},t.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,m):(t.__proto__=m,l(t,u,"GeneratorFunction")),t.prototype=Object.create(b),t},t.awrap=function(t){return{__await:t}},_(x.prototype),l(x.prototype,i,(function(){return this})),t.AsyncIterator=x,t.async=function(e,r,n,o,a){void 0===a&&(a=Promise);var i=new x(h(e,r,n,o),a);return t.isGeneratorFunction(r)?i:i.next().then((function(t){return t.done?t.value:i.next()}))},_(b),l(b,u,"Generator"),l(b,a,(function(){return this})),l(b,"toString",(function(){return"[object Generator]"})),t.keys=function(t){var e=Object(t),r=[];for(var n in e)r.push(n);return r.reverse(),function t(){for(;r.length;){var n=r.pop();if(n in e)return t.value=n,t.done=!1,t}return t.done=!0,t}},t.values=O,S.prototype={constructor:S,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=void 0,this.done=!1,this.delegate=null,this.method="next",this.arg=void 0,this.tryEntries.forEach(E),!t)for(var e in this)"t"===e.charAt(0)&&r.call(this,e)&&!isNaN(+e.slice(1))&&(this[e]=void 0)},stop:function(){this.done=!0;var t=this.tryEntries[0].completion;if("throw"===t.type)throw t.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var e=this;function n(r,n){return i.type="throw",i.arg=t,e.next=r,n&&(e.method="next",e.arg=void 0),!!n}for(var o=this.tryEntries.length-1;o>=0;--o){var a=this.tryEntries[o],i=a.completion;if("root"===a.tryLoc)return n("end");if(a.tryLoc<=this.prev){var c=r.call(a,"catchLoc"),s=r.call(a,"finallyLoc");if(c&&s){if(this.prev<a.catchLoc)return n(a.catchLoc,!0);if(this.prev<a.finallyLoc)return n(a.finallyLoc)}else if(c){if(this.prev<a.catchLoc)return n(a.catchLoc,!0)}else{if(!s)throw new Error("try statement without catch or finally");if(this.prev<a.finallyLoc)return n(a.finallyLoc)}}}},abrupt:function(t,e){for(var n=this.tryEntries.length-1;n>=0;--n){var o=this.tryEntries[n];if(o.tryLoc<=this.prev&&r.call(o,"finallyLoc")&&this.prev<o.finallyLoc){var a=o;break}}a&&("break"===t||"continue"===t)&&a.tryLoc<=e&&e<=a.finallyLoc&&(a=null);var i=a?a.completion:{};return i.type=t,i.arg=e,a?(this.method="next",this.next=a.finallyLoc,v):this.complete(i)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),v},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.finallyLoc===t)return this.complete(r.completion,r.afterLoc),E(r),v}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var r=this.tryEntries[e];if(r.tryLoc===t){var n=r.completion;if("throw"===n.type){var o=n.arg;E(r)}return o}}throw new Error("illegal catch attempt")},delegateYield:function(t,e,r){return this.delegate={iterator:O(t),resultName:e,nextLoc:r},"next"===this.method&&(this.arg=void 0),v}},t}function u(t,e,r,n,o,a,i){try{var c=t[a](i),s=c.value}catch(t){return void r(t)}c.done?e(s):Promise.resolve(s).then(n,o)}function l(t){return function(){var e=this,r=arguments;return new Promise((function(n,o){var a=t.apply(e,r);function i(t){u(a,n,o,i,c,"next",t)}function c(t){u(a,n,o,i,c,"throw",t)}i(void 0)}))}}const h={data:function(){return{user:[]}},methods:{fetchUser:function(){var t=this;return l(s().mark((function e(){var r;return s().wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return e.prev=0,e.next=3,o().get("http://localhost:8000/api/auth/list-user",{headers:{Authorization:"Bearer "+localStorage.getItem("token")}});case 3:r=e.sent,t.user=r.data.data,e.next=10;break;case 7:e.prev=7,e.t0=e.catch(0),console.error(e.t0);case 10:case"end":return e.stop()}}),e,null,[[0,7]])})))()},deleteItem:function(t){var e=this;return l(s().mark((function r(){return s().wrap((function(r){for(;;)switch(r.prev=r.next){case 0:return r.next=2,i().fire({title:"Apakah Anda yakin ingin menghapus data ini?",icon:"warning",showCancelButton:!0,confirmButtonColor:"#d33",cancelButtonColor:"#3085d6",confirmButtonText:"Hapus",cancelButtonText:"Batal"});case 2:if(!r.sent.isConfirmed){r.next=8;break}return o().delete("http://localhost:8000/api/auth/delete-user/".concat(t),{headers:{Authorization:"Bearer "+localStorage.getItem("token")}}).then((function(t){console.log(t.data),e.fetchUser()})).catch((function(t){console.error(t)})),r.next=7,i().fire({title:"Data berhasil dihapus!",icon:"success",timer:1500,timerProgressBar:!0,showConfirmButton:!1});case 7:e.$router.push("/admin-list-user");case 8:case"end":return r.stop()}}),r)})))()}},created:function(){var t=this;o().get("http://localhost:8000/api/auth/me/",{headers:{Authorization:"Bearer "+localStorage.getItem("token")}}).then((function(e){var r=e.data.role,n=localStorage.getItem("token"),o=localStorage.getItem("expires_in");!n||!o||new Date>new Date(o)?(localStorage.removeItem("token"),localStorage.removeItem("expires_in"),t.$router.push("/")):"admin"!==r?t.$router.push("/unauthorized"):(console.log("role: ",r),console.log("success"),t.fetchUser())})).catch((function(e){console.error(e),t.$router.push("/")}))}};var f=r(3379),v=r.n(f),p=r(246),d={insert:"head",singleton:!1};v()(p.Z,d);p.Z.locals;const m=(0,r(1900).Z)(h,(function(){var t=this,e=t._self._c;return e("div",{attrs:{id:"wrapper"}},[e("sidebar-admin"),t._v(" "),e("div",{staticClass:"d-flex flex-column",attrs:{id:"content-wrapper"}},[e("div",{attrs:{id:"content"}},[e("navbar"),t._v(" "),e("h1",{staticClass:"text-center h3"},[t._v("List User")]),t._v(" "),e("div",{staticClass:"row"},[e("div",{staticClass:"col-sm-1"}),t._v(" "),e("div",{staticClass:"col-sm-10"},[e("div",{staticClass:"row mt-5"},[e("div",{staticClass:"col-sm-3"},[e("router-link",{staticClass:"btn btn-primary me-2",attrs:{to:"admin-tambah-user"}},[e("i",{staticClass:"bi bi-plus"})])],1),t._v(" "),e("div",{staticClass:"col-sm-9"})]),t._v(" "),e("div",{staticClass:"table-responsive"},[e("table",{staticClass:"table table-striped mt-2"},[t._m(0),t._v(" "),e("tbody",t._l(t.user,(function(r,n){return e("tr",{key:r.id},[e("th",{attrs:{scope:"row"}},[t._v(t._s(n+1))]),t._v(" "),e("td",[t._v(t._s(r.name))]),t._v(" "),e("td",[t._v(t._s(r.email))]),t._v(" "),e("td",[e("button",{staticClass:"btn btn-danger",on:{click:function(e){return t.deleteItem(r.id)}}},[e("i",{staticClass:"bi bi-trash3"})])])])})),0)])])]),t._v(" "),e("div",{staticClass:"col-sm-1"})])],1),t._v(" "),e("footer")])],1)}),[function(){var t=this,e=t._self._c;return e("thead",[e("tr",[e("th",{attrs:{scope:"col"}},[t._v("No")]),t._v(" "),e("th",{attrs:{scope:"col"}},[t._v("Nama")]),t._v(" "),e("th",{attrs:{scope:"col"}},[t._v("email")]),t._v(" "),e("th",{attrs:{scope:"col"}},[t._v("Action")])])])}],!1,null,"ee93eb1c",null).exports}}]);