<?php

namespace App\Imports;

use App\Models\Post;
use App\Models\PostTmp;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;
use InvalidArgumentException;

class PostsImport
{
    /**
     * Write import file content to post preview table
     */
    public function fromFile(string $fileName, string $reason)
    {
        $stream = Storage::readStream($fileName);
        stream_set_read_buffer($stream, 40000); // ensure buffered stream
        $id = fgets($stream);
        $now = Date::now();
        $start_id = Post::query()->max('id'); // get correct preview id
        $data = array(); // processed data for bulk insertion
        $current_count = 0; // current part size
        while ($id != false) {
            // check for illegal characters
            if (preg_match('/[1-9]\d*/', $id) != 1) {
                throw new InvalidArgumentException('Invalid post id ' . $id . ' could not be imported.');
            }
            $data[] = [
                'id' => ++$start_id,
                'created_at' => $now,
                'updated_at' => $now,
                'reason' => $reason,
                'soPostId' => $id,
                'imported' => true,
                'codeBlockIndex' => -1,
                'rows' => -1,
            ];

            if (++$current_count >= 1000) {
                PostTmp::query()->insert($data); // bulk insert
                $data = array(); // clear processed data
                $current_count = 0;
            }

            $id = fgets($stream);
        }
        if ($current_count > 0) {
            PostTmp::query()->insert($data); // handle leftovers
        }
    }
}
