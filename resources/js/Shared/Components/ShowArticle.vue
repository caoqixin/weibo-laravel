<template>
    <li class="py-4 border-b-2">
        <div class="flex space-x-3">
            <img
                class="h-6 w-6 rounded-full"
                :src="gravatar"
                :alt="user_name"
            />
            <div class="flex-1 space-y-1">
                <div class="flex items-center justify-between">
                    <h3 class="text-sm font-medium">{{ user_name }}</h3>
                    <p class="text-sm text-gray-500">
                        {{ article.created_at }}
                    </p>
                </div>
                <p class="text-sm text-gray-500">{{ article.content }}</p>
            </div>
        </div>
    </li>
</template>
<script setup>
defineProps({
    article: Object,
    user_name: String,
    gravatar: String,
});
</script>
