<template>
    <div class="flex items-start space-x-4">
        <div class="flex-shrink-0">
            <img class="inline-block h-10 w-10 rounded-full" :src="gravatar" />
        </div>
        <div class="min-w-0 flex-1">
            <form @submit.prevent="submit">
                <div
                    class="border-b border-gray-200 focus-within:border-indigo-600"
                >
                    <label for="content" class="sr-only">写下你的动态</label>
                    <textarea
                        rows="3"
                        name="content"
                        id="content"
                        v-model="form.content"
                        class="block w-full resize-none border-0 border-b border-transparent p-0 pb-2 focus:border-indigo-600 focus:ring-0 sm:text-sm"
                        maxlength="200"
                        placeholder="写下你的动态"
                    />
                </div>
                <div class="flex pt-2 justify-end">
                    <div class="flex-shrink-0">
                        <button
                            type="submit"
                            class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                            :disabled="form.processing"
                        >
                            发布
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script setup>
import { useForm } from "@inertiajs/vue3";

defineProps({
    gravatar: String,
});

const form = useForm({
    content: "",
});

const submit = () => {
    form.post("/articles", {
        onFinish: () => form.reset("content"),
    });
};
</script>
