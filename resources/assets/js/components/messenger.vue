<template>
	<div class="messenger-main" style="width:100%;height:100%;">
		<div id="chatbox" class="bg-secondary p-2" style="height:90%;overflow-y: scroll;">
			<div v-for="message in messages" style="clear:both;">
				<div class="bg-dark float-right card d-inline-block clear-both mb-1" v-if="message.sender.id == user.id">
					<h6 class="card-title p-1 m-0 bg-dark rounded-top"><a :href="'/profilepage/' + message.sender.name">{{ message.sender.name }}</a> <small>wrote:</small></h6>
					<div class="card-body text-center rounded-bottom" style="background-color:#f5f8fa;">
						<span class="card-text">{{ message.body }}</span>
					</div>
				</div>
				<div class="bg-dark card float-left d-inline-block clear-both mb-1" v-else>
					<h6 class="card-title p-1 m-0 bg-dark rounded-top"><a :href="'/profilepage/' + message.sender.name">{{ message.sender.name }}</a> <small>wrote:</small></h6>
					<div class="card-body text-center rounded-bottom" style="background-color:#f5f8fa;">				
						<span class="card-text">{{ message.body }}</span>
					</div>
				</div>
			</div>
		</div>
		<div class="bg-dark p-3" style="height:10%;">
			<input id="inputField" v-if="messages != null" class="rounded" style="height:100%;width:100%;" v-on:keyup.enter="sendPersonalMessage" />
		</div>
	</div>
</template>

<script>

	export default {
		props: ['messages', 'user', 'chatter'],
		data: {
			channel: null,
			newChannel: false,
			unknownMessages: null
		},
		methods: {
			sendPersonalMessage : function()
			{
				let message = document.getElementById('inputField').value;
				axios.post('/api/personalmessages/create', {
					receiver_id : this.chatter,
					message : message
				}).then((response) => {
					this.messages = this.messages.concat(response.data);
				})
				document.getElementById('inputField').value = "";
			}
		},
		updated: function() {
            this.$nextTick( function() {
                var div = document.getElementById("chatbox");
                div.scrollTop = div.scrollHeight - div.clientHeight;
            });
            if (this.user.id < this.chatter)
            {
            	if (this.channel != 'messenger' + this.user.id + 'to' + this.chatter)
            	{
            		Echo.leave(this.channel);
            		this.newChannel = true;
            		this.channel = 'messenger' + this.user.id + 'to' + this.chatter;
            	}
            } else {
            	if (this.channel != 'messenger' + this.chatter + 'to' + this.user.id)
            	{
            		Echo.leave(this.channel)
            		this.newChannel = true;
            		this.channel = 'messenger' + this.chatter + 'to' + this.user.id;
            	}
            }
            if (this.newChannel == true)
            {
	            Echo.channel(this.channel)
                .listen('newPersonalMessage', (message) => {
                   	this.messages = this.messages.concat(message['message']);
                });
                this.newChannel = false;
            }
        },
        mounted() {
        	axios.get('/api/personalmessages/unknownMessages')
        	.then((response) => {
        		console.log(response.data);
        	})
        }
	}	

</script>

<style scoped>

.messenger-main {
	border-color:rgb(220, 53, 69);
}

.card {
	min-width:33%;
}

.card-title {
	color:rgb(220, 53, 69);
}

a {
	color:rgb(220, 53, 69);
}

</style>