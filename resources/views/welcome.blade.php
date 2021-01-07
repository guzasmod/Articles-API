<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Saitynas</title>

        <link href="css/app.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">


        <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'>
        <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css'>
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
           
    </head>
    <body>
        <div id='app' class="d-flex flex-column min-vh-100">
            <navbar></navbar>
            <div class="container flex-fill">
             <!--   <articles></articles>-->
                <!--
                    <router-link to='./'>Home</router-link>
                    <router-link to='./articles'>About</router-link>
                    <router-link to='./home'>Homee</router-link>
                    <router-link to='./login'>Login</router-link>
                    <router-link to='./register'>Register</router-link>
                    <router-link to='/register'>Registerrrr</router-link>
                -->
                <router-view></router-view>           
        </div>
            {{-- <footer class="footer">footer</footer> --}}
            <footer class="footer py-3 bg-dark">
                <div class="container">
                    <p class="m-0 text-center text-white">Copyright &copy; ArticlesAPI</p>
                </div>
              </footer>
            {{-- <footerr></footerr> --}}

        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
        <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js'></script>


        <script src="{{ asset('js/app.js') }}"></script>
        
    </body>
</html>