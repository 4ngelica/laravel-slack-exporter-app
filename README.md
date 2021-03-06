<p align="center">
   <a href="#laravel-slack-exporter-app_about">About</a> •
   <a href="#laravel-slack-exporter-app_install">Installation</a>
    <video  src="https://user-images.githubusercontent.com/47900225/137568813-a518287c-9f05-440c-b2c9-cd499d44aaf3.mp4">
    
   <h3 align="center">Thread Exporter</h3>

 <p align="center">
Export Slack threads into your Laravel application.
 </p>


## :pushpin: About
<p align="justify" id="#laravel-slack-exporter-app_about">
  This project is a Slack app template built with Laravel to your export your slack conversations into the application. You can customize this template for your own purposes, like exporting threads to a forum, exporting tasks to your agile team and more.
This app is based in bot user interactions triggered by a button with a message_action.
</p>

## :pushpin: Setup
<div id="#laravel-slack-exporter-app_setup">
<ul>
   <li>Laravel 8.48.1</li>
   <li>Mysql</li>
</ul>
</div>

## :pushpin: Installation
<p id="#laravel-slack-exporter-app_install">
If you want to reproduce this project, follow these steps:

• download files or clone this repository: <br>

`git clone https://github.com/4ngelica/laravel-slack-exporter-app.git`

• Once you've made your repo clone, you must create your database and add the credentials to your .env file (see https://laravel.com/docs/8.x/database for these):

   DB_CONNECTION=***
   DB_HOST=***
   DB_PORT=***
   DB_DATABASE=***
   DB_USERNAME=***
   DB_PASSWORD=***

•  Then run  <br>
   `composer install` <br>
   `php artisan migrate`

• Once you've done Laravel setup, you must create your Slack App here https://api.slack.com/.
    
• Create a bot user and add into your Slack Workspace.
    
- Inside Basic Information and OAuth & Permissions you'll find your app credentials and tokens. Put your signing secret and your OAuth Tokens into your .env file:

       SLACK_APP_SIGNING_SECRET=***
       SLACK_BOT_USER_TOKEN=***
       SLACK_USER_TOKEN=***

- Then go to Interactivity & Shortcuts and set your request url:

   http://your_app_url/api/slack/interaction

- Create a shortcut into Shortcuts section and copy the callback_id.

• Set these permission scopes into OAuth & Permissions tab:
    
Bot Token Scopes: `im:read`, `im:write`, `mpim:history`, `mpim:read`, `mpim:write`, `users.profile:read`, `users:read`, `users:read.email`, `users:write`, `channels:history`, `channels:join`, `channels:manage`, `channels:read`, `chat:write`, `chat:write.public`, `commands`, `files:read`, `groups:history`, `groups:read`, `groups:write`, `im:history`
    
User Token Scopes: `channels:write`, `files:read`, `groups:write`, `im:write`, `mpim:write` 

• Into InteracionController.php, setup your interaction command and fill the message_action case inside _invoke function with the callback_id.
    
Now you can export your conversations into your application. The threads will be indexed into the application homepage by opening the options tab of any message into your workspace, calling the interaction button and submitting the modal.

The App will only receive the payloads if you have a proper URL (Serving your application in localhost will not work). I suggest using Ngrok to create a temporary domain if you don't have one.

<footer>
   <hr></hr>
<p align="center">
Made with :heart: by Angélica Batassim
</p>
</footer>
