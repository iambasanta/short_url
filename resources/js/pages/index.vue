<template>
  <div>
      <div class="text-center mt-5 ">
        <h1 class="text-2xl">Shorten your long URL</h1>
        <form action="" @submit.prevent="submit">
            <input type="text" name="url" placeholder="Paste your long url" id="" class="p-2 border-rounded-md shadow-md w-64" v-model="original_url">
            <i @click="submit" class="fas fa-paper-plane fa-lg text-blue-400 cursor-pointer px-2" ></i>
        </form>
        <span v-if="errors.original_url" class="text-xs text-red-400">{{errors.original_url[0]}}</span>
      </div>
        <section class="mt-5 text-center flex justify-center">
            <div class="border rounded-md p-4">
                <table class="">
                    <thead>
                        <tr>
                            <th>Original URL</th>
                            <th>Shorten URL</th>
                            <th>Visits</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in items" :key="item.id">
                            <td class="p-2 border rounded text-smp">
                                {{item.original_url}}
                            </td>
                            <td class="p-2 border rounded text-smp">
                                <a :href="item.path" target="_blank">
                                    {{item.shorten_url}} 
                                    <i class="fas fa-external-link-alt mx-2"></i>
                                </a>
                            </td>
                            <td class="p-2 border rounded text-smp">
                                {{item.visits}}
                            </td>
                            <td class="p-2 border rounded text-smp">
                                {{item.created_at}}
                            </td>
                            <td class="p-2 border rounded text-smp">
                                <i @click="destroy(item)" class="fas fa-times text-red-200 hover:text-red-400 cursor-pointer"></i>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
  </div>
</template>

<script>
export default {
    data(){
        return {
            original_url:"",
            errors: {},
            items:[]
        }
    },
    mounted(){
        this.fetchData();
    },
    methods : {
        submit(){
            if(this.original_url == '') return;
            axios
            .post('/api/url',{original_url: this.original_url})
            .then(res=>{
                this.original_url = '';
                this.item.unshift(res.data);
                this.$alert("Created Successfully!");
            })
            .catch((e)=>{
                this.errors = e.response.data.errors;
            });
        },
        fetchData(){
            axios
            .get('/api/url').then(res=>{
                this.items = res.data;
            })
            .catch(e=>{
                this.errors = e.response.data;
            });
        },
        destroy(item){
            if(confirm('Are you Sure ?')){
                axios
                .delete(`api/url/${item.shorten_url}`).then(() =>{
                    this.items = this.items.filter(i => i.id != item.id);
                    this.$alert("Deleted !!!");

                });

            }
        }
    }
}
</script>

<style>

</style>