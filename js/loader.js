// Loading spinner on page load 
let preloader = document.getElementById('loader');
// set a 100ms timeout to load
setTimeout(function preLoaderHandler(){
    preloader.style.display = 'none';
}, 100);
