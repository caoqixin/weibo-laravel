<template>
    <Head title="Home"></Head>

    <div class="bg-slate-300 p-3 sm:p-5 rounded">
        <h1>Hello Laravel</h1>
        <p class="leading-6">
            你现在所看到的是
            <a
                href="https://learnku.com/courses/laravel-essential-training"
                class="text-blue-600"
                >Laravel 入门教程</a
            >
            的示例项目主页。
        </p>
        <p class="mt-4">一切，将从这里开始。</p>
        <p>
            <Link
                v-if="!$page.props.isLogin"
                class="bg-green-400 text-white p-3 rounded mt-2"
                :href="registerUrl"
                as="button"
                >现在注册</Link
            >
        </p>
    </div>
</template>
<script setup>
defineProps({
    registerUrl: String,
});
</script>
