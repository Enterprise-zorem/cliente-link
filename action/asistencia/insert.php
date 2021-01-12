<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <input type="text" id="ip" name="ip">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
        $.getJSON("https://api.ipify.org/?format=json", function(e) {
        console.log(e.ip);
            $("#ip").val(e.ip);

        });
    </script>
</body>
</html>