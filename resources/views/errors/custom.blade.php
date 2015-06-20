<html>
<head>
    <title>{{{$content or "Error : "}}}</title>
    <meta charset="utf-8">
    <link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
    <style>
        body {margin: 0;padding: 0;width: 100%;height: 100%;color: #B0BEC5;display: table;font-weight: 100;font-family: 'trebuchet ms', verdana, arial;}
        .container {text-align: center;display: table-cell;vertical-align: middle;}
        .content {text-align: center;display: inline-block;}
        .title{font-size: 60px;font-family: 'Lato';color:red;}
        .title2{font-size: 30px;margin-bottom: 40px;font-family: 'Lato';color:darkred;}
        .spy{color:#222;font-weight: normal;margin-top: 200px;}
    </style>
</head>
<body>
<div class="container">
    <div class="content">
        <div class="title">{{{$content or ""}}}</div>
        <div class="title2">{{{$content2 or ""}}}</div>

        <div class="spy">{{trans('app.app_desc')}}</div>
    </div>
</div>
</body>
</html>
