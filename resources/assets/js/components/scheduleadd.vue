<template>


</template>
<script>
export default {

    data:function(){
      return{
          games : []
      }
    },
    props: ['user'],
    mounted() {
      axios.get('/api/allgames').then(response => {
        this.games = JSON.parse(JSON.stringify(response.data));
      })
    },

    methods: {

    }
  }
</script>
