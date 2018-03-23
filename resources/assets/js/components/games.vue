<template>
<<<<<<< HEAD
  <div class="col-3" style="padding-right:0">
    <div class="p-2" style="padding:0;margin;0;float:right" v-for="game in games">
      <div class="card" style="width: 150px;color:#343a40"> 
        <img class="card-img-top" :src="game.image_source" :alt="game.name" height="150" width="150">

        <div class="card-body" style="text-align:center">
          <h6 class="card-title">{{game.name}}</h6>
          <a href="#" class="btn btn-danger">number</a>
=======
  <div class="col-md-5 d-flex flex-wrap justify-content-end" style="padding-right:0">
    <div class="p-1" style="padding:0;margin:0;float:right" v-for="game in games">
      <a v-bind:href="'/game/' + game.name">
        <div class="card" style="width: 175px; height:100%;">
          <img class="card-img-top" :src="game.image_source" :alt="game.name" height="150" width="150">

          <div class="card-body">
            <h6 class="card-title">{{game.name}}</h6>
            <small class="text-danger" style="position: absolute; bottom:10px;">{{game.streams_count}} streaming</small>
          </div>
>>>>>>> 0ead856db9fee9bb828e7a13619ad33825fd498a
        </div>
      </a>
    </div>
</div>
</template>

<script>
  export default {
    data:function(){
      return{
        games : null
      }
    },
    mounted() {
      axios.get('/api/games').then(response => {
        this.games = response.data;
      })
    }
  }
</script>
