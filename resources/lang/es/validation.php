<?php

declare(strict_types=1);

return [
    'slug' => 'El campo :attribute debe ser una URL amigable válida.',
    'even' => 'El campo :attribute debe ser un número par.',
    'odd' => 'El campo :attribute debe ser un número impar.',
    'semver' => 'El campo :attribute debe ser una versión semántica válida (p. ej. 1.0.0).',
    'base64_string' => 'El campo :attribute debe ser una cadena válida codificada en base64.',
    'luhn' => 'El campo :attribute debe superar la validación checksum de Luhn.',
    'min_words' => 'El campo :attribute debe tener al menos :min palabras.',
    'max_words' => 'El campo :attribute no debe superar :max palabras.',
    'domain' => 'El campo :attribute debe ser un nombre de dominio válido.',
    'e164' => 'El campo :attribute debe ser un número de teléfono válido en formato E.164 (p. ej. +14155552671).',
    'isbn' => 'El campo :attribute debe ser un ISBN válido.',
    'country_code' => 'El campo :attribute debe ser un código de país ISO 3166-1 válido.',
    'hex_color' => 'El campo :attribute debe ser un código de color hexadecimal válido.',
    'without_alias' => 'El campo :attribute no debe contener un alias con signo más (p. ej. usuario+etiqueta@ejemplo.com).',
    'not_email' => 'El campo :attribute no debe ser una dirección de correo electrónico.',
    'latitude' => 'El campo :attribute debe ser una latitud válida entre -90 y 90 grados.',
    'longitude' => 'El campo :attribute debe ser una longitud válida entre -180 y 180 grados.',
    'cidr' => 'El campo :attribute debe ser un bloque válido en notación CIDR.',
    'email_domain' => 'El campo :attribute debe ser una dirección de correo electrónico de un dominio autorizado.',
    'not_hashed' => 'El campo :attribute no debe ser una cadena previamente hasheada.',
    'alpha_underscore' => 'El campo :attribute solo puede contener letras, números y guiones bajos.',
    'unless_between' => 'El campo :attribute no debe estar entre :min y :max.',
    'without_whitespace' => 'El campo :attribute no debe contener espacios en blanco.',
    'no_html' => 'El campo :attribute no debe contener etiquetas HTML.',
    'url_protocol' => 'El campo :attribute debe usar uno de los siguientes protocolos: :protocols.',
    'snake_case' => 'El campo :attribute debe tener formato snake_case.',
    'multiple_of' => 'El campo :attribute debe ser un múltiplo de :step.',
    'alpha_num_ascii' => 'El campo :attribute solo puede contener letras y números ASCII.',
];
