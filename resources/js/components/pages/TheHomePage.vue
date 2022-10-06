<template>
  <main class="container">
    <ThePost></ThePost>
  </main>
</template>

<script>
import ThePost from "../posts/ThePost.vue";

export default {
    name: 'TheHomePage',
    components: {
      ThePost
    },
}
</script>

<style>

</style>