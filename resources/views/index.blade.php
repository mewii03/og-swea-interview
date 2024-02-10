<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Project</title>
</head>
<body>

    @auth
    <p>Congrats you are logged in!!!</p>
    <form action="/logout" method="POST">
        @csrf
        <button>Log out</button>
    </form>
    
    <div style="border: 3px solid black; background-color: indianred">
        <h2 style="background-color: salmon; text-align:justify; padding: 10px; margin: 10px">Create a New Post</h2>
        <form action="/create-post" method="POST">
            @csrf
            <div class="group">
                <label for="user" class="topic">Title:</label>
                <input id="user" type="text" class="input" placeholder="title...">
              </div>
              <style>
                .topic {
                    background-color: salmon;
                    color:black;
                    margin-left: 10px;
                    padding: 0;
                    font-size: 20px;
                }
              </style>
            <div class="content">
            <label for="topic" class="c1">Content: </label>
            <textarea class="c2" name="body" placeholder="body content..."></textarea>
             </div>
             <style>
                .content > .c1 {
                    background-color: salmon;
                    color:black;
                    margin-left: 10px;
                    padding: 0;
                    font-size: 20px;
                }

             </style>
             <div class="save">
            <button style="background-color: pink">Save Post</button>
             </div>
             <style>
                .save {
                    margin-left: 200px;
                }
             </style>
        </form>
    </div>


    <div style="border: 3px solid black; background-color: indianred">
        <h2 style="background-color: salmon; padding: 10px; margin: 10px; text-align:center">My Posts</h2>
        @foreach ($posts as $post)
        <div style="background-color: pink; padding: 10px; margin: 10px;">
            <h3 style="background-color: salmon; width: 200px; text-align: center;">{{$post['title']}} by {{$post->user->name}}</h3>
            {{$post['body']}}
            <p><a href="/edit-post/{{$post->id}}">Edit</a></p>
            <form action="/delete-post/{{$post->id}}" method="POST">
            @csrf
            @method('DELETE')
            <button>Delete</button>
            </form>
        </div>
        @endforeach
    </div>

    @else 
    <div class="reg" style="border: 3px solid black;">
    <h2>Register</h2>
    <form action="/register" method="POST">
        @csrf
        <input name="name" type="text" placeholder="name">
        <input name="email" type="text" placeholder="email">
        <input name="password" type="password" placeholder="password">
        <button>Register</button>
    </form>
    </div>
    <style>
        .reg {
            text-align: center;
            padding: 0;
            margin: 10px;
            background-color: pink;
        }
    </style>
    <div class="log" style="border: 3px solid black;">
        <h2>Login</h2>
        <form action="/login" method="POST">
            @csrf
            <input name="loginname" type="text" placeholder="name">
            <input name="loginpassword" type="password" placeholder="password">
            <button>Log in</button>
        </form>
        </div>
        <style>
            .log {
            text-align: center;
            padding: 0;
            margin: 10px;
            background-color: pink;
        }
        </style>
    @endauth

</body>
</html>