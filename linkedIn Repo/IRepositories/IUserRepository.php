<?php
interface IUserRepository
{
    public function getAllUsersQuery();
    public function upgradeUserQuery($id);
    public function getUserQuery($id);
}
?>