<?php
/**
 * Created by PhpStorm.
 * User: Alberto
 * Date: 22/08/2016
 * Time: 12:39
 */
namespace AppBundle\Model;

class Emails
{
    private $to,$from, $mensaje, $subject;

    public function __construct($to = '', $from = '', $subject= '', $mensaje = '') {
        $this->to = $to;
        $this->from = $from;
        $this->subject = $subject;
        $this->mensaje = $mensaje;
    }

    public function createEmailAlta($to = '', $from = '', $mensaje = '')
    {
        $this->to ='koushenwd@gmail.com';
        $this->from = 'web@libreria.com';
        $this->subject = 'New Book';
        $this->mensaje ='Se ha dado de alta un libro';
    }

    public function sendEmail(){
        mail($this->to,$this->subject,$this->mensaje);
    }
}
