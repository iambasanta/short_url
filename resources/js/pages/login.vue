<template>
  <div>
      <div class="p-3 flex justify-center">
        <div class=" py-10 flex flex-wrap justify-center border rounded">
          <h2 class="text-3xl text-center w-full ">Login Page</h2>
          <form action="" class="p-2" @submit.prevent="submit">
            <div class="py-2 w-full">
              <input type="text" v-model="form.email" placeholder="Enter your email." class="p-2 w-full border rounded shadow">
            </div>
            <div class="py-2 w-full">
              <input type="password" v-model="form.password" placeholder="*****" class="p-2 w-full border rounded shadow">
            </div>
            <div class="py-2 w-full">
              <input type="submit" value="Login" class=" px-2 py-2 text-white border rounded bg-blue-400 w-full">
            </div>
          </form>
        </div>
      </div>
  </div>
</template>

<script>
export default {
  data(){
    return{
      form: {
        email: "",
        password: ""
      }
    };
  },
  methods:{
    submit(){}
  }

}
</script>

<style>

</style>