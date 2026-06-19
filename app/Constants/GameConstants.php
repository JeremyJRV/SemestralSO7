<?php

namespace App\Constants;

/**
 * GameConstants
 * Constantes del sistema de trivias
 */
class GameConstants
{
    // Estados de sesión de juego
    const STATUS_EN_PROGRESO = 'en_progreso';
    const STATUS_COMPLETADA = 'completada';
    const STATUS_ABANDONADA = 'abandonada';

    // Tipos de preguntas
    const QUESTION_TYPE_MULTIPLE_CHOICE = 'opción_múltiple';
    const QUESTION_TYPE_TRUE_FALSE = 'verdadero_falso';

    // Roles de usuarios
    const ROLE_PLAYER = 'jugador';
    const ROLE_CREATOR = 'armador';
    const ROLE_ADMIN = 'administrador';

    // Niveles
    const LEVEL_BASIC = 'Básico';
    const LEVEL_INTERMEDIATE = 'Intermedio';
    const LEVEL_ADVANCED = 'Avanzado';

    // Calificaciones de tema
    const RATING_BORING = 1;
    const RATING_INTERESTING = 2;
    const RATING_AMAZING = 3;

    // Configuración de seguridad
    const MAX_LOGIN_ATTEMPTS = 3;
    const LOCK_DURATION_MINUTES = 15;

    // Configuración de juego
    const QUESTIONS_PER_SESSION = 10;
    const PASSING_PERCENTAGE = 80;
    const POINTS_PER_CORRECT = 10;
}