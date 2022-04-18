<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name')}}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        
        <!-- jQuery cdn -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        
        <!-- datatables css/js cdn -->
        <link href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
        <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js" defer></script>
        
        <!-- my script -->
        <script src="{{asset('js/app.js')}}" defer></script>
        
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
        <div style="width: 80%; margin: 50px auto; border: 1px solid black; padding: 20px">
            <h2>Tabella riepilogo presenze</h2>
            <table id="myTable">
            </table>
        </div>
        
        <div style="width: 80%; margin: 50px auto; border: 1px solid black; padding: 20px">
            <h2>Tabella presenze settimanali</h2>
            <table id="myTable2">
            </table>
        </div>


    </body>
</html>
