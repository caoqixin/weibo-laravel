<template>
    <div class="px-4 py-5 sm:p-6 flex-col">
        <Link
            :href="link"
            class="text-base font-normal whitespace-nowrap text-gray-900"
        >
            {{ label }}
        </Link>
        <div class="flex items-baseline text-2xl font-semibold text-indigo-600">
            {{ count }}
        </div>
    </div>
</template>
<script setup>
defineProps({
    link: String,
    count: Number,
    label: String,
});
</script>
