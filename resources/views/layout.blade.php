<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>riooocourse</title>
    @vite(['resources/css/app.css','resources/js/app.js'])

    <style>
       <style>
        @keyframes slideIn {
            0% {
                transform: translateX(100%);
            }
            100% {
                transform: translateX(0);
            }
        }

        .animated-card {
            animation: slideIn 0.5s ease-out;
        }
    </style>
</head>
<body class="flex flex-col min-h-screen">
   

    
        @yield('content')
    
    

</body>
</html>

