<template>
<div class="col-3" style="padding-left:0;">

  <a href="#" class="list-group-item"><img src="http://www.onyxtree.com/IMAGE-GRA/Grass-400x100.jpg" class="img-fluid" alt="Responsive image"></a>
<a href="#" class="list-group-item"><img src="http://www.onyxtree.com/IMAGE-GRA/Grass-400x100.jpg" class="img-fluid" alt="Responsive image"></a>
<a href="#" class="list-group-item"><img src="http://www.onyxtree.com/IMAGE-GRA/Grass-400x100.jpg" class="img-fluid" alt="Responsive image"></a>
  <a href="#" class="list-group-item"><img src="http://www.onyxtree.com/IMAGE-GRA/Grass-400x100.jpg" class="img-fluid" alt="Responsive image"></a>

</div>
</template>
<script>

export default {
    mounted() {
        console.log('Component mounted.')
    }
}
/*    export default {
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

    } */
</script>
