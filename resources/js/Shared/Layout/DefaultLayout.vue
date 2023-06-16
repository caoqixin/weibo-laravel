<template>
    <header class="bg-gray-800">
        <Header :isLogin="isLogin" :user="user"></Header>
    </header>

    <section class="p-6">
        <main class="max-w-3xl mx-auto">
            <slot></slot>
        </main>
    </section>

    <section class="p-6">
        <Footer />
    </section>
</template>
<script setup>
import Footer from "./Footer.vue";
import Header from "./Header.vue";
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const page = usePage();

const isLogin = computed(() => page.props.isLogin);
const user = computed(() => page.props.auth);
</script>
<script></script>
