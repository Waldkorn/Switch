<template>
  <div>
    <div class="card" style="width: 100%;"v-for="user in users">
      <h3 class="card-title">{{ user.name }}</h3>
      <img class="card-img-top" src="/images/placeholder.jpg" alt="hardcoded example">

      <div class="card-body">
        <h5 class="card-title">followers: [some number]</h5>
        <div id="follow_unfollow" v-if="loggedin == 1" >
        <button class="btn btn-success" id="follow_btn"style="margin-top:1rem" v-on:click="follow" :value="user.id" v-if="isfollowing == 0">follow</button>
        <button class="btn btn-danger"id="unfollow_btn" style="margin-top:1rem" v-on:click="unfollow" :value="user.id" v-if="isfollowing == 1">unfollow</button><br>
        <div class="alert alert-success" id="followmsg" role="alert" style="display:none">You are now following {{user.name}}</div>
        <div class="alert alert-danger" id="unfollowmsg" role="alert" style="display:none"> You are no longer following {{user.name}}</div>
      </div>
        <div id="follow_unfollow" v-if="loggedin == 0" > Please log in or register to follow {{user.name}}
</div>
    </div>
        <p class="card-text">pinned games, maybe social media links, whatever</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['auth_user','profile','loggedin','isfollowing'],

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
       follower_id: this.auth_user.id
     })
     .then(function (response) {
        document.getElementById('follow_btn').style.display = "none";
        document.getElementById('followmsg').style.display = "block";

      })
  },

    unfollow: function() {

      axios.post('/api/profilepage/unfollow', {
      user_id: document.getElementById('unfollow_btn').value,
      unfollower_id: this.auth_user.id
      })
      .then(function (response) {
        document.getElementById('unfollowmsg').style.display = "block";
        document.getElementById('unfollow_btn').style.display = "none";
      })
    },
  },
}
</script>
