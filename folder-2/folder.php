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
        <th scope="col" class="bg-danger text-white">Actions</th>
    </tr>
    </thead>
    <tbody>
    {% for name in names %}
    <tr class="bg-white">
        <td class="fw-semibold text-danger">{{ name.name }}</td>
        <td>{{ name.description }}</td>
        <td>
            <img src="{{ asset('uploads/' ~ name.img) }}" alt="Pizza Image" class="rounded" style="width: 100px; height: 100px; object-fit: cover;">
        </td>
        <td class="text-center">
            <a href="{{ path('app_crud_read', {id: name.id}) }}" class="btn btn-light border-danger btn-sm me-1 text-danger">
                <i class="bi bi-eye"></i>
            </a>
            <a href="{{ path('app_crud_edit', {id: name.id}) }}" class="btn btn-light border-danger btn-sm me-1 text-danger">
                <i class="bi bi-pencil-square"></i>
            </a>
            <form method="post" action="{{ path('app_crud_delete', {id: name.id}) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this pizza?');">
                <input type="hidden" name="_token" value="{{ csrf_token('delete' ~ name.id) }}">
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="bi bi-trash"></i>
                </button>
            </form>
        </td>
    </tr>
    {% else %}
    <tr>
        <td colspan="4" class="text-center text-muted py-4">No pizzas available.</td>
    </tr>
    {% endfor %}
    </tbody>
</table>


