<script setup>
import DefaultNavBar from './components/DefaultNavBar.vue'
// import MovieList from './components/MovieList.vue'
import { RouterView } from 'vue-router';
import { useAuthStore } from './stores/authStore';
import { onMounted } from 'vue';
// import Footer from './Views/footer.vue';
const authStore = useAuthStore();
onMounted (()=> {
  authStore.getUser
  console.log(authStore.getUser);
})
</script>

<template>
  <!-- <header>
      <DefaultNavBar/>
  </header> -->
  <main>
    <RouterView/>
  </main>
  <!-- <Footer/> -->
</template>


