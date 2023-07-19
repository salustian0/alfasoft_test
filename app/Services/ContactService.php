<?php

namespace App\Services;

class ContactService
{
    function getContacts()
    {

        $mockContacts = array();
        for ($i = 0; $i < 10; $i++) {
            $mockContacts[] = array(
                'id' => $i,
                'name' => "Nome contato {$i}",
                'email' => "email@contato{$i}.com",
                'contact' => "11 9 0000-000{$i}",
            );
        }

        return $mockContacts;
    }
}
