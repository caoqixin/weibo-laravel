<template>
    <nav class="ml-6">
        <ul class="flex space-x-6">
            <li>
                <NavLink :active="$page.component === 'Help'" href="/help"
                    >帮助</NavLink
                >
            </li>
            <li>
                <NavLink href="/login">登录</NavLink>
            </li>
        </ul>
    </nav>
</template>
<script setup>
import NavLink from "./NavLink.vue";
</script>
<script></script>
