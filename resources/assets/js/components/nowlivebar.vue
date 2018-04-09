<template>
  <div>
    <div class="container-fluid px-0" >
      <div class="card" style="margin-bottom:4px" v-if="subscriber_status !='premium'">
        <img class="card-img-top" src="/images/ads/1.png" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">hi there, I'm an ad!</h5>
        </div>
      </div>

      <div class="list-group-item" style="background-color:#f5f5dc;border-radius: 0px 0px 0rem 0rem;border:0px">
        <h4 class="mb-1" >Popular streamers</h4>
      </div>

      <div class="streamer list-group-item" v-for="user in users" v-bind:class="{ 'list-group-item': user.now_live, 'list-group-item-secondary': !user.now_live }"style="background-color:#343a40;border-radius: 0px 0px 0rem 0rem;">
        <div class="d-flex w-100 justify-content-between">
          <a v-if="user.streaming && user.now_live" :href="'/stream/' + user.name" style="color:#f5f5dc">
            {{ user.name }}
          </a>
          <a v-else :href="'/profilepage/' + user.name" style="color:#f5f5dc">
            {{ user.name }}
          </a>
          <small class="text-danger" v-show="user.streaming && user.now_live">live &nbsp; &nbsp; <img width="16px" src="/images/viewingIcon.png"> {{ user.viewer_count }}</small>
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
      users : [],
      subscriber_status:"free",
    }
  },
  props: ['user'],
  mounted() {
    if(this.user != undefined) {
      console.log(this.user.subscriber_status);
      this.subscriber_status = this.user.subscriber_status;
      axios.get('/api/listusers').then(response => {
          this.users = response.data;
      })
      setInterval(function(){
        axios.get('/api/listusers').then(response => {
          this.users = response.data;
        })
      }.bind(this), 5000);
    } else {
      axios.get('/api/listusersunauthenticated').then(response => {
            this.users = response.data;

        })
        setInterval(function(){
          axios.get('/api/listusersunauthenticated').then(response => {
            this.users = response.data;
          })
      }.bind(this), 5000);
    }
  }
}
</script>
