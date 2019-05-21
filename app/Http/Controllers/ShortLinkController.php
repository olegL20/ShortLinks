<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShortLinkConvertRequest;
use App\Models\ShortLink;
use App\Services\ShortLinkConverter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ShortLinkController extends Controller
{
    /** @var ShortLinkConverter */
    protected $shortLinkConverter;

    public function __construct(ShortLinkConverter $linkConverter)
    {
        $this->shortLinkConverter = $linkConverter;
    }

    public function index()
    {
        return view('short-link-converter');
    }

    public function convert(ShortLinkConvertRequest $request)
    {
        $expirationDate = new  Carbon($request->get('expired_at'));
        $link = $this->shortLinkConverter->convert($request->get('url'), $expirationDate);
        return back()->with(['link' => $link]);
    }

    public function redirect(ShortLink $link)
    {
        if ($link->expired_at && $link->isExpired()) {
            return back()->withErrors(['expired' => 'This link is expired']);
        }

        return Redirect::to($link->original_url);
    }
}
