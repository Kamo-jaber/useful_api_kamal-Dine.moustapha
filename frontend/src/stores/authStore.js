import axios from "axios";
import {defineStore} from "pinia";

const apiUrl = import.meta.env.VITE_API_URL

function axiosGenerator() {

  if (sessionStorage.getItem('access_token') !== null) {

    const token = sessionStorage.getItem('access_token');

    const authAxios = axios.create({

      baseURL: apiUrl+"auth/",
      headers: {

        Authorization: `Bearer ${token}`
      }
    })

    return authAxios
  } else {
    const authAxios = axios.create({

      baseURL: apiUrl+"auth/",
    })

    return authAxios
  }
}

const authAxios = axiosGenerator()

export const useAuthStore = defineStore('authStore', {
    state: () => ({
      user: JSON.parse(sessionStorage.getItem('user')),
      token: sessionStorage.getItem("access_token"),
}),


    actions: {

        async SignUp(data) {

            try {
                const res = await authAxios.post('register', data)

                const responseToken = res.data.access_token

                const responseUser = res.data.user


                sessionStorage.setItem('access_token', responseToken)
                sessionStorage.setItem('user', JSON.stringify(responseUser))
                this.user = JSON.parse(sessionStorage.getItem('user'))
                this.token = sessionStorage.getItem('access_token')

        return { responseUser };

      } catch (error) {

        console.error("Signup error:", error);

        };
      },

        async SignIn(data) {

            try {

                const res = await authAxios.post('login', data)

                const token = res.data.access_token
                const responseUser = res.data.user

                sessionStorage.setItem('access_token', token)
                sessionStorage.setItem('user', JSON.stringify(responseUser))
                this.user = JSON.parse(sessionStorage.getItem('user'))
                this.token = sessionStorage.getItem('access_token')

              return { responseUser };

      } catch (error) {
        console.error("Login error:", error);
        };
      },
    },

    persist: {

    enabled: true,
    strategies: [
      {
        storage: localStorage,
        paths: ["user", "token"],
      },
    ],
  },
})
