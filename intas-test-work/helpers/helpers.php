<?php

function dd(mixed $data): void
{
    d($data);
    exit();
}

function d(mixed $data): void
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}

function includeView(string $template, array $data = []): void
{
    extract($data);
    include VIEW . '/' . $template . '.php';
}