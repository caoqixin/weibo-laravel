<template>
    <Head :title="`${user.name}'s Profile`" />
    <div class="flex flex-col items-center">
        <Link :href="profileUrl" class="pb-3">
            <img :src="gravatar" :alt="user.name" class="w-14 rounded-full" />
        </Link>
        <h1 class="mt-4 mb-1 text-2xl">{{ user.name }}</h1>
    </div>
</template>
<script setup>
defineProps({
    user: Object,
    profileUrl: String,
    gravatar: String,
});
</script>
