import Vue from 'vue';
import './bootstrap';
import ContentEditor from './components/ContentEditor.vue';
import HtmlEditor from './components/HtmlEditor.vue';
import SectionEditor from './components/SectionEditor.vue';
import StringEditor from './components/StringEditor.vue';
import PageEditor from './components/PageEditor.vue';
import ViewEditor from './components/ViewEditor.vue';
import SaveButton from './components/SaveButton.vue';

Vue.component('ContentEditor', ContentEditor);
Vue.component('HtmlEditor', HtmlEditor);
Vue.component('SectionEditor', SectionEditor);
Vue.component('StringEditor', StringEditor);
Vue.component('PageEditor', PageEditor);
Vue.component('ViewEditor', ViewEditor);
Vue.component('SaveButton', SaveButton);

var app = new Vue({
    el: 'body'
});
