<template>
  <div class="col-md-5 pt-1" >
    <div class="card mb-2">
      <div class="card-body bg-dark" style="color:rgb(245, 245, 220);padding:0px">

        <h3 class="card-title" style="margin:20px"> Upcoming streams </h3>
        <hr>
        <table class="table table-dark" style="margin:0px;background-color:#343a40">
          <thead>
            <tr>
              <th scope="col">Who?</th>
              <th scope="col">What?</th>
              <th scope="col">When?</th>
              <th scope="col">starts in</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="upcomingstream in upcomingstreams" :class="upcomingstream.class">
              <th scope="row"> <a :href="'/profilepage/' + upcomingstream.streamer" style="color:#dc3545;"><strong>{{upcomingstream.streamer}}</strong></a> </th>
              <td>{{upcomingstream.game_name}}</td>
              <td>{{upcomingstream.start_time}}</td>
              <td>{{upcomingstream.starts_in}}</td>
            </tr>
          </tbody>
        </table>

      </div>
    </div>

    <div class="card mb-2" v-for="announcement in announcements">
    	<div class="card-body bg-dark" style="color:rgb(245, 245, 220);">
    		<div class="card-title">
    			<img height="32px" :src=announcement.user.profilecontent.img_url><span><a :href="'/profilepage/' + announcement.user.name" style="color:#dc3545;"><h3 class="ml-2" style="display:inline">{{announcement.user.name}}</h3></a><br><h5 class="pt-1">{{ announcement.title }}</h5></span>
    		</div>
    		<hr>
    		<div class="card-text">
    			{{ announcement.message }}
          <hr>

          <a class="btn btn-danger float-right mr-1 mb-1" data-toggle="collapse" :href="'#comments' + announcement.id" role="button" aria-expanded="false" :aria-controls="'comments' + announcement.id" v-show="announcement.comments_count != 0" onclick="this.style.display='none'">{{ announcement.comments_count }} comments</a>
          <div :id="'comments' + announcement.id" class="collapse">
            <div class="card bg-secondary m-1" v-for="comment in announcement.comments">
              <div class="card-body p-2">
                <h6 class="card-title px-2"><span style="color:#dc3545;">{{ comment.user.name }}</span> wrote:</h6>
                <p class="card-text text-right px-3">{{ comment.body }}</p>
              </div>
            </div>
          </div>

          <div class="form-group">
            <input type="text" :id="'commentfield' + announcement.id" placeholder="leave your comment..." class="form-control" style="background-color:rgb(245, 245, 220);"
            v-on:keyup.enter="postComment(announcement.id)">
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
        announcements : [],
        upcomingstreams : [],
      }
    },
    mounted() {
      axios.get('/api/announcements').then(response => {
        this.announcements = response.data;
      });
      axios.get('/api/upcomingstreams').then(response => {
        this.upcomingstreams = JSON.parse(JSON.stringify(response.data));
      })
    },
    methods: {
      postComment : function(number)
      {
        let message = document.getElementById("commentfield" + number).value
        axios.post("/api/comment/" + number + "/create", {
          body: message
        }).then((response) => {
          this.announcements.find(announcement => announcement.id === number).comments.push(response.data);
          this.announcements.find(announcement => announcement.id === number).comments_count++;
        });
        document.getElementById("commentfield" + number).value = "";
        return false;
      }
    }
  }

</script>
