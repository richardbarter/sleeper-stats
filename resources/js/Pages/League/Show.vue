<template>
    <Head title="League" />
    <!-- should make this div flex? -->
    <div>
        <!-- //refactor to a component for h2s? -->
        <!-- <h3 class="dark:text-white">{{ league.name }}</h3> -->
        <Heading class="mb-3">{{ league.name }}</Heading>
        <div class="flex gap-x-5">
            <Card class="">
                <template #title><Heading>Rankings</Heading></template>
                <template #content>
                    <DataTable :value="powerRankings" size="small">
                        <!-- <Column field="teamName" header="Team Name"></Column> -->
                        <Column header="Team Name">
                            <template #body="slotProps">
                                <div class="flex gap-3">
                                    {{ slotProps.data.rank }}
                                    <img
                                        :src="`https://sleepercdn.com/avatars/thumbs/${slotProps.data.avatar}`"
                                        :alt="slotProps.data.teamName"
                                        class="w-5 rounded-full"
                                    />
                                    {{ slotProps.data.teamName }}
                                </div>
                            </template>
                        </Column>
                        <Column field="wlt" header="W-L-T"></Column>
                        <Column field="pts_for" header="Points For"></Column>
                        <Column
                            field="pts_against"
                            header="Points Against"
                        ></Column>
                    </DataTable>
                    <!-- <ul>
                        <li v-for="ranking in powerRankings">
                            {{ ranking.teamName }}
                        </li>
                    </ul> -->
                </template>
            </Card>
            <!-- <Card class="w-64">
                <template #title>Simple Card</template>
                <template #content>
                    <p class="m-0">
                        Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Inventore sed consequuntur error repudiandae
                        numquam deserunt quisquam repellat libero asperiores
                        earum nam nobis, culpa ratione quam perferendis esse,
                        cupiditate neque quas! am deserunt quisquam repellat
                        libero asperiores earum nam nobis, culpa ratione quam
                        perferendis esse, cupiditate neque quas!
                    </p>
                </template>
            </Card>
            <Card class="w-64">
                <template #title>Simple Card</template>
                <template #content>
                    <p class="m-0">some other amount</p>
                </template>
            </Card>
            <Card />
            <Card /> -->
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { Head } from "@inertiajs/vue3";
import Heading from "@/Components/General/Heading.vue";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import Card from "primevue/card";

//this page will have the rankings for this league year. when it is given a league id - the id is specific to that year. So for example
//LeagueA 2023 league ID will be diffeerent from LeagueA 2022 season league ID.
//it will have

//the inertia route extracts and passes the data as props.
//so we expect a league as an object.
const props = defineProps({
    league: {
        type: Object,
    },
    powerRankings: {
        type: Object,
    },
});

console.log("power rankings are", props.powerRankings);

//card will actually be refactored to a 'roster' or 'team' component.
//need to retrieve the roster data from the backend.
</script>

<style scoped></style>

<!-- // const selectedCity = ref();
// const cities = ref([
//     { name: "New York", code: "NY" },
//     { name: "Rome", code: "RM" },
//     { name: "London", code: "LDN" },
//     { name: "Istanbul", code: "IST" },
//     { name: "Paris", code: "PRS" },
// ]);

// const value = ref("Off");
// const options = ref(["Off", "On"]); -->

<!-- <Panel
    header="Header"
    :pt="{
        title: { class: 'text-primary-500' },
        content: {
            class: '!bg-gradient-to-r !from-primary-500/20 !via-primary-500/10 !to-surface-500/20',
        },
    }"
    :ptOptions="{
        mergeProps: true,
    }"
>
    <p class="m-0">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
        do eiusmod tempor incididunt ut labore et dolore magna
        aliqua. Ut enim ad minim veniam, quis nostrud exercitation
        ullamco laboris nisi ut aliquip ex ea commodo consequat.
        Duis aute irure dolor in reprehenderit in voluptate velit
        esse cillum dolore eu fugiat nulla pariatur. Excepteur sint
        occaecat cupidatat non proident, sunt in culpa qui officia
        deserunt mollit anim id est laborum.
    </p>
</Panel> -->

<!-- <div class="flex flex-col gap-y-5">
        <div class="card flex justify-center">
            <div>
                <Dropdown
                    v-model="selectedCity"
                    :options="cities"
                    optionLabel="name"
                    placeholder="Select a City"
                    class="w-full md:w-[14rem]"
                />
            </div>
            <div>
                <InputText class="ml-5 mr-5" />
            </div>
        </div>
        <div class="card flex justify-center">
            <SelectButton
                v-model="value"
                :options="options"
                aria-labelledby="basic"
                :pt="{
                    button: { class: '' },
                    label: { class: 'text-primary-500' },
                }"
                :ptOptions="{
                    mergeSections: true,
                    mergeProps: true,
                }"
            />
            <SelectButton v-model="value" :options="options" />
        </div>
        <div class="card flex justify-center">
            
        </div>
    </div> -->
