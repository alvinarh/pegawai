<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    public function getEmailUsers($email)
    {
        $query = "select `admin`.`id_admin` AS `kode`,`admin`.`password` AS `password`,`admin`.`email` AS `email`,`admin`.`nama` AS `nama`, `admin`. `role` as `role` from `admin` where email='" . $email . "'
        union
        select `pimpinan`.`kode_pimpinan` AS `kode`,`pimpinan`.`password` AS `password`,`pimpinan`.`email` AS `email`,`pimpinan`.`nama` AS `nama`, `pimpinan`. `role` as `role` from `pimpinan` where email='" . $email . "'
        union
        select `user`.`kode_pegawai` AS `kode`,`user`.`password` AS `password`,`user`.`email` AS `email`,`user`.`nama` AS `nama`, `user`. `role` as `role` from `user` where email='" . $email . "';";
        return $this->db->query($query)->row();
    }

    public function getUserPassUsers($email, $password)
    {
        $query = "select `admin`.`id_admin` AS `kode`,`admin`.`password` AS `password`,`admin`.`email` AS `email`,`admin`.`nama` AS `nama`, `admin`. `role` as `role` from `admin` where email='" . $email . "' and password='" . $password . "'
        UNION
        select `pimpinan`.`kode_pimpinan` AS `kode`,`pimpinan`.`password` AS `password`,`pimpinan`.`email` AS `email`,`pimpinan`.`nama` AS `nama`, `pimpinan`. `role` as `role` from `pimpinan` where email='" . $email . "' and password='" . $password . "'
        UNION
        select `user`.`kode_pegawai` AS `kode`,`user`.`password` AS `password`,`user`.`email` AS `email`,`user`.`nama` AS `nama`, `user`. `role` as `role` from `user` where email='" . $email . "'";
        return $this->db->query($query);
    }
}
