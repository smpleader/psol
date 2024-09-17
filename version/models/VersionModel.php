<?php
/**
 * SPT software - Model
 * 
 * @project: https://github.com/smpleader/spt
 * @author: Pham Minh - smpleader
 * @description: Just a basic model
 * 
 */

namespace App\psol\version\models;

use SPT\Container\Client as Base;

class VersionModel extends Base 
{ 
    use \SPT\Traits\ErrorString;

    public function getVersion()
    {
        $version_level = (int) $this->OptionModel->get('version_level', 1);
        $version_level_deep = (int) $this->OptionModel->get('version_level_deep', 1);

        $version_lastest = $this->VersionEntity->list(0, 1, [], 'id desc');
        $current_version = $version_lastest ? $version_lastest[0]['version'] : '0.0.0';
        
        $version_level = $version_level > 0 ? $version_level : 1;
        $vParts = explode('.', $current_version);
        $max = (int) str_repeat('9', $version_level);
        $newVersion = '';
        $ins = 1;
        for ($i = $version_level_deep; $i > 0 ; $i--) 
        { 
            # code...
            $tmp = isset($vParts[$i - 1]) ? (int) $vParts[$i - 1] + $ins : 0;
            $ins = 0;
            if ($tmp > $max)
            {
                $ins = 1;
                $tmp = 0;
            }

            $tmp = ($i == $version_level_deep && $tmp == 0) ? 1 : $tmp;

            if ($version_level - strlen((string) $tmp) > 0)
            {
                $tmp = str_repeat('0', $version_level - strlen((string) $tmp)) . $tmp;
            }

            $newVersion = strlen($newVersion) ? $tmp . '.' . $newVersion : $tmp;
        }

        return $newVersion;
    }

    public function validate($data)
    {
        if (!$data || !is_array($data))
        {
            return false;
        }

        if (!$data['name'])
        {
            $this->error = 'Title is required!';
            return false;
        }

        $where = ['name' => $data['name']];
        if (isset($data['id']) && $data['id'])
        {
            $where[] = 'id <> '. $data['id'];
        }

        if($data['release_date'] == '')
        {
            $this->error = "Release date can't empty";
            return false;
        }   
        return true;
    }

    public function add($data)
    {
        $version_number = $this->getVersion();
        $data = [
            'name' => $data['name'],
            'release_date' => $data['release_date'],
            'description' => $data['description'],
            'version' => $version_number,
            'status' => $data['status'],
            'created_by' => $this->user->get('id'),
            'created_at' => date('Y-m-d H:i:s'),
            'modified_by' => $this->user->get('id'),
            'modified_at' => date('Y-m-d H:i:s')
        ]; 

        $data = $this->VersionEntity->bind($data);
        if (!$data)
        {
            $this->error = $this->VersionEntity->getError();
            return false;
        }

        $newId =  $this->VersionEntity->add($data);
        if (!$newId)
        {
            $this->error = $this->VersionEntity->getError();
        }

        return $newId;
    }

    public function update($data)
    {
        $data = [
            'name' => $data['name'],
            'release_date' => $data['release_date'],
            'description' => $data['description'],
            'status' => $data['status'],
            'modified_by' => $this->user->get('id'),
            'modified_at' => date('Y-m-d H:i:s'),
            'id' => $data['id'],
        ];

        $data = $this->VersionEntity->bind($data);
        if (!$data)
        {
            $this->error = $this->VersionEntity->getError();
            return false;
        }

        $try = $this->VersionEntity->update($data);

        if (!$try)
        {
            $this->error = $this->VersionEntity->getError();
        }

        return $try;
    }

    public function  remove($id)
    {
        if (!$id) return false;
        $try = $this->VersionEntity->remove($id);
        if ($try)
        {
            $find = $this->VersionNoteEntity->list(0, 0, ['version_id' => $id]);
            foreach($find as $item)
            {
                $this->VersionNoteEntity->remove($item['id']);
            }
        }
        
        return $try;
    }
}
