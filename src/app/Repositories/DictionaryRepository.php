<?php

namespace App\Repositories;

use App\Models\Dictionary;
use Illuminate\Support\Facades\Storage;

class DictionaryRepository
{
    protected $model;
    
    public function __construct(Dictionary $model)
    {
        $this->model = $model;
    }
    
    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }
    
    public function create(array $data)
    {
        $audioUrls = [];
        if (isset($data["audios"])) {
            foreach ($data["audios"] as $audio) {
                $audioUrls[] = $audio->store("dictionary", "public");
            }
        }
        $data["audio_urls"] = $audioUrls;
        unset($data["audios"]);

        if (isset($data["image"]) && $data["image"]) {
            $data["image"] = $data["image"]->store("dictionary/images", "public");
        }

        $data["user_id"] = auth()->user()->id;

        $categoryIds = $data['categories'] ?? [];
        unset($data['categories']);

        $dictionary = $this->model->create($data);
        $dictionary->categories()->sync($categoryIds);

        return $dictionary;
    }

    public function update($id, array $data)
    {
        $dictionary = $this->find($id);
        if (!$dictionary) {
            return false;
        }

        $audioUrls = $dictionary->audio_urls ?? [];
        if (isset($data["audios"])) {
            foreach ($data["audios"] as $audio) {
                $audioUrls[] = $audio->store("dictionary", "public");
            }
        }
        $data["audio_urls"] = $audioUrls;
        unset($data["audios"]);

        if (isset($data["image"]) && $data["image"]) {
            if ($dictionary->image) {
                Storage::disk('public')->delete($dictionary->image);
            }
            $data["image"] = $data["image"]->store("dictionary/images", "public");
        } else {
            unset($data["image"]);
        }

        $categoryIds = $data['categories'] ?? [];
        unset($data['categories']);

        $dictionary->update($data);
        $dictionary->categories()->sync($categoryIds);

        return $dictionary;
    }

    public function deleteAudio($id, $audioUrl)
    {
        $dictionary = $this->find($id);
        if ($dictionary) {
            $audioUrls = $dictionary->audio_urls ?? [];
            $audioUrl = trim($audioUrl);
            
            $newAudioUrls = [];
            $found = false;
            foreach ($audioUrls as $url) {
                if (trim($url) === $audioUrl) {
                    Storage::disk('public')->delete($url);
                    $found = true;
                    continue;
                }
                $newAudioUrls[] = $url;
            }

            if ($found) {
                $dictionary->audio_urls = $newAudioUrls;
                return $dictionary->save();
            }
        }
        return false;
    }
    
    public function delete($id)
    {
        return $this->model->where('id', $id)->delete();
    }
    
    public function paginate($perPage = 15, $with = [])
    {
        return $this->model->with($with)->paginate($perPage);
    }
}
