(()=>{"use strict";const e=window.wp.element,t=window.wp.plugins,o=window.wp.editPost,n=window.wp.coreData,l=window.wp.data,s=window.wp.components;(0,t.registerPlugin)("inc2734-wp-seo-panel",{render:()=>{const t=(0,l.useSelect)((e=>e("core/editor").getCurrentPostType()),[]),r=(0,l.useSelect)((e=>e("core/editor").getCurrentPost()),[]),[a,i]=(0,n.useEntityProp)("postType",t,"meta");return null!=r?.meta?.["wp-seo-meta-description"]&&null!=r?.meta?.["wp-seo-meta-robots"]&&(0,e.createElement)(o.PluginDocumentSettingPanel,{name:"inc2734-wp-seo-panel",title:"SEO"},(0,e.createElement)(s.TextareaControl,{label:"Meta description",value:a?.["wp-seo-meta-description"],onChange:e=>i({...a,"wp-seo-meta-description":e.replace(/\r?\n/g,"")})}),(0,e.createElement)(s.BaseControl,{label:"Meta robots",id:"inc2734-wp-seo-meta-robots"},(0,e.createElement)(s.ToggleControl,{label:"noindex",checked:a?.["wp-seo-meta-robots"].includes("noindex"),onChange:e=>{let t=[...a?.["wp-seo-meta-robots"]];e?t.includes("noindex")||t.push("noindex"):t=t.filter((e=>"noindex"!==e)),i({...a,"wp-seo-meta-robots":t})}}),(0,e.createElement)(s.ToggleControl,{label:"nofollow",checked:a?.["wp-seo-meta-robots"].includes("nofollow"),onChange:e=>{let t=[...a?.["wp-seo-meta-robots"]];e?t.includes("nofollow")||t.push("nofollow"):t=t.filter((e=>"nofollow"!==e)),i({...a,"wp-seo-meta-robots":t})}})))},icon:"palmtree"}),document.addEventListener("DOMContentLoaded",(()=>{const e=document.getElementById("wp-seo-meta-description"),t=document.getElementById("wp-seo-meta-description-counter");if(!e||!t)return;const o=()=>t.innerText=e.value.length;o(),e.addEventListener("change",o),e.addEventListener("keyup",o),e.addEventListener("paste",o),e.addEventListener("input",(()=>e.value=e.value.replace(/\r?\n/g,"")))}))})();