<template>
  <div class="content">
    <TheHeader></TheHeader>
    <router-view></router-view>
  </div>
</template>

<script>
import TheHeader from "./TheHeader.vue";

export default {
  name: "App",
  components: {
    TheHeader,
  },
};
</script>
