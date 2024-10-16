<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegisterUserTest extends WebTestCase
{
    public function testSomething(): void
    {

        // 1. Créer un faux client (navigateur) de pointer vers une URL
        $client = static::createClient();
        $client->request('GET', '/inscription');

        // 2. Remplir le champ de mon formulaire d'inscription 
        // 2. firstname, lastname, email, password, confirmation du password, valider
        $client->submitForm('Valider', [
            'register_user[email]' => 'julie@exemple.fr',
            'register_user[plainPassword][first]' => '123456',
            'register_user[plainPassword][second]' => '123456',
            'register_user[firstname]' => 'Julie',
            'register_user[lastname]' => 'Doe'
        ]);
        
        // Follow
        $this->assertResponseRedirects('/login');
        $client->followRedirect();

        // 3. Est-ce que tu peux regarder si dans ma page j'ai le message (alert) suivant:
        // Votre compte est correctement créé, veuillez vous connecter.
        $this->assertSelectorExists('div:contains(Votre compte est correctement créé, veuillez vous connecter.)');
        
        // $crawler = $client->request('GET', '/');

        // $this->assertResponseIsSuccessful();
        // $this->assertSelectorTextContains('h1', 'Hello World');
    }
}
