<script setup lang="ts">
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import type { User, Rating, Campingground } from "@/types";
import { Head } from "@inertiajs/vue3";

const props = defineProps<{
    users: User[];
    ratings: Rating[];
    campinggrounds: Campingground[];
    usersWithRatings: any;
}>();
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        {{ users[0].name }}
                        <br />
                        {{ ratings[0].bewertung }}
                        <br />
                        {{ campinggrounds[0].name }}
                    </div>
                </div>
            </div>
            {{ usersWithRatings[0] }}
        </div>
    </AuthenticatedLayout>
</template>
