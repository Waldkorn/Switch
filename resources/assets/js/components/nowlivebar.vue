<template>
  <div class="col-md-2 pt-1" style="padding:0;">
    <div class="container-fluid px-0">

      <div class="list-group-item" style="background-color:#f5f5dc;border-radius: 0px 0px 0rem 0rem;border:0px">
        <h4 class="mb-1" >Popular streamers</h4>
      </div>

      <div class="streamer list-group-item" v-for="user in users" v-bind:class="{ 'list-group-item': user.now_live, 'list-group-item-secondary': !user.now_live }"style="background-color:#343a40;border-radius: 0px 0px 0rem 0rem;">
        <div class="d-flex w-100 justify-content-between">
          <a :href="'/' + user.name" style="color:#f5f5dc">{{ user.name }}</a><small class="text-danger" v-show="user.streaming">live now</small>
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
    axios.get('/api/listusers').then(response => {
        this.users = response.data;
    })
    setInterval(function(){
      axios.get('/api/listusers').then(response => {
        this.users = response.data;
      })
    }.bind(this), 30000);
  }
}
</script>
