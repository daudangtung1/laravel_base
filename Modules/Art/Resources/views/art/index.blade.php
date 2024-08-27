<!DOCTYPE html>
<html>

<head></head>

<body>
    @foreach($data as $v)
    <img src="{{$v->path}}" alt="{{$v->title}}">
    @endforeach
</body>

</html>