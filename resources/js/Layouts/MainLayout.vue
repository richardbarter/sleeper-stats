<template>
    <div class="flex flex-col">
        <!-- Header -->
        <Header />

        <div class="flex flex-1 overflow-hidden">
            <!-- Main Content -->
            <main class="flex-1 p-4">
                <slot></slot>
            </main>
        </div>
    </div>
</template>

<script setup>
import Header from "./Header.vue";
</script>
