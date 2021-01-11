<?php 

session_start();

print_r($_SESSION);
use App\Models\Recipe;
use App\Storage\MySqlDatabaseRecipeStorage;
use App\Storage\SessionsRecipeStorage;
use App\RecipeManager;



require __DIR__ . "/../vendor/autoload.php";


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

// Connexion a la DB
try {
  $db = new PDO("mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']}", $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
} catch (PDOException $e) {
  die($e->getMessage());
}


$recipe = new Recipe;
$_SESSION['recipes'][] = json_encode($recipe);

$recipe->setCreatedAt(new DateTime());
$recipe->SetName('Fondant au choolat mi-cuit');
$recipe->setDescription('La racette du fameux fondant au chocolat mi-cuit');
$recipe->setPersons(4);
$recipe->setPreparationTime(40);


echo $recipe->getName();
echo $recipe->getDescription();
echo $recipe->getPersons();
echo $recipe->getPreparationTime();
echo $recipe->getCreatedAt()->format('d/m/Y H:i');


// index.php
// MYSQL
// Get all recipes
$storage = new MySqlDatabaseRecipeStorage($db);
print_r($storage->all());
// Create a recipe
$recipe->setCreatedAt(new DateTime())
 ->setName('Fondant au chocolat mi-cuit')
 ->setDescription('La recette du fameux fondant au chocolat micuit.')
 ->setPersons(4)
 ->setPreparationTime(40);
$recipeId = $storage->store($recipe);
print_r($storage->get($recipeId));
// Update a recipe
$recipe = $storage->get(1);
$recipe->setName('blablabla');
$storage->update($recipe);

// index.php
// Session
// Get all recipes
$storage = new SessionsRecipeStorage();
print_r($storage->all());
// Create a recipe
$recipe->setCreatedAt(new DateTime())
 ->setName('Fondant au chocolat mi-cuit')
 ->setDescription('La recette du fameux fondant au chocolat micuit.')
 ->setPersons(4)
 ->setPreparationTime(40);
$recipeId = $storage->store($recipe);
print_r($storage->get($recipeId));
// Update a recipe
$recipe = $storage->get(2);
$recipe->setName('blublublu');
$storage->update($recipe);


// index.php
$storage = new MySqlDatabaseRecipeStorage($pdo);
// Ou

// $storage = new SessionRecipeStorage();
$manager = new RecipeManager($storage);
// Create a recipe
$recipe->setCreatedAt(new DateTime())
 ->setName('blablablabla mi-cuit')
 ->setDescription('La recette du fameux fondant au chocolat.')
 ->setPersons(4)
 ->setPreparationTime(40);
$addedRecipe = $manager->addRecipe($recipe);
// Update (and get)
$recipe = $manager->getRecipe(2);
$recipe->setPreparationTime(60);
$manager->updateRecipe($recipe);
// Recipes
$recipes = $manager->getRecipes();
print_r($recipes);