<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/contacts.php";

    session_start();

    if(empty($_SESSION['list_of_contacts'])) {
        $_SESSION['list_of_contacts'] = array();
    }

    $app = new Silex\Application();
    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('contacts.html.twig', array('contacts' => Contact::getAll()));
    });

    $app->get("/addName", function() use ($app) {
        return $app['twig']->render('addContact.html.twig');
    });

    $app->post("/newContacts", function() use ($app) {
        $newContact = new Contact($_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['phone'], $_POST['street'], $_POST['city'], $_POST['state'], $_POST['zip'], $_POST['img']);
        $newContact->save();
        return $app['twig']->render('showNewContact.html.twig', array('contact' => $newContact));
    });

    $app->post("/searchResults", function() use ($app) {
        $matches = Contact::getMatches($_POST['searchName']);

        return $app['twig']->render('search.html.twig', array('matches' => $matches));
    });

    $app->get("/clearAll", function() use ($app) {
        Contact::clearAll();
        return $app['twig']->render('clearAll.html.twig');
    });

    return $app;
?>
