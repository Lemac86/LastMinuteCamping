<script setup lang="ts">
import { Modal } from "custom-mbd-components";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import type { User, Rating, Campingground } from "@/types";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import { Head } from "@inertiajs/vue3";
import { toRefs } from "vue";
import { computed, ref } from "vue";
// @ts-expect-error
import VueResizable from "vue-resizable";
VueResizable;

const props = defineProps<{
    users: User[];
    ratings: Rating[];
    campinggrounds: Campingground[];
    usersWithRatings: any;
}>();

const { campinggrounds } = toRefs(props);

const filters = ref({
    WC: false,
    dusche: false,
    spielplatz: false,
    haustiere: false,
    barrierefrei: false,
    bademöglichkeit: false,
    kiosk: false,
    WLAN: false,
    strom: false,
    waschmaschine: false,
});
const minBewertung = ref("");
const maxPreis = ref("");
const gesuchtesAttribut = ref("");
let inputArray = campinggrounds;

const displayedArray = computed(() =>
    inputArray.value.filter(
        (e: Campingground) =>
            ((filters.value.WC && e.WC) || filters.value.WC == false) &&
            ((filters.value.dusche && e.dusche) ||
                filters.value.dusche == false) &&
            ((filters.value.spielplatz && e.spielplatz) ||
                filters.value.spielplatz == false) &&
            ((filters.value.haustiere && e.tiereErlaubt) ||
                filters.value.haustiere == false) &&
            ((filters.value.barrierefrei && e.barrierefrei) ||
                filters.value.barrierefrei == false) &&
            ((filters.value.bademöglichkeit && e.bademoeglichkeit) ||
                filters.value.bademöglichkeit == false) &&
            ((filters.value.kiosk && e.kiosk) ||
                filters.value.kiosk == false) &&
            ((filters.value.WLAN && e.WLAN) || filters.value.WLAN == false) &&
            ((filters.value.strom && e.strom) ||
                filters.value.strom == false) &&
            ((filters.value.waschmaschine && e.waschmaschine) ||
                filters.value.waschmaschine == false) &&
            (!minBewertung.value ||
                parseFloat(e.bewertung) > parseFloat(minBewertung.value)) &&
            (!maxPreis.value ||
                parseFloat(e.preis) < parseFloat(maxPreis.value)) &&
            (e.name
                .toLocaleLowerCase()
                .includes(gesuchtesAttribut.value.toLowerCase()) ||
                e.ort
                    .toLocaleLowerCase()
                    .includes(gesuchtesAttribut.value.toLowerCase()))
    )
);
</script>

