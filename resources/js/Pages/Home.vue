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

    <div v-else class="flex">
        <div>
            <ArticleForm :gravatar="$page.props.auth.gravatar" class="mt-2" />

            <!-- 文章 -->
            <div>
                <h4 class="font-bold text-lg mt-8 border-b-2 border-b-gray-400">
                    微博列表
                </h4>
                <ul
                    role="list"
                    class="divide-y divide-gray-200 mt-2"
                    :class="{ 'text-center': feeds.data.length == 0 }"
                >
                    <div v-if="feeds.data.length != 0">
                        <div v-for="feed in feeds.data" :key="feed.id">
                            <ShowArticle
                                :article="feed"
                                :user_name="$page.props.auth.info.name"
                                :gravatar="$page.props.auth.gravatar"
                            />
                        </div>
                    </div>
                    <div v-else>暂时还没有数据哦!!</div>
                </ul>
                <div class="mt-6 flex justify-center">
                    <Pagination :links="feeds.links" />
                </div>
            </div>
        </div>

        <div class="mt-2">
            <div class="ml-7">
                <Gravatar
                    :gravatar-src="$page.props.auth.gravatar"
                    :user-name="$page.props.auth.info.name"
                    :profile-url="`users/${$page.props.auth.info.id}`"
                />

                <Stats :statuses="statuses" />
            </div>
        </div>
    </div>
</template>
<script setup>
import ArticleForm from "../Shared/Components/ArticleForm.vue";
import ShowArticle from "../Shared/Components/ShowArticle.vue";
import Pagination from "../Shared/Components/Pagination.vue";
import Gravatar from "../Shared/Components/Gravatar.vue";
import Stats from "../Shared/Components/Stats.vue";

const props = defineProps({
    registerUrl: String,
    message: String,
    feeds: Object,
    statuses: Object,
});
</script>
