<template>
  <div>
    <div class="card" style="width: 100%;border-radius: 0px 0px 0.25rem 0rem;border:0px">
      <h3 class="card-title" style="margin:0;padding:0.5rem">{{ profile.name }}</h3>
      <img class="card-img-top" :src="profile.profilecontent.img_url" alt="hardcoded example">

      <div class="btn-group" style="padding:0;width:100%;border:0px;border-radius:0px">
        <button type="button" class="btn btn-danger" v-on:click="togglefollowers" style="width:50%;border-right:1px;border-radius:0px;margin-right:1px">Followers<br> <span class="badge badge-light">{{profile.followers_count}}</span></button>
        <button type="button" class="btn btn-danger" v-on:click="togglefollowings" style="width:50%;border:0px;border-radius:0px">Following<br><span class="badge badge-light">{{profile.followings_count}}</span></button>
      </div>
      <br>
      <div class="container-fluid">
        <div class="container-fluid" id="follow_unfollow" v-if="loggedin == 1" style="text-align:center">
          <button class="btn btn-success btn-lg" id="follow_btn" v-on:click="follow" :value="user.id" v-if="isfollowing == 0">follow</button>
          <button class="btn btn-danger btn-lg" id="unfollow_btn" v-on:click="unfollow" :value="user.id" v-if="isfollowing == 1">unfollow</button><br>
          <div class="alert alert-success" id="followmsg" role="alert" style="display:none">You are now following {{user.name}}</div>
          <div class="alert alert-danger" id="unfollowmsg" role="alert" style="display:none"> You are no longer following {{user.name}}</div>
        </div>
        <div id="follow_unfollow" v-if="loggedin == 0" > Please log in or register to follow {{user.name}}</div>
      </div>

      <div class="card-body"><hr>
        <h3 class="card-title"> About: </h3>
        <h5 class="card-text">{{profile.profilecontent.about}}</h5>
        <hr>
          <h3 class="card-title"> Featured Games: </h3>
          <h5 class="card-text"><span v-for="featuredgame in featuredgames" :class="featuredgame.label" style="margin:1px">{{featuredgame.name}}</span></h5>
      </div>

      <div class="list-group" id="followerslist" style="width:100%;max-height:500px;overflow:hidden;display:none">
        <p class="list-group-item list-group-item-dark"><strong>Followers:</strong></p>
        <div class="container-fluid" style="overflow-y:scroll;width:100%;height:100%;padding:0">
          <a v-for="follower in followers" :href="'/profilepage/' + follower.name" class="list-group-item list-group-item-action" > {{follower.name}}</a>
        </div>
      </div>

      <div class="list-group" id="followingslist" style="width:100%;max-height:500px;overflow:hidden;display:none">
        <p class="list-group-item list-group-item-dark"><strong>Following:</strong></p>
        <div class="container-fluid" style="overflow-y:scroll;width:100%;height:100%;padding:0">
          <a v-for="following in followings" :href="'/profilepage/' + following.name" class="list-group-item list-group-item-action" > {{following.name}}</a>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
export default {
  props: ['profile','loggedin','isfollowing'],

  data:function(){
    return{
      user : [],
      featuredgames : [],
      followers : [],
      followings : [],
      auth : [],
      showsubscribeform : [],
    }
  },

  mounted() {

    this.user = this.profile;
    this.followers = this.profile.followers;
    this.followings = this.profile.followings;
    this.featuredgames = this.profile.featured_games;

  },

  methods: {
    follow: function() {
      console.log(document.getElementById('follow_btn').value);
    axios.post('/api/profilepage/follow', {
       user_id: document.getElementById('follow_btn').value,

     })
     .then(function (response) {
        document.getElementById('follow_btn').style.display = "none";
        document.getElementById('followmsg').style.display = "block";
      })
  },

    unfollow: function() {

      axios.post('/api/profilepage/unfollow', {
      user_id: document.getElementById('unfollow_btn').value,

      }).then(function (response) {
        document.getElementById('unfollowmsg').style.display = "block";
        document.getElementById('unfollow_btn').style.display = "none";
      })
    },
    subscribe: function() {

    axios.post('/api/profilepage/subscribe', {
       user_id: this.user.id,
     })
     .then(function (response) {

        document.getElementById('subscribe_btn').style.display = "none";
        document.getElementById('subscribemsg').style.display = "block";
      })
  },

    unsubscribe: function() {

      axios.post('/api/profilepage/unsubscribe', {
      user_id: this.user.id,
      }).then(function (response) {
        document.getElementById('unsubscribemsg').style.display = "block";
        document.getElementById('unsubscribe_btn').style.display = "none";
      })
    },

    togglefollowers: function() {
      var x = document.getElementById("followerslist");
      if (x.style.display === "none") {
           x.style.display = "block";
      } else {
           x.style.display = "none";
      }
    },

    togglefollowings: function() {
      var x = document.getElementById("followingslist");
      if (x.style.display === "none") {
           x.style.display = "block";
      } else {
           x.style.display = "none";
      }
    },
    togglesubscribe: function() {
      var x = document.getElementById("subscribe_btn");
      if (x.style.display === "none") {
           x.style.display = "block";
      } else {
           x.style.display = "none";
      }
    }

  },
}
</script>
