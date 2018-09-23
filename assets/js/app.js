global.$ = global.jQuery = $;

// loads the Bootstrap jQuery plugins
import 'bootstrap/dist/js/bootstrap'

// loads the code syntax highlighting library
import './highlight.js';

document.addEventListener("DOMContentLoaded", function(event) {
    document.querySelectorAll('img').forEach(function(img){
        img.onerror = function(){this.style.display='none';};
    })
});
