<?php 

namespace Notes\Listener;

use Laminas\Mvc\MvcEvent;
use Laminas\Http\Response;

class CorsListener
{
    public function onDispatch(MvcEvent $event)
    {
        /** @var Response $response */
        $response = $event->getResponse();
        $headers = $response->getHeaders();
        
        $headers->addHeaderLine('Access-Control-Allow-Origin', '*');
        $headers->addHeaderLine('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        $headers->addHeaderLine('Access-Control-Allow-Headers', 'Content-Type, Authorization');

        $request = $event->getRequest();

        if ($request instanceof \Laminas\Http\Request && $request->getMethod() === \Laminas\Http\Request::METHOD_OPTIONS) {
            $response->setStatusCode(200);
            return $response;
        }
    }
}
