<template>
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="mt-6 text-center text-3xl leading-9 font-extrabold text-white">
            Register For Vaccine
        </h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">

        <div class="bg-green-200 rounded-md py-2 text-center mb-2" v-if="isFormValid && user">
            <h4>{{ user }}</h4>
        </div>

        <div class="text-white bg-red-800 rounded-md text-center mb-2 py-2" v-if="!isFormValid">
            <ul>
                <li v-for="(value, key) in formDataError" :key="key">{{ value }}</li>
            </ul>

        </div>
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <form @submit.prevent="onFormSubmit">
                <div>
                    <label for="email" class="block text-sm font-medium leading-5  text-gray-700">Name</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input id="name" name="name" placeholder="John Doe" type="text" required=""
                               v-model="formData.name"
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                        <div class="hidden absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                      clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <label for="email" class="block text-sm font-medium leading-5 text-gray-700">
                        Email address
                    </label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input id="email" name="email" placeholder="user@example.com" type="email"
                               required=""
                               v-model="formData.email"
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                        <div class="hidden absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                      clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <label for="email" class="block text-sm font-medium leading-5 text-gray-700">
                        Password
                    </label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input id="password" name="password" placeholder="enter password" type="password"
                               required=""
                               v-model="formData.password"
                               autocomplete=""
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                        <div class="hidden absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                      clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <label for="email" class="block text-sm font-medium leading-5 text-gray-700">
                        Confirm Password
                    </label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input id="password_confirmation" name="password_confirmation" placeholder="confirm password" type="password"
                               required=""
                               autocomplete=""
                               v-model="formData.password_confirmation"
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                        <div class="hidden absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                      clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <label for="email" class="block text-sm font-medium leading-5 text-gray-700">
                        Vaccine Center
                    </label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <select
                            v-model="formData.vaccine_center"
                            class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease
                            focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer"
                            required=""
                        >
                            <option value="">Select Vaccine Center</option>
                            <template v-if="vaccineCenters.length">
                                <option v-for="vaccineCenter in vaccineCenters" :value="vaccineCenter.id">
                                    {{ vaccineCenter.name }}
                                </option>
                            </template>
                        </select>
                        <div class="hidden absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                      clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <label for="nid" class="block text-sm font-medium leading-5 text-gray-700">
                        NID
                    </label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input id="nid" name="nid" placeholder="enter nid"
                               required=""
                               v-model="formData.nid"
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                        <div class="hidden absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                      clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <span class="block w-full rounded-md shadow-sm">
                        <button type="submit"
                                class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                            Register
                        </button>
                    </span>
                </div>
            </form>

        </div>
    </div>
</template>

<script setup>
import {computed, onMounted, reactive, ref} from 'vue'
import {GET_VACCINE_CENTERS_URL, GET_USER_REGISTRATION_URL, GET_USER_STATUS_SEARCH_URL} from "../apiEndpoints.js";

const vaccineCenters = ref([]);
const formData = ref({
    vaccine_center: '',
    name: '',
    email: '',
    nid: '',
    password: '',
    password_confirmation: '',
});

const formDataError = reactive({});
const user = ref(null);

onMounted(async () => {
    await getVaccineCenters();
})

const isFormValid = computed(() => {
    return !Object.keys(formDataError).length;
})

const getVaccineCenters = async () => {
    axios.get(GET_VACCINE_CENTERS_URL).then((response) => {
        vaccineCenters.value = response.data?.vaccine_centers ?? [];
    });
}

const onFormSubmit = () => {
    user.value = null;
    if (!validateForm()) {
        return
    }

    axios.post(GET_USER_REGISTRATION_URL, formData.value).then((response) => {
        user.value = response.data.data;
    }).catch((err) => {
        console.log(err)
    });
}

const validateForm = () => {
    resetError();

    if (!formData.value.name.trim().length) {
        formDataError.name = 'Name must not be empty.'
    }

    if (!formData.value.email.trim().length) {
        formDataError.email = 'Email must not be empty.'
    }

    if (!formData.value.password.trim().length) {
        formDataError.password = 'Password must not be empty.'
    } else if (formData.value.password.trim().length < 6){
        formDataError.password = 'Password must be grater than 6 digit.'
    }

    if (!formData.value.password_confirmation.trim().length) {
        formDataError.password_confirmation = 'Password must not be empty.'
    } else if (formData.value.password_confirmation.trim().length < 6){
        formDataError.password_confirmation = 'Password must be grater than 6 digit.'
    } else if (formData.value.password.trim() !== formData.value.password_confirmation.trim()) {
        formDataError.password_confirmation = 'Password does not match.'
    }

    if (!formData.value.nid.trim().length) {
        formDataError.nid = 'Nid must not be empty.'
    }

    if (formData.value.nid.trim().length !== 10) {
        formDataError.nid = 'Nid must be 10 character.'
    }

    if (!formData.value.vaccine_center) {
        formDataError.vaccineCenter = 'Vaccine center must not empty.'
    }

    return isFormValid.value;
}

const resetError = () => {
    for (const key in formDataError) {
        delete formDataError[key];  // Use delete to remove each property
    }
}
</script>

<style scoped>

</style>
