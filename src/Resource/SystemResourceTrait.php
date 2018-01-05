<?php

declare(strict_types=1);

/*
 * This file has been auto generated by Jane,
 *
 * Do no edit it directly.
 */

namespace Docker\API\Resource;

use Jane\OpenApiRuntime\Client\QueryParam;

trait SystemResourceTrait
{
    /**
     * Validate credentials for a registry and, if available, get an identity token for accessing the registry without password.
     *
     * @param \Docker\API\Model\AuthConfig $authConfig Authentication to check
     * @param array                        $parameters List of parameters
     * @param string                       $fetch      Fetch mode (object or response)
     *
     * @throws \Docker\API\Exception\SystemAuthInternalServerErrorException
     *
     * @return \Psr\Http\Message\ResponseInterface|\Docker\API\Model\AuthPostResponse200|null
     */
    public function systemAuth(\Docker\API\Model\AuthConfig $authConfig, array $parameters = [], string $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam($this->streamFactory);
        $url = '/auth';
        $url = $url . ('?' . $queryParam->buildQueryString($parameters));
        $headers = array_merge(['Accept' => ['application/json'], 'Content-Type' => ['application/json']], $queryParam->buildHeaders($parameters));
        $body = $this->serializer->serialize($authConfig, 'json');
        $request = $this->messageFactory->createRequest('POST', $url, $headers, $body);
        $response = $this->httpClient->sendRequest($request);
        if (self::FETCH_OBJECT === $fetch) {
            if (200 === $response->getStatusCode()) {
                return $this->serializer->deserialize((string) $response->getBody(), 'Docker\\API\\Model\\AuthPostResponse200', 'json');
            }
            if (204 === $response->getStatusCode()) {
                return null;
            }
            if (500 === $response->getStatusCode()) {
                throw new \Docker\API\Exception\SystemAuthInternalServerErrorException($this->serializer->deserialize((string) $response->getBody(), 'Docker\\API\\Model\\ErrorResponse', 'json'));
            }
        }

        return $response;
    }

    /**
     * @param array  $parameters List of parameters
     * @param string $fetch      Fetch mode (object or response)
     *
     * @throws \Docker\API\Exception\SystemInfoInternalServerErrorException
     *
     * @return \Psr\Http\Message\ResponseInterface|\Docker\API\Model\InfoGetResponse200
     */
    public function systemInfo(array $parameters = [], string $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam($this->streamFactory);
        $url = '/info';
        $url = $url . ('?' . $queryParam->buildQueryString($parameters));
        $headers = array_merge(['Accept' => ['application/json']], $queryParam->buildHeaders($parameters));
        $body = $queryParam->buildFormDataString($parameters);
        $request = $this->messageFactory->createRequest('GET', $url, $headers, $body);
        $response = $this->httpClient->sendRequest($request);
        if (self::FETCH_OBJECT === $fetch) {
            if (200 === $response->getStatusCode()) {
                return $this->serializer->deserialize((string) $response->getBody(), 'Docker\\API\\Model\\InfoGetResponse200', 'json');
            }
            if (500 === $response->getStatusCode()) {
                throw new \Docker\API\Exception\SystemInfoInternalServerErrorException($this->serializer->deserialize((string) $response->getBody(), 'Docker\\API\\Model\\ErrorResponse', 'json'));
            }
        }

        return $response;
    }

    /**
     * Returns the version of Docker that is running and various information about the system that Docker is running on.
     *
     * @param array  $parameters List of parameters
     * @param string $fetch      Fetch mode (object or response)
     *
     * @throws \Docker\API\Exception\SystemVersionInternalServerErrorException
     *
     * @return \Psr\Http\Message\ResponseInterface|\Docker\API\Model\VersionGetResponse200
     */
    public function systemVersion(array $parameters = [], string $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam($this->streamFactory);
        $url = '/version';
        $url = $url . ('?' . $queryParam->buildQueryString($parameters));
        $headers = array_merge(['Accept' => ['application/json']], $queryParam->buildHeaders($parameters));
        $body = $queryParam->buildFormDataString($parameters);
        $request = $this->messageFactory->createRequest('GET', $url, $headers, $body);
        $response = $this->httpClient->sendRequest($request);
        if (self::FETCH_OBJECT === $fetch) {
            if (200 === $response->getStatusCode()) {
                return $this->serializer->deserialize((string) $response->getBody(), 'Docker\\API\\Model\\VersionGetResponse200', 'json');
            }
            if (500 === $response->getStatusCode()) {
                throw new \Docker\API\Exception\SystemVersionInternalServerErrorException($this->serializer->deserialize((string) $response->getBody(), 'Docker\\API\\Model\\ErrorResponse', 'json'));
            }
        }

        return $response;
    }

