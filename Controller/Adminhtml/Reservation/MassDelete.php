<?php
declare(strict_types=1);

namespace Merlin\ReservationGrid\Controller\Adminhtml\Reservation;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\Redirect;
use Merlin\ReservationGrid\Model\ReservationFactory;
use Magento\Framework\Exception\LocalizedException;

class MassDelete extends Action
{
    public const ADMIN_RESOURCE = 'Merlin_ReservationGrid::reservation';

    private ReservationFactory $reservationFactory;

    public function __construct(
        Context            $context,
        ReservationFactory $reservationFactory
    ) {
        parent::__construct($context);
        $this->reservationFactory = $reservationFactory;
    }

    public function execute(): Redirect
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $ids = $this->getRequest()->getParam('selected', []);

        if (!is_array($ids) || empty($ids)) {
            $this->messageManager->addErrorMessage(__('Please select reservation(s).'));
            return $resultRedirect->setPath('*/*/index');
        }

        $deleted = 0;
        foreach ($ids as $id) {
            $id = (int)$id;
            if ($id <= 0) {
                continue;
            }
            try {
                $reservation = $this->reservationFactory->create()->load($id);
                if ($reservation->getId()) {
                    $reservation->delete();
                    $deleted++;
                }
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Throwable $e) {
                $this->messageManager->addErrorMessage(
                    __('An error occurred deleting reservation ID %1.', $id)
                );
            }
        }

        if ($deleted) {
            $this->messageManager->addSuccessMessage(
                __('A total of %1 reservation(s) have been deleted.', $deleted)
            );
        }

        return $resultRedirect->setPath('*/*/index');
    }
}
