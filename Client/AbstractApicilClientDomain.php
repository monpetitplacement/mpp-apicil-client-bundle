<?php

namespace Mpp\ApicilClientBundle\Client;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Response as GuzzleResponse;
use Mpp\ApicilClientBundle\Model\ApicilApiError;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\SerializerInterface;

abstract class AbstractApicilClientDomain implements ApicilClientDomainInterface
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * @var ClientInterface
     */
    protected $httpClient;

    public function __construct(LoggerInterface $logger, SerializerInterface $serializer, ClientInterface $httpClient)
    {
        $this->logger = $logger;
        $this->serializer = $serializer;
        $this->httpClient = $httpClient;
    }

    /**
     * Retrieve logger.
     *
     * @method getLogger
     *
     * @return LoggerInterface
     */
    public function getLogger(): LoggerInterface
    {
        return $this->logger;
    }

    /**
     * Retrieve http client.
     *
     * @method getHttpClient
     *
     * @return ClientInterface
     */
    public function getHttpClient(): ClientInterface
    {
        return $this->httpClient;
    }

    /**
     * Make a guzzle request.
     *
     * @method request
     *
     * @param string $method
     * @param string $path
     * @param array  $options
     *
     * @return GuzzleResponse
     *
     * @throws ApicilApiError
     */
    public function request(string $method, string $path, array $options = []): GuzzleResponse
    {
        try {
            $fullPath = sprintf('%s%s', $this->getBasePath(), $path);
            $url = sprintf('%s%s', $this->httpClient->getConfig('base_uri'), $fullPath);
            $className = (new \ReflectionClass($this))->getName();

            $this->logger->info(sprintf('%s api call', $className), [
                'method' => $method,
                'url' => $url,
                'headers' => $this->httpClient->getConfig('headers'),
            ]);

            return $this->httpClient->request($method, $fullPath, $options);
        } catch (ClientException | ServerException $e) {
            if (Response::HTTP_UNAUTHORIZED === $e->getResponse()->getStatusCode()) {
                throw (new ApicilApiError())
                    ->setCode(Response::HTTP_UNAUTHORIZED)
                    ->setMessage($e->getResponse()->getBody()->getContents())
                    ->getException()
                ;
            }

            $apicilApiError = $this->serializer->deserialize($e->getResponse()->getBody()->getContents(), ApicilApiError::class, 'json');

            $this->logger->error(sprintf('%s error', $className), [
                'method' => $method,
                'url' => $url,
                'headers' => $this->httpClient->getConfig('headers'),
                'boby' => $e->getRequest()->getBody(),
                'response_code' => $e->getResponse()->getStatusCode(),
                'error_code' => $apicilApiError->getCode(),
                'error_messages' => (string) $apicilApiError,
            ]);

            throw $apicilApiError->getException();
        }
    }

    /**
     * Make and request and return the response ressource as file.
     *
     * @method download
     *
     * @param string $method
     * @param string $path
     * @param array  $options
     *
     * @return File
     */
    public function download(string $method, string $path, array $options = []): File
    {
        $temporaryResourcePath = sprintf('%s/%s', sys_get_temp_dir(), uniqid());
        $options['sink'] = fopen($temporaryResourcePath, 'w');
        $this->request($method, $path, $options);

        return new File($temporaryResourcePath);
    }

    /**
     * Make a request and deserialize the Guzzle response to an object of the given class name.
     *
     * @method requestAndPopulate
     *
     * @param string $className
     * @param string $method
     * @param string $path
     * @param array  $options
     *
     * @return mixed
     */
    public function requestAndPopulate(string $className, string $method, string $path, array $options = [])
    {
        $response = $this->request($method, $path, $options)->getBody()->getContents();

        if ('bool' === $className) {
            return filter_var($response, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        }

        if ('array' === $className) {
            return json_decode($response, true);
        }

        try {
            return $this->serializer->deserialize($response, $className, 'json');
        } catch (ExceptionInterface $e) {
            $this->logger->error(sprintf('Error during deserialization: %s', $e->getMessage()));
        }
    }

    /**
     * {@inheritdoc}
     */
    abstract public static function getClientDomainAlias(): string;

    /**
     * {@inheritdoc}
     */
    abstract public function getBasePath(): string;
}
