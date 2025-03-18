import axiosInstance from "@/axiosInstance";
import { defineStore } from "pinia"

export const useAuthStore = defineStore('authStore', {

  state: () => ({
    userDetails: null,
    user: null,
    errors: {},
  }),
  getters: {

  },
  actions: {

    async getUser() {
      const token = localStorage.getItem('token');
      if (token) {
        try {
          const res = await axiosInstance.get('/user', {
            headers: {
              Authorization: `Bearer ${token}`
            }
          });
          this.user = res.data;
          console.log(res);
          return res.data;
        } catch (error) {
          console.error('Error fetching user:', error);
          this.errors = error; // Store errors in state if needed
        }
      }

    },

    async authenticateUser(apiRoute, formData) {
      const token = localStorage.getItem('token');
      const config = token ? { headers: { Authorization: `Bearer ${token}`, 'Content-Type': 'multipart/form-data' } } : { headers: { 'Content-Type': 'multipart/form-data' } };

      try {
        const request = await axiosInstance.post(apiRoute, formData, config);
        const response = await request.data;
        this.userDetails = response;
        console.log(response);
        console.log(response.token);
        localStorage.setItem('token', response.token);
        this.router.push({ name: "HomeView" })
      } catch (error) {

        if (error.response?.data) {
          this.errors = error.response.data;
        }
        console.log(this.errors);
      }
    },

    async logOut() {
      const token = localStorage.getItem('token');
      const config = token ? { headers: { Authorization: `Bearer ${token}`, 'Content-Type': 'multipart/form-data' } } : { headers: { 'Content-Type': 'multipart/form-data' } };
      console.log(config);
      try {
        const request = await axiosInstance.post('logout', config);
        const response = await request.data;
        console.log(response);
        // console.log(response.token);
        localStorage.setItem('token', response.token);
        this.router.push({ name: "login" })
      } catch (error) {

        if (error.response?.data) {
          this.errors = error.response.data;
        }
        console.log(this.errors);
      }
    },
  },
})