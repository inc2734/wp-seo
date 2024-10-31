(()=>{"use strict";const e=window.React,t=window.wp.plugins,o=window.wp.editor,n=window.wp.coreData,a=window.wp.data,r=window.wp.components;(0,t.registerPlugin)("inc2734-wp-seo-panel",{render:()=>{const t=(0,a.useSelect)((e=>e("core/editor").getCurrentPostType()),[]),s=(0,a.useSelect)((e=>e("core/editor").getCurrentPost()),[]),[l,i]=(0,n.useEntityProp)("postType",t,"meta");return null!=s?.meta?.["wp-seo-meta-description"]&&null!=s?.meta?.["wp-seo-meta-robots"]&&(0,e.createElement)(o.PluginDocumentSettingPanel,{name:"inc2734-wp-seo-panel",title:"SEO"},(0,e.createElement)(r.TextareaControl,{__nextHasNoMarginBottom:!0,label:"Meta description",value:l?.["wp-seo-meta-description"],onChange:e=>i({...l,"wp-seo-meta-description":e.replace(/\r?\n/g,"")})}),(0,e.createElement)(r.BaseControl,{__nextHasNoMarginBottom:!0,label:"Meta robots",id:"inc2734-wp-seo-meta-robots"},(0,e.createElement)(r.ToggleControl,{__nextHasNoMarginBottom:!0,label:"noindex",checked:l?.["wp-seo-meta-robots"].includes("noindex"),onChange:e=>{let t=[...l?.["wp-seo-meta-robots"]];e?t.includes("noindex")||t.push("noindex"):t=t.filter((e=>"noindex"!==e)),i({...l,"wp-seo-meta-robots":t})}}),(0,e.createElement)(r.ToggleControl,{__nextHasNoMarginBottom:!0,label:"nofollow",checked:l?.["wp-seo-meta-robots"].includes("nofollow"),onChange:e=>{let t=[...l?.["wp-seo-meta-robots"]];e?t.includes("nofollow")||t.push("nofollow"):t=t.filter((e=>"nofollow"!==e)),i({...l,"wp-seo-meta-robots":t})}})))},icon:"palmtree"}),document.addEventListener("DOMContentLoaded",(()=>{const e=document.getElementById("wp-seo-meta-description"),t=document.getElementById("wp-seo-meta-description-counter");if(!e||!t)return;const o=()=>t.innerText=e.value.length;o(),e.addEventListener("change",o),e.addEventListener("keyup",o),e.addEventListener("paste",o),e.addEventListener("input",(()=>e.value=e.value.replace(/\r?\n/g,"")))}))})();