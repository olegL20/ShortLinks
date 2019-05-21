<?php

namespace App\Services;

use App\Models\ShortLink;
use Carbon\Carbon;

class ShortLinkConverter
{
    protected $url;
    const SHORT_LINK_LENGTH = 5;

    public function convert(string $url, ?Carbon $expired_at = null): string
    {
        $link = new ShortLink();
        $link->original_url = $url;
        $link->short_url = $this->makeShortLink($url);
        $link->expired_at = $expired_at;
        $link->save();

        return $link->short_url;
    }

    public function makeShortLink(string $url): string
    {
        return substr(md5($url.mt_rand()), 0, self::SHORT_LINK_LENGTH);
    }
}

