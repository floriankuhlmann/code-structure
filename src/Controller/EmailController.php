<?php
namespace CoSt\Controller;
use CoSt\Helper\Response as Response;
use Symfony\Component\HttpFoundation\Request as Request;
use Mailgun\Mailgun;

class EmailController
{

    /**
     * @var Response
     */
    private $response;

    /**
     * CalculateValuationController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        # Instantiate the client.
        $mgClient = Mailgun::create('mailgin api key', 'https://api.eu.mailgun.net');
        $domain = "mailgun domain";
        $params = array(
            'from'    => 'from email address',
            'to'      => 'to email address',
            'subject' => 'Hello',
            'text'    => 'Testing some Mailgun awesomness!'
        );

        # Make the call to the client.
        $mgClient->messages()->send($domain, $params);
    }


}