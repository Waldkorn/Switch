<template>
  <div class="col-3">
    <div class="card" style="width: 18rem;"v-for="user in users">
      <h3 class="card-title">{{ user.name }}</h3>
      <img class="card-img-top" src="http://www.top13.net/wp-content/uploads/2015/10/perfectly-timed-funny-cat-pictures-5.jpg" alt="hardcoded example">

      <div class="card-body">
        <h5 class="card-title">followers: [some number]</h5>
        <div id="follow_unfollow">
        <button class="btn btn-danger" id="follow_btn"style="margin-top:1rem" v-on:click="follow" :value="user.id">Follow</button>
        <button class="btn btn-danger"id="unfollow_btn" style="margin-top:1rem" v-on:click="unfollow" :value="user.id">unfollow</button>
      </div>
        <p class="card-text">pinned games, maybe social media links, whatever</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['auth_id','profile'],

  data:function(){
    return{
      users : null,
    }
  },

  mounted() {
    var url = '/api/profilepage/'+this.profile.name;
    axios.get(url).then(response => {
    this.users = JSON.parse(JSON.stringify(response.data));
    })
  },

  methods: {
    follow: function() {

    axios.post('/api/profilepage/follow', {
       user_id: document.getElementById('follow_btn').value,
       follower_id: this.auth_id
     })
     .then(function (response) {
        console.log('followed');
      })
  },

    unfollow: function() {

      axios.post('/api/profilepage/unfollow', {
      user_id: document.getElementById('unfollow_btn').value,
      unfollower_id: this.auth_id
      })
      .then(function (response) {
       console.log('unfollowed');
      })
    },
  },
}
</script>