    /**
     * This is a dummy endpoint you can use to test if the server is accessible.
     *
     * @param array  $parameters List of parameters
     * @param string $fetch      Fetch mode (object or response)
     *
     * @throws \Docker\API\Exception\SystemPingInternalServerErrorException
     *
     * @return \Psr\Http\Message\ResponseInterface|null
     */
    public function systemPing(array $parameters = [], string $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam($this->streamFactory);
        $url = '/_ping';
        $url = $url . ('?' . $queryParam->buildQueryString($parameters));
        $headers = array_merge(['Accept' => ['application/json']], $queryParam->buildHeaders($parameters));
        $body = $queryParam->buildFormDataString($parameters);
        $request = $this->messageFactory->createRequest('GET', $url, $headers, $body);
        $response = $this->httpClient->sendRequest($request);
        if (self::FETCH_OBJECT === $fetch) {
            if (200 === $response->getStatusCode()) {
                return json_decode((string) $response->getBody());
            }
            if (500 === $response->getStatusCode()) {
                throw new \Docker\API\Exception\SystemPingInternalServerErrorException($this->serializer->deserialize((string) $response->getBody(), 'Docker\\API\\Model\\ErrorResponse', 'json'));
            }
        }

        return $response;
    }

    /**
     * Stream real-time events from the server.

    Various objects within Docker report events when something happens to them.

    Containers report these events: `attach`, `commit`, `copy`, `create`, `destroy`, `detach`, `die`, `exec_create`, `exec_detach`, `exec_start`, `export`, `health_status`, `kill`, `oom`, `pause`, `rename`, `resize`, `restart`, `start`, `stop`, `top`, `unpause`, and `update`

    Images report these events: `delete`, `import`, `load`, `pull`, `push`, `save`, `tag`, and `untag`

    Volumes report these events: `create`, `mount`, `unmount`, and `destroy`

    Networks report these events: `create`, `connect`, `disconnect`, `destroy`, `update`, and `remove`

    The Docker daemon reports these events: `reload`

    Services report these events: `create`, `update`, and `remove`

    Nodes report these events: `create`, `update`, and `remove`

    Secrets report these events: `create`, `update`, and `remove`

    Configs report these events: `create`, `update`, and `remove`

     *
     * @param array $parameters {
     *
     *     @var string $since show events created since this timestamp then stream new events
     *     @var string $until show events created until this timestamp then stop streaming
     *     @var string $filters A JSON encoded value of filters (a `map[string][]string`) to process on the event list. Available filters:

     * }
     * @param string $fetch Fetch mode (object or response)
     *
     * @throws \Docker\API\Exception\SystemEventsBadRequestException
     * @throws \Docker\API\Exception\SystemEventsInternalServerErrorException
     *
     * @return \Psr\Http\Message\ResponseInterface|\Docker\API\Model\EventsGetResponse200
     */
    public function systemEvents(array $parameters = [], string $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam($this->streamFactory);
        $queryParam->addQueryParameter('since', false, ['string']);
        $queryParam->addQueryParameter('until', false, ['string']);
        $queryParam->addQueryParameter('filters', false, ['string']);
        $url = '/events';
        $url = $url . ('?' . $queryParam->buildQueryString($parameters));
        $headers = array_merge(['Accept' => ['application/json']], $queryParam->buildHeaders($parameters));
        $body = $queryParam->buildFormDataString($parameters);
        $request = $this->messageFactory->createRequest('GET', $url, $headers, $body);
        $response = $this->httpClient->sendRequest($request);
        if (self::FETCH_OBJECT === $fetch) {
            if (200 === $response->getStatusCode()) {
                return $this->serializer->deserialize((string) $response->getBody(), 'Docker\\API\\Model\\EventsGetResponse200', 'json');
            }
            if (400 === $response->getStatusCode()) {
                throw new \Docker\API\Exception\SystemEventsBadRequestException($this->serializer->deserialize((string) $response->getBody(), 'Docker\\API\\Model\\ErrorResponse', 'json'));
            }
            if (500 === $response->getStatusCode()) {
                throw new \Docker\API\Exception\SystemEventsInternalServerErrorException($this->serializer->deserialize((string) $response->getBody(), 'Docker\\API\\Model\\ErrorResponse', 'json'));
            }
        }

        return $response;
    }

    /**
     * @param array  $parameters List of parameters
     * @param string $fetch      Fetch mode (object or response)
     *
     * @throws \Docker\API\Exception\SystemDataUsageInternalServerErrorException
     *
     * @return \Psr\Http\Message\ResponseInterface|\Docker\API\Model\SystemDfGetResponse200
     */
    public function systemDataUsage(array $parameters = [], string $fetch = self::FETCH_OBJECT)
    {
        $queryParam = new QueryParam($this->streamFactory);
        $url = '/system/df';
        $url = $url . ('?' . $queryParam->buildQueryString($parameters));
        $headers = array_merge(['Accept' => ['application/json']], $queryParam->buildHeaders($parameters));
        $body = $queryParam->buildFormDataString($parameters);
        $request = $this->messageFactory->createRequest('GET', $url, $headers, $body);
        $response = $this->httpClient->sendRequest($request);
        if (self::FETCH_OBJECT === $fetch) {
            if (200 === $response->getStatusCode()) {
                return $this->serializer->deserialize((string) $response->getBody(), 'Docker\\API\\Model\\SystemDfGetResponse200', 'json');
            }
            if (500 === $response->getStatusCode()) {
                throw new \Docker\API\Exception\SystemDataUsageInternalServerErrorException($this->serializer->deserialize((string) $response->getBody(), 'Docker\\API\\Model\\ErrorResponse', 'json'));
            }
        }

        return $response;
    }
}
