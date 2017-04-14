<?php
namespace App\Transformers;

/**
 * 帮组模型转化类
 */
class HelpTransformer extends Transformer
{
    public function transform($help)
    {
        return [
            'help_id'   => $help['id'],
            'help_name' => $help['name'],
        ];
    }
}
