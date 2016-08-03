import Vue from 'vue';

export let Content = Vue.resource('contents{/id}');

export let Layout = Vue.resource('layouts{/id}');

export let Page = Vue.resource('pages{/id}');