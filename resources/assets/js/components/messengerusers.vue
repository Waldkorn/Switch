<template>
	<div>

		<div class="list-group">
			<div class="list-group-item list-group-item-secondary">Your friends</div>
			<button type="button" class="list-group-item list-group-item-action" v-for="following in followings" v-on:click="openConversationWith(following.id)">{{ following.name }}</button>
		</div>

	</div>
</template>

<script>

	export default {
		props: ['followings'],
		mounted() {
			var viewportHeight = document.documentElement.clientHeight;
            var navbarHeight = document.getElementById('navbar').clientHeight;
            document.getElementById('main').style.minHeight = viewportHeight - navbarHeight + "px";
            document.getElementById('main').style.maxHeight = viewportHeight - navbarHeight + "px";
		},
		methods: {
			openConversationWith : function(id)
			{
				axios.get('/api/personalmessages/' + id).then((response) => {
					this.$emit('new-chat-window', response.data, id);
				})
			}
		}
	}

</script>