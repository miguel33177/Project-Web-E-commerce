<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
</head>
<body>
    <h3>{{ $title }}</h3>

        <p>Dear Customer,</p>
       <p> Hello, <b>{{$from_name}} </b> has sent you a new message on your account. Please log in to your account to view the message.</p>
       <p> Message: <b >{{$messages}}</b></p>
       <p> Sincerely, <b style="color: red;">BMN SHOP</b></p>
</body>
</html>