<template>
    <header>
        <Disclosure as="nav" v-slot="{ open }">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 text-white">
                            <Link href="/">Weibo App</Link>
                        </div>
                    </div>
                    <div class="hidden sm:ml-6 sm:block" v-if="isLogin">
                        <div class="flex items-center">
                            <Link
                                href="#"
                                class="bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                            >
                                用户列表
                            </Link>
                            <!-- Profile dropdown -->
                            <Menu as="div" class="relative ml-3">
                                <div>
                                    <MenuButton
                                        class="flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                                    >
                                        <span class="sr-only"
                                            >Open user menu</span
                                        >
                                        <img
                                            class="h-8 w-8 rounded-full"
                                            :src="user.gravatar"
                                            :alt="user.info.name"
                                        />
                                    </MenuButton>
                                </div>
                                <transition
                                    enter-active-class="transition ease-out duration-100"
                                    enter-from-class="transform opacity-0 scale-95"
                                    enter-to-class="transform opacity-100 scale-100"
                                    leave-active-class="transition ease-in duration-75"
                                    leave-from-class="transform opacity-100 scale-100"
                                    leave-to-class="transform opacity-0 scale-95"
                                >
                                    <MenuItems
                                        class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                    >
                                        <MenuItem v-slot="{ active }">
                                            <Link
                                                :href="`/users/${user.info.id}`"
                                                :class="[
                                                    active ? 'bg-gray-100' : '',
                                                    'block px-4 py-2 text-sm text-gray-700',
                                                ]"
                                                >个人中心</Link
                                            >
                                        </MenuItem>
                                        <MenuItem v-slot="{ active }">
                                            <Link
                                                href="#"
                                                :class="[
                                                    active ? 'bg-gray-100' : '',
                                                    'block px-4 py-2 text-sm text-gray-700',
                                                ]"
                                                >编辑资料</Link
                                            >
                                        </MenuItem>
                                        <MenuItem v-slot="{ active }">
                                            <Link
                                                href="/logout"
                                                method="delete"
                                                :class="[
                                                    active ? 'bg-gray-100' : '',
                                                    'block px-4 py-2 text-sm text-gray-700',
                                                ]"
                                                >退出</Link
                                            >
                                        </MenuItem>
                                    </MenuItems>
                                </transition>
                            </Menu>
                        </div>
                    </div>
                    <div class="hidden sm:ml-6 sm:block" v-else>
                        <div class="flex items-center">
                            <Nav />
                        </div>
                    </div>
                    <div class="-mr-2 flex sm:hidden" v-if="isLogin">
                        <!-- Mobile menu button -->
                        <DisclosureButton
                            class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                        >
                            <span class="sr-only">Open main menu</span>
                            <Bars3Icon
                                v-if="!open"
                                class="block h-6 w-6"
                                aria-hidden="true"
                            />
                            <XMarkIcon
                                v-else
                                class="block h-6 w-6"
                                aria-hidden="true"
                            />
                        </DisclosureButton>
                    </div>
                    <div class="-mr-2 flex sm:hidden" v-else>
                        <DisclosureButton
                            class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                        >
                            <NavLink href="/login">登录</NavLink>
                        </DisclosureButton>
                    </div>
                </div>
            </div>

            <DisclosurePanel class="sm:hidden" v-if="isLogin">
                <div class="border-t border-gray-700 pt-4 pb-3">
                    <div class="flex items-center px-5">
                        <div class="flex-shrink-0">
                            <img
                                class="h-10 w-10 rounded-full"
                                :src="user.gravatar"
                                :alt="user.info.name"
                            />
                        </div>
                        <div class="ml-3">
                            <div class="text-base font-medium text-white">
                                {{ user.info.name }}
                            </div>
                            <div class="text-sm font-medium text-gray-400">
                                {{ user.info.email }}
                            </div>
                        </div>
                        <button
                            type="button"
                            class="ml-auto flex-shrink-0 bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                        >
                            用户列表
                        </button>
                    </div>
                    <div class="mt-3 space-y-1 px-2">
                        <DisclosureButton
                            as="a"
                            :href="`/users/${user.info.id}`"
                            class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white"
                            >个人中心</DisclosureButton
                        >
                        <DisclosureButton
                            as="a"
                            href="#"
                            class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white"
                            >编辑资料</DisclosureButton
                        >
                        <DisclosureButton
                            as="a"
                            href="#"
                            class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white"
                            >退出</DisclosureButton
                        >
                    </div>
                </div>
            </DisclosurePanel>
        </Disclosure>
    </header>
</template>
<script setup>
import {
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
} from "@headlessui/vue";
import { Bars3Icon, XMarkIcon } from "@heroicons/vue/24/outline";
import Nav from "../Components/Nav.vue";
import NavLink from "../Components/NavLink.vue";

defineProps({
    isLogin: Boolean,
    user: Object,
});
</script>
