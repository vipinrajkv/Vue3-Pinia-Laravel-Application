<script setup>
    // import MovieList from './components/MovieList.vue'
    import MovieList from '@/components/MovieList.vue'
import MovieDetails from './MovieDetails.vue';
</script>
<template>
      <main>
        <MovieList  limit="4" showButton ="true" />
        <MovieDetails/>

      </main>
</template>