<?php
class Application_Model_DbTable_Users extends Zend_Db_Table_Abstract
{
	protected $_name = 'users';

	public function getUser($iduser)
	{
		$iduser = (int)$iduser;
		$row = $this->fetchRow('iduser = ' . $iduser);
		if (!$row) {
			throw new Exception("Could not find row $iduser");
		}
		return $row->toArray();
	}
	public function addUser($name, $email, $password, $description,
                            $photo, $coders, $cities_idcity/*, $roles_idrole*/)
	{
		$data = array(
				'name' => $name,
				'email' => $email,
				'password' => $password,
				'description' => $description,
				'photo' => $photo,
				'coders' => $coders,
		        'cities_idcity' => $cities_idcity,
		        'roles_idrole' => 4
		);
		$this->insert($data);
	}
	public function updateUser($iduser, $name, $email, $password, $description,
                               $photo, $coders, $cities_idcity/*, $roles_idrole*/)
	{
		$data = array(
				'name' => $name,
				'email' => $email,
				'password' => $password,
				'description' => $description,
				'photo' => $photo,
				'coders' => $coders,
		        'cities_idcity' => $cities_idcity
		);
		$this->update($data, 'iduser = '. (int)$iduser);
	}
	public function deleteUser($iduser)
	{
		$this->delete('iduser =' . (int)$iduser);
	}
}
?>