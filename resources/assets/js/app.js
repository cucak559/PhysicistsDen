
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./caret');


window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


require('selectize');

$( document ).ready(function() {
    $('#tags').selectize({
        delimiter: ',',
        persist: false,
        valueField: 'tag',
        labelField: 'tag',
        searchField: 'tag',
        options: tags,
        create: function(input) {
            return {
                tag: input
            }
        }
    });
});

require ('at.js');

Vue.component('flash', require('./components/Flash.vue'));
Vue.component('comments', require('./components/Comments.vue'));
Vue.component('comment', require('./components/Comment.vue'));
Vue.component('social', require('./components/Social.vue'));
Vue.component('new-comment', require('./components/NewComment.vue'));
Vue.component('paginator', require('./components/Paginator.vue'));
Vue.component('watch-button', require('./components/WatchButton.vue'));
Vue.component('user-notifications', require('./components/UserNotifications.vue'));

Vue.component('article-view', require('./pages/Article.vue'));



const app = new Vue({
    el: '#app'
});
