<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Twitter лента</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Twitter лента</h1>

                <div class="tweets"></div>

            </div>
        </div>
    </div>
    
    <!-- JQuery -->
    <script type="text/javascript" src="vendor/components/jquery/jquery.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script>
        function getTweets25(){
            var url = "getTweets.php";
            $.get(
                url,
                "do=getTweets25",
                function (result) {
                    if (result.type == "success") {
                        $('.tweets').html(result.tweets);
                    } else {
                        return false;
                    }
                },
            "json"
            );
        }
        getTweets25();
        /*опрашиваем раз в 1 минуту - ограничения Тивттера на запросы*/
        var timerId = setInterval(function() {
          getTweets25();
        }, 60000);
    </script>
</body>
</html>
