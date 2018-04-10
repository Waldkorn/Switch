<template>
  <div id="games-main" class="col-md-5 d-flex flex-wrap justify-content-end" style="padding-right:0;max-height: 1px;float:right;">
    <div class="p-1" style="padding:0;margin:0;float:right" v-for="game in games">
      <a v-bind:href="'/game/' + game.name">
        <div class="card" style="width:175px;height:100%;">
          <img class="card-img-top" :src="game.image_source" :alt="game.name" height="150" width="150">

          <div class="card-body">
            <h6 class="card-title">{{game.name}}</h6>
            <small class="text-danger" style="position: absolute; bottom:10px;">{{game.users_count}} streaming</small>
          </div>
        </div>
      </a>
    </div>
</div>
</template>

<script>
  export default {
    data:function(){
      return{
        upcomingstreams : null
      }
    },
    mounted() {
      axios.get('/api/upcomingstreams').then(response => {
        console.log(response.data);
        this.upcomingstreams = response.data;

      })
      setInterval(function(){
        axios.get('/api/upcomingstreams').then(response => {
          this.upcomingstreams = response.data;
        })
      }.bind(this), 5000);
    }
  }
</script>

<style>



</style>
