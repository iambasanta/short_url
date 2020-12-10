<template>
    <section class="m-1 p-2 w-9/12 border rounded">
        <div v-if="data">
            <div class="flex justify-between">
                <h1>{{ data.title }}</h1>
                <i
                    class="fas fa-trash text-red-300 hover:text-red-600 cursor-pointer"
                    @click="destroy"
                ></i>
            </div>
            <p class="text-xs text-gray-400">
                {{ data.original_url }}
            </p>
            <div class="flex my-5">
                <p class="text-xs text-yellow-500">
                    {{ data.shorten_url }}
                </p>
                <i
                    class="fas fa-copy text-xs text-yellow-500 mx-2 cursor-pointer"
                    @click="copyToClipboard(data.path)"
                ></i>
            </div>
            <div class="my-5">
                <p class="text-sm text-gray-600">Visits: {{ data.visits }}</p>
            </div>
        </div>
        <div class="text-center text-gray-400" v-else>
            <h2>Select Title to show details</h2>
        </div>
    </section>
</template>

<script>
export default {
    name: "right-bar",
    props: ["data"],
    methods: {
        copyToClipboard(url) {
            navigator.clipboard.writeText(url);
        },
        destroy() {
            this.$emit("deleteItem", this.data);
        }
    }
};
</script>

<style></style>
