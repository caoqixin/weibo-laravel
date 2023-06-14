<template>
    <section class="p-6 bg-gray-700">
        <header class="flex justify-between">
            <Link
                href="/"
                as="h1"
                class="font-bold text-lg cursor-pointer text-white"
                >Weibo</Link
            >
            <Nav />
        </header>
    </section>

    <section class="p-6">
        <div class="max-w-3xl mx-auto">
            <slot></slot>
        </div>
    </section>
</template>
<script setup>
import Nav from "../Components/Nav.vue";
</script>
<script></script>
