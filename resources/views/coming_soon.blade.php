<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
        /* Set height to 100% for body and html to enable the background image to cover the whole page: */
        body, html {
            height: 100%
        }

        body {
            /* Background image */
            background-image: url('http://pic.8win.com/cms/image/all/2016/8/9/82bcf648-a46d-4ca8-9762-dc586aad38eb.jpg');
            /* Full-screen */
            height: 100%;
            /* Center the background image */
            background-position: center;
            /* Scale and zoom in the image */
            background-size: cover;
            /* Add position: relative to enable absolutely positioned elements inside the image (place text) */
            position: relative;
            /* Add a white text color to all elements inside the .bgimg container */
            color: white;
            /* Add a font */
            font-family: 'Raleway', sans-serif;
            /* Set the font-size to 25 pixels */
            font-size: 30px;
        }

        /* Position text in the top-left corner */
        .topleft {
            position: absolute;
            top: 0;
            left: 16px;
        }

        /* Position text in the bottom-left corner */
        .bottomleft {
            position: absolute;
            bottom: 0;
            left: 16px;
        }

        /* Position text in the middle */
        .middle {
            position: absolute;
            top: 25%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        /* Style the <hr> element */
        hr {
            margin: auto;
            width: 40%;
        }
        </style>
</head>
    <body>
        <div class="flex-center position-ref full-height">
          <div class="bgimg">
            <div class="topleft">
            </div>
            <div class="middle">
              <h1>COMING SOON</h1>
              <hr>
            </div>
            <div class="bottomleft">
            </div>
          </div>
      </div>
    </body>
</html>
