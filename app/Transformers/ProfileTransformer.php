<?php
namespace App\Transformers;

/**
 * 个人信息转换类
 */
class ProfileTransformer extends Transformer
{
    public function transform($profile)
    {
        return [
            'user_id' => $profile['id'],
            'user_name' => $profile['name'],
            'user_email' => $profile['email'],
            'ss_passwd' => $profile['passwd'],
        ];
    }
}
