<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="slide navbar style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('img/icontitle.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
            font-family: 'Jost', sans-serif;
            background: linear-gradient(to bottom, rgb(22, 41, 70), #696cff, rgb(40, 36, 62));
            overflow: hidden;
        }

        .main {
            width: 550px;
            height: 500px;
            background: red;
            overflow: hidden;
            background: url("https://doc-08-2c-docs.googleusercontent.com/docs/securesc/68c90smiglihng9534mvqmq1946dmis5/fo0picsp1nhiucmc0l25s29respgpr4j/1631524275000/03522360960922298374/03522360960922298374/1Sx0jhdpEpnNIydS4rnN4kHSJtU1EyWka?e=view&authuser=0&nonce=gcrocepgbb17m&user=03522360960922298374&hash=tfhgbs86ka6divo3llbvp93mg4csvb38") no-repeat center/ cover;
            border-radius: 10px;
            box-shadow: 5px 20px 50px #000;
        }

        #chk {
            display: none;
        }

        .password-container {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 20%;
            top: 55%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #757578;
            font-size: 1.3em;
        }

        .signup {
            position: relative;
            width: 100%;
            height: 100%;
        }

        label {
            color: #fff;
            font-size: 2.3em;
            justify-content: center;
            display: flex;
            margin: 50px;
            font-weight: bold;
            cursor: pointer;
            transition: .5s ease-in-out;
        }

        @media (min-width: 992px) {
            .signup-label {
                margin-bottom: 0px;
            }
        }

        input {
            width: 60%;
            height: 10px;
            background: #e0dede;
            justify-content: center;
            display: flex;
            margin: 15px auto;
            padding: 12px;
            border: none;
            outline: none;
            border-radius: 25px;
        }

        button {
            width: 64%;
            height: 40px;
            margin: 10px auto;
            justify-content: center;
            display: block;
            color: #fff;
            background: #696cff;
            font-size: 1em;
            font-weight: bold;
            margin-top: 5px;
            outline: none;
            border: none;
            border-radius: 25px;
            transition: .2s ease-in;
            cursor: pointer;
        }

        button:hover {
            background: rgb(42, 79, 138);
        }

        button[type="button-google"] {
            width: 64%;
            height: 40px;
            margin: 10px auto;
            justify-content: center;
            display: flex;
            align-items: center;
            color: rgb(76, 75, 75);
            background: rgb(255, 255, 255);
            font-size: 1em;
            font-weight: bold;
            margin-top: 10px;
            outline: none;
            border: none;
            border-radius: 25px;
            transition: .2s ease-in;
            cursor: pointer;
        }

        button[type="button-google"]:hover {
            background: rgb(180, 178, 178);
        }

        button[type="button-google-mobile"] {
            display: none;
        }

        .google-icon {
            width: 25px;
            height: 25px;
            margin-right: 8px;
        }

        .google-text {
            display: inline-block;
            line-height: 1.2;
            vertical-align: middle;
            /* Vertically center the text with the icon */
        }

        .login {
            height: 460px;
            background: #eee;
            border-radius: 60% / 10%;
            transform: translateY(-180px);
            transition: .8s ease-in-out;
        }

        .login label {
            color: rgb(74, 106, 214);
            transform: scale(.6);
        }

        #chk:checked~.login {
            transform: translateY(-500px);
        }

        #chk:checked~.login label {
            transform: scale(1);
        }

        #chk:checked~.signup label {
            transform: scale(.6);
        }

        .back-home-link {
            margin-left: 110px;
            margin-top: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 62%;
        }

        .back-home-link a {
            color: rgb(253, 206, 0);
            text-decoration: none;
            font-family: 'Jost', sans-serif;
        }

        .back-home-link a:hover {
            color: rgb(166, 161, 139);
        }

        .continue-google {
            background-color: rgb(255, 255, 255);
            padding: 4px 18px;
            border-radius: 20px;
            color: #fff;
        }

        .continue-google:hover {
            background: rgb(222, 222, 222);
        }

        .google-icon-signup {
            width: 20px;
            height: 20px;
            margin-bottom: -4px;
        }

        .no-account-link {
            color: #fff;
            font-size: 0.9em;
            text-align: left;
            display: block;
            margin-left: 20%;
            margin-top: -10px;
            margin-bottom: 0px;
            cursor: pointer;
        }

        .logo-container {
            margin-bottom: 20px;
            /* Tambahkan jarak dengan main */
            text-align: center;
            /* Pastikan logo berada di tengah */
        }

        .logo-bfashion {
            max-width: 300px;
            width: 100%;
            height: auto;
        }


        @media (max-width: 768px) {
            body {
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
                min-height: 100vh;
                font-family: 'Jost', sans-serif;
                background: linear-gradient(to bottom, rgb(41, 12, 12), rgb(99, 43, 43), rgb(62, 36, 36));
                overflow: hidden;
            }

            .main {
                width: 90%;
                height: 685px;
                background: url("https://doc-08-2c-docs.googleusercontent.com/docs/securesc/68c90smiglihng9534mvqmq1946dmis5/fo0picsp1nhiucmc0l25s29respgpr4j/1631524275000/03522360960922298374/03522360960922298374/1Sx0jhdpEpnNIydS4rnN4kHSJtU1EyWka?e=view&authuser=0&nonce=gcrocepgbb17m&user=03522360960922298374&hash=tfhgbs86ka6divo3llbvp93mg4csvb38") no-repeat center / cover;
                border-radius: 10px;
                box-shadow: 5px 20px 50px #000;
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }

            .logo-container {
                display: flex;
                opacity: 0.1;
            }

            #chk:checked~.login {
                transform: translateY(-650px);
            }

            .login {
                height: 660px;
                background: #eee;
                border-radius: 60% / 10%;
                transform: translateY(-180px);
                transition: .8s ease-in-out;
            }

            .continue-with-google {
                display: none;
            }

            .back-home-link {
                margin-left: 18%;
            }

            button[type="button-google-mobile"] {
                width: 64%;
                height: 40px;
                margin: 10px auto;
                justify-content: center;
                display: flex;
                align-items: center;
                color: rgb(76, 75, 75);
                background: rgb(255, 255, 255);
                font-size: 1em;
                font-weight: bold;
                margin-top: 10px;
                outline: none;
                border: none;
                border-radius: 25px;
                transition: .2s ease-in;
                cursor: pointer;
            }

            button[type="button-google-mobile"]:hover {
                background: rgb(180, 178, 178);
            }
        }

        @media (max-width: 1024px) and (orientation: landscape) {
            body {
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
                min-height: 50vh;
                font-family: 'Jost', sans-serif;
                background: linear-gradient(to bottom, rgb(41, 12, 12), rgb(99, 43, 43), rgb(62, 36, 36));
                overflow: hidden;
            }

            .main {
                width: 60%;
                height: 385px;
                background: url("https://doc-08-2c-docs.googleusercontent.com/docs/securesc/68c90smiglihng9534mvqmq1946dmis5/fo0picsp1nhiucmc0l25s29respgpr4j/1631524275000/03522360960922298374/03522360960922298374/1Sx0jhdpEpnNIydS4rnN4kHSJtU1EyWka?e=view&authuser=0&nonce=gcrocepgbb17m&user=03522360960922298374&hash=tfhgbs86ka6divo3llbvp93mg4csvb38") no-repeat center / cover;
                border-radius: 10px;
                box-shadow: 5px 20px 50px #000;
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }

            .logo-container {
                display: none;
                opacity: 0.1;
            }

            .back-home-link {
                margin-left: 5%;
                width: 40%;
            }

            .signup-label {
                margin-bottom: 0px;
            }

            #chk {
                display: none;
            }

            .password-container {
                position: relative;
            }

            .toggle-password {
                position: absolute;
                right: 25%;
                top: 50%;
                transform: translateY(-50%);
                cursor: pointer;
            }

            .signup {
                position: relative;
                width: 100%;
                height: 100%;
            }

            label {
                color: #fff;
                font-size: 1.8em;
                /* Smaller font size */
                justify-content: center;
                display: flex;
                margin: 30px;
                /* Smaller margin */
                font-weight: bold;
                cursor: pointer;
                transition: .5s ease-in-out;
            }


            input {
                width: 50%;
                /* Smaller input width */
                height: 8px;
                /* Smaller height */
                background: #e0dede;
                justify-content: center;
                display: flex;
                margin: 10px auto;
                /* Reduced margin */
                padding: 10px;
                /* Smaller padding */
                border: none;
                outline: none;
                border-radius: 20px;
                /* Smaller border-radius */
            }

            button {
                width: 55%;
                /* Smaller button width */
                height: 35px;
                /* Smaller height */
                margin: 8px auto;
                /* Reduced margin */
                justify-content: center;
                display: block;
                color: #fff;
                background: rgb(74, 106, 214);
                font-size: 0.9em;
                /* Smaller font size */
                font-weight: bold;
                margin-top: 5px;
                outline: none;
                border: none;
                border-radius: 20px;
                /* Smaller border-radius */
                transition: .2s ease-in;
                cursor: pointer;
            }

            button:hover {
                background: rgb(184, 68, 68);
            }

            button[type="button-google"] {
                width: 60%;
                /* Smaller width */
                height: 30px;
                /* Smaller height */
                margin: 8px auto;
                /* Reduced margin */
                justify-content: center;
                display: flex;
                align-items: center;
                color: rgb(76, 75, 75);
                background: rgb(255, 255, 255);
                font-size: 0.9em;
                /* Smaller font size */
                font-weight: bold;
                margin-top: 10px;
                outline: none;
                border: none;
                border-radius: 20px;
                /* Smaller border-radius */
                transition: .2s ease-in;
                cursor: pointer;
            }

            button[type="button-google"]:hover {
                background: rgb(180, 178, 178);
            }

            button[type="button-google-mobile"] {
                display: none;
            }

            .google-icon {
                width: 20px;
                /* Smaller icon */
                height: 20px;
                /* Smaller icon */
                margin-right: 8px;
            }

            .google-text {
                display: inline-block;
                line-height: 1.2;
                vertical-align: middle;
            }

            .login {
                height: 380px;
                background: #eee;
                border-radius: 60% / 10%;
                transform: translateY(-140px);
                transition: .8s ease-in-out;
            }

            .login label {
                color: rgb(74, 106, 214);
                transform: scale(.5);
                /* Smaller scale */
            }

            #chk:checked~.login {
                transform: translateY(-370px);
            }

            #chk:checked~.login label {
                transform: scale(1);
            }

            #chk:checked~.signup label {
                transform: scale(.5);
                /* Smaller scale */
            }

            .back-home-link {
                margin-left: 25%;
                /* Reduced left margin */
                margin-top: 5px;
                margin-bottom: -20px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                width: 50%;
                /* Smaller width */
            }

            .back-home-link a {
                color: rgb(253, 206, 0);
                text-decoration: none;
                font-family: 'Jost', sans-serif;
            }

            .back-home-link a:hover {
                color: rgb(166, 161, 139);
            }

            .continue-google {
                display: none;
            }

            .google-icon-signup {
                width: 16px;
                /* Smaller icon size */
                height: 16px;
                /* Smaller icon size */
                margin-bottom: -4px;
            }

            .no-account-link {
                color: #fff;
                font-size: 0.8em;
                /* Smaller font size */
                text-align: left;
                display: block;
                margin-left: 25%;
                /* Smaller left margin */
                margin-top: -5px;
                /* Reduced top margin */
                margin-bottom: 0px;
                cursor: pointer;
            }

            .logo-container {
                margin-bottom: 15px;
                /* Reduced bottom margin */
                text-align: center;
            }

            .logo-bfashion {
                max-width: 250px;
                /* Smaller logo width */
                width: 100%;
                height: auto;
            }

            .our {
                margin-top: -5px;
                margin-bottom: -5px;
            }

        }
    </style>
