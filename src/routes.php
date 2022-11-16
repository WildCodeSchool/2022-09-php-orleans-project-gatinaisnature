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
    'items' => ['ItemController', 'index',],
    'items/edit' => ['ItemController', 'edit', ['id']],
    'items/show' => ['ItemController', 'show', ['id']],
    'items/add' => ['ItemController', 'add',],
    'items/delete' => ['ItemController', 'delete',],
    'circuits' => ['CircuitController', 'index',],
    'circuits/show' => ['CircuitController', 'show', ['id']],
    'admin/circuits/add' => ['CircuitController', 'addCircuit'],
    'admin/circuits/index' => ['CircuitController', 'indexCircuitsAdmin'],
    'admin/circuits/edit' => ['CircuitController', 'editCircuit', ['id']],
    'contact' => ['ContactController', 'index',['answer']],
    'admin/especes/index' => ['OrganismController', 'index'],
    'landscape' => ['LandscapeController', 'index',],
];
