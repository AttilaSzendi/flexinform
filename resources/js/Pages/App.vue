<script setup>

</script>

<template>
    <div>
        <h1>Vue SPA</h1>
        <nav>
            <router-link to="/">Home</router-link> |
            <router-link to="/about">About</router-link>
        </nav>
        <router-view></router-view>
    </div>
</template>

<style scoped>

</style>
