<template>
    <Head title="忘记密码" />

    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        忘记密码了？没问题。告诉我们您的电子邮件地址，我们将向您发送一封包含重置密码链接的电子邮件，让您选择一个新密码。
    </div>

    <div
        v-if="status"
        class="mb-4 font-medium text-sm text-green-600 dark:text-green-400"
    >
        {{ status }}
    </div>

    <form @submit.prevent="submit">
        <div>
            <InputLabel for="email" value="邮箱" />
            <input
                type="email"
                id="email"
                v-model="form.email"
                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                required
                autofocus
            />
            <div v-show="form.errors.email">
                <p class="text-sm text-red-600 dark:text-red-400">
                    {{ form.errors.email }}
                </p>
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <PrimaryButton
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                发送重置密码邮件
            </PrimaryButton>
        </div>
    </form>
</template>
<script setup>
import { useForm } from "@inertiajs/vue3";
import PrimaryButton from "../../Shared/Components/PrimaryButton.vue";
import InputLabel from "../../Shared/Components/InputLabel.vue";

defineProps({
    status: String,
});

const form = useForm({
    email: "",
});

const submit = () => {
    form.post("/forgot-password");
};
</script>
