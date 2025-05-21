<script setup>

import meherlogo2 from "../../images/meherlogo2.png";
import meherlogo from "../../images/meherlogo.png";
import {Link} from "@inertiajs/vue3";
import {ref} from "vue";
import {useCollapsedSidebar} from "@/CustomJs/collaspable.js";
const isCollapsed = useCollapsedSidebar();
function toggleSidebar() {
    isCollapsed.value = !isCollapsed.value;
}
const data = [
    {
        item: "Category",
        link: "/super-admin/category",
        icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 0 0 2.25-2.25V6a2.25 2.25 0 0 0-2.25-2.25H6A2.25 2.25 0 0 0 3.75 6v2.25A2.25 2.25 0 0 0 6 10.5Zm0 9.75h2.25A2.25 2.25 0 0 0 10.5 18v-2.25a2.25 2.25 0 0 0-2.25-2.25H6a2.25 2.25 0 0 0-2.25 2.25V18A2.25 2.25 0 0 0 6 20.25Zm9.75-9.75H18a2.25 2.25 0 0 0 2.25-2.25V6A2.25 2.25 0 0 0 18 3.75h-2.25A2.25 2.25 0 0 0 13.5 6v2.25a2.25 2.25 0 0 0 2.25 2.25Z" />
                </svg>`
    },
    {
        item: "Sub Category",
        link: "/super-admin/sub-category",
        icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 0 1-1.125-1.125v-3.75ZM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-8.25ZM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-2.25Z" />
                </svg>`
    },
    {
        item: "Add Users",
        link: "/super-admin/add-user",
        icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                </svg>`
    },
    {
        item: "All Users",
        link: "/super-admin/all-users",
        icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                </svg>`
    },
    {
        item: "Log Out",
        link: "/logout",
        icon: `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                </svg>`
    }
];
</script>

<template>
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside  :class="[
        'bg-white border-r  fixed top-0 left-0 h-full z-50 transition-all duration-300',
        isCollapsed ? 'w-[70px]' : 'w-[250px]'
    ]">

            <div class="shadow " :class="isCollapsed ? 'py-7 px-4': 'p-4'">
                <Link href="/super-admin">
                    <img :src="isCollapsed ? meherlogo2 :meherlogo " alt="logo" class="transition-all duration-300  mx-auto" :class="isCollapsed? 'h-auto' : 'h-12' " />
                </Link>

            </div>

            <div class="py-6 font-nunito">
                <component
                    v-for="(nav, index) in data"
                    :is="nav.link ? Link : 'div'"
                    :key="index"
                    v-bind="nav.link ? { href: nav.link } : {}"
                    class="group flex items-center gap-3 text-gray-700 shadow font-medium px-4 py-2 transition-all duration-300 hover:bg-[#132749] hover:text-white cursor-pointer"
                >
                    <!-- Icon -->
                    <span
                        v-html="nav.icon"
                        class="text-gray-500 group-hover:text-white transition-all duration-300 transform group-hover:scale-110"
                    ></span>

                    <!-- Text -->
                    <span
                        v-if="!isCollapsed"
                        class="transition-all duration-300 group-hover:ml-1"
                    >
                      {{ nav.item }}
                    </span>
                </component>
            </div>
        </aside>

        <!-- Content -->
        <div :class="['flex-1 bg-gray-100 min-h-screen transition-all duration-300', isCollapsed ? 'ml-[70px]' : 'ml-[250px]']">
            <!-- Header -->
            <header class="bg-white p-6 shadow flex items-center justify-between">
                <div class="space-x-4 flex items-center">
                    <!-- collapse button-->
                    <button class="text-gray-500" @click="toggleSidebar">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                    <nav class="space-x-4 text-gray-600">
                        <a href="#">Apps</a>
                        <a href="#">Chat</a>
                        <a href="#">Calendar</a>
                        <a href="#">Notes</a>
                    </nav>
                </div>
                <div class="space-x-4 flex items-center">
                    <img src="https://flagcdn.com/w40/gb.png" alt="flag" class="w-5 h-5">
                    <span>🔔</span>
                    <img src="https://i.pravatar.cc/40" class="rounded-full w-8 h-8" alt="user">
                </div>
            </header>

            <!-- Main Content -->
            <main class="p-6">
                <slot/>
            </main>
        </div>
    </div>
</template>

<style scoped>

</style>
