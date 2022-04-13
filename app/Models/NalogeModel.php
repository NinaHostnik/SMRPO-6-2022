<?php namespace App\Models;

use CodeIgniter\Model;

class NalogeModel extends Model
{
    protected $table = 'naloge';
    protected $allowedFields = ['zgodba_id', 'opis_naloge', 'ocena_casa','clan_ekipe','potrjen'];

}