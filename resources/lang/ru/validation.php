<?php

return [
    'required' => 'Поле :attribute обязательно для заполнения.',
    'confirmed' => 'Поле :attribute должно совпадать с полем подтверждения.',
    'unique' => ':Attribute уже занято.',
    'same' => 'Поле :attribute должно совпадать с полем :other.',

    'min' => [
        'numeric' => ':Attribute должен быть не менее :min символов.',
        'file' => ':Attribute должен быть не менее :min килобайт.',
        'string' => ':Attribute должен быть не менее :min символов.',
        'array' => ':Attribute должен быть не менее :min элементов.',
    ],

    'attributes' => [
        'password' => 'пароль',
        'name' => 'имя',
    ],
];
