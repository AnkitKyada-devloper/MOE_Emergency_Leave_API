<!DOCTYPE html>
<html>
<head>
<base target="_top">
</head>
<body>
        <div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
        <div style="margin:50px auto;width:80%;padding:20px 0">
        <div style="border-bottom:5px solid #eee">
</div>

        <h1>{{$maildetails['Subject'] }}</h1>
        <p style="font-size:15px">Hello {{$maildetails['username'] }}</p>
        <p>Use this pin to complete your Log in procedures and verify your account on MOE Leave App.</p>
        <p>Remember, Never share this pin with anyone.</p>
        <p>This pin is valid for 5 minutes only.</p>
        <h2 style="background: #00466a;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;">{{$maildetails['body'] }}</h2>
        <p style="font-size:15px;">Regards,<br />Team openeyes</p>
        <hr style="border:none;border-top:5px solid #eee" />
        <div style="float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300">
</div>
</div>
</div>
</body>
</html>