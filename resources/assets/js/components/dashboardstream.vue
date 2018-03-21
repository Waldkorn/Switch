<template>
  <div class="row">

    <div class="col-9">

      <div class="card" style="width:100%;margin-bottom:1rem;text-align:center">
        <h5 class="card-header">Stream Preview</h5>
        <video id="vid1" class="video-js" controls preload="auto" data-setup='{ "aspectRatio": "16:9" }'>
				    <source :src="'http://10.0.0.61:8080/hls/'  + user.stream_token + '.m3u8'" type='application/x-mpegURL'>
				    <p class="vjs-no-js">
				    	To view this video please enable JavaScript, and consider upgrading to a web browser that
				    	<a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
				    </p>
				</video>
      </div>

      <div class="card" style="width:100%;text-align:center">
        <h5 class="card-header">Start streaming?</h5>
        <form style="text-align:left">

          <div class="form-group">
            <label for="streamtitle">Title:</label>
            <input type="text" class="form-control" id="streamtitle" placeholder="Enter stream title" >
          </div>

          <div class="form-group">
            <label for="gameselect">Game:</label>
            <select class="form-control" id="gameselect">
              <option v-for="game in games" :value="game.id">{{game.name}}</option>
            </select>
          </div>

          <div class="form-group" style="text-align:center">
            <div type="submit" class="btn btn-success" v-on:click="golive">GO LIVE!</div>
          </div>
        </form>
      </div>

    </div>

    <div class="col-3">
      <div class="card">
        <h5 class="card-header">Getting started</h5>
        <div class="card-body">
          <h5 class="card-title">Step one: Streaming software</h5>
          <p class="card-text">To start streaming, you will first need streaming software. Open Broadcaster Software (OBS) is a free, open source client that is easy to set up and use.</p>
          <h5 class="card-title">Step Two: setting up a stream</h5>
          <p class="card-text">Once your streaming software is installed and running, it'll have to stream to our server.</p>
          <p class="card-text">In the settings menu, enter your url: rtmp://10.0.0.61:1935/hls/{{user.name}}/</p>
          <p class="card-text">And your unique stream key, like this:<img class="card-img-top" src="/images/dashboard/streamsettingsobs.png" alt="OBS stream settings" style="max-width:100%"></p>

          <div class='container' style="text-align:center; margin-bottom:1rem">
            <div class="btn btn-danger"id="streamkey_btn" style="margin-top:1rem;display:block" v-on:click="streamkey">Show my streamkey</div>
            <div class="btn btn-danger"id="hide_btn" style="margin-top:1rem;display:none" v-on:click="hidekey">hide streamkey</div>
            <div class="alert alert-danger" id="streamkeymessage" role="alert" style="display:none"></div>
          </div>

          <p class="alert alert-danger">(This is your personal streamkey, never show it to anyone!)</p>
          <h5 class="card-title">Step Three: connect to the server</h5>
          <p class="card-text">After you've entered your url and streamkey, you can start streaming to our server</p>
          <p class="card-text">You should see a preview of your stream on this page</p>
          <h5 class="card-title">Step Four: Start streaming! </h5>
          <p class="card-text">finally, choose a title and game, and go live! Your viewers can find your stream on your profile.</p>
        </div>
      </div>
    </div>
  </div>

</template>
<script>

export default {

    data:function(){
      return{
          user : [],
          games : []
      }
    },

    mounted() {
      axios.get('/api/user').then(response => {
        this.user = response.data;
      });

      axios.get('/api/allgames').then(response => {
        this.games = JSON.parse(JSON.stringify(response.data));
      })
    },

    methods: {

      streamkey: function() {

          axios.post('/api/streamkey', {
           user_id: this.user.id,

          }).then(function (response) {
            document.getElementById('streamkeymessage').style.display = "block";
            document.getElementById('streamkey_btn').style.display = "none";
            document.getElementById('hide_btn').style.display = "block";
            document.getElementById('streamkeymessage').innerHTML = response.data;

            })
      },

      hidekey: function() {
          document.getElementById('streamkeymessage').style.display = "none";
          document.getElementById('hide_btn').style.display = "none";
          document.getElementById('streamkey_btn').style.display = "block";
          document.getElementById('streamkeymessage').innerHTML = "";
      },

      golive: function() {

        axios.post('/api/stream', {

          user_id: this.user.id,
          stream_title: document.getElementById('streamtitle').value,
          game_id:  document.getElementById('gameselect').value,

       }).then(function (response) {console.log("you are live!")})
      },
    }
  }
</script>
