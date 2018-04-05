<template>
  <div v-show="users.length != 0">
    <div class="container-fluid px-0 pb-1">

      <div class="list-group-item" style="background-color:#f5f5dc;border-radius: 0px 0px 0rem 0rem;border:0px">
        <h4 class="mb-1" >Followed channels</h4>
      </div>

      <div class="streamer list-group-item" v-for="user in users" v-bind:class="{ 'list-group-item': user.now_live, 'list-group-item-secondary': !user.now_live }"style="background-color:#343a40;border-radius: 0px 0px 0rem 0rem;">
        <div class="d-flex w-100 justify-content-between">
          <a v-if="user.streaming" :href="'/' + user.name" style="color:#f5f5dc">{{ user.name }}</a>
          <a v-else :href="'/profilepage/' + user.name" style="color:#f5f5dc">{{ user.name }}</a>
          <small class="text-danger" v-show="user.streaming">live &nbsp; &nbsp; <img width="16px" src="/images/viewingIcon.png"> {{ user.viewer_count }}</small>
        </div>
      </div>
    </div>
  </div>
</template>
<script>

export default {
  data:function(){
    return{
      games : null,
      users : []
    }
  },

  mounted() {
    axios.get('/api/followings').then(response => {
        this.users = response.data;
    })
    setInterval(function(){
      axios.get('/api/followings').then(response => {
        this.users = response.data;
      })
    }.bind(this), 5000);
  }
}
</script>
