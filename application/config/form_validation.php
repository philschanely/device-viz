<?php

$config = array(
    'user/signup' => array(
        array(
            'field' => 'email',
            'label' => 'e-mail',
            'rules' => 'required'
        ),
        array(
            'field' => 'password',
            'label' => 'password',
            'rules' => 'required'
        ),
        array(
            'field' => 'password2',
            'label' => 'password confirmation',
            'rules' => 'required|matches[password]'
        ),
        array(
            'field' => 'name',
            'label' => 'name',
            'rules' => 'required|trim'
        )
    ),
    'user/login' => array(
        array(
            'field' => 'email',
            'label' => 'e-mail',
            'rules' => 'required'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required'
        )
    )                          
);

