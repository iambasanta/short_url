<template>
    <div>
        <div class="p-3 flex justify-center">
            <div class=" py-10 flex flex-wrap justify-center border rounded">
                <h2 class="text-3xl text-center w-full ">Login Page</h2>
                <form action="" class="p-2" @submit.prevent="submit">
                    <div class="py-2 w-full">
                        <input
                            type="text"
                            v-model="form.email"
                            placeholder="Enter your email."
                            class="p-2 w-full border rounded shadow focus:outline-none focus:ring focus:border-blue-300  "
                        />
                        <span
                            v-if="errors.email"
                            class="text-xs text-red-400"
                            >{{ errors.email[0] }}</span
                        >
                    </div>

                    <div class="py-2 w-full">
                        <input
                            type="password"
                            v-model="form.password"
                            placeholder="*****"
                            class="p-2 w-full border rounded shadow focus:outline-none focus:ring focus:border-blue-300 "
                        />
                        <span
                            v-if="errors.password"
                            class="text-xs text-red-400"
                            >{{ errors.password[0] }}</span
                        >
                    </div>
                    <div class="w-full">
                        <router-link
                            to="/forgot-password"
                            class="float-right my-1"
                        >
                            forgot password
                        </router-link>
                    </div>
                    <div class="py-2 w-full">
                        <input
                            type="submit"
                            value="Login"
                            class=" px-2 py-2 text-white border rounded bg-blue-400 w-full focus:outline-none focus:ring focus:border-blue-300 "
                        />
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    middleware: "guest",
    data() {
        return {
            form: {
                email: "",
                password: ""
            },
            errors: {}
        };
    },
    methods: {
        submit() {
            axios
                .post("/login", this.form)
                .then(res => {
                    window.location = "/";
                })
                .catch(e => {
                    this.errors = e.response.data.errors;
                });
        }
    }
};
</script>

<style></style>
