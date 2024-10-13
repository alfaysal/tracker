<template>
    <div>
        <form class="max-w-md mx-auto" @submit.prevent="serachByNId">
            <label for="default-search"
                   class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="text-white bg-red-800 rounded-md text-center mb-2 py-2" v-if="failedReason">
                <h4>{{ searchValidationMessages[failedReason] }}</h4>
            </div>

            <div class="bg-green-200 rounded-md py-2 text-center mb-2" v-if="user && !failedReason">
                <h4> User: <span class="text-xl">{{ user.name || 'N/A' }}</span></h4>
                <h4>Vaccination status: <span class="text-xl">{{ user.vaccinated_status }}</span></h4>
            </div>

            <div class="relative">
                <input
                    v-model="nid"
                    type="search"
                    class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Search by nid"
                    required
                />
                <button type="submit"
                        class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">
                    Search
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
import {GET_USER_STATUS_SEARCH_URL} from "../apiEndpoints.js";
import {ref} from "vue";
const nid = ref('');
const user = ref(null);
const nidIsEmpty = ref(false);
const failedReason = ref(null);
const searchValidationMessages = ref({
    empty: "Nid can not empty!!!",
    length: "length must be 10 chars",
    notFound: "User not found"
});
const serachByNId = () => {
    nidIsEmpty.value = false;
    user.value = null;
    failedReason.value = null;

    let trimedNid = nid.value.trim();

    if (!trimedNid.length) {
        failedReason.value = 'empty';
        nidIsEmpty.value = true;
        return;
    }

    if (trimedNid.length !== 10) {
        failedReason.value = 'length';
        return;
    }


    axios.post(GET_USER_STATUS_SEARCH_URL, {nid: nid.value}).then((response) => {
        console.log(response)
        user.value = response.data.data;
    }).catch((err)=>{
        failedReason.value = 'notFound';
    });
}
</script>


<style scoped>

</style>
