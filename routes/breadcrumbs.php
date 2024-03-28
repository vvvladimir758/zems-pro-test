<?php 

use Diglactic\Breadcrumbs\Breadcrumbs;

use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Приветсвие', route('home'));
});
    
Breadcrumbs::for('project.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Проекты', route('project.index'));
});

Breadcrumbs::for('project.show', function (BreadcrumbTrail $trail, $project) {
    $trail->parent('project.index');
    $trail->push($project->title, route('project.show',$project->id));
});

// Home > Blog
Breadcrumbs::for('task.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Задачи', route('task.index'));
});

// Home > Blog > [Category]
Breadcrumbs::for('category', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('blog');
    $trail->push($category->title, route('category', $category));
});