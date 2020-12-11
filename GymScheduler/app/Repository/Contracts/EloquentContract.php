<?php

namespace App\Repository\Contracts;

interface EloquentContract {
  /**
   * retrieves all info from db
   */
  public function all();

  /**
   * @param array $data
   * populates db
   */
  public function create(array $data);

  /**
   * @param int $id
   * finds data for matching id in db
   */
  public function find($id);

  public function count();

  public function findOrFail( $id);


  /**
   * @param array $data
   * @param int $id
   * updates data for matching id in db
   */
  public function update(array $data, $id);

  public function setModel( $model);

} 