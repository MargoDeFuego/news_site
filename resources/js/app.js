import { createApp } from 'vue';
import './bootstrap';
import NewArticleNotify from './components/NewArticleNotify.vue';

const notifyApp = createApp({});

notifyApp.component('new-article-notify', NewArticleNotify);
notifyApp.mount('#notify-app');
