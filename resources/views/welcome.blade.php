<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="content">
        <h2>Topic owner top 10 comments</h2>
        <form action="{{ route('top10comments') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="owner">Owner</label>
                <select name="owner" class="form-control">
                    @foreach($owners as $owner)
                        <option value="{{ $owner->id }}">{{ $owner->username }}</option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-success" type="submit">Submit</button>
        </form>

        <h2>Top N comments by owner and author</h2>
        <form class="" action="{{ route('topNComments') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="owner">Owner</label>
                <select name="owner" class="form-control">
                    @foreach($owners as $owner)
                        <option value="{{ $owner->id }}">{{ $owner->username }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="author">Author</label>
                <select name="author" class="form-control">
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}">{{ $author->username }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="limit">Limit</label>
                <input class="form-control" type="number" name="limit">
            </div>
            <button class="btn btn-success" type="submit">Submit</button>
        </form>

        <h2>Topics owners by comment authors</h2>
        <form action="{{ route('ownersByCommentAuthor') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="author">Author</label>
                <select name="author" class="form-control">
                    @foreach($comment_authors as $author)
                        <option value="{{ $author->id }}">{{ $author->username }}</option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-success" type="submit">Submit</button>
        </form>
    </div>
</div>
</body>
</html>
