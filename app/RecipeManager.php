<?php 
namespace App;

class RecipeManager {
  protected $storage;
  function __construct(RecipeStorageInterface $storage)
  {
    $this->storage = $storage;
  }
  function addRecipe(){
    $id = $this->storage->store($recipe);
    return $this->getTask($id);
  }
  public function getRecipe(int $id)
  {
      return $this->storage->get($id);
  }
  public function updateRecipe(Recipe $recipe)
  {
      return $this->storage->update($recipe);
  }
  public function getRecipes()
  {
      return $this->storage->all();
  }
}