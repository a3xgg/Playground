<template>
  <div>
    <router-view></router-view>
  </div>
  
</template>

<script>

const AuthServices = require('../services/AuthServices.js').default;

export default {
  name: 'app',
  data() {
    return {
    }
  },
  mounted() {
    if(!AuthServices.loggedIn()){
      return this.$route.path == '/login' ? null : this.$router.push('/login');
    }
  },
}
</script>