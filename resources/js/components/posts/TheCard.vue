<template>
  <div>
    <li class="d-flex">
      
      <div class="card col-12 p-2 m-2">
        <!-- <img :src="post.image" class="card-img-top" :alt="post.title" /> -->
        <div class="card-body">
          <h3 class="card-title"> {{ post.title }} </h3>
          <p class="card-text">
            {{ post.content }}
          </p>
          <div class="d-flex justify-content-between align-items-center">
          <h6> Created at: {{ publishedAt }}</h6>
          <h6> Created by: {{ post.user_id}} (Id of user)</h6>
          <router-link :to="`/posts/${post.id}`" class="btn btn-primary">View</router-link>
        </div>
        </div>
   
    </div>
    </li>
  </div>
</template>

<script>
export default {
  name: "TheCard",
  props: {
    post: Object,
  },
  computed: {
      publishedAt() {
        const postDate = new Date(this.post.created_at);
        let day = postDate.getDate();
        let month = postDate.getMonth();
        let year = postDate.getFullYear();

        if(day < 10 ) day = "0" + day;
        if(month < 10 ) month = "0" + month;


        return `${day}-${month}-${year}`;
      }
  }
};
</script>

<style>
</style>