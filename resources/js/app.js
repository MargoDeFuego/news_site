import { createApp } from 'vue';
import './bootstrap';
import NewArticleNotify from './components/NewArticleNotify.vue';
import '../css/style.css';

const notifyApp = createApp({});

notifyApp.component('new-article-notify', NewArticleNotify);
notifyApp.mount('#notify-app');


document.addEventListener('DOMContentLoaded', () => {
    if (window.Echo) {
        window.Echo.channel('articles')
            .listen('.article.published', () => {
                updateNotifications();
            });
    }
});

async function updateNotifications() {
    try {
        const response = await fetch('/notifications/render');
        const html = await response.text();

        const container = document.getElementById('notifications-container');
        if (container) {
            container.innerHTML = html;
        }
    } catch (e) {
        console.error(e);
    }
}
