<template>
    <div class="flex flex-col items-center">
        <Link :href="profileUrl" class="pb-3">
            <img :src="gravatarSrc" :alt="userName" class="w-14 rounded-full" />
        </Link>
        <h1 class="mt-4 mb-1 text-2xl">{{ userName }}</h1>
    </div>
</template>
<script setup>
defineProps({
    profileUrl: String,
    gravatarSrc: String,
    userName: String,
});
</script>
