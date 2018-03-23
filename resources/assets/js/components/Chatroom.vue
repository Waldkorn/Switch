<template>
    <div class="chatroom pt-1 pb-1 px-1">

        <div id="chatbox" class="chatbox" style="overflow-y:scroll;">
            <div class="chatmessages card mx-1 my-1 py-1 px-1" v-for="message in messages">
                <div class="card-text" style="margin-bottom: -15px;">
                    {{ streamer.title }}
                    <p>
                        <b v-bind:style="'color:' + activeUsers[ message.user.name ]">{{ message.user.name }}:</b>

                        {{ message.message }}
                    </p>
                </div>
            </div>
        </div>

        <div id="chatfield" class="chatfield">

            <input type="text" class="form-control mt-auto mb-auto" v-on:keydown.enter="createChatMessage" id="messageField" v-if="loggedIn" style="height: 100%;">

            <input disabled v-else class="form-control mt-auto mb-auto" value="Please log in to chat" style="height:100%;">

        </div>

    </div>
</template>

<script>
    export default {
        name: 'chatbox',
        data: function() {
            return {
                messages : [],
                highestid : 0,
                activeUsers : [],
                colors: ["Blue", "Coral", "DodgerBlue", "SpringGreen", "YellowGreen", "Green", "OrangeRed", "Red", "GoldenRod", "HotPink", "CadetBlue", "SeaGreen", "Chocolate", "BlueViolet", "Firebrick"],
                index: 0,
                loggedIn: false
            }
        },
        props: [ 'user', 'streamer', 'viewers' ],
        mounted() {

            var viewportHeight = document.getElementById('container').clientHeight;
            var navbarHeight = document.getElementById('navbar').clientHeight;
            document.getElementById('main').style.minHeight = viewportHeight - navbarHeight + "px";
            document.getElementById('main').style.maxHeight = viewportHeight - navbarHeight + "px";

            this.listen();

            if (this.user != undefined) {
                this.loggedIn = true;
            } else {
                document.getElementById('chatfield').style.backgroundColor = "lightgray";
            }                       

            Echo.join('StreamPresence.' + this.streamer.stream.id)
            .here((users) => {
                // this.viewers = users;
                this.$emit('user-list', users);
            })
            .joining((user) => {
                // this.viewers.push(JSON.parse(JSON.stringify(user)));
                this.$emit('user-joined', user);
            })
            .leaving((user) => {
                // for (var i = 0 ; i < viewers.length ; i++) {
                //     if(viewers[i].id == user.id) {
                //         viewers.splice(i, 1);
                //     }
                // }
                this.$emit('user-left', user);
            })
        },
        methods: {
            createChatMessage : function(message) {
                axios.post('/api/chatmessages/create', {
                    user_id: this.user.id,
                    chat_id: this.streamer.stream.id,
                    message: document.getElementById('messageField').value
                })
                document.getElementById('messageField').value = "";
            },
            assignColorToUsers : function(data) {
                if (!(data.user.name in this.activeUsers))
                {
                    this.activeUsers[data.user.name] = this.colors[this.index];
                    this.index++;
                    if (this.index == this.colors.length) {
                        this.index = 0;
                    }
                }
            },
            listen() {
                Echo.channel('stream.' + this.streamer.stream.id)
                    .listen('NewChatmessage', (chatmessage) => {
                        this.assignColorToUsers(chatmessage);
                        this.messages = this.messages.concat(chatmessage);
                    })
            }
        },
        updated: function() {
            this.$nextTick( function() {
                var div = document.getElementById("chatbox");
                div.scrollTop = div.scrollHeight - div.clientHeight;
            })
        }


    }
</script>

<style>

    .chatroom {

        width: 100%;
        height: 100%;

        border-left-style: solid;
        border-left-width: thin;
        border-color: black;

        overflow: hidden;

    }

    .chatbox {

        width: 100%;
        height: 90%;

    }

    .chatfield {

        width: 100%;
        height: 10%;

        border-style: solid;
        border-width: thin;
        border-color: black;

    }

    .chatmessages {

        border-style: solid;
        border-width: thin;
        border-color: black;
        border-radius: 2px;

    }

</style>
