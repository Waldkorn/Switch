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

        <div class="chatfield">

            <input type="text" class="form-control mt-auto mb-auto" v-on:keydown.enter="createChatMessage" id="messageField" style="height: 100%;">

            </input>

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
                index: 0
            }
        },
        props: [ 'user', 'streamer' ],
        mounted() {

            var viewportHeight = document.getElementById('container').clientHeight;
            var navbarHeight = document.getElementById('navbar').clientHeight;
            document.getElementById('main').style.minHeight = viewportHeight - navbarHeight + "px";
            document.getElementById('main').style.maxHeight = viewportHeight - navbarHeight + "px";
            console.log(this.streamer);

            axios.get('/api/chatmessages/' + this.streamer.stream.id + "/0").then( response => {
                if (response.data != 0) {
                    this.highestid = response.data[response.data.length - 1].id - 5;
                }
            })

            setInterval(function() {

                axios.get('/api/chatmessages/' + this.streamer.stream.id + '/' + this.highestid).then(response => {
                    if (response.data.length != 0) {
                        this.assignColorToUsers(response.data);
                        this.messages = this.messages.concat(JSON.parse(JSON.stringify(response.data)));
                        this.highestid = this.messages[this.messages.length - 1].id;
                    }
                });

            }.bind(this), 1000);

        },
        methods: {
            createChatMessage : function(message) {
                axios.post('/api/chatmessages/create', {
                    user_id: this.user.id,
                    chat_id: 2,
                    message: document.getElementById('messageField').value
                })
                document.getElementById('messageField').value = "";
            },
            assignColorToUsers : function(data) {
                for (var i = 0 ; i < data.length ; i++) 
                {
                    if (!(data[i].user.name in this.activeUsers))
                    {
                        this.activeUsers[data[i].user.name] = this.colors[this.index];
                        this.index++;
                        if (this.index == this.colors.length) {
                            this.index = 0;
                        }
                    }
                }
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
