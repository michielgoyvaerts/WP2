<?php
require "vendor/autoload.php";
use dao\ContactDao;
use repository\ContactRepository;

function generateContactRepository()
{
    $contactDao = new DAO\ContactDao();
    $contactRepository = new Repository\ContactRepository($contactDao);
    return $contactRepository;
}

try {
    $contactRepository = generateContactRepository();
    $router = new AltoRouter();
    $router->setBasePath('/');
    $router->map(
        'GET',
        'contacts/[i:id]',
        function ($id) use ($contactRepository) {
            $contactRepository->getContact($id);
        }
    );
    $router->map(
        'GET',
        'contacts/',
        function () use ($contactRepository) {
            $contactRepository->getAllContacts();
        }
    );
    $router->map(
        'DELETE',
        'contacts/[i:id]',
        function ($id) use ($contactRepository) {
            $contactRepository->deleteContact($id);
        }
    );
    $router->map(
        'POST',
        'contacts/',
        function () use ($contactRepository) {
            $data = json_decode(file_get_contents('php://input'));
            //print($data->email);
            $contactRepository->createContact($data->name, $data->email);
        }
    );
    $match = $router->match();
    if ($match && is_callable($match['target'])) {
        call_user_func_array($match['target'], $match['params']);
    } else {
        http_response_code(500);
    }
} catch (Exception $exception) {
    http_response_code(500);
}