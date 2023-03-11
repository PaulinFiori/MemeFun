@if(count(auth()->user()->memes))
    <div class="mt-2 mb-5 mx-1">
        <div class="filter bg-white float-right d-flex align-items-center justify-content-center">
            <span>Populares</span>
            <div class="dropdown">
                <button class="btn btn-flat btn-flat-icon" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <em class="fa fa-ellipsis-h"></em>
                </button>
                <div class="dropdown-menu dropdown-scale dropdown-menu-right" role="menu" style="position: absolute; transform: translate3d(-136px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                    <a class="dropdown-item" href="#">Populares</a>
                    <a class="dropdown-item" href="#">Últimas</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-lg-6 offset-lg-3">
            <div class="cardbox shadow-lg bg-white">
                <!-- start cardbox-heading -->
                <div class="cardbox-heading">
                    <div class="dropdown float-right">
                        <button class="btn btn-flat btn-flat-icon" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <em class="fa fa-ellipsis-h"></em>
                        </button>
                        <div class="dropdown-menu dropdown-scale dropdown-menu-right" role="menu" style="position: absolute; transform: translate3d(-136px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <a class="dropdown-item" href="#">Excluir</a>
                            <a class="dropdown-item" href="#">Reportar</a>
                        </div>
                    </div>
                    <div class="media m-0">
                        <div class="d-flex mr-3">
                            <a href="">
                                <img class="img-fluid rounded-circle" src="http://www.themashabrand.com/templates/bootsnipp/post/assets/img/users/4.jpg" alt="User">
                            </a>
                        </div>
                        <div class="media-body">
                            <p class="m-0">Benjamin Robinson</p>
                            <small><span><i class="icon ion-md-time"></i> 10 horas atrás</span></small>
                        </div>
                    </div>
                    <!--/ cardbox-heading -->

                    <!--start cardbox-item -->
                    <div class="cardbox-item">
                        <img class="img-fluid" src="http://www.themashabrand.com/templates/bootsnipp/post/assets/img/1.jpg" alt="Image">
                    </div>
                    <!--/ cardbox-item -->

                    <!-- start cardbox-base -->
                    <div class="cardbox-base">
                        <ul class="float-right">
                            <li>
                                <a>
                                    <i class="fa fa-comments"></i>
                                </a>
                            </li>
                            <li>
                                <a>
                                    <em class="mr-2-rem">12</em>
                                </a>
                            </li>
                            <li>
                                <a>
                                    <i class="fa fa-share-alt"></i>
                                </a>
                            </li>
                            <li>
                                <a>
                                    <i class="fa-solid fa-circle-down no-margin-right"></i>
                                </a>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <a>
                                    <i class="fa fa-thumbs-up"></i>
                                    <span class="ml-menus-5-percent">242 Likes</span>
                                </a>
                            </li>
                        </ul>			   
                    </div>
                    <!--/ cardbox-base -->

                    <!--start cardbox-like -->
                    <div class="cardbox-comments">
                        <!--start comments -->
                        <div class="d-flex mb-3">
                            <span class="comment-avatar float-left">
                                <a>
                                    <img class="rounded-circle" src="http://www.themashabrand.com/templates/bootsnipp/post/assets/img/users/6.jpg" alt="...">
                                </a>                            
                            </span>
                            <div class="comment me-3 float-right mt-10">
                                <span>
                                    Ótima pintura
                                </span>
                            </div>
                        </div>
                        <!--/ comments -->
                        
                        <span class="comment-avatar float-left">
                            <a>
                                <img class="rounded-circle" src="http://www.themashabrand.com/templates/bootsnipp/post/assets/img/users/6.jpg" alt="...">
                            </a>                            
                        </span>
                        <!--start Search -->
                        <div class="search">
                            <input placeholder="Deixe um comentário" type="text">
                            <button>
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </div>
                        <!--/. Search -->
                    </div>
                    <!--/ cardbox-like -->
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-lg-6 offset-lg-3">
            <div class="cardbox shadow-lg bg-white">
                <!-- start cardbox-heading -->
                <div class="cardbox-heading">
                    <div class="dropdown float-right">
                        <button class="btn btn-flat btn-flat-icon" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <em class="fa fa-ellipsis-h"></em>
                        </button>
                        <div class="dropdown-menu dropdown-scale dropdown-menu-right" role="menu" style="position: absolute; transform: translate3d(-136px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <a class="dropdown-item" href="#">Excluir</a>
                            <a class="dropdown-item" href="#">Reportar</a>
                        </div>
                    </div>
                    <div class="media m-0">
                        <div class="d-flex mr-3">
                            <a href="">
                                <img class="img-fluid rounded-circle" src="http://www.themashabrand.com/templates/bootsnipp/post/assets/img/users/4.jpg" alt="User">
                            </a>
                        </div>
                        <div class="media-body">
                            <p class="m-0">Benjamin Robinson</p>
                            <small><span><i class="icon ion-md-pin"></i> Nairobi, Kenya</span></small>
                            <small><span><i class="icon ion-md-time"></i> 10 hours ago</span></small>
                        </div>
                    </div>
                    <!--/ cardbox-heading -->

                    <!--start cardbox-item -->
                    <div class="cardbox-item">
                        <img class="img-fluid" src="http://www.themashabrand.com/templates/bootsnipp/post/assets/img/1.jpg" alt="Image">
                    </div>
                    <!--/ cardbox-item -->

                    <!-- start cardbox-base -->
                    <div class="cardbox-base">
                        <ul class="float-right">
                            <li>
                                <a>
                                    <i class="fa fa-comments"></i>
                                </a>
                            </li>
                            <li>
                                <a>
                                    <em class="mr-2-rem">12</em>
                                </a>
                            </li>
                            <li>
                                <a>
                                    <i class="fa fa-share-alt"></i>
                                </a>
                            </li>
                            <li>
                                <a>
                                    <i class="fa-solid fa-circle-down no-margin-right"></i>
                                </a>
                            </li>
                        </ul>
                        <ul>
                            <li>
                                <a>
                                    <i class="fa fa-thumbs-up"></i>
                                    <span class="ml-menus-5-percent">242 Likes</span>
                                </a>
                            </li>
                        </ul>			   
                    </div>
                    <!--/ cardbox-base -->

                    <!--start cardbox-like -->
                    <div class="cardbox-comments">
                        <!--start comments -->
                        <div class="d-flex mb-3">
                            <span class="comment-avatar float-left">
                                <a>
                                    <img class="rounded-circle" src="http://www.themashabrand.com/templates/bootsnipp/post/assets/img/users/6.jpg" alt="...">
                                </a>                            
                            </span>
                            <div class="comment me-3 float-right mt-10">
                                <span>
                                    Ótima pintura
                                </span>
                            </div>
                        </div>
                        <!--/ comments -->
                        
                        <span class="comment-avatar float-left">
                            <a>
                                <img class="rounded-circle" src="http://www.themashabrand.com/templates/bootsnipp/post/assets/img/users/6.jpg" alt="...">
                            </a>                            
                        </span>
                        <!--start Search -->
                        <div class="search">
                            <input placeholder="Deixe um comentário" type="text">
                            <button>
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </div>
                        <!--/. Search -->
                    </div>
                    <!--/ cardbox-like -->
                </div>
            </div>
        </div>
    </div>
@else
    <p class="font-weight-bold text-center mb-3 mt-3">Esse usuário não tem memes</p>
@endif