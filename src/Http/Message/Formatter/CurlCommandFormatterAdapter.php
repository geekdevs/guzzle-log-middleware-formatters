<?php
namespace Geekdevs\Http\Message\Formatter;

use Exception;
use Http\Message\Formatter\CurlCommandFormatter;
use Http\Message\Formatter\FullHttpMessageFormatter;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * This formatter outputs curl request and then full request body and full response body + exception messages if any
 *
 * Class CurlCommandFormatterAdapter
 * @package Geekdevs\Http\Message\Formatter
 */
class CurlCommandFormatterAdapter
{
    private const MAX_BODY_LENGTH = 10000;

    /**
     * @var CurlCommandFormatter
     */
    private $curlCommandFormatter;

    /**
     * @var FullHttpMessageFormatter
     */
    private $fullHttpMessageFormatter;

    /**
     * HttpMessageLogFormatter constructor.
     */
    public function __construct()
    {
        $this->curlCommandFormatter = new CurlCommandFormatter();
        $this->fullHttpMessageFormatter = new FullHttpMessageFormatter(self::MAX_BODY_LENGTH);
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface|null $response
     * @param Exception|null $error
     * @return string
     */
    public function format(RequestInterface $request, ResponseInterface $response = null, Exception $error = null): string
    {
        return sprintf(
            "%s\n>>>>>>>>\n%s\n<<<<<<<<\n%s\n--------\n%s",
            $this->curlCommandFormatter->formatRequest($request),
            $this->fullHttpMessageFormatter->formatRequest($request),
            $this->fullHttpMessageFormatter->formatResponse($response),
            $error ? $error->getMessage() : '{OK}'
        );
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface|null $response
     * @param Exception|null $error
     * @return string
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response = null, Exception $error = null): string
    {
        return $this->format($request, $response, $error);
    }
}
