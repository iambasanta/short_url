<template>
    <div class="flex flex-wrap">
        <div class="w-full p-4">
            <button
                class="float-right px-1 py-2 bg-green-600 text-white rounded shadow w-28"
                @click="openModal"
            >
                New
            </button>
        </div>
        <div class="w-full flex">
            <left-bar
                @selectedTitle="showDetails"
                :items="items.data"
                :allItems="items"
            />
            <right-bar :data="selectedItem" @deleteItem="destroy" />
        </div>
        <div>
            <create-modal
                :show="modalOpen"
                @closeModal="modalOpen = false"
                :items="items.data"
            />
        </div>
        <!-- <div class="text-center mt-5 ">
            <h1 class="text-2xl">Shorten your long URL</h1>
            <form action="" @submit.prevent="submit">
                <div class="m-1">
                    <div class="flex-col">
                        <input
                            type="text"
                            name="url"
                            placeholder="Give a title for your shorten url"
                            id=""
                            class="p-2 border-rounded-md shadow-md w-64"
                            v-model="form.title"
                        />
                    </div>
                    <span v-if="errors.title" class="text-xs text-red-400">{{
                        errors.title[0]
                    }}</span>
                </div>
                <div class="m-1">
                    <div class="flex-col">
                        <input
                            type="text"
                            name="url"
                            placeholder="Paste your long url"
                            id=""
                            class="p-2 border-rounded-md shadow-md w-64"
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
                    class="fas fa-paper-plane fa-lg text-blue-400 cursor-pointer px-2"
                ></i>
            </form>
        </div>
        <section class="mt-5 text-center flex justify-center">
            <div class="border rounded-md p-4">
                <div v-if="items.data.length > 0">
                    <table class="">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Original URL</th>
                                <th>Shorten URL</th>
                                <th>Visits</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in items.data" :key="item.id">
                                <td class="p-2 border rounded text-smp">
                                    {{ item.title }}
                                </td>
                                <td class="p-2 border rounded text-smp">
                                    {{ item.original_url }}
                                </td>
                                <td class="p-2 border rounded text-smp">
                                    <span
                                        class="cursor-pointer"
                                        @click="copyToClipboard(item.path)"
                                        >{{ item.shorten_url }}</span
                                    >
                                    <a :href="item.path" target="_blank">
                                        <i
                                            class="fas fa-external-link-alt mx-2 "
                                        ></i>
                                    </a>
                                </td>
                                <td class="p-2 border rounded text-smp">
                                    {{ item.visits }}
                                </td>
                                <td class="p-2 border rounded text-smp">
                                    {{ item.created_at }}
                                </td>
                                <td class="p-2 border rounded text-smp">
                                    <i
                                        @click="destroy(item)"
                                        class="fas fa-times text-red-200 hover:text-red-400 cursor-pointer"
                                    ></i>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="flex justify-between mt-5">
                        <a
                            href=""
                            @click.prevent="prev"
                            class="border rounded shadow-xs w-10"
                            :class="items.current_page == 1 ? 'opacity-50' : ''"
                        >
                            <<
                        </a>
                        <a
                            href=""
                            @click.prevent="next"
                            class="border rounded shadow-xs w-10"
                            :class="
                                items.current_page == items.last_page
                                    ? 'opacity-50'
                                    : ''
                            "
                        >
                            >>
                        </a>
                    </div>
                </div>
                <div class="" v-else>
                    <h2>No Shorten URL to show .</h2>
                </div>
            </div>
        </section> -->
    </div>
</template>

<script>
import CreateModal from "../components/index/createModal.vue";
import leftBar from "../components/index/leftBar.vue";
import RightBar from "../components/index/rightBar.vue";
export default {
    components: {
        leftBar,
        RightBar,
        CreateModal
    },
    middleWare: "auth",
    data() {
        return {
            modalOpen: false,
            form: {
                title: "",
                original_url: ""
            },
            errors: {},
            selectedItem: null,
            items: { data: [] }
        };
    },
    mounted() {
        this.fetchData(this.$route.query.page);
        Event.$on("prevPage", this.prev);
        Event.$on("nextPage", this.next);
    },
    methods: {
        fetchData(page = 1) {
            axios
                .get(`/url?page=${page}`)
                .then(res => {
                    this.items = res.data;
                })
                .catch(e => {
                    this.errors = e.response.data;
                });
        },
        destroy(item) {
            if (confirm("Are you Sure ?")) {
                this.items.data = this.items.data.filter(i => i.id != item.id);
                axios.delete(`url/${item.shorten_url}`).then(() => {
                    this.$notify({ message: "Deleted !!!" });
                });
            }
        },

        showDetails(item) {
            this.selectedItem = item;
        },

        openModal() {
            this.modalOpen = true;
        },
        next() {
            let nextPageNumber = this.items.current_page + 1;
            if (this.items.current_page == this.items.last_page) return;
            this.fetchData(nextPageNumber);
            this.$router.replace({ query: { page: nextPageNumber } });
        },
        prev() {
            let prevPageNumber = this.items.current_page - 1;
            if (prevPageNumber == 0) return;
            this.fetchData(prevPageNumber);
            this.$router.replace({ query: { page: prevPageNumber } });
        }
    }
};
</script>

<style></style>
