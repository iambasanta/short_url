<template>
    <section class="m-1 p-2 w-3/12 border rounded">
        <pagination :items="allItems" />
        <transition-group name="list" tag="p">
            <div v-for="item in items" :key="item.id" class="border-b py-3">
                <h2
                    class="font-semibold text-yellow-600 cursor-pointer"
                    @click="showDetails(item)"
                >
                    {{ item.title }}
                </h2>

                <div class="flex justify-between">
                    <div class="flex text-sm text-grey-700">
                        <p
                            class=" opacity-70 cursor-pointer "
                            @click="copyToClipboard(item.path)"
                        >
                            {{ item.shorten_url }}
                        </p>
                        <a :href="item.path" target="_blank">
                            <i class="fas fa-external-link-alt mx-2 "></i>
                        </a>
                    </div>
                    <div class="text-xs">
                        {{ item.created_at }}
                    </div>
                </div>
            </div>
        </transition-group>
    </section>
</template>

<script>
import pagination from "./pagination.vue";
export default {
    components: { pagination },
    name: "left-bar",
    props: ["items", "allItems"],
    methods: {
        showDetails(item) {
            this.$emit("selectedTitle", item);
        }
    }
};
</script>

<style>
.list-item {
    display: inline-block;
    margin-right: 10px;
}
.list-enter-active,
.list-leave-active {
    transition: all 1s;
}
.list-enter, .list-leave-to /* .list-leave-active below version 2.1.8 */ {
    opacity: 0;
    transform: translateX(-30px);
}
</style>
