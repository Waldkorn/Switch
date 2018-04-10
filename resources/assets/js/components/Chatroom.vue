<template>
    <div class="chatroom pt-1 pb-1 px-1" v-bind:class="{ 'bg-dark': darkmode, 'bg-secondary': darkmode }">

        <div id="chatbox" class="chatbox" style="overflow-y:scroll;" v-bind:class="{ 'bg-dark': darkmode, 'border-secondary': darkmode }">
            <div class="chatmessages card mx-1 my-1 py-1 px-1" v-for="message in messages" v-bind:class="{ 'bg-secondary': darkmode, 'border-secondary': darkmode }">
                <div class="card-text" style="margin-bottom: -15px;">
                    {{ streamer.title }}
                    <p>
                        <b v-bind:style="'color:' + activeUsers[ message.user.name ]">{{ message.user.name }}:</b>

                        <span v-html="message.message"></span>

                    </p>
                </div>
            </div>
        </div>

        <div id="chatfield" class="chatfield" >

            <input type="text" class="form-control mt-auto mb-auto" v-on:keydown.enter="createChatMessage" id="messageField" v-if="loggedIn" style="height:100%;" v-bind:class="{ 'bg-secondary': darkmode, 'border-secondary': darkmode }">

            <input disabled v-else class="form-control mt-auto mb-auto" value="Please log in to chat" style="height:100%;" v-bind:class="{ 'bg-secondary': darkmode, 'border-secondary': darkmode }">

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
                loggedIn: false,
                emotes: [ 
                    { shortcut: "smileyFace", replacement: "<img height='16px' src='/images/emoticons/smiling_face.png'>" },
                    { shortcut: "laughingFace", replacement: "<img height='16px' src=/images/emoticons/laughing_face.png>"},
                    { shortcut: "tongueFace", replacement: "<img height='16px' src='/images/emoticons/tongue_face.png'>" }
                ],
                subscriberEmotes: [
                    { shortcut: "cashEmoticon", replacement: "<img height='32px' src='/images/emoticons/cash.png'>" },
                    { shortcut: "specialEmoticon", replacement: "<img height='32px' src='/images/emoticons/special.png'>" },
                    { shortcut: "wewEmoticon", replacement: "<img height='32px' src='/images/emoticons/wew.png'>" },
                ]
            }
        },
        props: [ 'user', 'streamer', 'viewers', 'darkmode' ],
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

            Echo.join('StreamPresence.' + this.streamer.stream.id, this.streamer)
            .here((users) => {
                this.$emit('user-list', users);
            })
            .joining((user) => {
                this.$emit('user-joined', user);
            })
            .leaving((user) => {
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
                        chatmessage.message = this.expandText(chatmessage.message);
                        this.messages = this.messages.concat(chatmessage);
                    })
            },
            expandText(text){
               for (var i = 0; i < this.emotes.length; i++){
                    text = text.replace(new RegExp("\\b" + this.emotes[i].shortcut + "\\b", 'g'), this.emotes[i].replacement);
                    if (this.user.subscriber_status == "premium")
                    {
                        text = text.replace(new RegExp("\\b" + this.subscriberEmotes[i].shortcut + "\\b", 'g'), this.subscriberEmotes[i].replacement);
                    }
                }

                return text;
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
