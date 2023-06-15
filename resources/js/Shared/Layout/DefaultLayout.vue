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
        <main class="max-w-3xl mx-auto">
            <slot></slot>
        </main>
    </section>

    <section class="p-6">
        <footer class="max-w-3xl mx-auto flex justify-between border-t">
            <a
                href="https://learnku.com/laravel/courses"
                target="_blank"
                class="no-underline"
            >
                刻意练习，每日精进
            </a>

            <div class="float-left">
                <Link href="/about" class="no-underline">关于</Link>
            </div>
        </footer>
    </section>
</template>
<script setup>
import Nav from "../Components/Nav.vue";
</script>
<script></script>
