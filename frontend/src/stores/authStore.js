import axiosInstance from "@/axiosInstance";
import { defineStore } from "pinia"

export const useAuthStore = defineStore('authStore', {
  state: () => ({
    userDetails: null,
    errors: {},
  }),
  getters: {
    doubleCount: (state) => state.count * 2,
  },
  actions: {
    async authenticateUser(apiRoute, formData) {
      const token = localStorage.getItem('token');
      const config = token ? { headers: { Authorization: `Bearer ${token}`, 'Content-Type': 'multipart/form-data' } } : { headers: { 'Content-Type': 'multipart/form-data' } };
      try {
        const request = await axiosInstance.post(apiRoute, formData, config);
        const response = await request.data;
        this.userDetails = response;
        const token = localStorage.setItem('token');
        this.router.push('/')
      } catch (error) {

        if (error.response?.data) {
          this.errors = error.response.data;
        }
        console.log(this.errors);
      }
    },
  },
})