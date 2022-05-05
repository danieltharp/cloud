// window.axios = require('axios');
// import Vue from 'vue';
// import Search from './components/Search.vue';
// import hljs from 'highlight.js/lib/core';

// // Syntax highlighting
// hljs.registerLanguage('bash', require('highlight.js/lib/languages/bash'));
// hljs.registerLanguage('css', require('highlight.js/lib/languages/css'));
// hljs.registerLanguage('dockerfile', require('highlight.js/lib/languages/dockerfile'));
// hljs.registerLanguage('go', require('highlight.js/lib/languages/go'));
// hljs.registerLanguage('html', require('highlight.js/lib/languages/xml'));
// hljs.registerLanguage('javascript', require('highlight.js/lib/languages/javascript'));
// hljs.registerLanguage('json', require('highlight.js/lib/languages/json'));
// hljs.registerLanguage('julia', require('highlight.js/lib/languages/julia'));
// hljs.registerLanguage('markdown', require('highlight.js/lib/languages/markdown'));
// hljs.registerLanguage('php', require('highlight.js/lib/languages/php'));
// hljs.registerLanguage('powershell', require('highlight.js/lib/languages/powershell'));
// hljs.registerLanguage('python', require('highlight.js/lib/languages/python'));
// hljs.registerLanguage('rust', require('highlight.js/lib/languages/rust'));
// hljs.registerLanguage('yaml', require('highlight.js/lib/languages/yaml'));

// document.querySelectorAll('pre code').forEach((block) => {
//     hljs.highlightBlock(block);
// });

// Vue.config.productionTip = false;

// new Vue({
//     components: {
//         Search,
//     },
// }).$mount('#vue-search');


/* These are friends and family members that have left my life too soon.
 Scared as I am of the "second death" when you are last remembered,
 the least I can do is try to keep their memory alive here. */
var dedications = [
    "For Jon, and the conversations never finished.",
    "For Mikey, and what should have been.",
    "For w_0, who called me the ROTY.",
    "For Devin, and the melodies undiscovered.",
    "For Mom, who missed the good part.",
    "For Dad, who loved unconditionally.",
    "For Mr. Jim, a friend in a time of few.",
    "For Daniel C, who suffered in silence.",
    "For Eric, who poured from an empty cup."
]

function dedicate() {
    var randomNumber = Math.floor(Math.random() * dedications.length);
    document.getElementById('dedication').innerHTML = dedications[randomNumber];
}

dedicate();
