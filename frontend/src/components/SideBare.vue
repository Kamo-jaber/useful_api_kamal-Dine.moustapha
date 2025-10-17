<script setup>
import { ref } from 'vue';
import { useModalStore } from '@/stores/ModalSignInStore';
import { useAuthStore } from '@/stores/AuthStore';
import { useCommentStore } from '@/stores/CommentStore';

import SigninModal from '@/components/Auth/SigninModal.vue';
import SignupModal from '@/components/Auth/SignupModal.vue';
import SearchBar from '@/components/SearchBar/SearchBar.vue';
import { useRouter } from 'vue-router';

const modalStore = useModalStore()
const AuthStore = useAuthStore()
const commentStore = useCommentStore()
const router = useRouter()

const sideShortcut = ref(false)
const bottomShortcut = ref(false)

const showSearch = ref(false)

function showComments(input) {
    if (input.trim !== '') {
        commentStore.fetchCommentByInput(input)
    }
}

function reload() {
    router.push('/')
}

</script>

<template>

    <SearchBar v-if="showSearch" @hide-search="showSearch = false" @search-input="(input) => showComments(input)">
    </SearchBar>

    <SigninModal />
    <SignupModal />

    <!-- check if the token is empty -->
    <div v-if="AuthStore.token === null">
        <!-- ##### GUEST TOPNAV ##### -->
        <nav class="topNav z-100 flex justify-between align-middle bg-gray-900 text-xl border-b-2 border-gray-700 p-3">
            <a href="/">

                <div @click="reload" class="relative w-[200px] h-[50px] flex justify-center items-center right-[10px] cursor-pointer">
                    <img src="../../../public/logo_franko.svg" class="w-full h-full object-cover" alt="">
                </div>
                <!-- <h1 class="text-gray-200 text-2xl">Franko</h1> -->
            </a>
        </nav>

        <!-- ##### GUEST SIDENAV ##### -->
        <nav class="sidenav bg-gray-900 text-xl border-r-2 border-gray-700 p-3">

            <div @click="reload" class="relative w-[100%] h-[50px] flex justify-center items-center right-[10px] cursor-pointer">
                <img src="../../../public/logo_franko.svg" class="w-full h-full object-cover" alt="">
            </div>

            <div id="dropdown-cta" class="p-2 mt-6 rounded-lg xs bg-gray-800" role="alert">

                <div class="flex flex-col justify-center items-center mb-3">
                    <p class="mb-3  mt-3 text-sm text-center text-gray-200">
                        Pour obtenir le meilleur de Franko,
                    </p>
                    <button type="button" @click="modalStore.openLoginModal()"
                        class="text-white bg-[#a54c03] hover:bg-[#966a46] focus:outline-none focus:ring-4 focus:ring-[#db9256] font-medium rounded-full text-sm px-2 py-2.5 text-center me-2 mb-2 dark:focus:ring-yellow-900">Connectez-vous!
                    </button>
                </div>
            </div>

        </nav>

        <!-- ##### GUEST BOTTOM NAV ##### -->
        <nav class="bottomNav fixed bottom-0 left-0 z-50 w-full h-16 bg-gray-900 border-t-2 border-gray-700 p-3">
            <div class="h-full flex justify-center align-middle grid-cols-4 mx-auto font-medium">
                <button type="button" @click="modalStore.openLoginModal()"
                    class="text-white bg-[#a54c03] hover:bg-[#966a46] focus:outline-none focus:ring-4 font-medium rounded-full text-sm p-3 focus:ring-yellow-900">Connectez-vous!
                </button>
            </div>
        </nav>
    </div>

    <div v-else>
        <!-- ##### CONNECTED TOPNAV ##### -->
        <nav class="topNav z-100 flex justify-between align-middle bg-gray-900 text-xl border-b-2 border-gray-700 p-3">

            <a href="/">
                <div @click="reload" class="relative w-[100px] h-[35px] flex justify-center items-center right-[10px] cursor-pointer">
                    <img src="../../../public/logo_franko.svg" class="w-full h-full object-cover" alt="">
                </div>
                <!-- <h1 class="text-gray-200 text-2xl">Franko</h1> -->
            </a>
        </nav>

        <!-- ##### CONNECTED SIDENAV ##### -->
        <nav class="sidenav bg-gray-900 text-xl border-r-2 border-gray-700 p-3 z-10">

            <div @click="reload" class="relative w-[100%] h-[50px] flex justify-center items-center right-[10px] cursor-pointer">
                <img src="../../../public/logo_franko.svg" class="w-full h-full object-cover" alt="">
            </div>
            <!-- <h1 class="text-gray-200 text-4xl">Franko</h1> -->

            <div class="flex flex-col h-full justify-between items-center py-[50px]">

                <div class="flex flex-col gap-[20px]">
                    <a href="/" class="text-white">
                        <i class="fa-solid fa-house"></i>
                        Home
                    </a>
                    <router-link to="/profil/" class="text-white">
                        <i class="fa-regular fa-user"></i>
                        Profil
                          <span class="relative flex size-3">
                            <span
                                class="absolute inline-flex h-full w-full animate-ping rounded-full bg-sky-400 opacity-75"></span>
                            <span class="relative inline-flex size-3 rounded-full bg-sky-500"></span>
                        </span>
                        </router-link>
                    <router-link to="" class="text-white" @click="showSearch = true">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        Search
                    </router-link>
                </div>

                <div class="flex flex-col gap-[40px] justify-center items-center">

                    <router-link to="/addcomment"
                        class="rounded-full w-[100px] bg-[#a54c03] text-center p-3 text-sm font-semibold text-white shadow-xs hover:bg-[#966a46]">
                        <i class="fa-solid fa-feather"></i>
                        Post
                    </router-link>


                    <!-- profile shortcut -->
                    <div class="z-[500000] relative">

                        <button id="dropdownRightButton1" data-dropdown-toggle="dropdownRight1" @click="sideShortcut = !sideShortcut"
                            data-dropdown-placement="right" class="rounded-full flex text-sm cursor-pointer">
                            <img :src="AuthStore.user.picture || 'https://placehold.co/100'" alt="Photo de profil"
                                class="img rounded-full object-cover border shadow" />
                            <!-- {{ userStore.selecteduser?.username }} -->
                        </button>

                        <div v-if="sideShortcut === true" id="dropdownRight1"
                            class="absolute top-[-10px] left-[85px] divide-y divide-gray-100 rounded-lg shadow-sm w-max bg-gray-800 border-2 border-gray-500 !z-[10000]">
                            <ul class="relative py-2 text-lg text-gray-200"
                                aria-labelledby="dropdownRightButton">
                                <li class="relative !z-[100]">
                                    <button @click.stop="modalStore.openLoginModal()"
                                        class="block px-4 py-2 hover:bg-gray-600 hover:text-white cursor-pointer">Connect
                                        to another profile</button>
                                </li>
                                <li class="relative !z-[100]">
                                    <button @click="AuthStore.Logout()"
                                        class="block px-4 py-2 hover:bg-gray-600 hover:text-white">Sign
                                        out to <span>{{ AuthStore.user.username }}</span></button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>


            </div>

        </nav>

        <!-- ##### CONNECTED BOTTOM NAV ##### -->
        <nav class="bottomNav fixed bottom-0 left-0 z-50 w-full h-16 bg-gray-900 border-t-2 border-gray-700 p-3">

            <div class="h-full flex justify-center items-center grid-cols-4 mx-auto font-medium">

                <div class="flex w-full justify-evenly items-center gap-[50px] text-xl">

                    <a href="/" class="text-white h-fit">
                        <i class="fa-solid fa-house"></i>
                    </a>

                    <router-link to="/profil/" class="text-white h-fit">
                        <i class="fa-regular fa-user"></i>
                    </router-link>

                    <div class="z-[50000] relative">

                        <!-- profile shortcut -->
                        <button id="dropdownRightButton2" data-dropdown-toggle="dropdownRight2" @click="bottomShortcut = !bottomShortcut"
                            data-dropdown-placement="top" class="rounded-full flex text-sm cursor-pointer">
                            <img :src="AuthStore.user.picture || 'https://placehold.co/100'" alt="Photo de profil"
                                class="img rounded-full object-cover border shadow" />
                            <!-- {{ userStore.selecteduser?.username }} -->
                        </button>

                        <div v-if="bottomShortcut === true" id="dropdownRight2"
                            class="absolute top-[-100px] left-[-80px] divide-y divide-gray-100 rounded-lg shadow-sm w-max bg-gray-800 border-2 border-gray-500 !z-[10000]">
                            <ul class="relative py-2 text-sm text-gray-200 !z-[10000]"
                                aria-labelledby="dropdownRightButton">
                                <li class="relative !z-[100]">
                                    <button @click.stop="modalStore.openLoginModal()"
                                        class="block px-4 py-2 hover:bg-gray-600 hover:text-white cursor-pointer">Connect
                                        to another profile</button>
                                </li>
                                <li class="relative !z-[100]">
                                    <button @click="AuthStore.Logout()" href="#"
                                        class="block px-4 py-2 hover:bg-gray-600 hover:text-white">Sign
                                        out to <span>{{ AuthStore.user.username }}</span></button>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <router-link to="" class="text-white h-fit" @click="showSearch = true">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </router-link>

                    <router-link to="/addcomment"
                        class="rounded-full bg-[#a54c03] text-center p-2 text-sm font-semibold text-white shadow-xs hover:bg-[#966a46]">
                        <i class="fa-solid fa-feather"></i>
                    </router-link>
                </div>
            </div>
        </nav>
    </div>

</template>

<style scoped>
.topNav {
    width: 100%;
    height: 60px;
    position: fixed;
    top: 0;
    left: 0;
}

.sidenav {
    display: block;
    width: 200px;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;

    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 20px;
}

.bottomNav,
.topNav {
    display: none;
}

.img {
    width: 70px;
    height: 70px;
}

@media screen and (max-width: 1050px) {

    .bottomNav,
    .topNav {
        display: block;
    }

    .sidenav {

        display: none;
    }

    .img {
        width: 40px;
        height: 40px;
    }
}
</style>
