<?php
session_start();


define('PERSO_GENRES', ['homme', 'femme']);
define('PERSO_CHEVEUX', ['bruns', 'blonds', 'gris']);
define('PERSO_PEAU', ['claire', 'foncée']);
define('PERSO_MOUSTACHE', ['sans', 'avec']);
define('PERSO_BARBE', ['sans', 'avec']);

$liste_complete = [
  'u_01' => [
    'emoji' => '🧑🏻',
    'genre' => PERSO_GENRES[0],
    'cheveux' => PERSO_CHEVEUX[0],
    'peau' => PERSO_PEAU[0],
    'moustache' => PERSO_MOUSTACHE[0],
    'barbe' => PERSO_BARBE[0]
  ],
  'u_02' => [
    'emoji' => '👱🏻‍♂️',
    'genre' => PERSO_GENRES[0],
    'cheveux' => PERSO_CHEVEUX[1],
    'peau' => PERSO_PEAU[0],
    'moustache' => PERSO_MOUSTACHE[0],
    'barbe' => PERSO_BARBE[0]
  ],
  'u_03' => [
    'emoji' => '👩🏻',
    'genre' => PERSO_GENRES[1],
    'cheveux' => PERSO_CHEVEUX[0],
    'peau' => PERSO_PEAU[0],
    'moustache' => PERSO_MOUSTACHE[0],
    'barbe' => PERSO_BARBE[0]
  ],
  'u_04' => [
    'emoji' => '🧓🏻',
    'genre' => PERSO_GENRES[1],
    'cheveux' => PERSO_CHEVEUX[2],
    'peau' => PERSO_PEAU[0],
    'moustache' => PERSO_MOUSTACHE[0],
    'barbe' => PERSO_BARBE[0]
  ],
  'u_05' => [
    'emoji' => '👨🏿',
    'genre' => PERSO_GENRES[0],
    'cheveux' => PERSO_CHEVEUX[0],
    'peau' => PERSO_PEAU[1],
    'moustache' => PERSO_MOUSTACHE[1],
    'barbe' => PERSO_BARBE[0]
  ],
  'u_06' => [
    'emoji' => '👱🏿‍♀️',
    'genre' => PERSO_GENRES[1],
    'cheveux' => PERSO_CHEVEUX[1],
    'peau' => PERSO_PEAU[1],
    'moustache' => PERSO_MOUSTACHE[0],
    'barbe' => PERSO_BARBE[0]
  ],
  'u_07' => [
    'emoji' => '🧓🏿',
    'genre' => PERSO_GENRES[1],
    'cheveux' => PERSO_CHEVEUX[2],
    'peau' => PERSO_PEAU[1],
    'moustache' => PERSO_MOUSTACHE[0],
    'barbe' => PERSO_BARBE[0]
  ],
  'u_08' => [
    'emoji' => '🧔🏻',
    'genre' => PERSO_GENRES[0],
    'cheveux' => PERSO_CHEVEUX[0],
    'peau' => PERSO_PEAU[0],
    'moustache' => PERSO_MOUSTACHE[1],
    'barbe' => PERSO_BARBE[1]
  ],
  'u_09' => [
    'emoji' => '🧔🏿',
    'genre' => PERSO_GENRES[0],
    'cheveux' => PERSO_CHEVEUX[0],
    'peau' => PERSO_PEAU[1],
    'moustache' => PERSO_MOUSTACHE[1],
    'barbe' => PERSO_BARBE[1]
  ],
  'u_10' => [
    'emoji' => '👴🏻',
    'genre' => PERSO_GENRES[0],
    'cheveux' => PERSO_CHEVEUX[2],
    'peau' => PERSO_PEAU[0],
    'moustache' => PERSO_MOUSTACHE[0],
    'barbe' => PERSO_BARBE[0]
  ],
  'u_11' => [
    'emoji' => '👴🏿',
    'genre' => PERSO_GENRES[0],
    'cheveux' => PERSO_CHEVEUX[2],
    'peau' => PERSO_PEAU[1],
    'moustache' => PERSO_MOUSTACHE[0],
    'barbe' => PERSO_BARBE[0]
  ],
];

//Initialisation du personnage choisi par l'ordi.
cpu_choix_perso($liste_complete);

$reponses = [];
//Mise à jour de la liste de personnages selon les critères issus du formulaire.
$liste_selon_criteres = liste_persos_selon_criteres($liste_complete, $reponse);
/**
 * Séléctionne aléatoirement un perso et l'affecte en variable de session.
 */
function cpu_choix_perso(array $liste_complete)
{
  if (empty($_SESSION['cpu_perso']) || !empty($_POST['reload'])) {
    $rand_key = array_rand($liste_complete);
    $_SESSION['cpu_perso'] = $liste_complete[$rand_key];
    $_SESSION['cpu_perso']['id'] = $rand_key;
  }
}


function liste_persos_selon_criteres(array $liste_complete, &$reponse): array
{
  $liste_de_persos = $liste_complete;
  if (!empty($_GET)) {
    foreach ($_GET as $property => $value) {
      if ($value != 'none'){
        foreach ($liste_de_persos as $id => $personnage) {
          if ($personnage[$property] != $value)
            unset($liste_de_persos[$id]);
        }
        if($_SESSION['cpu_perso'][$property] == $_GET[$property]){
          $reponse[$property] = "<p class='text-success text-center'><span>Oui</p></p>";
        } else {
          $reponse[$property] = "<p class='text-danger text-center'><span>Non</span></p>";
        }
      }
    }
  }
  return $liste_de_persos;
}


