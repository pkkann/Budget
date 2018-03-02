<?php
http_response_code(404);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>404 page was not found</title>
        <style>
            @import url('https://fonts.googleapis.com/css?family=Open+Sans');
            body {
                background: #EEEEEE;
            }
            body > div {
                background: white;
                max-width:1024px;
                margin-left: auto;
                margin-right: auto;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                border-left: 5px dashed #444444;
                border-right: 5px dashed #444444;
            }
            body > div > div {
                font-family: 'Open Sans', sans-serif;
                text-align: center;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
                position: absolute;
                top: 0;
                bottom: 0;
                left: 0;
                right: 0;
            }
            body > div > div > h2 {
                font-weight: normal;
                font-size: 48px;
                color: #444444;
            }
            body > div > div > h3 {
                font-weight: normal;
                font-size: 24px;
                color: #888888;
            }
        </style>
    </head>
    <body>
        <div>
            <div>
                <h2>The requested page was not found</h2>
                <h3>It looks like, what you tried to access could not be found</h3>
            </div>
        </div>
    </body>
</html>