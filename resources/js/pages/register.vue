<template>
    <div>
        <div class="p-3 flex justify-center">
            <div class=" py-10 flex flex-wrap justify-center border rounded">
                <h2 class="text-3xl text-center w-full ">Register Page</h2>
                <form action="" class="p-2" @submit.prevent="submit">
                    <div class="py-2 w-full">
                        <input
                            type="name"
                            v-model="form.name"
                            placeholder="Enter your name."
                            class="p-2 w-full border rounded shadow focus:outline-none focus:ring focus:border-blue-300 "
                        />
                        <span v-if="errors.name" class="text-xs text-red-400">{{
                            errors.name[0]
                        }}</span>
                    </div>
                    <div class="py-2 w-full">
                        <input
                            type="email"
                            v-model="form.email"
                            placeholder="Enter your email."
                            class="p-2 w-full border rounded shadow focus:outline-none focus:ring focus:border-blue-300 "
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
                    <div class="py-2 w-full">
                        <input
                            type="password"
                            v-model="form.password_confirmation"
                            placeholder="Confirm your password"
                            class="p-2 w-full border rounded shadow focus:outline-none focus:ring focus:border-blue-300 "
                        />
                    </div>
                    <div class="py-2 w-full">
                        <input
                            type="submit"
                            value="Register"
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
                name: "",
                email: "",
                password: "",
                password_confirmation: ""
            },
            errors: {}
        };
    },
    methods: {
        submit() {
            axios
                .post("/register", this.form)
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
