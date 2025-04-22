<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {useForm, usePage, router } from "@inertiajs/vue3";
import {ref} from "vue";
import Swal from "sweetalert2";
import {Inertia} from "@inertiajs/inertia";



const users = ref([]);
const useData = usePage().props.users;
const error = usePage().props.errors;
console.log(error);
users.value = useData;
const activeModalId = ref(null); // Track which modal is open
const selectedUser = ref(null);

const openModal = (user) => {
    activeModalId.value = user.id;
    selectedUser.value = {...user};

};

const closeModal = () => {
    activeModalId.value = null;
    selectedUser.value = null;
};

const data = useForm({
    id: null,
    firstName: '',
    lastName: '',
    email: '',
    mobile: '',
    password: '',
    role: ''
});


const updateRegister = () => {
    if (!selectedUser.value) return;

    // Update the form data to match the selectedUser
    data.id = selectedUser.value.id;
    data.firstName = selectedUser.value.firstName;
    data.lastName = selectedUser.value.lastName;
    data.email = selectedUser.value.email;
    data.mobile = selectedUser.value.mobile;
    data.password = selectedUser.value.password;
    data.role = selectedUser.value.role;

    // Send the PATCH request to update the user
    data.patch(`/super-admin/all-users`, {
        preserveScroll: true,
        onSuccess: () => {
            closeModal();
            Swal.fire({
                title: "User Updated Successfully",
                icon: "success"
            });

            // After successful update, get the updated user
            users.value = usePage().props.users;

        },
        onError: () => {
            console.log("Form submission errors:", data.error); // Log errors here
        },

    });
};


console.log(data.errors)

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
                            <div class="">{{ user.firstName+" "+ user.lastName }}</div>
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
                            <h3 class="text-xl font-bold">Update User Information</h3>
                            <button @click="closeModal" class="text-gray-400 hover:text-gray-900">✕</button>
                        </div>
                        <form class="w-full font-nunito" @submit.prevent="updateRegister">
                            <div class="py-4" v-if="selectedUser">
<!--                                selected user id-->
                                <input type="hidden" name="id" v-model="selectedUser.id" hidden/>
                                <!-- First Name -->
                                <div class="mb-5">
                                    <label for="firstName" class="block mb-2 font-medium text-gray-900">First Name</label>
                                    <input type="text" id="firstName" v-model="selectedUser.firstName"
                                           class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                    />
                                    <div v-if="data.errors.firstName" class="text-red-500 text-sm mt-1">{{ data.errors.firstName }}</div>

                                </div>

                                <!-- Last Name -->
                                <div class="mb-5">
                                    <label for="lastName" class="block mb-2 font-medium text-gray-900">Last Name</label>
                                    <input type="text" id="lastName" v-model="selectedUser.lastName"
                                           class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                    />
                                    <div v-if="data.errors.lastName" class="text-red-500 text-sm mt-1">{{ data.errors.lastName }}</div>
                                </div>

                                <!-- Email -->
                                <div class="mb-5">
                                    <label for="email" class="block mb-2 font-medium text-gray-900">Email</label>
                                    <input type="email" id="email" v-model="selectedUser.email"
                                           class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                    />
                                    <div v-if="data.errors.email" class="text-red-500 text-sm mt-1">{{ data.errors.email }}</div>
                                </div>

                                <!-- Mobile -->
                                <div class="mb-5">
                                    <label for="mobile" class="block mb-2 font-medium text-gray-900">Mobile Number</label>
                                    <input type="text" id="mobile" v-model="selectedUser.mobile"
                                           class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                    />
                                    <div v-if="data.errors.mobile" class="text-red-500 text-sm mt-1">{{ data.errors.mobile }}</div>
                                </div>

                                <!-- Password -->
                                <div class="mb-5">
                                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                                    <input type="password" v-model="selectedUser.password" id="password"
                                           class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                           autocomplete="new-password" />
                                    <div v-if="data.errors.password" class="text-red-500 text-sm mt-1">{{ data.errors.password }}</div>
                                </div>

                                <!-- Role -->
                                <div class="mb-5">
                                    <label for="role" class="block mb-2 font-medium text-gray-900">Select Role</label>
                                    <select id="role" v-model="selectedUser.role"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                                        <option value="" disabled>Select Role</option>
                                        <option value="admin">Admin</option>
                                        <option value="recruiter">Recruiter</option>
                                        <option value="client">Client</option>
                                    </select>
                                    <div v-if="data.errors.role" class="text-red-500 text-sm mt-1">{{ data.errors.role }}</div>
                                </div>
                            </div>
                            <div class="flex justify-end border-t pt-3">
                                <button type="submit"  class="text-white bg-[#10284a] hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5">Update User</button>
                                <button type="button" @click="closeModal" class="ml-2 px-4 py-2 border rounded">Decline</button>
                            </div>
                        </form>
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

