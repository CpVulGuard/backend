<?php

namespace App\Imports;
use App\Models\PostTmp;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use phpDocumentor\Reflection\Types\String_;

class PostsImport implements ToModel, SkipsOnError
{
    use Importable, SkipsErrors;

    protected $fileName;
    protected $reason;

    public function fromFile(string $fileName, string $reason)
    {
        $this->fileName = $fileName;
        $this->reason = $reason;
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
            'reason'       => $this->reason,
            'soPostId'     => $row[0],
            'imported'     => true,
            'codeBlockIndex' => -1,
            'rows' => -1,
        ]);
    }
}
