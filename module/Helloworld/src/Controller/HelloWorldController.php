<?php

declare(strict_types=1);

namespace Helloworld\Controller;

use Laminas\Log\Logger;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Laminas\Http\Response; // Ensure this is the correct class

class HelloWorldController extends AbstractActionController
{
    private $logger;

    // Inject the logger through the constructor
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function helloworldAction()
    {
        try {
            // Log a message when this action is called
            $this->logger->info('Attempting to render HelloWorld action.');

            // Simulate an error for demonstration purposes (uncomment to test)
            // throw new \Exception('Simulated exception');

            // If everything is fine, return the view model
            return new ViewModel(['message' => 'Hello, World!']);

        } catch (\Exception $e) {
            // Log the error
            $this->logger->err('An error occurred in HelloWorldController: ' . $e->getMessage());

            // Retrieve and check the response type
            $response = $this->getResponse();
            if ($response instanceof Response) {
                // Set 404 status code in the response object
                $response->setStatusCode(Response::STATUS_CODE_404); // Use 404 directly if preferred
            } else {
                // If it's not the correct response type, log the issue
                $this->logger->err('Unexpected response type: ' . get_class($response));
            }

            // Return a custom error view model
            return new ViewModel([
                'message' => 'An error occurred, and the page could not be found.',
                'error' => $e->getMessage(),
            ]);
        }
    }
}
