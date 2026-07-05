<?php
namespace clases;

class DigitalSignature
{
    private static string $secret = 'clave_secreta_super_segura';

    public static function sign(array $data): string
    {
        ksort($data);
        $payload = json_encode($data);
        return hash_hmac('sha256', $payload, self::$secret);
    }

    public static function verify(array $data, string $signature): bool
    {
        $expected = self::sign($data);
        return hash_equals($expected, $signature);
    }

    public static function signData(array $data): array
    {
        $signature = self::sign($data);
        $data['signature'] = $signature;
        return $data;
    }

    public static function verifyAndExtract(array $data): ?array
    {
        if (!isset($data['signature'])) {
            return null;
        }
        $signature = $data['signature'];
        unset($data['signature']);
        if (self::verify($data, $signature)) {
            return $data;
        }
        return null;
    }
}