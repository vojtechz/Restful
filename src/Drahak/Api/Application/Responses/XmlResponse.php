<?php
namespace Drahak\Api\Application\Responses;

use Drahak\Api\IMapper;
use Drahak\Api\Mapping\XmlMapper;
use Nette\Application\IResponse;
use Nette\Object;
use Nette\Http;

/**
 * XmlResponse
 * @package Drahak\Api\Responses
 * @author Drahomír Hanák
 *
 * @property-write IMapper $mapper
 */
class XmlResponse extends Object implements IResponse
{

    /** @var IMapper */
    private $mapper;

    /**
     * @param array|\stdClass|\Traversable $data
     * @param string $rootElement
     */
    public function __construct($data, $rootElement = 'root')
    {
        $this->mapper = new XmlMapper($data, $rootElement);
    }

	/**
	 * Change XmlResponse mapper
	 * @param IMapper $mapper
	 * @return XmlResponse
	 */
	public function setMapper(IMapper $mapper)
	{
		$this->mapper = $mapper;
		return $this;
	}

    /**
     * Sends response to output
     * @param Http\IRequest $httpRequest
     * @param Http\IResponse $httpResponse
     */
    public function send(Http\IRequest $httpRequest, Http\IResponse $httpResponse)
    {
        $httpResponse->setContentType('application/xml');
        echo $this->mapper->convert();
    }


}