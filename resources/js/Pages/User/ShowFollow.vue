<template>
    <Head :title="title" />

    <div class="flex flex-col items-center">
        <h1 class="mt-4 mb-1 text-2xl">{{ title }}</h1>
    </div>

    <ul role="list" class="divide-y divide-gray-100">
        <li
            v-for="user in users.data"
            :key="user.id"
            class="flex justify-between gap-x-6 py-5"
        >
            <div class="flex gap-x-4">
                <img
                    class="h-12 w-12 flex-none rounded-full bg-gray-50"
                    :src="user.gravatar"
                    :alt="user.name"
                />
                <div class="min-w-0 flex-auto">
                    <p class="text-sm font-semibold leading-6 text-gray-900">
                        {{ user.name }}
                    </p>
                </div>
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
    title: String,
});
</script>
