<?php
// Auth
$router->get('/login', 'AuthController', 'showLogin');
$router->post('/login', 'AuthController', 'login');
$router->get('/register', 'AuthController', 'showRegister');
$router->post('/register', 'AuthController', 'register');
$router->get('/logout', 'AuthController', 'logout');

// Dashboard
$router->get('/dashboard', 'DashboardController', 'index');

// Juego
$router->get('/game', 'GameController', 'selectMode');
$router->get('/game/start/{themeLevelId}', 'GameController', 'start');
$router->get('/game/play/{sessionId}', 'GameController', 'play');
$router->post('/game/submit/{sessionId}', 'GameController', 'submitAnswers');
$router->get('/game/results/{sessionId}', 'GameController', 'results');

// Multijugador
$router->get('/game/room/create', 'GameController', 'createRoom');
$router->post('/game/room/store', 'GameController', 'storeRoom');
$router->get('/game/room/{roomCode}', 'GameController', 'joinRoom');

// Acceso directo por código QR
$router->get('/qr/{themeLevelId}', 'GameController', 'accessByQr');

// Panel de administración: generar/ver los códigos QR de cada tema-nivel
$router->get('/admin/qr', 'QrController', 'index');

// Perfil
$router->get('/profile', 'ProfileController', 'show');
$router->post('/profile/avatar', 'ProfileController', 'updateAvatar');

// Avatares
$router->get('/avatars', 'AvatarController', 'index');
$router->post('/avatars/store', 'AvatarController', 'store');
$router->post('/avatars/update/{id}', 'AvatarController', 'update');
$router->post('/avatars/activate/{id}', 'AvatarController', 'activate');
$router->post('/avatars/deactivate/{id}', 'AvatarController', 'deactivate');
$router->post('/avatars/delete/{id}', 'AvatarController', 'destroy');

// Estadísticas
$router->get('/statistics', 'StatisticsController', 'index');

// Ranking
$router->get('/ranking', 'RankingController', 'index');

// Admin Usuarios
$router->get('/admin/users', 'UserController', 'index');
$router->get('/admin/users/create', 'UserController', 'create');
$router->post('/admin/users/store', 'UserController', 'store');
$router->get('/admin/users/edit/{id}', 'UserController', 'edit');
$router->post('/admin/users/update/{id}', 'UserController', 'update');
$router->post('/admin/users/delete/{id}', 'UserController', 'delete');

// Admin Temas
$router->get('/admin/themes', 'ThemeController', 'index');
$router->get('/admin/themes/create', 'ThemeController', 'create');
$router->post('/admin/themes/store', 'ThemeController', 'store');
$router->get('/admin/themes/edit/{id}', 'ThemeController', 'edit');
$router->post('/admin/themes/update/{id}', 'ThemeController', 'update');
$router->post('/admin/themes/delete/{id}', 'ThemeController', 'delete');

// Rating de temas (ajax)
$router->post('/themes/rate', 'ThemeController', 'rate');

// Admin Preguntas
$router->get('/admin/questions', 'QuestionController', 'index');
$router->get('/admin/questions/create', 'QuestionController', 'create');
$router->post('/admin/questions/store', 'QuestionController', 'store');
$router->get('/admin/questions/edit/{id}', 'QuestionController', 'edit');
$router->post('/admin/questions/update/{id}', 'QuestionController', 'update');
$router->post('/admin/questions/delete/{id}', 'QuestionController', 'delete');

// Admin Premios
$router->get('/admin/prizes', 'PrizeController', 'index');
$router->get('/admin/prizes/create', 'PrizeController', 'create');
$router->post('/admin/prizes/store', 'PrizeController', 'store');
$router->get('/admin/prizes/edit/{id}', 'PrizeController', 'edit');
$router->post('/admin/prizes/update/{id}', 'PrizeController', 'update');
$router->post('/admin/prizes/delete/{id}', 'PrizeController', 'delete');

// Admin Encuestas
$router->get('/admin/surveys', 'SurveyController', 'index');
$router->get('/admin/surveys/create', 'SurveyController', 'create');
$router->post('/admin/surveys/store', 'SurveyController', 'store');
$router->get('/admin/surveys/edit/{id}', 'SurveyController', 'edit');
$router->post('/admin/surveys/update/{id}', 'SurveyController', 'update');
$router->post('/admin/surveys/delete/{id}', 'SurveyController', 'delete');

// Landing pública
$router->get('/', 'LandingController', 'index');
$router->get('/about', 'LandingController', 'about');
$router->get('/contact', 'LandingController', 'contact');

// Promocional con encuestas
$router->get('/promo', 'PromoController', 'index');
$router->post('/promo/submit-survey', 'PromoController', 'submitSurvey');

// Reporte Excel (admin)
$router->get('/admin/report', 'AdminController', 'downloadReport');