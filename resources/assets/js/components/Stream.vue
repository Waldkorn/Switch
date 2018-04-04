<template>

	<div class="col-md-9 pl-1 pt-1" style="overflow-y:scroll;">

		<div class="card" v-bind:class="{ 'bg-dark': darkmode }">
			<div class="card-header">
			    <ul class="nav nav-tabs card-header-tabs">
			        <li class="nav-item px-1" v-on:click="showstream" v-bind:class="{ 'bg-dark': darkmode }">
			        	<a class="nav-link active" href="#" v-bind:class="{ 'bg-secondary': darkmode, 'border-secondary': darkmode }">{{ streamer.name}}</a>
			        </li>
			    	<li class="nav-item px-1" v-on:click="showviewers" v-bind:class="{ 'bg-dark': darkmode }">
			        	<a class="nav-link active" href="#" v-bind:class="{ 'bg-secondary': darkmode, 'border-secondary': darkmode }">viewers <small class="text-muted">{{ viewers.length }}</small></a>
			        </li>
			        <li class="nav-item px-1" v-on:click="showfollowers" v-bind:class="{ 'bg-dark': darkmode }">
			        	<a class="nav-link active" href="#" v-bind:class="{ 'bg-secondary': darkmode, 'border-secondary': darkmode }">followers <small class="text-muted">{{ followers.length }}</small></a>
			        </li>
			        <li class="ml-auto">
				        <button type="button" class="btn btn-dark" v-on:click="toggleDarkMode">Dark mode</button>
				    </li>
			    </ul>
			</div>
			<div v-show="watchstream">
				<div class="card-body" v-if="streamer.now_live">
				 	<video id="vid1" class="video-js" controls preload="auto" data-setup='{ "aspectRatio": "16:9" }'>
				    	<source :src="'http://10.0.0.61:8080/hls/' + streamer.stream_token + '.m3u8'" type='application/x-mpegURL'>
					    <p class="vjs-no-js">
					    	To view this video please enable JavaScript, and consider upgrading to a web browser that
					    	<a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
					    </p>
					</video>
				</div>
				<div class="card-body" style="text-align:center" v-else>
				 	<img src="/images/offline.png" alt="streamer offline" style="width:85%">
				</div>
			</div>
			<div v-show="watchviewers">
				<div class="card-body">
					<h1>
						Watching now
					</h1>
					<div class="list-group">
						<div class="list-group-item" v-for="viewer in viewers" v-bind:class="{ 'bg-secondary': darkmode, 'border-secondary': darkmode }">
							<a :href="'/profilepage/' + viewer.name">{{viewer.name}}</a>
						</div>
					</div>				
				</div>
			</div>
			<div v-show="watchfollowers">
				<div class="card-body">
					<h1>
						{{ streamer.name }}'s followers
					</h1>
					<div class="list-group">
						<div class="list-group-item" v-for="follower in followers" v-bind:class="{ 'bg-secondary': darkmode, 'border-secondary': darkmode }">
							<a :href="'/profilepage/' + follower.name">{{follower.name}}</a>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

</template>

<script>
	export default {
		name: 'stream',
		props: ['streamer', 'followers', 'viewers', 'darkmode'],
		data: function() {
			return {
				watchstream: true,
				watchviewers: false,
				watchfollowers: false
			}
		},
		methods: {
			showstream: function() {
				this.watchstream = true;
				this.watchviewers = false;
				this.watchfollowers = false;
			},
			showviewers: function() {
				this.watchstream = false;
				this.watchviewers = true;
				this.watchfollowers = false;
			},
			showfollowers: function() {
				this.watchstream = false;
				this.watchviewers = false;
				this.watchfollowers = true;
			},
			toggleDarkMode: function() {
				this.$emit('darkmode');
			}
		}
	}
</script>
