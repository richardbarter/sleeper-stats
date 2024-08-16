<template>
    <Head title="Best Ball" />
    <!-- <div class="card flex justify-center text-white">test</div> -->

    <DataTable :value="customRankings" tableStyle="min-width: 50rem">
        <Column field="id" header="Player ID"></Column>
        <Column field="player" header="Name"></Column>
    </DataTable>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
const props = defineProps({ customRankings: Array });
// console.log("test page");
// console.log("props: ", props.customRankings);
</script>
