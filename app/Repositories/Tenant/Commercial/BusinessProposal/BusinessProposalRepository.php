<?php

namespace App\Repositories\Tenant\Commercial\BusinessProposal;

use App\Models\Tenant\Commercial\BusinessProposal\BusinessProposal;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Spatie\LaravelData\Data;

class BusinessProposalRepository extends BaseRepository
{
  public function __construct(BusinessProposal $model)
  {
    parent::__construct($model);
  }

  public static function make(): Self
  {
    return new self(new BusinessProposal);
  }

  // /**
  //  * Método executado dentro de BaseRepository.index()
  //  * Adicionar join de tabelas e mostra colunas específicas
  //  *
  //  * @param Builder $queryBuilder
  //  * @return array
  //  * Retornar um array contendo queryBuilder e string de colunas a serem exibidas
  //  */
  // public function indexInside(Builder $queryBuilder): array
  // {
  //   return [
  //     $queryBuilder
  //       ->leftJoin('city', 'city.id', 'person.city_id')
  //       ->leftJoin('state', 'state.id', 'city.state_id'),
  //     'person.*, ' .
  //     'city.name          as city_name, ' .
  //     'city.ibge_code     as city_ibge_code, ' .
  //     'state.name         as state_name, ' .
  //     'state.abbreviation as state_abbreviation'
  //   ];
  // }

  // /**
  //  * Localizar um único registro por ID
  //  * Acrescenta with para mostrar relacionamentos
  //  * 
  //  * @param integer $id
  //  * @return Data|null
  //  */
  // public function show(int $id): Data|null
  // {
  //   // Buscando apenas os campos que preciso
  //   $modelFound = $this->model
  //     ->whereId($id)
  //     ->with('city.state')
  //     ->with('personAddress.city.state')      
  //     ->with('personContact')      
  //     ->first();

  //   return $modelFound
  //     ? $modelFound->getData()
  //     : null;
  // }

  // /**
  //  * Salvar registro e retornar DTO
  //  * Acrescenta createMany para salvar relacionamentos
  //  * 
  //  * @param Data $dto
  //  * @return Data
  //  */
  // public function store(Data $dto): Data
  // {
  //   $dto->id = null;
  //   $data = $dto->toArray();
  //   $executeStore = function ($data) {
  //     $modelFound = $this->model->create($data);
  //     $modelFound->personAddress()->createMany($data['person_address']);
  //     $modelFound->personContact()->createMany($data['person_contact']);

  //     return $this->show($modelFound->id);
  //   };

  //   // Controle de Transação
  //   return match ($this->isTransaction()) {
  //     true => DB::transaction(fn () => $executeStore($data)),
  //     false => $executeStore($data),
  //   };
  // }

  // /**
  //  * Atualizar Registro e retorna DTO atualizado
  //  *
  //  * @param integer $id
  //  * @param Data $dto
  //  * @return Data
  //  */
  // public function update(int $id, Data $dto): Data
  // {
  //   $dto->id = $id;
  //   $data = $dto->toArray();
  //   $executeUpdate = function ($id, $data) {
  //     $modelFound = $this->model->findOrFail($id);

  //     // Atualizar BusinessProposal
  //     tap($modelFound)->update($data);

  //     // Atualizar BusinessProposalAddress
  //     $modelFound->personAddress()->delete();
  //     $modelFound->personAddress()->createMany($data['person_address']);

  //     // Atualizar BusinessProposalContact
  //     $modelFound->personContact()->delete();
  //     $modelFound->personContact()->createMany($data['person_contact']);

  //     // Retornar registro atualizado
  //     return $this->show($modelFound->id);
  //   };

  //   // Controle de Transação
  //   return match ($this->isTransaction()) {
  //     true => DB::transaction(fn () => $executeUpdate($id, $data)),
  //     false => $executeUpdate($id, $data),
  //   };
  // }
}