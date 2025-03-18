<script setup>
import DefaultNavBar from './components/DefaultNavBar.vue'
// import MovieList from './components/MovieList.vue'
import { RouterView } from 'vue-router';
import { useAuthStore } from './stores/authStore';
import { onMounted } from 'vue';
// import Footer from './Views/footer.vue';
const authStore = useAuthStore();

// onMounted (async ()=> {
//   console.log(authStore.getUser());
//   const userData = await authStore.getUser();  
// })

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


