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

    $app->get("/searchResults", function() use ($app) {
        $matches = array();
        foreach (Contact::getAll() as $contact) {
            if (strtoupper($contact->getFName()) == strtoupper($_GET['searchName']) || strtoupper($contact->getLName()) == strtoupper($_GET['searchName']))
            {
                array_push($matches, $contact);
            }
        }
        return $app['twig']->render('search.html.twig', array('matches' => $matches));
    });

    return $app;
?>
