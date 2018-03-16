<template>
  <div class="col-3" style="padding-left:0;">
    <div class="container-fluid">
      <a href="/streampage" class="list-group-item">GO TO THE STREAM</a>
      <a href="#" class="list-group-item"><img src="http://www.onyxtree.com/IMAGE-GRA/Grass-400x100.jpg" class="img-fluid" alt="Responsive image"></a>
      <a href="#" class="list-group-item"><img src="http://www.onyxtree.com/IMAGE-GRA/Grass-400x100.jpg" class="img-fluid" alt="Responsive image"></a>
      <a href="#" class="list-group-item"><img src="http://www.onyxtree.com/IMAGE-GRA/Grass-400x100.jpg" class="img-fluid" alt="Responsive image"></a>
    </div>
    <div class=container-fluid style="max-height:500px"> Some other users
    <div class=container-fluid style="padding:0;overflow-y:scroll;"  
    <div class="container-fluid" style="padding:0" v-for="user in users">
    <a :href="'/profilepage/'  + user.name" class="list-group-item">{{user.name}}</a>
    </div>
</div>

  </div>


</template>
<script>

export default {
  data:function(){
    return{
      games : null,
      users : null
    }
  },

  mounted() {
    axios.get('/api/listusers').then(response => {
      this.users = response.data;
      console.log(response.data);
    })

  }
}
</script>
