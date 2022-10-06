<template>
  <div class="container">
    <h1 class="mt-5">Post: </h1>
    <TheCard :post="post" />
  </div>
</template>

<script>
import TheCard from '../posts/TheCard.vue'

export default {
    name: 'ThePostDetail',
    components: { TheCard },
    data() {
    return {
      post: [],
    };
  },
  methods: {
    fetchPost() {
      axios
        .get("http://127.0.0.1:8000/api/posts/" + this.$route.params.id)
        .then((res) => {
          this.post = res.data;
        })
        .catch((err) => {
          console.error(err);
        })
        .then(() => {
          console.info("Called api");
        });
    },
  },
  mounted() {
    this.fetchPost();
  },
}
</script>

<style>

</style>