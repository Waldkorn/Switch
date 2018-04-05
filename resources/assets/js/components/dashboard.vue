<template>
<div class="container-fluid" style="padding:0px">

  <ul class="nav nav-pills nav-fill navbar-dark bg-dark">
    <li class="nav-item" v-on:click="showstreamdash">
      <a class="nav-link" href="#" >Stream</a>
    </li>
    <li class="nav-item" v-on:click="showprofiledash">
      <a class="nav-link" href="#" >Profile</a>
    </li>
    <li class="nav-item" v-on:click="showannouncementdash">
      <a class="nav-link" href="#" >Announcements</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#" v-on:click="showscheduledash">schedule</a>
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

                <h5 class="card-title">Step Three: ensure your followers know you're live</h5>
                <p class="card-text">You're all set to stream, but ofcourse you want your followers to be able to see that you're live. Switch has a handy built in feature that helps you do this.</p>
                <p class="card-text">To let Switch know that you're live, add a BrowserSource to your scene with the url switch.vps.codegorilla.nl/streaminglive/{STREAM_KEY}. That's it! We'll handle the rest.</p>

                <h5 class="card-title">Step Four: connect to the server</h5>
                <p class="card-text">After you've entered your url and streamkey, you can start streaming to our server</p>
                <p class="card-text">You should see a preview of your stream on this page</p>

                <h5 class="card-title">Step Five: Start streaming! </h5>
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

      <div v-show="announcementsdash">

        <div class="row px-2">

          <div class="col-md-6">

            <h3 class="display-4" style="color: #343a40;">New announcement</h3>

            <form action="/announcements/post" method="POST">

              <div class="form-group">
               <input type="hidden" name="_token" id="csrf-token" :value="csrftoken" />
             </div>

              <div class="form-group">
                <label for="Title">Title</label>
                <input type="text" class="form-control" name="title" placeholder="Enter title">
              </div>

              <div class="form-group">
                <textarea type="textarea" class="form-control" name="message" placeholder="Announcement" rows="5"></textarea>
              </div>

              <button type="submit" class="btn btn-danger float-right">Submit</button>

            </form>

          </div>

          <div class="col-md-6">

            <h3 class="display-4" style="color: #343a40;">Your recent announcements</h3>

            <div class="card mb-2" v-for="announcement in announcements">
              <div class="card-body bg-dark" style="color:rgb(245, 245, 220);">
                <div class="card-title">
                  <img height="32px" :src=announcement.user.profilecontent.img_url><span><a :href="'/profilepage/' + announcement.user.name"><h3 class="ml-2" style="display:inline">{{announcement.user.name}}</h3></a><br><h5 class="pt-1">{{ announcement.title }}</h5></span>
                </div>
                <hr>
                <div class="card-text">
                  {{ announcement.message }}
                </div>
              </div>
            </div>

          </div>

        </div>
      </div>

      <div  id="nav-channel" v-show="scheduledash">
        <div class="row">
          <div class="col-7" style="padding:0px;padding-left:1rem">

            <div class="card">
              <div class="card-body" style="padding:0px">
                <h5 class="card-title">Single streams</h5>
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
                    <tr v-for="singlestream in singlestreams">
                      <th scope="row">{{singlestream.type}}</th>
                      <td>{{singlestream.title}}</td>
                      <td>{{singlestream.start_date}}</td>
                      <td>{{singlestream.end_date}}</td>
                      <td>{{singlestream.game}}</td>
                      <td>{{singlestream.tag}}</td>
                      <td><div class="btn btn-info"  v-on:click="editsingle(singlestream.id,this)">edit</div></td>
                      <td><div class="btn btn-danger":id="singlestream.id" v-on:click="delete_schedule(singlestream.id,this)">delete</div></td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>

                <h5 class="card-title">Daily streams</h5>
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
                    <tr v-for="dailystream in dailystreams">
                      <th scope="row">{{dailystream.type}}</th>
                      <td>{{dailystream.title}}</td>
                      <td>{{dailystream.start_time}}</td>
                      <td>{{dailystream.end_time}}</td>
                      <td>{{dailystream.game}}</td>
                      <td>{{dailystream.tag}}</td>
                      <td><div class="btn btn-info":id="dailystream.id" v-on:click="editdaily(dailystream.id,this)">edit</div></td>
                      <td><div class="btn btn-danger"v-on:click="delete_schedule(dailytream.id,this)">delete</div></td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>

                <h5 class="card-title">Weekly streams</h5>
                <table class="table table-striped table-dark" style="margin:0px;background-color:#343a40">
                  <thead>
                    <tr style="color:#dc3545">
                      <th scope="col">type</th>
                      <th scope="col">name</th>
                      <th scope="col">day</th>
                      <th scope="col">start</th>
                      <th scope="col">end</th>
                      <th scope="col">game</th>
                      <th scope="col">tag</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr v-for="weeklystream in weeklystreams">
                      <th scope="row">{{weeklystream.type}}</th>
                      <td>{{weeklystream.title}}</td>
                        <td>{{weeklystream.day}}</td>
                      <td>{{weeklystream.start_time}}</td>
                      <td>{{weeklystream.end_time}}</td>
                      <td>{{weeklystream.game}}</td>
                      <td>{{weeklystream.tag}}</td>
                      <td><div class="btn btn-info" :id="weeklystream.id"v-on:click="editweekly(weeklystream.id,this)">edit</div></td>
                      <td><div class="btn btn-danger" :id="weeklystream.id" v-on:click="delete_schedule(weeklystream.id,this)">delete</div></td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

          </div>

          <div class="col-5" style="padding:0px">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Add a scheduled event</h5>
              </div>

              <div class="card-body">

                <div class="container-fluid" id="addschedulebuttons">
                  <div class="btn btn-warning btn-lg btn-block" v-on:click="show_form_single">Single event</div>
                  <div class="btn btn-secondary btn-lg btn-block" v-on:click="show_form_daily">Daily stream</div>
                  <div class="btn btn-info btn-lg btn-block" v-on:click="show_form_weekly">Weekly stream</div>
                  <div class="alert alert-success" id="schedulemsg" style="display:none"></div>
                </div>

                  <!-- schedule creation forms  -->
                  <div class="container-fluid" id="schedule_form_single" style="display:none">
                    <div class="btn btn-danger" v-on:click="show_back" >Back</div>
                    <!-- single stream -->
                    <form>

                      <div class="form-group">
                        <label for="single_title">Name</label>
                        <input type="text" class="form-control" id="single_title" name="single_title" placeholder="Event Name">
                      </div>

                      <div class="form-row">
                        <div class="col">
                          <span>Start：</span>
                          <input type="datetime-local" name="single_start" id="single_start" :min="currentdate">
                        </div>

                        <div class="col">
                          <span>End：</span>
                          <input type="datetime-local" name="single_end" id="single_end" :min="currentdate">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="single_tag">tag</label>
                        <input type="text" class="form-control" id="single_tag" name="single_tag" placeholder="idk">
                      </div>

                      <div class="form-group">
                        <label for="single_game">Game:</label>
                        <select class="form-control" id="single_game" name="single_game">
                          <option v-for="game in games" :value="game.id">{{game.name}}</option>
                        </select>
                      </div>

                      <div id="submitschedulebtn" class="btn btn-danger btn-lg btn-block" v-on:click="add_schedule_single">Add event</div>
                      <div class="alert alert-danger" role="alert" id="single_errors" style="display:none;margin-top:1rem"></div>
                    </form>
                  </div>

                  <!-- daily stream -->
                  <div class="container-fluid" id="schedule_form_daily" style="display:none">
                    <div class="btn btn-danger" v-on:click="show_back" >Back</div>

                    <form>
                      <div class="form-group">
                        <label for="daily_title">Name</label>
                        <input type="text" class="form-control" id="daily_title" name="daily_title" placeholder="Event Name">
                      </div>

                      <div class="form-row">
                        <div class="col">
                          <span>Start：</span>
                          <input type="time" name="daily_start" id="daily_start">
                        </div>

                        <div class="col">
                          <span>End：</span>
                          <input type="time" name="daily_end" id="daily_end">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="daily_tag">tag</label>
                        <input type="text" class="form-control" id="daily_tag" name="daily_tag" placeholder="idk">
                      </div>

                      <div class="form-group">
                        <label for="daily_game">Game:</label>
                        <select class="form-control" id="daily_game" name="daily_game">
                          <option v-for="game in games" :value="game.id">{{game.name}}</option>
                        </select>
                      </div>

                      <div id="submitschedulebtn" class="btn btn-danger btn-lg btn-block" v-on:click="add_schedule_daily">Add event</div>
                      <div class="alert alert-danger" role="alert" id="daily_errors" style="display:none;margin-top:1rem"></div>
                    </form>
                  </div>

                  <!-- weekly stream -->
                  <div class="container-fluid" id="schedule_form_weekly" style="display:none">
                      <div class="btn btn-danger" v-on:click="show_back" >Back</div>

                    <form>

                      <div class="form-group">
                        <label for="weekly_title">Name</label>
                        <input type="text" class="form-control" id="weekly_title" name="weekly_title" placeholder="Stream Name">
                      </div>

                      <div class="form-group">
                        <label for="weekly_day">Day:</label>
                        <select class="form-control" id="weekly_day" name="weekly_day">
                          <option value="monday">Monday</option>
                          <option value="Tuesday">Tuesday</option>
                          <option value="Wednesday">Wednesday</option>
                          <option value="Thursday">Thursday</option>
                          <option value="Friday">Friday</option>
                          <option value="Saturday">Saturday</option>
                          <option value="Sunday">Sunday</option>
                        </select>
                      </div>

                      <div class="form-row">
                        <div class="col">
                          <span>Start：</span>
                          <input type="time" name="weekly_start" id="weekly_start">
                        </div>
                        <div class="col">
                          <span>End：</span>
                          <input type="time" name="weekly_end" id="weekly_end">
                          </div>
                      </div>

                      <div class="form-group">
                        <label for="weekly_tag">tag</label>
                        <input type="text" class="form-control" id="weekly_tag" name="weekly_tag" placeholder="idk">
                      </div>

                      <div class="form-group">
                        <label for="weekly_game">Game:</label>
                        <select class="form-control" id="weekly_game" name="weekly_game">
                          <option v-for="game in games" :value="game.id">{{game.name}}</option>
                        </select>
                      </div>

                      <div id="submitschedulebtn" class="btn btn-danger btn-lg btn-block" v-on:click="add_schedule_weekly">Add event</div>
                      <div class="alert alert-danger" role="alert" id="weekly_errors" style="display:none;margin-top:1rem"></div>
                    </form>
                  </div>
                  <!-- end creation forms -->

                  <!-- update forms -->
                  <!-- edit daily stream  -->
                  <div class="container-fluid" id="editdailyschedule" style="display:none">
                    <h3> Update daily stream </h3>
                    <div class="btn btn-danger btn-lg btn-block" v-on:click="cancel_editdaily">Never mind </div>

                    <form>

                      <input type="hidden" id="editdaily_id">

                      <div class="form-group">
                        <label for="editdaily_title">Name</label>
                        <input type="text" class="form-control" id="editdaily_title" name="editdaily_title" placeholder="Event Name">
                      </div>

                      <div class="form-row">
                        <div class="col">
                          <span>Start：</span>
                          <input type="time" name="editdaily_start_time" id="editdaily_start_time">
                        </div>

                        <div class="col">
                          <span>End：</span>
                          <input type="time" name="editdaily_end_time" id="editdaily_end_time">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="daily_tag">tag</label>
                        <input type="text" class="form-control" id="editdaily_tag" name="editdaily_tag" placeholder="idk">
                      </div>

                      <div class="form-group">
                        <label for="daily_game">Game:</label>
                        <select class="form-control" id="editdaily_game" name="editdaily_game">
                          <option v-for="game in games" :value="game.id">{{game.name}}</option>
                        </select>
                      </div>

                      <div id="submiteditdailybtn" class="btn btn-danger btn-lg btn-block" v-on:click="updatedaily">Update</div>
                        <div class="alert alert-danger" role="alert" id="daily_edit_errors" style="display:none;margin-top:1rem"></div>
                    </form>
                  </div>
                  <!-- edit single stream  -->
                  <div class="container-fluid" id="editsingleschedule" style="display:none">
                    <h3> Update single stream </h3>
                    <div class="btn btn-danger btn-lg btn-block" v-on:click="cancel_editsingle">Never mind </div>

                    <form>

                      <input type="hidden" id="editsingle_id">

                      <div class="form-group">
                        <label for="editsingle_title">Name</label>
                        <input type="text" class="form-control" id="editsingle_title" name="editsingle_title" placeholder="Event Name">
                      </div>

                      <div class="form-row">
                        <div class="col">
                          <span>Start：</span>
                          <input type="datetime-local" name="editsingle_start_date" id="editsingle_start_date">
                        </div>

                        <div class="col">
                            <span>End：</span>
                            <input type="datetime-local" name="editsingle_end_date" id="editsingle_end_date">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="editsingle_tag">tag</label>
                        <input type="text" class="form-control" id="editsingle_tag" name="editsingle_tag" placeholder="idk">
                      </div>

                      <div class="form-group">
                        <label for="editsingle_game">Game:</label>
                        <select class="form-control" id="editsingle_game" name="editsingle_game">
                          <option v-for="game in games" :value="game.id">{{game.name}}</option>
                        </select>
                      </div>

                      <div id="submiteditsinglebtn" class="btn btn-danger btn-lg btn-block"  v-on:click="updatesingle">Update</div>
                      <div class="alert alert-danger" role="alert" id="single_edit_errors" style="display:none;margin-top:1rem"></div>
                  </form>
                </div>
                <!-- edit weekly stream  -->
                <div class="container-fluid" id="editweeklyschedule" style="display:none">

                  <h3> Update weekly stream </h3>
                  <div class="btn btn-danger btn-lg btn-block" v-on:click="cancel_editweekly">Never mind </div>

                  <form>

                    <input type="hidden" id="editweekly_id">

                    <div class="form-group">
                      <label for="editweekly_title">Name</label>
                      <input type="text" class="form-control" id="editweekly_title" name="editweekly_title" placeholder="Event Name">
                    </div>

                    <div class="form-group">
                      <label for="editweekly_day">Day:</label>
                      <select class="form-control" id="editweekly_day" name="editweekly_day">
                        <option value="monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                        <option value="Saturday">Saturday</option>
                        <option value="Sunday">Sunday</option>
                      </select>
                    </div>

                    <div class="form-row">
                      <div class="col">
                        <span>Start：</span>
                        <input type="time" name="editweekly_start_time" id="editweekly_start_time">
                      </div>

                      <div class="col">
                          <span>End：</span>
                          <input type="time" name="editweekly_end_time" id="editweekly_end_time">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="editweekly_tag">tag</label>
                      <input type="text" class="form-control" id="editweekly_tag" name="editweekly_tag" placeholder="idk">
                    </div>

                    <div class="form-group">
                      <label for="editweekly_game">Game:</label>
                      <select class="form-control" id="editweekly_game" name="editweekly_game">
                        <option v-for="game in games" :value="game.id">{{game.name}}</option>
                      </select>
                    </div>

                    <div id="submiteditweeklybtn" class="btn btn-danger btn-lg btn-block" v-on:click="updateweekly">Update</div>
                    <div class="alert alert-danger" role="alert" id="weekly_edit_errors" style="display:none;margin-top:1rem"></div>
                  </form>
                </div>
                <!-- end edit forms  -->

              </div>

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
          allschedules : [],
          dailystreams : [],
          weeklystreams: [],
          singlestreams : [],
          csrftoken : document.head.querySelector('meta[name="csrf-token"]').content,
          games : [],
          announcements : [],
          currentdate : [],
          errors : [],
          errormessage : [],
          streamdash: true,
  				profiledash: false,
  			  scheduledash: false,
          announcementsdash: false,

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
      });
      axios.get('/api/currentdate').then(response => {
        this.currentdate = JSON.parse(JSON.stringify(response.data));
      });
      axios.get('/api/scheduleoverview').then(response => {
        this.allschedules= JSON.parse(JSON.stringify(response.data));

        this.dailystreams = this.allschedules.filter(x => x.type == 'daily');
        this.weeklystreams = this.allschedules.filter(x => x.type == 'weekly');
        this.singlestreams = this.allschedules.filter(x => x.type == 'single');
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
            document.getElementById('schedulemsg').style.display = "block";
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
      show_form_single: function(){
        document.getElementById('addschedulebuttons').style.display = "none";
        document.getElementById('schedule_form_single').style.display = "block";
      },
      show_form_weekly: function(){
        document.getElementById('addschedulebuttons').style.display = "none";
        document.getElementById('schedule_form_weekly').style.display = "block";
      },
      show_form_daily: function(){
        document.getElementById('addschedulebuttons').style.display = "none";
        document.getElementById('schedule_form_daily').style.display = "block";
      },
      show_back:function(){
        document.getElementById('addschedulebuttons').style.display = "block";
        document.getElementById('schedule_form_single').style.display = "none";
        document.getElementById('schedule_form_weekly').style.display = "none";
        document.getElementById('schedule_form_daily').style.display = "none";
      },
      add_schedule_single: function () {
        document.getElementById('single_errors').style.display="none";
        document.getElementById('single_errors').innerHTML = "";
        axios.post('/api/addschedulesingle', {
          name: document.getElementById('single_title').value,
          start: document.getElementById('single_start').value,
          end: document.getElementById('single_end').value,
          tag: document.getElementById('single_tag').value,
          game: document.getElementById('single_game').value,
       }).then(response => {
         document.getElementById('addschedulebuttons').style.display = "block";
         document.getElementById('schedulemsg').style.display = "block";
         document.getElementById('schedulemsg').innerHTML = response.data;
         document.getElementById('schedule_form_single').style.display = "none";
         document.getElementById('schedule_form_weekly').style.display = "none";
         document.getElementById('schedule_form_daily').style.display = "none";
       }).catch(error => {
         this.error_response = JSON.parse(JSON.stringify(error.response.data));
         this.errors = this.error_response.errors;
         console.log(this.errors);
         this.errormessage = [];
         if(this.errors.name) {this.errormessage.push(this.errors.name[0]+"<br>")};
         if(this.errors.start) {this.errormessage.push(this.errors.start[0]+"<br>")};
         if(this.errors.end) {this.errormessage.push(this.errors.end[0]+"<br>")};
         if(this.errors.tag) {this.errormessage.push(this.errors.tag[0]+"<br>")};
         document.getElementById('single_errors').style.display="block";
         document.getElementById('single_errors').innerHTML = this.errormessage;
       })

      },
      add_schedule_daily: function () {
        document.getElementById('daily_errors').style.display="none";
        document.getElementById('daily_errors').innerHTML = "";
        axios.post('/api/addscheduledaily', {
          name: document.getElementById('daily_title').value,
          start: document.getElementById('daily_start').value,
          end: document.getElementById('daily_end').value,
          tag: document.getElementById('daily_tag').value,
          game: document.getElementById('daily_game').value,
       }).then(response => {
         document.getElementById('addschedulebuttons').style.display = "block";
         document.getElementById('schedulemsg').style.display = "block";
         document.getElementById('schedulemsg').innerHTML = response.data;
         document.getElementById('schedule_form_single').style.display = "none";
         document.getElementById('schedule_form_weekly').style.display = "none";
         document.getElementById('schedule_form_daily').style.display = "none";
       }).catch(error => {
         this.error_response = JSON.parse(JSON.stringify(error.response.data));
         this.errors = this.error_response.errors;
         this.errormessage = [];
         if(this.errors.name) {this.errormessage.push(this.errors.name[0]+"<br>")};
         if(this.errors.start) {this.errormessage.push(this.errors.start[0]+"<br>")};
         if(this.errors.end) {this.errormessage.push(this.errors.end[0]+"<br>")};
         if(this.errors.tag) {this.errormessage.push(this.errors.tag[0]+"<br>")};
         document.getElementById('daily_errors').style.display="block";
         document.getElementById('daily_errors').innerHTML = this.errormessage;
       })
      },
      add_schedule_weekly: function () {
        document.getElementById('weekly_errors').style.display="none";
        document.getElementById('weekly_errors').innerHTML = "";
        axios.post('/api/addscheduleweekly', {
          name: document.getElementById('weekly_title').value,
          day: document.getElementById('weekly_day').value,
          start: document.getElementById('weekly_start').value,
          end: document.getElementById('weekly_end').value,
          tag: document.getElementById('weekly_tag').value,
          game: document.getElementById('weekly_game').value,
       }).then(response => {
         document.getElementById('addschedulebuttons').style.display = "block";
         document.getElementById('schedulemsg').style.display = "block";
         document.getElementById('schedulemsg').innerHTML = response.data;
         document.getElementById('schedule_form_single').style.display = "none";
         document.getElementById('schedule_form_weekly').style.display = "none";
         document.getElementById('schedule_form_daily').style.display = "none";
       }).catch(error => {
         this.error_response = JSON.parse(JSON.stringify(error.response.data));
         this.errors = this.error_response.errors;
         this.errormessage = [];
         if(this.errors.name) {this.errormessage.push(this.errors.name[0]+"<br>")};
         if(this.errors.day) {this.errormessage.push(this.errors.day[0]+"<br>")};
         if(this.errors.start) {this.errormessage.push(this.errors.start[0]+"<br>")};
         if(this.errors.end) {this.errormessage.push(this.errors.end[0]+"<br>")};
         if(this.errors.tag) {this.errormessage.push(this.errors.tag[0]+"<br>")};
         document.getElementById('weekly_errors').style.display="block";
         document.getElementById('weekly_errors').innerHTML = this.errormessage;
       })
      },
      editsingle: function(id, value){
        this.editsingletemp = JSON.parse(JSON.stringify(this.allschedules.filter(x => x.id == id)));
        document.getElementById('addschedulebuttons').style.display="none";
        document.getElementById('editsingleschedule').style.display="block";
        document.getElementById('editweeklyschedule').style.display="none";
        document.getElementById('editdailyschedule').style.display="none";
        document.getElementById('editsingle_title').value = this.editsingletemp[0].title;
        document.getElementById('editsingle_game').value = this.editsingletemp[0].game;
        document.getElementById('editsingle_tag').value = this.editsingletemp[0].tag;
        document.getElementById('editsingle_id').value = id;
      },
      updatesingle: function(){
        document.getElementById('single_edit_errors').style.display="none";
        document.getElementById('single_edit_errors').innerHTML = "";
        axios.post('/api/editschedulesingle', {
          id:document.getElementById('editsingle_id').value,
          name: document.getElementById('editsingle_title').value,
          start: document.getElementById('editsingle_start_date').value,
          end: document.getElementById('editsingle_end_date').value,
          tag: document.getElementById('editsingle_tag').value,
          game: document.getElementById('editsingle_game').value,
       }).then(response => {
         document.getElementById('addschedulebuttons').style.display = "block";
         document.getElementById('schedulemsg').style.display = "block";
         document.getElementById('schedulemsg').innerHTML = response.data;
        document.getElementById('editsingleschedule').style.display="none";
       }).catch(error => {
         this.error_response = JSON.parse(JSON.stringify(error.response.data));
         this.errors = this.error_response.errors;
         this.errormessage = [];
         if(this.errors.name) {this.errormessage.push(this.errors.name[0]+"<br>")};
         if(this.errors.start) {this.errormessage.push(this.errors.start[0]+"<br>")};
         if(this.errors.end) {this.errormessage.push(this.errors.end[0]+"<br>")};
         if(this.errors.tag) {this.errormessage.push(this.errors.tag[0]+"<br>")};
         if(this.errors.game) {this.errormessage.push(this.errors.game[0]+"<br>")};
         document.getElementById('single_edit_errors').style.display="block";
         document.getElementById('single_edit_errors').innerHTML = this.errormessage;
       })
     },
      editdaily: function(id, value){
        this.editdailytemp = JSON.parse(JSON.stringify(this.allschedules.filter(x => x.id == id)));
        document.getElementById('addschedulebuttons').style.display="none";
        document.getElementById('editsingleschedule').style.display="none";
        document.getElementById('editdailyschedule').style.display="block";
        document.getElementById('editweeklyschedule').style.display="none";
        document.getElementById('editdaily_title').value = this.editdailytemp[0].title;
        document.getElementById('editdaily_start_time').value = this.editdailytemp[0].start_time;
        document.getElementById('editdaily_end_time').value = this.editdailytemp[0].end_time;
        document.getElementById('editdaily_game').value = this.editdailytemp[0].game;
        document.getElementById('editdaily_tag').value = this.editdailytemp[0].tag;
        document.getElementById('editdaily_id').value = id;
      },
      updatedaily: function(){
        document.getElementById('daily_edit_errors').style.display="none";
        document.getElementById('daily_edit_errors').innerHTML = "";
        axios.post('/api/editscheduledaily', {
          id:document.getElementById('editdaily_id').value,
          name: document.getElementById('editdaily_title').value,
          start: document.getElementById('editdaily_start_time').value,
          end: document.getElementById('editdaily_end_time').value,
          tag: document.getElementById('editdaily_tag').value,
          game: document.getElementById('editdaily_game').value,
       }).then(response => {
         document.getElementById('addschedulebuttons').style.display = "block";
         document.getElementById('schedulemsg').style.display = "block";
         document.getElementById('schedulemsg').innerHTML = response.data;
         document.getElementById('schedule_form_single').style.display = "none";
         document.getElementById('schedule_form_weekly').style.display = "none";
         document.getElementById('editdailyschedule').style.display="none";
       }).catch(error => {
         this.error_response = JSON.parse(JSON.stringify(error.response.data));
         this.errors = this.error_response.errors;
         this.errormessage = [];
         if(this.errors.name) {this.errormessage.push(this.errors.name[0]+"<br>")};
         if(this.errors.start) {this.errormessage.push(this.errors.start[0]+"<br>")};
         if(this.errors.end) {this.errormessage.push(this.errors.end[0]+"<br>")};
         if(this.errors.tag) {this.errormessage.push(this.errors.tag[0]+"<br>")};
         if(this.errors.game) {this.errormessage.push(this.errors.game[0]+"<br>")};
         document.getElementById('daily_edit_errors').style.display="block";
         document.getElementById('daily_edit_errors').innerHTML = this.errormessage;
       })
     },
      editweekly: function(id,value){
        this.editweeklytemp = JSON.parse(JSON.stringify(this.allschedules.filter(x => x.id == id)));
        document.getElementById('addschedulebuttons').style.display="none";
        document.getElementById('editsingleschedule').style.display="none";
        document.getElementById('editdailyschedule').style.display="none";
        document.getElementById('editweeklyschedule').style.display="block";
        document.getElementById('editweekly_title').value = this.editweeklytemp[0].title;
        document.getElementById('editweekly_day').value = this.editweeklytemp[0].day;
        document.getElementById('editweekly_start_time').value = this.editweeklytemp[0].start_time;
        document.getElementById('editweekly_end_time').value = this.editweeklytemp[0].end_time;
        document.getElementById('editweekly_game').value = this.editweeklytemp[0].game;
        document.getElementById('editweekly_tag').value = this.editweeklytemp[0].tag;
        document.getElementById('editweekly_id').value = id;
      },
      updateweekly: function(){
        document.getElementById('weekly_edit_errors').style.display="none";
        document.getElementById('weekly_edit_errors').innerHTML = "";
        axios.post('/api/editscheduleweekly', {
          weekly_id: document.getElementById('editweekly_id').value,
          weekly_title: document.getElementById('editweekly_title').value,
          weekly_day: document.getElementById('editweekly_day').value,
          weekly_start: document.getElementById('editweekly_start_time').value,
          weekly_end: document.getElementById('editweekly_end_time').value,
          weekly_tag: document.getElementById('editweekly_tag').value,
          weekly_game: document.getElementById('editweekly_game').value,
       }).then(response => {
         document.getElementById('addschedulebuttons').style.display = "block";
         document.getElementById('schedulemsg').style.display = "block";
         document.getElementById('schedulemsg').innerHTML = response.data;
         document.getElementById('editweeklyschedule').style.display="none";
       }).catch(error => {
         this.error_response = JSON.parse(JSON.stringify(error.response.data));
         this.errors = this.error_response.errors;
         this.errormessage = [];
         if(this.errors.name) {this.errormessage.push(this.errors.name[0]+"<br>")};
         if(this.errors.day) {this.errormessage.push(this.errors.day[0]+"<br>")};
         if(this.errors.start) {this.errormessage.push(this.errors.start[0]+"<br>")};
         if(this.errors.end) {this.errormessage.push(this.errors.end[0]+"<br>")};
         if(this.errors.tag) {this.errormessage.push(this.errors.tag[0]+"<br>")};
         if(this.errors.game) {this.errormessage.push(this.errors.game[0]+"<br>")};
         document.getElementById('weekly_edit_errors').style.display="block";
         document.getElementById('weekly_edit_errors').innerHTML = this.errormessage;
       })
     },
      cancel_editsingle: function() {
        document.getElementById('editsingleschedule').style.display="none";
        document.getElementById('addschedulebuttons').style.display="block";
			},
      cancel_editdaily: function() {
        document.getElementById('editdailyschedule').style.display="none";
        document.getElementById('addschedulebuttons').style.display="block";
			},
      cancel_editweekly: function() {
			  document.getElementById('editweeklyschedule').style.display="none";
        document.getElementById('addschedulebuttons').style.display="block";
			},
      delete_schedule: function(id,value) {
        console.log(id);
        axios.post('/api/deleteschedule', {
          delete_id: id,
         }).then(response => {
           document.getElementById('addschedulebuttons').style.display = "block";
           document.getElementById('schedulemsg').style.display = "block";
           document.getElementById('schedulemsg').innerHTML = response.data;
           document.getElementById('editweeklyschedule').style.display="none";
  			});
      },
      showstreamdash: function() {
				this.streamdash = true;
				this.profiledash = false;
        this.scheduledash = false;
        this.announcementsdash = false;
			},
			showprofiledash: function() {
				this.streamdash = false;
				this.profiledash = true;
        this.scheduledash = false;
        this.announcementsdash = false;
			},
			showchanneldash: function() {
				this.streamdash = false;
				this.profiledash = false;
        this.scheduledash = false;
        this.announcementsdash = false;
			},
      showannouncementdash: function() {
        this.streamdash = false;
        this.profiledash = false;
        this.announcementsdash = true;
        this.scheduledash = false;
        axios.get('/api/personalannouncements').then((response) => {
          this.announcements = response.data;
        })
      },
      showscheduledash: function() {
        this.streamdash = false;
        this.profiledash = false;
        this.scheduledash = true;
        this.announcementsdash = false;
			}

    }
  }

</script>
