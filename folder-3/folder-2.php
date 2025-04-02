🛠️ Step 1: Install Composer (Windows)
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'.PHP_EOL; } else { echo 'Installer corrupt'.PHP_EOL; unlink('composer-setup.php'); exit(1); }"
php composer-setup.php
php -r "unlink('composer-setup.php');"

🛠️ Step 2: Install Symfony CLI (Recommended)
scoop install symfony-cli

🛠️ Step 3: Create a New Symfony Project
composer create-project symfony/skeleton:"6.4.*" my_project_directory
cd my_project_directory
composer require webapp

🛠️ Step 4: Install Dependencies
composer install

🛠️ Step 5: Install Twig for Templating
composer require twig

🛠️ Step 6: Create a New Controller
php bin/console make:controller ControllerName

🛠️ Step 7: Configure Database Connection
1. DATABASE_URL="mysql://root:@127.0.0.1:3306/your_database_name?serverVersion=10.4.28-MariaDB&charset=utf8mb4"
2. php bin/console doctrine:database:create

🛠️ Step 8: Create an Entity (Table)
php bin/console make:entity

🛠️ Step 9: Generate a Migration File
php bin/console make:migration

🛠️ Step 10: Run the Migration
php bin/console doctrine:migrations:migrate

🛠️ Step 11: Fetch Data in a Controller
use App\Repository\EntityNameRepository;

#[Route('/crud', name: 'app_crud')]
public function index(EntityNameRepository $repository): Response
{
$items = $repository->findAll();
return $this->render('table/index.html.twig', [
'items' => $items,
]);
}

🛠️ Step 12: Display Data in Twig Template
<table class="table table-hover align-middle">
    <thead class="bg-danger text-white">
    <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Image</th>
    </tr>
    </thead>
    <tbody>
    {% for item in items %}
    <tr>
        <td>{{ item.name }}</td>
        <td>{{ item.description }}</td>
    </tr>
    {% else %}
    <tr>
        <td colspan="3" class="text-center text-muted">No data available.</td>
    </tr>
    {% endfor %}
    </tbody>
</table>

🛠️ Step 13: Master-Detail Relationship (Example: Category & Detail)
1. Create a Second Table (Detail Entity)
-php bin/console make:entity Detail

2. Define a ManyToOne relationship
New property name: category
Type: ManyToOne
Target entity: Category
Is this field nullable? No

3. Create a Detail Page (Twig Template)
{% extends 'base.html.twig' %}
{% block title %}{{ genre.name }}{% endblock %}
{% block body %}
<h1>{{ category.name }}</h1>
<p>{{ category.description }}</p>
<h2>Detail in this Category:</h2>
{% if genre.films is empty %}
<p>No films in this genre yet.</p>
{% else %}
<ul>
    {% for film in genre.films %}
    <li>{{ film.name }}</li>
    {% endfor %}
</ul>
{% endif %}
<a href="{{ path('app_genre') }}">Back to Genres</a>
{% endblock %}

🛠️ Step 14: Generate CRUD Operations
php bin/console make:crud EntityName