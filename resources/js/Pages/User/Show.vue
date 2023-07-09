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
    <div v-if="message" class="rounded-md bg-green-50 p-4 mb-2">
        <div class="flex">
            <div class="ml-3">
                <p class="text-sm font-medium text-green-800">
                    {{ message }}
                </p>
            </div>
        </div>
    </div>
    <Gravatar
        :profile-url="profileUrl"
        :user-name="user.name"
        :gravatar-src="gravatar"
    />

    <!-- 关注 -->
    <form
        class="flex flex-col items-center my-5"
        @submit.prevent="followOrUnFollow"
        v-if="can.follow"
    >
        <button
            type="submit"
            class="inline-flex items-center rounded-md border border-transparent px-4 py-2 text-sm font-mediumshadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
            :class="[
                isFollowing
                    ? 'bg-white text-indigo-600 border-indigo-600 hover:bg-indigo-300'
                    : 'bg-indigo-600 text-white hover:bg-indigo-700',
            ]"
        >
            {{ isFollowing ? "取消关注" : "关注" }}
        </button>
    </form>

    <Stats :statuses="statuses" />

    <!-- 文章 -->
    <div>
        <ul
            role="list"
            class="divide-y divide-gray-200 mt-2"
            :class="{ 'text-center': articles.data.length == 0 }"
        >
            <div v-if="articles.data.length != 0">
                <div v-for="article in articles.data" :key="article.id">
                    <ShowArticle
                        :article="article"
                        :user_name="user.name"
                        :gravatar="gravatar"
                    />
                </div>
                <div class="mt-6 flex justify-center">
                    <Pagination :links="articles.links" />
                </div>
            </div>
            <div v-else>暂时还没有数据哦!!</div>
        </ul>
    </div>
</template>
<script setup>
import ShowArticle from "../../Shared/Components/ShowArticle.vue";
import Gravatar from "../../Shared/Components/Gravatar.vue";
import Stats from "../../Shared/Components/Stats.vue";
import Pagination from "../../Shared/Components/Pagination.vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    user: Object,
    profileUrl: String,
    gravatar: String,
    welcome: String,
    message: String,
    articles: Object,
    statuses: Object,
    can: Object,
    isFollowing: Boolean,
});

const followOrUnFollow = () => {
    const requestUrl = `/users/followers/${props.user.id}`;
    if (!props.isFollowing) {
        router.post(requestUrl);
    } else {
        router.delete(requestUrl);
    }
};
</script>
