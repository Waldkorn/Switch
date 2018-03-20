<template>
  <div class="container-fluid" >
    <p> your super secret streamkey is </p>
    <button class="btn btn-danger"id="streamkey_btn" style="margin-top:1rem" v-on:click="streamkey" >Show my streamkey</button><br>
    <div class="alert alert-success" id="streamkeymessage" role="alert" style="display:none"></div>
    <p> to stream this and this </p>
  </div>
</template>
<script>

  export default {
    props: ['auth_id'],

    data:function(){
      return{
  //user : null
      }
    },

    mounted() {
      console.log(this.auth_id);
      axios.post('/api/dashboardstream', {
         user_id: this.auth_id,
        })
       .then(function (response) {
        console.log(response.data);
        //this.user = JSON.parse(JSON.stringify(response.data));

        })



    },
    methods: {
      streamkey: function() {

      axios.post('/api/streamkey', {
         user_id: this.auth_id,

       })
       .then(function (response) {
         console.log(response.data);
          document.getElementById('streamkeymessage').style.display = "block";
          document.getElementById('streamkeymessage').innerHTML = response.data;

        })
    },
  }
  }
</script>
