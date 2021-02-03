<template>
  <div>
    <profile-component></profile-component>
  </div>
</template>

<script>
export default {
  name: 'dashboard',
  data() {
    return {
      guest: true,
    }
  }, 
  mounted() {
    if(this.guest) {
      return this.$router.login;
    }
  }
}
</script>