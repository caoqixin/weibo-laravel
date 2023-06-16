<template>
    <Head title="修改资料" />

    <form class="divide-y divide-gray-200 lg:col-span-9" @submit.prevent="save">
        <div class="py-6 px-4 sm:p-6 lg:pb-8">
            <div>
                <h2 class="text-lg font-medium leading-6 text-gray-900">
                    个人资料更新
                </h2>
            </div>

            <div class="mt-6 flex flex-col lg:flex-row">
                <div class="flex-grow space-y-6">
                    <div>
                        <label
                            for="email"
                            class="block text-sm font-medium text-gray-700"
                            >邮箱</label
                        >
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <input
                                type="email"
                                name="email"
                                id="email"
                                class="block w-full min-w-0 flex-grow rounded-md border-gray-300 focus:border-sky-500 focus:ring-sky-500 sm:text-sm"
                                :value="form.email"
                                disabled
                            />
                        </div>
                    </div>

                    <div>
                        <label
                            for="name"
                            class="block text-sm font-medium text-gray-700"
                            >用户名</label
                        >
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <input
                                type="text"
                                name="name"
                                id="name"
                                v-model="form.name"
                                class="block w-full min-w-0 flex-grow rounded-md border-gray-300 focus:border-sky-500 focus:ring-sky-500 sm:text-sm"
                            />
                        </div>
                    </div>

                    <div>
                        <label
                            for="password"
                            class="block text-sm font-medium text-gray-700"
                            >密码</label
                        >
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <input
                                type="password"
                                name="password"
                                id="password"
                                v-model="form.password"
                                class="block w-full min-w-0 flex-grow rounded-md border-gray-300 focus:border-sky-500 focus:ring-sky-500 sm:text-sm"
                            />
                        </div>
                    </div>

                    <div>
                        <label
                            for="password_confirmation"
                            class="block text-sm font-medium text-gray-700"
                            >确认密码</label
                        >
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <input
                                type="text"
                                name="password_confirmation"
                                id="password_confirmation"
                                v-model="form.password_confirmation"
                                class="block w-full min-w-0 flex-grow rounded-md border-gray-300 focus:border-sky-500 focus:ring-sky-500 sm:text-sm"
                            />
                        </div>
                    </div>
                </div>

                <div
                    class="mt-6 flex-grow lg:mt-0 lg:ml-6 lg:flex-shrink-0 lg:flex-grow-0"
                >
                    <div class="mt-1 lg:hidden">
                        <div class="flex items-center">
                            <div
                                class="inline-block h-12 w-12 flex-shrink-0 overflow-hidden rounded-full"
                                aria-hidden="true"
                            >
                                <img
                                    class="h-full w-full rounded-full"
                                    :src="gravatar"
                                    :alt="user.name"
                                />
                            </div>
                        </div>
                    </div>

                    <div
                        class="relative hidden overflow-hidden rounded-full lg:block"
                    >
                        <img
                            class="relative h-40 w-40 rounded-full"
                            :src="gravatar"
                            :alt="user.name"
                        />
                    </div>
                </div>
            </div>

            <div class="mt-4 flex justify-end py-4 px-4 sm:px-6">
                <Link
                    href="/users"
                    as="button"
                    type="button"
                    class="inline-flex justify-center rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2"
                >
                    返回
                </Link>
                <button
                    type="submit"
                    class="ml-5 inline-flex justify-center rounded-md border border-transparent bg-sky-700 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-sky-800 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2"
                >
                    保存
                </button>
            </div>
        </div>
    </form>
</template>
<script setup>
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    user: Object,
    gravatar: String,
});

const form = useForm(props.user);

const save = () => {
    form.patch(`/users/${form.id}`);
};
</script>
