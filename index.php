<?php
    //~ URL appelée nous retournant des données au format JSON.
    $data_url = 'http://api.randomuser.me/?results=3';

    //~ On appelle l'URL et on stocke le contenu retourné dans une variable.
    $data_contenu = file_get_contents($data_url);

    //~ Les données étant au format JSON, on les décode pour les stocker sous la forme d'un tableau associatif.
    $data_array = json_decode($data_contenu, true);

    //~ On pointe directement sur les données du/des utilisateur(s) retourné(s).
    $utilisateurs = $data_array['results'];

    //~ On requiert l'autoloader pour appeler les templates.
    require_once "vendor/autoload.php";

    // On appelle le dossier où on trouve les templates.
    $loader = new \Twig\Loader\FilesystemLoader('templates');

    // On initialise l'environnement Twig.
    $twig = new \Twig\Environment($loader);

    // On prépare la variable de données pour Twig.
    $twig->addGlobal("users", $utilisateurs);

    // On charge le template.
    $template = $twig->load("index.html.twig");
    
    echo $template->render([]);