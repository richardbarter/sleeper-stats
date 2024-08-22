<template>
    <div
        class="w-full px-1 pt-5 pb-5 bg-gradient-to-r from-primary-500/20 via-primary-500/10 to-surface-500/20"
    >
        <!-- <Menubar :model="items" /> -->
    </div>
</template>
<!-- bg-gradient-to-r from-orange-300 to-red-500
  -->
<script setup>
import Menubar from "primevue/menubar";

import { ref } from "vue";
//placeholder stuff.
const items = ref([
    {
        label: "Home",
        icon: "pi pi-home",
    },
    {
        label: "Features",
        icon: "pi pi-star",
    },
    {
        label: "Projects",
        icon: "pi pi-search",
        items: [
            {
                label: "Components",
                icon: "pi pi-bolt",
            },
            {
                label: "Blocks",
                icon: "pi pi-server",
            },
            {
                label: "UI Kit",
                icon: "pi pi-pencil",
            },
            {
                label: "Templates",
                icon: "pi pi-palette",
                items: [
                    {
                        label: "Apollo",
                        icon: "pi pi-palette",
                    },
                    {
                        label: "Ultima",
                        icon: "pi pi-palette",
                    },
                ],
            },
        ],
    },
    {
        label: "Contact",
        icon: "pi pi-envelope",
    },
]);
</script>

<!-- <Menubar
            :pt="{
                root: { class: 'bg-gradient-to-r from-orange-300 to-red-500' },
            }"
            :ptOptions="{
                mergeProps: true,
            }"
            :model="items"
        /> -->
