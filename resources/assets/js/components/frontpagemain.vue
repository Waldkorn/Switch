<template>
  <div class="col" >

<p> lots of stuff here soon </p>
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
