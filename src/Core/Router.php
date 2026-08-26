<?php
namespace Cisse\CategorieProduitPoo\Core;

class Router
{
    private array $routes = [];

    public function __construct()
    {
        $this->routes = [
            '/' => [
                'controller' => 'Cisse\CategorieProduitPoo\Controller\ProduitController',
                'action' => 'liste'
            ],
            '/save' => [
                'controller' => 'Cisse\CategorieProduitPoo\Controller\ProduitController',
                'action' => 'enregistrerProduit'
            ]
        ];
    }

    public function redirection(): void
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if (!isset($this->routes[$uri])) {
            http_response_code(404);
            echo "Page introuvable";
            exit;
        }

        $controllerClass = $this->routes[$uri]['controller'];
        $action = $this->routes[$uri]['action'];

        if (class_exists($controllerClass)) {
            // var_dump($controllerClass);
            // die;
            $controllerInstance = new $controllerClass();

            if (method_exists($controllerInstance, $action)) {
                $controllerInstance->$action();
            } else {
                http_response_code(500);
                echo "Erreur : La méthode '$action' est introuvable.";
            }
        } else {
            http_response_code(404);
            echo "Erreur : Le contrôleur '$controllerClass' est introuvable.";
        }
    }
}