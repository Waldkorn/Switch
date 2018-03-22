<template>
  <div class="col-3" style="padding:0">
    <div class="container-fluid" style="padding:0">

      <div class="list-group-item" style="background-color:#f5f5dc;border-radius: 0px 0px 0rem 0rem;border:0px">
        <h4 class="mb-1" >Popular streamers</h4>
      </div>

      <div class="streamer list-group-item" v-for="user in users" v-bind:class="{ 'list-group-item': user.now_live, 'list-group-item-secondary': !user.now_live }"style="background-color:#343a40;border-radius: 0px 0px 0rem 0rem;">
        <div class="d-flex w-100 justify-content-between">
          <a :href="'/' + user.name" style="color:#f5f5dc">{{ user.name }}</a><small class="text-danger" v-bind:class="{ 'd-none': !user.now_live }">live now</small>
        </div>
      </div>
    </div>

    <div class=container-fluid style="max-height:500px;padding:0;border-radius: 0px 0px 0rem 0rem;"> <div class="list-group-item" style="background-color:#f5f5dc;border:0px;border-radius: 0px 0px 0rem 0rem;">
      <h4 class="mb-1" >Some other users</h4>
    </div>
      <div class=container-fluid style="padding:0;overflow-y:hidden;border-radius: 0px 0px 0.25rem 0rem;">
        <div class="container-fluid" style="padding:0" v-for="user in users">
          <a :href="'/profilepage/'  + user.name" class="list-group-item" style="color:#f5f5dc;background-color:#343a40;border-radius: 0px;">{{user.name}}</a>
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
