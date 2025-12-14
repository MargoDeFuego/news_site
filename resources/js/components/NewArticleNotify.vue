<template>
  <div v-if="visible" class="notify">
    <div class="notify__card">
      <div class="notify__title">Новая статья</div>
      <div class="notify__text">{{ article.title }}</div>

      <div class="notify__actions">
        <a class="btn btn-primary btn-sm" :href="article.url">Открыть</a>
        <button class="btn btn-outline-secondary btn-sm" @click="close">Закрыть</button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';

const visible = ref(false);
const article = ref({ id: null, title: '', url: '' });

function close() {
  visible.value = false;
}

onMounted(() => {
  // канал: articles, событие: article.published
  window.Echo
    .channel('articles')
    .listen('.article.published', (e) => {
      // ключи те же, что в broadcastWith()
      article.value = {
        id: e.id,
        title: e.title,
        url: e.url,
      };
      visible.value = true;
    });
});
</script>

<style scoped>
.notify{
  position: fixed;
  right: 16px;
  bottom: 16px;
  z-index: 9999;
}
.notify__card{
  width: 320px;
  background: #fff;
  border: 1px solid #ddd;
  border-radius: 10px;
  padding: 12px;
  box-shadow: 0 10px 30px rgba(0,0,0,.15);
}
.notify__title{
  font-weight: 700;
  margin-bottom: 6px;
}
.notify__text{
  margin-bottom: 10px;
}
.notify__actions{
  display: flex;
  gap: 8px;
}
</style>
