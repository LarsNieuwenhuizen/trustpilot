<?php
namespace LarsNieuwenhuizen\Trustpilot;

use GuzzleHttp\Client as HttpClient;
use LarsNieuwenhuizen\Trustpilot\Service\BusinessUnitDataService;
use LarsNieuwenhuizen\Trustpilot\Service\CategoriesDataService;
use LarsNieuwenhuizen\Trustpilot\Service\ConsumerDataService;

class Client
{
    /**
     * @var Configuration
     */
    protected $configuration;

    /**
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * @var BusinessUnitDataService
     */
    public $businessDataService;

    /**
     * @var CategoriesDataService
     */
    public $categoryDataService;

    /**
     * @var ConsumerDataService
     */
    public $consumerDataService;

    /**
     * Client constructor.
     * @param Configuration $configuration
     */
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
        $this->httpClient = new HttpClient([
            'base_uri' => $configuration->getBaseUrl() . $configuration->getBasePath(),
            'headers' => [
                'baseUrl' => $configuration->getBaseUrl() . $configuration->getBasePath(),
                'apikey' => $configuration->getApiKey()
            ]
        ]);
        $this->businessDataService = new BusinessUnitDataService($this);
        $this->categoryDataService = new CategoriesDataService($this);
        $this->consumerDataService = new ConsumerDataService($this);
    }

    /**
     * @return Configuration
     */
    public function getConfiguration(): Configuration
    {
        return $this->configuration;
    }

    /**
     * @param Configuration $configuration
     */
    public function setConfiguration(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @return HttpClient
     */
    public function getHttpClient(): HttpClient
    {
        return $this->httpClient;
    }
}
