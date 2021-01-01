<?php

return [
    'name' => [
        'required' => 'İsim alanı gereklidir.',
        'min' => 'İsim alanı minimum 6 karakterden oluşmalıdır.',
        'max' => 'İsim alanı maksimum 50 karakter olabilir.',
        'string' => 'İsim alanı rakam içeremez!',
    ],
    'email' => [
        'required' => 'Eposta alanı gereklidir.',
        'min' => 'Eposta alanı minimum 6 karakterden oluşmalıdır.',
        'max' => 'Eposta alanı maksimum 50 karakter olabilir.',
        'email' => 'Lütfen geçerli bir e-posta adresi giriniz!.',
        'unique' => 'Bu kullanılamaz.',
    ],
    'password' => [
        'required' => 'Lütfen bir şifre belirtiniz.',
        'min' => 'Şifre alanı minimum 6 karakterden oluşmalıdır.',
        'max' => 'Şifre alanı maksimum 50 karakterden oluşmalıdır.',
        'confirmed' => 'Şifre alanı ile Şifre teyit alanı uyuşmalıdır.'
    ]
];
