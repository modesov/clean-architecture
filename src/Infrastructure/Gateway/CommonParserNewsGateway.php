<?php

namespace App\Infrastructure\Gateway;

use App\Application\Gateway\ParserNewsGateway\ParserNewsGatewayInterface;
use App\Application\Gateway\ParserNewsGateway\ParserNewsRequest;
use App\Application\Gateway\ParserNewsGateway\ParserNewsResponse;

class CommonParserNewsGateway implements ParserNewsGatewayInterface
{

    public function parseNews(ParserNewsRequest $request): ParserNewsResponse
    {
        $content = file_get_contents($request->url);
        preg_match('~<title>(.*?)</title>~is', $content, $matches );
        return new ParserNewsResponse($matches[1]);
    }
}