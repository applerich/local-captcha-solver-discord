# Local Captcha Solver
A local captcha solver that can send the token to a Discord webhook.

# How to use
1. Clone this repository/download the captcha.php file.
2. Make sure to have [WAMP](http://www.wampserver.com/en/) or [XXAMP](https://www.apachefriends.org/index.html) or equivalent setup.
3. Copy and paste the captcha.php file into your server.
4. Go to the URL in a web browser to check that it's working.

# Configuration
1. Change the ```$webhook```variable value to your Discord's webhook.
2. Change ```$username``` to the bot's username that you want.
3. Change the ```$avatar_url``` to the direct URL of an image.
4. Scroll down to the site key field (line 101) and change the value to the appropriate site key.

# Features
- Discord web hook support
- Save username and site title  (local storage)
- Easy captcha solving

# Future Plans
- To add Slack/Twitter support
- Fix up the UI
- Set the sitekey from the web page
