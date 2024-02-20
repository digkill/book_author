<template>
  <ul>
    <li>
      <router-link to="/">Home</router-link>
    </li>
    <li>
      <router-link to="/books/top10">TOP 10</router-link>
    </li>
  </ul>
  <div class='container'>
    <a-typography-title>Books</a-typography-title>
    <router-view></router-view>
  </div>
</template>

<script>
import BooksList from './components/BooksList.vue';

export default {
  components: {
    BooksList,
  }
}
</script>

<style scoped>
.container {
  padding: 2%;
}
</style>