<script setup>
import { useAuthStore } from '@/stores/authStore';
import { ref } from 'vue';

const authStore = useAuthStore();
const email = ref("");
const password = ref("");
const name = ref("");
const openlogin = ref(false);
const opensignup = ref(false)

const handleLogin = async () => {

    console.log("Tentative de connexion :", {
        email: email.value,
        password: password.value
    });
      await authStore.SignIn({
        email: email.value,
        password: password.value
    })
  }

  const handleSignup = async () => {
    console.log("Signup data:", {
        name: name.value,
        email: email.value,
        password: password.value,
    });

await authStore.SignUp({
        name: name.value,
        email: email.value,
        password: password.value,
    })
}


</script>

<template>

<!-- LOGIN -->

<!-- Main modal -->
<div v-if="!openlogin"  class="fixed inset-0 z-50 flex items-center justify-center backdrop-blur-[10px] bg-gray-900/60">
        <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Sign in to our platform
                </h3>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form @submit.prevent="handleLogin" class="space-y-4" action="#">
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                        <input v-model="email" type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" required />
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                        <input v-model="password" type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                    </div>
                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login to your account</button>
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                        Not registered? <a @click="openlogin = true; opensignup = true" class="text-blue-700 hover:underline dark:text-blue-500 cursor-pointer">Create account</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- REGISTER -->

<!-- Main modal -->
<div v-if="opensignup"  class="fixed inset-0 z-50 flex items-center justify-center backdrop-blur-[10px] bg-gray-900/60">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Create your account
                </h3>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form @submit.prevent="handleSignup" class="space-y-4" action="#">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your name</label>
                        <input v-model="name" type="name" name="email" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="John" required />
                    </div>
                    <div>
                      <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                        <input v-model="email" type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" required />
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                        <input v-model="password" type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                    </div>
                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create your account</button>
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                        You alredy have account?<a @click="openlogin = false; opensignup = false" class="text-blue-700 hover:underline dark:text-blue-500 cursor-pointer">Login to your account</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


</template>

<style scoped>

</style>
