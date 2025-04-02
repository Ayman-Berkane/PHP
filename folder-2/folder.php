windows guide

#1
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'.PHP_EOL; } else { echo 'Installer corrupt'.PHP_EOL; unlink('composer-setup.php'); exit(1); }"
php composer-setup.php
php -r "unlink('composer-setup.php');"

#2
scoop install symfony-cli

#3
composer create-project symfony/skeleton:"6.4.*" my_project_directory
cd my_project_directory
composer require webapp

#4
composer install

#5
composer require twig

#6
php bin/console make:controller

#7
DATABASE_URL="mysql://root:@127.0.0.1:3306/Databasename?serverVersion=10.4.28-MariaDB&charset=utf8mb4"
php bin/console doctrine:database:create

#8
php bin/console make:entity

#9
php bin/console make:migration

#10
php bin/console doctrine:migrations:migrate

#11 insert into controller
use App\Repository\NameRepository;

#[Route('/crud', name: 'app_crud')]
public function index(NameRepository $NameRepository): Response
{
$names = $NameRepository->findAll();

return $this->render('table/index.html.twig', [
'names' => $names,
]);
}

#12 insert into template
<table class="table table-hover align-middle">
    <thead class="bg-danger text-white">
    <tr>
        <th scope="col" class="bg-danger text-white">Name</th>
        <th scope="col" class="bg-danger text-white">Description</th>
        <th scope="col" class="bg-danger text-white">Image</th>
    </tr>
    </thead>
    <tbody>
    {% for name in names %}
    <tr class="bg-white">
        <td class="fw-semibold text-danger">{{ name.name }}</td>
        <td>{{ name.description }}</td>
        <td>
        </td>
    </tr>
    {% else %}
    <tr>
        <td colspan="4" class="text-center text-muted py-4">No names available.</td>
    </tr>
    {% endfor %}
    </tbody>
</table>

#14 master detail tables
make second table for the detail
make a detail twig page into the table template map

#15 Kies de volgende opties in de command-line prompt:
php bin/console make:entity Film
New property name: genre
Type: ManyToOne
Target entity: Genre
Is this field nullable? No

#16 detail:
{% extends 'base.html.twig' %}

{% block title %}Hello GenreController!{% endblock %}

{% block body %}
<h1>{{ genre.name }}</h1>
<p>{{ genre.description }}</p>

<h2>Films in dit genre:</h2>
{% if films is empty %}
<p>Er zijn nog geen films in dit genre.</p>
{% else %}
<ul>
    {% for film in films %}
    <li>{{ film.name }}</li>
    {% endfor %}
</ul>
{% endif %}

<a href="{{ path('app_genre') }}">Terug naar alle genres</a>
{% endblock %}


17:
php bin/console make:crud Genre
php bin/console make:crud Film