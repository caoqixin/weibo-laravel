<template>
    <Head title="注册" />

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <form class="space-y-6" @submit.prevent="register">
                <div>
                    <label
                        for="name"
                        class="block text-sm font-medium text-gray-700"
                        >用户名</label
                    >
                    <div class="mt-1">
                        <input
                            id="name"
                            v-model="form.name"
                            name="name"
                            type="name"
                            required
                            class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                        />
                    </div>
                    <p
                        class="mt-2 text-sm text-red-600"
                        v-if="form.errors.name"
                    >
                        {{ form.errors.name }}
                    </p>
                </div>

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
                <div>
                    <label
                        for="password_confirmation"
                        class="block text-sm font-medium text-gray-700"
                        >确认密码</label
                    >
                    <div class="mt-1">
                        <input
                            id="password_confirmation"
                            v-model="form.password_confirmation"
                            name="password_confirmation"
                            type="password"
                            required
                            class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                        />
                    </div>
                    <p
                        class="mt-2 text-sm text-red-600"
                        v-if="form.errors.password_confirmation"
                    >
                        {{ form.errors.password_confirmation }}
                    </p>
                </div>

                <div>
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        注册
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
<script setup>
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const register = () => {
    form.post("/register");
};
</script>
<script></script>
