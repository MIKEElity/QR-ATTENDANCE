<?php 
namespace App\Models;
use CodeIgniter\Model;
class interestModel extends Model
{
    protected $table = 'loan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['cntn','date'];

    
    
}