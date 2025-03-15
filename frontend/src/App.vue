<script setup>
import NavBar from './components/NavBar.vue'
// import MovieList from './components/MovieList.vue'
import { RouterView } from 'vue-router';
import Footer from './Views/footer.vue';
</script>

<template>
  <header>
      <NavBar/>
  </header>
  <main>
    <RouterView/>
  </main>
  <Footer/>
</template>


