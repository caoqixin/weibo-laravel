<template>
    <div>
        <div
            class="mt-5 flex justify-around divide-gray-200 rounded-lg bg-white shadow"
        >
            <StatBlock
                label="粉丝"
                :count="statuses.fans.count"
                :link="statuses.fans.link"
            />
            <StatBlock
                label="关注"
                :count="statuses.followings.count"
                :link="statuses.followings.link"
            />
            <StatBlock
                label="微博"
                :count="statuses.articles.count"
                :link="statuses.articles.link"
            />
        </div>
    </div>
</template>

<script setup>
import StatBlock from "./StatBlock.vue";

defineProps({
    statuses: Object,
});
</script>
