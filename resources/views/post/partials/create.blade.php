<form action="{{route('post.store')}}" method="POST">
    @csrf
    <div>
        <label>Title</label>
        <input type="text" name="text" required autocomplete="off">
    </div>
    <div>
        <label>Content</label>
        <textarea type="text" name="content" required autocomplete="off"></textarea>
    </div>
    <div>
        <button type="submit">create</button>
    </div>
</form>