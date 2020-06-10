webpackJsonp([16],{202:function(t,e,a){var o=a(203);"string"==typeof o&&(o=[[t.i,o,""]]),o.locals&&(t.exports=o.locals);a(4)("de08d36a",o,!0,{})},203:function(t,e,a){(t.exports=a(2)(!1)).push([t.i,".display-flex[data-v-2b387174]{display:-webkit-box;display:-ms-flexbox;display:flex}.navi-item[data-v-2b387174]{margin-right:210px!important}.lettering[data-v-2b387174]{font-size:45px}.header[data-v-2b387174]{padding:5px 20px!important;background:#fff;color:#717171;border-bottom:1px solid #e0e4e8}.info[data-v-2b387174]{margin:20px;color:#717171;line-height:25px}.main_content[data-v-2b387174]{width:auto}.main_content .header[data-v-2b387174]{padding:20px;background:#fff;color:#717171;border-bottom:1px solid #e0e4e8}.main_content .info[data-v-2b387174]{margin-left:40px;margin-right:40px;margin-top:20px;color:#717171;line-height:25px}.main_content .info div[data-v-2b387174]{margin-bottom:20px}",""])},204:function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default={data:function(){return{ifReady:!0,name:"",image:"",selectedProject:null,options:[],formData2:new FormData,errors:[]}},mounted:function(){var t=this;new Promise(function(e,a){axios.get("/api/list-projects").then(function(a){console.log(a.data.data),t.options=a.data.data,e()}).catch(function(e){t.ifReady=!0})})},methods:{onFileSelected:function(t){this.image=t.target.files[0]},createNewProjectImage:function(){var t=this;this.ifReady=!1,this.errors=[];var e=new FormData;e.append("caption",this.name),e.append("project_id",this.selectedProject),null!=this.image&&e.append("image",this.image),axios.post("/api/projectImages",e).then(function(e){t.toast("Success","Project added","Successfully submitted the request","secondary"),t.$router.push({name:"project-images.index"})}).catch(function(e){t.errors=e.response.data.errors,t.ifReady=!0,console.log(e.response),t.toast("Error","Failed to submit","Unable to process request!","danger")})},toast:function(t,e,a,o){var s=this.$createElement;this.count++;var n=s("p",{class:["text-center","mb-0"]},[s("b-spinner",{props:{type:"grow",small:!0}}),"  ",s("strong",{class:"text-muted"},a),"  ",s("b-spinner",{props:{type:"grow",small:!0}})]),r=s("div",{class:["d-flex","flex-grow-1","align-items-baseline","mr-2"]},[s("strong",{class:"mr-2"},t),s("small",{class:"ml-auto text-italics"},e)]);this.$bvToast.toast([n],{title:[r],solid:!0,toaster:"b-toaster-bottom-right",variant:o})},viewProjectImages:function(){this.$router.push({name:"projects.index"})}}}},205:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"main_content"},[a("div",{staticClass:"info"},[a("div",{staticClass:"mr-auto mt-5 lettering"},[t._v("\n            Project Images\n        ")]),t._v(" "),a("div",[a("div",{staticClass:"d-flex flex-row-reverse"},[a("label",{staticClass:"text-secondary clickableText header-margin",on:{click:function(e){return!e.type.indexOf("key")&&t._k(e.keyCode,"default",void 0,e.key,void 0)?null:(e.preventDefault(),t.viewProjectImages(e))}}},[a("i",{staticClass:"fas fa-long-arrow-alt-left"}),t._v(" \n                    "),a("strong",[t._v("Back")])])]),t._v(" "),a("div",{staticClass:"card"},[a("div",{staticClass:"card-header"},[a("router-link",{attrs:{to:"/projects-images"}},[t._v("Project Images")]),t._v(" >> Create Project\n                ")],1),t._v(" "),a("div",{staticClass:"card-body header-margin"},[t.ifReady?a("div",[a("form",{on:{submit:function(e){return e.preventDefault(),t.createNewProjectImage(e)}}},[a("div",{staticClass:"form-group"},[a("label",[t._v("Image (optional)")]),t._v(" "),a("input",{staticClass:"form-control-file",attrs:{type:"file"},on:{change:t.onFileSelected}})]),t._v(" "),a("div",{staticClass:"form-group"},[a("label",[t._v("Caption")]),t._v(" "),a("input",{directives:[{name:"model",rawName:"v-model",value:t.name,expression:"name"}],staticClass:"form-control",attrs:{id:"name",type:"text",autocomplete:"off",minlength:"2",maxlength:"255",required:""},domProps:{value:t.name},on:{input:function(e){e.target.composing||(t.name=e.target.value)}}})]),t._v(" "),a("div",{staticClass:"form-group"},[a("label",[t._v("Project")]),t._v(" "),a("b-form-select",{scopedSlots:t._u([{key:"first",fn:function(){return[a("b-form-select-option",{attrs:{value:null,disabled:""}},[t._v("-- Please select a project --")])]},proxy:!0}],null,!1,1701746922),model:{value:t.selectedProject,callback:function(e){t.selectedProject=e},expression:"selectedProject"}},[t._v(" "),t._l(this.options,function(e){var o=e.id,s=e.name;return a("option",{key:s,domProps:{value:o}},[t._v("\n                                        "+t._s(s)+"\n                                    ")])})],2)],1),t._v(" "),t.errors!=[]?a("div",t._l(t.errors,function(e){return a("div",{key:e,staticClass:"alert alert-danger"},[a("a",{staticClass:"close",attrs:{href:"#","data-dismiss":"alert"}},[t._v("×")]),t._v(" "),a("strong",[t._v("Error!")]),t._v(" "+t._s(e[0])+"\n                                ")])}),0):t._e(),t._v(" "),a("button",{staticClass:"btn btn-secondary btn-sm",attrs:{type:"submit"}},[t._v("Add Project Image")])])]):a("div",[a("div",{staticClass:"d-flex justify-content-center mb-3"},[a("b-spinner",{attrs:{label:"Loading..."}})],1)])])])])])])},staticRenderFns:[]}},245:function(t,e,a){var o=a(3)(a(204),a(205),!1,function(t){a(202)},"data-v-2b387174",null);t.exports=o.exports}});
//# sourceMappingURL=16.js.map