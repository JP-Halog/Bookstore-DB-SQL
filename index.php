<!DOCTYPE html>
<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <title>JDH0102 JP Halog's Bookstore Database Interface</title>
  <style>
    body {
      background-color: #121212;
      color: #FFFFFF;
      font-family: Arial, sans-serif;
    }
    form {
      margin-top: 50px;
    }
    label {
      display: block;
      margin-bottom: 10px;
    }
    textarea {
      width: 100%;
      height: 150px;
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #FFFFFF;
      background-color: #333333;
      color: #FFFFFF;
    }
    input[type="submit"] {
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      background-color: #4CAF50;
      color: #FFFFFF;
      font-size: 16px;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <h1>JDH0102 JP Halog's Bookstore Database Interface</h1>
  <form method="post" action="execute_query.php">
    <label for="query">Enter SQL Query:</label>
    <textarea id="query" name="query" rows="4" cols="50"></textarea>
    <input type="submit" value="Submit">
  </form>
  <div id="results">
    <?php
      if (isset($_POST["query"])) {
        include "execute_query.php";
      }
    ?>
  </div>
  <script>
    $(document).ready(function(){
      $("form").on("submit", function(event){
        event.preventDefault();

        $.ajax({
          url: "execute_query.php",
          type: "post",
          data: $(this).serialize(),
          success: function(response){
            $("#results").html(response);
          }
        });
      });
    });
  </script>
</body>
</html>