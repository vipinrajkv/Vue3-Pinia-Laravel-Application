<script setup>
import axiosInstance from '@/axiosInstance';
import { onMounted, ref, defineProps, computed } from 'vue';
const movies = ref([]);
const isLoading = ref(true);
onMounted(() => {
  axiosInstance.get('/movies').then((response) => {
    movies.value = response.data.data;
    isLoading.value = false;
    console.log(movies.value[0].plot);
  })
})

const props = defineProps({
  limit: Number,
  showButton: {
      type:Boolean,
      default: false
  }
})
const toggleDescription = (movieId) => {
  const movie = movies.value.find((m) => m.id === movieId);
  if (movie) {
    movie.fullDescription = !movie.fullDescription;
  }
};

const getShortDescription = (plot) => {
  return plot.length > 90 ? plot.substring(0, 90) + '....' : plot;
};

</script>
<template>
  <div class="bg-white">
    <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-12 lg:max-w-7xl lg:px-8">

      <h2 class="text-2xl font-bold tracking-tight text-gray-900">Customers also purchased</h2>
      <div v-if="isLoading" class="text-center">
        <div role="status">
          <svg aria-hidden="true" class="inline w-10 h-10 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
              fill="currentColor" />
            <path
              d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
              fill="currentFill" />
          </svg>
          <span class="sr-only">Loading...</span>
        </div>
      </div>
      <div v-else class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
        <div v-for="movie in movies.slice(0,props.limit || movies.length)"  :key="movie.id" class="group relative">
          <RouterLink :to="`/movie/${movie.id}`">
            <img :src="movie.images" :alt="movie.images"
              class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80" />
            <div class="mt-4 flex justify-between">
              <div>
                <h3 class="text-sm text-gray-700">
                  <a :href="movie.href">
                    <span aria-hidden="true" class="absolute inset-0" />
                    {{ movie.title }}
                  </a>
                </h3>
                <p class="mt-1 text-sm text-gray-500">{{ movie.director }}</p>

                <p class="text-sm font-medium text-gray-900">{{ movie.released }}</p>
                <p class="mt-4 text-gray-700">
                <!-- {{ movie.plot }} -->
                <!-- Truncated or Full Description -->
                {{ movie.fullDescription ? movie.plot : getShortDescription(movie.plot) }}
              </p>
                <!-- <p class="mt-1 text-sm text-gray-500">{{ movie.director }}</p> -->
                <button
                  v-if="movie.plot.length > 90"
                  @click="toggleDescription(movie.id)"
                  class="text-blue-600 text-sm mt-2">
                  {{ movie.fullDescription ? 'View Less' : 'View More' }}
                </button>
              </div>
    
             
            </div>
          </RouterLink>
        </div>
      </div>
    </div>
  </div>
  <div v-if="showButton" class="flex justify-center items-center px-9 py-6">
  <button type="button" class="text-white bg-[#24292F] hover:bg-[#24292F]/90 focus:ring-4 focus:outline-none focus:ring-[#24292F]/50 font-medium rounded-lg text-sm px-3 py-2 text-center inline-flex items-center dark:focus:ring-gray-500 dark:hover:bg-[#050708]/30">
    
    View More
  </button>
</div>
</template>

