<template>
    <Head :title="`${user.name}'s Profile`" />
    <div v-if="welcome" class="rounded-md bg-green-50 p-4 mb-2">
        <div class="flex">
            <div class="ml-3">
                <p class="text-sm font-medium text-green-800">
                    {{ welcome }}
                </p>
            </div>
        </div>
    </div>
    <div class="flex flex-col items-center">
        <Link :href="profileUrl" class="pb-3">
            <img :src="gravatar" :alt="user.name" class="w-14 rounded-full" />
        </Link>
        <h1 class="mt-4 mb-1 text-2xl">{{ user.name }}</h1>
    </div>
</template>
<script setup>
const props = defineProps({
    user: Object,
    profileUrl: String,
    gravatar: String,
    welcome: String,
});
</script>
