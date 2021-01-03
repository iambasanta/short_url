<template>
    <div>
        <div class="p-3 flex justify-center">
            <div class=" py-10 flex flex-wrap justify-center border rounded">
                <h2 class="text-3xl text-center w-full ">
                    Reset Your Password
                </h2>
                <form action="" class="p-2" @submit.prevent="submit">
                    <div class="py-2 w-full">
                        <input
                            type="text"
                            v-model="form.email"
                            placeholder="Enter your email."
                            class="p-2 w-full border rounded shadow focus:outline-none focus:ring focus:border-blue-300 "
                        />
                    </div>
                    <div class="py-2 w-full">
                        <input
                            type="password"
                            v-model="form.password"
                            placeholder="*****"
                            class="p-2 w-full border rounded shadow focus:outline-none focus:ring focus:border-blue-300 "
                        />
                    </div>
                    <div class="py-2 w-full">
                        <input
                            type="password"
                            v-model="form.password_confirmation"
                            placeholder="Confirm Your Password"
                            class="p-2 w-full border rounded shadow focus:outline-none focus:ring focus:border-blue-300 "
                        />
                    </div>
                    <div class="py-2 w-full">
                        <input
                            type="submit"
                            value="Reset Password"
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
                token: "",
                password: "",
                password_confirmation: ""
            }
        };
    },
    mounted() {
        this.form.email = this.$route.query.email;
        this.form.token = this.$route.params.token;
    },

    methods: {
        submit() {
            axios.post("/password/reset", this.form).then(res => {
                window.location = "/";
            });
        }
    }
};
</script>

<style></style>
