<template>
  <div>
    <form @submit.prevent="login">
      <label for="email">Email</label>
      <input id="email" type="text" v-model="email">
      <label for="password">Password</label>
      <input type="password" v-model="password">
      <button type="submit" class="btn btn-primary">Login</button>
    </form>
    don't have an account? <router-link to="/register">Register</router-link>
  </div>
</template>

<script>

import AuthServices from '../../services/AuthServices';

export default {
  data() {
    return {
      email: '',
      password: '',
    }
  },
  mounted() {
    if(AuthServices.loggedIn()){
      return this.$router.push('/dashboard');
    }
  },
  methods: {
    login () {
      axios.post(route('browser.api.login'), {
        email: this.email,
        password: this.password,
      }).then((response) => {
        localStorage.setItem('access_token', response.data.access_token);
        this.$router.push('/dashboard');
      }).catch((error)=>console.log(response));
    }
  }
}
</script>

<style>

</style>