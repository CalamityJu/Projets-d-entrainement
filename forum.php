<?php
    require_once("template/debut.php"); // On insère le menu et on démarre la session. 
    require_once("template/menu.php"); // On insère le menu et on démarre la session. 
    require_once("template/forum_category.php"); // On charge les différentes catégories
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
    </header>
    <section class="content">
    <div class="container p-0 mt-5">
            <div class="row">
                <div class="col-lg-8">
                    <?php foreach ($categories as $categorie) : 
                        if($user_permission >= $categorie['auth_view']): ?> 
                        <div class="category d-flex">
                            <a class = "wrap-ut" href="forum_topic.php?id=<?php echo $categorie['forum_id']; ?>">
                            <div class="pull-left d-flex">
                                <div class="cattext pull-left ml-5">
                                    <h2>
                                        <?php echo $categorie['forum_title']; ?>
                                    </h2>
                                    <p><?php echo $categorie['forum_description']; ?></p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                             </a>
                            <div class="catinfo pull-left d-none d-md-block">
                                <div class="time text-center">
                                    <i class="far fa-clock"></i>
                                    <?php echo get_last_message_time($bdd, $categorie['forum_id']); ?>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <?php endif;
                    endforeach ; ?>
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
    </section>
</div>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/menu.js"></script>