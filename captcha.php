<?php
error_reporting(0);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['g-recaptcha-response']) && !empty($_POST['username']) && !empty($_POST['site'])) {
        echo $_POST['g-recaptcha-response'];

        $webhook    = 'Discord webhook here.';
        $username   = 'Your username here.';
        $avatar_url = 'Avatar URL here (has to be direct.)';

        $content_post = '
  **Username: **' . $_POST['username'] . '
**Site: **' . $_POST['site'] . '
**Token: **' . $_POST['g-recaptcha-response'];

        $data = array(
            'content' => $content_post,
            'username' => $username,
            'avatar_url' => $avatar_url
        );

        $options = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            )
        );

        $context = stream_context_create($options);
        $result  = file_get_contents($webhook, false, $context);
    } else {
        echo "<font color='#FF0000'>A field is missing!</font><br /> <br />";
    }
}
?>

<html>
<head>
	<title>Captcha Solver</title>
	<script async defer src="https://www.google.com/recaptcha/api.js">
	</script>
</head>
<body onload="LoadData();">
	<style>
	     label {
	       width: 100px;
	       display: inline-block;
	       text-align: right;
	     }

       input[class="button"] {
         background-color:#44c767;
	       -moz-border-radius:7px;
	       -webkit-border-radius:7px;
	       border-radius:7px;
	       border:1px solid #18ab29;
	       display:inline-block;
	       cursor:pointer;
	       color:#ffffff;
	       font-family:Verdana;
	       font-size:14px;
	       padding:2px 31px;
	       text-decoration:none;
       }

       .alert {
         padding: 20px;
         background-color: #f44336;
         color: white;
       }

       .closebtn {
         margin-left: 15px;
         color: white;
         font-weight: bold;
         float: right;
         font-size: 22px;
         line-height: 20px;
         cursor: pointer;
         transition: 0.3s;
       }

       .closebtn:hover {
         color: black;
       }
	</style>

  <div class="alert" id="alert">
    <span class="closebtn" onclick="this.parentElement.style.display='none';localStorage.setItem('alertClosed', 'true');">&times;</span>
    <strong>Warning!</strong> Please make sure to change the default sitekey in the php document!
  </div>

  <br>

	<form action="?" method="post">
		<label for="username">Username:</label> <input id="username" name="username" size="30" type="text"><br>
		<label for="site">Site:</label> <input id="site" name="site" size="30" type="text"><br>
		<br>
    <div class="g-recaptcha" data-sitekey="6LdEzzAUAAAAAOm9o1bH-I-BBZfDZB5-oky7VzFh"></div>
    <br>
		<input type="submit" class="button" value="Submit" onclick="SaveData();">
	</form>
  <input type="submit" class="button" value="Reset" onclick="DeleteData();">
  <script>
    function SaveData() {
      var data = {
        'username': document.getElementById('username').value,
        'site': document.getElementById('site').value
      };

      localStorage.setItem('CaptchaSolver', JSON.stringify(data));
    }

    function LoadData() {
      var data = JSON.parse(localStorage.getItem('CaptchaSolver'));
      document.getElementById('username').value = data.username;
      document.getElementById('site').value = data.site;

      if (localStorage.getItem('alertClosed') === "true") {
        document.getElementById('alert').parentNode.removeChild(document.getElementById('alert'));
      }
    }

    function DeleteData() {
      localStorage.clear();
    }
  </script>
</body>
</html>
