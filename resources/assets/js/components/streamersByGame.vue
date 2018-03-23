<template>
  <div class="col-md-10 d-flex flex-wrap justify-content-end px-5" style="padding-right:0">
    <div class="p-1" style="padding:0;margin:0;float:right" v-for="streamer in streamers">
      <a v-bind:href="'/' + streamer.user.name">
        <div class="card" style="width: 175px; height:100%;">
          <img class="card-img-top" :src="imageLink" :alt="streamer.user.name" height="150" width="150">

          <div class="card-body">
            <h5 class="card-title">{{streamer.title}}</h5>
            <h6>{{streamer.user.name}}</h6>
            <small class="text-danger" style="position: absolute; bottom:10px;">{{streamer.user.followers_count}} followers</small>
          </div>
        </div>
      </a>
    </div>
</div>
</template>

<script>
  export default {
    props: ['game', 'streamers'],
    data:function(){
      return{
        imageLink : "/images/drdisrespect.jpeg",
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
