<?php
namespace App\Models;
use CodeIgniter\Model;
class UsersModel extends Model{
    protected $table            = 'pengguna';
    protected $primaryKey       = 'id_user';
    protected $useAutoIncrement = false;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $protectFields    = false;
    protected $allowedFields    = [
        'id_user',
        'nama_users',
        'email',
        'password',
        'profile',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function get_user(){
        $result = $this->findAll();
        return $result;
    }

    public function get_user_id($id)
    {        
        $result = $this->select('id_user, nama_users, email, profile') 
                    ->where('id_user', $id)
                    ->first(); 
        
        return $result;
    }

    public function get_user_username($username){
        $result = $this->where('nama_users', $username)->first();
        return $result;
    }

    public function get_user_email($email){
        $result = $this->where('email', $email)->first();
        return $result;
    }

    public function insert_user($data){
        $result = $this->insert($data);
        return $result;
    }

    public function delete_user($id){
        $result = $this->delete($id);
        return $result;
    }

    public function update_user($id, $data){
        $result = $this->update($id, $data);
        return $result;
    }
    
    public function getUserByEmail($email, $id_user)
    {
        return $this->where('email', $email)
                    ->where('deleted_at', NULL)
                    ->where('id_user !=', $id_user)
                    ->asArray()
                    ->first();
    }
}
