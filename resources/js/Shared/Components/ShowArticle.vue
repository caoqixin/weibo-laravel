<template>
    <li class="py-4 border-b-2">
        <div class="flex space-x-3">
            <img
                class="h-6 w-6 rounded-full"
                :src="gravatar"
                :alt="user_name"
            />
            <div class="flex-1 space-y-1">
                <div class="flex items-center justify-between">
                    <h3 class="text-sm font-medium">
                        {{ user_name }} /
                        <i class="text-sm text-gray-400">{{
                            article.created_at
                        }}</i>
                    </h3>
                </div>
                <p class="text-sm text-gray-500">{{ article.content }}</p>
                <div class="hidden sm:flex sm:flex-col sm:items-end">
                    <DeleteButton
                        type="button"
                        v-if="article.can.delete"
                        @click="deleteButton"
                        >删除</DeleteButton
                    >
                </div>
            </div>
        </div>
    </li>

    <ConfirmAlert :open="open" @close="close" @confirm="destroy" />
</template>
<script setup>
import { ref } from "vue";
import ConfirmAlert from "../Components/ConfirmAlert.vue";
import { router } from "@inertiajs/vue3";
import DeleteButton from "./Buttons/DeleteButton.vue";
const props = defineProps({
    article: Object,
    user_name: String,
    gravatar: String,
});
const open = ref(false);
const deleteButton = () => {
    open.value = true;
};

const destroy = (value) => {
    if (value) {
        router.delete(`/articles/${props.article.id}`);
    }

    open.value = !open.value;
};

const close = (value) => {
    open.value = value;
};
</script>
