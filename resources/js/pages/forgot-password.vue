<template>
    <div class="p-3 flex justify-center">
        <div class=" py-10 flex flex-wrap justify-center border rounded">
            <h2 class="text-3xl text-center w-full ">Reset password</h2>
            <form action="" class="p-2" @submit.prevent="submit">
                <div class="py-2 w-full">
                    <input
                        type="text"
                        v-model="form.email"
                        placeholder="Enter your email."
                        class="p-2 w-full border rounded shadow focus:outline-none focus:ring focus:border-blue-300 "
                    />
                </div>
                <span v-if="errors.email" class="text-xs text-red-400">{{
                    errors.email[0]
                }}</span>

                <div class="py-2 w-full">
                    <input
                        type="submit"
                        value="Send"
                        class=" px-2 py-2 text-white border rounded bg-blue-400 w-full focus:outline-none focus:ring focus:border-blue-300 "
                    />
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data: function() {
        return {
            form: { email: "" },
            errors: {}
        };
    },
    methods: {
        submit() {
            axios
                .post("/password/reset-link-email", this.form)
                .then(res => {
                    this.$notify({ message: res.data.message });
                })
                .catch(e => {
                    this.errors = e.response.data.errors;
                });
        }
    }
};
</script>

<style></style>
