<?php

/* Repeating configurations */
$user_id = array(
    'field' => 'user_id',
    'label' => 'identification number',
    'rules' => 'required'
);
$user_email = array(
    'field' => 'email',
    'label' => 'e-mail',
    'rules' => 'required'
);
$user_name = array(
    'field' => 'name',
    'label' => 'name',
    'rules' => 'required|trim'
);
$user_password = array(
    'field' => 'password',
    'label' => 'password',
    'rules' => 'required'
);
$user_password2 = array(
    'field' => 'password2',
    'label' => 'password confirmation',
    'rules' => 'required|matches[password]'
);

/* Validation configureations */
$config = array(
    'user/signup' => array(
        $user_email, $user_name, 
        $user_password, $user_password2
    ),
    'user/login' => array($user_email, $user_password),
    'user-change-info' => array(
        $user_id, $user_email, $user_name
    ),
    'user-change-password' => array(
        $user_id, $user_password, $user_password2
    ),
    'user-request-reset' => array($user_email),
    'user-reset' => array($user_id, $user_password, $user_password2),
    'site/edit' => array(
        array(
            'field'=>'name',
            'label'=>'name',
            'rules'=>'required|trim'
        ),
        array(
            'field'=>'url',
            'label'=>'url',
            'rules'=>'required|trim'
        ),
        array(
            'field'=>'description',
            'label'=>'description',
            'rules'=>'trim'
        )
    )
);

