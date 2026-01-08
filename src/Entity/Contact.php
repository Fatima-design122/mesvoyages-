<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
/**
 * Description of Contact
 *
 * @author ordi2304690
 */
class Contact {
    #[Assert\NoBlank()]
    #[Assert\Length(min:2, max:100)]
    private ?string $nom;
    
    #[Assert\NoBlank()]
    #[Assert\Email()]
    private ?string $email;
    
    #[Assert\NoBlank()]
    private ?string $message;
    
    function getNom(): ?string {
        return $this->nom;
    }
    
    function getEmail(): ?string {
        return $this->email;
    }
    
    function getMessage(): ?string {
        return $this->message;
    }
    
    function setNom($nom):self {
        $this->nom = $nom;
        return $this;
    }
    
    function setEmail($email):self {
        $this->email = $email;
        return $this;
    }
    
    function setMessage($message):self {
        $this->message = $message;
        return $this;
    }
}

