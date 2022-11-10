<form action="{{route('post.update', $data->id)}}" method="POST">
    @csrf
    <div>
        <label>Title</label>
        <input type="text" name="text" required autocomplete="off" value="{{$data->text}}">
    </div>
    <div>
        <label>Content</label>
        <textarea type="text" name="content" required autocomplete="off"> {{$data->content}}</textarea>
    </div>
    <div>
        <button type="submit">create</button>
    </div>
</form>