if(isset($_POST['answer'])){
  if($_POST['answer'] == $_SESSION['cpu_perso']['id']){
    $resultat = '<h3 class="text-success text-center pb-4">Gagné !</h3>';
    $choix_ordi = $_SESSION['cpu_perso']['emoji'];
  } else {
    $resultat = '<h3 class="text-danger text-center pb-4">Perdu !</h3>';
  }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <title>Expressions régulières</title>
</head>

<body class="bg-light">
  <div class="container py-5">
    <div class="shadow rounded p-5 bg-white">
      <h1 class="pb-5 display-1 text-center text-dark">Qui est-ce ?</h1>
      <?php if(isset($resultat)){ echo $resultat; }?>
      <form method="post" class="row justify-content-center">
        <?php foreach ($liste_selon_criteres as $id => $personnage) : ?>
          <div class="col-4">
            <button name="answer" type="submit" value="<?php echo $id; ?>">
            <h4 class="display-2 text-center"><?php echo $personnage['emoji']; ?></h4>
          </div>
        <?php endforeach; ?>
      </form>
    </div>
    <hr class="my-5">
    <div class="row no-gutters">
      <div class="col-3">
        <div class="shadow rounded p-5 bg-dark text-light">
          <h2 class="text-center">Choix de l'ordinateur</h2>
          <h4 class="display-2 text-center"><?php if(isset($choix_ordi)){ echo $choix_ordi; } ?></h4>
          <form method="POST" class="d-flex justify-content-center">
            <button type="submit" name="reload" value="1" class="btn btn-warning mt-2 text-center">Changer</button>
          </form>
        </div>
      </div>
      <div class="col-9">
        <div class="shadow rounded p-5 bg-white text-dark ml-4">
          <h2 class="text-center">Formulaire de recherche</h2>
          <form method="GET">
            <div class="form-row pb-4">
              <!-- Cheveux -->
              <div class="col">
                <div class="form-group">
                  <label for="cheveux">Cheveux</label>
                  <select class="form-control  form-control-lg" id="cheveux" name="cheveux">
                    <option selected value="none">-- Aucune valeur --</option>
                    <?php foreach (PERSO_CHEVEUX as $key => $value) : ?>
                      <!-- Si cette valeur est la valeur actuelle (càd passée via l'URL) -->
                      <?php if (!empty($_GET['cheveux']) && $_GET['cheveux'] == $value) : ?>
                        <option value="<?php echo $value; ?>" selected><?php echo $value; ?></option>
                      <?php else : ?>
                        <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  </select>
                </div>
                <?php if(isset($reponse['cheveux'])) {
                  echo $reponse['cheveux'];
                }?>
              </div>
              <!-- Peau -->
              <div class="col">
                <div class="form-group">
                  <label for="peau">Peau</label>
                  <select class="form-control  form-control-lg" id="peau" name="peau">
                    <option selected value="none">-- Aucune valeur --</option>
                    <?php foreach (PERSO_PEAU as $key => $value) : ?>
                      <!-- Si cette valeur est la valeur actuelle (càd passée via l'URL) -->
                      <?php if (!empty($_GET['peau']) && $_GET['peau'] == $value) : ?>
                        <option value="<?php echo $value; ?>" selected><?php echo $value; ?></option>
                      <?php else : ?>
                        <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  </select>
                </div>
                <?php if(isset($reponse['peau'])) {
                  echo $reponse['peau'];
                }?>
              </div>

              <!-- Genre -->
              <div class="col">
                <div class="form-group">
                  <label for="genre">Genre</label>
                  <select class="form-control  form-control-lg" id="genre" name="genre">
                    <option selected value="none">-- Aucune valeur --</option>
                    <?php foreach (PERSO_GENRES as $key => $value) : ?>
                      <!-- Si cette valeur est la valeur actuelle (càd passée via l'URL) -->
                      <?php if (!empty($_GET['genre']) && $_GET['genre'] == $value) : ?>
                        <option value="<?php echo $value; ?>" selected><?php echo $value; ?></option>
                      <?php else : ?>
                        <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  </select>
                </div>
                <?php if(isset($reponse['genre'])) {
                  echo $reponse['genre'];
                }?>
              </div>

              <!-- Moustache -->
              <div class="col">
                <div class="form-group">
                  <label for="moustache">Moustache</label>
                  <select class="form-control  form-control-lg" id="mostache" name="moustache">
                    <option selected value="none">-- Aucune valeur --</option>
                    <?php foreach (PERSO_MOUSTACHE as $key => $value) : ?>
                      <!-- Si cette valeur est la valeur actuelle (càd passée via l'URL) -->
                      <?php if (!empty($_GET['moustache']) && $_GET['moustache'] == $value) : ?>
                        <option value="<?php echo $value; ?>" selected><?php echo $value; ?></option>
                      <?php else : ?>
                        <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  </select>
                </div>
                <?php if(isset($reponse['moustache'])) {
                  echo $reponse['moustache'];
                }?>
              </div>

              <!-- Barbe -->
              <div class="col">
                <div class="form-group">
                  <label for="moustache">Barbe</label>
                  <select class="form-control  form-control-lg" id="barbe" name="barbe">
                    <option selected value="none">-- Aucune valeur --</option>
                    <?php foreach (PERSO_BARBE as $key => $value) : ?>
                      <!-- Si cette valeur est la valeur actuelle (càd passée via l'URL) -->
                      <?php if (!empty($_GET['barbe']) && $_GET['barbe'] == $value) : ?>
                        <option value="<?php echo $value; ?>" selected><?php echo $value; ?></option>
                      <?php else : ?>
                        <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  </select>
                </div>
                <?php if(isset($reponse['barbe'])) {
                  echo $reponse['barbe'];
                }?>
              </div>
            </div>

            <button type="submit" class="btn btn-primary btn-lg">Rechercher</button>
        </div>

        </form>
      </div>
    </div>
  </div>
  </div>
</body>

</html>
