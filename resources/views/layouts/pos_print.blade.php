<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @php
        // $bootstrap = file_get_contents(url('/dist/css/bootstrap.css'));
        // echo "<style>";
        // echo $bootstrap;
        // echo "</style>";
    @endphp

    <style>
        body {
            font-size: 24px !important;
            font-family: sans-serif;
        }

        .title-command {
            text-align: center;
            font-size: 40px !important;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .td-label {
            padding-right:10px;
            width: 150px;
            text-align: left;
            /* font-weight: bold; */
        }

        .pr-10 {
            padding-right: 10px;
        }

        .bold { font-weight: bold; }

        .text-right { text-align: right; }
        
        .text-center { text-align: center; }

        .text-center {
            text-align: center;
        }

        table {border-collapse: collapse;}

        thead {border-bottom: 1px solid black}

        tfoot {border-top: 1px solid black}

        .title {
            text-align: center;
            font-size: 38px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .printed-at {
            font-style: oblique; 
            display: block; 
            text-align: right;
            font-size: 20px;
        }

    </style>
</head>
<body>
    @yield('content')
</body>
</html>