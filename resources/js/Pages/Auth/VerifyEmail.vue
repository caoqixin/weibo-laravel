<template>
    <Head title="邮箱验证" />

    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        感谢您的注册! 在开始之前, 您需要验证您的邮箱,
        如果您没有收到可以点击以下按钮重新发送
    </div>

    <div
        class="mb-4 font-medium text-sm text-green-600 dark:text-green-400"
        v-if="verificationLinkSent"
    >
        新的邮件已发到您的邮箱, 请查收
    </div>

    <form @submit.prevent="submit">
        <div class="mt-4 flex items-center justify-between">
            <button
                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                重发
            </button>

            <Link
                href="/logout"
                method="delete"
                as="button"
                class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                >退出登录</Link
            >
        </div>
    </form>
</template>
<script setup>
import { useForm } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({
    status: {
        type: String,
    },
});

const form = useForm({});

const submit = () => {
    form.post("/email/verification-notification");
};

const verificationLinkSent = computed(
    () => props.status === "verification-link-sent"
);
</script>
