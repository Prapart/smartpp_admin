<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP & JSON</title>




</head>
<body>
    <div id="result"></div>
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous">
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $.ajax({
            url:'action.php',
            type:'GET',
            success:function(response){
                var data = JSON.parse(response);
                for (i in data){
                    $("#result").append("<h2>" + data[i].node_name + "</h2>");
                }
              
            }
        });
    });

</script>
  
</body>
</html>