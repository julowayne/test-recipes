<?php

namespace app\Models;

class Recipe
{
  protected $id;
  protected $created_at;
  protected $name;
  protected $description;
  protected $persons;
  protected $preparation_time;


  // GETTER - SETTER ID
  public function getId()
  {
      return $this->id;
  }

  public function setId($id)
  {
      $this->id = $id;
      return $this;
  }


  // GETTER - SETTER CREATED_AT
  public function getCreatedAt(){
      return $this->created_at;
  }

  public function setCreatedAt($created_at){
      $this->created_at = $created_at;
      return $this;
  }


  // GETTER - SETTER NAME
  public function getName(){
      return $this->name;
  }

  public function setName($name){
      $this->name = $name;
      return $this;
  }


  // GETTER - SETTER DESCRIPTION
  public function getDescription(){
      return $this->description;
  }

  public function setDescription($description){
      $this->description = $description;
      return $this;
  }


  // GETTER - SETTER PERSONS
  public function getPersons(){
      return $this->persons;
  }

  public function setPersons($persons){
      $this->persons = $persons;
      return $this;
  }


  // GETTER - SETTER PREPARATION_TIME
  public function getPreparationTime(){
      return $this->preparation_time;
  }

  public function setPreparationTime($preparation_time){
      $this->preparation_time = $preparation_time;
      return $this;
  }
}