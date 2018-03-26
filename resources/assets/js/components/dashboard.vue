<template>
<div class="container-fluid" style="padding:0px">

  <ul class="nav nav-pills nav-fill navbar-dark bg-dark">
      <li class="nav-item" v-on:click="showstreamdash">
        <a class="nav-link" href="#" >Stream</a>
      </li>
    <li class="nav-item"v-on:click="showprofiledash">
        <a class="nav-link" href="#" >Profile</a>
      </li>
      <li class="nav-item" v-on:click="showchanneldash">
        <a class="nav-link" href="#" >Channel</a>
      </li>
      <li class="nav-item" v-on:click="showscheduledash">
        <a class="nav-link" href="#">schedule</a>
      </li>
  </ul>

<div class="container-fluid" style="padding:0px">
      <div  id="nav-stream" v-show="streamdash">
        <div class="row" style="border:0px">

          <div class="col-9" style="border:0px">

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

          <div class="col-3" style="border:0px">
            <div class="card">
              <h5 class="card-header">Getting started</h5>
              <div class="card-body">
                <h5 class="card-title">Step one: Streaming software</h5>
                <p class="card-text">To start streaming, you will first need streaming software. Open Broadcaster Software (OBS) is a free, open source client that is easy to set up and use.</p>
                <h5 class="card-title">Step Two: setting up a stream</h5>
                <p class="card-text">Once your streaming software is installed and running, it'll have to stream to our server.</p>
                <p class="card-text">In the settings menu, enter your url: rtmp://10.0.0.61:1935/hls/</p>
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


      </div>
      <div  id="nav-profile" v-show="profiledash">
        <div class="row">
          <div class="col-3">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" :src="profilecontent.img_url" alt="Card image cap">
                <div class="card-img-overlay"><h5 class="card-title" ></h5></div>
                <div class="card-body">
                  <div id="accordion">
                    <div class="card">

                      <div class="card-header" id="headingEdit">
                        <h5 class="mb-0">
                          <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseImage" aria-expanded="false" aria-controls="collapseImage">
                            Upload new image
                          </button>
                        </h5>
                      </div>
                  <div id="collapseImage" class="collapse" aria-labelledby="headingImage" data-parent="#accordion">
                    <div class="card-body">
                      <form action="/uploadimage" enctype="multipart/form-data" method="POST" >
                        <div class="form-group">
                          <label for="profileimage">Example file input</label>
                          <input type="hidden" name="_token" id="csrf-token" :value="csrftoken" />
                          <input type="file" class="form-control-file" id="profileimage" name="profileimage">
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
                  <h5 class="card-title">{{user.name}}</h5>
                  <div class="card-text">{{profilecontent.about}}</div>
                  <div id="accordion">
                    <div class="card">
                      <div class="card-header" id="headingEdit">
                        <h5 class="mb-0">
                          <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseEdit" aria-expanded="false" aria-controls="collapseEdit">
                            Edit about section:
                          </button>
                        </h5>
                      </div>
                      <div id="collapseEdit" class="collapse" aria-labelledby="headingEdit" data-parent="#accordion">
                        <div class="card-body">
                          <form>
                            <div class="form-group">
                              <label for="aboutinput">Text</label>
                              <input type="text" class="form-control" id="aboutinput" :value="profilecontent.about">
                            </div>
                            <div type="submit" class="btn btn-primary" v-on:click="updateAbout">Update</div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
          <div class="col-3"></div>
          <div class="col-3"></div>
        </div>
      </div>
      <div  id="nav-channel" v-show="channeldash">channel settings here</div>
      <div  id="nav-channel" v-show="scheduledash">
        <div class="row">
            <div class="row"></div>
            <div class="row">
              <div class="card" style="width: 18rem;">
            <div class="card-body">
              <div class="card-header">
                <h5 class="card-title">Add a scheduled event</h5>
              </div>
              <div class="card-body"></div>
              <form>
                <div class="form-group">
                  <label for="schedulename">Name</label>
                  <input type="text" class="form-control" id="schedulename" placeholder="Event Name">
                </div>

                <div class="form-row">
                <div class="col">
                  <div class="form-group">
                 <label for="schedulestart">Start:</label>
                 <input type="datetime-local" id="schedulestart" name="bdaytime">
               </div>
                </div>
                <div class="col">
                  <div class="form-group">
               <label for="scheduleend">End:</label>
                <input type="datetime-local" id="scheduleend" name="bdaytime">
             </div>
                </div>
              </div>

                <div class="form-group">
                  <label for="scheduletag">tag</label>
                  <input type="text" class="form-control" id="scheduletag" placeholder="idk">
                </div>
                <div class="form-group">
                  <label for="schedulegame">Game:</label>
                  <select class="form-control" id="schedulegame">
                    <option v-for="game in games" :value="game.id">{{game.name}}</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="scheduletype">type:</label>
                  <select class="form-control" id="scheduletype">
                    <option value="once">once</option>
                    <option value="daily">Daily</option>
                    <option value="weekly">Weekly</option>
                    <option value="monthly">Monthly</option>
                  </select>
                </div>
                <div type="submit" class="btn btn-primary" v-on:click="addschedule">Add event</div>
              </form>
            </div>
          </div>
            </div>
          </div>
      </div>
</div>
</div>
</template>

<script>

export default {


    data:function(){
      return{
          profilecontent : [],
          csrftoken : document.head.querySelector('meta[name="csrf-token"]').content,
          games : [],
          streamdash: true,
  				profiledash: false,
  				channeldash: false,
          scheduledash: false,
      }
    },
    props: ['user'],
    mounted() {

       var contenturl = 'api/profilecontent/'+this.user.name;
      axios.get(contenturl).then(response => {
        this.profilecontent = JSON.parse(JSON.stringify(response.data));
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

       })
      },

      updateAbout: function() {

        axios.post('/api/profilecontentabout', {
          about: document.getElementById('aboutinput').value,
       }).then(response => {
         this.profilecontent.about = response.data;
         $('#collapseEdit').collapse("toggle");
       })
      },
      showstreamdash: function() {
				this.streamdash = true;
				this.profiledash = false;
				this.channeldash = false;
        this.scheduledash = false;
			},
			showprofiledash: function() {
				this.streamdash = false;
				this.profiledash = true;
				this.channeldash = false;
        this.scheduledash = false;
			},
			showchanneldash: function() {
				this.streamdash = false;
				this.profiledash = false;
				this.channeldash = true;
        this.scheduledash = false;
			},
      showscheduledash: function() {
        this.streamdash = false;
        this.profiledash = false;
        this.channeldash = false;
        this.scheduledash = true;
      },



    }
  }
</script>
