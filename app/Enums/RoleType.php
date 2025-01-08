<?php

    namespace App\Enums;

    enum RoleType: string
    {
        case Admin = 'admin';
        case Author = 'author';
        case Editor = 'editor';
        case AuthorEditor = 'AuthorEditor';
    }
