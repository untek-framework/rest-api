<?php

namespace Untek\Framework\RestApi\Presentation\Http\Symfony\Controllers;

use Untek\Framework\RestApi\Presentation\Http\Symfony\Helpers\RestApiHelper;
use Untek\Framework\RestApi\Presentation\Http\Symfony\Libs\RestApiSerializer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Untek\Core\Instance\Helpers\MappingHelper;
use Untek\Framework\RestApi\Presentation\Http\Serializer\DefaultResponseSerializer;
use Untek\Framework\RestApi\Presentation\Http\Serializer\ResponseSerializerInterface;

abstract class AbstractRestApiController
{

    protected function extractData(Request $request): array
    {
        $format = RestApiHelper::getFormat($request);
        if ($request->getContent()) {
            $data = $request->getContent();
        } else {
            $data = $request->request->all();
        }
        if(empty($data)) {
            $data = $request->query->all();
        }
        if (is_string($data) && $format) {
            $data = $this->getSerializer()->decode($data, $format);
        }
        return $data;
    }

    protected function createForm(Request $request, string $type): object
    {
        $data = $this->extractData($request);
        return MappingHelper::restoreObject($data, $type);
//        return $this->getSerializer()->denormalize($data, $type);
    }

    protected function error(string $message, int $statusCode = 500): JsonResponse
    {
        $data = [
            'message' => $message
        ];
        return new JsonResponse($data, $statusCode);
    }

    protected function serialize($data): JsonResponse
    {
        /** @var JsonResponse $response */
        $response = $this->getResponseSerializer()->encode($data);
        return $response;
    }

    private function getResponseSerializer(): ResponseSerializerInterface
    {
        $serializer = $this->getSerializer();
        return new DefaultResponseSerializer($serializer);
    }

    private function getSerializer(): SerializerInterface
    {
        return new RestApiSerializer();
    }
}
