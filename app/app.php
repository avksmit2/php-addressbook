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
    
    $app->get("/addName", function() use ($app) {
        return $app['twig']->render('addContact.html.twig');
    });

    $app->post("/newContacts", function() use ($app) {
        $newContact = new Contact($_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['phone'], $_POST['street'], $_POST['city'], $_POST['state'], $_POST['zip'], $_POST['img']);
        $newContact->save();
        return $app['twig']->render('showNewContact.html.twig', array('contact' => $newContact));
    });

    return $app;
?>
