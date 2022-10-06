<template>
  <div>
    <h2 class="mt-4">Posts</h2>
    <BaseLoader v-if="loading" />
    <div v-else>
      <ul v-if="posts.data.length">
        <TheCard
          v-for="post in posts.data"
          :key="post.id"
          :post="post"
          class="row"
        />
      </ul>
      <h3 class="mt-3 font-weight-light" v-else>Nothing found</h3>
    </div>
  </div>
</template>

<script>
import Axios from "axios";
import TheCard from "./TheCard";
import BaseLoader from "../BaseLoader.vue";

export default {
  name: "ThePost",
  components: {
    TheCard,
    BaseLoader,
  },
  data() {
    return {
      posts: [],
      loading: false,
    };
  },
  methods: {
    fetchPosts() {
      this.loading = true;
      axios
        .get("http://127.0.0.1:8000/api/posts")
        .then((res) => {
          this.posts = res.data;
        })
        .catch((err) => {
          console.error(err);
        })
        .then(() => {
          console.info("Called api");
          this.loading = false;
        });
    },
  },
  mounted() {
    this.fetchPosts();
  },
};
</script>

<style>
</style>



