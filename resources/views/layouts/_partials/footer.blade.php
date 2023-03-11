<footer class="text-center text-lg-start bg-white text-muted">
    <section class="">
        <div class="container text-center text-md-start mt-5">
            <div class="row mt-3">
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold mb-4">
                        <i class="fas fa-gem me-3 text-secondary"></i>
                        MemeFun
                    </h6>

                    <p>
                        Seu lugar funstástico.
                    </p>

                    <img src="{{ asset('images/logo.png') }}" height="50" alt="Logo"/>
                </div>
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4 fs-26">
                    <h6 class="text-uppercase fw-bold mb-4">
                        Nossas Redes Sociais:
                    </h6>

                    <a href="" class="me-4 link-secondary rede-sociais">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="" class="me-4 link-secondary rede-sociais">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="" class="me-4 link-secondary rede-sociais">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="" class="me-4 link-secondary rede-sociais">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="" class="me-4 link-secondary rede-sociais">
                        <i class="fab fa-linkedin"></i>
                    </a>
                </div>

                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold mb-4">
                        Mapa do site
                    </h6>

                    <p>
                        <a href="{{route('home')}}" class="text-reset">Home</a>
                    </p>
                    <p>
                        <a href="{{route('melhores')}}" class="text-reset">Melhores</a>
                    </p>
                    <p>
                        <a href="{{route('seguidores')}}" class="text-reset">Seguidores</a>
                    </p>
                    <p>
                        <a href="{{route('comunidades')}}" class="text-reset">Comunidade</a>
                    </p>
                    <p>
                        <a href="{{route('novo-post')}}" class="text-reset">Novo Post</a>
                    </p>

                    <h6 class="text-uppercase fw-bold mt-4 perfilRodape">
                        Perfil
                        <i class="fa-solid fa-chevron-down"></i>
                        <i class="fa-solid fa-chevron-right" style="display: none;"></i>
                    </h6>

                    <div class="rotaPerfil">
                        <p class="mx-2">
                            <a href="{{route('perfil')}}" class="text-reset">Perfil</a>
                        </p>
                        <p class="mx-2">
                            <a href="{{route('editar-perfil')}}" class="text-reset">Editar Perfil</a>
                        </p>
                        <p class="mx-2">
                            <a href="{{route('configuracoes')}}" class="text-reset">Configurações</a>
                        </p>
                        <p class="mx-2">
                            <a href="{{route('ranking')}}" class="text-reset">Ranking</a>
                        </p>
                        <p class="mx-2">
                            <a href="{{route('sair')}}" class="text-reset">Sair</a>
                        </p>
                    </div>

                    <div class="rotaLogin mt-3">
                        <p>
                            <a href="{{route('login')}}" class="text-reset">Entrar</a>
                        </p>
                        <p>
                            <a href="{{route('cadastro')}}" class="text-reset">Registrar-se</a>
                        </p>

                    </div>
                </div>

                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <h6 class="text-uppercase fw-bold mb-4">Contato</h6>
                    <p>
                        <i class="fas fa-home me-3 text-secondary"></i> 
                        Uberlândia, Minas Gerais, Brasil
                    </p>
                    <p>
                        <i class="fas fa-envelope me-3 text-secondary"></i>
                        paulofiori34@gmail.com
                    </p>
                    <p>
                        <i class="fas fa-phone me-3 text-secondary"></i> 
                        +55 (34) 9 9660-5050
                    </p>
                </div>
            </div>
        </div>
    </section>

  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.025);">
    Direitos Autorais © 2022
    <a class="text-reset fw-bold" href="{{config('app.url')}}">MemeFun</a>
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->