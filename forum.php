<?php
    include("template/debut.php"); // On insère le menu et on démarre la session. 
?>

<div id="forum">
    <div class="menu_forum">
        <?php
            include("template/menu.php"); // On insère le menu et on démarre la session. 
        ?>
    </div>
    <header class="container-fluid m-auto p-0">
        <div class="banner-container p-0 d-none d-md-block">
            <div class="banner">
                <ul class="p-0 m-0">
                    <!--SLIDE-->
                    <li>
                        <img src="img/coucher-soleil.jpg" alt="Coucher de soleil de minecraft">
                    </li>
                </ul>
                <div class="loader"><img src="img/loader.gif" alt="Loader"></div>
            </div>
        </div>
    </header>
    <section class="content">
        <div class="container mt-2">
            <div class="row">
                <div class="col-8 m-auto">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="forum.php">Accueil</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Édition</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-4 my-auto">
                    <button class="btn btn-primary float-right">Nouveau sujet</button>
                </div>
            </div>
            
        </div>
        <div id="paginationMenu" class="container p-0">
            <div class="row justify-content-center justify-content-lg-start">
                <div class="col-lg-8 col-sm-12 col-md-8 d-flex">
                    <div class="pull-left">
                        <a href="#" class="prevnext">
                            <i class="fa fa-angle-left"></i>
                        </a>
                    </div>
                    <div class="pull-left">
                        <ul class="paginationForum p-0">
                            <li class="d-none d-xl-inline-block">
                                <a href="#">1</a>
                            </li>
                            <li class="d-none d-lg-inline-block">
                                <a href="#">2</a>
                            </li>
                            <li class="d-none d-lg-inline-block">
                                <a href="#">3</a>
                            </li>
                            <li class="d-none d-sm-inline-block">
                                <a href="#">4</a>
                            </li>
                            <li>
                                <a href="#">5</a>
                            </li>
                            <li>
                                <a href="#">6</a>
                            </li>
                            <li>
                                <a href="#" class="active">7</a>
                            </li>

                            <li>
                                <a href="#">8</a>
                            </li>
                            <li>
                                <a href="#">9</a>
                            </li>
                            <li class="d-none d-sm-inline-block">
                                <a href="#">10</a>
                            </li>
                            <li class="d-none d-lg-inline-block">
                                <a href="#">11</a>
                            </li>
                            <li class="d-none d-lg-inline-block">
                                <a href="#">12</a>
                            </li>
                            <li class="d-none d-xl-inline-block">
                                <a href="#">1586</a>
                            </li>
                        </ul>
                    </div>
                    <div class="pull-left">
                        <a href="#" class="prevnext last">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="container p-0">
            <div class="row">
                <div class="col-lg-8">
                    <div class="post d-flex">
                        <div class="wrap-ut pull-left d-flex">
                            <div class="userinfo pull-left">
                                <div class="avatar">
                                    <img src="">
                                    <div class="status">

                                    </div>
                                </div>
                                <div class="icons">
                                    <img src="" alt="">
                                    <img src="" alt="">
                                </div>
                            </div>
                            <div class="posttext pull-left">
                                <h2>
                                    <a href="#">Topic title</a>
                                </h2>
                                <p>Begining of the topic</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="postinfo pull-left">
                            <div class="comments text-center">
                                <div class="commentbg">
                                    <span class="numberOfComments">450</span>
                                    <div class="mark"></div>
                                </div>
                            </div>
                            <div class="views text-center">
                                <i class="fa fa-eye"></i>
                                <span id="nombreDeVue">1520</span>
                            </div>
                            <div class="time text-center">
                                <i class="far fa-clock"></i>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="post">
                        <div class="wrap-ut pull-left">
                            <div class="userinfo pull-left">
                                <div class="avatar">
                                    <img src="">
                                    <div class="status">

                                    </div>
                                </div>
                                <div class="icons">
                                    <img src="" alt="">
                                    <img src="" alt="">
                                </div>
                            </div>
                            <div class="posttext pull-left">
                                <h2>
                                    <a href="#">Topic title</a>
                                </h2>
                                <p>Begining of the topic</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="postinfo pull-left">
                            <div class="comments text-center">
                                <div class="commentbg">
                                    <span class="numberOfComments"></span>
                                    <div class="mark"></div>
                                </div>
                            </div>
                            <div class="views">
                                <i class="fa fa-eye"></i>
                            </div>
                            <div class="time">
                                <i class="fa fa-clock-o"></i>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div id="paginationMenu2" class="container d-lg-none">
                    <div class="row justify-content-center justify-content-lg-start">
                        <div class="col-lg-8 col-sm-12 col-md-8 d-flex ">
                            <div class="pull-left">
                                <a href="#" class="prevnext">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                            </div>
                            <div class="pull-left">
                                <ul class="paginationForum p-0">
                                    <li class="d-none d-xl-inline-block">
                                        <a href="#">1</a>
                                    </li>
                                    <li class="d-none d-lg-inline-block">
                                        <a href="#">2</a>
                                    </li>
                                    <li class="d-none d-lg-inline-block">
                                        <a href="#">3</a>
                                    </li>
                                    <li class="d-none d-sm-inline-block">
                                        <a href="#">4</a>
                                    </li>
                                    <li>
                                        <a href="#">5</a>
                                    </li>
                                    <li>
                                        <a href="#">6</a>
                                    </li>
                                    <li>
                                        <a href="#" class="active">7</a>
                                    </li>

                                    <li>
                                        <a href="#">8</a>
                                    </li>
                                    <li>
                                        <a href="#">9</a>
                                    </li>
                                    <li class="d-none d-sm-inline-block">
                                        <a href="#">10</a>
                                    </li>
                                    <li class="d-none d-lg-inline-block">
                                        <a href="#">11</a>
                                    </li>
                                    <li class="d-none d-lg-inline-block">
                                        <a href="#">12</a>
                                    </li>
                                    <li class="d-none d-xl-inline-block">
                                        <a href="#">1586</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="pull-left">
                                <a href="#" class="prevnext last">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mt-5 mt-lg-0">
                    <div class="sidebarblock">
                        <h3 class="m-0">Categories</h3>
                        <div class="blocktxt">
                            <ul class="cats m-0 p-0">
                                <li>
                                    <a href="#">
                                        Text
                                        <span class="badge pull-right">20</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Text
                                        <span class="badge pull-right">20</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="sidebarblock">
                        <h3 class="m-0">sondage du moment</h3>
                        <div class="blocktxt">
                            <p>A quel jeux jouez-vous en ce moment ?</p>
                            <form action="#" class="form" method="post">
                                <table class="poll w-100">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar color1 text-left" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">Choix 1</div>
                                                </div>
                                            </td>
                                            <td class="chbox">
                                                <input type="radio" name="opt1" value="1" id="opt1">
                                                <label for="opt1"></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar color2 text-left" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">Choix 2</div>
                                                </div>
                                            </td>
                                            <td class="chbox">
                                                <input type="radio" name="opt2" value="2" id="opt2">
                                                <label for="opt2"></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar color3 text-left" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">Choix 3</div>
                                                </div>
                                            </td>
                                            <td class="chbox">
                                                <input type="radio" name="opt3" value="3" id="opt3">
                                                <label for="opt3"></label>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                            <p class="small">Les votes se terminent le 19 janvier</p>
                        </div>
                    </div>
                    <div class="sidebarblock">
                        <h3 class="m-0">Derniers articles</h3>
                        <div class="blocktxt">
                            <a href="#">Article 1</a>
                        </div>
                        <div class="blocktxt">
                            <a href="#">Article 2</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="paginationMenu3" class="container p-0 d-none d-lg-block">
            <div class="row">
                <div class="col-lg-8 col-sm-12 col-md-8 d-flex">
                    <div class="pull-left">
                        <a href="#" class="prevnext">
                            <i class="fa fa-angle-left"></i>
                        </a>
                    </div>
                    <div class="pull-left">
                        <ul class="paginationForum p-0">
                            <li class="d-none d-xl-inline-block">
                                <a href="#">1</a>
                            </li>
                            <li class="d-none d-lg-inline-block">
                                <a href="#">2</a>
                            </li>
                            <li class="d-none d-lg-inline-block">
                                <a href="#">3</a>
                            </li>
                            <li class="d-none d-sm-inline-block">
                                <a href="#">4</a>
                            </li>
                            <li>
                                <a href="#">5</a>
                            </li>
                            <li>
                                <a href="#">6</a>
                            </li>
                            <li>
                                <a href="#" class="active">7</a>
                            </li>

                            <li>
                                <a href="#">8</a>
                            </li>
                            <li>
                                <a href="#">9</a>
                            </li>
                            <li class="d-none d-sm-inline-block">
                                <a href="#">10</a>
                            </li>
                            <li class="d-none d-lg-inline-block">
                                <a href="#">11</a>
                            </li>
                            <li class="d-none d-lg-inline-block">
                                <a href="#">12</a>
                            </li>
                            <li class="d-none d-xl-inline-block">
                                <a href="#">1586</a>
                            </li>
                        </ul>
                    </div>
                    <div class="pull-left">
                        <a href="#" class="prevnext last">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <div class="container">
            <div class="row text-center text-sm-left">
                <div class="col-lg-1 col-sm-2 logo">
                    <a href="#">
                        <img src="" alt="Logo d'Imperacube">
                    </a>
                </div>
                <div class="col-lg-8 col-sm-6 text-sm-center text-lg-left pl-lg-5">Copyrights 2019, imperacube.fr</div>
                <div class="col-lg-3 col-sm-4 sociconcent text-sm-right">
                    <ul class="socialicons p-0 mb-0">
                        <li>
                            <a href="#facebook">
                                <i class="fab fa-facebook-square"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#youtube">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    
</div>

<!-- Page d'exemple 

http://forum.azyrusthemes.com/index.html

Tu t'es arrêté au label des sidebackblock (radio checkbox)

-->