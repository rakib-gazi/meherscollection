<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { usePage } from "@inertiajs/vue3";
import {computed, ref} from "vue";

const users = computed(() => usePage().props.users);

const activeModalId = ref(null); // Track which modal is open
const selectedUser = ref(null);

const openModal = (user) => {
    activeModalId.value = user.id;
    selectedUser.value = user;
};

const closeModal = () => {
    activeModalId.value = null;
    selectedUser.value = null;
};
</script>

<template>
    <AdminLayout>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg font-nunito">
            <table class="w-full text-sm text-left rtl:text-right  ">
                <thead class=" text-white  bg-[#132749]">
                <tr class="font-semibold text-base">
                    <th scope="col" class="p-4">
                        SL
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Full Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Phone
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Role
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Action
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(user, index) in users" :key="user.id" class="bg-white text-[#132749] border-b  border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4 w-6">
                        {{ index+1 }}
                    </td>
                    <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
<!--                        <img class="w-10 h-10 rounded-full" src="/docs/images/people/profile-picture-1.jpg" alt="Jese image">-->
                        <div class="ps-3">
                            <div class="">{{ user.lastName+" "+ user.lastName }}</div>
                        </div>
                    </th>
                    <td class="px-6 py-4">
                        {{ user.email }}
                    </td>
                    <td class="px-6 py-4">
                        {{ user.mobile }}
                    </td>
                    <td class="px-6 py-4">
                        {{ user.role }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex justify-center items-center">

                            <button @click="openModal(user)">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-[#132749]">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                            </button>


                        </div>
                    </td>
                </tr>

                </tbody>
            </table>
        </div>
        <!-- Shared Modal, rendered only once -->
        <transition name="fade">
            <div
                v-if="activeModalId"
                class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
            >
                <transition name="scale">
                    <div
                        class="bg-white rounded-lg w-full max-w-2xl p-6"
                        @click.stop
                    >
                        <div class="flex justify-between items-center border-b pb-3">
                            <h3 class="text-xl font-semibold">Terms of Service</h3>
                            <button @click="closeModal" class="text-gray-400 hover:text-gray-900">✕</button>
                        </div>
                        <div class="py-4">
                            <p v-if="selectedUser">Modal content goes here for {{ selectedUser.lastName }}</p>
                        </div>
                        <div class="flex justify-end border-t pt-3">
                            <button @click="closeModal" class="px-4 py-2 bg-blue-600 text-white rounded">I Accept</button>
                            <button @click="closeModal" class="ml-2 px-4 py-2 border rounded">Decline</button>
                        </div>
                    </div>
                </transition>
            </div>
        </transition>
    </AdminLayout>
</template>
<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

.scale-enter-active,
.scale-leave-active {
    transition: transform 0.3s ease;
}
.scale-enter-from,
.scale-leave-to {
    transform: scale(0.95);
}
</style>

