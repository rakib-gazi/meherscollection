<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {Link, useForm} from "@inertiajs/vue3";
import Swal from "sweetalert2";

// Set up form state
const data = useForm({
    firstName: '',
    lastName: '',
    email: '',
    mobile: '',
    password: '',
    role: ''
});

// Submit handler
const register = () => {
    data.post("/super-admin/add-user", {
        onSuccess: () => {
            data.reset();
            Swal.fire({
                title: "User Added Successfully",
                icon: "success"
            });
             // Clear form after success
        }
    });
};
</script>

<template>
    <AdminLayout>
        <div class="flex justify-between items-center">
            <Link href="/super-admin" class="mb-4 text-white bg-cyan-950 hover:bg-blue-700 font-medium rounded-lg px-4 py-2 flex justify-center items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                </svg>

                Go Back
            </Link>
        </div>
        <div class="bg-white p-6 rounded-md max-w-lg mx-auto">
            <h1 class="text-2xl text-cyan-950 font-bold text-center py-3">Add User</h1>
            <form class="w-full font-nunito" @submit.prevent="register">
                <!-- First Name -->
                <div class="mb-5">
                    <label for="firstName" class="block mb-2 font-medium text-gray-900">First Name</label>
                    <input type="text" id="firstName" v-model="data.firstName"
                           class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                            />
                    <div v-if="data.errors.firstName" class="text-red-500 text-sm mt-1">{{ data.errors.firstName }}</div>
                </div>

                <!-- Last Name -->
                <div class="mb-5">
                    <label for="lastName" class="block mb-2 font-medium text-gray-900">Last Name</label>
                    <input type="text" id="lastName" v-model="data.lastName"
                           class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                            />
                    <div v-if="data.errors.lastName" class="text-red-500 text-sm mt-1">{{ data.errors.lastName }}</div>
                </div>

                <!-- Email -->
                <div class="mb-5">
                    <label for="email" class="block mb-2 font-medium text-gray-900">Email</label>
                    <input type="email" id="email" v-model="data.email"
                           class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                            />
                    <div v-if="data.errors.email" class="text-red-500 text-sm mt-1">{{ data.errors.email }}</div>
                </div>

                <!-- Mobile -->
                <div class="mb-5">
                    <label for="mobile" class="block mb-2 font-medium text-gray-900">Mobile Number</label>
                    <input type="phone" id="mobile" v-model="data.mobile"
                           class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                            />
                    <div v-if="data.errors.mobile" class="text-red-500 text-sm mt-1">{{ data.errors.mobile }}</div>
                </div>

                <!-- Password -->
                <div class="mb-5">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                    <input type="password" v-model="data.password" id="password"
                           class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                           autocomplete="new-password" />
                    <div v-if="data.errors.password" class="text-red-500 text-sm mt-1">{{ data.errors.password }}</div>
                </div>

                <!-- Role -->
                <div class="mb-5">
                    <label for="role" class="block mb-2 font-medium text-gray-900">Select Role</label>
                    <select id="role" v-model="data.role"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                        <option value="" disabled>Select Role</option>
                        <option value="admin">Admin</option>
                        <option value="recruiter">Recruiter</option>
                        <option value="client">Client</option>
                    </select>
                    <div v-if="data.errors.role" class="text-red-500 text-sm mt-1">{{ data.errors.role }}</div>
                </div>

                <!-- Submit -->
                <button type="submit" class="text-white bg-[#10284a] hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 w-full">Add User</button>
            </form>
        </div>
    </AdminLayout>
</template>
