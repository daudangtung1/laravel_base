<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <main>
        <div class="container">
            <div id="post">
                @foreach($users as $user)
                <div>{{$user->email}}</div>
                @endforeach
            </div>
            <a class="see-more" href="javascript:void(0)">See more</a>
            <div style="display: none">
                {{ $users }}
            </div>
        </div>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        $(function() {
            var $posts = $("#posts");
            var $ul = $("ul.pagination");
            $ul.hide();

            $(".see-more").click(function() {
                $.ajax({
                    url: $ul.find("a[rel='next']").attr("href"),
                    success: function(response) {
                        $posts.append(
                            $(response).find("#posts").html()
                        );
                        console.log(response);
                    }
                });
            });
        });
    </script>
</body>

</html>