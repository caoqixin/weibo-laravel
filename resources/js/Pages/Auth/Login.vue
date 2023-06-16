<template>
    <Head title="Login" />

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
                        <a
                            href="#"
                            class="font-medium text-indigo-600 hover:text-indigo-500"
                            >忘记密码</a
                        >
                    </div>
                </div>

                <div>
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        登录
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
<script setup>
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const login = () => {
    form.post("/login");
};
</script>
