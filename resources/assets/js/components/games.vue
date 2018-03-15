<template>
  <div class="col-3" style="padding-right:0">
    <div class="p-2" style="padding:0;margin;0;float:right" v-for="game in games">
      <div class="card" style="width: 150px;">
        <img class="card-img-top" :src="game.image_source" :alt="game.name" height="150" width="150">

        <div class="card-body">
          <h6 class="card-title">{{game.name}}</h6>
          <a href="#" class="btn btn-primary">number</a>
        </div>
      </div>
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