<template>
    <Head title="Welcome" />
    <div class="body">
        <div class="profileDiv hidden sm:flex sm:items-center sm:ml-6">
            <div class="ml-3 relative">
                <Dropdown align="right" width="48">
                    <template #trigger>
                        <span class="inline-flex rounded-md">
                            <button
                                type="button"
                                class="profileButton inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                            >
                                {{ $page.props.auth.user.name }}

                                <svg
                                    class="ml-2 -mr-0.5 h-4 w-4"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </button>
                        </span>
                    </template>

                    <template #content>
                        <DropdownLink :href="route('profile.edit')">
                            Profile
                        </DropdownLink>
                        <DropdownLink
                            :href="route('logout')"
                            method="post"
                            as="button"
                        >
                            Log Out
                        </DropdownLink>
                    </template>
                </Dropdown>
            </div>
        </div>
        <h1>Last Minute Camping</h1>
        <div class="h1Addon">Tent Edition</div>
        <h2>Finde deinen Zeltplatz</h2>
        <div class="contentDiv row g-0">
            <div class="col-2">
                <div class="pe-5">
                    <div class="filterHeader text-white">Filteroptionen:</div>
                    <div class="extras">
                        <div
                            class="extrasButtonAlignment"
                            v-for="extra in Object.keys(filters)"
                        >
                            <input
                                type="checkbox"
                                :id="extra"
                                v-model="filters[extra as  keyof typeof filters]"
                            />
                            <label :for="extra" class="checkboxes ps-2">
                                {{
                                    extra.charAt(0).toUpperCase() +
                                    extra.slice(1)
                                }}</label
                            >
                        </div>
                        <label id="priceLabel">Preis bis </label><br /><input
                            type="search"
                            v-model="maxPreis"
                            name="Preis"
                            id="priceInput"
                        /><label> € </label><br /><br />
                        <div class="bewertung">
                            <label id="ratingLabel">Bewertung ab</label>
                            <form class="star-rating">
                                <template v-for="star in [5, 4, 3, 2, 1]">
                                    <input
                                        class="radio-input"
                                        type="radio"
                                        v-model="minBewertung"
                                        :id="'star' + star"
                                        name="star-input"
                                        :value="star"
                                    />
                                    <label
                                        class="radio-label"
                                        :for="'star' + star"
                                        :title="star + ' stars'"
                                        >{{ star + " stars" }}</label
                                    >
                                </template>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-10">
                <div class="search">
                    <div class="searchSymbol">
                        <i class="bi bi-search text-white"></i>
                    </div>
                    <input
                        type="text"
                        v-model="gesuchtesAttribut"
                        name=""
                        id=""
                        class="searchInput"
                        placeholder="Gib hier den gesuchten Campingplatz oder Ort ein..."
                    />
                </div>
                <div class="list">
                    <Modal v-for="element in displayedArray">
                        <div class="cardDiv py-1">
                            <img
                                :src="element.bildURL"
                                alt="bildLink"
                                style="height: 300px; object-fit: cover"
                            />
                            <div class="container">
                                <h5 class="pb-0 mb-0">
                                    <b>{{ element.name }}</b>
                                </h5>
                                <div>
                                    <div class="cardText">
                                        Bewertung: {{ element.bewertung }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <template #button>
                            <div class="cardDiv py-1">
                                <div class="container">
                                    <h5 class="mb-0 pb-0">
                                        <b>{{ element.ort }}</b>
                                    </h5>
                                    <div class="cardText">
                                        {{ element.plz }}, {{ element.straße }}
                                        {{ element.hausnummer }}
                                    </div>
                                </div>
                                <img
                                    :src="element.bildURL"
                                    alt="bildLink"
                                    style="height: 300px; object-fit: cover"
                                />
                                <div class="container">
                                    <h5 class="pb-0 mb-0">
                                        <b>{{ element.name }}</b>
                                    </h5>
                                    <div class="d-flex justify-content-between">
                                        <div class="cardText">
                                            Anzahl freier Platze:
                                            {{ element.anzahlFreierPlaetze }}
                                        </div>
                                        <div class="cardText">
                                            Telefonnummer:
                                            {{ element.telefonnummer }}
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <div class="cardText">
                                            Bewertung: {{ element.bewertung }}
                                        </div>
                                        <div class="cardText">
                                            Preis: {{ element.preis }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </Modal>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.profileDiv {
    position: absolute;
    right: 50px;
    top: 20px;
    z-index: 2;
}

.profileButton {
    background-color: rgba(131, 155, 23, 0.8) !important;
    color: white !important;
}

h1 {
    text-align: center;
    font-family: "camping-font1";
    font-size: 60px;
    font-weight: 900;
    padding-top: 5vh;
    position: relative;
    /* text-decoration: underline; */
}

.h1Addon {
    position: absolute;
    font-family: "camping-font";
    color: rgba(94, 116, 31, 0.9);
    text-shadow: 1px 0.5px rgba(131, 155, 23, 0.5);
    font-size: 30px;
    left: calc(100vw / 2 + 250px);
    top: 10%;
    transform: rotate(-15deg);
    text-decoration: underline;
}

h2 {
    text-align: center;
    padding-top: 8vh;
    font-family: "camping-font1";
    font-size: 35px;
    font-weight: 600;
    margin-bottom: 1vh;
    /* text-decoration: underline; */
}

.contentDiv {
    height: 70vh;
}

.filterHeader {
    display: flex;
    padding-left: 20px;
    border-radius: 0 10px 0 0;
    font-family: "camping-font1";
    font-weight: 600;
    align-items: center;
    /* width: 10vw; */
    height: 2.5rem;
    background-color: rgba(131, 155, 23, 0.8);
}
.search {
    display: flex;
    justify-content: center;
    width: 75vw;
    height: 2.5rem;
}
.searchSymbol {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 5vw;
    text-align: center;
    border-radius: 10px 0 0 0;
    background-color: rgba(131, 155, 23, 0.8);
}
.searchInput {
    width: 70vw;
    font-family: "camping-font1";
    font-size: 1rem;
    border-radius: 0 10px 0 0;
    border: none;
    padding-left: 25px;
    background-color: rgba(131, 155, 23, 0.4);
}
.searchInput:focus {
    outline: none;
}

.list {
    /* margin: 0 auto; */
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    background-color: rgba(202, 205, 245, 0.5);
    width: 75vw;
    height: calc(70vh - 2.5rem);
    border-radius: 0 0 10px 10px;
    backdrop-filter: blur(10px);
    overflow-y: scroll;
    scrollbar-width: none;
}
/* card START */
.cardDiv {
    font-family: Arial, Helvetica, sans-serif;
    box-shadow: 6px 8px 16px 0 rgba(0, 0, 0, 0.3);
    background-color: rgba(255, 255, 255, 0.6);
    transition: 0.3s;
    margin: 10px;
    border-radius: 5px;
}
.cardText {
    font-size: 13px;
    color: rgba(0, 0, 0, 0.7);
}
.container {
    padding: 10px;
}
img {
    border-radius: 5px 5px 0 0;
}
/* card END */
.extras {
    padding-top: 15px;
    padding-bottom: 15px;
    font-size: 17px;
    font-weight: 800;
    font-family: "camping-font1";

    padding-left: 10px;
    backdrop-filter: blur(10px);
    background-color: rgba(202, 205, 245, 0.4);
    border-radius: 0 0 10px 0;
    height: calc(70vh - 2.5rem);
}
.extrasButtonAlignment {
    display: flex;
    align-items: center;
    margin-bottom: 16px;
}
.checkboxes {
    margin: 0;
    padding: 0;
    /* margin-bottom: 5px; */
}
label:hover {
    cursor: pointer;
}
#ratingLabel {
    padding-left: 5px;
}
#priceLabel {
    padding-left: 5px;
}
#priceInput {
    font-family: Arial, Helvetica, sans-serif;
    border-radius: 10px;
    padding-left: 10px;
    margin-right: 3px;
    border: none;
    width: 85%;
    box-shadow: inset 0 0 0 1px rgb(131, 155, 23);
    background-color: rgba(131, 155, 23, 0.4);
}
/* checkbox Layout START */
[type="checkbox"] {
    width: 1rem;
    height: 1rem;
    color: rgba(131, 155, 23, 0.75);
    vertical-align: middle;
    -webkit-appearance: none;
    background: none;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.9);
    /* transition: background 300ms; */
    cursor: pointer;
}
[type="checkbox"]::before {
    content: "";
    color: transparent;
    display: block;
    width: inherit;
    height: inherit;
    border-radius: inherit;
    border: 0;
    background-color: transparent;
    background-size: contain;
    box-shadow: inset 0 0 0 1px #ccd3d8;
}
[type="checkbox"]:checked {
    background-color: currentcolor;
}
[type="checkbox"]:checked::before {
    box-shadow: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E %3Cpath d='M15.88 8.29L10 14.17l-1.88-1.88a.996.996 0 1 0-1.41 1.41l2.59 2.59c.39.39 1.02.39 1.41 0L17.3 9.7a.996.996 0 0 0 0-1.41c-.39-.39-1.03-.39-1.42 0z' fill='%23fff'/%3E %3C/svg%3E");
}
/* checkbox Layout END */
/* Bewertung START*/
.bewertung {
    display: flex;
    flex-direction: column;
}
.star-rating {
    padding-top: 0;
    margin-top: 0;
    display: flex;
    flex-direction: row-reverse;
    justify-content: flex-end;
}
.radio-input {
    position: fixed;
    opacity: 0;
    pointer-events: none;
}

.radio-label {
    cursor: pointer;
    font-size: 0;
    color: rgba(0, 0, 0, 0.1);
    transition: color 0.1s ease-in-out;
}

.radio-label:before {
    content: "★";
    display: inline-block;
    font-size: 32px;
}
.radio-input:checked ~ .radio-label {
    color: rgb(94, 116, 31);
}

.radio-label:hover,
.radio-label:hover ~ .radio-label {
    color: rgba(131, 155, 23, 0.5);
}

.radio-input:checked + .radio-label:hover,
.radio-input:checked + .radio-label:hover ~ .radio-label,
.radio-input:checked ~ .radio-label:hover,
.radio-input:checked ~ .radio-label:hover ~ .radio-label,
.radio-label:hover ~ .radio-input:checked ~ .radio-label {
    color: rgba(131, 155, 23, 0.75);
}
/* Bewertung END */
</style>
