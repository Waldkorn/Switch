<template>
<div>
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
      axios.get('/api/user').then(response => {
        console.log(response.data);
      })

    }
  }
</script>
