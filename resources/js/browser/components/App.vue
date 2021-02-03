<template>
  <div>Hello World!
    <router-link to="/dashboard">Dashboard</router-link>
    <router-view></router-view>
  </div>
  
</template>

<script>
export default {
  name: 'app'
}
</script>