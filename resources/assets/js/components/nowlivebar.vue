<template>
  <div class="col-md-2 pt-1" style="padding-left:0;">
    <div class="container-fluid">

      <div class="list-group-item">
        <h5 class="mb-1">Popular streamers</h5>
      </div>

      <div class="streamer list-group-item" v-for="user in users" v-bind:class="{ 'list-group-item-primary': user.now_live, 'list-group-item-secondary': !user.now_live }">
        <div class="d-flex w-100 justify-content-between">
          <a :href="'/' + user.name">{{ user.name }}</a><small class="text-danger" v-bind:class="{ 'd-none': !user.now_live }">live now</small>
        </div>
      </div>
    </div>

<!--     <div class=container-fluid style="max-height:500px"> Some other users
      <div class=container-fluid style="padding:0;overflow-y:scroll;">
        <div class="container-fluid" style="padding:0" v-for="user in users">
          <a :href="'/profilepage/'  + user.name" class="list-group-item">{{user.name}}</a>
        </div>
      </div>
    </div> -->
  </div>  
</template>
<script>

export default {
  data:function(){
    return{
      games : null,
      users : null
    }
  },

  mounted() {
    axios.get('/api/listusers').then(response => {
      this.users = response.data;
    })

  }
}
</script>
