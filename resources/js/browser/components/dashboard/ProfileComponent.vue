<template>
  <div>
    Profile Component
    <button v-on:click="logout">Logout</button>
  </div>
</template>

<script>

import AuthServices from '../../services/AuthServices';

export default {
  methods: {
    logout() {
      axios.get(route('browser.api.logout'), {
        headers: {
          'Authorization': `Bearer ${localStorage.getItem('access_token')}`
        }
      }).then((response)=>{
        localStorage.removeItem('access_token');
        return this.$router.push('/login');
      }).catch((error)=>console.log(error));
    }
  }
}
</script>

<style>

</style>