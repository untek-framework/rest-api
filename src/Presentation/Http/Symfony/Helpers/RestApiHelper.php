<?php

namespace Untek\Framework\RestApi\Presentation\Http\Symfony\Helpers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mime\MimeTypes;
use Untek\Core\Arr\Helpers\ArrayHelper;

class RestApiHelper
{

    public static function getFormat(Request $request): ?string
    {
        $format = null;
        $mimeType = $request->headers->get('Content-Type');
        if ($mimeType) {
            $extensions = (new MimeTypes)->getExtensions($mimeType);
            $format = ArrayHelper::first($extensions);
        }
        return $format;
    }

    public static function extractHeaders(array $headers): array
    {
        $result = [];
        foreach ($headers as $headerKey => $headerValues) {
            $headerKey = self::prepareHeaderKey($headerKey);
            $result[$headerKey] = ArrayHelper::first($headerValues);
        }
        return $result;
    }

    protected static function keyToServerVar(string $name): string
    {
        return strtr(mb_strtoupper($name), '-', '_');
    }

    protected static function prepareHeaderKey(string $name): string
    {
        return strtr(mb_strtolower($name), '_', '-');
    }
}