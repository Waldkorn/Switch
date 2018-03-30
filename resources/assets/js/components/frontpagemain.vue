<template>
  <div class="col-md-5 pt-1" >

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
</template>

<script>
	export default {
    data:function(){
      return{
        announcements : [],
        profiledetails : []
      }
    },
    mounted() {
      axios.get('/api/announcements').then(response => {
        this.announcements = response.data;
        console.log(this.announcements);
        for (var i = 0 ; i < this.announcements.length ; i++)
        {
        	this.profiledetails[this.announcements[i].user.name] = this.announcements[i].user.profilecontent;
        }
        console.log(this.profiledetails);
      })
    }
  }
</script>
