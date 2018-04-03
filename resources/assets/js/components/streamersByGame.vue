<template>
  <div class="col-md-10 d-flex flex-wrap px-5" style="padding-right:0;" id="games-main">
    <div class="p-1" style="padding:0;margin:0;float:right;" v-for="streamer in streamers">
      <div class="card" style="width: 175px; height:100%;">
        <a v-bind:href="'/' + streamer.user.name">
          <img class="card-img-top" :src="streamer.user.profilecontent.img_url" :alt="streamer.name" height="150" width="150">
        </a>

        <div class="card-body">
          <a v-bind:href="'/' + streamer.user.name">
            <h6 class="card-title">{{streamer.title}}</h6>
          </a>
          <a v-bind:href="'/profilepage/' + streamer.user.name">
            <h6>{{streamer.user.name}}</h6>
          </a>
          <small class="text-danger" style="position: absolute; bottom:10px;">{{streamer.user.followers_count}} followers</small>
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
        sortable : []
      }
    },
    mounted() {
      function compare(a, b) {
        if (a.user.followers_count < b.user.followers_count)
          return -1;
        if (a.user.followers_count > b.user.followers_count)
          return 1;
        return 0;
      }
      
      for (var streamer in this.streamers) {
        this.sortable.push(this.streamers[streamer]);
      }

      this.streamers = this.sortable.sort(compare).reverse();

    }
  }
</script>

<style>

  #games-main {
    max-height: 1px;
  }

</style>
