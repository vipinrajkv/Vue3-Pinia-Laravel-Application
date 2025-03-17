import axiosInstance from "@/axiosInstance";
import { defineStore } from "pinia"

export const useAuthStore = defineStore('authStore', {
  
  state: () => ({
    userDetails: null,
    errors: {},
  }),
  getters: {
    
  },
  actions: {
    
    // Get authenticated user
    async getUser() {
      const token = localStorage.getItem('token');
      if (token) {
          const res = await axiosInstance.post('api/users',{
            headers: { Authorization: `Bearer ${token}`
            }
          });
          return res
      }
      console.log(res);

    },

    async authenticateUser(apiRoute, formData) {
      const token = localStorage.getItem('token');
      const config = token ? { headers: { Authorization: `Bearer ${token}`, 'Content-Type': 'multipart/form-data' } } : { headers: { 'Content-Type': 'multipart/form-data' } };

      try {
        const request = await axiosInstance.post(apiRoute, formData, config);
        const response = await request.data;
        this.userDetails = response;
        localStorage.setItem('token',response.data,token);
        this.router.push({name:"HomeView"})
      } catch (error) {

        if (error.response?.data) {
          this.errors = error.response.data;
        }
        console.log(this.errors);
      }
    },
  },
})