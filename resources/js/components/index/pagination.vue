<template>
    <div class="flex justify-between mt-5">
        <a
            href=""
            @click.prevent="prev"
            class=" w-10"
            :class="items.current_page == 1 ? 'opacity-50' : ''"
        >
            <i class="text-gray-600 fas fa-angle-left"></i>
        </a>
        <a
            href=""
            @click.prevent="next"
            class=" w-10"
            :class="items.current_page == items.last_page ? 'opacity-50' : ''"
        >
            <i class="text-gray-600 fas fa-angle-right"></i>
        </a>
    </div>
</template>

<script>
export default {
    name: "pagination",
    props: ["items"],
    methods: {
        next() {
            Event.$emit("nextPage");
        },
        prev() {
            Event.$emit("prevPage");
        }
    }
};
</script>

<style></style>
