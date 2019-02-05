<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css\app.css')}}">
    <title>Index</title>
</head>
<body style="background: white">
<div class="container-fluid">
    <div class="row mt-3 mb-3">
        <div class="col-md-1">@sortablelink('id')</div>
        <div class="col-md-2">@sortablelink('click_id')</div>
        <div class="col-md-1">@sortablelink('ip')</div>
        <div class="col-md-5">@sortablelink('user agent')</div>
        <div class="col-md-1">@sortablelink('param1')</div>
        <div class="col-md-1">@sortablelink('param2')</div>
        <div class="col-md-1">@sortablelink('error')</div>
    </div>
    @foreach ($clicks as $click)
        <div class="row border">
            <div class="col-md-1">{{ $click->id }}</div>
            <div class="col-md-2">{{ base64_decode($click->click_id) }}</div>
            <div class="col-md-1">{{ $click->ip }}</div>
            <div class="col-md-5">{{ base64_decode($click->ua) }}</div>
            <div class="col-md-1">{{ base64_decode($click->param1) }}</div>
            <div class="col-md-1">{{ $click->param2 }}</div>
            <div class="col-md-1">{{ $click->error }}</div>
        </div>
    @endforeach
    <nav class="mt-2">
        <ul class="pagination justify-content-center">
            {!! $clicks->appends(\Request::except('page'))->render() !!}
        </ul>
    </nav>
</div>
</body>
</html>

