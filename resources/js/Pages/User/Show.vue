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
            </div>
            <div v-else>暂时还没有数据哦!!</div>
        </ul>
    </div>
</template>
<script setup>
import ShowArticle from "../../Shared/Components/ShowArticle.vue";
import Gravatar from "../../Shared/Components/Gravatar.vue";
import Stats from "../../Shared/Components/Stats.vue";

const props = defineProps({
    user: Object,
    profileUrl: String,
    gravatar: String,
    welcome: String,
    message: String,
    articles: Object,
    statuses: Object,
});
</script>
