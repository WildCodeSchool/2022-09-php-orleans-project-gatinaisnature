<?php

// list of accessible routes of your application, add every new route here
// key : route to match
// values : 1. controller name
//          2. method name
//          3. (optional) array of query string keys to send as parameter to the method
// e.g route '/item/edit?id=1' will execute $itemController->edit(1)
return [
    '' => ['HomeController', 'index',],
    'activity' => ['ActivityController', 'index',],
    'admin/activites/indexAdmin' => ['ActivityController', 'indexAdmin'],
    'activity/add' => ['ActivityController', 'add'],
    'activity/edit' => ['ActivityController', 'edit', ['id']],
    'activity/delete' => ['ActivityController', 'delete'],
    'admin/evenements/index' => ['EventController', 'indexAdmin'],
    'items' => ['ItemController', 'index',],
    'items/edit' => ['ItemController', 'edit', ['id']],
    'items/show' => ['ItemController', 'show', ['id']],
    'items/add' => ['ItemController', 'add',],
    'items/delete' => ['ItemController', 'delete',],
    'circuits' => ['CircuitController', 'index',],
    'circuits/show' => ['CircuitController', 'show', ['id']],
    'admin/especes' => ['OrganismController', 'index'],
    'admin/especes/index' => ['OrganismController', 'index'],
    'admin/especes/ajouter' => ['OrganismController', 'add'],
    'admin/especes/editer' => ['OrganismController', 'edit', ['id']],
    'admin/especes/supprimer' => ['OrganismController', 'delete'],
    'admin/circuits/add' => ['CircuitController', 'addCircuit'],
    'admin/circuits/index' => ['CircuitController', 'indexCircuitsAdmin'],
    'admin/circuits/delete' => ['CircuitController', 'removeCircuit'],
    'admin/circuits/edit' => ['CircuitController', 'editCircuit', ['id']],
    'contact' => ['ContactController', 'index',['answer']],
    'landscape' => ['LandscapeController', 'index',],
    'event/edit' => ['EventController', 'edit', ['id']],
    'login' => ['LoginController', 'login'],
    'logout' => ['LoginController', 'logout'],
    'event/add' => ['EventController', 'add'],
    'event/delete' => ['EventController', 'delete'],
    'admin/paysages/index' => ['LandscapeController', 'indexLandscapeAdmin'],
    'admin/paysages/edit' => ['LandscapeController', 'edit', ['id']],
    'admin/paysages/add' => ['LandscapeController', 'add'],
    'admin' => ['AdminController', 'index'],
    'admin/paysages/delete' => ['LandscapeController', 'delete'],
];
