<template>
    <Head title="Login" />
    <div v-if="status" class="rounded-md bg-green-50 p-4 mb-2">
        <div class="flex">
            <div class="ml-3">
                <p class="text-sm font-medium text-green-800">
                    {{ status }}
                </p>
            </div>
        </div>
    </div>
    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <form class="space-y-6" @submit.prevent="login">
                <div>
                    <label
                        for="email"
                        class="block text-sm font-medium text-gray-700"
                        >邮箱</label
                    >
                    <div class="mt-1">
                        <input
                            id="email"
                            v-model="form.email"
                            name="email"
                            type="email"
                            required
                            class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                        />
                    </div>
                    <p
                        class="mt-2 text-sm text-red-600"
                        v-if="form.errors.email"
                    >
                        {{ form.errors.email }}
                    </p>
                </div>

                <div>
                    <label
                        for="password"
                        class="block text-sm font-medium text-gray-700"
                        >密码</label
                    >
                    <div class="mt-1">
                        <input
                            id="password"
                            v-model="form.password"
                            name="password"
                            type="password"
                            required
                            class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                        />
                    </div>
                    <p
                        class="mt-2 text-sm text-red-600"
                        v-if="form.errors.password"
                    >
                        {{ form.errors.password }}
                    </p>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input
                            id="remember"
                            v-model="form.remember"
                            name="remember"
                            type="checkbox"
                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                        />
                        <label
                            for="remember"
                            class="ml-2 block text-sm text-gray-900"
                            >记住我</label
                        >
                    </div>

                    <div class="text-sm">
                        <Link
                            href="forgot-password"
                            class="font-medium text-indigo-600 hover:text-indigo-500"
                            >忘记密码</Link
                        >
                    </div>
                </div>

                <div>
                    <SaveButton
                        type="submit"
                        :disabled="form.processing"
                        class="flex w-full justify-center"
                        >登录</SaveButton
                    >
                </div>
            </form>
        </div>
    </div>
</template>
<script setup>
import { useForm } from "@inertiajs/vue3";
import SaveButton from "../../Shared/Components/Buttons/SaveButton.vue";
defineProps({
    status: String,
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const login = () => {
    form.post("/login");
};
</script>
