<?php 
namespace App\Models;
use CodeIgniter\Model;
class CashiersModel extends Model
{
    protected $table = 'cashiers';
    protected $primaryKey = 'id';
    protected $allowedFields = ['fname','lname'];

    
    
}