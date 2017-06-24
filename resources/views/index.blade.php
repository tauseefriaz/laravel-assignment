<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Comments Factory</title>
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/app.css') }}?ts={{ $rcTime=time() }}" rel="stylesheet" type="text/css">
        <script type="text/javascript">
            var TMBC,
            app = {
                settings: {
                    basePath:   '{{ URL::to('') }}',
                    csrfToken:  '{{ csrf_token() }}',
                },

                init: function() {
                    TMBC = this.settings;
                }
            };
            app.init();
        </script>
    </head>
    <body>
        <div class="container bootstrap snippet">
            <div class="row">
                <div class="col-md-12">
                    <div class="blog-comment">
                        <h3 class="text-success">Write your awesome comments! <button class="btn-warning reply">Reply</button></h3>
                        <hr/>
                        @foreach($comments as $comment)
                            @include('includes/comment', ['comment' => $comment, 'count' => 1])
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div id="cover" class="cancel-comment"> </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/app.js') }}?ts={{ $rcTime }}"></script>
</html>