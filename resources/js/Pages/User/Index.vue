<template>
    <Head title="用户列表" />

    <div v-if="message" class="rounded-md bg-green-50 p-4 mb-2">
        <div class="flex">
            <div class="ml-3">
                <p class="text-sm font-medium text-green-800">
                    {{ message }}
                </p>
            </div>
        </div>
    </div>

    <ul role="list" class="divide-y divide-gray-100">
        <li
            v-for="user in users.data"
            :key="user.id"
            class="flex justify-between gap-x-6 py-5"
        >
            <Link class="flex gap-x-4" :href="user.link">
                <img
                    class="h-12 w-12 flex-none rounded-full bg-gray-50"
                    :src="user.gravatar"
                    :alt="user.name"
                />
                <div class="min-w-0 flex-auto">
                    <p class="text-sm font-semibold leading-6 text-gray-900">
                        {{ user.name }}
                    </p>
                    <p class="mt-1 truncate text-xs leading-5 text-gray-500">
                        {{ user.email }}
                    </p>
                </div>
            </Link>

            <div class="hidden sm:flex sm:flex-col sm:items-end">
                <Link
                    v-if="user.can.delete"
                    :href="`/users/${user.id}`"
                    method="delete"
                    as="button"
                    class="inline-flex items-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                >
                    删除
                </Link>
            </div>
        </li>
    </ul>

    <div class="mt-6 flex justify-center">
        <Pagination :links="users.links" />
    </div>
</template>
<script setup>
import Pagination from "../../Shared/Components/Pagination.vue";
defineProps({
    users: Object,
    message: String,
});
</script>
