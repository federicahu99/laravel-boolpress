<template>
  <div class="container-overlay d-flex justify-content-between">
    <div class="spinner-border text-primary" role="status"></div>
  </div>
</template>

<script>
export default {
  name: "BaseLoader",
};
</script>

<style scoped>
    .container-overlay {
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        backdrop-filter: gray;
    }
</style>