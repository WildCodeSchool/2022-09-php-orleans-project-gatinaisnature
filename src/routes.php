<?php

// list of accessible routes of your application, add every new route here
// key : route to match
// values : 1. controller name
//          2. method name
//          3. (optional) array of query string keys to send as parameter to the method
// e.g route '/item/edit?id=1' will execute $itemController->edit(1)
return [
    '' => ['HomeController', 'index',],
    'activites' => ['ActivityController', 'index',],
    'admin/activites/index' => ['ActivityController', 'indexAdmin'],
    'admin/activites/ajouter' => ['ActivityController', 'add'],
    'admin/activites/editer' => ['ActivityController', 'edit', ['id']],
    'admin/activites/supprimer' => ['ActivityController', 'delete'],
    'admin/event/index' => ['EventController', 'indexAdmin'],
    'admin/event/ajouter' => ['EventController', 'add'],
    'admin/event/editer' => ['EventController', 'edit', ['id']],
    'admin/event/supprimer' => ['EventController', 'delete'],
    'items' => ['ItemController', 'index',],
    'items/edit' => ['ItemController', 'edit', ['id']],
    'items/show' => ['ItemController', 'show', ['id']],
    'items/add' => ['ItemController', 'add',],
    'items/delete' => ['ItemController', 'delete',],
    'circuits' => ['CircuitController', 'index',],
    'circuits/show' => ['CircuitController', 'show', ['id']],
    'admin/circuits/index' => ['CircuitController', 'indexCircuitsAdmin'],
    'admin/circuits/ajouter' => ['CircuitController', 'addCircuit'],
    'admin/circuits/editer' => ['CircuitController', 'editCircuit', ['id']],
    'admin/circuits/supprimer' => ['CircuitController', 'removeCircuit'],
    'admin/especes/index' => ['OrganismController', 'index'],
    'admin/especes/ajouter' => ['OrganismController', 'add'],
    'admin/especes/editer' => ['OrganismController', 'edit', ['id']],
    'admin/especes/supprimer' => ['OrganismController', 'delete'],
    'paysages' => ['LandscapeController', 'index',],
    'admin/paysages/index' => ['LandscapeController', 'indexLandscapeAdmin'],
    'admin/paysages/ajouter' => ['LandscapeController', 'add'],
    'admin/paysages/editer' => ['LandscapeController', 'edit', ['id']],
    'admin/paysages/supprimer' => ['LandscapeController', 'delete'],
    'admin' => ['AdminController', 'index'],
    'contact' => ['ContactController', 'index',['answer']],
    'login' => ['LoginController', 'login'],
    'logout' => ['LoginController', 'logout'],
];
