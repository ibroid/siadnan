<?php


trait UserApi
{
    public function get_api()
    {
        return ResponseJson::success(['user' => '']);
    }

    public function delete_user($id = null)
    {
        if ($id == null) {
            throw new Exception("Id user kosong saat hapus data user", 1);
        }

        if ($id == 1 || $id == 2) {
            throw new Exception("<strong>User ini tidak boleh dihapus</strong>", 1);
        }

        UserEntity::where('id', $id)->delete();
    }

    public function insert_user($data = [])
    {
        return UserEntity::create($data);
    }

    public function update_user($id = null, $data = [])
    {
        if ($id == null) {
            throw new Exception("Id user kosong saat update data user", 1);
        }
        UserEntity::where('id', $id)->update($data);
    }
}
