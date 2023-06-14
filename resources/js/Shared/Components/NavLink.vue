<template>
    <Link
        class="text-gray-400 hover:underline"
        :class="{
            'font-bold underline': active,
        }"
    >
        <slot />
    </Link>
</template>
<script setup>
defineProps({
    active: Boolean,
});
</script>
