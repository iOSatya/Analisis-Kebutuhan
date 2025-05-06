import { defineStore } from "pinia";
import { ref } from "vue";

export const useAuthStore = defineStore("auth", () => {
  const token = ref(localStorage.getItem("token"));

  const removeToken = () => {
    localStorage.removeItem("token");
  }

  const addToken = (newToken) => {
    localStorage.setItem("token", newToken);
  }

  return { token, removeToken, addToken };
});