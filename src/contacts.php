<?php
class Contact
{
    private $fName;
    private $lName;
    private $phone;
    private $street;
    private $city;
    private $state;
    private $zip;
    private $img;

    function __construct($fName, $lName, $email, $phone, $street, $city, $state, $zip, $img)
    {
        $this->fName = $fName;
        $this->lName = $lName;
        $this->email = $email;
        $this->phone = $phone;
        $this->street = $street;
        $this->city = $city;
        $this->state = $state;
        $this->zip = $zip;
        $this->img = $img;
    }

    function setFName($new_fName)
    {
        $this->fName = (string) $new_fName;
    }

    function setLName($new_lName)
    {
        $this->lName = (string) $new_lName;
    }

    function setEmail($new_email)
    {
        $this->email = (string) $new_email;
    }

    function setPhone ($new_phone)
    {
        $this->phone = (string) $new_phone;
    }

    function setStreet($new_street)
    {
        $this->street = (string) $new_street;
    }

    function setCity($new_city)
    {
        $this->city = (string) $new_city;
    }

    function setState($new_state)
    {
        $this->state = (string) $new_state;
    }

    function setZip($new_zip)
    {
        $this->zip = (int) $new_zip;
    }

    function setImg($new_img)
    {
        $this->img = (string) $new_img;
    }

    function getFName()
    {
        return $this->fName;
    }

    function getLName()
    {
        return $this->lName;
    }

    function getEmail()
    {
        return $this->email;
    }

    function getPhone()
    {
        return $this->phone;
    }

    function getStreet()
    {
        return $this->street;
    }

    function getCity()
    {
        return $this->city;
    }

    function getState()
    {
        return $this->state;
    }

    function getZip()
    {
        return $this->zip;
    }

    function getImg()
    {
        return $this->img;
    }

    function save()
    {
        array_push($_SESSION['list_of_contacts'], $this);
    }

    static function getMatches($searchName)
    {
        $matches = array();
        foreach ($_SESSION['list_of_contacts'] as $contact) {
            if (strtoupper($contact->getFName()) == strtoupper($searchName) || strtoupper($contact->getLName()) == strtoupper($searchName))
            {
                array_push($matches, $contact);
            }
        }
        return $matches;
    }

    static function getAll()
    {
        return $_SESSION['list_of_contacts'];
    }

    static function clearAll()
    {
        return $_SESSION['list_of_contacts'] = array();
    }
}
?>
