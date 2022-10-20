<script>
  export default {
    name: 'App'
  }
</script>

<template>
  <div class="container" id="app">
    <notifications position="top center"/>
    <div class="row">
      <div class="col-12">
        <router-view  />
      </div>
    </div>
  </div>
</template>

<style scoped>
</style>
