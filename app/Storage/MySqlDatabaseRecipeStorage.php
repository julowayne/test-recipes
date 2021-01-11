<?php 

namespace App\Storage;

use App\Storage\Contracts\RecipeStorageInterface;
use App\Models\Recipe;


class MySqlDatabaseRecipeStorage implements RecipeStorageInterface {

  protected $db;
  function __construct(\PDO $db)
  {
      $this->db = $db;
  }
  public function store(Recipe $recipe){
    $statement = $this->db->prepare("INSERT INTO recipes (created_at, name, description, persons, preparation_time ) VALUES (:created_at, :name, :description, :persons, :preparation_time)");
    $statement->execute([
        'created_at' => $recipe->getCreatedAt()->format('Y-m-d H:i:s'),
        'name' => $recipe->getName(),
        'description' => $recipe->getDescription(),
        'persons' => $recipe->getPersons(),
        'preparation_time' => $recipe->getPreparationTime(),
    ]);
    return $this->db->lastInsertId();
  }

  public function update(Recipe $recipe){
    $statement = $this->db->prepare('UPDATE recipes SET name = :name, description = :description, persons = :persons, preparation_time = :preparation_time WHERE id = :id');
    $statement->execute([
      'id' => $recipe->getId(),
      'name' => $recipe->getName(),
      'description' => $recipe->getDescription(),
      'persons' => $recipe->getPersons(),
      'preparation_time' => $recipe->getPreparationTime(),
    ]);
    return $this->get($recipe->getId());
  }


  public function get($id){

    $statement = $this->db->prepare('SELECT * FROM recipes WHERE id = :id');
    $statement->execute(['id' => $id]);
    $statement->setFetchMode(\PDO::FETCH_CLASS, Recipe::class);
    return $statement->fetch();

  }

  
  public function all(){

    $statement = $this->db->prepare("SELECT * FROM recipes");
    $statement->execute();
    return $statement->fetchAll(\PDO::FETCH_CLASS, Recipe::class);
  }
}