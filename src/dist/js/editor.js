document.addEventListener("DOMContentLoaded",(()=>{const e=document.getElementById("wp-seo-meta-description"),t=document.getElementById("wp-seo-meta-description-counter");if(!e||!t)return;const n=()=>t.innerText=e.value.length;n(),e.addEventListener("change",n),e.addEventListener("keyup",n),e.addEventListener("paste",n),e.addEventListener("input",(()=>e.value=e.value.replace(/\r?\n/g,"")))}));