<?php
    include("template/debut.php"); // On insère le menu et on démarre la session. 
?>

<div id="forum">
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
        <?php
            include("template/menu.php"); // On insère le menu et on démarre la session. 
        ?>
    </header>
    <section class="content">
        <div id="paginationMenu" class="container p-0">
            <div class="row">
                <div class="col-lg-8 col-xs-12 col-md-8 d-flex">
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
                <div class="col-lg-8 col-md-8">
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
                <div class="col-lg-4 col-md-4">
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
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-xs-12 col-md-8">
                    <div class="pull-left">
                        <a href="#" class="prevnext">
                            <i class="fa fa-angle-left"></i>
                        </a>
                    </div>
                    <div class="pull-left">
                        <ul class="paginationForum">
                            <li class="hidden-xs">
                                <a href="#">1</a>
                            </li>
                            <li class="hidden-xs">
                                <a href="#">2</a>
                            </li>
                            <li class="hidden-xs">
                                <a href="#">3</a>
                            </li>
                            <li class="hidden-xs">
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
                            <li class="hidden-xs">
                                <a href="#">9</a>
                            </li>
                            <li class="hidden-xs">
                                <a href="#">10</a>
                            </li>
                            <li class="hidden-xs hidden-md">
                                <a href="#">11</a>
                            </li>
                            <li class="hidden-xs hidden-md">
                                <a href="#">12</a>
                            </li>
                            <li class="hidden-xs hidden-sm hidden-md">
                                <a href="#">13</a>
                            </li>
                            <li>
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
            <div class="row">
                <div class="col-lg-1 col-xs-3 col-sm-2 logo">
                    <a href="#">
                        <img src="" alt="Logo d'Imperacube">
                    </a>
                </div>
                <div class="col-lg-8 col-xs-9 col-sm-5">Copyrights 2019, imperacube.fr</div>
                <div class="col-lg-3 col-xs-12 col-sm-5 sociconcent">
                    <ul class="socialicons">
                        <li>
                            <a href="#facebook">
                                <i class="fa fa-facebook-square"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#twitter">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#youtube">
                                <i class="fa fa-youtube"></i>
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