<?php

namespace App\Imports;
use App\Models\PostTmp;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class PostsImport implements ToModel, SkipsOnError
{
    use Importable, SkipsErrors;

    protected $fileName;

    public function fromFile(string $fileName)
    {
        $this->fileName = $fileName;
        return $this;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new PostTmp([
            'created_at'   => Date::now(),
            'uptated_at'   => Date::now(),
            'reason'       => $this->fileName,
            'soPostId'     => $row[0],
            'imported'     => true,
        ]);
    }
}
