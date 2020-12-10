<template>
    <div class="right-0 left-0 fixed flex justify-center ">
        <div
            class="absolute border rounded p-1 bg-gray-50 shadow-xl"
            v-if="show"
        >
            <div class="bg-blue-400 w-full  p-2 flex justify-between">
                <h1 class="text-center text-white font-bold">
                    Shorten your long URL
                </h1>
                <i
                    class="text-white fas fa-times m-1 cursor-pointer"
                    @click="close"
                ></i>
            </div>
            <div class=" w-full h-full p-4">
                <form @submit.prevent="submit" class="p-4">
                    <div class="m-1">
                        <div class="flex-col">
                            <input
                                type="text"
                                name="url"
                                placeholder="Give a title for your shorten url"
                                id=""
                                class="p-2 border-rounded-md shadow-md w-64 "
                                v-model="form.title"
                            />
                        </div>
                        <span
                            v-if="errors.title"
                            class="text-xs text-red-400"
                            >{{ errors.title[0] }}</span
                        >
                    </div>
                    <div class="m-1">
                        <div class="flex-col">
                            <input
                                type="text"
                                name="url"
                                placeholder="Paste your long url"
                                id=""
                                class="p-2 border-rounded-md shadow-md w-64 mt-2 "
                                v-model="form.original_url"
                            />
                        </div>
                        <span
                            v-if="errors.original_url"
                            class="text-xs text-red-400"
                            >{{ errors.original_url[0] }}</span
                        >
                    </div>
                    <i
                        @click="submit"
                        class="fas fa-paper-plane fa-lg text-blue-400 cursor-pointer px-2 float-right mt-2"
                    ></i>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["show", "items"],
    name: "create-modal",
    data() {
        return {
            form: {
                title: "",
                original_url: ""
            },
            errors: {}
        };
    },
    methods: {
        submit() {
            axios
                .post("/url", this.form)
                .then(res => {
                    (this.form.title = ""), (this.form.original_url = "");
                    this.close();
                    this.items.unshift(res.data);
                    this.$notify({ message: "Created Successfully!" });
                })
                .catch(e => {
                    this.errors = e.response.data.errors;
                });
        },
        close() {
            this.$emit("closeModal");
            this.errors = {};
        }
    }
};
</script>

<style></style>
