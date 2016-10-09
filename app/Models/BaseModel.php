<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public function mfnFind($condition = [], $field = ['*'])
    {
        if (is_int($condition)) {
            return $this->where('id', '=', $condition)->first($field);
        } else if (is_array($condition)) {
            $model = $this;
            foreach ($condition as $i => $v) {
                $model = $this->where($i, '=', $v);
            }
            return $model->first($field);
        }
        return [];
    }

    public function mfnUpdate($data)
    {
        if (empty($data)) {
            return false;
        }
        if (empty($data['id'])) {
            $id = $this->insertGetId($data);
            if (empty($id)) {
                return false;
            }
        } else {
            $id = $data['id'];
            $status = $this->where('id', $id)->update($data);
            if (empty($status)) {
                return false;
            }
        }
        return $id;
    }

}