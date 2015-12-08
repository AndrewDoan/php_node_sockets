<?php 
  require_once('connection.php');

  function randomNumber(){
    $num = rand(1,10000000);
    return $num;
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Chatroom</title>
  <style type="text/css">
    .voffset  { margin-top: 2px; }
    .voffset1 { margin-top: 5px; }
    .voffset2 { margin-top: 10px; }
    .voffset3 { margin-top: 15px; }
    .voffset4 { margin-top: 30px; }
    .voffset5 { margin-top: 40px; }
    .voffset6 { margin-top: 60px; }
    .voffset7 { margin-top: 80px; }
    .voffset8 { margin-top: 100px; }
    .voffset9 { margin-top: 150px; }
    .container{
      /*border: 1px solid silver;*/
      padding:20px;
    }
    .chat_window{
      height:450px;
      overflow-y: auto;
      border: 1px solid silver;
      padding-left:20px;
      /*overflow:hidden;*/
    }

    .input_text{
      width:100%;
    }
    textarea{
      resize:none;
    }
    .user_event{
      font-style: italic;
    }
  </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <script src="node_modules/socket.io/node_modules/socket.io-client/socket.io.js"></script>

  <script>
      function randomMessage(data){
          <?php 
            $random = randomNumber();
            $user_query = "SELECT full_name FROM users where id = $random limit 1";
            $users = fetch($user_query);
            foreach ($users as $key => $user) {
              $name = $user;
            }
          ?>
          var random = "<?=$name?>";
          $("#chat_box").append("<p>" + random + ": " + data.message + "</p>");
      }
    $(document).ready(function(){
      var socket = io.connect('http://localhost:5000');
      var name = prompt("What is your name?");

      socket.emit("test", {name: name});

      socket.on("message", function(data){
        randomMessage(data);
      })

    })
  </script>
</head>
<body>
  <div class="container">
    <div class="row">
      <h3>Chatroom</h3>
    </div>
    <div class="row">
      <div class="col-xs-7">
        <div class="chat_window" id="chat_box">

        </div>
        <textarea class = "input_text" rows="2" id="message"></textarea>
        <button class="btn btn-primary btn-xs pull-right" id="chat_submit">Enter</button>
      </div>
      <div class="col-xs-3 col-xs-offset-1">

      </div>
    </div><!--  End row -->
  </div>
</body>
</html>