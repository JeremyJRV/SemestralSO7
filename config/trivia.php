<?php

return [
    /**
     * Configuración del Sistema de Trivias
     */

    // Configuración de seguridad
    'security' => [
        'max_login_attempts' => 3,
        'lock_duration_minutes' => 15,
        'password_min_length' => 8,
        'password_max_length' => 12,
    ],

    // Configuración del juego
    'game' => [
        'questions_per_session' => 10,
        'passing_score_percentage' => 80,
        'points_per_correct_answer' => 10,
        'max_session_duration_seconds' => 3600,
    ],

    // Configuración de niveles
    'levels' => [
        'basico' => ['order' => 1, 'name' => 'Básico'],
        'intermedio' => ['order' => 2, 'name' => 'Intermedio'],
        'avanzado' => ['order' => 3, 'name' => 'Avanzado'],
    ],

    // Configuración de temas
    'themes' => [
        'php' => ['name' => 'PHP', 'icon' => 'php-icon'],
        'javascript' => ['name' => 'JavaScript', 'icon' => 'js-icon'],
        'laravel' => ['name' => 'Laravel', 'icon' => 'laravel-icon'],
    ],

    // Configuración de auditoría
    'audit' => [
        'log_login_attempts' => true,
        'log_failed_validations' => true,
        'log_role_changes' => true,
        'retention_days' => 90,
    ],

    // Configuración de emails
    'email' => [
        'send_welcome_email' => true,
        'send_achievement_emails' => true,
    ],
];