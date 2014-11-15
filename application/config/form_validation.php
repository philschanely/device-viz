<?php

/* Repeating configurations */
$user_id = array(
    'field' => 'user_id',
    'label' => 'identification number',
    'rules' => 'required|integer'
);
$user_email = array(
    'field' => 'email',
    'label' => 'e-mail',
    'rules' => 'required|valid_email'
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
            'rules'=>'required|trim|prep_url'
        ),
        array(
            'field'=>'description',
            'label'=>'description',
            'rules'=>'trim|xss_clean'
        )
    ),
    'group/edit' => array(
        array(
            'field'=>'site',
            'label'=>'site',
            'rules'=>'required|integer'
        ),
        array(
            'field'=>'name',
            'label'=>'name',
            'rules'=>'required|trim'
        ),
        array(
            'field'=>'icon',
            'label'=>'icon',
            'rules'=>'required|integer'
        ),
        array(
            'field'=>'min_width',
            'label'=>'minimum width',
            'rules'=>'required|integer'
        ),
        array(
            'field'=>'max_width',
            'label'=>'maximum width',
            'rules'=>'required|integer'
        ),
        array(
            'field'=>'order',
            'label'=>'order',
            'rules'=>'required|integer'
        ),
        array(
            'field'=>'allow_portrait',
            'label'=>'include portrait orientations',
            'rules'=>'required|integer'
        )
    ),
    'period/edit' => array(
        array(
            'field'=>'site',
            'label'=>'site',
            'rules'=>'required|integer'
        ),
        array(
            'field'=>'start_date',
            'label'=>'start date',
            'rules'=>'required'
        ),
        array(
            'field'=>'end_date',
            'label'=>'end date',
            'rules'=>'required'
        )
    ),
);

