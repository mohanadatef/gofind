<?php

namespace Modules\Basic\Traits;


trait MediaTrait
{
    public function media_move($file, $file_name, $imageName, $path)
    {
        if (!\File::isDirectory(public_path($path . '/' . $file_name))) {
            \File::makeDirectory(public_path($path . '/' . $file_name), 0777, true, true);
        }
        $file->move(public_path($path . '/' . $file_name), $imageName);
    }

    public function media_upload($data, $request, $fileNameServer, $path, $type)
    {
        if (isset($request->$type) && !empty($request->$type)) {
            if (is_array($request->$type)) {
                foreach ($request->$type as $media) {
                    $this->upload($media, $data, $fileNameServer, $path, $type);
                }
            } else {
                $this->upload($request->$type, $data, $fileNameServer, $path, $type);
            }
        }
    }

    public function upload($media, $data, $fileNameServer, $path, $type)
    {
        $fileName = time() . $media->getClientOriginalname();
        $file = $data->media()->create(['file' => $fileName, 'type' => $type]);
        !$file->file ?: $this->media_move($media, $fileNameServer, $fileName, $path);
    }

    public function checkMediaDelete($data, $request, $type)
    {
        if (isset($request->$type) && !empty($request->$type)) {
            if ($data->$type) {
                $data->$type->forceDelete();
            }
        }
    }
}
