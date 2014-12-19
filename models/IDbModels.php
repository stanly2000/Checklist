<?php
/**
 *
 * @author stan
 */
interface IDbModels {
    public function load($id);
    public function save();
    public function getAll();
    public function remove($id);
}
