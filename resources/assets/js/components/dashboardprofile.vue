<template>
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
                <form  enctype="multipart/form-data">
                   <input type="hidden" name="_token" id="csrf-token" :value="csrftoken" />

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

    <div class="col-3">

    </div>


    <div class="col-3">

    </div>
  </div>

</template>
<script>

export default {


    data:function(){
      return{
          user : [],
          profilecontent : [],
          csrftoken : document.head.querySelector('meta[name="csrf-token"]').content,
      }
    },

    mounted() {
      axios.get('/api/user').then(response => {
        this.user = response.data;

      });

      axios.get('/api/profilecontent').then(response => {
        this.profilecontent = JSON.parse(JSON.stringify(response.data));
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
      uploadimage: function() {
        var formData = new FormData();
        formData.append("profileimage", document.getElementById('profileimage').files[0]);
        axios.post('/api/uploadimage' , formData, { headers: {'Content-Type': 'multipart/form-data' }}).then(response => {
        console.log('file sent');
       })
      },
    }
  }
</script>