</head>

<body>

    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true" checked @if(session('error')) checked @endif>
        <!-- Sign up form -->
        <div class="signup">
            <script>
                @if ($errors->has('username'))
                    Swal.fire({
                        icon: 'error',
                        title: 'Email is already!',
                        toast: true,
                        position: 'top',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                    });
                @endif
                @if ($errors->has('name'))
                    Swal.fire({
                        icon: 'error',
                        title: 'Please enter a name without symbols!',
                        toast: true,
                        position: 'top',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                    });
                @endif
                @if ($errors->has('password'))
                    Swal.fire({
                        icon: 'error',
                        title: 'Confirm password does not match! & minimum password of 8 characters',
                        toast: true,
                        position: 'top',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                    });
                @endif
            </script>
            <form method="POST" action="{{ route('user.storeregister') }}">
                @csrf
                <label for="chk" aria-hidden="true" class="signup-label">Sign up</label>
                <!-- Name Input -->
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    placeholder="JhonDoe" value="{{ old('name') }}" required>

                <!-- Username Input -->
                <input type="email" class="form-control @error('username') is-invalid @enderror" id="username"
                    name="username" placeholder="JhonDoe@example.com" value="{{ old('username') }}" required>

                <!-- Password Input -->
                <div class="password-container">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password" placeholder="passwordJhonDoe123" value="{{ old('password') }}" required>
                    <span class="toggle-password" id="togglePassword"><i class="bx bx-show"></i></span>
                </div>

                <!-- Confirm Password Input -->
                <div class="password-container">
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                        id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
                    <span class="toggle-password" id="toggleConfirmPassword"><i class="bx bx-show"></i></span>
                </div>

                <input type="hidden" name="role" value="user">
                <input type="hidden" name="login_type" value="Register Account">

                <div class="back-home-link d-flex justify-content-between align-items-center">

                    <p class="continue-with-google">
                        <a href="/auth/redirect"
                            class="btn btn-outline-primary d-flex align-items-center continue-google"
                            style="color:rgb(76, 75, 75)">
                            <img src="/img/google.svg" alt="Google Icon" class="google-icon-signup"> Continue with
                            Google
                        </a>
                    </p>
                </div>

                <button type="submit">Sign up</button>

                <button type="button-google-mobile" onclick="window.location.href='/auth/redirect'"
                    class="btn btn-light d-flex align-items-center justify-content-center google-button">
                    <img src="/img/google.svg" alt="Google Icon" class="google-icon">
                    <span class="google-text">Continue with Google</span>
                </button>
            </form>
        </div>
        <!-- Login form -->
        <div class="login">
            @if (session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        text: '{{ session('success') }}',
                        toast: true,
                        position: 'top',
                        showConfirmButton: false,
                        timer: 3000
                    });
                </script>
            @endif

            @if (session('error'))
                <script>
                    Swal.fire({
                        icon: 'error',
                        text: '{{ session('error') }}',
                        toast: true,
                        position: 'top',
                        showConfirmButton: false,
                        timer: 5000
                    });
                </script>
            @endif
            <form method="POST" action="{{ route('login') }}" class="form-mobile">
                @csrf
                <label for="chk" aria-hidden="true">Login</label>
                <input type="email" class="form-control" id="username" name="username" placeholder="JhonDoe@example.com"
                    required>
                <div class="password-container">
                    <input type="password" class="form-control" id="password" name="password" placeholder="example123"
                        required>
                    <span class="toggle-password" id="togglePassword-login"><i class="bx bx-show"></i></span>
                </div>
                <label class="no-account-link" for="chk">Don't have an account?</label>
                <button type="submit">Login</button>
                <p style="text-align:center;" class="our">our</p>
                <button type="button-google" onclick="window.location.href='/auth/redirect'"
                    class="btn btn-light d-flex align-items-center justify-content-center">
                    <img src="/img/google.svg" alt="Google Icon" class="google-icon">
                    <span class="google-text">Login with Google</span>
                </button>
            </form>
        </div>
    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');

        if (togglePassword && password) {
            togglePassword.addEventListener('click', function () {
                const type = password.type === 'password' ? 'text' : 'password';
                password.type = type;
                togglePassword.innerHTML = type === 'password' ? '<i class="bx bx-show"></i>' : '<i class="bx bx-hide"></i>';
            });
        }

        // Toggle password visibility for signup confirm password field
        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        const confirmPassword = document.getElementById('password_confirmation');

        if (toggleConfirmPassword && confirmPassword) {
            toggleConfirmPassword.addEventListener('click', function () {
                const type = confirmPassword.type === 'password' ? 'text' : 'password';
                confirmPassword.type = type;
                toggleConfirmPassword.innerHTML = type === 'password' ? '<i class="bx bx-show"></i>' : '<i class="bx bx-hide"></i>';
            });
        }

        // Toggle password visibility for login password field
        const togglePasswordLogin = document.getElementById('togglePassword-login');
        const loginPassword = document.querySelector('.login #password');

        if (togglePasswordLogin && loginPassword) {
            togglePasswordLogin.addEventListener('click', function () {
                const type = loginPassword.type === 'password' ? 'text' : 'password';
                loginPassword.type = type;
                togglePasswordLogin.innerHTML = type === 'password' ? '<i class="bx bx-show"></i>' : '<i class="bx bx-hide"></i>';
            });
        }
    </script>
</body>


</html>