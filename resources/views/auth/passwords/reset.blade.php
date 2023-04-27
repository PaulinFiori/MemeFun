<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>MemeFun - Recuperar Senha</title>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/countdown/2.6.0/countdown.js" integrity="sha512-zUUZJUMK19j/aCgjs828G2oo+Xr/PPAjiCqE2nsvq6kVXcFs+9n5w8Jwe2tjKaCfNrejmL0AHvdUYq38qwZswg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/animsition/4.0.2/js/animsition.min.js" integrity="sha512-pYd2QwnzV9JgtoARJf1Ui1q5+p1WHpeAz/M0sUJNprhDviO4zRo12GLlk4/sKBRUCtMHEmjgqo5zcrn8pkdhmQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.0/moment.min.js" integrity="sha512-Izh34nqeeR7/nwthfeE0SI3c8uhFSnqxV0sI9TvTcXiFJkMd6fB644O64BRq2P/LA/+7eRvCw4GmLsXksyTHBg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

        <script src="https://code.iconify.design/iconify-icon/1.0.1/iconify-icon.min.js"></script>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}"/>
        <link rel="stylesheet" href="{{ asset('css/login.css') }}"/>
        <link rel="stylesheet" href="{{ asset('css/util.css') }}"/>
        <script type="text/javascript" src="{{ asset('js/login.js') }}"></script>
    </head>

    <body>
        <div class="limiter">
            <div class="container-login100">
                <div class="wrap-login100">
                    <form method="POST" action="{{ route('password.update') }}" class="login100-form validate-form">
                        <span class="login100-form-title p-b-26">
                            Recuperar Senha
                        </span>
                        <span class="login100-form-title p-b-48">
                            <i class="zmdi zmdi-font"></i>
                        </span>

                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="wrap-input100 validate-input" data-validate = "Email válido é: a@b.c">
                            <input class="input100" type="text" name="email" value="{{ $email ?? old('email') }}">
                            <span class="focus-input100" data-placeholder="Email"></span>
                        </div>

                        <div class="wrap-input100 validate-input" data-validate="Digite uma senha">
                            <span class="btn-show-pass">
                                <iconify-icon icon="zmdi:eye"></iconify-icon>
                            </span>
                            <input class="input100" type="password" name="password">
                            <span class="focus-input100" data-placeholder="Senha"></span>
                        </div>

                        <div class="wrap-input100 validate-input" data-validate="Digite uma senha">
                            <span class="btn-show-pass">
                                <iconify-icon icon="zmdi:eye"></iconify-icon>
                            </span>
                            <input class="input100" type="password" name="password_confirmation">
                            <span class="focus-input100" data-placeholder="Confirme a senha"></span>
                        </div>

                        <div class="container-login100-form-btn">
                            <div class="wrap-login100-form-btn">
                                <div class="login100-form-bgbtn"></div>
                                <button type="submit" class="login100-form-btn">
                                    Resetar Senha
                                </button>
                            </div>
                        </div>

                        <div class="text-center p-t-115">
                            <a class="txt2" href="{{ route('login') }}">
                                Voltar ao login
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        

        <div id="dropDownSelect1"></div>

    </body>
</html>