<?php
namespace Merlin\ReservationGrid\Controller\Adminhtml\Reservation;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\CsrfAwareActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Request\InvalidRequestException;

class Index extends Action implements CsrfAwareActionInterface
{
    const ADMIN_RESOURCE = 'Merlin_ReservationGrid::reservation';

    /**
     * @var PageFactory
     */
    private $resultPageFactory;

    public function __construct(
        Action\Context $context,
        PageFactory    $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Bypass Magento’s CSRF validator for this action
     *
     * @param RequestInterface $request
     * @return InvalidRequestException|null
     */
    public function createCsrfValidationException(RequestInterface $request): ?InvalidRequestException
    {
        return null;
    }

    /**
     * Always allow
     *
     * @param RequestInterface $request
     * @return bool|null
     */
    public function validateForCsrf(RequestInterface $request): ?bool
    {
        return true;
    }

    /**
     * Render the grid page
     */
    public function execute()
    {
        $page = $this->resultPageFactory->create();
        $page->setActiveMenu('Merlin_ReservationGrid::reservation');
        $page->getConfig()->getTitle()->prepend(__('Inventory Reservations'));
        return $page;
    }
}
