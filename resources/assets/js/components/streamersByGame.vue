<template>
  <div class="col-md-10 d-flex flex-wrap px-5 mt-3 mb-auto" style="padding-right:0; min-height:0px;" id="games-main">
    <div style="width:100%">
      <div class="d-flex m-2">
        <img height="64px" :src="game.image_source" />
        <h1 class="my-auto mx-1" style="color:#dc3545;">{{ game.name }}</h1>
      </div>
    </div>
    <div v-show="no_streamers" class="jumbotron p-2" style="width:100%;min-height:0px;">
      <h3>Sorry! No one is currently streaming this game</h3>
    </div>
    <div class="mb-auto float-top" style="padding:0;margin:0;float:right;" v-for="streamer in streamers">
      <div class="card" style="width: 175px;">
        <a v-bind:href="'/' + streamer.user.name">
          <img class="card-img-top" :src="streamer.user.profilecontent.img_url" :alt="streamer.name" height="150" width="150">
        </a>

        <div class="card-body">     
          <div class="d-flex w-100 justify-content-between">
             <a v-bind:href="'/stream/' + streamer.user.name"><h6 class="card-title">{{streamer.title}}</h6></a>
            <small><img width="16px" src="/images/viewingIcon.png"> {{ streamer.user.viewer_count }}</small>
          </div>
          <a v-bind:href="'/profilepage/' + streamer.user.name">
            <h6>{{streamer.user.name}}</h6>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: ['game', 'streamers'],
    data:function(){
      return{
        sortable : [],
        no_streamers: false,
        viewer_count: 0
      }
    },
    mounted() {
      if (this.streamers.length == 0)
      {
        this.no_streamers = true;
      }
      function compare(a, b) {
        if (a.user.followers_count < b.user.followers_count)
          return -1;
        if (a.user.followers_count > b.user.followers_count)
          return 1;
        return 0;
      }

      for (var streamer in this.streamers) {
        this.sortable.push(this.streamers[streamer]);
        this.viewer_count += this.streamers[streamer].user.viewer_count;
      }

      this.streamers = this.sortable.sort(compare).reverse();

    }
  }
</script>
  
<style>
</style>
