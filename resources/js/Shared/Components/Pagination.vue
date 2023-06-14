<template>
    <nav
        class="isolate inline-flex -space-x-px rounded-md shadow-sm"
        aria-label="Pagination"
    >
        <Component
            v-for="link in links"
            :is="link.url ? 'Link' : 'span'"
            :href="link.url"
            v-html="link.label"
            class="relative inline-flex items-center px-4 py-2 text-sm font-semibold"
            aria-current="page"
            :class="[
                link.active
                    ? 'z-10 bg-indigo-600 text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600'
                    : 'ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0',
                link.label.match('Previous') ? 'rounded-l-md' : '',
                link.label.match('Next') ? 'rounded-r-md' : '',
            ]"
        />
    </nav>
</template>
<script setup>
defineProps({
    links: Array,
});
</script>
