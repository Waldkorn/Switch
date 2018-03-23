<template>

	<div class="col-md-9 pl-1 pt-1" style="overflow-y:scroll;">

		<div class="card">
			<div class="card-header">
			    <ul class="nav nav-tabs card-header-tabs">
			        <li class="nav-item px-1">
			        	<a class="nav-link active" href="#">{{ streamer.name}}</a>
			        </li>
			    	<li class="nav-item px-1">
			        	<a class="nav-link active" href="#">viewers <small class="text-muted">{{ viewers.length }}</small></a>
			        </li>
			        <li class="nav-item px-1">
			        	<a class="nav-link active" href="#">followers <small class="text-muted">{{ followercount }}</small></a>
			        </li>
			    </ul>
			</div>
			<div class="card-body">
			 	<video id="vid1" class="video-js" controls preload="auto" data-setup='{ "aspectRatio": "16:9" }'>
			    	<source src="http://10.0.0.61:8080/hls/" + streamer.stream_token + ".m3u8" type='application/x-mpegURL'>
				    <p class="vjs-no-js">
				    	To view this video please enable JavaScript, and consider upgrading to a web browser that
				    	<a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
				    </p>
				</video>
			 </div>
		</div>

	</div>

</template>

<script>
	export default {
		name: 'stream',
		props: ['streamer', 'followercount', 'viewers']
	}

</script>