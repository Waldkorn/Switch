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
          <div class="col-8" style="padding:0px;padding-left:1rem">
            <div class="card">
            <div class="card-header">
              <h5 class="card-title">scheduled streams</h5>
            </div>
            <div class="card-body" style="padding:0px">
              <table class="table table-striped table-dark" style="margin:0px;background-color:#343a40">
  <thead>
    <tr style="color:#dc3545">
      <th scope="col">type</th>
      <th scope="col">name</th>
      <th scope="col">start</th>
      <th scope="col">end</th>
      <th scope="col">game</th>
      <th scope="col">tag</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">single</th>
      <td>Dota 2: electric boogaloo</td>
      <td>soon</td>
      <td>1 hour after soon</td>
      <td>Dota2</td>
      <td>subscriber games</td>
      <td><div class="btn btn-info">edit</div></td>
      <td><div class="btn btn-danger">delete</div></td>
      <td></td>
    </tr>
    <tr>
      <th scope="row">daily</th>
      <td>Daily dose of minecraft</td>
      <td>soon</td>
      <td>1 hour after soon</td>
      <td>Minecraft</td>
      <td>evening stream</td>
      <td><div class="btn btn-info">edit</div></td>
      <td><div class="btn btn-danger">delete</div></td>
      <td><div class="btn btn-danger">delete all</div></td>
    </tr>
    <tr>
      <th scope="row">weekly</th>
      <td>sunday streamtime</td>
      <td>soon</td>
      <td>1 hour after soon</td>
      <td>WoW</td>
      <td>weekend streams</td>
      <td><div class="btn btn-info">edit</div></td>
      <td><div class="btn btn-danger">delete</div></td>
      <td><div class="btn btn-danger">delete all</div></td>
    </tr>
    <tr>
      <th scope="row">monthly</th>
      <td>Monthly subscriber stream</td>
      <td>soon</td>
      <td>1 hour after soon</td>
      <td>PUBG</td>
      <td>subscriber ama</td>
      <td><div class="btn btn-info">edit</div></td>
      <td><div class="btn btn-danger">delete</div></td>
      <td><div class="btn btn-danger">delete all</div></td>
    </tr>
  </tbody>
</table>
          </div>
        </div>
        </div>
            <div class="col-4" style="padding:0px">
              <div class="card">

              <div class="card-header">
                <h5 class="card-title">Add a scheduled event</h5>
              </div>
              <div class="card-body">
              <form>

                <div class="form-group">
                  <label for="schedule_title">Name</label>
                  <input type="text" class="form-control" id="schedule_title" name="schedule_title" placeholder="Event Name">
                </div>

                <div class="form-row">
                <div class="col">
                  <div class="form-group">
                    <div class="row">
                      <span>Start：</span>
                      <input type="datetime-local" name="schedule_start" id="schedule_start">
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <div class="row">
                      <span>End：</span>
                      <input type="datetime-local" name="schedule_end" id="schedule_end">
                    </div>
             </div>
                </div>
              </div>

                <div class="form-group">
                  <label for="schedule_tag">tag</label>
                  <input type="text" class="form-control" id="schedule_tag" name="schedule_tag" placeholder="idk">
                </div>
                <div class="form-group">
                  <label for="schedule_game">Game:</label>
                  <select class="form-control" id="schedule_game" name="schedule_game">
                    <option v-for="game in games" :value="game.id">{{game.name}}</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="schedule_type">type:</label>
                  <select class="form-control" id="schedule_type" name="schedule_type">
                    <option value="once">once</option>
                    <option value="daily">Daily</option>
                    <option value="weekly">Weekly</option>
                    <option value="monthly">Monthly</option>
                  </select>
                </div>
                <div type="submit" class="btn danger" v-on:click="addschedule">Add event</div>
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
var state = {
  date: ''
}
import myDatepicker from 'vue-datepicker'

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

          startTime: {
                time: ''
              },
              endtime: {
                time: ''
              },

              option: {
                type: 'day',
                week: ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'],
                month: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                format: 'YYYY-MM-DD',
                placeholder: 'when?',

                inputStyle: {
                  'display': 'inline-block',
                  'padding': '6px',
                  'line-height': '22px',
                  'font-size': '16px',
                  'border': '2px solid #fff',
                  'box-shadow': '0 1px 3px 0 rgba(0, 0, 0, 0.2)',
                  'border-radius': '2px',
                  'color': '#5F5F5F'
                },
                color: {
                  header: '#ccc',
                  headerText: '#f00'
                },
                buttons: {
                  ok: 'Ok',
                  cancel: 'Cancel'
                },
                overlayOpacity: 0.5, // 0.5 as default
                dismissible: true // as true as default
              },
              timeoption: {
                type: 'min',
                week: ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'],
                month: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                format: 'YYYY-MM-DD HH:mm'
              },
              multiOption: {
                type: 'multi-day',
                week: ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'],
                inputName: 'schedule_time',
                month: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                format:"YYYY-MM-DD HH:mm"
              },
              limit: [{
                type:'fromto',
                from: '',
                to: ''
              }]
      }
    },

    components: {
    'date-picker': myDatepicker
    },
    props: ['user'],
    mounted() {

       var contenturl = 'api/profilecontent/'+this.user.name;
      axios.get(contenturl).then(response => {
        this.profilecontent = JSON.parse(JSON.stringify(response.data));
      });
      axios.get('/api/allgames').then(response => {
        this.games = JSON.parse(JSON.stringify(response.data));
      });
      axios.get('/api/currentdate').then(response => {
        this.currentdate = JSON.parse(JSON.stringify(response.data));
        console.log(this.currentdate);
      });
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

        axios.post('/api/updateabout', {
          about: document.getElementById('aboutinput').value,
       }).then(response => {
         this.profilecontent.about = response.data;
         $('#collapseEdit').collapse("toggle");
       })
      },
      addschedule: function () {
        axios.post('/api/addschedule', {
          schedule_title: document.getElementById('schedule_title').value,
          schedule_start: document.getElementById('schedule_start').value,
          schedule_end: document.getElementById('schedule_end').value,
          schedule_tag: document.getElementById('schedule_tag').value,
          schedule_game: document.getElementById('schedule_game').value,
          schedule_type: document.getElementById('schedule_type').value,
       }).then(response => {console.log(response.data)
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
