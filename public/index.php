<?php

declare(strict_types=1);
session_start();

// Autoload
spl_autoload_register(function ($class) {
    $path = __DIR__ . '/../app/' . str_replace('\\', '/', $class) . '.php';
    if (is_file($path)) require $path;
});

use Core\Router;


// Normalisation du path pour sous-dossier (/PPE-main/public)
$requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$scriptDir   = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');

if ($scriptDir !== '' && $scriptDir !== '/' && strncmp($requestPath, $scriptDir, strlen($scriptDir)) === 0) {
    $requestPath = substr($requestPath, strlen($scriptDir)) ?: '/';
}

if ($requestPath === '/index.php') $requestPath = '/';

// Base URL (ex: /PPE-main/public/)
$baseUrl = rtrim($scriptDir, '/') . '/';
define('BASE_URL', $baseUrl);

// Création du router
$router = new Router();

// ------------------ Routes Etat ------------------
// CREATE
$router->get('/etat/create', [Controllers\EtatController::class, 'create']);
$router->post('/etat/create', [Controllers\EtatController::class, 'store']);

// INDEX
$router->get('/etat', [Controllers\EtatController::class, 'index']);
$router->get('/etat/', [Controllers\EtatController::class, 'index']);

// SHOW et UPDATE fallback manuel
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

// SHOW
if (preg_match('#^/etat/([0-9]+)$#', $requestPath, $m)) {
    (new \Controllers\EtatController)->show((int)$m[1]);
    exit;
}

// UPDATE
if (preg_match('#^/etat/([0-9]+)/update$#', $requestPath, $m)) {
    $ctrl = new \Controllers\EtatController;
    if ($method === 'GET') {
        $ctrl->update((int)$m[1]);
    } elseif ($method === 'POST') {
        $ctrl->save((int)$m[1]);
    }
    exit;
}
// DELETE
if (preg_match('#^/etat/([0-9]+)/delete$#', $requestPath, $m)) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        (new \Controllers\EtatController)->delete((int)$m[1]);
    }
    exit;
}

// ------------------ Routes FraisForfait ------------------
//CREATE
$router->get('/fraisforfait/create', [Controllers\fraisforfaitController::class, 'create']);
$router->post('/fraisforfait/store', [Controllers\fraisforfaitController::class, 'store']);

//INDEX
$router->get('/fraisforfait', [Controllers\fraisforfaitController::class, 'index']);
$router->get('/fraisforfait/', [Controllers\fraisforfaitController::class, 'index']);

// SHOW et UPDATE fallback manuel
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

// SHOW
if (preg_match('#^/fraisforfait/([0-9]+)$#', $requestPath, $m)) {
    (new \Controllers\fraisforfaitController)->show((int)$m[1]);
    exit;
}


// UPDATE
if (preg_match('#^/fraisforfait/([0-9]+)/update$#', $requestPath, $m)) {
    $ctrl = new \Controllers\fraisforfaitController;
    if ($method === 'GET') {
        $ctrl->update((int)$m[1]);
    } elseif ($method === 'POST') {
        $ctrl->save((int)$m[1]);
    }
    exit;
}

// DELETE
if (preg_match('#^/fraisforfait/([0-9]+)/delete$#', $requestPath, $m)) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        (new \Controllers\fraisforfaitController)->delete((int)$m[1]);
    }
    exit;
}

// ------------------ Routes frais hors forfait ------------------
//CREATE
$router->get('/frais_hors_forfait/create', [Controllers\frais_hors_forfaitController::class, 'create']);
$router->post('/frais_hors_forfait/store', [Controllers\frais_hors_forfaitController::class, 'store']);

//INDEX
$router->get('/frais_hors_forfait', [Controllers\frais_hors_forfaitController::class, 'index']);
$router->get('/frais_hors_forfait/', [Controllers\frais_hors_forfaitController::class, 'index']);

// SHOW et UPDATE fallback manuel
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

// SHOW
if (preg_match('#^/frais_hors_forfait/([0-9]+)$#', $requestPath, $m)) {
    (new \Controllers\frais_hors_forfaitController)->show((int)$m[1]);
    exit;
}


// UPDATE
if (preg_match('#^/frais_hors_forfait/([0-9]+)/update$#', $requestPath, $m)) {
    $ctrl = new \Controllers\frais_hors_forfaitController;
    if ($method === 'GET') {
        $ctrl->update((int)$m[1]);
    } elseif ($method === 'POST') {
        $ctrl->save((int)$m[1]);
    }
    exit;
}

// DELETE
if (preg_match('#^/frais_hors_forfait/([0-9]+)/delete$#', $requestPath, $m)) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        (new \Controllers\frais_hors_forfaitController)->delete((int)$m[1]);
    }
    exit;
}



// ------------------ Routes Visiteur ------------------



//CREATE
$router->get('/visiteur/create', [Controllers\visiteurController::class, 'create']);
$router->post('/visiteur/store', [Controllers\visiteurController::class, 'store']);


//INDEX
$router->get('/visiteur', [Controllers\visiteurController::class, 'index']);
$router->get('/visiteur/', [Controllers\visiteurController::class, 'index']);

// SHOW et UPDATE fallback manuel
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

// SHOW
if (preg_match('#^/visiteur/([0-9]+)$#', $requestPath, $m)) {
    (new \Controllers\visiteurController)->show((int)$m[1]);
    exit;
}


// UPDATE
if (preg_match('#^/visiteur/([0-9]+)/update$#', $requestPath, $m)) {
    $ctrl = new \Controllers\visiteurController;
    if ($method === 'GET') {
        $ctrl->update((int)$m[1]);
    } elseif ($method === 'POST') {
        $ctrl->save((int)$m[1]);
    }
    exit;
}

// DELETE
if (preg_match('#^/visiteur/([0-9]+)/delete$#', $requestPath, $m)) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        (new \Controllers\visiteurController)->delete((int)$m[1]);
    }
    exit;
}


// ------------------ Routes frais hors forfait ------------------
//CREATE
$router->get('/fichefrais/create', [Controllers\fichefraisController::class, 'create']);
$router->post('/fichefrais/store', [Controllers\fichefraisController::class, 'store']);

//INDEX
$router->get('/fichefrais', [Controllers\fichefraisController::class, 'index']);
$router->get('/fichefrais/', [Controllers\fichefraisController::class, 'index']);

// SHOW et UPDATE fallback manuel
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

// SHOW
if (preg_match('#^/fichefrais/([0-9]+)$#', $requestPath, $m)) {
    (new \Controllers\fichefraisController)->show((int)$m[1]);
    exit;
}


// UPDATE
if (preg_match('#^/fichefrais/([0-9]+)/update$#', $requestPath, $m)) {
    $ctrl = new \Controllers\fichefraisController;
    if ($method === 'GET') {
        $ctrl->update((int)$m[1]);
    } elseif ($method === 'POST') {
        $ctrl->save((int)$m[1]);
    }
    exit;
}

// DELETE
if (preg_match('#^/fichefrais/([0-9]+)/delete$#', $requestPath, $m)) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        (new \Controllers\fichefraisController)->delete((int)$m[1]);
    }
    exit;
}

// ------------------ Routes Auth ------------------
$router->get('/', [Controllers\AuthController::class, 'login']);
$router->get('/index.php', [Controllers\AuthController::class, 'login']);
$router->post('/login', [Controllers\AuthController::class, 'doLogin']);
$router->get('/dashboard', [Controllers\AuthController::class, 'dashboard']);
$router->get('/logout', [Controllers\AuthController::class, 'logout']);

// ------------------ Dispatcher final ------------------
$router->dispatch($method, $requestPath);
