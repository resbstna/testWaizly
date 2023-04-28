<script>
import axios from 'axios';

export default {
    name: 'Login',
    data() {
        return {
            form: {
                email: '',
                password: ''
            },
            success: false,
            allerros: []
        }
    },
    mounted() {
        if (localStorage.getItem('loggedIn')) {
            return this.$router.push({ name: 'tasktodo' })
        }
    },
    methods: {

        // submit login
        login() {
            axios.post('/login', this.form).then(response => {
                //simpan token di localstorage
                localStorage.setItem('token', response.data.access_token);
                //simpan data user di local storage
                // localStorage.setItem('dataUser', response.data.user);
                localStorage.setItem('loggedIn', "true");
                //push ke users
                return this.$router.go('/users')
            }).catch((err) => {
                // jika ada validasi error
                this.success = false
                this.allerros = err.response.data.data;


            })
        },
    }
};
</script>

<template>
    <div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto md:h-screen pt:mt-0 dark:bg-gray-900">
        <div class="w-full max-w-xl p-6 space-y-8 sm:p-8 bg-white rounded-lg shadow dark:bg-gray-800">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                Sign in to platform
            </h2>
            <form class="mt-8 space-y-6" @submit.prevent="login">
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                        email</label>
                    <input type="email" name="email" v-model="form.email" id="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="name@company.com">
                    <!-- check error validasi -->
                    <span v-if="allerros.email" :class="['mt-2 text-sm text-red-600 dark:text-red-500']">{{
                        allerros.email[0] }}</span>
                </div>
                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                        password</label>
                    <input type="password" name="password" v-model="form.password" id="password" placeholder="••••••••"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    <!-- check error validasi -->
                    <span v-if="allerros.password" :class="['mt-2 text-sm text-red-600 dark:text-red-500']">{{
                        allerros.password[0] }}</span>
                </div>
                <button type="submit"
                    class="w-full px-5 py-3 text-base font-medium text-center text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Login
                    to your account</button>
            </form>
        </div>
    </div>
</template>