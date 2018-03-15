<template>

<div class="container-fluid">
   <div class="row" style="max-height:10px">
            <div class="d-flex flex-row" v-for="game in games">
              <div class="p-2">
              <div class="card" style="width: 18rem;">
                <img class="card-img-top" :src="game.image_source" :alt="game.name">
                <div class="card-body">

                  <h5 class="card-title">({{game.name}})</h5>
                  <a href="#" class="btn btn-primary">currently streaming: x</a>
                </div>
              </div>
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
