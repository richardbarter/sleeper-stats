<!-- Temporary landing page. To be worke on further -->

<template>
    <Head title="Welcome" />
    <div class="flex flex-col justify-center items-center space-x-2 gap-y-5">
        <h2>Sleeper Stats</h2>
        <form @submit.prevent="submitForm">
            <InputLabel for="leagueId" value="Enter League ID" />
            <TextInput
                id="leagueId"
                type="text"
                v-model="form.leagueId"
                required
                autofocus
            />

            <InputError class="mt-2" :message="form.errors.leagueId" />

            <Button
                @click="submitForm"
                class="ms-4"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Submit
            </Button>
        </form>

        <!-- <h2>test input</h2> -->
        <!-- <InputText type="text" v-model="value" /> -->
    </div>
</template>

<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Button from "primevue/button";
import TextInput from "@/Components/TextInput.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputText from "primevue/inputtext";
import { Head, Link, router, useForm } from "@inertiajs/vue3";

defineOptions({
    layout: GuestLayout,
});

const form = useForm({
    leagueId: "",
});

function submitForm() {
    console.log("in submit form");
    if (leagueId.value) {
        //router.get(route("leagues.show"), { league: leagueId.value });
        router.get(route("leagues.show", { league: leagueId.value }));
    } else {
        alert("Please enter a valid League ID.");
    }
}

// function submit() {
//     if (form.leagueId) {
//         form.post(`/leagues/${form.leagueId}`);
//     } else {
//         alert("Please enter a valid League ID.");
//     }
// }

// const submit = () => {
//     if(form.leagueId){
//         form.post(route(``))
//     }else{
//         alert('Please enter a valid League ID');
//     }

// }
</script>

<!-- <template>
    <div class="flex justify-center items-center mt-5 space-x-2">
        <input
            v-model="leagueId"
            type="text"
            placeholder="Enter League ID"
            class="input border rounded px-4 py-2"
            @keyup.enter="goToLeague"
        />
        <button
            @click="goToLeague"
            class="btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
        >
            Go to League
        </button>
    </div>
</template>

<script setup>
import { ref } from "vue";


const leagueId = ref("");
const { visit } = useIn();

function goToLeague() {
    if (leagueId.value) {
        visit(`/leagues/${leagueId.value}`);
    } else {
        alert("Please enter a valid League ID.");
    }
}
</script> -->
