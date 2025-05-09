<?php 
interface IBaseRepository
{
    public function select($qry);
    public function insert($qry);
    public function update($qry);
    public function delete($qry);
}
?>