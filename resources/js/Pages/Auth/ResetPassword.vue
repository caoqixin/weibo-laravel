<template>
    <Head title="重置密码" />

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

        <div class="mt-4">
            <InputLabel for="password" value="密码" />

            <input
                type="password"
                id="password"
                v-model="form.password"
                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                required
            />
            <div v-show="form.errors.password">
                <p class="text-sm text-red-600 dark:text-red-400">
                    {{ form.errors.password }}
                </p>
            </div>
        </div>

        <div class="mt-4">
            <InputLabel for="password_confirmation" value="确认密码" />

            <input
                type="password"
                id="password_confirmation"
                v-model="form.password_confirmation"
                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                required
            />
            <div v-show="form.errors.password_confirmation">
                <p class="text-sm text-red-600 dark:text-red-400">
                    {{ form.errors.password_confirmation }}
                </p>
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <PrimaryButton
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                重置密码
            </PrimaryButton>
        </div>
    </form>
</template>
<script setup>
import { useForm } from "@inertiajs/vue3";
import PrimaryButton from "../../Shared/Components/PrimaryButton.vue";
import InputLabel from "../../Shared/Components/InputLabel.vue";

const props = defineProps({
    email: {
        type: String,
        required: true,
    },
    token: {
        type: String,
        required: true,
    },
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: "",
    password_confirmation: "",
});

const submit = () => {
    form.post("/reset-password", {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>
