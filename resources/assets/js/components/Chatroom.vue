<template>
    <div class="chatroom pt-1 pb-1 px-1">

        <div class="chatbox">

        </div>

        <div class="chatfield">

        </div>

    </div>
</template>

<script>
    export default {
        mounted() {

            var viewportHeight = document.getElementById('container').clientHeight;
            var navbarHeight = document.getElementById('navbar').clientHeight;
            document.getElementById('main').style.minHeight = viewportHeight - navbarHeight + "px";

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

    }

    .chatbox {

        width: 100%;
        height: 90%;

        float: left;

        border-style: solid;
        border-width: thin;
        border-color: black;

    }

    .chatfield {

        width: 100%;
        height: 10%;

        float: left;

        border-style: solid;
        border-width: thin;
        border-color: black;

    }



</style>