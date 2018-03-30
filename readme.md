# Switch streaming platform

Switch is a streaming platform in the style of twitch.com that's being developped by Julia van Drunen and Ewout Eggens as a final project for the CodeGorilla bootcamp.

We set up a Raspberry Pi to function as a server/router between the OBS streaming software and our website (build in laravel and vuejs).


A live version can be found on: https://switch.vps.codegorilla.nl/

Our implemented user stories and planning can be found on trello: https://trello.com/b/pWdyAshY/switch

# Raspberry pi streaming server

Our streaming server is a raspberry pi 3 model B, that runs a nginx server with the [arut/nginx-rtmp-module](https://github.com/arut/nginx-rtmp-module). 

Via OBS (or other streaming software), the users can stream their content to our server. Our pi server then converts the rtmp streams  hls (and soon to be https) streams that can be accessed by our website. each user has a unique streamtoken, which is used by our website to show the right stream on the right page.

# The streaming website

Our website is build in laravel and vuejs. The video player we used is [videojs](http://videojs.com/). 

# some previews:

## Switch homepage:
![switch homepage](https://i.imgur.com/Y1VmFlG.png)

## Switch Stream page:
![switch streampage](https://i.imgur.com/H51n5zo.png)
