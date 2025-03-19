import { createRouter, createWebHistory } from "vue-router";
import HomeView from "@/Views/HomeView.vue";
import MovieDetails from "@/Views/MovieDetails.vue";
import Register from "@/Views/Register.vue";
import Login from "@/Views/Login.vue";
import DefaultNavBar from "@/components/DefaultNavBar.vue";
import { useAuthStore } from "@/stores/authStore";

const router = createRouter({
    // history: createWebHistory(import.meta.env.VITE_API_BASE_URL),
    history: createWebHistory(),
    routes : [
        {
            path:'/',
            component:DefaultNavBar,
            children:[
                {path:'/', name:'HomeView', component:HomeView, meta:{auth: true}},
                {path:'/movie/:id', name:'movie',component:MovieDetails, meta:{auth: true}},
            ]
        },
        {
            path:'/register',
            name:'register',
            component:Register,
            meta:{ guest : true}
        },
        {
            path:'/login',
            name:'login',
            component:Login,
            meta:{ guest : true}
        }
    ]
})


router.beforeEach( async (to, from)=>{
    const authStore = useAuthStore();
    const userData = await authStore.getUser();  
  
    if (authStore.user && to.meta.guest) {
        return {name:'HomeView'}
    }

    if (!authStore.user && to.meta.auth) {
        return {name:'login'}
    }
});
export default router;