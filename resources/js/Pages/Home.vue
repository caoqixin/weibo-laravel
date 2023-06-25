<template>
    <Head title="主页"></Head>

    <div v-if="message" class="rounded-md bg-green-50 p-4 mb-2">
        <div class="flex">
            <div class="ml-3">
                <p class="text-sm font-medium text-green-800">
                    {{ message }}
                </p>
            </div>
        </div>
    </div>

    <div class="bg-slate-300 p-3 sm:p-5 rounded" v-if="!$page.props.isLogin">
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
                class="bg-green-400 text-white p-3 rounded mt-2"
                :href="registerUrl"
                as="button"
                >现在注册</Link
            >
        </p>
    </div>

    <div v-else>
        <ArticleForm :gravatar="$page.props.auth.gravatar" />
    </div>
</template>
<script setup>
import { computed } from "vue";
import ArticleForm from "../Shared/Components/ArticleForm.vue";

const props = defineProps({
    registerUrl: String,
    message: String,
});
</script>
