<template>
    <div>
        <div
            class="mt-5 flex justify-around divide-gray-200 rounded-lg bg-white shadow"
        >
            <div class="px-4 py-5 sm:p-6 flex-col">
                <Link
                    :href="statuses.fans.link"
                    class="text-base font-normal whitespace-nowrap text-gray-900"
                >
                    粉丝
                </Link>
                <div
                    class="flex items-baseline text-2xl font-semibold text-indigo-600"
                >
                    {{ statuses.fans.count }}
                </div>
            </div>
            <div class="px-4 py-5 sm:p-6 flex-col">
                <Link
                    :href="statuses.followings.link"
                    class="text-base font-normal whitespace-nowrap text-gray-900"
                >
                    关注
                </Link>
                <div
                    class="flex items-baseline text-2xl font-semibold text-indigo-600"
                >
                    {{ statuses.followings.count }}
                </div>
            </div>
            <div class="px-4 py-5 sm:p-6 flex-col">
                <p
                    class="text-base font-normal whitespace-nowrap text-gray-900"
                >
                    微博
                </p>
                <div
                    class="flex items-baseline text-2xl font-semibold text-indigo-600"
                >
                    {{ statuses.articles }}
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
defineProps({
    statuses: Object,
});
</script>
