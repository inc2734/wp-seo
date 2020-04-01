document.addEventListener(
  'DOMContentLoaded',
  () => {
    const description = document.getElementById('wp-seo-meta-description');
    const counter = document.getElementById('wp-seo-meta-description-counter');
    const count = () => counter.innerText = description.value.length;
    const removeBreaks = () => description.value = description.value.replace(/\r?\n/g, '');

    count();
    description.addEventListener('change', count);
    description.addEventListener('keyup', count);
    description.addEventListener('paste', count);
    description.addEventListener('input', removeBreaks);
  }
);
