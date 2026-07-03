<?php
namespace clases;

class DigitalSignature
{
    private static string $secret = 'clave_secreta_super_segura'; // Debe venir de .env

    public static function sign(array $data): string
    {
        $payload = json_encode($data);
        return hash_hmac('sha256', $payload, self::$secret);
    }

    public static function verify(array $data, string $signature): bool
    {
        $expected = self::sign($data);
        return hash_equals($expected, $signature);
    }
}