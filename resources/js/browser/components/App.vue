<template>
  <div>
    <router-view></router-view>
  </div>
  
</template>

<script>
export default {
  name: 'app',
  data() {
    return {
      guest: true
    }
  },
  mounted() {
    if(this.guest){
      return this.$route.path == '/login' ? null : this.$router.push('/login');
    }
  }
}
</script>