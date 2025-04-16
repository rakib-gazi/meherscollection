<script setup>

import AdminLayout from "@/Layouts/AdminLayout.vue";
import {router, useForm} from "@inertiajs/vue3";
const data = useForm({
    firstName: '',
    lastName: '',
    email: '',
    mobile:'',
    password: '',
    role:''
})
const register = ()=>{
    data.post("/super-admin/add-user", {
        onsuccess: ()=>{
            alert("success");
        }
    });
}
</script>

<template>
    <AdminLayout>
        <div class="bg-white p-6 rounded-md max-w-lg mx-auto">
            <form class="w-full font-nunito" @submit.prevent="register">
                <div class="mb-5">
                    <label for="firstName" class="block mb-2  font-medium text-gray-900 dark:text-white">First Name</label>
                    <input type="text" id="firstName" v-model="data.firstName" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light" placeholder="name@flowbite.com"  />
                </div>
                <div class="mb-5">
                    <label for="lastName" class="block mb-2  font-medium text-gray-900 dark:text-white">Last Name</label>
                    <input type="text" id="lastName" v-model="data.lastName" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light" placeholder="name@flowbite.com"  />
                </div>
                <div class="mb-5">
                    <label for="email" class="block mb-2  font-medium text-gray-900 dark:text-white">Email</label>
                    <input type="email" id="email" v-model="data.email" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light" placeholder="name@flowbite.com"  />
                </div>
                <div class="mb-5">
                    <label for="mobile" class="block mb-2  font-medium text-gray-900 dark:text-white">Mobile Number</label>
                    <input type="text" id="mobile" v-model="data.mobile" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light" placeholder="name@flowbite.com"  />
                </div>
                <div class="mb-5">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                    <input autocomplete="new-password" type="password" v-model="data.password" id="password" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light"  />
                </div>
<!--                <div class="mb-5">-->
<!--                    <label for="repeat-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Repeat password</label>-->
<!--                    <input autocomplete="new-password" type="password" id="repeat-password" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light"  />-->
<!--                </div>-->
                <div class="mb-5">
                    <label for="role" class="block mb-2  font-medium text-gray-900 dark:text-white">Select Role</label>
                    <select id="role" v-model="data.role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                        <option>United States</option>
                        <option>Canada</option>
                        <option>France</option>
                        <option>Germany</option>
                    </select>
                </div>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add User</button>
            </form>
        </div>
    </AdminLayout>

</template>

