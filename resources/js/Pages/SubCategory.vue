<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { router, useForm, usePage,Link } from "@inertiajs/vue3";
import Swal from "sweetalert2";
import { ref } from "vue";
import { Dialog, DialogOverlay, DialogTitle } from "@headlessui/vue";
// State
const userData = ref(usePage().props.subCategories);
const isModalOpen = ref(false);
const isEditMode = ref(false);
const isSubmitting = ref(false);
let editingUserId = null;
// Modal Control
const openModal = () => {
    isModalOpen.value = true;
};
const closeModal = () => {
    if (document.activeElement instanceof HTMLElement) {
        document.activeElement.blur();
    }
    isModalOpen.value = false;
    isEditMode.value = false;
    editingUserId = null;
    data.reset();
};
// Form
const data = useForm({
    sub_category: '',
});
// Refresh User List
const fetchUsers = () => {
    router.reload({
        only: ['sub_category'],
        onSuccess: () => {
            userData.value = usePage().props.subCategories;
        }
    });
};

// Add or Update User
const handleSubmit = () => {
    isSubmitting.value = true;
    if (isEditMode.value) {
        data.put(`/super-admin/update-sub-category/${editingUserId}`, {
            onSuccess: () => {
                Swal.fire({
                    icon: 'success',
                    title: 'Sub Category updated successfully',
                    showConfirmButton: false,
                    timer: 1000
                });
                closeModal();
                fetchUsers();
            },
            onFinish: () => isSubmitting.value = false
        });
    } else {
        data.post('/super-admin/add-sub-category', {
            onSuccess: () => {
                Swal.fire({
                    icon: 'success',
                    title: 'Sub Category added successfully',
                    showConfirmButton: false,
                    timer: 1000
                });
                closeModal();
                fetchUsers();
            },
            onFinish: () => isSubmitting.value = false
        });
    }
};

// Prepare Edit
const handleEdit = (id,sub_category) => {
    editingUserId = id;
    isEditMode.value = true;
    data.sub_category = sub_category;
    openModal();

};
const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
    }
});

// Delete
const handleDelete = (id) => {
    Swal.fire({
        title: 'Are you sure?',
        text: "This Sub Category will be deleted permanently!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            router.get(`/super-admin/delete-sub-category/${id}`)
            Toast.fire({
                icon: "warning",
                title: "Sub Category Deleted successfully"
            });
        }
    });
};

// Table Headers
const tableHeaders = [
    { text: 'Sub Category', value: 'sub_category' },
    { text: 'Actions', value: 'actions' },
];
</script>

<template>

        <AdminLayout>
            <div>
                <div class="flex justify-between items-center">
                    <Link href="/super-admin" class="mb-4 text-white bg-cyan-950 hover:bg-blue-700 font-medium rounded-lg px-4 py-2 flex justify-center items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                        </svg>

                        Go Back
                    </Link>

                    <button @click="openModal" class="mb-4 text-white bg-cyan-950 hover:bg-blue-700 font-medium rounded-lg px-4 py-2 flex justify-center items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 0 1-1.125-1.125v-3.75ZM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-8.25ZM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-2.25Z" />
                        </svg>

                        Add Sub Category
                    </button>
                </div>

                <!-- Modal -->
                <Dialog :open="isModalOpen" @close="closeModal" class="fixed z-50 inset-0 overflow-y-auto" aria-hidden="false">
                    <div class="flex items-center justify-center min-h-screen p-4 text-center">
                        <DialogOverlay class="fixed inset-0 bg-black opacity-30" />
                        <div class="relative bg-white w-full max-w-lg p-6 rounded-xl shadow-xl z-50">
                            <DialogTitle class="text-xl font-semibold mb-4">
                                {{ isEditMode ? 'Edit Sub Category' : 'Add Sub Category' }}
                            </DialogTitle>

                            <form @submit.prevent="handleSubmit" class="space-y-3">
                                <div>

                                    <input v-model="data.sub_category" type="text" class="w-full border p-2 rounded" />
                                    <div v-if="data.errors.sub_category" class="text-red-500 text-sm">{{ data.errors.sub_category }}</div>
                                </div>
                                <div class="flex justify-end space-x-2 mt-4">
                                    <button type="button" @click="closeModal" class="px-4 py-2 bg-red-600 rounded hover:bg-red-700 text-sm text-white">Cancel</button>
                                    <button
                                        type="submit"
                                        class="px-4 py-2 bg-cyan-950 text-white rounded hover:bg-blue-700 text-sm flex items-center justify-center min-w-[120px]"
                                        :disabled="isSubmitting"
                                    >
                                        <svg v-if="isSubmitting" class="animate-spin h-4 w-4 mr-2 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                                        </svg>
                                        {{ isSubmitting ? (isEditMode ? 'Updating...' : 'Submitting...') : (isEditMode ? 'Update' : 'Submit ') }}
                                    </button>

                                </div>
                            </form>
                        </div>
                    </div>
                </Dialog>

                <!-- Table -->
                <EasyDataTable
                    buttons-pagination
                    :headers="tableHeaders"
                    :items="userData"
                    :rows-per-page="5"
                    table-class-name="customize-table"
                    show-index
                >
                    <template #item-actions="{ id,sub_category}">
                        <div class="flex gap-2">
                            <button @click="handleEdit(id,sub_category)" class="bg-yellow-400 text-white px-2 py-1 rounded text-sm hover:bg-yellow-500">
                                Edit
                            </button>
                            <button @click="handleDelete(id)" class="bg-red-500 text-white px-2 py-1 rounded text-sm hover:bg-red-600">
                                Delete
                            </button>
                        </div>
                    </template>
                </EasyDataTable>
            </div>
        </AdminLayout>


</template>

<style scoped>
::v-deep(.customize-table) {
    --easy-table-header-font-size: 16px;
    --easy-table-body-row-font-size: 14px;
    --easy-table-header-font-color: #111827;
    --easy-table-body-row-font-color: #374151;
    --easy-table-border: 1px solid #e5e7eb;
}
::v-deep(.customize-table thead th:nth-child(3)),
::v-deep(.customize-table tbody td:nth-child(3)) {
    max-width: 200px;
    word-wrap: break-word;
    word-break: break-word;
    white-space: normal;
}
</style>
